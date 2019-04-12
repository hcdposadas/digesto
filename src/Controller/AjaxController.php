<?php

namespace App\Controller;

use App\Entity\Descriptor;
use App\Entity\Identificador;
use App\Entity\PalabraClave;
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
}
