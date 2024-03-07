<?php

namespace App\Controller\Admin;

use App\Entity\Comments;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;

class AdminController extends AbstractController
{
    public function commentsList(EntityManagerInterface $entityManager): Response
    {
        $list = $entityManager->getRepository(Comments::class)->findAll();
        return $this->render('Admin/admin_comments.html.twig', [
            'list' => $list,
        ]);
    }
}