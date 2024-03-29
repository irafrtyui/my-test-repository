<?php

namespace App\EventListener;


use Doctrine\ORM\EntityManagerInterface;
use Monolog\DateTimeImmutable;
use Symfony\Component\HttpFoundation\RedirectResponse;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Security\Core\Exception\AuthenticationException;
use Symfony\Component\Security\Http\Authentication\AuthenticationFailureHandlerInterface;

class AuthFailureHandler implements AuthenticationFailureHandlerInterface
{

    public function __construct(
        protected EntityManagerInterface $entityManager
    ){
    }

    public function onAuthenticationFailure(Request $request, AuthenticationException $exception): Response
    {
    $user = $exception->getToken()->getUser();

    $user->setNonLoginAt(new \DateTimeImmutable());
    $user->setNonLoginCnt($user->getNonLoginCnt() + 1);

    $this->entityManager->flush();

    return new RedirectResponse('/');
    }
}