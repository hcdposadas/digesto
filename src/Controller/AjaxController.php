<?php

namespace App\Controller;

use App\Entity\BoletinOficialMunicipal;
use App\Entity\Descriptor;
use App\Entity\Identificador;
use App\Entity\Norma;
use App\Entity\PalabraClave;
use App\Entity\Tema;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Routing\Annotation\Route;

/**
 * @Route("/ajax")
 */
class AjaxController extends AbstractController
{
    /**
     * @Route("/get_descriptores", name="get_descriptores", methods={"GET"})
     */
    public function getADescriptores(Request $request)
    {

        $value = strtoupper($request->get('q'));

        $em = $this->getDoctrine();

        $entities = $em->getRepository(Descriptor::class)->getByLike($value);

        $json = array();

        if (!count($entities)) {
            $json[] = array(
                'label' => 'No se encontraron coincidencias',
                'value' => ''
            );
        } else {

            foreach ($entities as $entity) {
                $json[] = array(
                    'id' => $entity['id'],
                    //'label' => $entity[$property],
                    'text' => $entity['nombre']
                );
            }
        }

        return new JsonResponse($json);

    }

    /**
     * @Route("/get_identificadores", name="get_identificadores", methods={"GET"})
     */
    public function getAIdentificadores(Request $request)
    {

        $value = strtoupper($request->get('q'));

        $em = $this->getDoctrine();

        $entities = $em->getRepository(Identificador::class)->getByLike($value);

        $json = array();

        if (!count($entities)) {
            $json[] = array(
                'label' => 'No se encontraron coincidencias',
                'value' => ''
            );
        } else {

            foreach ($entities as $entity) {
                $json[] = array(
                    'id' => $entity['id'],
                    //'label' => $entity[$property],
                    'text' => $entity['nombre']
                );
            }
        }

        return new JsonResponse($json);

    }

    /**
     * @Route("/get_palabras_clave", name="get_palabras_clave", methods={"GET"})
     */
    public function getAPalabrasClave(Request $request)
    {

        $value = strtoupper($request->get('q'));

        $em = $this->getDoctrine();

        $entities = $em->getRepository(PalabraClave::class)->getByLike($value);

        $json = array();

        if (!count($entities)) {
            $json[] = array(
                'label' => 'No se encontraron coincidencias',
                'value' => ''
            );
        } else {

            foreach ($entities as $entity) {
                $json[] = array(
                    'id' => $entity['id'],
                    //'label' => $entity[$property],
                    'text' => $entity['nombre']
                );
            }
        }

        return new JsonResponse($json);

    }

    /**
     * @Route("/get_temas", name="get_temas", methods={"GET"})
     */
    public function getATemas(Request $request)
    {

        $value = strtoupper($request->get('q'));

        $em = $this->getDoctrine();

        $entities = $em->getRepository(Tema::class)->getByLike($value);

        $json = array();

        if (!count($entities)) {
            $json[] = array(
                'label' => 'No se encontraron coincidencias',
                'value' => ''
            );
        } else {

            foreach ($entities as $entity) {
                $text = [];
                $e = $entity;
                while ($e) {
                    $text[] = $e->getTitulo();
                    $e = $e->getTemaPadre();
                }
                $json[] = array(
                    'id' => $entity->getId(),
                    'text' => implode(' / ', array_reverse($text))
                );
            }
        }

        return new JsonResponse($json);

    }

    /**
     * @Route("/get_normas", name="get_normas", methods={"GET"})
     */
    public function getANormas(Request $request)
    {
        $texto = strtolower($request->get('q'));
        $normas = $this->getDoctrine()->getRepository(Norma::class)->getByLike($texto);

        $json = array();
        if (!count($normas)) {
            $json[] = array(
                'label' => 'No se encontraron coincidencias',
                'value' => ''
            );
        } else {
            /** @var Norma $norma */
            foreach ($normas as $norma) {
                $json[] = array(
                    'id' => $norma->getId(),
                    'text' => $norma->getRama()->getTitulo().' '. $norma->__toString()
                );
            }
        }

        return new JsonResponse($json);
    }

    /**
     * @Route("/get_boletines", name="get_boletines", methods={"GET"})
     */
    public function getABoletines(Request $request)
    {
        $numero = strtolower($request->get('q'));
        $boletines = $this->getDoctrine()->getRepository(BoletinOficialMunicipal::class)->getByLike($numero);

        $json = array();
        if (!count($boletines)) {
            $json[] = array(
                'label' => 'No se encontraron coincidencias',
                'value' => ''
            );
        } else {
            /** @var BoletinOficialMunicipal $boletin */
            foreach ($boletines as $boletin) {
                $json[] = array(
                    'id' => $boletin->getId(),
                    'text' => $boletin->getNumero().' (Publicado el '. $boletin->getFechaPublicacion()->format('d/m/Y').')'
                );
            }
        }

        return new JsonResponse($json);
    }
}
