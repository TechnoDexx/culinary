<?php

namespace App\EventSubscriber;

use App\Repository\RecipeCategoriesRepository;
use Symfony\Component\EventDispatcher\EventSubscriberInterface;
use Symfony\Component\HttpKernel\Event\ControllerEvent;
use Twig\Environment;

class TwigEventSubscriber implements EventSubscriberInterface
{
    private $twig;
    private $rep;

    public function __construct(Environment $twig, RecipeCategoriesRepository $categoriesRepository)
    {
        $this->twig = $twig;
        $this->rep = $categoriesRepository;
    }
    public function onKernelController(ControllerEvent $event)
    {
      $this->twig->addGlobal('categories', $this->rep->findAll());
    }

    public static function getSubscribedEvents()
    {
        return [
            'kernel.controller' => 'onKernelController',
        ];
    }
}
