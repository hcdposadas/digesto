<?php

namespace App\Controller;

use App\Entity\Consolidacion;
use App\Entity\WebDigestoTexto;
use App\Entity\BoletinOficialMunicipal;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;

class TuristaController extends AbstractController
{
    /**
     * @Route("/turista", name="turista")
     */
    public function index()
    {
        $aniosBoletines  = $this->getDoctrine()->getRepository( BoletinOficialMunicipal::class )->getAniosBoletines();
		$consolidaciones = $this->getDoctrine()->getRepository( Consolidacion::class )->getConsolidacionesOrdenadas();
		$web             = $this->getDoctrine()->getRepository( WebDigestoTexto::class )->findOneBySlug( 'web' );
        
        return $this->render('turista/index.html.twig', [
            'web'             => $web,
		'anios_boletines' => $aniosBoletines,
		'consolidaciones' => $consolidaciones
        ]);
    }

     /**
     * @Route("/turista/{id}", name="turistaVer", methods={"GET"})
     */
    public function ver($id)
    {
        $aniosBoletines  = $this->getDoctrine()->getRepository( BoletinOficialMunicipal::class )->getAniosBoletines();
		$consolidaciones = $this->getDoctrine()->getRepository( Consolidacion::class )->getConsolidacionesOrdenadas();
		$web             = $this->getDoctrine()->getRepository( WebDigestoTexto::class )->findOneBySlug( 'web' );
        
        if($id=='1'){
            $contenido='1';
            $video='https://www.youtube.com/embed/tgbNymZ7vqY';
        }elseif($id=='2'){
            $contenido='2';
            $video='2';
        }elseif($id=='3'){
            $contenido='3';
            $video='3';
        }elseif($id=='4'){
            $contenido='4';
            $video='4';
        }
        return $this->render('turista/show.html.twig', [
        'contenido'       =>$contenido,
        'video'           =>$video,
        'web'             => $web,
		'anios_boletines' => $aniosBoletines,
		'consolidaciones' => $consolidaciones
        ]);
    }
}
