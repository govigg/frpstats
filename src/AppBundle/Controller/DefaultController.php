<?php

namespace AppBundle\Controller;

use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;
use AppBundle\Entity\User;
use SteamCondenser\Community\SteamId;

class DefaultController extends Controller
{
    /**
     * @Route("/", name="homepage")
     */
    public function indexAction(Request $request)
    {
//        if($this->getUser()){
            return $this->render('@App/Default/main.html.twig');
//        }
//        return $this->render('@App/notlogged.html.twig');
    }

    public function loginAction(Request $request){
        $steamid = $this->get("steam_login")->validate();

        $db = $this->getDoctrine();
        $user = $db->getRepository("AppBundle:User")->findOneBy(array("steamID"=>$steamid));

        $steam = SteamId::create('76561198038819576');
        dump($steam->getNickname());

        if($user instanceof User == false){
//            $manipulator = $this->get('fos_user.util.user_manipulator');
//            $manipulator->create();

        }

        if($user instanceof User){
            $loginManager = $this->get("fos_user.security.login_manager");
            $loginManager->logInUser("main",$user);
        }

//        return $this->redirectToRoute("main");
    }
}
