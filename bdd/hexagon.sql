-- phpMyAdmin SQL Dump
-- version 4.1.14
-- http://www.phpmyadmin.net
--
-- Client :  127.0.0.1
-- Généré le :  Dim 20 Janvier 2019 à 13:23
-- Version du serveur :  5.6.17
-- Version de PHP :  5.5.12

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8 */;

--
-- Base de données :  `hexagon`
--

-- --------------------------------------------------------

--
-- Structure de la table `aide`
--

CREATE TABLE IF NOT EXISTS `aide` (
  `id_question` int(11) NOT NULL AUTO_INCREMENT,
  `question` varchar(255) NOT NULL,
  `reponse` text NOT NULL,
  PRIMARY KEY (`id_question`)
) ENGINE=MyISAM  DEFAULT CHARSET=latin1 AUTO_INCREMENT=7 ;

--
-- Contenu de la table `aide`
--

INSERT INTO `aide` (`id_question`, `question`, `reponse`) VALUES
(1, 'Comment se déroule l’installation ? Est-il nécessaire de faire des travaux importants ?', 'L’installation ne nécessite pas de travaux. Elle se déroule sur une journée : un technicien se rend dans votre habitation afin d’y placer les capteurs, les passerelles intermédiaires et la passerelle centrale.'),
(2, ' Comment puis-je effectuer des modifications concernant ma maison (exemple : ajout de fonctionnalité) ?', 'A partir de votre espace Ma maison, vous pouvez ajouter des capteurs et des salles facilement.'),
(3, 'Quelles fonctions puis-je contrôler depuis mon compte sur le site web ?', 'Depuis votre page Ma maison, il vous est possible d’accéder, pour chaque pièce de votre habitation, aux informations des capteurs (température, luminosité... ) ainsi qu’à l’historique des données. A partir de ces informations, vous pouvez décider de modifier la température de votre habitation, d''éteindre une lampe…'),
(4, 'Que se passe-t-il en cas de panne ?', 'En cas de panne, nous en sommes avertis et un technicien interviendra dans votre habitation pour résoudre le problème dans les plus bref délais.'),
(5, 'Peut-on permettre l’accès à notre domicile sur le site web à d’autres utilisateurs ?', 'Il vous est possible de créer des accès à votre maison pour des utilisateurs secondaires avec la possibilité d’effectuer des actions différentes des vôtres.'),
(6, ' Comment les installations fonctionnent-elles ?', 'Lorsque vous voulez contrôler votre installation à distance, tous les composants domotiques sont reliés au serveur. Les données sont envoyées à ce serveur et il réalisera l''action à l''instant même dans votre habitation.');

-- --------------------------------------------------------

--
-- Structure de la table `a_propos`
--

