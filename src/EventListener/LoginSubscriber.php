<?php

namespace App\EventListener;

use Symfony\Component\Security\Http\Event\InteractiveLoginEvent;
use Symfony\Component\Security\Core\Exception\CustomUserMessageAuthenticationException;

class EmailVerificationListener
{
public function onSecurityInteractiveLogin(InteractiveLoginEvent $event)
{
$user = $event->getAuthenticationToken()->getUser();

if (!$user instanceof \App\Entity\User) {
return;
}

if (!$user->isEmailVerified()) {
throw new CustomUserMessageAuthenticationException(
'Vous devez valider votre adresse email avant de pouvoir vous connecter.'
);
}
}
}
