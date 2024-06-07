-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Servidor: 127.0.0.1:3306
-- Tiempo de generación: 07-06-2024 a las 19:29:19
-- Versión del servidor: 8.0.35
-- Versión de PHP: 7.4.33

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Base de datos: `quillquest`
--

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `wi_elecciones`
--

DROP TABLE IF EXISTS `wi_elecciones`;
CREATE TABLE IF NOT EXISTS `wi_elecciones` (
  `eleccion_id` int NOT NULL AUTO_INCREMENT,
  `pagina_id` int NOT NULL,
  `texto` varchar(255) NOT NULL,
  `pagina_destino_id` int DEFAULT NULL,
  `historia_id` int NOT NULL,
  PRIMARY KEY (`eleccion_id`),
  KEY `pagina_destino_id` (`pagina_destino_id`),
  KEY `wi_elecciones_ibfk_1` (`pagina_id`)
) ENGINE=InnoDB AUTO_INCREMENT=117 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Volcado de datos para la tabla `wi_elecciones`
--

INSERT INTO `wi_elecciones` (`eleccion_id`, `pagina_id`, `texto`, `pagina_destino_id`, `historia_id`) VALUES
(1, 1, 'Escuchar el plan para desencadenar el fin del mundo.', 2, 29),
(2, 2, 'Preguntas más sobre el ritual y qué papel jugarías en él.', 3, 29),
(3, 3, 'Seguirle el juego al líder.', 4, 29),
(4, 4, 'Escabullirse durante los preparativos.', 5, 29),
(5, 5, '¡Huir!', 10, 29),
(6, 3, 'Están locos. Te enfrentas a él y a sus seguidores, dispuesto a luchar por salir de allí.', 11, 29),
(7, 4, 'Recitar el conjuro.', 12, 29),
(32, 41, 'Buscar la lista en su bolsillo.', 42, 35),
(33, 41, 'Intentar recordar lo que necesitaba.', 43, 35),
(34, 42, 'Revisar otros bolsillos.', 44, 35),
(35, 44, 'Decidirse a comprar lo básico y esperar no olvidar nada importante.', 45, 35),
(36, 45, 'Aceptar su destino y pagar todo en la caja.', 46, 35),
(37, 45, 'Intentar devolver algunos productos.', 47, 35),
(61, 76, 'Sofía acepta la oferta y se sienta con él.', 77, 41),
(62, 76, 'Sofía se disculpa y se va rápidamente.', 78, 41),
(63, 77, 'Sofía acepta la invitación.', 79, 41),
(64, 78, 'Sofía se acerca y se disculpa de nuevo.', 80, 41),
(65, 79, 'Sofía también siente algo especial y deciden seguir conociéndose.', 81, 41),
(66, 80, 'Sofía acepta la invitación.', 82, 41),
(67, 83, 'Entrar por la puerta principal.', 84, 42),
(68, 83, 'Buscar una entrada lateral.', 85, 42),
(69, 84, 'Continuar avanzando por el pasillo', 86, 42),
(70, 85, 'Decidir explorar la entrada lateral.', 87, 42),
(71, 86, 'Investigar los objetos en la habitación.', 88, 42),
(72, 87, 'Decidir explorar el pasadizo.', 89, 42),
(73, 90, 'Revisar los sistemas de navegación. ', 91, 43),
(74, 90, 'Repasar los protocolos de seguridad.', 92, 43),
(75, 91, 'Activar el motor de propulsión.', 93, 43),
(76, 92, 'Realizar un simulacro de evacuación.', 94, 43),
(77, 93, 'Activar los sensores de exploración.', 95, 43),
(78, 94, 'Intentar reparar el sistema dañado.', 96, 43),
(79, 95, 'Descender a la superficie de un planeta desconocido.', 97, 43),
(80, 96, 'Intentar comunicarse con la Tierra para pedir ayuda.', 98, 43),
(81, 99, 'Recoger a un cliente en una zona peligrosa.', 100, 44),
(82, 100, 'Aceptar el encargo.', 101, 44),
(83, 101, 'Huir de los perseguidores por los callejones.', 102, 44),
(84, 102, 'Investigar las intenciones del pasajero.', 103, 44),
(85, 103, 'Ayudar al pasajero a escapar de la ciudad.', 104, 44),
(90, 110, 'Deciden seguir el camino principal.', 111, 46),
(91, 110, 'Optan por tomar un sendero menos transitado.', 112, 46),
(92, 111, 'Deciden continuar con precaución.', 113, 46),
(93, 111, 'Optan por regresar por donde vinieron.', 114, 46),
(94, 112, 'Deciden seguir adelante a pesar del miedo.', 115, 46),
(95, 112, 'Optan por dar la vuelta y buscar el camino principal.', 116, 46),
(96, 113, 'Deciden investigar los sonidos.', 117, 46),
(97, 113, 'Optan por huir en busca de seguridad.', 118, 46),
(98, 114, 'Deciden buscar una ruta alternativa.', 119, 46),
(99, 115, 'Deciden seguir hacia la izquierda.', 120, 46),
(100, 115, 'Optan por ir hacia la derecha.', 121, 46),
(101, 116, 'Deciden seguir adelante con precaución.', 122, 46),
(102, 117, 'Deciden enfrentarse a la amenaza.', 123, 46),
(103, 118, 'Deciden continuar corriendo.', 124, 46),
(104, 119, 'Deciden continuar explorando.', 125, 46),
(105, 120, 'Deciden continuar explorando.', 126, 46),
(106, 121, 'Deciden retroceder y tomar otro camino.', 127, 46),
(107, 122, 'Deciden avanzar con cautela.', 128, 46),
(112, 134, 'Va a la 2', 135, 51),
(113, 135, 'Va a la 3', 136, 51),
(114, 135, 'Esta a la 4', 137, 51),
(115, 136, 'a la 5', 138, 51);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `wi_generos`
--

