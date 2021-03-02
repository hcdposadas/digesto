<?php

namespace App\Controller;

use App\Entity\Tema;
use App\Form\TemaType;
use App\Repository\RamaRepository;
use App\Repository\TemaRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

/**
 * @Route("/temas")
 */
class TemasController extends AbstractController
{
    /**
     * @Route("/", name="temas_index", methods={"GET"})
     */
    public function index(Request $request, TemaRepository $temaRepository, RamaRepository $ramaRepository): Response
    {

        $rama = $request->query->get('rama') ? $ramaRepository->find($request->query->get('rama')) : null;
        $tema = $request->query->get('tema') ? $temaRepository->find($request->query->get('tema')) : null;
        $temas = null;
        if ($tema) {
            $temas = $tema->getTemas();
        } elseif ($rama) {
            $temas = $temaRepository->findBy(array('rama' => $rama, 'temaPadre' => null));
        } else {
            $temas = $temaRepository->findBy(array('temaPadre' => null));
        }

        $ramas = $ramaRepository->findAll();

        return $this->render('temas/index.html.twig', [
            'rama' => $rama,
            'tema' => $tema,
            'temas' => $temas,
            'ramas' => $ramas,
        ]);
    }

    /**
     * @Route("/new", name="temas_new", methods={"GET","POST"})
     */
    public function new(Request $request, RamaRepository $ramaRepository, TemaRepository $temaRepository): Response
    {
        $rama = $request->query->get('rama') ? $ramaRepository->find($request->query->get('rama')) : null;
        $temaPadre = $request->query->get('tema') ? $temaRepository->find($request->query->get('tema')) : null;


        $tema = new Tema();
        $tema->setRama($rama);
        $tema->setTemaPadre($temaPadre);
        $form = $this->createForm(TemaType::class, $tema);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $entityManager = $this->getDoctrine()->getManager();
            $entityManager->persist($tema);
            $entityManager->flush();

            return $this->redirectToRoute('temas_index', array(
                'rama' => $rama->getId(),
                'tema' => $temaPadre ? $temaPadre->getId() : null,
            ));
        }

        return $this->render('temas/new.html.twig', [
            'tema' => $tema,
            'rama' => $rama,
            'temaPadre' => $temaPadre,
            'form' => $form->createView(),
        ]);
    }

    /**
     * @Route("/{id}", name="temas_show", methods={"GET"})
     */
    public function show(Tema $tema): Response
    {
        return $this->render('temas/show.html.twig', [
            'tema' => $tema,
        ]);
    }

    /**
     * @Route("/{id}/edit", name="temas_edit", methods={"GET","POST"})
     */
    public function edit(Request $request, Tema $tema): Response
    {
        $rama = $tema->getRama();
        $temaPadre = $tema->getTemaPadre();

        $form = $this->createForm(TemaType::class, $tema);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $this->getDoctrine()->getManager()->flush();

            return $this->redirectToRoute('temas_index', array(
                'rama' => $rama->getId(),
                'tema' => $temaPadre ? $temaPadre->getId() : null,
            ));
        }

        return $this->render('temas/edit.html.twig', [
            'tema' => $tema,
            'temaPadre' => $temaPadre,
            'rama' => $rama,
            'form' => $form->createView(),
        ]);
    }

    /**
     * @Route("/{id}", name="temas_delete", methods={"DELETE"})
     */
    public function delete(Request $request, Tema $tema): Response
    {
        if ($this->isCsrfTokenValid('delete'.$tema->getId(), $request->request->get('_token'))) {
            $entityManager = $this->getDoctrine()->getManager();
            $entityManager->remove($tema);
            $entityManager->flush();
        }

        return $this->redirectToRoute('temas_index');
    }
}
