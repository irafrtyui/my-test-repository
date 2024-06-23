<?php

namespace App\Controller\Admin;

use App\Entity\Cart;
use App\Entity\Comments;
use App\Services\Export;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\BinaryFileResponse;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\HttpFoundation\ResponseHeaderBag;

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

    public function exportCart(Export $export, EntityManagerInterface $em): Response
    {
        $list = $em->getRepository(Cart::class)->GetCart();
        $file = $export->exportNews($list);

        $response = new BinaryFileResponse($file);
        $response->headers->set('Content-type', 'text/csv');
        $response->setContentDisposition(
            ResponseHeaderBag::DISPOSITION_ATTACHMENT,
            'export-data.csv'
        );
        return $response;
    }

    public function deleteCart(int $id, EntityManagerInterface $entityManager)
    {
        $list = $entityManager->getRepository(Cart::class)->findAll();

        return $this->render('Admin/cart/index.html.twig', [
            'list' => $list,
        ]);
    }

}