<?php


namespace App\Controller;

use App\Entity\Comments;
use App\Entity\Mail;
use App\Form\CommentsForm;
use App\Form\MailForm;
use App\Services\Export;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Component\HttpFoundation\Session\Session;
use Symfony\Component\Mime\Email;
use Symfony\Component\HttpFoundation\BinaryFileResponse;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\ResponseHeaderBag;
use Symfony\Component\HttpFoundation\Response;
use App\Entity\Posts;
use Symfony\Component\Mailer\MailerInterface;
use Symfony\Component\Security\Http\Authentication\AuthenticationUtils;


class DefaultController extends AbstractController
{
    public function home(): Response
    {
        return $this->render('Default/home.html.twig');
    }

    public function feedback(Request $request, EntityManagerInterface $entityManager, MailerInterface $mailer): Response
    {
        $form = $this->createForm(MailForm::class);
        $form->handleRequest($request);

        $isSubmitted = false;
        if ($form->isSubmitted() && $form->isValid()) {
            /** @var Mail $mail */
            $mail = $form->getData();


            $entityManager->persist($mail);
            $entityManager->flush();

            $message = new Email();
            $message->from('alex.course.test@gmail.com');
            $message->to('irafrtyui@ukr.net');
            $message->text('Hello!');
            $message->html($this->renderView('Mail/review.html.twig', [
                'email' => $mail->getEmail(),
                'name' => $mail->getName(),
                'message' => $mail->getMessage()
            ]));
            $message->subject('Feedback: [' . $mail->getEmail() . ']');

            $mailer->send($message);
            $this->addFlash('success', 'Thanks for your mail!');
            return $this->redirectToRoute('default_home');

        }
        return $this->render('Default/feedback.html.twig', [
            'form' => $form->createView(),
            'isSubmitted' => $isSubmitted,
        ]);
    }

    public function login(AuthenticationUtils $authenticationUtils): Response
    {
        $error = $authenticationUtils->getLastAuthenticationError();
        return $this->render('Default/login.html.twig', [
            'error' => $error,
            ]);
    }

    public function about(): Response
    {
        return $this->render('Default/about.html.twig');
    }

    public function latestNews(EntityManagerInterface $em): Response
    {
        $posts = $em->getRepository(Posts::class)->findAll();
        return $this->render('Default/latestNews.html.twig', [
            'posts' => $posts,
        ]);
    }

    public function newsList(Request $request, EntityManagerInterface $em): Response
    {
        $list = $em->getRepository(Posts::class)->GetNewsList();
        return $this->render('Default/newsList.html.twig', [
            'list' => $list,
        ]);
    }


    public function newsOne(int $id, Request $request, EntityManagerInterface $entityManager): Response
    {
        $post = $entityManager->getRepository(Posts::class)->find($id);

        $form = $this->createForm(CommentsForm::class);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            /** @var Comments $comment */
            $comment = $form->getData();
            $comment->setDate(new \DateTime());
            $comment->setPost($post);

            $entityManager->persist($comment);
            $entityManager->flush();


            $form = $this->createForm(CommentsForm::class);

            $this->addFlash('success', 'Thanks for your comment');
            return $this->redirectToRoute('default_newsOne', [
                'id' => $id,
            ]);
        }
        return $this->render('Default/newsOne.html.twig', [
            'post' => $post,
            'form' => $form->createView(),
        ]);
    }


    public function contacts(): Response
    {
        return $this->render('Default/contacts.html.twig');
    }

    public function exportList(Export $export, EntityManagerInterface $em): Response
    {
        $list = $em->getRepository(Posts::class)->GetNewsList();
        $file = $export->exportNews($list);

        $response = new BinaryFileResponse($file);
        $response->headers->set('Content-type', 'text/csv');
        $response->setContentDisposition(
            ResponseHeaderBag::DISPOSITION_ATTACHMENT,
            'export-data.csv'
        );
        return $response;
    }
}