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
        $aniosBoletines  = $this->getDoctrine()->getRepository(BoletinOficialMunicipal::class)->getAniosBoletines();
        $consolidaciones = $this->getDoctrine()->getRepository(Consolidacion::class)->getConsolidacionesOrdenadas();
        $web             = $this->getDoctrine()->getRepository(WebDigestoTexto::class)->findOneBySlug('web');

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
        $aniosBoletines  = $this->getDoctrine()->getRepository(BoletinOficialMunicipal::class)->getAniosBoletines();
        $consolidaciones = $this->getDoctrine()->getRepository(Consolidacion::class)->getConsolidacionesOrdenadas();
        $web             = $this->getDoctrine()->getRepository(WebDigestoTexto::class)->findOneBySlug('web');

        if ($id == '1') {
            $contenido = '
            <div class="row text-center">
                <div class="col-sm-12" >
                    <h2 class="m-b-3">CÓDIGO DE NOCTURNIDAD / NIGHT CODE</h2>
                    <img src="/build/images/noche.jpg" alt="noche" width="400" style="margin-bottom: 30px;" >
                    <br>
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
                    <a href="/uploads/textos_definitivos_normas/II%20-%20Nº%2042%20(1).pdf">
                        CÓDIGO DE NOCTURNIDAD / NIGHT CODE
                    </a>
                </div>
            </div>
            ';
            $video = '';
        } elseif ($id == '2') {
            $contenido = '
        <div class="row text-center">
            <div class="col-sm-12">
                <h2 class="m-b-3">POSADAS CIUDAD “LIBRE DE PIROTECNIA” / POSADAS WITHOUT PYROTECHNICS</h2>
                <img src="/build/images/pirotecnia.jpg" alt="pirotecnia" width="400" style="margin-bottom: 30px;">
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
            <a href="/texto-sin-consolidar/1108">
                PIROTECNIA CERO / NO PYROTECHNIC ALLOWED
            </a>
        </div>
    </div>

            ';
            $video = '';
        } elseif ($id == '3') {
            $contenido = '
            <div class="row text-center">
                <div class="col-sm-12">
                    <h2 class="m-b-3">ORDENANZA DE RUIDOS MOLESTOS / ANNOYING SOUNDS</h2>
                    <img src="/build/images/ruidos.jpg" alt="ruidos" width="400" style="margin-bottom: 30px;">
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
                    <a href="/uploads/textos_definitivos_normas/ORDENANZA%20VI%20-%20Nº%2014%20.pdf">
                        ORDENANZA RUIDOS MOLESTOS / ANNONING SOUNDS ISSUE
                    </a>
                </div>
            </div>
            ';
            $video = '';
        } elseif ($id == '4') {
            $contenido = '
            <div class="row text-center">
                <div class="col-sm-12">
                    <h2 class="m-b-3">SISTEMA DE ESTACIONAMIENTO MEDIDO / PARKING SYSTEM</h2>
                    <img src="/build/images/transito.webp" alt="transito" width="400" style="margin-bottom: 30px;">
                </div>
            </div>
            <div>
                <p>
                    Sistema de Estacionamiento Ordenado Municipal. Normas Generales. Estructura Vial. Estacionamiento medido. Franquicias especiales. Espacios Reservados. Módulos de estacionamiento exclusivo para discapacitados. Prohibiciones y sanciones. Autoridad de Aplicación. En esta norma conocerás sobre el sistema de tránsito municipal, y sus beneficios en el orden civil.
                    Además, aprenderá sobre el uso de la aplicación para cargar créditos por el uso de los lugares para garaje de su vehículo
                </p>
            </div>
            <div>
                <p>
                    <i>
                    Municipal Ordered Parking System. General Rules. Road structure. Metered parking. Special franchises. Reserved Spaces. Exclusive parking modules for the disabled. Prohibitions and sanctions. Enforcement Authority. In this norm you will know about the municipal traffic system, and its benefits in the civilian order.
                    Also, you will learn about the use of the app to charge credits for the use of the places to garage you vehicle.
                    </i>
                </p>
            </div>
            <div class="row text-center">
                <div class="col-sm-12"> 
                    <p>
                        Puede descargar la Ordenanza XVI – Nº 47 desde el siguiente link:
                    </p>
                    <p> 
                        <i>
                            You can download the Norm XVI – Nº 47 from the link below:
                        </i>
                    </p>
                    <a href="/uploads/textos_definitivos_normas/ORDENANZA%20XVI%20-%20Nº%2047%20(2).pdf">
                        SISTEMA DE ESTACIONAMIENTO / PARKING SYSTEM
                    </a>
                    <br>
                    <a href="https://play.google.com/store/apps/details?id=ar.edu.unlp.semmobile.posadas&hl=es_419&gl=US&pli=1">
                        APP SISTEMA ESTACIONAMIENTO MEDIDO / APP PARKING SYSTEM (ANDROID)
                    </a>
                    <br>
                    <a href="https://apps.apple.com/ar/app/sem-mobile/id1387705895">
                    APP SISTEMA ESTACIONAMIENTO MEDIDO / APP PARKING SYSTEM (iOS)
                    </a>
                </div>
            </div>
            ';
            $video = '';
        } elseif ($id == '5') {
            $contenido = '
            <div class="row text-center">
                <div class="col-sm-12">
                    <h2 class="m-b-3">MARCO REGULATORIO DE CONVIVENCIA CIUDADANA / COEXISTENCE RULES</h2>
                    <img src="/build/images/convivencia.jpg" alt="transito" width="400" style="margin-bottom: 30px;">
                </div>
            </div>
            <div>
                <p>
                    Adopta Marco Regulador de Normas de Convivencia Ciudadana y Vía Pública.
                    Esta norma garantiza los métodos correctos para prevenir incidentes en la vía pública, y evitar problemas entre vecinos por cuestiones de respeto, limpieza y orden general.
                </p>
            </div>
            <div>
                <p>
                    <i>
                        This standard guarantees the correct methods to prevent incidents on public roads, and avoid problems between neighbors for reasons of respect, cleanliness and general order.
                    </i>
                </p>
            </div>
            <div class="row text-center">
                <div class="col-sm-12"> 
                    <p>
                        Puede descargar la Ordenanza XI – Nº 56 desde el siguiente link:
                    </p>
                    <p> 
                        <i>
                            You can download the Norm XI – Nº 56 from the link below:
                        </i>
                    </p>
                    <a href="/uploads/textos_definitivos_normas/IX-56.pdf">
                        MARCO REGULATORIO DE CONVIVENCIA / COEXISTENCE RULES
                    </a>
                </div>
            </div>
            ';
            $video = '';
        } elseif ($id == '6') {
            $contenido = '
            <div class="row text-center">
                <div class="col-sm-12">
                    <h2 class="m-b-3">CUIDADO RESPONSABLE DE MASCOTAS / PET CARES AND OWNERS RESPONSABILITY</h2>
                    <img src="/build/images/imusa.jpg" alt="masCOTGA" width="400" style="margin-bottom: 30px;">
                </div>
            </div>
            <div>
                <p>
                    Establece como Política de Gobierno las acciones tendientes a la protección de la fauna urbana en la Ciudad de Posadas. Las Autoridades Municipales serán agentes de control del cuidado responsable, facilitando con sus acciones el cuidado sanitario de los animales y de los ciudadanos. Registro Municipal de Asociaciones Protectoras de la Vida Animal y Registro Único y Público de Infractores. Creación. Prohibiciones.
                </p>
            </div>
            <div>
                <p>
                    <i>
                        Establishes as Government Policy the actions tending to the protection of urban fauna in the City of Posadas. The Municipal Authorities will be responsible care control agents, facilitating with their actions the health care of animals and citizens. Municipal Registry of Associations for the Protection of Animal Life and the Single and Public Registry of Offenders. Creation. prohibitions.
                    </i>
                </p>
            </div>
            <div class="row text-center">
                <div class="col-sm-12"> 
                    <p>
                        Puede descargar la Ordenanza X – Nº 11 desde el siguiente link:
                    </p>
                    <p> 
                        <i>
                            You can download the Norm X – Nº 11 from the link below:
                        </i>
                    </p>
                    <a href="/uploads/textos_definitivos_normas/ORDENANZA%20X%20N°%2011%20(1).pdf">
                    CUIDADOS RESPONSABLES MASCOTAS / PET CARES
                    </a>
                </div>
            </div>

            ';
            $video = '';
        } elseif ($id == '7') {
                        $contenido = '
            <div class="row text-center">
                <div class="col-sm-12">
                    <h2 class="m-b-3">HABILITACION PARA EL PERNOCTE DE CASAS RODANTES / AUTHORIZATION FOR OVERNIGHT STAYS FOR MOTORHOMES / AUTORIZAÇÃO PARA PERNOITE DE MOTORHOMES</h2>
                    <img src="/build/images/motorhome.jpg" alt="motorhome" width="400" style="margin-bottom: 30px;">
                </div>
            </div>
            <div>
                <p>
Establece que el único lugar público habilitado para pasar la noche con motorhomes, casas rodantes y vehículos similares en la ciudad es el Camping Municipal Costa Sur, se establece las tarifas para la ocupación y pernocte según categoría y multas por incumplimiento e irregularidades. </p>
            </div>
            <div>
                <p>
                    <i>
Establishes that the only public place authorized for overnight stays with motorhomes, mobile homes, and similar vehicles in the city is the Costa Sur Municipal Campground. Occupancy and overnight stay rates are set according to category, and fines are imposed for noncompliance and irregularities.</i>
                </p>
            </div>
                        <div>
                <p>
                    <i> 
Estabelece que o único local público autorizado para pernoite de motorhomes, casas móveis e veículos similares na cidade é o Camping Municipal Costa Sur. As taxas de ocupação e pernoite são definidas de acordo com a categoria, e multas são aplicadas em caso de descumprimento e irregularidades.
                    </i>
                </p>
            </div>
            <div class="row text-center">
                <div class="col-sm-12"> 
                    <p>Puede descargar la Ordenanza XVIII – Nº 303 desde el siguiente link:</p>
                    <p> 
                        <i>
                            You can download the Norm XVIII – Nº 303 from the link below:
                        </i>
                    </p>
                    <p> 
                        <i>
                            Você pode baixar o regulamento XVIII - Nº 303 no seguinte link:
                        </i>
                    </p>
                    <a href="/ver_ordenanza/1546">
                    HABILITACION PARA EL PERNOCTE DE CASAS RODANTES / AUTHORIZATION FOR OVERNIGHT STAYS FOR MOTORHOMES / AUTORIZAÇÃO PARA PERNOITE DE MOTORHOMES
                    </a>
                </div>
            </div>

            ';


        }
        return $this->render('turista/show.html.twig', [
            'contenido'       => $contenido,
            'video'           => $video,
            'web'             => $web,
            'anios_boletines' => $aniosBoletines,
            'consolidaciones' => $consolidaciones
        ]);
    }
}
