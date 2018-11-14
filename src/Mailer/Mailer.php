<?php
/**
 * Created by PhpStorm.
 * User: MenDreK
 * Date: 14.11.2018
 * Time: 12:25
 */

namespace App\Mailer;


use App\Entity\User;
use Swift_Mailer;
use Swift_Message;

class Mailer
{
    /**
     * @var Swift_Mailer
     */
    private $mailer;
    /**
     * @var \Twig_Environment
     */
    private $twig;
    /**
     * @var string
     */
    private $mailFrom;

    public function __construct(\Swift_Mailer $mailer, \Twig_Environment $twig, string $mailFrom)
    {

        $this->mailer = $mailer;
        $this->twig = $twig;
        $this->mailFrom = $mailFrom;
    }

    /**
     * @param User $user
     */
    public function sendConfirmationEmail(User $user){
        $body = $this->twig->render('email/registration.html.twig',[
            'user' => $user
        ]);
        $message = (new Swift_Message())
            ->setSubject('Welcome to the micro-post app!')
            ->setFrom($this->mailFrom)
            ->setTo($user->getEmail())
            ->setBody($body,'text/html');

        $this->mailer->send($message);

    }
}