<?php

namespace AppBundle\Controller\Admin;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Routing\Annotation\Route;

class HomeController extends Controller
{
    /**
     * @Route("/admin", name="admin_home")
     */
    public function indexAction(Request $request)
    {
        return $this->render('admin/index.html.twig', []);
    }
}
