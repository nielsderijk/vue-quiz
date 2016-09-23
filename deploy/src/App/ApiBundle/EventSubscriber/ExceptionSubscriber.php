<?php

namespace App\ApiBundle\EventSubscriber;

use League\Tactician\Bundle\Middleware\InvalidCommandException;
use MediaMonks\RestApiBundle\Exception\ErrorField;
use MediaMonks\RestApiBundle\Exception\ValidationException;
use Symfony\Component\EventDispatcher\EventSubscriberInterface;
use Symfony\Component\HttpKernel\Event\GetResponseForExceptionEvent;
use Symfony\Component\HttpKernel\KernelEvents;
use Symfony\Component\Validator\ConstraintViolation;

/**
 * @package App\ApiBundle\EventSubscriber
 * @author Rutger Mensch <rutger@mediamonks.com>
 */
class ExceptionSubscriber implements EventSubscriberInterface
{
    /**
     * @return array
     */
    public static function getSubscribedEvents()
    {
        return [
            KernelEvents::EXCEPTION => [
                ['processException', 1000],
            ],
        ];
    }

    /**
     * @param GetResponseForExceptionEvent $event
     * @throws ValidationException
     */
    public function processException(GetResponseForExceptionEvent $event)
    {
        $exception = $event->getException();

        if ($exception instanceof InvalidCommandException) {
            /** @var ConstraintViolation[] $violations */
            $violations = $exception->getViolations();
            $fields = [];

            foreach ($violations as $key => $violation) {
                $fields[] = new ErrorField(
                    $violation->getPropertyPath(),
                    $violation->getCode(),
                    $violation->getMessage()
                );
            }

            throw new ValidationException($fields, $exception->getMessage(), $exception->getCode());
        }
    }
}
