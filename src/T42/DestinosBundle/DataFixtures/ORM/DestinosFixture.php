<?php

namespace T42\DataFixtures\ORM;

use Doctrine\Common\DataFixtures\FixtureInterface;
use Doctrine\Common\Persistence\ObjectManager;
use T42\DestinosBundle\Entity\Paquete;
use T42\DestinosBundle\Entity\Ciudad;
use T42\DestinosBundle\Entity\Pais;
use T42\DestinosBundle\Entity\Tarifa;

/**
 * T42\DataFixtures\ORM\DestinosFixture
 * 
 * Clase fixture de carga de destinos de prueba.
 *
 * @author Cristian Tosco <ctosco@tres42.com.ar>
 */
class DestinosFixture implements FixtureInterface
{
    public function load(ObjectManager $manager)
    {
        $paisGrecia = new Pais();
        $paisGrecia->setNombre('Grecia');
        
        $paisArgentina = new Pais();
        $paisArgentina->setNombre('Argentina');
        
        $paisBrasil = new Pais();
        $paisBrasil->setNombre('Brasil');

        $paisItalia = new Pais();
        $paisItalia->setNombre('Italia');
        
        $paisEspaña = new Pais();
        $paisEspaña->setNombre('España');

        $paisTurquia = new Pais();
        $paisTurquia->setNombre('Turquia');
        
        $ciudadAtenas = new Ciudad();
        $ciudadAtenas->setNombre('Atenas');
        $ciudadAtenas->setProvincia('Atenas');
        $ciudadAtenas->setPais($paisGrecia);
        
        $ciudadRioCuarto = new Ciudad();
        $ciudadRioCuarto->setNombre('Rio Cuarto');
        $ciudadRioCuarto->setPais($paisArgentina);
        $ciudadRioCuarto->setProvincia('Cordoba');
        
        $ciudadCordoba = new Ciudad();
        $ciudadCordoba->setNombre('Cordoba');
        $ciudadCordoba->setPais($paisArgentina);
        $ciudadCordoba->setProvincia('Cordoba');
        
        $ciudadEstambul = new Ciudad();
        $ciudadEstambul->setNombre('Estambul');
        $ciudadEstambul->setPais($paisTurquia);
        $ciudadEstambul->setProvincia('Estambul');
        
        $tarifa1 = new Tarifa();
        $tarifa1->identificador = 1;
        $tarifa1->concepto = 'SINGLE';
        $tarifa1->monto = 7990;

        $tarifa2 = new Tarifa();
        $tarifa2->identificador = 2;
        $tarifa2->concepto = 'DOUBLE';
        $tarifa1->monto = 6635;
        
        $tarifa3 = new Tarifa();
        $tarifa3->identificador = 3;
        $tarifa3->concepto = 'TRIPLE';
        $tarifa3->monto = 6285;
        
        $paquete1 = new Paquete();
        $paquete1->addCiudad($ciudadAtenas);
        $paquete1->addCiudad($ciudadEstambul);
        
        //$paquete1->addTarifa($tarifa1);
        //$paquete1->addTarifa($tarifa2);
        //$paquete1->addTarifa($tarifa3);

        $paquete1->setTitulo('GRECIA TURQUÍA Y EGIPTO 2012 (Secretos de Medio Oriente');
        
        $paquete1->setCategoria('Europa');
        
        $paquete1->setEsGrupal(true);
        
        $paquete1->setEsPromocion(true);
        
        $fechaSalida = new \DateTime();
        $fechaSalida->setDate(2012, 09, 14);
        
        $paquete1->setFechaSalida($fechaSalida);
        
        $paquete1->setItinerario(' DIA 1: RIO CUARTO - CORDOBA – ESTAMBUL.
	 
 DIA 2: ESTAMBUL (MEDIA PENSION):
	
Llegada, recepción en el aeropuerto y traslado al Hotel designado. Tarde libre. Cena.

	 
DIA 3: ESTAMBUL
	 
Desayuno. Por la mañana, visita de esta ciudad situada entre dos continentes: Europa y Asia. Visitaremos El Palacio de Santa Sofía, que contiene uno de los más ricos museos del mundo (En los dias que Santa Sofía esté cerrada se sustituye por la visita de la Cisterna de Yerebatan); la Mezquita Azul, revestida interiormente con azulejos de Inzik y la única con seis minaretes, el hipódromo romano, etc. Tarde libre para efectuar compras en el Gran Bazar, centro comercial de la ciudad con más de 4.000 tiendas, donde algunos almacenes famosos ofrecen a los buenos conocedores tapices turcos, persas, caucásicos, etc. Su precio está en función de su calidad y de su tamaño. Los más pequeños son los tapices que se usan para la oración. Cena y alojamiento.

DIA 4: ESTAMBUL (PENSION COMPLETA):
	 
Excursión de medio día crucero por el Bosforo. Almuerzo incluido. Por la tarde visita opcional al Palacio de Topkapi. Cena.

DIA 5: ESTAMBUL – ANKARA – CAPADOCIA (MEDIA PENSION):
	 
Desayuno. Traslado al aeropuerto para tomar el avión a Ankara o Kayseri. Llegada y salida en autobús hacia Capadocia. Llegada a Capadocia, fascinante región de paisajes lunares formada durante siglos sobre la gruesa y blanda capa de l avas esculpidas por los dos volcanes cercanos. Una de las curiosidades de Capadocia son las ciudades subterráneas. Los antiguos pueblos de la zona para defenderse de los ataques de los enemigos construyeron túneles, habitaciones, cocinas, iglesias bajo la tierra. Cena y alojamiento en el hotel.

DIA 6: CAPADOCIA (MEDIA PENSION):
	 
Desayuno. Excursión de día completo al Valle de Göreme. Este es un increíble complejo monástico bizantino integrado por iglesias excavadas en la roca con bellísimos frescos. Continuación hacia los pueblecitos trogloditas de Zelve, Uçhisar, la Fortaleza natural, Ortahisar, las Chimeneas de Hadas de Ürgüp y un pueblo de alfareros. Después visita a la ciudad subterránea de Ozkonak, que cuenta con depósitos de cereales y pozos de ventilación y que fue utilizada como refugio por los cristianos de la época. Cena y alojamiento.

DIA 7: CAPADOCIA – KONYA – PAMUKKALE (PENSION COMPLETA)

Desayuno. Continuación a Konya para visitar el monasterio de los Derviches danzantes fundado por Mevlana. Almuerzo, continuación Pamukkale y visita a la antigua Hierápolis y del castillo de Algodón, maravilla natural de gigantescas cascadas blancas, estalactitas y piscinas naturales formadas a lo largo de los siglos por el paso de las aguas cargadas de sales calcáreas procedentes de fuentes termales. Cena y alojamiento.

DIA 8:  PAMUKKALE – KUSADASI (PENSION COMPLETA)

Desayuno, salida hacia Efeso, la ciudad antigua mejor conservada de Asia Menor durante los siglos I y II tuvo una población de 250.000 habitantes, monopolizó la riqueza de Medio Oriente. Visitaremos el templo Adriano, los Baños Romanos, la Biblioteca, el Odeon, el Teatro, etc.. Almuerzo. Visitaremos la Casa de la Virgen María, supuesta última morada de la Madre de Jesús. Cena y alojamiento.

DIA 9: KUSADASI – PATMOS (PENSION COMPLETA):

Desayuno. Traslado al puerto para el embarque. Almuerzo a bordo. Llegada a Patmos. Desembarque y tiempo libre para visita la isla donde San Juan Evangelista escribió el Apocalipsis durante su exilio de Roma. Cena y alojamiento a bordo.

DIA 10: CRETA – HERAKLION – SANTORINI (PENSION COMPLETA):

Desayuno. Llegada a Heraklion (Creta). Dsembarque. Tiempo libre para visitar esta legendaria isla. Embarque y salida hacía la isla de Santorini. Llegada, desembarque y tiempo libre. Por la noche salida hacía el puerto de Pireo, Régimen de pensión completo.

DIA 11: PIREO – ATENAS (MEDIA PENSION)

Desayuno. Llegada del barco al puerto de Pireo. Traslado al hotel. Día libre para conocer el impresionante pasado artístico de esta ciudad, pasear, recorrer el animado barrio de Plaka o hacer alguna compra artesanal. Posibilidad de realizar alguna excursión opcional a Delfos, Argolida, o cenar en una de sus famosas tabernas Alojamiento.

DIA 12: ATENAS (MEDIA PENSION):
	 
Desayuno. Por la mañana, visita de la ciudad. El recorrido nos llevará a la Plaza de la Constitución, el Parlamento, la Biblioteca Nacional, la Universidad y la Academia. Al pasar por la calle Herodou Atticus podemos ver el ex Palacio Real, custodiado por los pintorescos Evzones. Siguiendo nuestro itinerario en dirección al ACROPOLIS, podrán ver el famoso Estadio Olímpico, el Templo de Zeus, el cual visitaremos, y el Arco de Adriano. En la Acrópolis se visitará las obras del tiempo de Pericles, los Propileos, el Templo de Atenea Nike, el Erection y el Partenón. Tarde libre para seguir conociendo e l impresionante pasado artístico de esta ciudad, pasear, recorrer el animado barrio de Plaka o hacer alguna compra artesanal. Alojamiento.


DIA 13:  ATENAS (MEDIA PENSION):
	 
Desayuno. Día libre recomendamos realizar la excurión opcional a Delfos.

DIA 14: ATENAS – EL CAIRO (MEDIA PENSION):

Desayuno. Traslado al aeropuerto para embarcar en vuelo hacía El Cairo .Llegada. Traslado al hotel. Tiempo libre en la capital de Egipto, la ciudad más grande de Africa y Oriente Próximo, con 16 millones de habitantes. Alojamiento. Cena.

DIA 15: EL CAIRO – LUXOR (PENSION COMPLETA):
	 
Desayuno. Traslado al aeropuerto a primera hora de la mañana para salir en vuelo de línea regular con destino a LUXOR. Llegada y traslado al barco, tramites de embarque y acomodación.Visita del valle de los Reyes para visitar las tumbas de los principales faraones. Entre estas tumbas, compuestas por varias habitaciones y corredores que conducen a las correspondientes cámaras de enterramiento, se encuentran entre otras las de Ramses III, Seti I y Amenhotep II. Se visitarán además los Colosos del Memnon, dos impresionantes estatuas de Amenofis II así como el Templo de la Reina Hatsepsut de camino a el Valle de las Reinas. Almuerzo a bordo. Por la tarde, visita de los templos de Luxor (dedicado al Dios Amon-Ra, Dios del Sol) y Karnark, impresionante conjunto de Templos, Lagos Sagrados. Cena y Alojamiento a bordo.

DIA 16: LUXOR – EDFU (PENSION COMPLETA):

Estancia en régimen de Pensión Completa. Navegación a Esna. Este día podremos disfrutar de la belleza del paisaje de las orillas del Nilo. Podrá realizar distintas actividades en barco y por la noche disfrutar de la música en la discoteca. Navegación a Edfu.

DIA 17:  EDFU – KOM OMBO (PENSION COMPLETA):
	 
Estancia en Pensión Completa. Llegada a Edfu y visita del Templo de Horus (Dios representado por un halcón), fue en el pasado cubierto parcialmente por el limo durante las inundaciones periódicas del Nilo. Una vez finalizados los trabajos de rescate y restauración, nos encontramos con uno de los templos más bellos de la época ptolomeica en un estado de conservación excepcional. Navegación a Kom Ombo.Visita del Templo de Kom Ombo, único templo dedicado a dos dioses, Sobek y Haroesis, en donde se encuentra un Nilométro (antiguo sistema de medición del nivel del río Nilo) y un cocodrilo momificado. Navegación a Aswan. Por la noche se disfrutará de la fiesta de las chilabas, traje típico del lugar (en ruta puede adquirir a módico precio en los mercados del lugar las chilabas) Alojamiento.

DIA 18:  KOM OMBO – ASWAN (PENSION COMPLETA):
	 
Estancia en Régimen de Pensión Completa. Llegada a Aswan, y visita de la ciudad con el Templo de Isis (Philae) que se encuentra en una isla accediendo a la misma en una lancha, y la cantera con el Obelisco Inacabado y la presa de Aswan, una de las mayores presas del mundo, creando el lago Nasser con una logitud de más de 500 km. Por la tarde paseo en “faluca”, típicos barcos de vela de la zona. Al llegar la noche disfrutaremos de espectáculo de danzas típicas beduinas con música folklórica y fiesta de despedida . Alojamiento.

DIA 19:  ASWAN – EL CAIRO (MEDIA PENSION):

Desayuno. Desembarque y traslado al aeropuerto. Salida en vuelo de línea regular hacia El Cairo. Llegada y traslado al hotel. Resto del día libre en la actual capital del país que cuenta con una población que supera los 16 millones de habitantes. Fue fundada hace mil años por los fatimitas (al Muzz Ledin El Lah El Fatimi) y es considerada la ciudad más grande de África, la mas caótica y la más simpática.Por la noche visita del espectáculo de luz y sonido en Las Pirámides de Giza. Alojamiento. Aquellos pasajeros que lo deseen tendrán la posibilidad de realizar una excursión opcional en avión al Templo de Abu Simbel, que fue rescatado de las aguas, elevándolo de su emplazamiento primitivo para salvarlo cuando se creó el Lago Nasser (es conveniente indicarlo a su llegada a Egipto).

DIA 20:  EL CAIRO (MEDIA PENSION):
	 
Desayuno. Visita de día completo en la que incluimos las famosas pirámides de Keops, Kefren y Micerinos ( entrada al interior de las pirámides no incluida), así como la impresionante Esfinge esculpida en roca, visita al instituto del papiro en donde se mostrará la forma de realización artesanal de los Papiros. Almuerzo. Visita del Museo Egipcio con su arte milenario y donde se guarda el tesoro de la Tumba de Tutankhamon. También se incluye la Ciudadela de Saladino y la Mezquita de Alabastro. Recomendamos una visita nocturna al Bazar Khan el Khal Ili. Alojamiento.

DIA 21:  EL CAIRO (MEDIA PENSION):

Traslado al medio día desde el hotel al aeropuerto para tomar el vuelo desde el Cairo con conexion en Madrid, y destino final Buenos Aires y Córdoba. Día 22: EL CAIRO – (EN VUELO): Llegada a Córdoba, traslado a Río Cuarto y fin de nuestros servicios.

DIA 22:  EL CAIRO – (EN VUELO):
	 
Llegada a Córdoba, traslado a Río Cuarto y fin de nuestros servicios. ');
        
        $paquete1->setObservaciones('Las Excursiones ofrecidas en el presente, 
                                    pueden ser realizadas en diferentes días a los 
                                    previstos en el itinerario, si esto no desmejora 
                                    la calidad y/o cantidad de servicios. Los pasajeros 
                                    alojados en Base Triple, compartirán una habitación que, 
                                    “frecuentemente”, cuenta con Una cama matrimonial 
                                    y una Cama “ADICIONAL” (Catre).- ');
        
        $paquete1->setResumen('GRECIA: ATENAS – ISLAS GRIEGAS: HERACLION – (CRETA) SANTORINI – 
                                PATMOS TURQUIA: KUSADASI – EFESO – PAMUKKALE – KONYA – CAPADOCIA – 
                                ANKARA – ESTAMBUL EGIPTO: EL CAIRO – LUXOR – KARNAK – EDFU – 
                                KOM OMBO – ASWAN ');
        
        $paquete1->setServiciosIncluidos('-Aéreos desde Cordoba.                                        -Aéreo Estambul / Kayseryl / Atenas / Cairo TURKISH AIR y OLIMPIC.
                                         -Pasaje aéreo Cairo / Luxor – 
                                         Aswan / Cairo con EGYPTAIR.
                                         -Todos los traslados de llegada y de salida.
                                         -Hoteles categoría 3* sup y 4* estrellas con desayuno
                                         -29 comidas (Almuerzos y cenas detalladas en el itinerario)
                                         -Crucero por Islas Griegas y por El Nilo.
                                         -Seguro asistencia al viajero
                                         -Excursiones y visitas especificadas en el programa
                                         -Coordinador permanente desde Córdoba y guías locales ');
        
        $paquete1->setServiciosNoIncluidos('-Bebidas en las Comidas.
                                            -Extras no especificados en el Itinerario.
                                            -Propinas en los Hoteles, Cruceros y Guías. (Aprox. U$D100).
                                            -Visado de Egipto (U$D35).
                                            -Tasas de Aeropuerto (U$D 29). ');
        
        $manager->persist($paisArgentina);
        $manager->persist($paisBrasil);
        $manager->persist($paisEspaña);
        $manager->persist($paisGrecia);
        $manager->persist($paisItalia);
        $manager->persist($paisTurquia);
        
        $manager->persist($ciudadAtenas);
        $manager->persist($ciudadCordoba);
        $manager->persist($ciudadEstambul);
        $manager->persist($ciudadRioCuarto);
                
        $manager->persist($paquete1);
        
        $manager->flush();
    }
}