DROP TABLE IF EXISTS `wi_generos`;
CREATE TABLE IF NOT EXISTS `wi_generos` (
  `genero_id` int NOT NULL AUTO_INCREMENT,
  `nombre_genero` varchar(40) NOT NULL,
  PRIMARY KEY (`genero_id`)
) ENGINE=InnoDB AUTO_INCREMENT=12 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Volcado de datos para la tabla `wi_generos`
--

INSERT INTO `wi_generos` (`genero_id`, `nombre_genero`) VALUES
(1, 'Aventura'),
(2, 'Ciencia Ficción'),
(3, 'Humor'),
(4, 'Romance'),
(5, 'Suspense'),
(6, 'Misterio'),
(7, 'Terror'),
(8, 'Fantasía'),
(9, 'Drama'),
(10, 'Novela Negra'),
(11, 'Histórico');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `wi_historias`
--

DROP TABLE IF EXISTS `wi_historias`;
CREATE TABLE IF NOT EXISTS `wi_historias` (
  `historia_id` int NOT NULL AUTO_INCREMENT,
  `historia_genero_id` int NOT NULL,
  `titulo` varchar(255) NOT NULL,
  `portada` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_0900_ai_ci DEFAULT NULL,
  `sinopsis` varchar(500) CHARACTER SET utf8mb4 COLLATE utf8mb4_0900_ai_ci NOT NULL,
  `autor_id` int NOT NULL,
  `visible` int DEFAULT '0' COMMENT '1: visible, 0:invisible',
  PRIMARY KEY (`historia_id`)
) ENGINE=InnoDB AUTO_INCREMENT=55 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Volcado de datos para la tabla `wi_historias`
--

