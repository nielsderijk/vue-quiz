<?php

namespace App\FrontEndBundle\Controller;

use App\CoreBundle\Controller\Controller as BaseController;
use Aws\Sns\Exception\InvalidSnsMessageException;
use Aws\Sns\Message;
use Aws\Sns\MessageValidator;
use Sensio\Bundle\FrameworkExtraBundle\Configuration as Sensio;
use Symfony\Component\HttpFoundation\Response;

/**
 * @author Rutger Mensch <rutger@mediamonks.com>
 */
class AwsController extends BaseController
{
    /**
     * @return Response
     *
     * @Sensio\Route(path="/aws/sns", name="front_end_aws_sns")
     */
    public function snsAction()
    {
        $message = Message::fromRawPostData();
        $validator = new MessageValidator();

        try {
            $validator->validate($message);

            if ($message['Type'] === 'SubscriptionConfirmation') {
                file_get_contents($message['SubscribeURL']);
            }

            return new Response();
        } catch (InvalidSnsMessageException $e) {
            return new Response($e->getMessage(), Response::HTTP_NOT_FOUND);
        }
    }

    /**
     * @return Response
     *
     * @Sensio\Route(path="/aws/sestest", name="front_end_aws_ses_test")
     */
    public function sesTestAction()
    {
        /** @var \Swift_Mailer $mailer */
        $mailer = $this->get('mailer');
        $message = new \Swift_Message();
        $message->setFrom('no-reply@primeimpossiblequest.com');
        $message->setTo('rutger.mensch@mediamonks.com');
        $message->setSubject('This is a test');
        $message->setBody('testing 123');
        $result = 0; //$mailer->send($message);

        return new Response($result);
    }
}
