<?php

namespace App\EventListener;


use Doctrine\ORM\EntityManagerInterface;
use Doctrine\ORM\Mapping\Entity;
use Illuminate\Http\RedirectResponse;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Security\Core\Authentication\Token\TokenInterface;
use Symfony\Component\Security\Http\Authentication\AuthenticationSuccessHandlerInterface;

class AuthSuccessHandler implements AuthenticationSuccessHandlerInterface
{
    public function __construct(
        protected EntityManagerInterface $entityManager
    ){
    }

    public function onAuthenticationSuccess(Request $request, TokenInterface $token): ?Response
    {
    $user = $token->getUser();
    $user->setLoginAt(new \DateTimeImmutable());
    $user->setLoginCnt($user->getLoginCnt() + 1);
    $user->setNonLoginCnt($user->getNonLoginCnt() * 0 );

    $this->entityManager->flush();

    return new \Symfony\Component\HttpFoundation\RedirectResponse('/admin/home');
    }
}