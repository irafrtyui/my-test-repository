<?php

namespace App\EventListener;


use App\Entity\User;
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

        $login = $request->request->get('_username');
        $user = $this->entityManager->getRepository(User::class)->findOneBy([
           'login' => $login,
        ]);
        if(false == empty($user)){
            $user->setNonLoginAt(new \DateTimeImmutable());
            $user->setNonLoginCnt($user->getNonLoginCnt() + 1);

            $this->entityManager->flush();
        }

    return new RedirectResponse('/default/login');
    }
}