INSERT INTO `wi_historias` (`historia_id`, `historia_genero_id`, `titulo`, `portada`, `sinopsis`, `autor_id`, `visible`) VALUES
(29, 6, 'El Diario De Jack Walters', 'images/portadas/portada_29.jpg', 'Mi nombre es Jack Walters y soy un investigador privado. Todo empezó una noche de 1915, con la llamada del inspector Armstrong. Un grupo de tarados armados se había atrincherado en una mansión y se negaban a salir. Llevaban tiempo asustando a los habitantes del lugar con sus conductas y extraños ritos. Según el inspector, el líder de la secta quería hablar conmigo, Jack Walters y se negaba a negociar.', 1, 1),
(35, 3, 'La Aventura del Despistado en el Supermercado', 'images/portadas/portada_35.jpg', 'Juan es un hombre muy despistado que se olvida la lista de compras en casa al ir al supermercado. A partir de ahí, se enfrenta a decisiones cómicas y situaciones inesperadas mientras intenta recordar lo que necesita comprar. ¿Podrá salir del supermercado con lo necesario o su torpeza lo meterá en más líos? Acompaña a Juan en esta divertida aventura llena de humor.', 1, 1),
(41, 4, 'Un Encuentro Inesperado', 'images/portadas/portada_41.jpg', 'Sofía, una joven que ha perdido la fe en el amor, se encuentra por casualidad con un misterioso desconocido en un café. A partir de este encuentro, su vida se llena de momentos inesperados y decisiones importantes que la llevarán a descubrir si el amor verdadero realmente existe. Acompaña a Sofía en su búsqueda del amor en esta emotiva historia romántica.', 1, 1),
(42, 7, 'La Casa Abandonada', 'images/portadas/portada_42.jpg', 'En \"La Casa Abandonada\", un grupo de amigos intrépidos se aventura a explorar una casa antigua y desolada en las afueras del pueblo. Lo que comienza como una aventura emocionante pronto se convierte en una experiencia aterradora cuando descubren oscuros secretos que acechan en las sombras de la vieja mansión. Prepárate para adentrarte en el misterio y el horror en esta escalofriante historia.', 1, 1),
(43, 2, 'El Viaje Interestelar', 'images/portadas/portada_43.jpg', 'En \"El Viaje Interestelar\", un grupo de astronautas se embarca en una misión pionera para explorar un sistema solar lejano en busca de vida extraterrestre. A medida que se adentran en lo desconocido, descubren secretos fascinantes y peligros inesperados que desafían su comprensión del universo. Únete a ellos en este emocionante viaje a las estrellas y más allá.', 1, 1),
(44, 2, 'Neón', 'images/portadas/portada_44.jpg', 'En \"Neón\", seguimos a Luna, una audaz y talentosa taxista en una ciudad cyberpunk futurista dominada por la tecnología y la corrupción. Luna se enfrenta a desafíos diarios mientras navega por las peligrosas calles de la metrópolis, transportando a clientes de todo tipo, desde ejecutivos corporativos hasta criminales de alto nivel. Acompaña a Luna en sus viajes nocturnos a través de un paisaje urbano iluminado por luces de neón y plagado de secretos oscuros.', 1, 1),
(45, 8, 'El Reino Perdido', 'images/portadas/portada_45.jpg', 'En busca de aventura, la intrépida exploradora Elena se aventura en una expedición para encontrar el legendario Reino Perdido, un lugar lleno de misterios y peligros. Acompaña a Elena en su viaje a través de tierras desconocidas y descubre qué secretos aguardan en este antiguo reino olvidado.', 1, 1),
(46, 7, 'La Pesadilla en el Bosque', 'images/portadas/portada_46.jpg', 'Un grupo de excursionistas se aventura en un espeso bosque en busca de emociones y nuevas experiencias. Sin embargo, lo que comienza como una simple caminata se convierte en una lucha por sobrevivir cuando se encuentran atrapados en medio del bosque, perseguidos por algo que acecha en la oscuridad.', 1, 1),
(51, 11, 'Historia de prueba', 'images/portadas/portada_51.jpg', 'Historia creada para hacer varias pruebas', 5, 1);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `wi_paginas`
--

DROP TABLE IF EXISTS `wi_paginas`;
CREATE TABLE IF NOT EXISTS `wi_paginas` (
  `pagina_id` int NOT NULL AUTO_INCREMENT,
  `historia_id` int NOT NULL,
  `contenido` text NOT NULL,
  PRIMARY KEY (`pagina_id`),
  KEY `wi_paginas_ibfk_1` (`historia_id`)
) ENGINE=InnoDB AUTO_INCREMENT=141 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Volcado de datos para la tabla `wi_paginas`
--

