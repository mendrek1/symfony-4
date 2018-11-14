<?php
/**
 * Created by PhpStorm.
 * User: MenDreK
 * Date: 05.11.2018
 * Time: 10:55
 */

namespace App\Controller;

use App\Entity\User;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Security;
use Symfony\COmponent\Routing\Annotation\Route;

/**
 * @Security("is_granted('ROLE_USER')")
 * @Route("/following")
 */
class FollowingController extends Controller
{
    /**
     * @Route("/follow/{id}", name="following_follow")
     * @param User $userToFollow
     * @return \Symfony\Component\HttpFoundation\RedirectResponse
     */
    public function follow(User $userToFollow)
    {

        /** @var User $currentUser */
        $currentUser = $this->getUser();

        if($userToFollow->getId() != $currentUser->getId()){

            $currentUser->follow($userToFollow);

            $this->getDoctrine()
                ->getManager()
                ->flush();
        }


        return $this->redirectToRoute(
            'micro_post_user',
                ['username' => $userToFollow->getUsername()]
        );
    }

    /**
     * @Route("/unfollow/{id}", name="following_unfollow")
     *
     * @return \Symfony\Component\HttpFoundation\RedirectResponse
     */
    public function unfollow(User $userToUnfollow)
    {
        /** @var User $currentUser */
        $currentUser = $this->getUser();
        $currentUser->getFollowing()
            ->removeElement($userToUnfollow);

        $this->getDoctrine()
            ->getManager()
            ->flush();

        return $this->redirectToRoute(
            'micro_post_user',
            ['username' => $userToUnfollow->getUsername()]
        );

    }
}