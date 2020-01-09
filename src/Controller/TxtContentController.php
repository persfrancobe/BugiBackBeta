<?php

namespace App\Controller;

use App\Entity\TxtContent;
use App\Form\TxtContentType;
use App\Repository\TxtContentRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

/**
 * @Route("/txt/content")
 */
class TxtContentController extends AbstractController
{
    /**
     * @Route("/", name="txt_content_index", methods={"GET"})
     */
    public function index(TxtContentRepository $txtContentRepository): Response
    {
        return $this->render('txt_content/index.html.twig', [
            'txt_contents' => $txtContentRepository->findAll(),
        ]);
    }

    /**
     * @Route("/new", name="txt_content_new", methods={"GET","POST"})
     */
    public function new(Request $request): Response
    {
        $txtContent = new TxtContent();
        $form = $this->createForm(TxtContentType::class, $txtContent);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $entityManager = $this->getDoctrine()->getManager();
            $entityManager->persist($txtContent);
            $entityManager->flush();

            return $this->redirectToRoute('txt_content_index');
        }

        return $this->render('txt_content/new.html.twig', [
            'txt_content' => $txtContent,
            'form' => $form->createView(),
        ]);
    }

    /**
     * @Route("/{id}", name="txt_content_show", methods={"GET"})
     */
    public function show(TxtContent $txtContent): Response
    {
        return $this->render('txt_content/show.html.twig', [
            'txt_content' => $txtContent,
        ]);
    }

    /**
     * @Route("/{id}/edit", name="txt_content_edit", methods={"GET","POST"})
     */
    public function edit(Request $request, TxtContent $txtContent): Response
    {
        $form = $this->createForm(TxtContentType::class, $txtContent);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $this->getDoctrine()->getManager()->flush();

            return $this->redirectToRoute('txt_content_index');
        }

        return $this->render('txt_content/edit.html.twig', [
            'txt_content' => $txtContent,
            'form' => $form->createView(),
        ]);
    }

    /**
     * @Route("/{id}", name="txt_content_delete", methods={"DELETE"})
     */
    public function delete(Request $request, TxtContent $txtContent): Response
    {
        if ($this->isCsrfTokenValid('delete'.$txtContent->getId(), $request->request->get('_token'))) {
            $entityManager = $this->getDoctrine()->getManager();
            $entityManager->remove($txtContent);
            $entityManager->flush();
        }

        return $this->redirectToRoute('txt_content_index');
    }
}
