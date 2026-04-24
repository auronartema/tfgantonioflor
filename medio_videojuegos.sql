-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Servidor: 127.0.0.1
-- Tiempo de generación: 24-04-2026 a las 18:52:36
-- Versión del servidor: 10.4.32-MariaDB
-- Versión de PHP: 8.2.12

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Base de datos: `medio_videojuegos`
--

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `articulos`
--

CREATE TABLE `articulos` (
  `id` int(11) NOT NULL,
  `titulo` varchar(255) NOT NULL,
  `introduccion` text DEFAULT NULL,
  `imagen` varchar(255) DEFAULT NULL,
  `contenido` text NOT NULL,
  `fecha_publicacion` datetime NOT NULL,
  `autor` varchar(100) NOT NULL,
  `valoracion` tinyint(4) DEFAULT NULL,
  `tipo` varchar(10) NOT NULL DEFAULT 'articulo'
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_general_ci;

--
-- Volcado de datos para la tabla `articulos`
--

INSERT INTO `articulos` (`id`, `titulo`, `introduccion`, `imagen`, `contenido`, `fecha_publicacion`, `autor`, `valoracion`, `tipo`) VALUES
(19, 'Dragon Quest VII Reimagined presenta a sus protagonistas con un nuevo tráiler cargado de detalles', 'Dragon Quest VII Reimagined presenta un nuevo tráiler centrado en los protagonistas de cara a su llegada en unos días.\r\n', 'imagenes/DRAGON QUEST.jpg', '<p class=\"ql-align-justify\">En poco más de una semana se pondrá a la venta&nbsp;<strong><em>Dragon Quest VII Reimagined</em></strong>&nbsp;y<strong>&nbsp;Square Enix</strong>&nbsp;se prepara para su llegada con un nuevo tráiler centrado en sus protagonistas. Y es que a diferencia de otras entregas de la franquicia, formaremos un sequito de con personajes muy implicados en la trama, contando cada uno de ellos, con un protagonismo superior al habitual.<a href=\"https://freakelitex.com/siete-motivos-para-jugar-a-dragon-quest-vii-reimagined/\" rel=\"noopener noreferrer\" target=\"_blank\" style=\"color: rgb(255, 255, 255); background-color: transparent;\"><em>motivos para jugar a DRAGON QUEST VII Reimagined</em></a></p><p class=\"ql-align-justify\">Un niño criado en lo salvaje, un caballero prejubilado, una domadora de bestias…&nbsp;<em>Dragon Quest VII&nbsp;</em>se caracteriza por el desarrollo de sus personajes y su trama más abierta. Además, llegará en apenas unos días al mercado, el próximo 5 de febrero, estando disponible en PS5, Xbox Series, Switch y Switch 2 y PC a través de Steam.</p><p class=\"ql-align-justify\"><br></p><h2><em>Dragon Quest VII Reimagined&nbsp;</em>se prepara para su llegada con un tráiler centrado en sus protagonistas</h2><p><br></p><p class=\"ql-align-justify\"><a href=\"https://youtu.be/Ci-wjJWNYV8\" rel=\"noopener noreferrer\" target=\"_blank\">https://youtu.be/Ci-wjJWNYV8</a></p><p class=\"ql-align-justify\"><br></p><p class=\"ql-align-justify\">En el apartado jugable, el sistema de combate por turnos ha sido renovado con mejoras que lo hacen más dinámico. Entre las novedades destaca el sistema de vocaciones actualizado, que incluye la mecánica “Moonlighting” para combinar dos vocaciones a la vez, la habilidad “Let Loose” que se activa en momentos clave y una nueva vocación, “Monster Master”, que permite invocar criaturas poderosas. También se han implementado mejoras en la interfaz y otras optimizaciones para facilitar la experiencia.</p><p>Para los coleccionistas, la Edición de Coleccionista Física, disponible en preventa a través de la tienda de Square Enix, incluye el juego, una caja SteelBook, un peluche de Slime Sonriente, una figura de barco en una botella y varios contenidos descargables. La Edición Digital Deluxe ofrece acceso anticipado de 48 horas, un traje exclusivo para el personaje Ruff y tres paquetes de DLC.</p><p><br></p><p class=\"ql-align-justify\">Además, quienes compren cualquier edición antes del lanzamiento recibirán un traje de Dragon Quest VIII para el héroe y objetos para mejorar estadísticas.</p><p class=\"ql-align-justify\"><br></p><p class=\"ql-align-justify\"><a href=\"https://freakelitex.com/dragon-quest-vii-reimagined-trailer-protagonistas-y-detalles/\" rel=\"noopener noreferrer\" target=\"_blank\">Fuente</a></p><p><br></p>', '2026-02-03 16:24:52', 'Antonio Flor', NULL, 'noticia'),
(20, 'Presentado Asthenia fantasía oscura en un mundo al borde del colapso', 'Anunciado el juego de terror y acción en primera persona Asthenia, que recuerda a títulos como Resident Evil VII.\r\n', 'imagenes/Asthenia.jpg', '<p class=\"ql-align-justify\"><em>Asthenia</em>&nbsp;es una nueva aventura de&nbsp;<strong>fantasía oscura</strong>&nbsp;ambientada en un mundo antiguo y moribundo, marcado por la decadencia, la fe y decisiones irreversibles. El juego invita a los jugadores a adentrarse en una dimensión en ruinas, gobernada por entidades ancestrales y consumida lentamente por una enfermedad corruptora que deforma tanto a sus habitantes como al propio entorno.</p><p class=\"ql-align-justify\">En esta experiencia, asumimos el papel de&nbsp;<strong>Adam</strong>, un hombre común que es arrastrado a este mundo junto a otros humanos. Sin habilidades especiales ni un destino heroico, Adam debe luchar por sobrevivir mientras intenta comprender qué está ocurriendo. Y, sobre todo, encontrar una forma de regresar con la persona que ama. A lo largo del viaje, recorreremos escenarios hostiles y desolados, como pueblos abandonados, restos industriales oxidados y templos olvidados por el tiempo. Donde cada rincón transmite una sensación constante de pérdida y amenaza.</p><h2>Asthenia se prepara para su primera demo en PC y es toda una declaración de intenciones</h2><p><br></p><p class=\"ql-align-justify\">El sistema de combate se centra en enfrentamientos&nbsp;<strong>lentos y cargados</strong>, utilizando el&nbsp;<strong>Guantelete Antiguo</strong>, un artefacto primordial que funciona tanto como arma como herramienta para interactuar con el entorno. La gestión de recursos es clave, ya que la energía del guantelete es limitada y cada decisión en combate puede tener consecuencias graves.&nbsp;<em>Asthenia</em>&nbsp;prescinde por completo de mapas y marcadores de misión, obligando al jugador a avanzar mediante la observación, la memoria y la intuición.</p><p class=\"ql-align-justify\">La narrativa se construye de forma indirecta, apoyándose en el&nbsp;<strong>storytelling ambiental</strong>: cartas fragmentadas, símbolos visuales, sonidos inquietantes y la propia narración interna de Adam. El juego toma inspiración tonal de títulos como&nbsp;<em>Resident Evil 7</em>,&nbsp;<em>Silent Hill</em>,&nbsp;<em>Outlast</em>&nbsp;y&nbsp;<em>Dark Souls</em>, combinando una atmósfera opresiva con un diseño que no lleva de la mano al jugador.</p><p><br></p><p><a href=\"https://freakelitex.com/asthenia-anunciado-para-pc-con-demo-y-trailer/\" rel=\"noopener noreferrer\" target=\"_blank\">Fuente</a></p>', '2026-02-03 17:36:06', 'Antonio Flor', NULL, 'noticia'),
(21, 'Análisis Inazuma Eleven – Heroes’ Victory Road', 'Inazuma Eleven Heroes\' Victory Road ha sido muy mejorado en su última actualización tal y como os contamos en nuestro análisis.\r\n', 'imagenes/Inazuma.jpg', '<p class=\"ql-align-justify\"><strong><em>Inazuma Eleven – Heroes’ Victory Road</em></strong>&nbsp;llega a PlayStation 5 envuelto en una mezcla de ilusión, dudas y muchas expectativas tras un lanzamiento que&nbsp;<a href=\"https://freakelitex.com/inazuma-eleven-victory-road-disponible-acceso-anticipado/\" rel=\"noopener noreferrer\" target=\"_blank\" style=\"color: rgb(255, 255, 255); background-color: transparent;\">ha necesitado&nbsp;<strong>una importante revisión</strong></a><strong>, pero que llegó a tiempo para nuestro análisis</strong>. No es para menos: hablamos de una de las franquicias manganime más queridas relacionadas con el fútbol, una obra que siempre ha ido mucho más allá del deporte para hablar de amistad, superación y pasión.</p><p class=\"ql-align-justify\">Además, su desarrollo ha sido largo y tortuoso, rozando en más de una ocasión lo que muchos catalogarían como un auténtico&nbsp;<em>development hell</em>. Lo que hacía temer que el resultado final no estuviera a la altura de lo que los fans llevaban años esperando. Sin embargo, el nuevo proyecto de LEVEL-5<strong>&nbsp;no solo busca recuperar la esencia de Inazuma Eleven, sino también adaptarla a los estándares actuales</strong>.</p><p class=\"ql-align-justify\">Así, ofreciendo una experiencia que combine narrativa, rol y fútbol de una forma muy particular. Heroes Victory Road no pretende ser un simulador deportivo al uso, ni tampoco un arcade puro, sino una experiencia muy marcada por su ADN manganime, algo que se nota desde el primer minuto.</p><h2>Pasión por el fútbol ante todo: análisis Inazuma Eleven – Heroes’ Victory Road</h2><p class=\"ql-align-justify\">Uno de los grandes pilares de Victory Road es su modo historia, y aquí&nbsp;<strong>LEVEL-5 demuestra que sigue sabiendo cómo construir relatos que conectan con el jugador</strong>. La trama se sitúa 25 años después de los acontecimientos de la serie original y presenta un nuevo protagonista. Billows, un joven que, paradójicamente, odia el fútbol.</p><p class=\"ql-align-justify\">Este punto de partida ya resulta interesante, especialmente dentro de una franquicia que siempre ha ensalzado este deporte como el centro de todo. El contexto no tarda en volverse más complejo.&nbsp;<strong>Billows llega a una escuela donde el fútbol está prohibido debido a un incidente ocurrido años atrás</strong>, y su único deseo es llevar una vida tranquila, alejada de los terrenos de juego.</p><p class=\"ql-align-justify\">Sin embargo, el destino (y una serie de encuentros clave) lo empujan poco a poco a replantearse su relación con el fútbol,<strong>especialmente cuando descubre que posee un talento natural que otros no pueden aprovechar</strong>. A lo largo de la aventura, el jugador irá conociendo a un elenco de personajes que encajan perfectamente con los arquetipos clásicos de la saga: diseños exagerados, peinados imposibles, personalidades muy marcadas y una química constante entre los miembros del equipo.</p><p class=\"ql-align-justify\"><strong>Todo ello resulta especialmente gratificante para los fans veteranos, que reconocerán de inmediato el tono y el espíritu de Inazuma Eleven</strong>. Eso sí, el juego no esconde que se trata de un RPG denso. Durante las primeras horas,<strong>la narrativa y los diálogos tienen mucho más peso que la acción</strong>.</p><p class=\"ql-align-justify\">Antes de disputar el primer partido, el jugador deberá completar numerosas tareas: desplazarse entre localizaciones, participar en entrenamientos, resolver misiones secundarias y familiarizarse con múltiples sistemas. Este arranque puede resultar lento y algo pesado para quienes busquen entrar rápidamente en el terreno de juego.&nbsp;<strong>No en vano diremos, que tardaréis varias horas en disputar el primer partido</strong>.</p><h3>Jugabilidad adaptada a nuevos tiempos pero con todo el carisma de la franquicia</h3><p class=\"ql-align-justify\">Con el paso del tiempo, eso sí, la historia va ganando fuerza. La construcción del mundo, el desarrollo de los personajes y ciertos momentos de tensión narrativa logran que la experiencia resulte muy satisfactoria a nivel argumental.&nbsp;<strong>Es una historia que se cuece a fuego lento, pero que recompensa a quienes deciden implicarse en ella</strong>.</p><p class=\"ql-align-justify\">Además, las escenas de anime son de lo más abundante, mucho más que en cualquier otro juego que hayamos jugado. La jugabilidad es, sin duda, uno de los aspectos más particulares del juego. LEVEL-5 apuesta por&nbsp;<strong>una mezcla de sistemas que refuerzan su identidad como RPG</strong>, alejándose deliberadamente de propuestas más directas o puramente deportivas. Para entenderla mejor, conviene dividirla en varios bloques.</p><p class=\"ql-align-justify\">A lo largo del modo historia,<strong>el jugador se encontrará con numerosos minijuegos que cumplen distintas funciones: desde obtener coleccionables hasta mejorar estadísticas o resolver situaciones concretas de la trama</strong>. Uno de los más habituales son los enfrentamientos de Foco, presentes tanto en la historia principal como en las misiones secundarias.</p><p class=\"ql-align-justify\">Estos enfrentamientos se basan en combates en tiempo real con una mecánica de piedra, papel y tijera, donde la gestión de la vida, la tensión y el número de compañeros resulta clave. Aunque cumplen su función,&nbsp;<strong>con el paso de las horas se vuelven repetitivos y pierden impacto, especialmente fuera de los partidos oficiales</strong>.</p><p class=\"ql-align-justify\">La exploración es sencilla y funcional, pero también uno de los puntos más flojos del conjunto. El jugador puede moverse entre distintas zonas de la ciudad, interactuar con NPCs, completar encargos o participar en pequeñas actividades. Sin embargo,&nbsp;<strong>muchas de estas acciones se sienten rutinarias, sobre todo durante las primeras horas.</strong></p><h3>RPG y fútbol se dan la mano de manera magistral</h3><p class=\"ql-align-justify\">Las misiones secundarias, en su mayoría<strong>, siguen una estructura de recadero que aporta poco a nivel jugable, aunque algunos diálogos sí ayudan a enriquecer el universo del juego</strong>. Aun así, es un apartado que podría haberse trabajado con mayor profundidad y variedad. Sin embargo, están bien para ampliar la historia y probar otras formas de jugar no tan centradas en el deporte.</p><p class=\"ql-align-justify\">Donde el juego sí brilla es en la personalización. Los objetos y coleccionables obtenidos permiten mejorar las estadísticas de los jugadores y definir su rol dentro del equipo.&nbsp;<strong>Este sistema resulta especialmente interesante cuando el jugador decide profundizar en tácticas, formaciones y supertécnicas.</strong>&nbsp;Aquí es donde Heroes Victory Road muestra sin complejos su faceta de RPG puro, ofreciendo opciones suficientes para quienes disfrutan optimizando y especializando a sus personajes.</p><p class=\"ql-align-justify\">Los partidos son el corazón de la experiencia y, afortunadamente, uno de sus mayores aciertos. La jugabilidad es pausada y estratégica, muy distinta a la de otros títulos como&nbsp;<em>Captain Tsubasa: Rise of the New Champions</em>. Cada encuentro se basa en la toma de decisiones, la gestión de la tensión y el posicionamiento.</p><p class=\"ql-align-justify\">Los constantes parones,<strong>&nbsp;especialmente en el centro del campo, se traducen en duelos 1vs1 donde entran en juego reflejos y estrategia</strong>. En ataque, llegar al área rival y activar la zona de disparo resulta clave, pudiendo optar por tiros normales o técnicas especiales. En defensa,&nbsp;<strong>la correcta utilización de las ultratécnicas convierte a porteros y defensas en auténticos muros</strong>. Todo ello culmina en un espectáculo visual que hace justicia al manganime,<strong>&nbsp;especialmente cuando entran en juego las técnicas especiales que tantos recuerdos despiertan en los fans</strong>.</p><h3>Modos de juego suficientes para que nunca te aburras de jugarlo</h3><p class=\"ql-align-justify\">Aunque&nbsp;<strong>el modo historia cuenta con suficiente carga y duración como para pasar por caja, lejos de ser el único incentivo jugable</strong>, cuenta con varios modos de juego más. Además de este, ofrece otros modos que amplían considerablemente su duración y atractivo.</p><p class=\"ql-align-justify\"><strong>El modo Crónica permite revivir algunos de los partidos más emblemáticos del anime</strong>, encarnando a Victorio Cryptix, un personaje capaz de viajar en el tiempo para evitar la destrucción del mundo. Sí, el fútbol es capaz de eso y más. Este modo es puro fanservice y una auténtica delicia para quienes quieran recrear momentos icónicos de la serie, además de servir como una excelente excusa para centrarse más en la acción directa.</p><p class=\"ql-align-justify\">Por otro lado,&nbsp;<strong>el Estadio BB permite enfrentarse a equipos predefinidos de toda la saga</strong>, ofreciendo un reto constante y la posibilidad de demostrar quién manda realmente sobre el césped. A todo esto se suma un modo multijugador que, en líneas generales, funciona de manera sólida y promete crecer con el contenido postlanzamiento y los torneos periódicos.</p><p class=\"ql-align-justify\">Respecto al modo en línea,&nbsp;<strong>pocas quejas podemos ponerle ya que el tiempo en encontrar y entablar partida es sumamente corto</strong>. Durante el desarrollo de las mismas,&nbsp;<strong>no hemos sufrido caídas ni bajadas de fotogramas,</strong>&nbsp;lo cual tiene mérito porque han sido muchas horas.</p><h3>Técnicamente hace delicias de cualquier amante del anime</h3><p class=\"ql-align-justify\">A nivel visual,&nbsp;<strong>estamos ante un título muy llamativo que defiende a la perfección los gráficos&nbsp;<em>cel-shading</em></strong>. El diseño de personajes, las cinemáticas que parecen sacadas directamente del anime y la recreación de las técnicas especiales convierten cada partido en un espectáculo.&nbsp;<strong>En el modo historia, la ambientación y las localizaciones logran una inmersión notable</strong>.</p><p class=\"ql-align-justify\">No obstante, el apartado técnico no está exento de problemas.&nbsp;<strong>En PlayStation 5 se han detectado errores puntuales: animaciones faciales algo pobres, falta de variedad en ciertos enfrentamientos y fallos de carga de texturas en segundo plano</strong>. No son errores graves ni rompen la experiencia, pero sí deslucen un conjunto que, en otros aspectos, resulta sobresaliente.</p><p class=\"ql-align-justify\">Mención especial merece la localización al castellano.&nbsp;<strong>A pesar de no contar con doblaje en español, la traducción es excelente, especialmente teniendo en cuenta la enorme cantidad de texto que incluye el juego</strong>. Además, la opción de elegir entre nombres occidentales o japoneses es un detalle muy agradecido, aunque puede generar alguna pequeña incongruencia puntual.</p><p class=\"ql-align-justify\">Por último y no por ello menos importante,<strong>&nbsp;la tasa de fotogramas a 60 fps es constante, y sin ninguna caída que hayamos podido apreciar</strong>. Esto es especialmente importante en títulos multijugador, aunque los elementos de rol le restan importancia, los reflejos siguen siendo delicados.</p><h3>Análisis de&nbsp;<em>Inazuma Eleven Heroes’ Victory Road</em>: conclusiones</h3><p class=\"ql-align-justify\"><em>Inazuma Eleven: Heroes Victory Road</em>&nbsp;es, ante todo, una carta de amor a los fans de la saga y al fútbol entendido como una pasión capaz de unir personas. LEVEL-5 ha logrado sacar adelante un proyecto ambicioso tras un desarrollo complicado,&nbsp;<strong>ofreciendo una experiencia rica en contenido y con una identidad muy marcada</strong>.</p><p class=\"ql-align-justify\">No es un juego perfecto y tiene aspectos claramente mejorables, pero su propuesta es honesta y muy disfrutable para quien conecte con su ritmo y su enfoque RPG.&nbsp;<strong>Un título que recompensa la paciencia y que demuestra que Inazuma Eleven sigue teniendo mucho que decir</strong>.</p><p><br></p>', '2026-02-03 17:40:21', 'Antonio Flor', 9, 'articulo'),
(22, 'Anunciado Snack World – Reloaded para PS5 y Switch 2, vuelve el clásico inspirado en Fantasy Life', 'Anunciado el remake de Snack World, Reloaded que además llegará a PS5 con muchas mejoras y añadidos.', 'imagenes/Snack World Reloaded PS5.jpg', '<p>Hay sagas que vuelven reinventándose… y luego est<strong>á&nbsp;<em>Snack World</em></strong>, que directamente decide reaparecer como si fuera un juego completamente nuevo.<strong>&nbsp;<em>Snack World – Reloaded</em>&nbsp;</strong>ya es oficial, y apunta a ese tipo de regreso que no sabías que necesitabas hasta que lo ves en movimiento.</p><p>El título parte de la base de&nbsp;<em>Snack World: The Dungeon Crawl – Gold</em>, pero lo de “remake” aquí se queda bastante corto. Desde&nbsp;<strong>Level-5 han apostado por rehacer la experiencia con cambios importantes en jugabilidad, controles e incluso en la historia</strong>, buscando que se sienta fresco tanto para los que ya lo jugaron en su día como para los que lleguen por primera vez.</p><p><br></p><p><a href=\"https://youtu.be/sMXeY_R3j6E\" rel=\"noopener noreferrer\" target=\"_blank\">https://youtu.be/sMXeY_R3j6E</a></p><p><br></p><p>A nivel visual, el salto es evidente. El mundo ahora tiene un estilo que recuerda a un diorama, como si todo formara parte de una maqueta viva. Ese toque encaja perfectamente con el tono desenfadado de la franquicia, que siempre ha jugado entre la fantasía clásica y un humor más ligero y accesible.</p><p>Pero no todo se queda en lo visual. Una de las novedades más curiosas es la inclusión de nuevas formas de jugar la historia, incluyendo la posibilidad de controlar a Chup, el protagonista del anime, lo que abre la puerta a ver el mundo desde otra perspectiva y no solo desde el enfoque original del juego.</p><p><br></p><p><br></p>', '2026-04-11 10:32:12', 'Antonio Flor', NULL, 'noticia'),
(23, '[Análisis] Life is Strange Reunion, el desenlace que todos esperábamos de la historia de Max y Chloe', 'Hace algo más de diez años, aterrizaba en nuestras vidas Life is Strange, una inesperada aventura narrativa cuyo triunfo no lo esperaba ni la propia Square Enix. Tras seis entregas, hemos seguido a Max y Chloe, juntas o separadas, durante al menos tres de ellas, siendo Life is Strange Reunion el cuarto y definitivo cierre a su historia.\r\n\r\n', 'imagenes/Imagen-destacada_20260410_150559_0000-1600x900.jpg', '<p>Reunion es bastante más que otra entrega de la saga, supone volver a los orígenes de lo que la hizo grande, la relación entre sus protagonistas. Varias de&nbsp;<strong>sus mecánicas clásicas regresan, y con ellas todo aquello que nos conquistó en su momento</strong>. Aunque no es una entrega perfecta, se nota claramente la intención de sus creadores, Deck Nine, de repetir la fórmula que tanto funcionó en su día.</p><p>Preparaos para acompañar a nuestra chica con poderes por última vez. Un viaje que, pese a todo,&nbsp;<strong>ha sabido mantenernos pegados a la pantalla</strong>, con más de un momento de tensión fuerte. Os lo contamos, pero no rebobinéis demasiado.</p><p><br></p><p>Ocho meses después de los sucesos de&nbsp;<em>Double Exposure</em>, M<strong>ax Caulfield trata de asentar bien sus raíces en Lakeport</strong>, donde ejerce como profesora de fotografía en la universidad, y también se forma como fotógrafa profesional. Sin embargo, cuando su carrera se halla en lo más alto, su centro de enseñanza arde, por lo que Max vuelve a rebobinar el tiempo en una foto otra vez más. Ahora,&nbsp;<strong>disponible de tan solo tres días para hallar la causa del incendio</strong>, que cada vez parece un caso más difícil, hasta el punto de sentirse superada.</p><p>Justo cuando más lo necesitaba,&nbsp;<strong>entra en escena Chloe Price, su amiga de la infancia cuyo papel en la historia depende de nuestra elección al final de la primera entrega</strong>. Y es que justo aquí, es donde Reunion presume y se diferencia del resto de entregas. Nuestras decisiones al inicio de la partida marcarán muchos sucesos durante la trama, más que en ninguna otra obra del estudio. De este modo, podemos afirmar que Reunion es la entrega de la saga donde las elecciones influyen más que nunca, por lo que factores como la rejugabilidad están más que aseguradas.</p><p>Si bien es cierto, la duración del juego está más que ajustada en los márgenes de la franquicia (8 horas), aquí rompe con todo lo visto y tenemos más finales que nunca. Pese a que habitualmente,&nbsp;<strong>la única decisión que importaba hasta el momento era la decisión final</strong>, ahora todo lo que hagamos influirá en la trama: el incendio, el destino de Chloe, la relación entre las chicas… todo.</p><p><br></p><p>Tal y como vimos en el análisis de<em>Double Exposure</em>, el poder de cambiar de dimensión tenía algunos pros importantes, como poder ver dos líneas temporales a la vez. Sin embargo,<strong>también corría algunos riesgos, como la tremenda necesidad de revisar dos escenarios de forma consecutiva</strong>, lo cual se hacía demasiado tedioso a la larga.</p><p>Aquí, recuperamos la mecánica más clásica de la primera entrega, rebobinar en el tiempo. Esto tiene diferentes usos, como permitirnos&nbsp;<strong>cambiar de elección durante una conversación</strong>. Hay muchos otros importantes, como permitirnos&nbsp;<strong>llegar a los sitios antes de que algo ocurra</strong>, algo que funcionó muy bien en su origen para Max y que no debería haber «olvidado».</p><p>En este sentido,&nbsp;<strong>se nota la necesidad del estudio en recular sus decisiones con respecto a&nbsp;<em>Double Exposure</em></strong>, aunque no es el único elemento donde han echado la vista atrás. Pese a que Max nunca había olvidado a Chloe<strong>, carecía prácticamente de importancia durante DE</strong>. En Reunion,&nbsp;<strong>Max la recuerda constantemente</strong>, hasta que mágicamente, vuelve a formar parte de la aventura.</p><p>El estudio ha justificado su regreso en base a los sucesos de DE, y lo cierto es que es bastante convincente. A nosotros nos ha convencido por varios motivos, siendo el principal de ello que deseábamos un final en el que pudieran estar juntas sin que eso implique la destrucción de Arcadia Bay.&nbsp;<strong>Dependerá por completo de vosotros lograr que esto suceda, buena suerte</strong>.</p><p><br></p><p>Once años después del lanzamiento del original,&nbsp;<strong>el primer&nbsp;<em>Life is Strange</em>&nbsp;nos sigue pareciendo la entrega más redonda en muchos sentidos</strong>, siendo el desarrollo de la trama, el más absoluto. Reunion ha abandonado el desarrollo por capítulos, por lo que la trama avanza de forma más uniforme, pero con menos momentos de tensión.</p><p>Aún así,&nbsp;<strong>el desarrollo es bastante completo, y el hecho de controlar a ambas heroínas</strong>, ayudan a no caer en la sensación de ser repetitivo. Si bien es cierto, muchas de las situaciones se resuelven hablando, nos ha parecido de las entregas con mejor desarrollo en muchos sentidos.</p><p>Por sacarle alguna pega,&nbsp;<strong>abusa de la repetición de escenarios, en especial si jugamos a DE, ya que el 90% de los escenarios han salido de esta entrega</strong>. Si bien es cierto, hay pequeños cambios, no podemos evitar caer en la repetición, y aquí se nota el esfuerzo del estudio por ahorrar recursos en vez de buscar una ubicación nueva.</p><p><br></p><p>Tras todo lo vivido,&nbsp;<strong>Square Enix y Deck Nine han conseguido algo que no era nada sencillo: cerrar una historia que lleva años acompañándonos</strong>&nbsp;con una entrega que mira constantemente al pasado, pero sin dejar de intentar avanzar.&nbsp;<strong>Life is Strange: Reunion no es perfecto, ni pretende serlo, pero sí se siente como ese último abrazo a unos personajes que ya forman parte de nosotros</strong>.</p><p><strong>La vuelta a las raíces,</strong>&nbsp;con el rebobinado como mecánica central&nbsp;<strong>y el foco absoluto en la relación entre Max Caulfield y Chloe Price</strong>, funciona. Funciona porque entiende qué hizo grande a la saga, y porque pone nuestras decisiones en el centro de todo como nunca antes. Aquí, cada elección pesa, cada diálogo cuenta, y cada pequeño gesto puede cambiarlo todo.</p><p><strong>Puede que le falte algo más de riesgo, que abuse de escenarios conocidos o que no alcance las cotas del original</strong>, pero cuando acierta, lo hace con mucha fuerza. En especial en lo emocional, donde sigue siendo capaz de tocarnos como pocas aventuras narrativas consiguen.</p><p><strong>Reunion no es solo un cierre, es una despedida</strong>. Y como toda despedida, tiene algo de imperfecta, pero también de inolvidable. Una saga que ha formado parte de nuestras vidas durante más de once años<strong>, y que merecíamos cerrar de una forma tan digna como esta</strong>.</p><h4>Lo que más nos ha gustado:</h4><ul><li>La relación de Max y Chloe, nos hace sentir como en la primera entrega.</li><li>Poder cambiar de personaje aporta variedad y le da carisma.</li><li>Las decisiones afectan desde el principio hasta el final de la aventura.</li></ul><h4>Lo que menos nos ha gustado:</h4><ul><li>Se repiten muchos escenarios de la anterior entrega.</li><li>Faltan capítulos con algo más de acción.</li></ul><p><br></p>', '2026-04-11 10:36:28', 'Antonio Flor', 9, 'articulo'),
(24, 'Anunciado Capitán Usopp el Valiente y los Sombrero de Paja para Netflix, una LEGO aventura de One Piece', 'Anunciada la primera adaptación televisiva de LEGO con One Piece, llega Capitán Usopp el Valiente y los Sombrero de Paja que y tiene fecha.\r\n', 'imagenes/Capitan-Usopp-el-Valiente-a.jpg', '<p class=\"ql-align-justify\">One Piece, lejos de tocar techo, está más presente que nunca y muy de moda, anunciado ahora la llegada de Capitán Usopp el Valiente y los sombrero de Paja. En efecto, estamos ante el primer especial de One Piece protagonizado con personajes y aventuras de LEGO. Además, ha presentado su primer tráiler.</p><p class=\"ql-align-justify\">Este especial, estará conformado por dos partes, teniendo un entreno programado para el 29 de septiembre de este mismo año. Además, se ambienta en el mismo universo que la adaptación live-action, por lo que, incluso los actores de doblaje, serán los mismos que en la serie. Tal y como podemos ver en el avance publicado.</p><h2>Capitán Usopp el Valiente y los Sombrero de Paja es la pirmera colaboración de LEGO y One Piece y llegará en septiembre</h2><p><br></p><p class=\"ql-align-justify\">Eso sí, este especial da un nuevo enfoque al mundo pirata que tanto nos apasiona, y es que, como podemos juzgar por el título, el protagonista inconfundible de este live-action será el gran Usopp. La trama trascurrirá en la isla de Sirop, siendo una historia totalmente original que no aparece en el anime. Muy posiblemente, anterior a los sucesos del anime.</p><p class=\"ql-align-justify\">A diferencia de las adaptaciones de LEGO que han sido totalmente hechas a mano, esta si cuenta con elementos digitalizados, especialmente en el diseño de escenarios. Por otra parte, ya existen productos que aúnan LEGO y One Piece, pero esta es la primera adaptación televisiva.</p><p class=\"ql-align-justify\"><strong>One Piece</strong>&nbsp;es un manga y anime épico creado por Eiichiro Oda. La historia sigue a Monkey D. Luffy y su tripulación, los Sombrero de Paja, en su búsqueda del legendario tesoro “One Piece” para convertirse en el Rey de los Piratas. Mezcla aventura, humor y emoción, explorando la amistad, la libertad y la justicia. Cada personaje tiene un sueño único y enfrenta desafíos increíbles en un mundo lleno de islas exóticas, misteriosas fuerzas y enemigos poderosos.</p><p><br></p>', '2026-04-11 10:42:45', 'Antonio Flor', NULL, 'noticia'),
(25, 'Análisis de Shinonome ABBYS – The Maiden Exorcist', 'En un abanico de género en constante cambio y evolución, nuevas propuestas suponen también nuevas formas de jugar. El mercado de los juegos a menudo está saturado por títulos que repiten la misma fórmula, por suerte, los chicos de WODAN, han dado con la tecla gracias a Shinonome ABBYS: The Maiden Exorcist.', 'imagenes/Shinonome.jpg', '<p>Estamos ante un título&nbsp;<em>roguelite&nbsp;</em>mezclado con elementos de terror al más puro estilo japonés, donde revisitaremos constantemente una mansión encantada. Cada visita a la casa,&nbsp;<strong>nos permitirá desbloquear nuevos elementos de la trama</strong>, a la par que ponernos a prueba para superarnos y explotar nuevas mecánicas jugables.</p><p>Lejos de ser una pobre chica indefensa,<strong>&nbsp;a Yono se le da genial recorrer cada rincón de la casa para mejorar su arsenal&nbsp;</strong>y hacer frente a las múltiples criaturas que nos atacarán. Pero, ¿será suficiente para sobrevivir y escapar?</p><h2>Yono, la excorcista de yokais y la búsqueda de su hermano: análisis SHINONOME ABBYS – The Maiden Exorcist</h2><p><img src=\"http://www.gameit.es/wp-content/uploads/2026/04/Analisis-SHINONOME-ABYSS-a-1024x576.jpg\" alt=\"Análisis SHINONOME ABYSS\" height=\"576\" width=\"1024\">Las trampas a veces son muy bastas, pero podemos usarlo en nuestro favor.</p><p>Siguiendo los pasos de su hermano Onmyouji desaparecido,&nbsp;<strong>la sacerdotisa Yono llega a una aterradora mansión embrujada por yokai y espíritus vengativos llamados Mononoke</strong>. Cada noche, nos espera una nueva visita en búsqueda de nuestro hermano, donde tendremos que sobrevivir sala tras sala hasta encontrar la salida.</p><p>Con una pretensión argumental mínima, el juego nos coloca directamente en la jugabilidad. Para lograrlo,&nbsp;<strong>presume de gráficos pixel en una vista cenital con una atmósfera sobrecogedora</strong>, donde cada sala de la casa infunde terror y la sensación de no estar solos en ningún momento.</p><p>El juego está pensado para disfrutar de partidas cortas y cronometradas. Más allá del escaso interés argumental que tiene, su principal baza es la rejugabilidad. Nos invita a rejugar cada escenario y a ir probando dificultades más altas. Lógicamente, esto también implica recompensas, c<strong>omo nuevas formas de acabar con nuestros enemigos, pero también nuevos peligros</strong>.</p><h2>Una mansión en constante cambio y con muchas formas de acabar con nuestros enemigos</h2><p><img src=\"http://www.gameit.es/wp-content/uploads/2026/04/Analisis-SHINONOME-ABYSS-c-1024x576.jpg\" alt=\"Análisis SHINONOME ABYSS\" height=\"576\" width=\"1024\">Análisis SHINONOME ABYSS</p><p>Como os decíamos, estamos ante un roguelite, por lo que cada partida implica cambios enormes en el mapeado, que se produce de forma aleatorio. La mansión,&nbsp;<strong>está conformada para varias salas, con nuevos peligros en cada visita</strong>. Aunque a menudo se repite el patrón de las salas, la exploración se premia bastante, ya que podemos encontrar objetos útiles que nos ayudarán a sobrevivir.</p><p>Uno de los más comunes serán los faroles,<strong>&nbsp;que no solo servirán para iluminarnos en las instancias más oscuras, también para prender fuego a los enemigos</strong>. En cada visita, y dependiendo también de la configuración que hayamos elegido, cambiará también el arsenal de armas que obtendremos. No nos valdremos únicamente de los objetos que encontremos, podemos poner las tramas que hay repartidas por toda la mansión en contra de nuestros rivales. Por ejemplo, con el candelabro haremos que nos sigan como polillas,&nbsp;<strong>llevándolos hasta una caída segura que acabará con ellos</strong>.</p><p>Lo cierto, es que la variedad de armas es uno de elementos trabajados del desarrollo,&nbsp;<strong>y también de los más variados, aunque no siempre resultan eficientes de la misma manera</strong>. Podemos llevar equipados un total de cuatro, pero no siempre conviene dar matarile a base de gastar todo lo que llevamos. En ocasiones, será más preciado buscar alguna trampa que podamos usar, pero si estamos cronometrando nuestra partida, es posible que prefiramos huir. Lógicamente, no siempre será una opción,&nbsp;<strong>pues a medida que progresamos, acaba siendo un hervidero de yokais</strong>.</p><h2>Modos de juego a tutiplén para no aburrirse nunca</h2><p><img src=\"http://www.gameit.es/wp-content/uploads/2026/04/Analisis-SHINONOME-ABYSS-d-1024x576.jpg\" alt=\"Análisis SHINONOME ABYSS\" height=\"576\" width=\"1024\">Algunos escenarios son muy visuales.</p><p>Lejos de ser un simple&nbsp;<em>roguelite</em>,&nbsp;<strong>contamos con tres modos para darle mucha más variedad al asunto</strong>. Por un lado, en&nbsp;<strong>Harai</strong>, contamos con mapas únicos y fijos, que no se producen de forma aleatoria. Aquí,<strong>&nbsp;tendremos que resolver acertijos, cobrando más protagonismo si cabe</strong>, aunque también abundarán los desafíos de enemigos.</p><p>Por otra parte,&nbsp;<strong>Misogi&nbsp;</strong>es la experiencia de juego más pura en el sentido de ser un&nbsp;<em>roguelite</em>, con escenarios aleatorios y centrados en la trama y el desafío por igual. Pero para quienes busquen un desafío mucho más alto, contamos con&nbsp;<strong>Gyou</strong>, que son mapas mucho más hardcore que además se enfoca más en la supervivencia al contar con muchos menos elementos.</p><p>Aquí, será más vital que nunca usar bien el oído, una suerte de «arma» secundaria, que nos permite anticiparnos al peligro antes de cambiar de sala. Este sistema recuerda enormemente al modo escucha de&nbsp;<em>The Last of Us</em>, pero con las limitaciones obvias de ser un juego indie. Lejos de servir únicamente para nuestros enemigos,&nbsp;<strong>también nos permite encontrar pistas y objetos por el escenario</strong>, toda una suerte que habrá que usar en dificultades más altas.</p><h2>Técnicamente precioso y con una atmósfera aterradora</h2><p><img src=\"http://www.gameit.es/wp-content/uploads/2026/04/Analisis-SHINONOME-ABYSS-f.webp\" height=\"576\" width=\"1024\">Análisis SHINONOME ABYSS</p><p>De nada serviría estar hablando de un juego de terror si no fuera por su apartado artístico.&nbsp;<strong>Los sonidos ambientales potencian en gran medida la sensación de inmersión con sonidos huecos como los cuervos</strong>, pero también cada pisada que damos por la casa. Estar en un ambiente tan tranquilo y que<strong>&nbsp;de repente escuchemos sonidos que no provienen de nosotros, es bastante estremecedor</strong>.</p><p><strong>Toda esta ambientación se apoya sobre una atmósfera pixel</strong>, pero con un nivel de detalle muy alto. Tanto el diseño de los escenarios, que se maquilla bastante al luchar contra los yoakis, como el de la protagonista y sus armas está cuidado, notándose el mimo pese a no ser un título de grandes pretensiones. El problema es, que al ser escenarios que se producen aleatoriamente, muchas de las salas parecen repetirse aunque sigan un patrón diferente.&nbsp;<strong>Esto le resta algo de inmersión, aunque no hay que olvidar las raíces del juego, que son de&nbsp;<em>roguelite</em></strong>.</p><p>Aunque la historia es bastante pasajera y&nbsp;<strong>podría contarse en pocos diálogos, llega en inglés</strong>. Quizás, si hubiera sido conveniente que llegara localizada para ayudarnos con las descripciones y la configuración de cada partida, pero tampoco es algo que estropée la experiencia. Por desgracia,<strong>&nbsp;tampoco llega con voces, algo acorde a su estilo artístico</strong>. Por cierto, podemos comparar nuestros resultados de cada partida con jugadores de todo el mundo,&nbsp;<strong>incentivando que repitamos las pruebas superando nuestras marcas</strong>.</p><p>Donde comprarlo:&nbsp;<a href=\"https://www.nintendo.com/es-es/Juegos/Programas-descargables-Nintendo-Switch/SHINONOME-ABYSS-The-Maiden-Exorcist-3048286.html?srsltid=AfmBOoriZOhSeMBz9hKPtaOAayasRXFmFsL1UI7JJzSrV5xxBBZq5P7d\" rel=\"noopener noreferrer\" target=\"_blank\" style=\"background-color: transparent; color: rgb(255, 255, 255);\">Switch</a>&nbsp;|&nbsp;<a href=\"https://store.steampowered.com/app/2948080/__SHINONOME_ABYSS_The_Maiden_Exorcist/\" rel=\"noopener noreferrer\" target=\"_blank\" style=\"background-color: transparent; color: rgb(255, 255, 255);\">Steam</a></p><iframe class=\"ql-video\" frameborder=\"0\" allowfullscreen=\"true\" src=\"https://www.youtube.com/embed/bwD3u_tpw2U?feature=oembed\" height=\"658\" width=\"1170\"></iframe><p><br></p><p>Análisis SHINONOME ABYSS – The Maiden Exorcist</p><h2>Análisis SHINONOME ABYSS – The Maiden Exorcist</h2><p><strong><em>Shinonome Abyss</em></strong>&nbsp;irrumpe como una propuesta muy original que mezcla dos género poco emparentados como son el terror y las mecánicas de roguelite. Sin llegar a ser un juego que de verdadero miedo,&nbsp;<strong>es muy inmersivo, con una atmósfera cuidada en un estilo pixel de los que ya quedan pocos</strong>.</p><p>Sin embargo, donde hace verdadera magia es en el apartado jugable,&nbsp;<strong>donde logra una sinergia muy cuidada entre mecánicas&nbsp;<em>roguelite</em>&nbsp;y gestión de recursos</strong>. Cada partida es diferente, y podemos darle el enfoque que queramos gracias a su variedad de mecánicas tales como la supervivencia o el enfrentamiento cara a cara.</p><h3>Lo que menos nos ha gustado:</h3><ul><li>Su variedad de mecánicas, podemos afrontar la partida de muchas maneras.</li><li>Variedad de niveles y muchos modos de juego.</li><li>La atmósfera pixel funciona muy bien con la jugabilidad.</li></ul><h3>Lo que menos nos ha gustado:</h3><ul><li>Llega en inglés.</li><li>La historia no rinde honor a sus virtudes.</li></ul><p><br></p>', '2026-04-20 10:43:52', 'Antonio Flor', 7, 'articulo');
INSERT INTO `articulos` (`id`, `titulo`, `introduccion`, `imagen`, `contenido`, `fecha_publicacion`, `autor`, `valoracion`, `tipo`) VALUES
(26, 'Análisis de Starfield en PS5, ¿cumple a nivel técnico en la sobremesa de Sony?', 'Tras probar en profundidad la última obra de Bethesda, os traemos nuestro análisis técnico de Starfield en PS5.\r\n', 'imagenes/Portada-analisis-Starfield.jpg', '<p class=\"ql-align-justify\">Han pasado casi tres años desde el lanzamiento original de&nbsp;<a href=\"https://freakelitex.com/starfield-caracteristicas-ps5-en-trailer/\" rel=\"noopener noreferrer\" target=\"_blank\" style=\"color: rgb(255, 255, 255); background-color: transparent;\"><strong><em>Starfield</em></strong></a>, y su llegada a PS5 no solo supone el fin de su exclusividad en el ecosistema Xbox. Sino también&nbsp;<strong>una segunda oportunidad para Bethesda de demostrar que su ambiciosa ópera espacial puede brillar en otro hardware</strong>. Esta versión no llega sola y lo hace acompañada de actualizaciones importantes como&nbsp;<em>Free Lanes</em>&nbsp;y contenido adicional que busca pulir la experiencia original.</p><p class=\"ql-align-justify\">Sin embargo, más allá de lo jugable o narrativo,<strong>&nbsp;el foco está claramente en lo técnico ya que no vamos a repetir elementos que ya hemos hablado en otros análisis</strong>. Y aquí es donde empiezan las dudas. Porque si algo ha caracterizado históricamente a Bethesda, es su capacidad para crear mundos inmensos… aunque no siempre estables. ¿Merecerá la pena el salto a PS5? ¿Han solucionado los problemas de la primera versión del juego? Os lo contamos.</p><h2>Directos al grano, así es el apartado técnico en PS5 y PS5 Pro: Análisis Starfield</h2><p><img src=\"https://freakelitex.com/wp-content/uploads/2026/04/Analisis-Starfield-PS5.png\" alt=\"Análisis Starfield PS5\" height=\"558\" width=\"1024\">El nivel de detalle de las zonas abiertas es impresionante. | Análisis Starfield PS5</p><p class=\"ql-align-justify\">Entrando en materia,&nbsp;<strong>la versión de PS5 ofrece dos modos gráficos bastante estándar: rendimiento y calidad</strong>. El primero apuesta por una mayor fluidez sacrificando resolución, mientras que el segundo prioriza la carga visual a costa de limitar la tasa de&nbsp;<em>frames</em>. Sobre el papel, todo correcto. En la práctica, no tanto.</p><p class=\"ql-align-justify\"><strong>El modo rendimiento intenta acercarse a los 60 FPS</strong>, pero no lo consigue de forma consistente.<strong>&nbsp;En zonas abiertas o interiores sencillos se comporta bien, pero en cuanto el juego se pone serio</strong>. ciudades grandes, combates con varios elementos en pantalla, zonas densas… la tasa de&nbsp;<em>frames&nbsp;</em>cae de forma notable. Esto genera&nbsp;<strong>una sensación de irregularidad bastante evidente</strong>, especialmente si eres sensible a este tipo de fluctuaciones.</p><p class=\"ql-align-justify\">El modo calidad, por otro lado, es más estable.&nbsp;<strong>Se mantiene en torno a los 30 FPS con bastante solidez&nbsp;</strong>y mejora aspectos como la distancia de dibujado, las sombras o la densidad de elementos. Es, probablemente, la opción más recomendable si buscas una experiencia más consistente, aunque menos fluida.&nbsp;<strong>Entendemos que esto pueda molestar a la gente que busca la fluidez&nbsp;</strong>cercana a un juego de acción, pero el resultado estable es bastante atractivo.</p><h3>Ahora bien, donde realmente hay cambios es en PS5 Pro</h3><p><img src=\"https://freakelitex.com/wp-content/uploads/2026/04/Analisis-Starfield-PS5-c.webp\" alt=\"Análisis Starfield PS5\" height=\"1080\" width=\"1920\"></p><p class=\"ql-align-justify\">Aquí el juego introduce más opciones gráficas, permitiendo ajustar mejor la experiencia según preferencias.<strong>&nbsp;En el mejor de los casos, puede acercarse a los 60 FPS de forma más estable</strong>, e incluso superarlos en determinadas situaciones&nbsp;<strong>si se combina con tecnologías como VRR</strong>. Sobre el papel, es la versión más completa. Pero tiene truco.</p><p class=\"ql-align-justify\">Para alcanzar ese rendimiento,&nbsp;<strong>el juego recurre a resoluciones internas bastante bajas en algunos modos, que luego se reescalan</strong>. Esto provoca que la imagen no siempre sea limpia: aparecen artefactos, pérdida de nitidez y problemas especialmente visibles en elementos como vegetación o detalles finos. Y luego está el gran problema: la estabilidad.&nbsp;<strong>Tanto en PS5 como en PS5 Pro, el juego presenta fallos que van más allá de lo visual</strong>. Hablamos de&nbsp;<em>crashes</em>, congelaciones e incluso problemas con el guardado de partida. No es algo constante en todos los casos, pero sí lo suficientemente frecuente como para generar desconfianza.</p><p class=\"ql-align-justify\">A esto se suman otros detalles como problemas con el HDR, opciones gráficas que no siempre se aplican correctamente o bugs heredados del propio motor. Nada que sorprenda viniendo de Bethesda,&nbsp;<strong>pero sí algo que pesa más de lo que debería a estas alturas</strong>. En resumidas cuentas, podríamos decir que en ambas versiones es jugable pero con problemas. El caso es, que&nbsp;<strong>Bethesda ya ha prometido soluciones</strong>, así que estamos hablando un poco sobre papel mojado porque de cara a un futuro, estos problemas no existirían.</p><h2>Con mucho más contenido que en su estreno original y la llegada de Terran Armada</h2><p><img src=\"https://freakelitex.com/wp-content/uploads/2026/04/Analisis-Starfield-PS5-b.jpeg\" height=\"366\" width=\"650\"><img src=\"https://freakelitex.com/wp-content/uploads/2026/04/Analisis-Starfield-PS5-a.webp\" height=\"1080\" width=\"1920\"></p><p class=\"ql-align-justify\">Uno de los puntos más positivos de este lanzamiento es que&nbsp;<em>Starfield</em><strong>&nbsp;llega con bastante más contenido que en su estreno original</strong>. Por un lado, tenemos actualizaciones que mejoran la calidad de vida general del juego. Cambios en sistemas, ajustes en la progresión y<strong>&nbsp;mejoras en la interfaz hacen que la experiencia sea más accesible y menos frustrante en algunos puntos clave</strong>. No reinventan el juego, pero sí lo afinan.</p><p class=\"ql-align-justify\">Por otro lado,&nbsp;<strong>también se incluyen expansiones que amplían el contenido narrativo y jugable</strong>. Nuevas misiones, más contexto dentro del universo y contenido adicional que alarga la vida útil del título. Eso sí,<strong>&nbsp;conviene dejar algo claro: esto sigue siendo&nbsp;<em>Starfield</em></strong>. Si en su momento no te convenció su estructura, su ritmo o su forma de plantear la exploración, estas mejoras no cambian la base. La hacen mejor, sí, pero no diferente.</p><p class=\"ql-align-justify\">El último DLC de&nbsp;<em>Starfield</em>, conocido como<strong>&nbsp;<em>Terran Armada</em>, está claramente enfocada a jugadores que ya han avanzado bastante en el juego base</strong>. No es un contenido pensado para empezar desde cero, sino más bien para ampliar la experiencia cuando ya has visto gran parte de lo que ofrece el universo principal.</p><p class=\"ql-align-justify\">A nivel narrativo,&nbsp;<strong>introduce una nueva amenaza en forma de facción militarizada con un enfoque más agresivo y tecnológico</strong>. Esto se traduce en una historia con más peso en el conflicto directo, dejando un poco de lado la exploración más pausada para apostar por una narrativa más intensa y centrada en la acción.&nbsp;<strong>Las misiones tienen más continuidad entre sí y buscan dar sensación de campaña más estructurada</strong>.</p><p class=\"ql-align-justify\">En lo jugable, se nota un aumento en la dificultad.&nbsp;<strong>Los enfrentamientos son más exigentes y obligan a aprovechar mejor el equipo, las habilidades y la preparación previa</strong>. También se añaden nuevas armas, mejoras tecnológicas y contenido que amplía las opciones de personalización, especialmente en fases avanzadas del juego. Eso sí, no cambia la base de&nbsp;<em>Starfield</em>. Es una expansión que suma más de lo mismo, pero mejor enfocado hacia el combate y el contenido&nbsp;<em>endgame</em>.&nbsp;<strong>Funciona bien como incentivo para seguir jugando, aunque no redefine la experiencia</strong>.</p><h2>Conclusiones finales | Análisis de Starfield en PS5</h2><iframe class=\"ql-video\" frameborder=\"0\" allowfullscreen=\"true\" src=\"https://www.youtube.com/embed/WhfHnKmcXAE?feature=oembed\" height=\"360\" width=\"640\"></iframe><p><br></p><p>Análisis de Starfield en PS5</p><p><br></p><p class=\"ql-align-justify\">La llegada de&nbsp;<em>Starfield</em>&nbsp;a PS5 es importante, pero no definitiva.&nbsp;<strong>Es una versión más completa en contenido, con mejoras evidentes en PS5 Pro</strong>&nbsp;(donde además se nota que ya han pasado tres años mejorando el título) y una base que sigue siendo interesante si te gusta el estilo Bethesda.</p><p class=\"ql-align-justify\">Sin embargo,&nbsp;<strong>también es una versión que arrastra problemas técnicos que no deberían estar tan presentes a estas alturas.</strong>&nbsp;El rendimiento irregular, los fallos de estabilidad y las limitaciones del motor pesan más de lo que deberían en un juego de este calibre.</p><p class=\"ql-align-justify\">Por suerte,&nbsp;<strong>también llega con muchísimo contenido nuevo que no estaba en el original, por lo que sería totalmente injusto no calificarlo como una versión mejor</strong>. Además, tenemos la promesa de&nbsp;<a href=\"https://bethesda.net/es-ES\" rel=\"noopener noreferrer\" target=\"_blank\" style=\"color: rgb(255, 255, 255); background-color: transparent;\">Bethesda&nbsp;</a>de mejorar el juego, y si bien sabemos que sus juegos suelen llegar con problemas,&nbsp;<strong>también somos conscientes de que acaban por solucionarlos</strong>.</p><p><img src=\"https://freakelitex.com/wp-content/uploads/2023/07/Muy-Notable.png\" height=\"100\" width=\"284\"></p><p><img src=\"https://freakelitex.com/wp-content/uploads/2025/07/Lo-que-mas-nos-ha-gustado-v2.jpg\" height=\"75\" width=\"1980\"></p><ul><li class=\"ql-align-justify\">Un universo enorme, con muchas posibilidades y contenido</li><li class=\"ql-align-justify\">Mejoras de calidad de vida que hacen la experiencia más llevadera</li><li class=\"ql-align-justify\">PS5 Pro ofrece más opciones y mejor rendimiento en condiciones ideales</li></ul><p><img src=\"https://freakelitex.com/wp-content/uploads/2025/07/Lo-que-menos-nos-ha-gustado-v2.jpg\" height=\"75\" width=\"1980\"></p><ul><li class=\"ql-align-justify\">Problemas de estabilidad que afectan a la experiencia</li><li class=\"ql-align-justify\">Rendimiento inconsistente, especialmente en modo rendimiento</li><li class=\"ql-align-justify\">Limitaciones técnicas del motor que siguen muy presentes</li></ul><p><br></p>', '2026-04-20 11:10:17', 'Antonio Flor', 9, 'articulo'),
(27, 'Trails in the Sky 2nd Chapter confirma su fecha de lanzamiento y mucha información nueva', 'Trails in the Sky 2nd Chapter confirma fecha de lanzamiento en español y nuevos detalles de cara a su lanzamiento este otoño.\r\n', 'imagenes/Trails-in-the-Sky-2nd-fecha-a.jpg', '<p class=\"ql-align-justify\"><strong><em>Trails in the Sky 2nd Chapter</em>&nbsp;</strong>ya tiene<strong>&nbsp;fecha de lanzamiento</strong>, y confirma algo que muchos esperaban: la continuación llega antes de lo que parecía. Hay sagas que viven del hype… y luego está&nbsp;<em>The Legend of Heroes</em>, que directamente sigue construyendo su legado capítulo a capítulo.</p><p class=\"ql-align-justify\">El remake del segundo capítulo&nbsp;<strong>se lanzará el próximo 17 de septiembre de 2026</strong>, encajando perfectamente con la estrategia de Falcom de mantener el ritmo tras el primer juego. No es casualidad:&nbsp;<strong>este proyecto forma parte de una reconstrucción completa de la trilogía original</strong>, pensada tanto para nuevos jugadores como para quienes llevan años siguiendo la saga.</p><p class=\"ql-align-justify\"><br></p><h2><em>Trails in the Sky 2nd Chapter</em>&nbsp;ya tiene fecha para continuar con la historia de Stella</h2><p><br></p><iframe class=\"ql-video\" frameborder=\"0\" allowfullscreen=\"true\" src=\"https://www.youtube.com/embed/hkII_nSxzkc?feature=oembed\" height=\"360\" width=\"640\"></iframe><p><br></p><p class=\"ql-align-justify\"><br></p><p class=\"ql-align-justify\">Y ojo, porque aquí no estamos hablando de una simple revisión.<strong>&nbsp;<em>2nd Chapter</em>&nbsp;sigue la línea del remake del primero, apostando por un rediseño en 3D</strong>, mejoras en el sistema de combate y una presentación mucho más actual. La idea es clara: modernizar la experiencia sin perder la esencia que convirtió a la saga en un referente dentro del JRPG.</p><p class=\"ql-align-justify\">A nivel narrativo, esto ya son palabras mayores. La historia retoma directamente los eventos del primer capítulo,<strong>&nbsp;pero sube el tono en todos los sentidos</strong>. El viaje de Estelle se vuelve más personal, más intenso, mientras el trasfondo político y las grandes amenazas empiezan a ocupar el centro del escenario. Es el punto donde la saga deja de presentarse… y empieza a desarrollar todo su potencial.</p><p class=\"ql-align-justify\"><br></p><p><img src=\"https://freakelitex.com/wp-content/uploads/2026/04/Trails-in-the-Sky-2nd-Chapter-ya-tiene-fecha-para-continuar-con-la-historia-de-Stella.png\" height=\"326\" width=\"580\"></p><p><br></p><p><em><span class=\"ql-cursor\">﻿</span>Trails in the Sky 2nd Chapter</em>&nbsp;ya tiene fecha para continuar con la historia de Stella</p><p class=\"ql-align-justify\">En cuanto a plataformas,<strong>&nbsp;el juego llegará a PS5, Nintendo Switch, Switch 2 y PC, con lanzamiento global simultáneo</strong>. Un movimiento que refuerza la intención de abrir la saga a un público más amplio sin perder a los fans de siempre. Solo estará disponible en formato físico para PS5 y Swtich 2, quedando la primera híbrida fuera del plano de lanzamiento.</p><p><br></p>', '2026-04-20 11:50:32', 'Antonio Flor', NULL, 'noticia');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `articulo_subcategoria`
--

CREATE TABLE `articulo_subcategoria` (
  `id_articulo` int(11) NOT NULL,
  `id_subcategoria` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_general_ci;

--
-- Volcado de datos para la tabla `articulo_subcategoria`
--

INSERT INTO `articulo_subcategoria` (`id_articulo`, `id_subcategoria`) VALUES
(19, 1),
(19, 2),
(19, 3),
(19, 4),
(19, 5),
(19, 6),
(20, 1),
(20, 2),
(20, 6),
(21, 1),
(21, 2),
(21, 4),
(21, 5),
(21, 6),
(22, 1),
(22, 5),
(23, 1),
(23, 3),
(23, 6),
(24, 6),
(25, 4),
(25, 5),
(25, 6),
(26, 1),
(26, 3),
(26, 6),
(27, 1),
(27, 5),
(27, 6);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `comentarios`
--

CREATE TABLE `comentarios` (
  `id` int(11) NOT NULL,
  `id_articulo` int(11) NOT NULL,
  `autor` varchar(100) DEFAULT NULL,
  `contenido` text NOT NULL,
  `fecha` timestamp NOT NULL DEFAULT current_timestamp(),
  `id_usuario` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_general_ci;

--
-- Volcado de datos para la tabla `comentarios`
--

INSERT INTO `comentarios` (`id`, `id_articulo`, `autor`, `contenido`, `fecha`, `id_usuario`) VALUES
(2, 27, 'Antonio Flor', 'cuarta prueba', '2026-04-24 16:22:06', NULL),
(3, 27, 'Antonio Flor', 'quinta prueba', '2026-04-24 16:22:16', NULL),
(5, 27, NULL, 'Perfecto!\r\n', '2026-04-24 16:28:46', 1);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `lanzamientos`
--

CREATE TABLE `lanzamientos` (
  `id` int(10) UNSIGNED NOT NULL,
  `titulo` varchar(255) NOT NULL,
  `plataforma` varchar(100) NOT NULL,
  `desarrolladora` varchar(150) DEFAULT NULL,
  `genero` varchar(100) DEFAULT NULL,
  `fecha_lanzamiento` date NOT NULL,
  `comprar` varchar(255) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Volcado de datos para la tabla `lanzamientos`
--

INSERT INTO `lanzamientos` (`id`, `titulo`, `plataforma`, `desarrolladora`, `genero`, `fecha_lanzamiento`, `comprar`) VALUES
(2, 'Dragon Quest VII Reimagined', 'PS4,PS5,Xbox Series,Nintendo Switch,Nintendo Switch 2,PC', 'Square Enix', 'RPG', '2026-02-05', 'https://www.game.es/videojuegos/rol/playstation-5/dragon-quest-vii-reimagined/251068'),
(3, 'Nioh 3', 'PS5,PC', 'Koei Tecmo', 'RPG', '2026-02-06', 'https://www.game.es/nioh-3-launch-edition-playstation-5-252323'),
(4, 'Pokémon Pokopia', 'Nintendo Switch 2', 'Nintendo', 'Simulación', '2026-03-05', 'https://www.game.es/pokemon-pokopia-nintendo-switch-2-253592'),
(5, 'Mario Tennis Fever', 'Nintendo Switch 2', 'Nintendo', 'Deportes', '2026-02-12', 'https://www.game.es/mario-tennis-fever-nintendo-switch-2-251057'),
(6, 'Saros', 'PS5', 'Housemarket', 'Roguelite', '2026-04-30', 'https://www.game.es/videojuegos/accion/playstation-5/saros/254933'),
(7, 'Yoshi and the Mysterious Book', 'Nintendo Switch 2', 'Nintendo', 'Plataformas', '2026-05-21', 'https://www.game.es/videojuegos/aventura/nintendo-switch-2/yoshi-and-the-mysterious-book/258399'),
(8, 'Starfield', 'PS5,Xbox Series,PC', 'Bethesda', 'Acción', '2026-05-02', 'https://www.game.es/videojuegos/rol/playstation-5/starfield-standard-edition/259063'),
(9, 'Outbound', 'PS4,PS5,Nintendo Switch,Nintendo Switch 2', 'Red Alert Games', 'Simulación', '2026-05-14', 'https://www.game.es/videojuegos/aventura/nintendo-switch/outbound/255044'),
(10, 'Tides of Tomorrow', 'PS4,PS5,Xbox Series,PC', 'Digital Art', 'Multijugador', '2026-06-22', 'https://www.game.es/videojuegos/aventura/playstation-5/tides-of-tomorrow/254417'),
(11, 'High On Life 2', 'PS5,Nintendo Switch 2', 'Squach Games', 'Acción', '2026-06-20', 'https://www.game.es/videojuegos/accion/playstation-5/high-on-life-2/254716'),
(12, 'Trails in the Sky 2nd Chapter', 'PS5,Nintendo Switch 2,PC', 'Falcom', 'Rol', '2026-09-07', 'https://www.game.es/videojuegos/rol/nintendo-switch-2/trails-in-the-sky-2nd-chapter/258528');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `subcategorias`
--

CREATE TABLE `subcategorias` (
  `id` int(11) NOT NULL,
  `nombre` varchar(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_general_ci;

--
-- Volcado de datos para la tabla `subcategorias`
--

INSERT INTO `subcategorias` (`id`, `nombre`) VALUES
(1, 'PS5'),
(2, 'PS4'),
(3, 'Xbox Series'),
(4, 'Nintendo Switch'),
(5, 'Nintendo Switch 2'),
(6, 'PC');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `usuarios`
--

CREATE TABLE `usuarios` (
  `id` int(11) NOT NULL,
  `nombre` varchar(100) NOT NULL,
  `email` varchar(100) NOT NULL,
  `password` varchar(255) NOT NULL,
  `fecha_registro` datetime NOT NULL DEFAULT current_timestamp(),
  `rol` varchar(20) NOT NULL DEFAULT 'usuario'
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_general_ci;

--
-- Volcado de datos para la tabla `usuarios`
--

INSERT INTO `usuarios` (`id`, `nombre`, `email`, `password`, `fecha_registro`, `rol`) VALUES
(1, 'Antonio Flor', 'auronartema@gmail.com', '$2y$10$.x71BFEhp45F5gyY6j2I0OeJrSf1Ix/WRrdT1BP65gywxdhxv2Fx.', '2026-01-30 20:02:57', 'administrador'),
(2, 'Sergio', 'lorase92@gmail.com', '$2y$10$ij5lQkGajqEZ/0JLOkacIONV0zQFO/YCiy2nRce7PB22uyZ65MSnm', '2026-01-30 20:12:46', 'redactor'),
(3, 'Usuario Normal', 'auronxiv@gmail.com', '$2y$10$xYMjLDA0oKzOkNExV8f7t.YAYd.LWThXh/YSHiO8WjxoLIgRl7I8S', '2026-02-02 16:28:33', 'usuario');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `valoraciones`
--

CREATE TABLE `valoraciones` (
  `id` int(11) NOT NULL,
  `id_articulo` int(11) NOT NULL,
  `id_usuario` int(11) NOT NULL,
  `valoracion` tinyint(4) NOT NULL CHECK (`valoracion` between 1 and 10),
  `fecha` datetime NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_general_ci;

--
-- Volcado de datos para la tabla `valoraciones`
--

INSERT INTO `valoraciones` (`id`, `id_articulo`, `id_usuario`, `valoracion`, `fecha`) VALUES
(5, 21, 1, 10, '2026-02-03 17:40:56'),
(6, 23, 1, 9, '2026-04-11 10:36:49'),
(7, 26, 1, 9, '2026-04-20 11:51:14');

--
-- Índices para tablas volcadas
--

--
-- Indices de la tabla `articulos`
--
ALTER TABLE `articulos`
  ADD PRIMARY KEY (`id`);

--
-- Indices de la tabla `articulo_subcategoria`
--
ALTER TABLE `articulo_subcategoria`
  ADD PRIMARY KEY (`id_articulo`,`id_subcategoria`),
  ADD KEY `id_subcategoria` (`id_subcategoria`);

--
-- Indices de la tabla `comentarios`
--
ALTER TABLE `comentarios`
  ADD PRIMARY KEY (`id`),
  ADD KEY `id_articulo` (`id_articulo`),
  ADD KEY `id_usuario` (`id_usuario`);

--
-- Indices de la tabla `lanzamientos`
--
ALTER TABLE `lanzamientos`
  ADD PRIMARY KEY (`id`);

--
-- Indices de la tabla `subcategorias`
--
ALTER TABLE `subcategorias`
  ADD PRIMARY KEY (`id`);

--
-- Indices de la tabla `usuarios`
--
ALTER TABLE `usuarios`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `email` (`email`);

--
-- Indices de la tabla `valoraciones`
--
ALTER TABLE `valoraciones`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `unica_valoracion` (`id_articulo`,`id_usuario`),
  ADD KEY `id_usuario` (`id_usuario`);

--
-- AUTO_INCREMENT de las tablas volcadas
--

--
-- AUTO_INCREMENT de la tabla `articulos`
--
ALTER TABLE `articulos`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=28;

--
-- AUTO_INCREMENT de la tabla `comentarios`
--
ALTER TABLE `comentarios`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;

--
-- AUTO_INCREMENT de la tabla `lanzamientos`
--
ALTER TABLE `lanzamientos`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=13;

--
-- AUTO_INCREMENT de la tabla `subcategorias`
--
ALTER TABLE `subcategorias`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT de la tabla `usuarios`
--
ALTER TABLE `usuarios`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT de la tabla `valoraciones`
--
ALTER TABLE `valoraciones`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;

--
-- Restricciones para tablas volcadas
--

--
-- Filtros para la tabla `articulo_subcategoria`
--
ALTER TABLE `articulo_subcategoria`
  ADD CONSTRAINT `articulo_subcategoria_ibfk_1` FOREIGN KEY (`id_articulo`) REFERENCES `articulos` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `articulo_subcategoria_ibfk_2` FOREIGN KEY (`id_subcategoria`) REFERENCES `subcategorias` (`id`) ON DELETE CASCADE;

--
-- Filtros para la tabla `comentarios`
--
ALTER TABLE `comentarios`
  ADD CONSTRAINT `comentarios_ibfk_1` FOREIGN KEY (`id_articulo`) REFERENCES `articulos` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `comentarios_ibfk_2` FOREIGN KEY (`id_usuario`) REFERENCES `usuarios` (`id`);

--
-- Filtros para la tabla `valoraciones`
--
ALTER TABLE `valoraciones`
  ADD CONSTRAINT `valoraciones_ibfk_1` FOREIGN KEY (`id_articulo`) REFERENCES `articulos` (`id`),
  ADD CONSTRAINT `valoraciones_ibfk_2` FOREIGN KEY (`id_usuario`) REFERENCES `usuarios` (`id`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
