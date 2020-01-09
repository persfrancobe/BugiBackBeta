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
 * @Route("/block")
 */
class BlockController extends AbstractController
{
    /**
     * @Route("/", name="block_index", methods={"GET"})
     */
    public function index(BlockRepository $blockRepository): Response
    {
        return $this->render('block/index.html.twig', [
            'blocks' => $blockRepository->findAll(),
        ]);
    }

    /**
     * @Route("/new", name="block_new", methods={"GET","POST"})
     */
    public function new(Request $request): Response
    {
        $block = new Block();
        $form = $this->createForm(BlockType::class, $block);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $entityManager = $this->getDoctrine()->getManager();
            $entityManager->persist($block);
            $entityManager->flush();

            return $this->redirectToRoute('block_index');
        }

        return $this->render('block/new.html.twig', [
            'block' => $block,
            'form' => $form->createView(),
        ]);
    }

    /**
     * @Route("/{id}", name="block_show", methods={"GET"})
     */
    public function show(Block $block): Response
    {
        return $this->render('block/show.html.twig', [
            'block' => $block,
        ]);
    }

    /**
     * @Route("/{id}/edit", name="block_edit", methods={"GET","POST"})
     */
    public function edit(Request $request, Block $block): Response
    {
        $form = $this->createForm(BlockType::class, $block);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $this->getDoctrine()->getManager()->flush();

            return $this->redirectToRoute('block_index');
        }

        return $this->render('block/edit.html.twig', [
            'block' => $block,
            'form' => $form->createView(),
        ]);
    }

    /**
     * @Route("/{id}", name="block_delete", methods={"DELETE"})
     */
    public function delete(Request $request, Block $block): Response
    {
        if ($this->isCsrfTokenValid('delete'.$block->getId(), $request->request->get('_token'))) {
            $entityManager = $this->getDoctrine()->getManager();
            $entityManager->remove($block);
            $entityManager->flush();
        }

        return $this->redirectToRoute('block_index');
    }
}