INSERT INTO `wi_paginas` (`pagina_id`, `historia_id`, `contenido`) VALUES
(1, 29, 'Decides aceptar la llamada del inspector y dirigirte a la casa de la secta. Al llegar, te reciben con hostilidad, pero el líder de la secta te invita a pasar. Te cuenta que tienen un plan para desencadenar el fin del mundo y que necesitan tu ayuda para completarlo.'),
(2, 29, 'Te sientas en una silla delante del líder de la secta, que comienza a explicarte su plan. Dice que han descubierto un antiguo ritual que puede desatar una gran catástrofe que destruirá el mundo actual y dará lugar a un nuevo orden. Te muestra unos documentos antiguos y te habla de la importancia de tu participación en el ritual.'),
(3, 29, 'El líder de la secta te explica que el ritual requiere de una persona con ciertas características especiales, y que tú encajas perfectamente en ese perfil. Te muestra un antiguo manuscrito y te explica que debes leer un conjuro en un momento preciso del ritual para que este tenga éxito.'),
(4, 29, 'El líder de la secta sonríe satisfecho y te dice: \"Excelente elección. Vamos a comenzar de inmediato\". Te toma del brazo y te conduce hacia una puerta oculta detrás de una librería. La puerta se abre con un crujido y te lleva a un sótano oscuro y húmedo.\n\nEn el centro del sótano, ves una mesa con objetos extraños y un libro abierto. El líder de la secta te indica que te acerques a la mesa y comiences a leer el conjuro. Sientes un escalofrío en la espalda al ver los objetos y el ambiente sombrío.'),
(5, 29, 'Aprovechas la distracción del líder y te deslizas por entre los seguidores hasta que encuentras una biblioteca llena de libros antiguos y documentos. Encuentras un documento que describe el propósito del ritual y los riesgos que implica.'),
(10, 29, 'Te mueves sigilosamente por los pasillos oscuros y logras llegar a la entrada principal sin ser detectado. Abre la puerta y sales corriendo hacia tu coche, donde guardas los documentos y te alejas de la mansión lo más rápido posible.\n\nEn un momento de calma, echas un breve vistazo a los documentos para descubrir que se trata del diario de Jack Walters y sus estudios para causar el caos mundial.'),
(11, 29, 'El líder de la secta sonríe y hace un gesto con la mano. Sus seguidores se acercan a ti, con una mirada fanática en sus ojos. Te rodean y te sujetan con fuerza.\r\n\r\n\"Lo siento\", dice el líder de la secta. \"Pero eres demasiado importante para nuestro ritual. No podemos permitir que te vayas\".\r\n\r\nTe forcejeas, pero eres superado en número. Te golpean y te drogan, y todo se vuelve oscuro.\r\n\r\nFIN\r\n\r\nHas sido secuestrado por la secta y ahora eres prisionero. No sabes qué les deparará el futuro, pero sabes que debes encontrar una manera de escapar antes de que sea demasiado tarde.'),
(12, 29, 'Los sectarios comienzan a recitar palabras antiguas y a realizar gestos extraños. La habitación comienza a distorsionarse y a deformarse, y sientes una energía oscura y palpable en el aire.\r\n\r\nDe repente, una figura emerge de la oscuridad: Cthulhu, el Gran Anciano. Su rostro es una masa de tentáculos y ojos que te observan con una inteligencia maligna.\r\n\r\nCthulhu habla en una voz que es como un trueno en tu mente, y te dice que eres suyo, que eres el instrumento de su regreso al mundo. La habitación comienza a desaparecer, y tú te sientes siendo arrastrado hacia el abismo.\r\n\r\nFIN\r\n\r\nHas sellado tu destino, y el del mundo. Cthulhu ha regresado, y la humanidad está condenada.'),
(41, 35, 'Era un día como cualquier otro, y Juan decidió ir al supermercado. Al llegar, se dio cuenta de que había olvidado la lista de compras.'),
(42, 35, 'Juan metió la mano en su bolsillo y encontró... ¡un calcetín viejo! Definitivamente, no era la lista de compras.'),
(43, 35, 'Juan cerró los ojos y trató de recordar. Necesitaba... ¿leche? ¿pan? ¿papel higiénico? Todo parecía confuso.\nHabías más probabilidades de acertar comprando cosas al azar. Así que se llevó hasta el carro de la compra\n\nFIN'),
(44, 35, 'En su búsqueda desesperada, Juan revisó cada rincón de sus bolsillos y finalmente encontró la lista... ¡del año pasado! No serviría de mucho.'),
(45, 35, 'Juan se armó de valor y empezó a improvisar. Terminó comprando cosas que no necesitaba y olvidando las más importantes. Fue un caos.'),
(46, 35, 'Juan aceptó su destino, pagó y se fue a casa. Su esposa no paró de reír al ver lo que había comprado.\n\nFIN'),
(47, 35, 'Juan intentó devolver algunos productos, pero al final terminó llevándose más cosas que antes. Fue un desastre total.\n\nFIN'),
(76, 41, 'Sofía entra en su café favorito y accidentalmente derrama su café sobre un desconocido. El hombre, sorprendentemente amable, le sonríe y le ofrece comprarle otro café.'),
(77, 41, 'Sofía y el desconocido, cuyo nombre es Carlos, conversan y descubren que tienen muchas cosas en común. Carlos la invita a una exposición de arte.'),
(78, 41, 'Sofía se siente mal por haber huido y decide dar un paseo por el parque para despejar su mente. Allí, se vuelve a encontrar con Carlos, quien está paseando a su perro.'),
(79, 41, 'Sofía y Carlos disfrutan de la exposición de arte. Durante la visita, Carlos le confiesa a Sofía que siente una conexión especial con ella.'),
(80, 41, 'Sofía se acerca a Carlos y se disculpa. Carlos acepta la disculpa y la invita a tomar un café en el parque.'),
(81, 41, 'Sofía y Carlos continúan conociéndose y empiezan una relación llena de amor y complicidad. Sofía redescubre el amor verdadero.'),
(82, 41, ' Sofía y Carlos pasan una tarde maravillosa en el parque, hablando y conociéndose mejor. Ambos sienten una fuerte conexión y deciden seguir viéndose y ver hacia dónde les lleva su relación.'),
(83, 42, 'El grupo de amigos llega a la casa abandonada, sintiendo una mezcla de emoción y temor.'),
(84, 42, 'El grupo se adentra en un pasillo oscuro, iluminando el camino con linternas temblorosas.'),
(85, 42, 'Los amigos encuentran una entrada lateral, pero esta parece llevar a un área aún más oscura y desconocida.'),
(86, 42, 'El grupo llega a una habitación misteriosa, llena de objetos antiguos y polvorientos.'),
(87, 42, 'La entrada lateral conduce a un pasadizo oculto, donde los amigos sienten una presencia inquietante.'),
(88, 42, 'El grupo hace un escalofriante descubrimiento en la habitación, revelando la verdad siniestra detrás de la casa abandonada.\n\nFIN'),
(89, 42, 'El pasadizo revela secretos aún más oscuros, llevando al grupo a enfrentarse a una presencia maligna que los persigue.\n\nFIN'),
(90, 43, 'El equipo se reúne en la nave espacial y se prepara para partir hacia el sistema solar lejano.'),
(91, 43, 'El equipo revisa los sistemas de navegación y traza el curso hacia el sistema solar objetivo.'),
(92, 43, 'El equipo repasa los protocolos de seguridad en caso de emergencia, preparándose para cualquier eventualidad.'),
(93, 43, 'La nave se adentra en el espacio profundo, enfrentándose a los desafíos del vacío cósmico y la radiación solar.'),
(94, 43, 'Durante el simulacro de evacuación, ocurre una emergencia real que pone a prueba las habilidades del equipo y su capacidad para trabajar juntos.'),
(95, 43, 'La nave llega al sistema solar objetivo y comienza a explorar los planetas en busca de signos de vida extraterrestre.'),
(96, 43, 'El equipo enfrenta una crisis a bordo de la nave y debe tomar decisiones difíciles para garantizar su supervivencia.'),
(97, 43, 'El equipo descubre signos de vida extraterrestre en la superficie del planeta, desencadenando una serie de eventos que cambiarán para siempre su comprensión del universo.\n\nFIN'),
(98, 43, 'El equipo lucha por superar la crisis a bordo de la nave, buscando una solución que les permita regresar a salvo a la Tierra.\n\nFIN'),
(99, 44, 'Luna comienza su turno nocturno como taxista, conduciendo por las concurridas calles de la ciudad cyberpunk.'),
(100, 44, 'Luna recoge a un misterioso pasajero en un callejón oscuro, quien le ofrece una suma considerable de dinero por un viaje rápido a través de la ciudad.'),
(101, 44, 'Luna se embarca en una carrera a toda velocidad a través de la ciudad, evitando a las autoridades y a los peligrosos competidores en el camino.'),
(102, 44, 'Luna y su pasajero encuentran refugio en un oscuro callejón, tratando de evadir a sus perseguidores mientras planean su próximo movimiento.'),
(103, 44, 'Luna descubre la verdadera identidad de su pasajero y se ve envuelta en una conspiración que amenaza con cambiar el equilibrio de poder en la ciudad.'),
(104, 44, 'Luna y su pasajero se embarcan en una peligrosa huida a través de los oscuros callejones y túneles subterráneos de la ciudad, enfrentándose a obstáculos mortales en cada paso del camino.\n\nFIN'),
(105, 45, 'Elena se prepara para su expedición hacia el Reino Perdido, llena de emoción y determinación.'),
(106, 45, ' Elena se encuentra con su guía, un experto conocedor de la zona. Juntos se preparan para adentrarse en las selvas peligrosas que rodean el Reino Perdido.\n\nFIN'),
(107, 45, 'Elena se adentra en las profundidades de la jungla, enfrentándose a desafíos y peligros sin la ayuda de nadie más que su propia determinación.'),
(108, 45, 'Elena descubre una antigua ruina cubierta por la maleza. Mientras explora, encuentra inscripciones antiguas que sugieren la ubicación del Reino Perdido.'),
(109, 45, 'Elena sigue el curso del río, enfrentándose a rápidos y peligros naturales. Pronto se da cuenta de que el río la ha llevado directamente al corazón del Reino Perdido.'),
(110, 46, 'El grupo de excursionistas comienza su caminata por el bosque, entusiasmados por la aventura que les espera.'),
(111, 46, 'Mientras caminan por el sendero principal, el grupo se siente seguro y confiado en su entorno. Sin embargo, pronto descubren que no están solos en el bosque.'),
(112, 46, 'A medida que avanzan por el sendero menos transitado, el bosque se vuelve más oscuro y silencioso. La sensación de ser observados comienza a acechar al grupo.'),
(113, 46, 'En la penumbra del bosque, el grupo comienza a notar movimientos y susurros entre los árboles. La sensación de peligro se intensifica.'),
(114, 46, 'Al volver sobre sus pasos, el grupo se encuentra con un obstáculo inesperado que les impide regresar por el camino por el que vinieron.'),
(115, 46, 'El grupo llega a una encrucijada en el sendero menos transitado. Las sombras parecen moverse a su alrededor, confundiéndolos sobre cuál camino tomar.'),
(116, 46, 'Al regresar al camino principal, el grupo se encuentra con un panorama desolador. El bosque parece haber cambiado, y la sensación de ser observados no desaparece.'),
(117, 46, 'Al acercarse a la fuente de los sonidos, el grupo descubre una presencia oscura y aterradora acechando entre los árboles.'),
(118, 46, 'Corriendo a través del bosque, el grupo se encuentra cara a cara con la criatura que los persigue, una visión de terror que los paraliza de miedo.'),
(119, 46, 'El grupo se aventura por un sendero desconocido en busca de una salida. Sin embargo, cada paso parece llevarlos más profundo en la oscuridad del bosque.'),
(120, 46, 'Al seguir el camino hacia la izquierda, el grupo se adentra en una parte del bosque que parece estar envuelta en una extraña neblina.'),
(121, 46, 'Al seguir el camino hacia la derecha, el grupo se encuentra rodeado de una oscuridad más densa y opresiva, sintiendo que algo siniestro los observa desde las sombras.'),
(122, 46, 'A pesar de la inquietud, el grupo decide seguir adelante por el camino principal, determinado a encontrar una salida del bosque.'),
(123, 46, 'El grupo lucha valientemente contra la criatura en un intento desesperado por sobrevivir y escapar del bosque maldito.\n\nFIN'),
(124, 46, 'La criatura acecha implacablemente al grupo, persiguiéndolos más profundo en la oscuridad del bosque, donde no hay escapatoria.\n\nFIN'),
(125, 46, 'El sendero alternativo conduce al grupo a un lugar aún más siniestro y peligroso dentro del bosque, donde se pierden para siempre en la oscuridad.\n\nFIN'),
(126, 46, 'La neblina se espesa a medida que el grupo avanza, envolviéndolos en una atmósfera de misterio y magia. Las sombras dan forma a criaturas extrañas y los susurros se convierten en voces de ultratumba.\n\nFIN'),
(127, 46, 'Al retroceder por el camino de la derecha, el grupo se encuentra con una presencia siniestra que les bloquea el paso. Se dan cuenta de que no están solos en el bosque.\n\nFIN'),
(128, 46, 'A pesar de las dificultades, el grupo continúa avanzando con la esperanza de encontrar una salida. La determinación y el coraje los guían a través de la oscuridad del bosque.\n\nFIN'),
(134, 51, 'Primera pagina'),
(135, 51, 'Segunda pag'),
(136, 51, '3, penúltima'),
(137, 51, 'Pag4\nFIN'),
(138, 51, 'Pag 5\nFIN');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `wi_users`
--

