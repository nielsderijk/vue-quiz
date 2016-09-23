<?php

namespace Domain\Handler;

use App\CoreBundle\Entity\Guest;
use App\CoreBundle\Service\S3UrlGenerator;
use Doctrine\ORM\EntityManager;
use Domain\Command\ReceiveGuestCommand;
use Intervention\Image\ImageManager;
use League\Flysystem\Filesystem;
use Symfony\Bundle\FrameworkBundle\Routing\Router;
use Symfony\Bundle\TwigBundle\TwigEngine;
use Symfony\Component\HttpFoundation\File\File;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Generator\UrlGeneratorInterface;

/**
 * @package Domain\Handler
 * @author Rutger Mensch <rutger@mediamonks.com>
 */
class ReceiveGuestHandler
{
    /**
     * @var string
     */
    protected $synchronizeGuestsKey;

    /**
     * @var EntityManager
     */
    protected $entityManager;

    /**
     * @var Filesystem
     */
    protected $filesystem;

    /**
     * @var TwigEngine
     */
    protected $templating;

    /**
     * @var \Swift_Mailer
     */
    protected $mailer;

    /**
     * @var Router
     */
    protected $router;

    /**
     * @var S3UrlGenerator
     */
    protected $s3UrlGenerator;

    /**
     * @var ImageManager
     */
    protected $imageManager;

    /**
     * @param string         $synchronizeGuestsKey
     * @param EntityManager  $entityManager
     * @param Filesystem     $filesystem
     * @param Router         $router
     * @param S3UrlGenerator $s3UrlGenerator
     * @param TwigEngine     $templating
     * @param \Swift_Mailer  $mailer
     */
    public function __construct(
        $synchronizeGuestsKey,
        EntityManager $entityManager,
        Filesystem $filesystem,
        Router $router,
        S3UrlGenerator $s3UrlGenerator,
        TwigEngine $templating,
        \Swift_Mailer $mailer
    ) {
        $this->synchronizeGuestsKey = $synchronizeGuestsKey;
        $this->entityManager = $entityManager;
        $this->filesystem = $filesystem;
        $this->router = $router;
        $this->s3UrlGenerator = $s3UrlGenerator;
        $this->templating = $templating;
        $this->mailer = $mailer;
        $this->imageManager = new ImageManager();
    }

    /**
     * @param ReceiveGuestCommand $command
     * @return true
     */
    public function handle(ReceiveGuestCommand $command)
    {
        $this->verifySignature(
            $command->getUuid(),
            $command->getFirstName(),
            $command->getLastName(),
            $command->getEmail(),
            $command->getSignature()
        );

        $uuid = $command->getUuid();
        $guest = $this
            ->entityManager
            ->getRepository('App\CoreBundle\Entity\Guest')
            ->find($uuid)
        ;

        if (!$guest instanceof Guest) {
            // The guest hasn't been synchronized before, so create a new entity for the guest.
            $guest = new Guest();
            $guest->setUuid($uuid);
        }

        $file = $command->getArtworkImage();

        if ($file instanceof File) {
            $contents = file_get_contents($file->getRealPath());
            $image = $this->imageManager->make($contents);
            $path = $guest->getArtworkImagePath();
            $this->filesystem->put($path, (string) $image->encode('png'));
        }

        $guest->setFirstName($command->getFirstName());
        $guest->setLastName($command->getLastName());
        $guest->setEmail($command->getEmail());
        $guest->setConsentTerms($command->getTerms());
        $guest->setOverEighteen($command->isAdult());
        $guest->setUpdateReceiver($command->getNewsletter());
        $guest->setZipCode($command->getZip());
        $guest->setStatus($command->getStatus());
        $guest->setPhase($command->getPhase());
        $guest->setStation($command->getStation());
        $guest->setArtworkData($command->getArtworkData());
        $guest->setCreatedAt($command->getCreatedAt());
        $guest->setUpdatedAt($command->getUpdatedAt());
        $guest->setVrOneAssign($command->getVrOneAssign());
        $guest->setVrOneStart($command->getVrOneStart());
        $guest->setVrOneFinish($command->getVrOneFinish());
        $guest->setVrTwoAssign($command->getVrTwoAssign());
        $guest->setVrTwoStart($command->getVrTwoStart());
        $guest->setVrTwoFinish($command->getVrTwoFinish());

        $this->entityManager->persist($guest);
        $this->entityManager->flush();
        $this->handleEmail($guest);

        return true;
    }

    /**
     * @param string $uuid
     * @param string $firstName
     * @param string $lastName
     * @param string $email
     * @param string $providedSignature
     */
    protected function verifySignature($uuid, $firstName, $lastName, $email, $providedSignature)
    {
        $signatureData = $uuid.$firstName.$lastName.$email;
        $signature = hash_hmac('sha256', $signatureData, $this->synchronizeGuestsKey);

        if ($signature !== $providedSignature) {
            throw new \InvalidArgumentException(
                'The provided signature could not be validated.',
                Response::HTTP_BAD_REQUEST
            );
        }
    }

    /**
     * @param Guest $guest
     * @return null
     */
    protected function handleEmail(Guest $guest)
    {
        $artworkImagePath = $guest->getArtworkImagePath();

        if ($guest->getStatus() < Guest::STATUS_VR1_FINISHED || // The guest has not finished VR1 yet.
            $guest->hasReceivedEmail() || // The guest has already received the e-mail.
            !$this->filesystem->has($artworkImagePath) // The artwork image does not exist on the filesystem.
        ) {
            return null;
        }

        $this->router->getContext()->setScheme('https');
        $shareUrl = $this->router->generate('front_end_guest', [
            'uuid' => $guest->getUuid(),
            'source' => 'email',
        ], UrlGeneratorInterface::ABSOLUTE_URL);
        $parameters = [
            'firstName' => $guest->getFirstName(),
            'shareUrl' => $shareUrl,
            'artworkImageUrl' => $this->s3UrlGenerator->generateUrl($artworkImagePath),
        ];

        $text = $this->templating->render('AppCoreBundle:Email:finish_vr_one.txt.twig', $parameters);
        $html = $this->templating->render('AppCoreBundle:Email:finish_vr_one.html.twig', $parameters);

        if (ENVIRONMENT === ENV_UAT || ENVIRONMENT === ENV_PRODUCTION) {
            $message = new \Swift_Message();
            $message->setFrom(['no-reply@primeimpossiblequest.com' => 'The Impossible Quest']);
            $message->setTo([$guest->getEmail() => $guest->getFirstName()]);
            $message->setSubject('Thank you for participating in "The Impossible Quest."');
            $message->setBody($text);
            $message->addPart($html, 'text/html');

            $this->mailer->send($message);
        } else {
            $logDirectory = realpath(__DIR__.'/../../../var/logs/mails').'/';
            $now = time();

            file_put_contents($logDirectory.$now.'.log.txt', $text);
            file_put_contents($logDirectory.$now.'.log.html', $html);
        }

        $guest->setReceivedEmail(true);
        $this->entityManager->flush();

        return null;
    }
}