CREATE TABLE IF NOT EXISTS `a_propos` (
  `id_a_propos` int(255) NOT NULL AUTO_INCREMENT,
  `description` text NOT NULL,
  PRIMARY KEY (`id_a_propos`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=2 ;

--
-- Contenu de la table `a_propos`
--

INSERT INTO `a_propos` (`id_a_propos`, `description`) VALUES
(1, 'Hexagon est un projet répondant à la demande de Domisep faite à la start-up Dominium (spécialisée en informatique, télécommunications, électronique et traitement du signal) de créer une plate-forme web afin de pouvoir gérer des habitations connectées de particuliers à distance. Grâce à cette plateforme il vous est possible de gérer les équipements domotiques (radiateurs, climatiseurs, volets roulants, alarmes…) de votre résidence principale (et de vos habitations secondaires) en un clic sans déplacement ! Que ce soit pour régler le chauffage, éteindre une lumière oubliée ou sécuriser votre maison … toutes ces actions vous sont rendues possibles et faciles via votre compte. Il vous est même possible de permettre l’accès à votre espace “Ma Maison” avec des fonctionnalités spécifiques à d’autres personnes (membres de votre famille…) en toute simplicité. De plus, notre entreprise vous propose un large choix d''équipement afin de répondre au mieux à votre demande.Vous êtes intéressé par notre installation? Vous avez des questions ? N’hésitez pas à nous contacter. ');

-- --------------------------------------------------------

--
-- Structure de la table `capteurpiece`
--

CREATE TABLE IF NOT EXISTS `capteurpiece` (
  `id_capteur_piece` int(11) NOT NULL AUTO_INCREMENT,
  `id_piece` int(11) NOT NULL,
  `id_capteur_catalogue` int(11) NOT NULL,
  `id_type` int(11) NOT NULL,
  `valeur` int(11) NOT NULL,
  PRIMARY KEY (`id_capteur_piece`),
  KEY `id_piece` (`id_piece`),
  KEY `id_capteur_catalogue` (`id_capteur_catalogue`),
  KEY `id_capteur_catalogue_2` (`id_capteur_catalogue`),
  KEY `id_piece_2` (`id_piece`),
  KEY `id_capteur_catalogue_3` (`id_capteur_catalogue`),
  KEY `id_type` (`id_type`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 COLLATE=utf8_bin AUTO_INCREMENT=68 ;

--
-- Contenu de la table `capteurpiece`
--

INSERT INTO `capteurpiece` (`id_capteur_piece`, `id_piece`, `id_capteur_catalogue`, `id_type`, `valeur`) VALUES
(66, 21, 5, 2, 0),
(67, 21, 5, 6, 0);

-- --------------------------------------------------------

--
-- Structure de la table `catalogue`
--

CREATE TABLE IF NOT EXISTS `catalogue` (
  `id_capteur` int(11) NOT NULL AUTO_INCREMENT,
  `description` text CHARACTER SET utf8 NOT NULL,
  `prix` int(11) NOT NULL,
  `nom` text CHARACTER SET utf8 NOT NULL,
  `photo2` text CHARACTER SET latin1 NOT NULL,
  `reference` int(11) NOT NULL,
  `id_type` int(11) NOT NULL,
  PRIMARY KEY (`id_capteur`),
  KEY `id_type` (`id_type`),
  KEY `id_type_2` (`id_type`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 COLLATE=utf8_bin AUTO_INCREMENT=17 ;

--
-- Contenu de la table `catalogue`
--

INSERT INTO `catalogue` (`id_capteur`, `description`, `prix`, `nom`, `photo2`, `reference`, `id_type`) VALUES
(1, 'Mesure l''intensité lumineuse. Permet la commande à distance de lampes, d''installations d''éclairage, de volets roulants et stores extérieurs.', 80, 'Capteur de luminosité S+S Regeltechnik', 'http://www.ses-automation.fr/_catalogue/_image/PH_1459782538.jpg ', 11001, 1),
(2, 'Allume automatiquement vos lampes ou baisse les volets de la maison en fonction du niveau d''obscurité que vous avez défini.\r\n', 30, 'Détecteur d''obscurité connecté DIO ', 'https://s1.lmcdn.fr/multimedia/944887611/14498584006d4/produits/detecteur-d-obscurite-et-minuterie-connecte-dio.jpg?$p=hi-w98 ', 12001, 1),
(3, 'Vous permet d''allumer ou d''éteindre vos éclairages à distance.\r\n', 28, 'Récepteur et interrupteur connectés pour éclairage DIO ', 'https://s1.lmcdn.fr/multimedia/1d4201843/1560f5b321669/produits/kit-1-recepteur-connecte-pour-eclairage-avec-un-interrupteur-connecte-dio.jpg?$p=hi-w358-h358 \r\n             ', 13001, 1),
(4, 'Affiche l''humidité et la température simultanément et enregistre les valeurs minimales et maximales.\r\nPossède différents modes d''affichage. ', 15, 'Capteur de température et d''humidité ThermoPro TP50', 'https://images-na.ssl-images-amazon.com/images/I/61b4bI8jD-L._SL1000_.jpg ', 21004, 2),
(5, 'Mesure, affiche et enregistre les températures intèrieures ou extèrieures.\r\nPossibilité d''ajouter une sonde d''humidité. Poss_de un historique sur 7 jours.', 74, 'Thermomètre Bluetooth Oregon Scientific EMR 211', 'https://images-na.ssl-images-amazon.com/images/I/41W1S1-H1pL.jpg ', 22005, 2),
(6, 'Mesure le taux d''humidité et la température.\r\nHaute précision', 30, 'Capteur de température et d''humidité Inkbird IBS-TH1', 'https://images-na.ssl-images-amazon.com/images/I/716vRLBc6gL._SL1500_.jpg ', 23006, 2),
(7, 'Allume la lumière ou d''autres objets connectés lorsque vous entrez dans la pièce. A l’intérieur comme à l’extérieur, à placer où vous voulez, sur un meuble ou fixé au mur.\r\nAngle de vue : 120?', 50, 'Capteur de mouvement EVE', 'https://static.fnac-static.com/multimedia/Images/FR/NR/1e/21/81/8462622/1505-1/tsp20180712093901/Capteur-de-mouvement-sans-fil-Elgato-Eve-Motion-Blanc.jpg ', 31007, 3),
(8, 'Détecte les mouvement dans votre habitation.\r\nPortée: 30 m. ', 74, 'Détecteur de mouvement Fibaro', 'https://images-na.ssl-images-amazon.com/images/I/81aypHbV1VL._SL1500_.jpg ', 32008, 3),
(9, 'Détecte les mouvements dans votre habitation par infrarouge. Fonctionne avec piles.', 20, 'Détecteur de mouvement Beewi', 'https://images-na.ssl-images-amazon.com/images/I/714A5dVCEqL._SL1500_.jpg ', 33009, 3),
(10, 'Détecteur de fumée connecté. Fonctionne sur batterie.\r\n', 100, 'Détecteur de fumée Netatmo', 'https://boulanger.scene7.com/is/image/Boulanger/bfr_overlay?layer=comp&$t1=&$product_id=Boulanger/3700730502276_h_f_l_0&wid=350&hei=350', 41010, 4),
(11, 'Détecteur de fumée et de chaleur connecté.', 120, 'Détecteur de fumée Eve', 'https://boulanger.scene7.com/is/image/Boulanger/bfr_overlay?layer=comp&$t1=&$product_id=Boulanger/4260195391574_h_f_l_0&wid=350&hei=350 ', 42011, 4),
(12, 'Détecte les températures élevées et le taux d''humidité afin de vous avertir uniquement en cas de danger.\r\nCapable de reconnaître un véritable incendie.', 129, 'Détecteur de fumée Nest Protect', 'https://images-na.ssl-images-amazon.com/images/I/91mcXTztkNL._SL1500_.jpg', 43011, 4),
(15, 'Récepteurs pour volet roulant reliés à des interrupteurs actionnables à distance.', 70, '3 récepteurs pour volets roulants Dio', 'https://s2.lmcdn.fr/multimedia/b24960954/16e3859492243/produits/lot-de-3-recepteurs-connecte-pour-volets-roulants-dio.jpg?$p=hi-w98 ', 51012, 5),
(16, 'Permet de commander l''ouverture et la fermeture des volets à distance. S''installe derrière votre interrupteur.', 53, 'Boitier micro-module Somfy', 'https://www.expert-domotique.com/841-large_default/somfy-micro-module-pour-volet-roulant-rts-so-2401162-so-1811244-permet-de-rendre-un-volet-roulant-avec-motorisation-filaire-comp.jpg ', 51013, 5);

-- --------------------------------------------------------

--
-- Structure de la table `consignes`
--

CREATE TABLE IF NOT EXISTS `consignes` (
  `id_consignes` int(11) NOT NULL AUTO_INCREMENT,
  `consigne` text NOT NULL,
  PRIMARY KEY (`id_consignes`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=12 ;

--
-- Contenu de la table `consignes`
--

INSERT INTO `consignes` (`id_consignes`, `consigne`) VALUES
(1, 'Aucun chauffage ne doit être allumé entre juillet et août.'),
(2, 'Eteignez vos lumières et vérifiez que le détecteur de mouvement est activé avant de quitter votre domicile.'),
(3, 'Vérifiez la fermeture des volets et de la porte d’entrée avant de partir en vacances.'),
(4, 'Températures idéales : 19°C pour le salon, la salle à manger, la cuisine, le bureau et la salle de bain, entre 16°C et 17°C pour les chambres, 14°C pour les pièces inoccupées. '),
(5, 'En cas d''''absence prolongée baisser le chauffage à 14°C. '),
(6, 'Taux d’humidité idéale dans une maison : entre 40% et 60%.'),
(7, 'Préférez l’utilisation d’ampoules basse consommation pour votre éclairage.'),
(8, 'En cas de dysfonctionnement d’une installation contactez nous rapidement.');

-- --------------------------------------------------------

--
-- Structure de la table `donnees`
--

CREATE TABLE IF NOT EXISTS `donnees` (
  `id_donnees` int(11) NOT NULL AUTO_INCREMENT,
  `valeur` int(11) NOT NULL,
  `ladate` date NOT NULL,
  `heure` time NOT NULL,
  `numero` varchar(11) COLLATE utf8_bin NOT NULL,
  `id_piece` int(11) NOT NULL,
  `id_type` int(11) NOT NULL,
  `id_capteur_piece` int(11) NOT NULL,
  PRIMARY KEY (`id_donnees`),
  KEY `id_capteur_piece` (`numero`),
  KEY `id_piece` (`id_piece`),
  KEY `id_capteur_piece_2` (`numero`),
  KEY `id_type` (`id_type`),
  KEY `id_capteur_piece_3` (`id_capteur_piece`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 COLLATE=utf8_bin AUTO_INCREMENT=105 ;

--
-- Contenu de la table `donnees`
--

INSERT INTO `donnees` (`id_donnees`, `valeur`, `ladate`, `heure`, `numero`, `id_piece`, `id_type`, `id_capteur_piece`) VALUES
(71, 12, '2019-01-17', '20:40:43', '22005', 21, 2, 66),
(73, 70, '2019-01-17', '20:40:43', '22005', 21, 6, 67),
(75, 12, '2019-01-17', '20:46:57', '22005', 21, 2, 66),
(77, 80, '2019-01-17', '20:46:57', '22005', 21, 6, 67),
(79, 12, '2019-01-17', '20:47:23', '22005', 21, 2, 66),
(81, 70, '2019-01-17', '20:47:23', '22005', 21, 6, 67),
(83, 19, '2019-01-17', '20:55:24', '22005', 21, 2, 66),
(84, 50, '2019-01-17', '20:55:24', '22005', 21, 6, 67),
(85, 0, '2019-01-17', '20:55:39', '22005', 21, 2, 66),
(86, 0, '2019-01-17', '20:55:39', '22005', 21, 6, 67),
(87, 0, '2019-01-20', '12:46:10', '22005', 21, 2, 66),
(88, 0, '2019-01-20', '12:46:10', '22005', 21, 6, 67),
(89, 0, '2019-01-20', '12:46:16', '22005', 21, 2, 66),
(90, 30, '2019-01-20', '12:46:16', '22005', 21, 6, 67),
(91, 0, '2019-01-20', '12:49:59', '22005', 21, 2, 66),
(92, 30, '2019-01-20', '12:49:59', '22005', 21, 6, 67),
(93, 0, '2019-01-20', '12:52:01', '22005', 21, 2, 66),
(94, 30, '2019-01-20', '12:52:01', '22005', 21, 6, 67),
(95, 0, '2019-01-20', '12:52:54', '22005', 21, 2, 66),
(96, 30, '2019-01-20', '12:52:54', '22005', 21, 6, 67),
(97, 0, '2019-01-20', '12:56:40', '22005', 21, 2, 66),
(98, 30, '2019-01-20', '12:56:40', '22005', 21, 6, 67),
(99, 0, '2019-01-20', '12:58:31', '22005', 21, 2, 66),
(100, 30, '2019-01-20', '12:58:31', '22005', 21, 6, 67),
(101, 0, '2019-01-20', '12:58:39', '22005', 21, 2, 66),
(102, 30, '2019-01-20', '12:58:39', '22005', 21, 6, 67),
(103, 0, '2019-01-20', '13:04:27', '22005', 21, 2, 66),
(104, 0, '2019-01-20', '13:04:27', '22005', 21, 6, 67);

-- --------------------------------------------------------

--
-- Structure de la table `habitation`
--

CREATE TABLE IF NOT EXISTS `habitation` (
  `id_habitation` int(11) NOT NULL AUTO_INCREMENT,
  `adresse` varchar(255) COLLATE utf8_bin NOT NULL,
  `cp` int(5) NOT NULL,
  `ville` varchar(255) COLLATE utf8_bin NOT NULL,
  `pays` varchar(255) COLLATE utf8_bin NOT NULL,
  `type` varchar(255) COLLATE utf8_bin NOT NULL,
  `id_personne` int(11) NOT NULL,
  `nomhabitation` varchar(255) COLLATE utf8_bin NOT NULL,
  PRIMARY KEY (`id_habitation`),
  KEY `id_personne` (`id_personne`),
  KEY `id_personne_2` (`id_personne`),
  KEY `id_personne_3` (`id_personne`),
  KEY `id_personne_4` (`id_personne`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 COLLATE=utf8_bin AUTO_INCREMENT=31 ;

--
-- Contenu de la table `habitation`
--

INSERT INTO `habitation` (`id_habitation`, `adresse`, `cp`, `ville`, `pays`, `type`, `id_personne`, `nomhabitation`) VALUES
(1, '12 rue de vanves', 97132, 'Issy-les-moulineaux', 'France', 'Principale', 1, ''),
(22, '1 Rue de vanves', 75006, 'Paris', 'France', 'Secondaire', 23, 'MAISON'),
(30, '13 rue des champs', 75006, 'Paris', 'France', 'Principale', 2, 'Maison');

-- --------------------------------------------------------

--
-- Structure de la table `mailvisiteur`
--

CREATE TABLE IF NOT EXISTS `mailvisiteur` (
  `id_mailvisiteur` int(11) NOT NULL AUTO_INCREMENT,
  `mail` varchar(255) COLLATE utf8_bin NOT NULL,
  `contenu` text COLLATE utf8_bin NOT NULL,
  `ladate` date NOT NULL,
  `heure` time NOT NULL,
  `nom` varchar(255) COLLATE utf8_bin NOT NULL,
  `prenom` varchar(255) COLLATE utf8_bin NOT NULL,
  PRIMARY KEY (`id_mailvisiteur`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 COLLATE=utf8_bin AUTO_INCREMENT=4 ;

--
-- Contenu de la table `mailvisiteur`
--

INSERT INTO `mailvisiteur` (`id_mailvisiteur`, `mail`, `contenu`, `ladate`, `heure`, `nom`, `prenom`) VALUES
(3, 'essai@gmail.com', 'Bonjour, j''aimerais en savoir plus sur vos produits.', '2019-01-13', '17:51:40', 'Chantout', 'Pierre');

-- --------------------------------------------------------

--
-- Structure de la table `message`
--

CREATE TABLE IF NOT EXISTS `message` (
  `id_message` int(11) NOT NULL AUTO_INCREMENT,
  `id_expediteur` int(11) NOT NULL,
  `id_destinataire` int(11) NOT NULL,
  `message` text NOT NULL,
  `heure` time NOT NULL,
  `ladate` date NOT NULL,
  `nomexpediteur` varchar(255) NOT NULL,
  `vu` int(11) NOT NULL,
  PRIMARY KEY (`id_message`),
  KEY `id_expediteur` (`id_expediteur`),
  KEY `id_destinataire` (`id_destinataire`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=56 ;

--
-- Contenu de la table `message`
--

INSERT INTO `message` (`id_message`, `id_expediteur`, `id_destinataire`, `message`, `heure`, `ladate`, `nomexpediteur`, `vu`) VALUES
(54, 1, 2, 'Bonjour, comment puis-je vous aider?', '11:19:09', '2019-01-16', 'admin', 1),
(55, 1, 2, 'J''aimerais ajouter un capteur\r\n', '21:05:13', '2019-01-18', 'Client', 1);

-- --------------------------------------------------------

--
-- Structure de la table `messageclient`
--

CREATE TABLE IF NOT EXISTS `messageclient` (
  `id_messageclient` int(11) NOT NULL AUTO_INCREMENT,
  `Nom` varchar(255) NOT NULL,
  `Prenom` varchar(255) NOT NULL,
  `message` text NOT NULL,
  `heure` time NOT NULL,
  `ladate` date NOT NULL,
  `id_destinataire` int(11) NOT NULL,
  `vu` int(11) NOT NULL,
  PRIMARY KEY (`id_messageclient`),
  KEY `id_destinataire` (`id_destinataire`),
  KEY `id_destinataire_2` (`id_destinataire`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=13 ;

--
-- Contenu de la table `messageclient`
--

INSERT INTO `messageclient` (`id_messageclient`, `Nom`, `Prenom`, `message`, `heure`, `ladate`, `id_destinataire`, `vu`) VALUES
(12, 'Rama', 'Hashley', ' bjr', '17:06:19', '2019-01-13', 2, 1);

-- --------------------------------------------------------

--
-- Structure de la table `personne`
--

CREATE TABLE IF NOT EXISTS `personne` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `nom` varchar(255) NOT NULL,
  `prenom` varchar(255) NOT NULL,
  `mdp` text NOT NULL,
  `numero` varchar(20) NOT NULL,
  `mail` varchar(255) NOT NULL,
  `confirmkey` varchar(20) NOT NULL,
  `confirme` int(1) NOT NULL,
  `admin` int(11) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=42 ;

--
-- Contenu de la table `personne`
--

INSERT INTO `personne` (`id`, `nom`, `prenom`, `mdp`, `numero`, `mail`, `confirmkey`, `confirme`, `admin`) VALUES
(1, 'admin', 'admin', 'd033e22ae348aeb5660fc2140aec35850c4da997', '0149545243', 'admin@a.com', '13842702555757', 1, 1),
(2, 'Rama', 'Hashley', '7110eda4d09e062aa5e4a390b0a572ac0d2c0220', '0102030405', 'hashleyjr@gmail.com', '53007857329424', 1, 0),
(23, 'Dupont', 'Jean', '430461ac1b3977c7dd9fe0a6d0d0ff72dd704b2e', '0610738692', 'xhatshoum_r@hotmail.fr', '51794568460641', 1, 0),
(39, 'cc', 'c@c.com', '430461ac1b3977c7dd9fe0a6d0d0ff72dd704b2e', '1144', 'c@c.com', '69797386848892', 0, 0),
(40, 'aaa', 'aaaa', '430461ac1b3977c7dd9fe0a6d0d0ff72dd704b2e', '54', 'a@a.com', '47170209569853', 1, 0);

-- --------------------------------------------------------

--
-- Structure de la table `piece`
--

CREATE TABLE IF NOT EXISTS `piece` (
  `id_piece` int(11) NOT NULL AUTO_INCREMENT,
  `nom` varchar(255) COLLATE utf8_bin NOT NULL,
  `superficie` int(11) NOT NULL,
  `id_habitation` int(11) NOT NULL,
  PRIMARY KEY (`id_piece`),
  KEY `id_habitation` (`id_habitation`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 COLLATE=utf8_bin AUTO_INCREMENT=25 ;

--
-- Contenu de la table `piece`
--

INSERT INTO `piece` (`id_piece`, `nom`, `superficie`, `id_habitation`) VALUES
(21, 'Salon', 20, 30),
(22, 'Salle de bain', 5, 30),
(23, 'Chambre', 20, 30);

-- --------------------------------------------------------

--
-- Structure de la table `recuperation`
--

CREATE TABLE IF NOT EXISTS `recuperation` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `code` int(11) NOT NULL,
  `mail` varchar(255) COLLATE utf8_bin NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 COLLATE=utf8_bin AUTO_INCREMENT=4 ;

--
-- Contenu de la table `recuperation`
--

INSERT INTO `recuperation` (`id`, `code`, `mail`) VALUES
(1, 41260297, 'hexagon@gmail.com');

-- --------------------------------------------------------

--
-- Structure de la table `secondaire`
--

CREATE TABLE IF NOT EXISTS `secondaire` (
  `id_secondaire` int(11) NOT NULL AUTO_INCREMENT,
  `ajoutercapteur` int(11) NOT NULL,
  `visualiser` int(11) NOT NULL,
  `id_principal` int(11) NOT NULL,
  `id_utilisateur_secondaire` int(11) NOT NULL,
  `id_piece` int(11) NOT NULL,
  `modifiervaleur` int(11) NOT NULL,
  `id_habitation` int(11) NOT NULL,
  `supprimercapteur` int(11) NOT NULL,
  PRIMARY KEY (`id_secondaire`),
  KEY `id_piece` (`id_piece`),
  KEY `id_piece_2` (`id_piece`),
  KEY `id_habitation` (`id_habitation`),
  KEY `id_principal` (`id_principal`),
  KEY `id_utilisateur_secondaire` (`id_utilisateur_secondaire`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=40 ;

--
-- Contenu de la table `secondaire`
--

INSERT INTO `secondaire` (`id_secondaire`, `ajoutercapteur`, `visualiser`, `id_principal`, `id_utilisateur_secondaire`, `id_piece`, `modifiervaleur`, `id_habitation`, `supprimercapteur`) VALUES
(32, 1, 1, 2, 40, 21, 0, 30, 0),
(33, 0, 0, 2, 40, 22, 0, 30, 0),
(34, 0, 0, 2, 40, 23, 0, 30, 0);

-- --------------------------------------------------------

--
-- Structure de la table `secondairehab`
--

CREATE TABLE IF NOT EXISTS `secondairehab` (
  `id_secondairehab` int(11) NOT NULL AUTO_INCREMENT,
  `id_principal` int(11) NOT NULL,
  `id_secondaire` int(11) NOT NULL,
  `id_habitation` int(11) NOT NULL,
  PRIMARY KEY (`id_secondairehab`),
  KEY `id_secondaire` (`id_secondaire`),
  KEY `id_principal` (`id_principal`),
  KEY `id_habitation` (`id_habitation`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 COLLATE=utf8_bin AUTO_INCREMENT=24 ;

--
-- Contenu de la table `secondairehab`
--

INSERT INTO `secondairehab` (`id_secondairehab`, `id_principal`, `id_secondaire`, `id_habitation`) VALUES
(22, 2, 40, 30);

-- --------------------------------------------------------

--
-- Structure de la table `type_capteur`
--

CREATE TABLE IF NOT EXISTS `type_capteur` (
  `id_type_capteur` int(11) NOT NULL AUTO_INCREMENT,
  `nom_type_capteur` varchar(255) COLLATE utf8_bin NOT NULL,
  `photo` text COLLATE utf8_bin NOT NULL,
  PRIMARY KEY (`id_type_capteur`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 COLLATE=utf8_bin AUTO_INCREMENT=7 ;

--
-- Contenu de la table `type_capteur`
--

INSERT INTO `type_capteur` (`id_type_capteur`, `nom_type_capteur`, `photo`) VALUES
(1, 'Luminosité', 'https://image.freepik.com/icones-gratuites/symbole-d-39-ampoule-noire_318-60262.jpg'),
(2, 'Température', 'https://encrypted-tbn0.gstatic.com/images?q=tbn:ANd9GcQunrWUy0VQcH_Knq_1O1G9aE9lGL_txsN1lfa83tJSn9nu1_BP'),
(3, 'Mouvement', 'http://www.lucid.fr/files/documents/tech/detection2.jpg'),
(4, 'Fumée\r\n', 'https://www.educol.net/coloriage-detecteur-de-fumee-dm27558.jpg'),
(5, 'Volets', 'https://previews.123rf.com/images/istinatali/istinatali1603/istinatali160300389/59700697-symbole-des-volets-vecteur-fen%C3%AAtre-d-illustration-.jpg'),
(6, 'Humidité', 'https://previews.123rf.com/images/barbaliss/barbaliss1501/barbaliss150100019/35670421-goutte-d-eau-symbole-avec-un-filet-de-d%C3%A9grad%C3%A9-illustration-vectorielle.jpg');

--
-- Contraintes pour les tables exportées
--

--
-- Contraintes pour la table `capteurpiece`
--
ALTER TABLE `capteurpiece`
  ADD CONSTRAINT `capteurpiece_ibfk_1` FOREIGN KEY (`id_piece`) REFERENCES `piece` (`id_piece`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `capteurpiece_ibfk_2` FOREIGN KEY (`id_capteur_catalogue`) REFERENCES `catalogue` (`id_capteur`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `capteurpiece_ibfk_3` FOREIGN KEY (`id_type`) REFERENCES `type_capteur` (`id_type_capteur`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Contraintes pour la table `catalogue`
--
ALTER TABLE `catalogue`
  ADD CONSTRAINT `catalogue_ibfk_1` FOREIGN KEY (`id_type`) REFERENCES `type_capteur` (`id_type_capteur`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Contraintes pour la table `donnees`
--
ALTER TABLE `donnees`
  ADD CONSTRAINT `donnees_ibfk_2` FOREIGN KEY (`id_piece`) REFERENCES `piece` (`id_piece`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `donnees_ibfk_3` FOREIGN KEY (`id_type`) REFERENCES `type_capteur` (`id_type_capteur`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `donnees_ibfk_4` FOREIGN KEY (`id_capteur_piece`) REFERENCES `capteurpiece` (`id_capteur_piece`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Contraintes pour la table `habitation`
--
ALTER TABLE `habitation`
  ADD CONSTRAINT `habitation_ibfk_1` FOREIGN KEY (`id_personne`) REFERENCES `personne` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Contraintes pour la table `message`
--
ALTER TABLE `message`
  ADD CONSTRAINT `message_ibfk_1` FOREIGN KEY (`id_expediteur`) REFERENCES `personne` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `message_ibfk_2` FOREIGN KEY (`id_destinataire`) REFERENCES `personne` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Contraintes pour la table `messageclient`
--
ALTER TABLE `messageclient`
  ADD CONSTRAINT `messageclient_ibfk_1` FOREIGN KEY (`id_destinataire`) REFERENCES `personne` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Contraintes pour la table `piece`
--
ALTER TABLE `piece`
  ADD CONSTRAINT `piece_ibfk_1` FOREIGN KEY (`id_habitation`) REFERENCES `habitation` (`id_habitation`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Contraintes pour la table `secondaire`
--
ALTER TABLE `secondaire`
  ADD CONSTRAINT `secondaire_ibfk_1` FOREIGN KEY (`id_piece`) REFERENCES `piece` (`id_piece`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `secondaire_ibfk_2` FOREIGN KEY (`id_principal`) REFERENCES `personne` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `secondaire_ibfk_3` FOREIGN KEY (`id_utilisateur_secondaire`) REFERENCES `personne` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `secondaire_ibfk_4` FOREIGN KEY (`id_habitation`) REFERENCES `habitation` (`id_habitation`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Contraintes pour la table `secondairehab`
--
ALTER TABLE `secondairehab`
  ADD CONSTRAINT `secondairehab_ibfk_1` FOREIGN KEY (`id_principal`) REFERENCES `personne` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `secondairehab_ibfk_2` FOREIGN KEY (`id_secondaire`) REFERENCES `personne` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `secondairehab_ibfk_3` FOREIGN KEY (`id_habitation`) REFERENCES `habitation` (`id_habitation`) ON DELETE CASCADE ON UPDATE CASCADE;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
