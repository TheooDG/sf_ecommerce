<?php

namespace App\EventSubscriber;

use Symfony\Component\EventDispatcher\EventSubscriberInterface;
use Symfony\Component\Security\Core\Exception\AuthenticationException;
use Symfony\Component\Security\Http\Event\CheckPassportEvent;

class TestSubscriber implements EventSubscriberInterface
{
    public function onCheckPassportEvent(CheckPassportEvent $event): void
    {
        $user = $event->getPassport()->getUser();
        if($user->isVerified() === false)
            throw new AuthenticationException();
    }

    public static function getSubscribedEvents(): array
    {
        return array(
            CheckPassportEvent::class => 'onCheckPassportEvent',
        );
    }
}