<?php
/**
 * Created by PhpStorm.
 * User: MenDreK
 * Date: 09.11.2018
 * Time: 10:00
 */

namespace App\Event;


use App\Mailer\Mailer;
use Swift_Mailer;
use Swift_Message;
use Symfony\Component\EventDispatcher\EventSubscriberInterface;
use Twig_Environment;

class UserSubscriber implements EventSubscriberInterface
{
    /**
     * @var Mailer
     */
    private $mailer;


    public function __construct(Mailer $mailer)
    {
        $this->mailer = $mailer;
    }

    public static function getSubscribedEvents()
    {
        return [
          UserRegisterEvent::NAME => 'onUserRegister'
        ];
    }

    public function onUserRegister(UserRegisterEvent $event){
        $this->mailer->sendConfirmationEmail($event->getRegisteredUser());
    }



}