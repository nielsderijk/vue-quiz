<?php

namespace App\ApiBundle\Controller;

use App\CoreBundle\Controller\Controller;
use Domain\Command\ReceiveGuestCommand;
use League\Tactician\CommandBus;
use MediaMonks\RestApiBundle\Exception\ValidationException;
use Nelmio\ApiDocBundle\Annotation\ApiDoc;
use Sensio\Bundle\FrameworkExtraBundle\Configuration as Sensio;
use Symfony\Component\HttpFoundation\Request;

/**
 * @Sensio\Route("guests", service="api.controller.guest")
 */
class GuestController extends Controller
{
    /**
     * @var CommandBus
     */
    private $commandBus;

    /**
     * @param CommandBus $commandBus
     */
    public function __construct(CommandBus $commandBus)
    {
        $this->commandBus = $commandBus;
    }

    /**
     * @param Request $request
     * @throws ValidationException
     * @return bool
     *
     * @Sensio\Route("/receive", name="api_guest_receive")
     * @Sensio\Method({"POST"})
     *
     * @ApiDoc(
     *  section="Guest",
     *  description="Receive a guest from the local event application and synchronize it with the database.",
     *  input="Domain\Command\ReceiveGuestCommand"
     * )
     */
    public function receiveAction(Request $request)
    {
        $command = new ReceiveGuestCommand(
            $request->request->get('uuid'),
            $request->request->get('firstName'),
            $request->request->get('lastName'),
            $request->request->get('email'),
            $request->request->getBoolean('terms'),
            $request->request->getBoolean('adult'),
            $request->request->getBoolean('newsletter'),
            $request->request->get('zip'),
            $request->request->get('status'),
            $request->request->get('phase'),
            $request->request->get('station'),
            $request->request->get('artworkData'),
            $request->files->get('artworkImage'),
            $request->request->get('createdAt'),
            $request->request->get('updatedAt'),
            $request->request->get('vrOneAssign'),
            $request->request->get('vrOneStart'),
            $request->request->get('vrOneFinish'),
            $request->request->get('vrTwoAssign'),
            $request->request->get('vrTwoStart'),
            $request->request->get('vrTwoFinish'),
            $request->request->get('signature')
        );

        return $this->commandBus->handle($command);
    }
}