DROP TABLE IF EXISTS `wi_users`;
CREATE TABLE IF NOT EXISTS `wi_users` (
  `user_id` int UNSIGNED NOT NULL AUTO_INCREMENT,
  `email` varchar(100) NOT NULL,
  `name` varchar(50) NOT NULL,
  `lastname` varchar(50) CHARACTER SET utf8mb3 COLLATE utf8mb3_general_ci DEFAULT NULL,
  `password` varchar(200) NOT NULL,
  `role` int UNSIGNED NOT NULL,
  `active` tinyint UNSIGNED NOT NULL,
  `username` varchar(45) DEFAULT NULL,
  `address` varchar(200) DEFAULT NULL,
  `photo` varchar(200) DEFAULT NULL,
  `phone` varchar(45) DEFAULT NULL,
  `dni` varchar(10) DEFAULT NULL,
  `attempts` tinyint NOT NULL DEFAULT '0',
  `blocked` tinyint UNSIGNED NOT NULL DEFAULT '0',
  `date_created` datetime DEFAULT NULL,
  `date_last_login` datetime DEFAULT NULL,
  `date_last_modify` datetime DEFAULT NULL,
  `created_by` varchar(100) NOT NULL,
  `modify_by` varchar(100) DEFAULT NULL,
  `deleted` tinyint(1) DEFAULT '0',
  `deleted_by` varchar(100) DEFAULT NULL,
  `date_deleted` datetime DEFAULT NULL,
  `who_login` varchar(100) DEFAULT NULL,
  `hash_remember` varchar(250) DEFAULT NULL,
  PRIMARY KEY (`user_id`)
) ENGINE=InnoDB AUTO_INCREMENT=7 DEFAULT CHARSET=utf8mb3 COMMENT='table for all users';

