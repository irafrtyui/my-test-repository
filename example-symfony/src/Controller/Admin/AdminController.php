<?php

namespace App\Controller\Admin;

use App\Entity\Comments;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;

/**
 * @method getDoctrine()
 */
class AdminController extends AbstractController
{
    public function adminHome(): Response
    {
        return $this->render('Admin/adminhome.html.twig');
    }

    public function commentsList(EntityManagerInterface $entityManager): Response
    {
        $list = $entityManager->getRepository(Comments::class)->findAll();

        return $this->render('Admin/admin_comments.html.twig', [
            'list' => $list,
        ]);
    }

    public function commentsDelete($id, EntityManagerInterface $entityManager): Response
    {
        $comment = $entityManager->getRepository(Comments::class)->find($id);
        if($comment){
            $entityManager->remove($comment);
            $entityManager->flush();
        }
        $this->addFlash('success', 'Deleted');
        return $this->redirectToRoute('admin_comments');
    }

}