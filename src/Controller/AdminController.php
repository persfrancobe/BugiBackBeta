<?php

namespace App\Controller;

use App\Entity\Block;
use App\Form\BlockType;
use App\Repository\BlockRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

/**
 * @Route("/admin",name="admin_")
 */
class AdminController extends AbstractController
{
    /**
     * @Route("", name="index", methods={"GET"})
     */
    public function index(): Response
    {
        $this->denyAccessUnlessGranted('ROLE_ADMIN');
        return $this->render('admin/index.html.twig');
    }
    public function nav(): Response
    {
        return $this->render('admin/partials/_nav.html.twig');
    }


}
