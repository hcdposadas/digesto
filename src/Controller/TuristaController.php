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
                    <h2 class="m-b-3">CÓDIGO DE NOCTURNIDAD / NIGHT CODE / CÓDIGO DE NOCTURNIDADE</h2>
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
	    <div>
		<p>
		  <i>
			Neste regulamento, você encontrará todas as disposições relacionadas às atividades que ocorrem durante a noite, desde regulamentações para espaços recreativos, comerciais ou gastronômicos até questões que visam garantir uma convivência adequada.
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
		    <p>
			<i>
			Você pode baixar o regulamento II - Nº 42  no seguinte link:
			</i>
		   </p>
                    <a href="/ver_ordenanza/90">
                        CÓDIGO DE NOCTURNIDAD / NIGHT CODE / CÓDIGO DE NOCTURNIDADE
                    </a>
                </div>
            </div>
            ';
            $video = '';
        } elseif ($id == '2') {
            $contenido = '
        <div class="row text-center">
            <div class="col-sm-12">
                <h2 class="m-b-3">POSADAS CIUDAD “LIBRE DE PIROTECNIA” / POSADAS WITHOUT PYROTECHNICS / POSADAS, CIDADE "LIVRE DE FOGOS DE ARTIFÍCIO"</h2>
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
	<div>
		<p>
			<i>
			Esta norma estabelece que na nossa cidade de Posadas, é proibido o uso e a comercialização de elementos pirotécnicos de alto impacto sonoro, os quais causam grande desconforto a pessoas com autismo, síndrome de Down, animais de estimação, entre outros.
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
	    <p>
		<i>
		Você pode baixar o regulamento II - Nº 81 no seguinte link:
		</i>
	   </p>
            <a href="/ver_ordenanza/1108">
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
                    <h2 class="m-b-3">ORDENANZA DE RUIDOS MOLESTOS / ANNOYING SOUNDS / NORMA DE RUÍDOS INDESEJADOS</h2>
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
	    <div>
		<p>
		 <i>
		  Esta norma estabelece todas as disposições pertinentes em relação aos níveis permitidos de som na cidade, com base nas atividades realizadas e no tipo de zona em que se encontram. É uma ordenança fundamental em nossa cidade que todos devem conhecer, principalmente aqueles que utilizam acomodações e/ou hostels em áreas residenciais.
		</i>
		</p>
	   <div>
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
		    <p>
			<i>
			Você pode baixar o regulamento VI - Nº 14 no seguinte link:
			</i>
		   </p>
                    <a href="/ver_ordenanza/314">
                        ORDENANZA RUIDOS MOLESTOS / ANNONING SOUNDS ISSUE / NORMA DE RUÍDOS INDESEJADOS
                    </a>
                </div>
            </div>
            ';
            $video = '';
        } elseif ($id == '4') {
            $contenido = '
            <div class="row text-center">
                <div class="col-sm-12">
                    <h2 class="m-b-3">SISTEMA DE ESTACIONAMIENTO MEDIDO / PARKING SYSTEM / SISTEMA DE ESTACIONAMENTO MEDIDO  </h2>
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
	<div>
		<p>
		  <i>
			Sistema Municipal de Estacionamento Ordenado. Normas Gerais. Estrutura Viária. Estacionamento medido. Franquias especiais. Espaços Reservados. Módulos de estacionamento exclusivos para pessoas com deficiência. Proibições e sanções. Autoridade de Aplicação. Nesta norma, você obterá informações sobre o sistema de trânsito municipal e seus benefícios para a ordem civil. Além disso, aprenderá sobre o uso do aplicativo para carregar créditos para o uso de vagas de estacionamento para o seu veículo.
		  </i>
		</p>
	</div>
            <div class="row text-center">
                <div class="col-sm-12"> 
                    <p>
                        Puede descargar la Ordenanza XVI – Nº 106 desde el siguiente link:
                    </p>
                    <p> 
                        <i>
                            You can download the Norm XVI – Nº 106  from the link below:
                        </i>
                    </p>
		    <p>
			<i>
			Você pode baixar o regulamento XVI - Nº 106 no seguinte link:
			</i>
		   </p>
                    <a href="/ver_ordenanza/1449">
                        SISTEMA DE ESTACIONAMIENTO / PARKING SYSTEM / SISTEMA DE ESTACIONAMENTO MEDIDO 
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
                    <h2 class="m-b-3">MARCO REGULATORIO DE CONVIVENCIA CIUDADANA / COEXISTENCE RULES / MARCO REGULATÓRIO DE CONVIVÊNCIA CIDADÃ  </h2>
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
		<div>
			<p>
			<i>
			Adota o Marco Regulatório de Normas de Convivência Cidadã e Via Pública. Esta norma garante métodos adequados para prevenir incidentes na via pública e evitar problemas entre vizinhos relacionados a questões de respeito, limpeza e ordem geral.
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
		   <p>
			<i>
			Você pode baixar o regulamento XI - Nº 56  no seguinte link:
			</i>
		  </p>
                    <a href="/ver_ordenanza/467">
                        MARCO REGULATORIO DE CONVIVENCIA / COEXISTENCE RULES / MARCO REGULATÓRIO DE CONVIVÊNCIA CIDADÃ 
                    </a>
                </div>
            </div>
            ';
            $video = '';
        } elseif ($id == '6') {
            $contenido = '
            <div class="row text-center">
                <div class="col-sm-12">
                    <h2 class="m-b-3">CUIDADO RESPONSABLE DE MASCOTAS / PET CARES AND OWNERS RESPONSABILITY / CUIDADO RESPONSÁVEL DE ANIMAIS DE ESTIMAÇÃO</h2>
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
	   <div>
		<p>
		  <i>
Adota o Marco Regulatório de Normas de Convivência Cidadã e Via Pública. Esta norma garante métodos adequados para prevenir incidentes na via pública e evitar problemas entre vizinhos relacionados a questões de respeito, limpeza e ordem geral.
		  </i>
		<p>
	 </div>
            <div class="row text-center">
                <div class="col-sm-12"> 
                    <p>
                        Puede descargar la Ordenanza X – Nº 17 desde el siguiente link:
                    </p>
                    <p> 
                        <i>
                            You can download the Norm X – Nº 17 from the link below:
                        </i>
                    </p>
		    <p>
			<i>
			Você pode baixar o regulamento X - Nº 17 no seguinte link:
			</i>
		   </p>
                    <a href="/ver_ordenanza/1291">
                    CUIDADOS RESPONSABLES MASCOTAS / PET CARES / CUIDADO RESPONSÁVEL DE ANIMAIS DE ESTIMAÇÃO
                    </a>
                </div>
            </div>

            ';
            $video = '';
        }elseif ($id == '7') {
            $contenido = '
            <div class="row text-center">
                <div class="col-sm-12">
                    <h2 class="m-b-3">ALCOHOL CERO / ALCOHOL ZERO TOLERANCE / ÁLCOOL ZERO</h2>
                    <img src="/build/images/alcohol.jpg" alt="alcohol" width="400" style="margin-bottom: 30px;">
                </div>
            </div>
            <div>
                <p>

		En el año 2016 nuestra Ciudad estableció la tolerancia cero de alcohol en sangre a todas aquellas personas que conducen un vehículo, de esta manera se han evitado un gran numero de accidentes y se creó conciencia acerca de los peligros de ingerir bebidas alcohólicas.
                </p>
            </div>
            <div>
                <p>
                    <i>In 2016, our City established zero tolerance for alcohol in the blood for all those who drive a vehicle, this norm makes safe streets for all people and other drivers.
                    </i>
                </p>
            </div>
	   <div>
		<p>
		<i>
			No ano de 2016, nossa cidade estabeleceu a tolerância zero de álcool no sangue para todas as pessoas que dirigem um veículo. Desta forma, evitaram-se muitos acidentes e conscientizou-se sobre os perigos do consumo de bebidas alcoólicas.
		</i>
		</p>
	  </div>
            <div class="row text-center">
                <div class="col-sm-12"> 
                    <p>
                        Puede descargar la Ordenanza XVI – Nº 58 desde el siguiente link:
                    </p>
                    <p> 
                        <i>
                            You can download the Norm XVI – Nº 58 from the link below:
                        </i>
                    </p>
		    <p>
			<i>
			Você pode baixar o regulamento XVI - Nº 58 no seguinte link:
			</i>
		   </p>
                    <a href="/ver_ordenanza/693">
                    ALCOHOL CERO / ALCOHOL ZERO TOLERANCE / ÁLCOOL ZERO</a>
                </div>
            </div>

            ';
            $video = '';
			 } elseif ($id == '8') {
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
