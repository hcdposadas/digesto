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
            $contenido='
            <div class="row text-center">
                <div class="col-sm-12">
                    <h2 class="m-b-3">CÓDIGO DE NOCTURNIDAD / NIGHT CODE</h2>
                </div>
            </div>
            <div>
                <p>
                    En esta Ordenanza, Ud encontrará todas las disposiciones en función a las actividades que tengan lugar en la noche, desde regulaciones conforme a espacios recreativos, comerciales o gastronómicos hasta cuestiones que garanticen una correcta convivencia.
                </p>
            </div>
            <div>
                <p>
                    <i>
                    In this Ordinance, you will find all the provisions depending on the activities that take place at night, from regulations according to recreational, commercial or gastronomic places to that guarantee a correct coexistence in our city.
                    </i>
                </p>
            </div>
            <div class="row text-center">
                <div class="col-sm-12"> 
                    <p>
                        Puede descargar la Ordenanza II – Nº 42 desde el siguiente link:
                    </p>
                    <p> 
                        <i>
                            You can download the Norm II – Nº 42 from the link below:
                        </i>
                    </p>
                    <a>
                        CÓDIGO DE NOCTURNIDAD / NIGHT CODE
                    </a>
                </div>
            </div>
            ';
            $video='';
        }elseif($id=='2'){
            $contenido='
        <div class="row text-center">
            <div class="col-sm-12">
                <h2 class="m-b-3">POSADAS CIUDAD “LIBRE DE PIROTECNIA” / POSADAS WITHOUT PYROTECHNICS</h2>
            </div>
        </div>
        <div>
        <p>
            Esta norma establece que en nuestra Ciudad de Posadas se encuentra prohibido el uso y la comercialización de elementos pirotécnicos de alto impacto sonoro, los cuales representan un gran malestar a personas con Autismo, Síndrome de Down, Mascotas, entre otros.
        </p>
    </div>
    <div>
        <p>
            <i>
                This norm establishes that in our City the use and commercialization of pyrotechnic elements with high sound impact is prohibited, that elements represent a great discomfort to people with Autism, Down Syndrome, and Pets.
            </i>
        </p>
    </div>
    <div class="row text-center">
        <div class="col-sm-12"> 
            <p>
                Puede descargar la Ordenanza II – Nº 81 desde el siguiente link:
            </p>
            <p> 
                <i>
                    You can download the Norm II – Nº 81 from the link below:
                </i>
            </p>
            <a>
                PIROTECNIA CERO / NO PYROTECHNIC ALLOWED
            </a>
        </div>
    </div>

            ';
            $video='2';
        }elseif($id=='3'){
            $contenido='
            <div class="row text-center">
                <div class="col-sm-12">
                    <h2 class="m-b-3">ORDENANZA DE RUIDOS MOLESTOS / ANNOYING SOUNDS</h2>
                </div>
            </div>
            <div>
                <p>
                    Esta norma establece todas las disposiciones pertinentes con respecto a los niveles permitidos de sonido en la ciudad, en función a las actividades que se lleven a cabo y en tipo de zona en la que se encuentre. Es una ordenanza elemental de nuestra ciudad que todos deben conocer, principalmente quienes hacen uso de hospedajes y/o hostels en zonas residenciales.
                </p>
            </div>
            <div>
                <p>
                    <i>
                        This norm establishes all the pertinent provisions regarding the permitted sound levels in the city, depending on the activities that are carried out and the type of area in which it is located. It is an elementary ordinance of our city that everyone should know, especially those who use lodgings and/or hostels in residential areas.
                    </i>
                </p>
            </div>
            <div class="row text-center">
                <div class="col-sm-12"> 
                    <p>
                        Puede descargar la Ordenanza VI – Nº 14 desde el siguiente link:
                    </p>
                    <p> 
                        <i>
                            You can download the Norm VI – Nº 14 from the link below:
                        </i>
                    </p>
                    <a>
                        ORDENANZA RUIDOS MOLESTOS / ANNONING SOUNDS ISSUE
                    </a>
                </div>
            </div>
            ';
            $video='3';
        }elseif($id=='4'){
            $contenido='SISTEMA DE ESTACIONAMIENTO MEDIDO / PARKING SYSTEM
            Sistema de Estacionamiento Ordenado Municipal. Normas Generales. Estructura Vial. Estacionamiento medido. Franquicias especiales. Espacios Reservados. Módulos de estacionamiento exclusivo para discapacitados. Prohibiciones y sanciones. Autoridad de Aplicación. En esta norma conocerás sobre el sistema de tránsito municipal, y sus beneficios en el orden civil.
            Además, aprenderá sobre el uso de la aplicación para cargar créditos por el uso de los lugares para garaje de su vehículo
            Municipal Ordered Parking System. General Rules. Road structure. Metered parking. Special franchises. Reserved Spaces. Exclusive parking modules for the disabled. Prohibitions and sanctions. Enforcement Authority. In this norm you will know about the municipal traffic system, and its benefits in the civilian order.
            Also, you will learn about the use of the app to charge credits for the use of the places to garage you vehicle.
            Puede descargar la Ordenanza XVI – Nº 47 y la Aplicación desde los siguientes links:
            You can download the Norm XVI – Nº 14 and its App from the links below:
            SISTEMA DE ESTACIONAMIENTO / PARKING SYSTEM
            APP SISTEMA ESTACIONAMIENTO MEDIDO / APP PARKING SYSTEM
             
            ';
            $video='4';
        }elseif($id=='5'){
            $contenido='MARCO REGULATORIO DE CONVIVENCIA CIUDADANA / COEXISTENCE RULES
            Adopta Marco Regulador de Normas de Convivencia Ciudadana y Vía Pública.
            Esta norma garantiza los métodos correctos para prevenir incidentes en la vía pública, y evitar problemas entre vecinos por cuestiones de respeto, limpieza y orden general.
            This standard guarantees the correct methods to prevent incidents on public roads, and avoid problems between neighbors for reasons of respect, cleanliness and general order.
            Puede descargar la Ordenanza XI – Nº 56 desde el siguiente link:
            You can download the Norm XI – Nº 56 from the link below:
            MARCO REGULATORIO DE CONVIVENCIA / COEXISTENCE RULES
            
            ';
            $video='4';
        }elseif($id=='6'){
            $contenido='
            CUIDADO RESPONSABLE DE MASCOTAS / PET CARES AND OWNERS RESPONSABILITY
            Establece como Política de Gobierno las acciones tendientes a la protección de la fauna urbana en la Ciudad de Posadas. Las Autoridades Municipales serán agentes de control del cuidado responsable, facilitando con sus acciones el cuidado sanitario de los animales y de los ciudadanos. Registro Municipal de Asociaciones Protectoras de la Vida Animal y Registro Único y Público de Infractores. Creación. Prohibiciones.
            Establishes as Government Policy the actions tending to the protection of urban fauna in the City of Posadas. The Municipal Authorities will be responsible care control agents, facilitating with their actions the health care of animals and citizens. Municipal Registry of Associations for the Protection of Animal Life and the Single and Public Registry of Offenders. Creation. prohibitions.
            Puede descargar la Ordenanza X – Nº 11 desde el siguiente link:
            You can download the Norm X – Nº 11 from the link below:
            CUIDADOS RESPONSABLES MASCOTAS / PET CARES
            ';
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
