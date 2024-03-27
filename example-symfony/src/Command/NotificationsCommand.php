<?php

namespace App\Command;

use App\Entity\Comments;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bridge\Twig\Mime\TemplatedEmail;
use Symfony\Component\Console\Attribute\AsCommand;
use Symfony\Component\Console\Command\Command;
use Symfony\Component\Console\Input\InputArgument;
use Symfony\Component\Console\Input\InputInterface;
use Symfony\Component\Console\Input\InputOption;
use Symfony\Component\Console\Output\OutputInterface;
use Symfony\Component\Console\Style\SymfonyStyle;
use Symfony\Component\Mailer\MailerInterface;
use Symfony\Component\Routing\RouterInterface;

#[AsCommand(
    name: 'notifications',
    description: 'New comments in 1 day',
)]
class NotificationsCommand extends Command
{
    public function __construct(
        protected EntityManagerInterface $entityManager,
        protected RouterInterface $router,
        protected MailerInterface $mailer,
    )
    {
        parent::__construct();
    }


    protected function execute(InputInterface $input, OutputInterface $output): int
    {
        $io = new SymfonyStyle($input, $output);
        $comments = $this->entityManager->getRepository(Comments::class)->GetNewComments();

        $message = new TemplatedEmail();
        $message->from('alex.course.test@gmail.com');
        $message->to('irafrtyui@ukr.net');
        $message->text('You have new comments!');
        $message->htmlTemplate('Mail/notifications.html.twig');
        $message->context(['comments' => $comments]);
        $message->subject('A new comments');

        $this->mailer->send($message);

        return Command::SUCCESS;
    }
}
