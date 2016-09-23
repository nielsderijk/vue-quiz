<?php

namespace App\FrontEndBundle\Controller;

use App\CoreBundle\Controller\Controller as BaseController;
use App\CoreBundle\Entity\Guest;
use App\CoreBundle\Service\S3UrlGenerator;
use Sensio\Bundle\FrameworkExtraBundle\Configuration as Sensio;
use Symfony\Component\HttpFoundation\RedirectResponse;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Generator\UrlGenerator;

/**
 * @author Rutger Mensch <rutger@mediamonks.com>
 */
class IndexController extends BaseController
{
    /**
     * @param Request $request
     * @param string  $uuid
     * @return Response
     *
     * @Sensio\Route(path="/", name="front_end_index")
     * @Sensio\Route(path="/{uuid}/", name="front_end_guest", requirements={
     *  "uuid"="[a-z0-9-]{8}-[a-z0-9-]{4}-[a-z0-9-]{4}-[a-z0-9-]{4}-[a-z0-9-]{12}"
     * })
     * @Sensio\Route(path="/creation/", name="front_end_creation")
     * @Sensio\Route(path="/creation/{uuid}/", name="front_end_creation_guest", requirements={
     *  "uuid"="[a-z0-9-]{8}-[a-z0-9-]{4}-[a-z0-9-]{4}-[a-z0-9-]{4}-[a-z0-9-]{12}"
     * })
     * @Sensio\Cache(smaxage=3600, maxage=3600)
     */
    public function indexAction(Request $request, $uuid = null)
    {
        $guest = null;
        $source = $request->get('source');
        $firstName = '';
        $shareUrl = $this->generateUrl('front_end_index', [], UrlGenerator::ABSOLUTE_URL);
        $imageUrl = $shareUrl.'bundles/appfrontend/default-share-image.png';
        $random360VideoId = rand(1, 5);

        if ($source !== 'email') {
            $source = 'other';
        }

        if ($uuid) {
            /** @var Guest $guest */
            $guest = $this->getRepository('App\CoreBundle\Entity\Guest')->find($uuid);

            if ($guest instanceof Guest && $guest->getStatus() >= Guest::STATUS_VR1_FINISHED) {
                /** @var S3UrlGenerator $s3UrlGenerator */
                $s3UrlGenerator = $this->get('app.s3_url_generator');

                $firstName = $guest->getFirstName();
                $imageUrl = $s3UrlGenerator->generateUrl($guest->getArtworkImagePath());
                $shareUrl = $this->generateUrl('front_end_guest', [
                    'uuid' => $uuid,
                ], UrlGenerator::ABSOLUTE_URL);
                $random360VideoId = $guest->getRandom360VideoId();

                // Users who participated before September 11th need to see a different version of the page.
                $cutoffDateTime = new \DateTime('2016-09-10 23:59:59');

                if ($request->get('_route') === 'front_end_guest' &&
                    $guest->getCreatedAt() <= $cutoffDateTime
                ) {
                    // The user is on the MDN page, but should see the TechCrunch page.
                    return new RedirectResponse($this->generateUrl('front_end_creation_guest', [
                        'uuid' => $uuid,
                    ]));
                }

                if ($request->get('_route') === 'front_end_creation_guest' &&
                    $guest->getCreatedAt() > $cutoffDateTime
                ) {
                    // The user is on the TechCrunch page, but should see the MDN page.
                    return new RedirectResponse($this->generateUrl('front_end_guest', [
                        'uuid' => $uuid,
                    ]));
                }
            }
        }

        return $this->render('AppFrontEndBundle:Home:index.html.twig', [
            'source' => $source, // Can be 'email' or 'other'.
            'firstName' => $firstName,
            'imageUrl' => $imageUrl,
            'shareUrl' => $shareUrl,
            'random360VideoId' => $random360VideoId,
        ]);
    }
}
