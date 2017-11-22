<?php

namespace Biberltd\ValidatorBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;

class DefaultController extends Controller
{
    public function indexAction()
    {
        return $this->render('ValidatorBundle:Default:index.html.twig');
    }
}
