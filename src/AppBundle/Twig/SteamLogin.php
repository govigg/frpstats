<?php

namespace AppBundle\Twig;

use Symfony\Component\Routing\Generator\UrlGeneratorInterface;
use Symfony\Component\DependencyInjection\ContainerInterface as Container;

class SteamLogin extends \Twig_Extension {
    private $container;

    public function getFunctions(){
        return array(
            new \Twig_SimpleFunction("getSteamLoginUrl",array($this,"steamUrl")),
        );
    }

    public function __construct(Container $container){
        $this->container = $container;
    }

    public function steamUrl(){
        $steamLogin = $this->container->get("steam_login");
        $router = $this->container->get("router");

        return $steamLogin->genUrl($router->generate("main_login",array(), UrlGeneratorInterface::ABSOLUTE_URL),false);
    }

    public function getName()
    {
        return "steam_login";
    }
}