--
-- Volcado de datos para la tabla `wi_users`
--

INSERT INTO `wi_users` (`user_id`, `email`, `name`, `lastname`, `password`, `role`, `active`, `username`, `address`, `photo`, `phone`, `dni`, `attempts`, `blocked`, `date_created`, `date_last_login`, `date_last_modify`, `created_by`, `modify_by`, `deleted`, `deleted_by`, `date_deleted`, `who_login`, `hash_remember`) VALUES
(1, 'g.v.mario96@gmail.com', 'Mario', 'González', '$2y$10$9MLGZDACMM/c9nWAIkqkiunTh6TFf7x/RGOmXIxprKkZxL68lxQnO', 1, 1, NULL, NULL, 'images/panel/usuarios/usuario_1.jpg', NULL, NULL, 0, 0, '2022-11-05 20:43:00', '2024-06-07 21:28:38', NULL, 'g.v.mario96@gmail.com', NULL, 0, NULL, NULL, NULL, NULL),
(5, 'pruebas@quillquest.com', 'Pruebas', NULL, '$2y$10$kV3ClpM7c9Znzu6elqJadOXo.P0EuuH7.kQLe5jYVP7hGlyTtAkSO', 2, 1, NULL, NULL, NULL, NULL, NULL, 1, 0, NULL, '2024-06-07 19:04:14', NULL, 'pruebas', NULL, 0, NULL, NULL, NULL, NULL),
(6, 'manual@quillquest.com', 'Manual', 'Editado', '$2y$10$AXMd/EuavJYkIO/kHTP2h.KdtRXYu9TD4qyUl6/hcXtJyqzL2YGi2', 2, 1, NULL, NULL, 'images/panel/usuarios/usuario_6.png', NULL, NULL, 1, 0, NULL, '2024-06-07 21:20:41', NULL, 'pruebas', NULL, 0, NULL, NULL, NULL, NULL);

--
-- Restricciones para tablas volcadas
--

--
-- Filtros para la tabla `wi_elecciones`
--
ALTER TABLE `wi_elecciones`
  ADD CONSTRAINT `wi_elecciones_ibfk_1` FOREIGN KEY (`pagina_id`) REFERENCES `wi_paginas` (`pagina_id`) ON DELETE CASCADE,
  ADD CONSTRAINT `wi_elecciones_ibfk_2` FOREIGN KEY (`pagina_destino_id`) REFERENCES `wi_paginas` (`pagina_id`);

--
-- Filtros para la tabla `wi_paginas`
--
ALTER TABLE `wi_paginas`
  ADD CONSTRAINT `wi_paginas_ibfk_1` FOREIGN KEY (`historia_id`) REFERENCES `wi_historias` (`historia_id`) ON DELETE CASCADE;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
