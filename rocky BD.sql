-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Hôte : 127.0.0.1
-- Généré le : jeu. 03 avr. 2025 à 16:24
-- Version du serveur : 10.4.32-MariaDB
-- Version de PHP : 8.2.12

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Base de données : `rushcompta`
--

-- --------------------------------------------------------

--
-- Structure de la table `achats`
--

CREATE TABLE `achats` (
  `id_achats` int(11) NOT NULL,
  `total_achats` decimal(10,0) NOT NULL,
  `reste_achats` int(11) NOT NULL,
  `created_at_achats` timestamp NOT NULL DEFAULT current_timestamp(),
  `updated_a_achats` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Structure de la table `achats_produits`
--

CREATE TABLE `achats_produits` (
  `id_achats_produits` int(11) NOT NULL,
  `id_achats` int(11) NOT NULL,
  `id_produits` int(11) NOT NULL,
  `quantite_achats_produits` int(11) NOT NULL,
  `prix_achats_produits` int(11) NOT NULL,
  `created_at_achats_produits` timestamp NOT NULL DEFAULT current_timestamp(),
  `updated_at_achats_produits` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Structure de la table `ajustements_de_stocks`
--

CREATE TABLE `ajustements_de_stocks` (
  `id_ajustements_de_stocks` int(11) NOT NULL,
  `id_quantite_en_stocks` int(11) NOT NULL,
  `quantite_ajuste_stocks` decimal(10,0) NOT NULL,
  `raison_ajustements_de_stocks` varchar(250) NOT NULL,
  `date_ajustements_de_stocks` date NOT NULL,
  `created_at_ajustements_de_stocks` timestamp NOT NULL DEFAULT current_timestamp(),
  `updated_at_ajustements_de_stocks` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Structure de la table `categorie_produits`
--

CREATE TABLE `categorie_produits` (
  `id_categorie_produits` int(11) NOT NULL,
  `nom_categorie_produits` varchar(250) NOT NULL,
  `created_at_categorie_produits` timestamp NOT NULL DEFAULT current_timestamp(),
  `updated_at_categorie_produits` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Déchargement des données de la table `categorie_produits`
--

INSERT INTO `categorie_produits` (`id_categorie_produits`, `nom_categorie_produits`, `created_at_categorie_produits`, `updated_at_categorie_produits`) VALUES
(1, 'PAPETERIE', '2024-12-31 01:45:05', '2025-01-26 11:13:23'),
(4, 'LIBRAIRIE', '2025-01-25 10:05:14', '2025-01-25 10:05:14'),
(5, 'APPAREIL', '2025-01-25 10:05:40', '2025-01-25 10:05:40'),
(6, 'ENCRE LAZER', '2025-01-25 10:06:43', '2025-01-26 11:14:05'),
(7, 'LIVRES D\'OCCASIONS', '2025-01-25 10:07:48', '2025-01-25 10:08:12'),
(8, 'ENCRE A JET', '2025-01-26 11:14:39', '2025-01-26 11:14:39');

-- --------------------------------------------------------

--
-- Structure de la table `clients`
--

CREATE TABLE `clients` (
  `id_clients` int(11) NOT NULL,
  `nom_clients` varchar(250) NOT NULL,
  `prenom_clients` varchar(250) NOT NULL,
  `tel_clients` int(11) NOT NULL,
  `point_de_fidelite_clients` int(11) NOT NULL,
  `residence_clients` varchar(250) NOT NULL,
  `sexe_clients` varchar(250) NOT NULL,
  `type_clients` varchar(250) NOT NULL,
  `numero_cni_clients` varchar(250) NOT NULL,
  `created_at_clients` timestamp NOT NULL DEFAULT current_timestamp(),
  `updated_at_clients` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Déchargement des données de la table `clients`
--

INSERT INTO `clients` (`id_clients`, `nom_clients`, `prenom_clients`, `tel_clients`, `point_de_fidelite_clients`, `residence_clients`, `sexe_clients`, `type_clients`, `numero_cni_clients`, `created_at_clients`, `updated_at_clients`) VALUES
(1, 'client de', 'passage', 0, 0, '0', '0', '0', '0', '2025-01-26 16:09:21', '2025-01-26 16:09:21'),
(8, 'Mr WAFO', 'SERGES', 690868614, 0, 'EBOLOWA', 'Maculin', 'Grossiste', '0001', '2025-01-25 10:19:40', '2025-01-25 10:19:40'),
(9, 'FRED', 'FRED', 695060899, 0, 'EBOLOWA', 'Maculin', 'Grossiste', '0002', '2025-01-25 10:21:44', '2025-01-25 10:21:44');

-- --------------------------------------------------------

--
-- Structure de la table `dettes_clients`
--

CREATE TABLE `dettes_clients` (
  `id_dettes_clients` int(11) NOT NULL,
  `id_clients` int(11) NOT NULL,
  `id_ventes` int(11) NOT NULL,
  `montant_dettes_clients` decimal(10,0) NOT NULL DEFAULT 0,
  `avance_dettes_clients` float NOT NULL DEFAULT 0,
  `date_dettes_clients` date NOT NULL,
  `note_dettes_clients` varchar(250) NOT NULL,
  `statut_dettes_clients` varchar(250) NOT NULL,
  `created_at_dettes_clients` timestamp NOT NULL DEFAULT current_timestamp(),
  `updated_at_dettes_clients` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Déchargement des données de la table `dettes_clients`
--

INSERT INTO `dettes_clients` (`id_dettes_clients`, `id_clients`, `id_ventes`, `montant_dettes_clients`, `avance_dettes_clients`, `date_dettes_clients`, `note_dettes_clients`, `statut_dettes_clients`, `created_at_dettes_clients`, `updated_at_dettes_clients`) VALUES
(18, 8, 592, 4000, 1000, '2025-02-19', '', '1', '2025-02-19 14:35:23', '2025-02-19 14:35:23'),
(20, 8, 594, 2000, 0, '2025-02-19', '', '1', '2025-02-19 14:38:02', '2025-02-19 14:38:02');

-- --------------------------------------------------------

--
-- Structure de la table `dettes_fournisseurs`
--

CREATE TABLE `dettes_fournisseurs` (
  `id_dettes_fournisseurs` int(11) NOT NULL,
  `id_fournisseurs` int(11) NOT NULL,
  `montant_dettes_fournisseurs` decimal(10,0) NOT NULL,
  `date_dettes_fournisseurs` datetime NOT NULL,
  `note_dettes_fournisseurs` varchar(250) NOT NULL,
  `statut_dettes_fournisseurs` varchar(250) NOT NULL,
  `created_at_dettes_fournisseurs` timestamp NOT NULL DEFAULT current_timestamp(),
  `updated_at_dettes_fournisseurs` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Structure de la table `fournisseurs`
--

CREATE TABLE `fournisseurs` (
  `id_fournisseurs` int(11) NOT NULL,
  `nom_fournisseurs` varchar(250) NOT NULL,
  `tel_fournisseurs` int(11) NOT NULL,
  `residence_fournisseurs` varchar(250) NOT NULL,
  `created_at_fournisseurs` timestamp NOT NULL DEFAULT current_timestamp(),
  `updated_at_fournisseurs` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Déchargement des données de la table `fournisseurs`
--

INSERT INTO `fournisseurs` (`id_fournisseurs`, `nom_fournisseurs`, `tel_fournisseurs`, `residence_fournisseurs`, `created_at_fournisseurs`, `updated_at_fournisseurs`) VALUES
(6, 'ERIMAR', 677889642, 'YAOUNDE', '2025-01-25 10:11:48', '2025-01-25 10:11:48'),
(7, 'Mr EMMA', 691219229, 'YAOUNDE', '2025-01-25 10:13:43', '2025-01-25 10:13:43'),
(8, 'PACHI', 2147483647, 'YAOUNDE', '2025-01-25 10:16:12', '2025-01-25 10:16:12');

-- --------------------------------------------------------

--
-- Structure de la table `historique_transfert`
--

CREATE TABLE `historique_transfert` (
  `id_historique_transfert` int(11) NOT NULL,
  `id_produits` int(11) NOT NULL,
  `quantite_historique_transfert` int(11) NOT NULL,
  `id_stocks` int(11) NOT NULL,
  `de_stock_historique_transfert` int(11) NOT NULL,
  `date_historique_transfert` datetime DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Déchargement des données de la table `historique_transfert`
--

INSERT INTO `historique_transfert` (`id_historique_transfert`, `id_produits`, `quantite_historique_transfert`, `id_stocks`, `de_stock_historique_transfert`, `date_historique_transfert`) VALUES
(13, 134, 1, 4, 3, '2025-02-27 04:56:34'),
(14, 151, 1, 4, 3, '2025-02-27 04:56:34');

-- --------------------------------------------------------

--
-- Structure de la table `paiements_dettes_clients`
--

CREATE TABLE `paiements_dettes_clients` (
  `id_paiements_dettes_clients` int(11) NOT NULL,
  `id_dettes_clients` int(11) NOT NULL,
  `montant_paiements_dettes` decimal(10,0) NOT NULL,
  `date_paiements_dettes` date NOT NULL,
  `note_paiements_dettes_clients` varchar(250) NOT NULL,
  `created_at_paiements_dettes` timestamp NOT NULL DEFAULT current_timestamp(),
  `updated_at_paiements_dettes` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Structure de la table `paiements_dettes_fournisseurs`
--

CREATE TABLE `paiements_dettes_fournisseurs` (
  `id_paiements_dettes_fournisseurs` int(11) NOT NULL,
  `id_dettes_fournisseurs` int(11) NOT NULL,
  `montant_paiements_dettes` decimal(10,0) NOT NULL,
  `date_paiements_dettes_fournisseurs` date NOT NULL,
  `note_paiements_dettes_fournisseurs` varchar(250) NOT NULL,
  `created_at_paiements_dettes_fournisseurs` timestamp NOT NULL DEFAULT current_timestamp(),
  `updated_at_paiements_dettes_fournisseurs` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Structure de la table `personnels`
--

CREATE TABLE `personnels` (
  `id_personnels` int(11) NOT NULL,
  `nom_personnels` varchar(250) NOT NULL,
  `prenom_personnels` varchar(250) NOT NULL,
  `date_de_naissance_personnels` date NOT NULL,
  `poste_personnels` varchar(250) NOT NULL,
  `code_personnels` varchar(250) NOT NULL,
  `tel_personnels` int(11) NOT NULL,
  `email_personnels` varchar(250) NOT NULL,
  `sexe_personnels` varchar(250) NOT NULL,
  `residence_personnels` varchar(250) NOT NULL,
  `image_personnels` varchar(250) NOT NULL,
  `numero_cni_personnels` varchar(250) NOT NULL,
  `photo_verso_personnels` varchar(250) NOT NULL,
  `photo_recto_personnels` varchar(250) NOT NULL,
  `created_at_personnels` timestamp NULL DEFAULT current_timestamp(),
  `updated_at_personnels` timestamp NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Déchargement des données de la table `personnels`
--

INSERT INTO `personnels` (`id_personnels`, `nom_personnels`, `prenom_personnels`, `date_de_naissance_personnels`, `poste_personnels`, `code_personnels`, `tel_personnels`, `email_personnels`, `sexe_personnels`, `residence_personnels`, `image_personnels`, `numero_cni_personnels`, `photo_verso_personnels`, `photo_recto_personnels`, `created_at_personnels`, `updated_at_personnels`) VALUES
(5, 'TEGUE', 'RAYMOND', '1981-01-13', 'Propriétaire', 'P', 696848084, 'raimondtegue02@yahoo.com', 'Maculin', 'Ebolowa', 'assets/images/personnels/photos/6786a729379e3_Sans titre.jpg', '000000', 'assets/images/personnels/cni_vesro/6786a729379e6_Sans titre.jpg', 'assets/images/personnels/cni_recto/6786a729379e7_Sans titre.jpg', '2025-01-14 18:04:25', '2025-01-14 18:04:25'),
(6, 'MEKAM', 'SORELLE', '2004-12-10', 'Vendeur', 'V', 692751737, 'sorellemekam42@gmail.com', 'Feminin', 'Ebolowa', 'assets/images/personnels/photos/6787e3060706f_IMG20241228074141.jpg', 'SUD17512I5J7DDVP93QN6', 'assets/images/personnels/cni_vesro/6787e30607073_Image1.jpg', 'assets/images/personnels/cni_recto/6787e30607074_Image2.jpg', '2025-01-15 16:32:06', '2025-01-15 16:32:06'),
(7, 'MBONGO\'O', 'WILFRIED', '1983-07-26', 'Vendeur', 'V', 677442721, 'mbongowilfried@gmail.com', 'Maculin', 'Ebolowa', 'assets/images/personnels/photos/6788ef026e8cd_PHOTO SG WILFRIED.jpg', '117960652', 'assets/images/personnels/cni_vesro/6788ef026e8d1_003.jpg', 'assets/images/personnels/cni_recto/6788ef026e8d2_004.jpg', '2025-01-16 11:35:30', '2025-01-16 11:35:30');

-- --------------------------------------------------------

--
-- Structure de la table `produits`
--

CREATE TABLE `produits` (
  `id_produits` int(11) NOT NULL,
  `id_fournisseurs` int(11) NOT NULL,
  `id_categorie_produits` int(11) NOT NULL,
  `nom_produits` varchar(250) NOT NULL,
  `prix_produits` decimal(10,0) NOT NULL,
  `prix_produits1` decimal(10,0) NOT NULL,
  `photo_produits1` varchar(250) NOT NULL,
  `unite_produits` varchar(250) NOT NULL,
  `photo_produits2` varchar(250) NOT NULL,
  `description_produits` text NOT NULL,
  `created_at_produits` timestamp NOT NULL DEFAULT current_timestamp(),
  `updated_at_produits` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Déchargement des données de la table `produits`
--

INSERT INTO `produits` (`id_produits`, `id_fournisseurs`, `id_categorie_produits`, `nom_produits`, `prix_produits`, `prix_produits1`, `photo_produits1`, `unite_produits`, `photo_produits2`, `description_produits`, `created_at_produits`, `updated_at_produits`) VALUES
(29, 7, 1, 'Boites archives dos de 10', 1200, 1000, 'assets/images/produits/6794c1345693b_WhatsApp Image 2025-01-25 à 11.27.08_b8d0566b.jpg', 'Piece', 'assets/images/produits/6794c13456940_WhatsApp Image 2025-01-25 à 11.26.49_9e1c5a73.jpg', 'boites archives dos de 10 couleur verte', '2025-01-25 10:47:16', '2025-01-26 17:04:08'),
(30, 6, 1, 'chrono archives', 3500, 2000, 'assets/images/produits/6794c27d0f47a_WhatsApp Image 2025-01-25 à 11.33.18_a99f072f.jpg', 'Piece', 'assets/images/produits/6794c27d0f47e_WhatsApp Image 2025-01-25 à 11.33.19_17fca706.jpg', 'chrono archives', '2025-01-25 10:52:45', '2025-01-25 10:52:45'),
(31, 6, 1, 'Envellope A6 carre', 1500, 1200, 'assets/images/produits/6794c53ed6ca4_WhatsApp Image 2025-01-25 à 11.50.41_a33b15d5.jpg', 'Paquet', 'assets/images/produits/6794c53ed6cae_WhatsApp Image 2025-01-25 à 11.55.05_0c1962e4.jpg', 'Enveloppes A6 carre', '2025-01-25 11:04:30', '2025-01-25 11:04:30'),
(32, 7, 4, 'Enveloppe  A6 rectangulaire', 1500, 1000, 'assets/images/produits/6794c6c730553_WhatsApp Image 2025-01-25 à 11.50.40_0cd7719e.jpg', 'Paquet', 'assets/images/produits/6794c6c730558_WhatsApp Image 2025-01-25 à 11.55.05_b370df76.jpg', 'Enveloppe A6 rectangulaire', '2025-01-25 11:11:03', '2025-01-25 11:11:03'),
(33, 7, 4, 'Envellope A5 kaki', 2500, 1500, 'assets/images/produits/6794c807e92a9_WhatsApp Image 2025-01-25 à 11.59.20_c4cce739.jpg', 'Paquet', 'assets/images/produits/6794c807e92ac_WhatsApp Image 2025-01-25 à 11.50.41_92280959.jpg', 'enveloppe A6 kaki', '2025-01-25 11:16:23', '2025-01-25 11:16:23'),
(34, 7, 1, 'Enveloppe A4 kaki', 3800, 2500, 'assets/images/produits/6794c908866d7_WhatsApp Image 2025-01-25 à 11.50.42_8c36e940.jpg', 'Paquet', 'assets/images/produits/6794c908866dc_WhatsApp Image 2025-01-25 à 11.59.19_f580ee0f.jpg', 'enveloppe A4 kaki', '2025-01-25 11:20:40', '2025-01-25 11:20:40'),
(35, 7, 1, 'Enveloppe A3 kaki', 4800, 4000, 'assets/images/produits/6794ca2f5259d_WhatsApp Image 2025-01-25 à 11.50.42_8c36e940.jpg', 'Paquet', 'assets/images/produits/6794ca2f525a1_WhatsApp Image 2025-01-25 à 11.50.42_3fd11053.jpg', 'Enveloppes A3 kaki', '2025-01-25 11:25:35', '2025-01-25 11:25:35'),
(36, 7, 1, 'Envellope A5 blanche', 3000, 2500, 'assets/images/produits/6794cb841622e_WhatsApp Image 2025-01-25 à 11.55.05_0c1962e4.jpg', 'Paquet', 'assets/images/produits/6794cb8416234_WhatsApp Image 2025-01-25 à 11.55.05_b370df76.jpg', 'Enveloppe A5 blanche', '2025-01-25 11:31:16', '2025-01-25 11:31:16'),
(37, 7, 1, 'Envellope A4  blanche', 4000, 3000, 'assets/images/produits/6794cc54c3631_WhatsApp Image 2025-01-25 à 12.09.51_66b0c6ae.jpg', 'Paquet', 'assets/images/produits/6794cc54c3637_WhatsApp Image 2025-01-25 à 12.09.50_e3922b85.jpg', 'Enveloppe A6 blanche', '2025-01-25 11:34:44', '2025-01-25 11:34:44'),
(38, 7, 5, 'souris HP neuves avec fil', 3500, 2500, 'assets/images/produits/6794cda8b3bc7_WhatsApp Image 2025-01-25 à 12.20.10_f88c4e2a.jpg', 'Piece', 'assets/images/produits/6794cda8b3bcb_WhatsApp Image 2025-01-25 à 12.20.09_c914f1d4.jpg', 'souris PH neuves avec fil', '2025-01-25 11:40:24', '2025-01-25 11:40:24'),
(39, 7, 5, 'souris d\'occasion avec fil', 3500, 2500, 'assets/images/produits/6794ce6d125af_WhatsApp Image 2025-01-25 à 12.20.48_9575934e.jpg', 'Piece', 'assets/images/produits/6794ce6d125b5_WhatsApp Image 2025-01-25 à 12.20.47_bb975f4a.jpg', 'souris d\'occasion avec fil', '2025-01-25 11:43:41', '2025-01-25 11:43:41'),
(40, 7, 5, 'Clavier d\'ordinatuer  d\'occasion', 4500, 2500, 'assets/images/produits/6794cf4c4907a_WhatsApp Image 2025-01-25 à 12.21.22_97e21c0e.jpg', 'Piece', 'assets/images/produits/6794cf4c4907e_WhatsApp Image 2025-01-25 à 12.21.21_7674557b.jpg', 'Clavier d\'ordinateur d\'occasion', '2025-01-25 11:47:24', '2025-01-25 11:47:24'),
(41, 6, 1, 'paquets chemises cartonneés de 80', 5000, 3000, 'assets/images/produits/6794d213df1c4_WhatsApp Image 2025-01-25 à 12.51.10_c438efb4.jpg', 'Paquet', 'assets/images/produits/6794d213df1c7_WhatsApp Image 2025-01-25 à 12.51.10_e380c78a.jpg', 'paquets chemises cartonnées', '2025-01-25 11:59:15', '2025-01-25 11:59:15'),
(42, 7, 4, 'paqets sous chemises 60g', 4000, 2500, 'assets/images/produits/6794d3653c2cb_WhatsApp Image 2025-01-25 à 12.51.34_1b14624c.jpg', 'Paquet', 'assets/images/produits/6794d3653c2d0_WhatsApp Image 2025-01-25 à 12.51.34_b7aad123.jpg', 'sous chemises 60g', '2025-01-25 12:04:53', '2025-01-25 12:04:53'),
(43, 6, 1, 'Malmereau de lux', 7500, 5000, 'assets/images/produits/679509f1d9225_WhatsApp Image 2025-01-25 à 12.48.30_4e479c99.jpg', 'Paquet', 'assets/images/produits/679509f1d9229_WhatsApp Image 2025-01-25 à 12.48.32_ab501362.jpg', 'Malmereau de lux', '2025-01-25 15:57:37', '2025-01-25 15:57:37'),
(44, 7, 5, 'Rallonge cinq trous', 7500, 5000, 'assets/images/produits/67950bd9242bc_WhatsApp Image 2025-01-25 à 12.50.03_c8d13963.jpg', 'Piece', 'assets/images/produits/67950bd9242bf_WhatsApp Image 2025-01-25 à 12.50.03_20e93c24.jpg', 'Rallonge cinq trous', '2025-01-25 16:05:45', '2025-01-25 16:05:45'),
(45, 7, 4, 'Gomme mapede', 100, 50, 'assets/images/produits/67950ce30d467_WhatsApp Image 2025-01-25 à 13.43.59_34960e3d.jpg', 'Piece', 'assets/images/produits/67950ce30d46c_WhatsApp Image 2025-01-25 à 13.43.59_34960e3d.jpg', 'Gomme mapede', '2025-01-25 16:10:11', '2025-01-25 16:10:11'),
(46, 7, 1, 'Datteur', 1800, 1500, 'assets/images/produits/67950db6bd06d_WhatsApp Image 2025-01-25 à 13.45.31_555d1c68.jpg', 'Piece', 'assets/images/produits/67950db6bd071_WhatsApp Image 2025-01-25 à 13.45.30_24d9d526.jpg', 'datteur', '2025-01-25 16:13:42', '2025-01-25 16:13:42'),
(47, 7, 1, 'Correcteur retype', 1000, 800, 'assets/images/produits/67950f3e1bc89_WhatsApp Image 2025-01-25 à 13.45.33_67450bdf.jpg', 'Boite', 'assets/images/produits/67950f3e1bc8c_WhatsApp Image 2025-01-25 à 13.45.32_22b840c0.jpg', 'correcteur retype', '2025-01-25 16:20:14', '2025-01-25 16:20:14'),
(48, 7, 1, 'Stick note 76x127mm', 1000, 700, 'assets/images/produits/679510dd5adb6_WhatsApp Image 2025-01-25 à 13.45.33_ec795580.jpg', 'Piece', 'assets/images/produits/679510dd5adbb_WhatsApp Image 2025-01-25 à 13.45.33_d47e7327.jpg', 'Stic note 76x127mm', '2025-01-25 16:27:09', '2025-01-25 16:27:09'),
(49, 7, 1, 'Stick note 76x76mm', 500, 300, 'assets/images/produits/6795120f9ec4c_WhatsApp Image 2025-01-25 à 13.45.34_37bb6c78.jpg', 'Piece', 'assets/images/produits/6795120f9ec4f_WhatsApp Image 2025-01-25 à 13.45.35_09e76448.jpg', 'Stick note 76x76mm', '2025-01-25 16:32:15', '2025-01-25 16:32:15'),
(50, 7, 1, 'carnet de recus autocopiant 50 dupli', 1000, 700, 'assets/images/produits/679513b5ab04a_WhatsApp Image 2025-01-25 à 13.45.35_f7c85143.jpg', 'Piece', 'assets/images/produits/679513b5ab04e_WhatsApp Image 2025-01-25 à 13.45.35_938f36b6.jpg', 'carnet de reçus autocopiant 50 dupli', '2025-01-25 16:39:17', '2025-01-25 16:39:17'),
(51, 6, 1, 'Facturier 09 tableaux', 1500, 1000, 'assets/images/produits/679514a1d8365_WhatsApp Image 2025-01-25 à 13.45.36_bc37cad3.jpg', 'Piece', 'assets/images/produits/679514a1d836a_WhatsApp Image 2025-01-25 à 13.45.36_cc9d40d1.jpg', 'Facturier 09 tableaux', '2025-01-25 16:43:13', '2025-01-25 16:43:13'),
(52, 7, 4, 'facturier A5 simple', 750, 500, 'assets/images/produits/679516ca71f99_WhatsApp Image 2025-01-25 à 13.45.37_0e843986.jpg', 'Piece', 'assets/images/produits/679516ca71f9c_WhatsApp Image 2025-01-25 à 13.45.37_f9e3c1e3.jpg', 'facturier A5 simple', '2025-01-25 16:52:26', '2025-01-25 16:52:26'),
(53, 6, 1, 'Facturier A6', 500, 400, 'assets/images/produits/679518e6094d3_WhatsApp Image 2025-01-25 à 13.45.38_0c016eec.jpg', 'Piece', 'assets/images/produits/679518e6094d7_WhatsApp Image 2025-01-25 à 13.45.37_9e67990e.jpg', 'Facturier A6', '2025-01-25 17:01:26', '2025-01-25 17:01:26'),
(54, 7, 1, 'Carnet de recus de 100', 500, 400, 'assets/images/produits/67951a5b8af88_WhatsApp Image 2025-01-25 à 13.45.38_773273a4.jpg', 'Piece', 'assets/images/produits/67951a5b8af8b_WhatsApp Image 2025-01-25 à 13.45.39_75594c14.jpg', 'Carnet de reçus de 100', '2025-01-25 17:07:39', '2025-01-25 17:07:39'),
(55, 7, 1, 'Cahier morceaux choisi', 500, 300, 'assets/images/produits/67951b21da819_WhatsApp Image 2025-01-25 à 13.45.39_6ee79533.jpg', 'Piece', 'assets/images/produits/67951b21da81e_WhatsApp Image 2025-01-25 à 13.45.40_71a7d2cd.jpg', 'Cahier morceaux choisi', '2025-01-25 17:10:57', '2025-01-25 17:10:57'),
(56, 7, 1, 'Facturier A4', 1500, 1000, 'assets/images/produits/67951bc37f86a_WhatsApp Image 2025-01-25 à 13.45.40_eb52fec9.jpg', 'Piece', 'assets/images/produits/67951bc37f86f_WhatsApp Image 2025-01-25 à 13.45.40_c7d70ce7.jpg', 'Facturier A4', '2025-01-25 17:13:39', '2025-01-25 17:13:39'),
(57, 6, 1, 'Journal de caisse autocopiant', 3500, 2500, 'assets/images/produits/67951c9d302cf_WhatsApp Image 2025-01-25 à 13.45.41_d8c81fdd.jpg', 'Piece', 'assets/images/produits/67951c9d302d3_WhatsApp Image 2025-01-25 à 13.45.41_4beb5557.jpg', 'Journal de caisse autocopiant', '2025-01-25 17:17:17', '2025-01-25 17:17:17'),
(58, 7, 1, 'Binder clips 32 mm1/4', 500, 350, 'assets/images/produits/67951ed1e67fa_WhatsApp Image 2025-01-25 à 15.19.25_e97572a5.jpg', 'Piece', 'assets/images/produits/67951ed1e67fd_WhatsApp Image 2025-01-25 à 15.19.25_e97572a5.jpg', 'Binder clips 32 mm1/4', '2025-01-25 17:26:41', '2025-01-25 17:26:41'),
(59, 6, 1, 'ote-agraffe', 500, 400, 'assets/images/produits/67951fbd686c7_WhatsApp Image 2025-01-25 à 15.19.46_0730994f.jpg', 'Piece', 'assets/images/produits/67951fbd686cc_WhatsApp Image 2025-01-25 à 15.19.37_ab39710e.jpg', 'ote-agrafe', '2025-01-25 17:30:37', '2025-01-25 17:30:37'),
(60, 7, 1, 'Agrafeuse 24/6', 5500, 3500, 'assets/images/produits/6795213777dfb_WhatsApp Image 2025-01-25 à 15.19.58_eac4514b.jpg', 'Piece', 'assets/images/produits/6795213777dfe_WhatsApp Image 2025-01-25 à 15.20.23_a533e11a.jpg', 'Agrafeuse 24/6', '2025-01-25 17:36:55', '2025-01-25 17:36:55'),
(61, 6, 1, 'Agrafeuse bebe', 3500, 2000, 'assets/images/produits/67952208c5513_WhatsApp Image 2025-01-25 à 15.21.05_acd19901.jpg', 'Piece', 'assets/images/produits/67952208c5519_WhatsApp Image 2025-01-25 à 15.21.01_99a916f2.jpg', 'Agrafeuse bebe', '2025-01-25 17:40:24', '2025-01-26 10:40:14'),
(62, 6, 1, 'Papier prelure 32g', 25, 10, 'assets/images/produits/679522ceeadb1_WhatsApp Image 2025-01-25 à 15.21.07_79b00d87.jpg', 'Piece', 'assets/images/produits/679522ceeadb6_WhatsApp Image 2025-01-25 à 15.21.11_1d50c713.jpg', 'Papier prelure 32g', '2025-01-25 17:43:42', '2025-01-26 10:40:44'),
(63, 7, 1, 'Maqueur tableau', 500, 400, 'assets/images/produits/67952451f407c_WhatsApp Image 2025-01-25 à 15.21.16_8b64bd9c.jpg', 'Piece', 'assets/images/produits/67952451f407f_WhatsApp Image 2025-01-25 à 15.21.15_cbcd88cf.jpg', 'Marqueur tableau', '2025-01-25 17:50:10', '2025-01-25 17:50:10'),
(64, 7, 1, 'Marqueur permanant', 500, 300, 'assets/images/produits/67952540b49c8_WhatsApp Image 2025-01-25 à 15.21.20_e3321297.jpg', 'Piece', 'assets/images/produits/67952540b49cf_WhatsApp Image 2025-01-25 à 15.21.19_03143037.jpg', 'Marqueur permanent', '2025-01-25 17:54:08', '2025-01-25 17:54:08'),
(65, 6, 1, 'Block note A5', 500, 350, 'assets/images/produits/6795270a049a3_WhatsApp Image 2025-01-25 à 15.21.21_5dd07612.jpg', 'Piece', 'assets/images/produits/6795270a049a6_WhatsApp Image 2025-01-25 à 15.21.22_619059d0.jpg', 'Block note A5', '2025-01-25 18:01:46', '2025-01-25 18:01:46'),
(66, 7, 1, 'Block note A4', 1200, 800, 'assets/images/produits/679528c3603ba_WhatsApp Image 2025-01-25 à 15.21.24_b1766d19.jpg', 'Piece', 'assets/images/produits/679528c3603be_WhatsApp Image 2025-01-25 à 15.21.27_200cef5d.jpg', 'Block note A4', '2025-01-25 18:09:07', '2025-01-25 18:09:07'),
(67, 6, 1, 'ciseaux PM', 1300, 1000, 'assets/images/produits/679529ec22076_WhatsApp Image 2025-01-25 à 15.21.32_ae8bafff.jpg', 'Piece', 'assets/images/produits/679529ec2207b_WhatsApp Image 2025-01-25 à 15.21.29_99fe9545.jpg', 'ciseaux PM', '2025-01-25 18:14:04', '2025-01-25 18:14:04'),
(68, 6, 1, 'Ciseaux GM', 1800, 1500, 'assets/images/produits/67952bf9b73cf_WhatsApp Image 2025-01-25 à 15.21.37_1051acde.jpg', 'Piece', 'assets/images/produits/67952bf9b73d4_WhatsApp Image 2025-01-25 à 15.21.34_7281ef9e.jpg', 'Ciseaux GM', '2025-01-25 18:22:49', '2025-01-25 18:22:49'),
(69, 6, 1, 'Rame de forma A3', 9000, 8500, 'assets/images/produits/67952e1b1c4a8_WhatsApp Image 2025-01-25 à 15.21.38_0a053f83.jpg', 'Paquet', 'assets/images/produits/67952e1b1c4ac_WhatsApp Image 2025-01-25 à 15.21.40_eaf1dd72.jpg', 'Rame de forma A3', '2025-01-25 18:31:55', '2025-01-25 18:31:55'),
(70, 6, 1, 'Rames format A4 sinaline', 3500, 3000, 'assets/images/produits/67952f33dc63c_WhatsApp Image 2025-01-25 à 15.21.42_a6835170.jpg', 'Paquet', 'assets/images/produits/67952f33dc641_WhatsApp Image 2025-01-25 à 15.21.41_e2069e35.jpg', 'Rames format A4 sinaline', '2025-01-25 18:36:35', '2025-01-25 18:36:35'),
(71, 6, 1, 'papier auto collant A4 (paquets)', 100, 100, 'assets/images/produits/6795314f32298_WhatsApp Image 2025-01-25 à 16.35.53_9f3b63df.jpg', 'Piece', 'assets/images/produits/6795314f3229b_WhatsApp Image 2025-01-25 à 16.35.56_1b416c93.jpg', 'Papier autocollant A4', '2025-01-25 18:45:35', '2025-01-26 11:01:02'),
(72, 7, 1, 'Paquet tranparent pour reliure', 7500, 3000, 'assets/images/produits/6796040e3d559_WhatsApp Image 2025-01-25 à 16.35.59_a83773a0.jpg', 'Paquet', 'assets/images/produits/6796040e3d55b_WhatsApp Image 2025-01-25 à 16.35.58_076e43f9.jpg', 'Paquet transparent pour reliure', '2025-01-26 09:44:46', '2025-01-26 09:44:46'),
(73, 7, 1, 'Paque master A4', 7500, 3000, 'assets/images/produits/679604ac03ab8_WhatsApp Image 2025-01-25 à 16.35.59_e10423cb.jpg', 'Paquet', 'assets/images/produits/679604ac03aba_WhatsApp Image 2025-01-25 à 16.36.00_1c9bb001.jpg', 'Paquet master A4', '2025-01-26 09:47:24', '2025-01-26 09:47:24'),
(74, 6, 1, 'Photo peper 180g/m2', 3500, 2500, 'assets/images/produits/679605a2119fb_WhatsApp Image 2025-01-25 à 16.36.01_50392f29.jpg', 'Paquet', 'assets/images/produits/679605a2119fe_WhatsApp Image 2025-01-25 à 16.36.00_4ed69b0f.jpg', 'Photo peper 180g/m2', '2025-01-26 09:51:30', '2025-01-26 09:51:30'),
(75, 6, 1, 'Paquet protege forma', 3500, 3000, 'assets/images/produits/679606fa6f93c_WhatsApp Image 2025-01-25 à 16.36.02_818f275b.jpg', 'Paquet', 'assets/images/produits/679606fa6f93e_WhatsApp Image 2025-01-25 à 16.36.02_44aa99d5.jpg', 'Paquet protège forma', '2025-01-26 09:57:14', '2025-01-26 09:57:14'),
(76, 6, 1, 'Paquet copies doubles quadrilles', 3800, 2500, 'assets/images/produits/67960a525a1bd_WhatsApp Image 2025-01-26 à 11.00.26_20bba11e.jpg', 'Paquet', 'assets/images/produits/67960a525a1c0_WhatsApp Image 2025-01-26 à 11.00.27_0169f65f.jpg', 'papier ministre (paquet)', '2025-01-26 10:11:30', '2025-01-26 10:59:06'),
(77, 6, 1, 'Paquet bristol  vert clair', 2800, 2500, 'assets/images/produits/67961bedec754_WhatsApp Image 2025-01-26 à 12.21.59_2b31708c.jpg', 'Paquet', 'assets/images/produits/67961bedec756_WhatsApp Image 2025-01-26 à 12.22.10_e5e21995.jpg', 'Paquet bristol  vert clair', '2025-01-26 11:26:37', '2025-01-26 11:26:37'),
(78, 6, 1, 'paquet bristol blanc', 2800, 2500, 'assets/images/produits/67961cd51021e_WhatsApp Image 2025-01-26 à 12.21.04_dfca51db.jpg', 'Paquet', 'assets/images/produits/67961cd510222_WhatsApp Image 2025-01-26 à 12.21.17_5afaed1a.jpg', 'paquet bristol blanc', '2025-01-26 11:30:29', '2025-01-26 11:30:29'),
(79, 6, 1, 'Paquet blistol rose', 2800, 2500, 'assets/images/produits/67961e8e65271_WhatsApp Image 2025-01-26 à 12.21.46_d66ba15d.jpg', 'Paquet', 'assets/images/produits/67961e8e65273_WhatsApp Image 2025-01-26 à 12.21.37_634f1f67.jpg', 'Paquet bristol rose', '2025-01-26 11:37:50', '2025-01-26 11:37:50'),
(80, 6, 1, 'Paquet sous chemise', 4000, 2500, 'assets/images/produits/679623ab4317c_WhatsApp Image 2025-01-26 à 12.49.22_3383be05.jpg', 'Paquet', 'assets/images/produits/679623ab4317f_WhatsApp Image 2025-01-26 à 12.49.33_7be148a8.jpg', 'Paquet sous chemise', '2025-01-26 11:59:39', '2025-01-26 11:59:39'),
(81, 6, 1, 'Rame de format double A 70g', 3500, 2900, 'assets/images/produits/6796257ad2f1c_WhatsApp Image 2025-01-26 à 12.49.48_8d3b2ea5.jpg', 'Paquet', 'assets/images/produits/6796257ad2f1e_WhatsApp Image 2025-01-26 à 12.50.05_37169382.jpg', 'Rame de format double A 70g', '2025-01-26 12:07:22', '2025-01-26 12:07:22'),
(82, 6, 1, 'Rame de format double A 80g', 4500, 3800, 'assets/images/produits/679626cfddddd_WhatsApp Image 2025-01-26 à 12.50.22_2eec631b.jpg', 'Paquet', 'assets/images/produits/679626cfddddf_WhatsApp Image 2025-01-26 à 12.50.33_b7f2a8d7.jpg', 'Rame de format double A 80g', '2025-01-26 12:13:03', '2025-01-26 12:13:03'),
(83, 6, 1, 'Boite craie robert color blanche', 2000, 1800, 'assets/images/produits/67962dea6354e_WhatsApp Image 2025-01-26 à 13.36.49_00b5a1a4.jpg', 'Boite', 'assets/images/produits/67962dea63551_WhatsApp Image 2025-01-26 à 13.37.01_786849aa.jpg', 'Boite craie robert color blanche', '2025-01-26 12:43:22', '2025-01-26 12:43:22'),
(84, 6, 1, 'Boite de craie royal blanche', 1500, 1300, 'assets/images/produits/67962f3a380d5_WhatsApp Image 2025-01-26 à 13.38.27_c2063d59.jpg', 'Boite', 'assets/images/produits/67962f3a380d7_WhatsApp Image 2025-01-26 à 13.38.16_8f917403.jpg', 'Boite de craie royal blanche', '2025-01-26 12:48:58', '2025-01-26 12:48:58'),
(85, 6, 1, 'Boite de craie royal couleur', 3500, 2500, 'assets/images/produits/6796305d7b88c_WhatsApp Image 2025-01-26 à 13.37.56_d12094e9.jpg', 'Boite', 'assets/images/produits/6796305d7b890_WhatsApp Image 2025-01-26 à 13.37.19_ba2bbba3.jpg', 'Boite de craie royal couleur', '2025-01-26 12:53:49', '2025-01-26 12:53:49'),
(86, 6, 1, 'Papier ministre', 50, 45, 'assets/images/produits/67963f896b013_WhatsApp Image 2025-01-26 à 14.52.29_aa967c7e.jpg', 'Piece', 'assets/images/produits/67963f896b016_WhatsApp Image 2025-01-26 à 14.52.38_12da092d.jpg', 'Papier ministre', '2025-01-26 13:58:33', '2025-01-26 13:58:33'),
(87, 6, 1, 'Trombone petite boite de 100', 500, 300, 'assets/images/produits/679642180f661_WhatsApp Image 2025-01-26 à 15.03.16_71e2a8a6.jpg', 'Paquet', 'assets/images/produits/679642180f665_WhatsApp Image 2025-01-26 à 15.03.22_fea06a61.jpg', 'Trombone petite boite de 100', '2025-01-26 14:09:28', '2025-01-26 14:09:28'),
(88, 6, 1, 'Chemise a rabat', 500, 350, 'assets/images/produits/679644498f9e4_WhatsApp Image 2025-01-26 à 15.05.41_dcfd8643.jpg', 'Piece', 'assets/images/produits/679644498f9e6_WhatsApp Image 2025-01-26 à 15.05.25_2f02a7b4.jpg', 'Chemise a rabat', '2025-01-26 14:18:49', '2025-01-26 14:18:49'),
(89, 6, 1, 'Trombone boite de 1000 couleurs assorties', 4500, 3000, 'assets/images/produits/679644fe23563_WhatsApp Image 2025-01-26 à 15.03.52_f79b741f.jpg', 'Boite', 'assets/images/produits/679644fe23567_WhatsApp Image 2025-01-26 à 15.03.41_ae2b1be7.jpg', 'Trombone boite de 1000 couleurs assorties', '2025-01-26 14:21:50', '2025-01-26 14:21:50'),
(90, 6, 1, 'Perforateur DL0818(PM)', 3500, 2500, 'assets/images/produits/67964610e86c4_WhatsApp Image 2025-01-26 à 15.05.06_4ff5f07c.jpg', 'Piece', 'assets/images/produits/67964610e86c7_WhatsApp Image 2025-01-26 à 15.05.06_4ff5f07c.jpg', 'Perforateur DL0818(PM)', '2025-01-26 14:26:24', '2025-01-26 14:26:24'),
(91, 6, 1, 'Perforateur DL8260 (GM)', 4500, 3500, 'assets/images/produits/67964ceb375ac_WhatsApp Image 2025-01-26 à 15.04.58_8fb41167.jpg', 'Piece', 'assets/images/produits/67964ceb375af_WhatsApp Image 2025-01-26 à 15.04.58_8fb41167.jpg', 'Perforateur DL8260 (GM)', '2025-01-26 14:55:39', '2025-01-26 14:55:39'),
(92, 6, 1, 'Registre 200ps 20x30cm', 2800, 1500, 'assets/images/produits/679679e307e0d_WhatsApp Image 2025-01-26 à 18.45.48_f9e08d36.jpg', 'Piece', 'assets/images/produits/679679e307e10_WhatsApp Image 2025-01-26 à 18.45.48_f9e08d36.jpg', 'Registre 200ps 20x30cm', '2025-01-26 18:07:31', '2025-01-26 18:07:31'),
(93, 6, 1, 'Registre 300ps 20x30cm', 3800, 2000, 'assets/images/produits/67967ae21af83_WhatsApp Image 2025-01-26 à 19.08.06_13e34635.jpg', 'Piece', 'assets/images/produits/67967ae21af87_WhatsApp Image 2025-01-26 à 19.08.06_13e34635.jpg', 'Registre 300ps 20x30cm', '2025-01-26 18:11:46', '2025-01-26 18:11:46'),
(94, 6, 1, 'Registre 400ps 20x36cm', 4800, 2500, 'assets/images/produits/67967b9bba6e0_WhatsApp Image 2025-01-26 à 19.12.20_2593d803.jpg', 'Piece', 'assets/images/produits/67967b9bba6e4_WhatsApp Image 2025-01-26 à 19.12.20_2593d803.jpg', 'Registre 400ps 20x36cm', '2025-01-26 18:14:51', '2025-01-26 18:14:51'),
(95, 6, 1, 'Registre 500ps 20x30cm', 5800, 3500, 'assets/images/produits/67967ca27c12e_WhatsApp Image 2025-01-26 à 19.12.20_2593d803.jpg', 'Piece', 'assets/images/produits/67967ca27c133_WhatsApp Image 2025-01-26 à 19.12.20_2593d803.jpg', 'Registre 500ps 20x30cm', '2025-01-26 18:19:14', '2025-01-26 18:19:14'),
(96, 6, 1, 'Registre 200ps 23x36cm', 3800, 2500, 'assets/images/produits/67967e9590038_WhatsApp Image 2025-01-26 à 19.21.27_75893582.jpg', 'Piece', 'assets/images/produits/67967e959003b_WhatsApp Image 2025-01-26 à 19.21.27_75893582.jpg', 'Registre 200ps 23x36cm', '2025-01-26 18:27:33', '2025-01-26 18:27:33'),
(97, 6, 4, 'Registre 300ps 23x36cm', 4800, 3500, 'assets/images/produits/67967f8351dab_WhatsApp Image 2025-01-26 à 19.28.25_f7bc27c5.jpg', 'Piece', 'assets/images/produits/67967f8351db0_WhatsApp Image 2025-01-26 à 19.28.25_f7bc27c5.jpg', 'Registre 300ps 23x36cm', '2025-01-26 18:31:31', '2025-01-26 18:31:31'),
(98, 6, 1, 'Registre 400ps 23x36cm', 6800, 4000, 'assets/images/produits/679680622ed78_WhatsApp Image 2025-01-26 à 19.32.18_4af119dd.jpg', 'Piece', 'assets/images/produits/679680622ed7c_WhatsApp Image 2025-01-26 à 19.32.18_4af119dd.jpg', 'Registre 400ps 23x36cm', '2025-01-26 18:35:14', '2025-01-26 18:35:14'),
(99, 6, 1, 'Registre 500 ps 23x36cm', 7800, 5000, 'assets/images/produits/6796815271a1a_WhatsApp Image 2025-01-26 à 19.36.18_eb1f5e40.jpg', 'Piece', 'assets/images/produits/6796815271a1f_WhatsApp Image 2025-01-26 à 19.36.18_eb1f5e40.jpg', 'Registre 500 ps 23x36cm', '2025-01-26 18:39:14', '2025-01-26 18:39:14'),
(100, 6, 1, 'Regitre 600ps 23x36cm', 9800, 6000, 'assets/images/produits/679682a82520e_WhatsApp Image 2025-01-26 à 19.40.55_8d1df618.jpg', 'Piece', 'assets/images/produits/679682a825212_WhatsApp Image 2025-01-26 à 19.40.55_8d1df618.jpg', 'Regitre 600ps 23x36cm', '2025-01-26 18:44:56', '2025-01-26 18:44:56'),
(101, 6, 1, 'Registre 800ps 23x36cm', 15000, 7000, 'assets/images/produits/679683b55b54a_WhatsApp Image 2025-01-26 à 19.46.26_67ea0e85.jpg', 'Piece', 'assets/images/produits/679683b55b54e_WhatsApp Image 2025-01-26 à 19.46.26_67ea0e85.jpg', 'Registre 800ps 23x36cm', '2025-01-26 18:49:25', '2025-01-26 18:49:25'),
(102, 6, 1, 'Regitre 1000ps 26x40cm', 22000, 10000, 'assets/images/produits/679685c06d6fc_WhatsApp Image 2025-01-26 à 19.55.06_af2689d2.jpg', 'Piece', 'assets/images/produits/679685c06d6ff_WhatsApp Image 2025-01-26 à 19.55.06_af2689d2.jpg', 'Regitre 1000ps 26x40cm', '2025-01-26 18:58:08', '2025-01-26 18:58:08'),
(103, 6, 1, 'Encre a tampon bleux (horse)', 1000, 700, 'assets/images/produits/679688853d444_WhatsApp Image 2025-01-26 à 20.05.29_8a4fe584.jpg', 'Piece', 'assets/images/produits/679688853d449_WhatsApp Image 2025-01-26 à 20.05.29_8a4fe584.jpg', 'Encre a tampon bleu (horse)', '2025-01-26 19:09:57', '2025-01-26 19:14:37'),
(104, 6, 1, 'Encre a tampon rouge (horse)', 1000, 7000, 'assets/images/produits/6796892ea0029_WhatsApp Image 2025-01-26 à 20.10.32_56c81e9a.jpg', 'Piece', 'assets/images/produits/6796892ea002e_WhatsApp Image 2025-01-26 à 20.10.32_56c81e9a.jpg', 'Encre a tampon rouge (horse)', '2025-01-26 19:12:46', '2025-01-26 19:13:56'),
(105, 6, 1, 'Encrier rouge (horse)', 1000, 500, 'assets/images/produits/67968aa16f25a_WhatsApp Image 2025-01-26 à 20.16.11_55840b81.jpg', 'Piece', 'assets/images/produits/67968aa16f25e_WhatsApp Image 2025-01-26 à 20.16.11_55840b81.jpg', 'Encrier rouge (horse)', '2025-01-26 19:18:57', '2025-01-26 19:18:57'),
(106, 6, 1, 'Encrier bleu (horse)', 1000, 500, 'assets/images/produits/67968be1b1040_WhatsApp Image 2025-01-26 à 20.22.08_62b6d398.jpg', 'Piece', 'assets/images/produits/67968be1b1044_WhatsApp Image 2025-01-26 à 20.22.08_62b6d398.jpg', 'Encrier bleu (horse)', '2025-01-26 19:24:17', '2025-01-26 19:24:17'),
(107, 6, 1, 'Chemise a sangle', 1000, 700, 'assets/images/produits/67968d75717e0_WhatsApp Image 2025-01-26 à 20.25.52_9f24a041.jpg', 'Piece', 'assets/images/produits/67968d75717e7_WhatsApp Image 2025-01-26 à 20.25.52_9f24a041.jpg', 'Chemise a sangle', '2025-01-26 19:31:01', '2025-01-26 19:31:01'),
(108, 6, 4, 'Chemise de chantier (speed folder)', 1800, 1300, 'assets/images/produits/67968e77e1ceb_WhatsApp Image 2025-01-26 à 20.32.57_cbfef41d.jpg', 'Piece', 'assets/images/produits/67968e77e1cf0_WhatsApp Image 2025-01-26 à 20.32.57_cbfef41d.jpg', 'Chemise de chantier (speed folder)', '2025-01-26 19:35:19', '2025-01-26 19:35:19'),
(109, 6, 1, 'Chemise de chantier en plastique', 1800, 1300, 'assets/images/produits/67968f990b933_WhatsApp Image 2025-01-26 à 20.36.59_61e278a2.jpg', 'Piece', 'assets/images/produits/67968f990b937_WhatsApp Image 2025-01-26 à 20.36.59_61e278a2.jpg', 'Chemise de chantier en plastique', '2025-01-26 19:40:09', '2025-01-26 19:40:09'),
(110, 6, 1, 'Feuilles mobiles', 600, 500, 'assets/images/produits/6796913d6cff6_WhatsApp Image 2025-01-26 à 20.42.50_e35b7364.jpg', 'Paquet', 'assets/images/produits/6796913d6cff9_WhatsApp Image 2025-01-26 à 20.42.50_e35b7364.jpg', 'Feuilles mobiles', '2025-01-26 19:47:09', '2025-01-26 19:47:09'),
(111, 6, 1, 'Malmereau blanc (paquet)', 7500, 3000, 'assets/images/produits/6796953250bff_WhatsApp Image 2025-01-26 à 20.59.23_3d8c820e.jpg', 'Paquet', 'assets/images/produits/6796953250c03_WhatsApp Image 2025-01-26 à 20.59.23_3d8c820e.jpg', 'Malmereau blanc (paquet)', '2025-01-26 20:04:02', '2025-01-26 20:04:02'),
(112, 6, 1, 'Malmereau vert foret (paquet)', 7500, 3000, 'assets/images/produits/679695eea87d6_WhatsApp Image 2025-01-26 à 21.04.57_2c587078.jpg', 'Paquet', 'assets/images/produits/679695eea87eb_WhatsApp Image 2025-01-26 à 21.04.57_2c587078.jpg', 'Malmereau vert foret (paquet)', '2025-01-26 20:07:10', '2025-01-26 20:07:10'),
(113, 6, 1, 'Malmereau blanc cassé (paquet)', 7500, 3000, 'assets/images/produits/679696cd6ad24_WhatsApp Image 2025-01-26 à 21.07.42_483684e3.jpg', 'Paquet', 'assets/images/produits/679696cd6ad28_WhatsApp Image 2025-01-26 à 21.07.42_483684e3.jpg', 'Malmereau blanc cassé (paquet)', '2025-01-26 20:10:53', '2025-01-26 20:10:53'),
(114, 6, 1, 'Malmereau rouge (paquet)', 7500, 3000, 'assets/images/produits/67969792910e7_WhatsApp Image 2025-01-26 à 21.11.46_e30bd44e.jpg', 'Paquet', 'assets/images/produits/67969792910eb_WhatsApp Image 2025-01-26 à 21.11.46_e30bd44e.jpg', 'Malmereau rouge (paquet)', '2025-01-26 20:14:10', '2025-01-26 20:14:10'),
(115, 6, 1, 'Malmereau bleu clair (paquet)', 7500, 3000, 'assets/images/produits/6796986b5b503_WhatsApp Image 2025-01-26 à 21.14.47_2dcdd790.jpg', 'Paquet', 'assets/images/produits/6796986b5b508_WhatsApp Image 2025-01-26 à 21.14.47_2dcdd790.jpg', 'Malmereau bleu clair (paquet)', '2025-01-26 20:17:47', '2025-01-26 20:17:47'),
(116, 6, 1, 'Agrafes 24/6 couleur bleu', 500, 300, 'assets/images/produits/679739d612b0e_WhatsApp Image 2025-01-27 à 08.40.20_744a6b44.jpg', 'Piece', 'assets/images/produits/679739d612b11_WhatsApp Image 2025-01-27 à 08.40.20_744a6b44.jpg', 'Agrafes 24/6 couleur bleu', '2025-01-27 07:46:30', '2025-01-27 07:46:30'),
(117, 6, 1, 'Agrafes bebe', 500, 300, 'assets/images/produits/67973a9464a63_WhatsApp Image 2025-01-27 à 08.46.57_3ace5123.jpg', 'Piece', 'assets/images/produits/67973a9464a67_WhatsApp Image 2025-01-27 à 08.46.57_3ace5123.jpg', 'Agrafes bebe', '2025-01-27 07:49:40', '2025-01-27 07:49:40'),
(118, 6, 1, 'Agrafes 24/6 couleur blanche', 500, 300, 'assets/images/produits/67973c4ce2bca_WhatsApp Image 2025-01-27 à 08.52.47_6dd7d957.jpg', 'Piece', 'assets/images/produits/67973c4ce2bce_WhatsApp Image 2025-01-27 à 08.52.47_6dd7d957.jpg', 'Agrafes 24/6 couleur blanche', '2025-01-27 07:57:00', '2025-01-27 07:57:00'),
(119, 6, 1, 'Facturier A5 autocopiant', 1000, 700, 'assets/images/produits/67973d7b0b231_WhatsApp Image 2025-01-27 à 08.58.58_78ce881b.jpg', 'Piece', 'assets/images/produits/67973d7b0b234_WhatsApp Image 2025-01-27 à 08.58.58_78ce881b.jpg', 'Facturier A5 autocopiant', '2025-01-27 08:02:03', '2025-01-27 08:02:03'),
(120, 6, 1, 'Manifold autocopiant A5', 1000, 700, 'assets/images/produits/67973f090d7ad_WhatsApp Image 2025-01-27 à 09.03.24_36e3b94e.jpg', 'Piece', 'assets/images/produits/67973f090d7b0_WhatsApp Image 2025-01-27 à 09.03.24_36e3b94e.jpg', 'Manifold autocopiant A5', '2025-01-27 08:08:41', '2025-01-27 08:08:41'),
(121, 6, 1, 'Manifold autocopiant A6', 1000, 500, 'assets/images/produits/67973ff1e3cf0_WhatsApp Image 2025-01-27 à 09.09.23_058f15a2.jpg', 'Piece', 'assets/images/produits/67973ff1e3cf4_WhatsApp Image 2025-01-27 à 09.09.23_058f15a2.jpg', 'Manifold autocopiant A6', '2025-01-27 08:12:33', '2025-01-27 08:12:33'),
(122, 6, 1, 'Manifold autocopiant A4  1dupli', 3500, 2500, 'assets/images/produits/6797412577860_WhatsApp Image 2025-01-27 à 09.15.18_1dae7920.jpg', 'Piece', 'assets/images/produits/6797412577864_WhatsApp Image 2025-01-27 à 09.15.18_1dae7920.jpg', 'Manifold autocopiant A4  1dupli', '2025-01-27 08:17:41', '2025-01-27 08:17:41'),
(123, 6, 1, 'Recettes et depences', 3500, 2500, 'assets/images/produits/6797420c67831_WhatsApp Image 2025-01-27 à 09.18.34_02dbc320.jpg', 'Piece', 'assets/images/produits/6797420c67834_WhatsApp Image 2025-01-27 à 09.18.34_02dbc320.jpg', 'Recettes et depences', '2025-01-27 08:21:32', '2025-01-27 08:22:58'),
(124, 6, 1, 'Bloc brouillon', 200, 1500, 'assets/images/produits/679744fd07d48_WhatsApp Image 2025-01-27 à 09.27.30_6cea92df.jpg', 'Piece', 'assets/images/produits/679744fd07d4a_WhatsApp Image 2025-01-27 à 09.27.30_6cea92df.jpg', 'Bloc brouillon', '2025-01-27 08:34:05', '2025-01-27 08:34:05'),
(125, 6, 1, 'Bloc vendeur', 200, 150, 'assets/images/produits/6797462ec100e_WhatsApp Image 2025-01-27 à 09.35.49_3feaf8bb.jpg', 'Piece', 'assets/images/produits/6797462ec1010_WhatsApp Image 2025-01-27 à 09.35.49_3feaf8bb.jpg', 'Bloc vendeur', '2025-01-27 08:39:10', '2025-01-27 08:39:10'),
(126, 6, 1, 'Colle bâton (stic)', 1000, 500, 'assets/images/produits/6797479c69bca_WhatsApp Image 2025-01-27 à 09.41.41_b78da538.jpg', 'Piece', 'assets/images/produits/6797479c69bcc_WhatsApp Image 2025-01-27 à 09.41.41_b78da538.jpg', 'Colle bâton (stic)', '2025-01-27 08:45:16', '2025-01-27 08:45:16'),
(127, 6, 1, 'Surligneur', 500, 400, 'assets/images/produits/679748ebc5f6b_WhatsApp Image 2025-01-27 à 09.48.44_a02ad9e1.jpg', 'Piece', 'assets/images/produits/679748ebc5f6f_WhatsApp Image 2025-01-27 à 09.48.44_a02ad9e1.jpg', 'Surligneur', '2025-01-27 08:50:51', '2025-01-27 08:50:51'),
(128, 7, 1, 'Bic pensan bleu', 100, 90, 'assets/images/produits/679751b036545_WhatsApp Image 2025-01-27 à 10.23.38_8d0aa5b3.jpg', 'Piece', 'assets/images/produits/679751b036547_WhatsApp Image 2025-01-27 à 10.23.38_8d0aa5b3.jpg', 'Bic pensan bleu', '2025-01-27 09:28:16', '2025-01-27 09:28:16'),
(129, 6, 1, 'Bic pensan noir', 100, 90, 'assets/images/produits/67975287eba3e_WhatsApp Image 2025-01-27 à 10.29.24_fc120f70.jpg', 'Piece', 'assets/images/produits/67975287eba41_WhatsApp Image 2025-01-27 à 10.29.24_fc120f70.jpg', 'Bic pensan noir', '2025-01-27 09:31:51', '2025-01-27 09:31:51'),
(130, 6, 1, 'Bic pensan rouge', 100, 90, 'assets/images/produits/67975491895f0_WhatsApp Image 2025-01-27 à 10.38.23_76a9884d.jpg', 'Piece', 'assets/images/produits/67975491895f2_WhatsApp Image 2025-01-27 à 10.38.23_76a9884d.jpg', 'Bic pensan rouge', '2025-01-27 09:40:33', '2025-01-27 09:40:33'),
(131, 6, 1, 'Bic crystal noir', 150, 100, 'assets/images/produits/679755ea7ff15_WhatsApp Image 2025-01-27 à 10.42.45_13a15f3a.jpg', 'Piece', 'assets/images/produits/679755ea7ff19_WhatsApp Image 2025-01-27 à 10.42.45_13a15f3a.jpg', 'Bic cristal noir', '2025-01-27 09:46:18', '2025-01-27 09:46:18'),
(132, 6, 1, 'Bic cristal bleu', 150, 100, 'assets/images/produits/67975741299aa_WhatsApp Image 2025-01-27 à 10.47.31_9c131fa4.jpg', 'Piece', 'assets/images/produits/67975741299ad_WhatsApp Image 2025-01-27 à 10.47.31_9c131fa4.jpg', 'Bic cristal bleu', '2025-01-27 09:52:01', '2025-01-27 09:52:01'),
(133, 6, 1, 'Bic cristal rouge', 150, 100, 'assets/images/produits/67975834bc1a9_WhatsApp Image 2025-01-27 à 10.54.09_7e75f9ae.jpg', 'Piece', 'assets/images/produits/67975834bc1ac_WhatsApp Image 2025-01-27 à 10.54.09_7e75f9ae.jpg', 'Bic cristal rouge', '2025-01-27 09:56:04', '2025-01-27 09:56:04'),
(134, 6, 1, 'Bic schneider rouge', 200, 150, 'assets/images/produits/6797592484976_WhatsApp Image 2025-01-27 à 10.54.09_7e75f9ae.jpg', 'Piece', 'assets/images/produits/679759248497a_WhatsApp Image 2025-01-27 à 10.54.09_7e75f9ae.jpg', 'Bic schneider rouge', '2025-01-27 10:00:04', '2025-01-27 10:00:04'),
(135, 6, 1, 'Bic schneider vert', 200, 150, 'assets/images/produits/679759f2a67a9_WhatsApp Image 2025-01-27 à 11.01.16_2e9b5756.jpg', 'Piece', 'assets/images/produits/679759f2a67ae_WhatsApp Image 2025-01-27 à 11.01.16_2e9b5756.jpg', 'Bic schneider vert', '2025-01-27 10:03:30', '2025-01-27 10:03:30'),
(136, 6, 1, 'Bic schneider bleu', 200, 150, 'assets/images/produits/67975adddf75e_WhatsApp Image 2025-01-27 à 11.04.31_ba2830f1.jpg', 'Piece', 'assets/images/produits/67975adddf762_WhatsApp Image 2025-01-27 à 11.04.31_ba2830f1.jpg', 'Bic schneider bleu', '2025-01-27 10:07:25', '2025-01-27 10:07:25'),
(137, 6, 1, 'Cle USB 2G°', 3500, 2500, 'assets/images/produits/67976184a63f8_WhatsApp Image 2025-01-27 à 11.32.52_8d442b88.jpg', 'Piece', 'assets/images/produits/67976184a63fa_WhatsApp Image 2025-01-27 à 11.32.52_8d442b88.jpg', 'Cle USB 2G°', '2025-01-27 10:35:48', '2025-01-27 10:35:48'),
(138, 6, 1, 'Cle USB 4G°', 4500, 3500, 'assets/images/produits/67976240eabfe_WhatsApp Image 2025-01-27 à 11.36.29_67bf8039.jpg', 'Piece', 'assets/images/produits/67976240eac02_WhatsApp Image 2025-01-27 à 11.36.29_67bf8039.jpg', 'Cle USB 4G°', '2025-01-27 10:38:56', '2025-01-27 10:38:56'),
(139, 6, 1, 'Cle USB 8G°', 6500, 3500, 'assets/images/produits/6797639500efb_WhatsApp Image 2025-01-27 à 11.41.28_9f729949.jpg', 'Piece', 'assets/images/produits/6797639500efd_WhatsApp Image 2025-01-27 à 11.41.28_9f729949.jpg', 'Cle USB 8G°', '2025-01-27 10:44:37', '2025-01-27 10:44:37'),
(140, 6, 1, 'Cle USB 32G°', 20000, 10000, 'assets/images/produits/67976b46a7a08_WhatsApp Image 2025-01-27 à 11.47.56_432bd2bb.jpg', 'Piece', 'assets/images/produits/67976b46a7a0b_WhatsApp Image 2025-01-27 à 11.47.56_432bd2bb.jpg', 'Cle USB 32G°', '2025-01-27 11:17:26', '2025-01-27 11:17:26'),
(141, 6, 1, 'Ikon 1/2kg', 7500, 500, 'assets/images/produits/67976c5fbd38b_WhatsApp Image 2025-01-27 à 12.18.24_cc82d06c.jpg', 'Boite', 'assets/images/produits/67976c5fbd390_WhatsApp Image 2025-01-27 à 12.18.24_cc82d06c.jpg', 'Ikon 1/2kg', '2025-01-27 11:22:07', '2025-01-27 11:22:07'),
(142, 6, 4, 'Ikon 1kg', 15000, 9000, 'assets/images/produits/67976eb1db915_WhatsApp Image 2025-01-27 à 12.18.24_cc82d06c.jpg', 'Boite', 'assets/images/produits/67976eb1db917_WhatsApp Image 2025-01-27 à 12.18.24_cc82d06c.jpg', 'Ikon 1kg', '2025-01-27 11:32:01', '2025-01-27 11:32:01'),
(143, 6, 8, 'Encre recharge a jet bleu 100ml', 1000, 1000, 'assets/images/produits/67977109a85d8_WhatsApp Image 2025-01-27 à 12.39.40_8da6df33.jpg', 'Boite', 'assets/images/produits/67977109a85db_WhatsApp Image 2025-01-27 à 12.39.40_8da6df33.jpg', 'Encre recharge a jet bleu 100ml', '2025-01-27 11:42:01', '2025-01-27 11:42:01'),
(144, 6, 1, 'Encre recharge a jet jaune 100ml', 1000, 1000, 'assets/images/produits/6797a2c1cb55f_WhatsApp Image 2025-01-27 à 16.10.58_352f1fa1.jpg', 'Boite', 'assets/images/produits/6797a2c1cb563_WhatsApp Image 2025-01-27 à 16.10.58_352f1fa1.jpg', 'Encre recharge a jet jaune 100ml', '2025-01-27 15:14:09', '2025-01-27 15:14:09'),
(145, 6, 8, 'Encre recharge a jet rouge 100ml', 1000, 1000, 'assets/images/produits/6797a3a7f209c_WhatsApp Image 2025-01-27 à 16.14.44_f91ffe8c.jpg', 'Boite', 'assets/images/produits/6797a3a7f20a1_WhatsApp Image 2025-01-27 à 16.14.44_f91ffe8c.jpg', 'Encre recharge a jet rouge 100ml', '2025-01-27 15:18:00', '2025-01-27 15:18:00'),
(146, 6, 8, 'Encre recharge a jet noir 100ml', 1000, 1000, 'assets/images/produits/6797a4509b9ba_WhatsApp Image 2025-01-27 à 16.18.36_5b5ebadd.jpg', 'Boite', 'assets/images/produits/6797a4509b9be_WhatsApp Image 2025-01-27 à 16.18.36_5b5ebadd.jpg', 'Encre recharge a jet noir 100ml', '2025-01-27 15:20:48', '2025-01-27 15:20:48'),
(147, 6, 1, 'Colle bobo 70ml', 500, 400, 'assets/images/produits/6797a97219957_WhatsApp Image 2025-01-27 à 16.37.17_adea267e.jpg', 'Boite', 'assets/images/produits/6797a9721995a_WhatsApp Image 2025-01-27 à 16.37.17_adea267e.jpg', 'Colle bobo 70ml', '2025-01-27 15:42:42', '2025-01-27 15:42:42'),
(148, 6, 1, 'Colle bobo 70ml', 1000, 750, 'assets/images/produits/6797aa086e43d_WhatsApp Image 2025-01-27 à 16.41.55_2710cf92.jpg', 'Boite', 'assets/images/produits/6797aa086e443_WhatsApp Image 2025-01-27 à 16.41.55_2710cf92.jpg', 'Colle bobo 70ml', '2025-01-27 15:45:12', '2025-01-27 15:45:12'),
(149, 6, 1, 'Colle pm de 200', 200, 150, 'assets/images/produits/6797acd2a1eb1_WhatsApp Image 2025-01-27 à 16.55.53_5cb6bd85.jpg', 'Boite', 'assets/images/produits/6797acd2a1eb3_WhatsApp Image 2025-01-27 à 16.55.53_5cb6bd85.jpg', 'Colle pm de 200', '2025-01-27 15:57:06', '2025-01-27 15:57:06'),
(150, 6, 1, 'Colle (lequid glue) 100ml', 1000, 750, 'assets/images/produits/6797ae4f2c788_WhatsApp Image 2025-01-27 à 17.01.11_9bf7214b.jpg', 'Boite', 'assets/images/produits/6797ae4f2c78b_WhatsApp Image 2025-01-27 à 17.01.11_9bf7214b.jpg', 'Colle (lequid glue) 100ml', '2025-01-27 16:03:27', '2025-01-27 16:03:27'),
(151, 6, 1, 'Colle gingko (white glue)', 1000, 750, 'assets/images/produits/6797af58d9726_WhatsApp Image 2025-01-27 à 17.05.51_fa3e6e70.jpg', 'Boite', 'assets/images/produits/6797af58d972e_WhatsApp Image 2025-01-27 à 17.05.51_fa3e6e70.jpg', 'Colle gingko (white glue)', '2025-01-27 16:07:52', '2025-01-27 16:07:52'),
(152, 6, 4, 'Cahier 32ps double ligne', 150, 100, 'assets/images/produits/67987e625062e_WhatsApp Image 2025-01-28 à 07.48.05_7181dff5.jpg', 'Piece', 'assets/images/produits/67987e6250631_WhatsApp Image 2025-01-28 à 07.48.05_7181dff5.jpg', 'Cahier 32ps double ligne', '2025-01-28 06:51:14', '2025-01-28 06:51:14'),
(153, 6, 1, 'Cahier 32ps double ligne bananier', 200, 150, 'assets/images/produits/67987ef7d8be0_WhatsApp Image 2025-01-28 à 07.48.05_7181dff5.jpg', 'Piece', 'assets/images/produits/67987ef7d8be3_WhatsApp Image 2025-01-28 à 07.48.05_7181dff5.jpg', 'Cahier 32ps double ligne bananier', '2025-01-28 06:53:43', '2025-01-28 06:53:43'),
(154, 6, 1, 'Cahier 50ps A5', 150, 125, 'assets/images/produits/67987f8526c71_WhatsApp Image 2025-01-28 à 07.48.05_7181dff5.jpg', 'Piece', 'assets/images/produits/67987f8526c75_WhatsApp Image 2025-01-28 à 07.48.05_7181dff5.jpg', 'Cahier 50ps A5', '2025-01-28 06:56:05', '2025-01-28 06:56:05'),
(155, 6, 1, 'Cahier 100ps A5', 250, 225, 'assets/images/produits/6798803dc195e_WhatsApp Image 2025-01-28 à 07.56.34_b24490ed.jpg', 'Piece', 'assets/images/produits/6798803dc1962_WhatsApp Image 2025-01-28 à 07.56.34_b24490ed.jpg', 'Cahier 100ps A5', '2025-01-28 06:59:09', '2025-01-28 06:59:09'),
(156, 6, 1, 'Cahier 144ps A5', 350, 300, 'assets/images/produits/679881081b018_WhatsApp Image 2025-01-28 à 08.00.20_0f344d18.jpg', 'Piece', 'assets/images/produits/679881081b01b_WhatsApp Image 2025-01-28 à 08.00.20_0f344d18.jpg', 'Cahier 144ps A5', '2025-01-28 07:02:32', '2025-01-28 07:02:32'),
(157, 6, 1, 'Cahier 200ps A5', 500, 450, 'assets/images/produits/679881b345f19_WhatsApp Image 2025-01-28 à 08.03.01_06dc68da.jpg', 'Piece', 'assets/images/produits/679881b345f1b_WhatsApp Image 2025-01-28 à 08.03.01_06dc68da.jpg', 'Cahier 200ps A5', '2025-01-28 07:05:23', '2025-01-28 07:05:23'),
(158, 6, 1, 'Cahier 288ps A5', 700, 600, 'assets/images/produits/6798824e282a0_WhatsApp Image 2025-01-28 à 08.03.01_06dc68da.jpg', 'Piece', 'assets/images/produits/6798824e282a3_WhatsApp Image 2025-01-28 à 08.03.01_06dc68da.jpg', 'Cahier 288ps A5', '2025-01-28 07:07:58', '2025-01-28 07:07:58'),
(159, 6, 1, 'Cahier 300ps A5', 800, 700, 'assets/images/produits/6798830c78abd_WhatsApp Image 2025-01-28 à 08.08.19_346828ed.jpg', 'Piece', 'assets/images/produits/6798830c78ac1_WhatsApp Image 2025-01-28 à 08.08.19_346828ed.jpg', 'Cahier 300ps A5', '2025-01-28 07:11:08', '2025-01-28 07:11:08'),
(160, 6, 1, 'Cahier 400ps A5', 1200, 1000, 'assets/images/produits/679883da95e16_WhatsApp Image 2025-01-28 à 08.11.47_8c3ab00e.jpg', 'Piece', 'assets/images/produits/679883da95e1a_WhatsApp Image 2025-01-28 à 08.11.47_8c3ab00e.jpg', 'Cahier 400ps A5', '2025-01-28 07:14:34', '2025-01-28 07:14:34'),
(161, 6, 1, 'TP  cahier 144ps A4', 850, 750, 'assets/images/produits/679884f70701d_WhatsApp Image 2025-01-28 à 08.17.06_5e07b984.jpg', 'Piece', 'assets/images/produits/679884f707021_WhatsApp Image 2025-01-28 à 08.17.06_5e07b984.jpg', 'TP  cahier 144ps A4', '2025-01-28 07:19:19', '2025-01-28 07:19:19'),
(162, 6, 1, 'TP  cahier 200ps A4', 1200, 1000, 'assets/images/produits/679886243ab30_WhatsApp Image 2025-01-28 à 08.20.06_03632b7e.jpg', 'Piece', 'assets/images/produits/679886243ab33_WhatsApp Image 2025-01-28 à 08.20.06_03632b7e.jpg', 'TP  cahier 200ps A4', '2025-01-28 07:24:20', '2025-01-28 07:24:20'),
(163, 6, 1, 'TP  cahier 300ps A4', 2000, 1500, 'assets/images/produits/679887180f974_WhatsApp Image 2025-01-28 à 08.26.08_e73602ff.jpg', 'Piece', 'assets/images/produits/679887180f978_WhatsApp Image 2025-01-28 à 08.26.08_e73602ff.jpg', 'TP  cahier 300ps A4', '2025-01-28 07:28:24', '2025-01-28 07:28:24'),
(164, 6, 1, 'TP  cahier 400ps A4', 2500, 2000, 'assets/images/produits/679888a863682_WhatsApp Image 2025-01-28 à 08.26.08_e73602ff.jpg', 'Piece', 'assets/images/produits/679888a863685_WhatsApp Image 2025-01-28 à 08.26.08_e73602ff.jpg', 'TP  cahier 400ps A4', '2025-01-28 07:35:04', '2025-01-28 07:35:04'),
(165, 6, 1, 'Cahier 200ps A4 seyes', 1200, 1000, 'assets/images/produits/67988ad2b4472_WhatsApp Image 2025-01-28 à 08.41.38_cec37b63.jpg', 'Piece', 'assets/images/produits/67988ad2b4475_WhatsApp Image 2025-01-28 à 08.41.38_cec37b63.jpg', 'Cahier 200ps A4 seyes', '2025-01-28 07:44:18', '2025-01-28 07:44:18'),
(166, 6, 1, 'Cahier 300ps A4 seyes', 2000, 1500, 'assets/images/produits/67988c07b4344_WhatsApp Image 2025-01-28 à 08.41.38_cec37b63.jpg', 'Piece', 'assets/images/produits/67988c07b4347_WhatsApp Image 2025-01-28 à 08.41.38_cec37b63.jpg', 'Cahier 300ps A4 seyes', '2025-01-28 07:49:27', '2025-01-28 07:49:27'),
(167, 6, 1, 'Cahier 400ps A4 seyes', 2500, 2000, 'assets/images/produits/67988cdd69f9c_WhatsApp Image 2025-01-28 à 08.50.42_e4585340.jpg', 'Piece', 'assets/images/produits/67988cdd69f9f_WhatsApp Image 2025-01-28 à 08.50.42_e4585340.jpg', 'Cahier 400ps A4 seyes', '2025-01-28 07:53:01', '2025-01-28 07:53:01'),
(168, 6, 1, 'HC cahier 200ps A5', 1500, 1300, 'assets/images/produits/6798968beb1da_WhatsApp Image 2025-01-28 à 08.59.34_568e22fa.jpg', 'Piece', 'assets/images/produits/6798968beb1dd_WhatsApp Image 2025-01-28 à 08.59.34_568e22fa.jpg', 'HC cahier 200ps A5', '2025-01-28 08:34:19', '2025-01-28 08:34:19'),
(169, 6, 1, 'HC cahier 300ps A5', 2000, 1500, 'assets/images/produits/679899e3729dd_WhatsApp Image 2025-01-28 à 09.36.18_27f97210.jpg', 'Piece', 'assets/images/produits/679899e3729e4_WhatsApp Image 2025-01-28 à 09.36.18_27f97210.jpg', 'HC cahier 300ps A5', '2025-01-28 08:48:35', '2025-01-28 08:48:35'),
(170, 6, 1, 'HC cahier 400ps A5', 2500, 2000, 'assets/images/produits/67989ba36309b_WhatsApp Image 2025-01-28 à 09.53.12_6d6735c1.jpg', 'Piece', 'assets/images/produits/67989ba36309d_WhatsApp Image 2025-01-28 à 09.53.12_6d6735c1.jpg', 'HC cahier 400ps A5', '2025-01-28 08:56:03', '2025-01-28 08:56:03'),
(171, 6, 1, 'HC cahier 200ps A4', 2000, 1500, 'assets/images/produits/67989cb810b61_WhatsApp Image 2025-01-28 à 09.58.37_4e612b48.jpg', 'Piece', 'assets/images/produits/67989cb810b63_WhatsApp Image 2025-01-28 à 09.58.37_4e612b48.jpg', 'HC cahier 200ps A4', '2025-01-28 09:00:40', '2025-01-28 09:00:40'),
(172, 6, 1, 'HC cahier 300ps A4', 2500, 2000, 'assets/images/produits/67989e5ad4544_WhatsApp Image 2025-01-28 à 10.06.16_a470b60d.jpg', 'Piece', 'assets/images/produits/67989e5ad4547_WhatsApp Image 2025-01-28 à 10.06.16_a470b60d.jpg', 'HC cahier 300ps A4', '2025-01-28 09:07:38', '2025-01-28 09:07:38'),
(173, 6, 1, 'HC cahier 400ps A4', 3500, 2500, 'assets/images/produits/6798a1af9b808_WhatsApp Image 2025-01-28 à 10.20.10_76eb91a0.jpg', 'Piece', 'assets/images/produits/6798a1af9b80e_WhatsApp Image 2025-01-28 à 10.20.10_76eb91a0.jpg', 'HC cahier 400ps A4', '2025-01-28 09:21:51', '2025-01-28 09:21:51'),
(174, 6, 1, 'HC cahier 400ps A4', 200, 150, 'assets/images/produits/6798a49760d5d_WhatsApp Image 2025-01-28 à 10.28.15_82c457f3.jpg', 'Piece', 'assets/images/produits/6798a49760d60_WhatsApp Image 2025-01-28 à 10.28.15_82c457f3.jpg', 'HC cahier 400ps A4', '2025-01-28 09:34:15', '2025-01-28 09:34:15'),
(175, 6, 1, '20 leaves plain R an B', 200, 150, 'assets/images/produits/6798ad6447a41_WhatsApp Image 2025-01-28 à 10.28.15_82c457f3.jpg', 'Piece', 'assets/images/produits/6798ad6447a46_WhatsApp Image 2025-01-28 à 10.28.15_82c457f3.jpg', '20 leaves plain R an B', '2025-01-28 10:11:48', '2025-01-28 10:11:48'),
(176, 6, 1, '20 leaves plain', 200, 150, 'assets/images/produits/6798b02600de5_WhatsApp Image 2025-01-28 à 11.16.07_1ae4d7c0.jpg', 'Piece', 'assets/images/produits/6798b02600de8_WhatsApp Image 2025-01-28 à 11.16.07_1ae4d7c0.jpg', '20 leaves plain', '2025-01-28 10:23:34', '2025-01-28 10:23:34'),
(177, 6, 1, '40 leaves plain', 300, 250, 'assets/images/produits/6798b27c5270b_WhatsApp Image 2025-01-28 à 11.30.25_8ddc17a2.jpg', 'Piece', 'assets/images/produits/6798b27c52711_WhatsApp Image 2025-01-28 à 11.30.25_8ddc17a2.jpg', '40 leaves plain', '2025-01-28 10:33:32', '2025-01-28 10:33:32'),
(178, 6, 1, '60 leaves plain', 350, 300, 'assets/images/produits/6798b42a99d89_WhatsApp Image 2025-01-28 à 11.35.16_b59b4ee6.jpg', 'Piece', 'assets/images/produits/6798b42a99d8c_WhatsApp Image 2025-01-28 à 11.35.16_b59b4ee6.jpg', '60 leaves plain', '2025-01-28 10:40:42', '2025-01-28 10:40:42'),
(179, 6, 1, '80 leaves plain', 400, 350, 'assets/images/produits/679a4a18bb774_WhatsApp Image 2025-01-28 à 12.39.57_511ae006.jpg', 'Piece', 'assets/images/produits/679a4a18bb777_WhatsApp Image 2025-01-28 à 12.39.57_511ae006.jpg', '80 leaves plain', '2025-01-29 15:32:40', '2025-01-29 15:32:40'),
(180, 6, 1, '20 leaves square', 200, 150, 'assets/images/produits/679a4c2693f91_WhatsApp Image 2025-01-29 à 16.35.24_7c0ce4fc.jpg', 'Piece', 'assets/images/produits/679a4c2693f95_WhatsApp Image 2025-01-29 à 16.35.24_7c0ce4fc.jpg', '20 leaves square', '2025-01-29 15:41:26', '2025-01-29 15:41:26'),
(181, 6, 1, '40 leaves square', 300, 250, 'assets/images/produits/679a4ebcd12e8_WhatsApp Image 2025-01-29 à 16.47.41_810ad9c9.jpg', 'Piece', 'assets/images/produits/679a4ebcd12ec_WhatsApp Image 2025-01-29 à 16.47.41_810ad9c9.jpg', '40 leaves square', '2025-01-29 15:52:28', '2025-01-29 15:52:28'),
(182, 6, 1, '60 leaves square', 350, 300, 'assets/images/produits/679a501969430_WhatsApp Image 2025-01-29 à 16.53.24_eb022b32.jpg', 'Piece', 'assets/images/produits/679a501969436_WhatsApp Image 2025-01-29 à 16.53.24_eb022b32.jpg', '60 leaves square', '2025-01-29 15:58:17', '2025-01-29 15:58:17'),
(183, 6, 1, '80 leaves square', 400, 350, 'assets/images/produits/679a50c4b8e3e_WhatsApp Image 2025-01-29 à 16.59.25_b8d0688a.jpg', 'Piece', 'assets/images/produits/679a50c4b8e41_WhatsApp Image 2025-01-29 à 16.59.25_b8d0688a.jpg', '80 leaves square', '2025-01-29 16:01:08', '2025-01-29 16:01:08'),
(184, 7, 6, 'rrr', 52754, 425, 'assets/images/produits/67ab3a4f82724_71oCTNXESPL._AC_SX425_.jpg', 'Carton', 'assets/images/produits/67ab3a4f8272a_9115_livre ouvert_Horia Varlan -flickr by 20.jpg', '55', '2025-02-11 11:53:51', '2025-02-11 11:53:51');

-- --------------------------------------------------------

--
-- Structure de la table `quantite_en_stocks`
--

CREATE TABLE `quantite_en_stocks` (
  `id_quantite_en_stocks` int(11) NOT NULL,
  `id_stocks` int(11) NOT NULL,
  `id_produits` int(11) NOT NULL,
  `quantite_quantite_en_stocks` int(11) NOT NULL,
  `seuil_quantite_en_stocks` int(11) NOT NULL,
  `created_at_quantite_en_stocks` timestamp NOT NULL DEFAULT current_timestamp(),
  `updated_at_quantite_en_stocks` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Déchargement des données de la table `quantite_en_stocks`
--

INSERT INTO `quantite_en_stocks` (`id_quantite_en_stocks`, `id_stocks`, `id_produits`, `quantite_quantite_en_stocks`, `seuil_quantite_en_stocks`, `created_at_quantite_en_stocks`, `updated_at_quantite_en_stocks`) VALUES
(6, 4, 29, 0, 5, '2025-01-25 10:47:16', '2025-01-25 10:47:16'),
(7, 4, 30, 7, 5, '2025-01-25 10:52:45', '2025-01-25 10:52:45'),
(8, 4, 31, 4, 2, '2025-01-25 11:04:31', '2025-01-25 11:04:31'),
(9, 4, 32, 6, 2, '2025-01-25 11:11:03', '2025-01-25 11:11:03'),
(10, 4, 33, 6, 2, '2025-01-25 11:16:24', '2025-01-25 11:16:24'),
(11, 4, 34, 0, 2, '2025-01-25 11:20:40', '2025-01-25 11:20:40'),
(12, 4, 35, 0, 1, '2025-01-25 11:25:35', '2025-01-25 11:25:35'),
(13, 4, 36, 3, 2, '2025-01-25 11:31:16', '2025-01-25 11:31:16'),
(14, 4, 37, 0, 1, '2025-01-25 11:34:44', '2025-01-25 11:34:44'),
(15, 4, 38, 2, 1, '2025-01-25 11:40:24', '2025-01-25 11:40:24'),
(16, 3, 39, 3, 1, '2025-01-25 11:43:41', '2025-01-25 11:43:41'),
(17, 4, 40, 9, 4, '2025-01-25 11:47:24', '2025-01-25 11:47:24'),
(18, 4, 41, 15, 5, '2025-01-25 11:59:16', '2025-01-25 11:59:16'),
(19, 4, 42, 16, 5, '2025-01-25 12:04:53', '2025-01-25 12:04:53'),
(20, 4, 43, 3, 1, '2025-01-25 15:57:38', '2025-01-25 15:57:38'),
(21, 4, 44, 6, 1, '2025-01-25 16:05:45', '2025-01-25 16:05:45'),
(22, 4, 45, 66, 25, '2025-01-25 16:10:11', '2025-01-25 16:10:11'),
(23, 4, 46, 0, 0, '2025-01-25 16:13:42', '2025-01-25 16:13:42'),
(24, 4, 47, 42, 5, '2025-01-25 16:20:14', '2025-01-25 16:20:14'),
(25, 4, 48, 82, 20, '2025-01-25 16:27:09', '2025-01-25 16:27:09'),
(26, 4, 49, 59, 10, '2025-01-25 16:32:15', '2025-01-25 16:32:15'),
(27, 4, 50, 43, 10, '2025-01-25 16:39:17', '2025-01-25 16:39:17'),
(28, 4, 51, 14, 5, '2025-01-25 16:43:13', '2025-01-25 16:43:13'),
(29, 4, 52, 3, 1, '2025-01-25 16:52:26', '2025-01-25 16:52:26'),
(30, 4, 53, 44, 10, '2025-01-25 17:01:26', '2025-01-25 17:01:26'),
(31, 4, 54, 34, 5, '2025-01-25 17:07:39', '2025-01-25 17:07:39'),
(32, 4, 55, 10, 1, '2025-01-25 17:10:57', '2025-01-25 17:10:57'),
(33, 4, 56, 4, 1, '2025-01-25 17:13:39', '2025-01-25 17:13:39'),
(34, 4, 57, 3, 1, '2025-01-25 17:17:17', '2025-01-25 17:17:17'),
(35, 4, 58, 96, 5, '2025-01-25 17:26:42', '2025-01-25 17:26:42'),
(36, 4, 59, 1, 0, '2025-01-25 17:30:37', '2025-01-25 17:30:37'),
(37, 4, 60, 2, 1, '2025-01-25 17:36:55', '2025-01-25 17:36:55'),
(38, 4, 61, 1, 1, '2025-01-25 17:40:24', '2025-01-25 17:40:24'),
(39, 4, 62, 500, 50, '2025-01-25 17:43:43', '2025-01-25 17:43:43'),
(40, 4, 63, 14, 5, '2025-01-25 17:50:10', '2025-01-25 17:50:10'),
(41, 4, 64, 130, 10, '2025-01-25 17:54:08', '2025-01-25 17:54:08'),
(42, 4, 65, 96, 10, '2025-01-25 18:01:46', '2025-01-25 18:01:46'),
(43, 4, 66, 50, 10, '2025-01-25 18:09:07', '2025-01-25 18:09:07'),
(44, 4, 67, 9, 5, '2025-01-25 18:14:04', '2025-01-25 18:14:04'),
(45, 4, 68, 4, 1, '2025-01-25 18:22:49', '2025-01-25 18:22:49'),
(46, 4, 69, 5, 1, '2025-01-25 18:31:55', '2025-01-25 18:31:55'),
(47, 4, 70, 9, 1, '2025-01-25 18:36:35', '2025-01-25 18:36:35'),
(48, 4, 71, 100, 20, '2025-01-25 18:45:35', '2025-01-25 18:45:35'),
(49, 4, 72, 22, 5, '2025-01-26 09:44:46', '2025-01-26 09:44:46'),
(50, 4, 73, 7, 2, '2025-01-26 09:47:24', '2025-01-26 09:47:24'),
(51, 4, 74, 4, 1, '2025-01-26 09:51:30', '2025-01-26 09:51:30'),
(52, 4, 75, 9, 2, '2025-01-26 09:57:14', '2025-01-26 09:57:14'),
(53, 4, 76, 10, 2, '2025-01-26 10:11:30', '2025-01-26 10:11:30'),
(54, 4, 77, 2, 1, '2025-01-26 11:26:38', '2025-01-26 11:26:38'),
(55, 4, 78, 4, 1, '2025-01-26 11:30:29', '2025-01-26 11:30:29'),
(56, 4, 79, 10, 1, '2025-01-26 11:37:50', '2025-01-26 11:37:50'),
(57, 4, 80, 16, 1, '2025-01-26 11:59:39', '2025-01-26 11:59:39'),
(58, 4, 81, 46, 5, '2025-01-26 12:07:22', '2025-01-26 12:07:22'),
(59, 4, 82, 25, 0, '2025-01-26 12:13:03', '2025-01-26 12:13:03'),
(60, 4, 83, 9, 1, '2025-01-26 12:43:22', '2025-01-26 12:43:22'),
(61, 4, 84, 11, 1, '2025-01-26 12:48:58', '2025-01-26 12:48:58'),
(62, 4, 85, 10, 1, '2025-01-26 12:53:49', '2025-01-26 12:53:49'),
(63, 4, 86, 50, 10, '2025-01-26 13:58:33', '2025-01-26 13:58:33'),
(64, 4, 87, 30, 5, '2025-01-26 14:09:28', '2025-01-26 14:09:28'),
(65, 4, 88, 300, 25, '2025-01-26 14:18:49', '2025-01-26 14:18:49'),
(66, 4, 89, 9, 1, '2025-01-26 14:21:50', '2025-01-26 14:21:50'),
(67, 4, 90, 4, 1, '2025-01-26 14:26:25', '2025-01-26 14:26:25'),
(68, 4, 91, 2, 1, '2025-01-26 14:55:39', '2025-01-26 14:55:39'),
(69, 4, 92, 7, 2, '2025-01-26 18:07:31', '2025-01-26 18:07:31'),
(70, 4, 93, 20, 1, '2025-01-26 18:11:46', '2025-01-26 18:11:46'),
(71, 4, 94, 4, 1, '2025-01-26 18:14:51', '2025-01-26 18:14:51'),
(72, 4, 95, 5, 1, '2025-01-26 18:19:14', '2025-01-26 18:19:14'),
(73, 4, 96, 46, 1, '2025-01-26 18:27:33', '2025-01-26 18:27:33'),
(74, 4, 97, 35, 1, '2025-01-26 18:31:31', '2025-01-26 18:31:31'),
(75, 4, 98, 25, 1, '2025-01-26 18:35:14', '2025-01-26 18:35:14'),
(76, 4, 99, 18, 1, '2025-01-26 18:39:14', '2025-01-26 18:39:14'),
(77, 4, 100, 14, 1, '2025-01-26 18:44:56', '2025-01-26 18:44:56'),
(78, 4, 101, 13, 1, '2025-01-26 18:49:25', '2025-01-26 18:49:25'),
(79, 4, 102, 2, 1, '2025-01-26 18:58:08', '2025-01-26 18:58:08'),
(80, 4, 103, 125, 1, '2025-01-26 19:09:57', '2025-01-26 19:09:57'),
(81, 4, 104, 147, 1, '2025-01-26 19:12:46', '2025-01-26 19:12:46'),
(82, 4, 105, 103, 1, '2025-01-26 19:18:57', '2025-01-26 19:18:57'),
(83, 4, 106, 95, 1, '2025-01-26 19:24:17', '2025-01-26 19:24:17'),
(84, 4, 107, 76, 1, '2025-01-26 19:31:01', '2025-01-26 19:31:01'),
(85, 4, 108, 15, 1, '2025-01-26 19:35:19', '2025-01-26 19:35:19'),
(86, 4, 109, 2, 1, '2025-01-26 19:40:09', '2025-01-26 19:40:09'),
(87, 4, 110, 54, 1, '2025-01-26 19:47:09', '2025-01-26 19:47:09'),
(88, 4, 111, 13, 1, '2025-01-26 20:04:02', '2025-01-26 20:04:02'),
(89, 4, 112, 9, 1, '2025-01-26 20:07:10', '2025-01-26 20:07:10'),
(90, 4, 113, 7, 1, '2025-01-26 20:10:53', '2025-01-26 20:10:53'),
(91, 4, 114, 8, 1, '2025-01-26 20:14:10', '2025-01-26 20:14:10'),
(92, 4, 115, 13, 1, '2025-01-26 20:17:47', '2025-01-26 20:17:47'),
(93, 4, 116, 46, 5, '2025-01-27 07:46:30', '2025-01-27 07:46:30'),
(94, 4, 117, 99, 5, '2025-01-27 07:49:40', '2025-01-27 07:49:40'),
(95, 4, 118, 146, 5, '2025-01-27 07:57:01', '2025-01-27 07:57:01'),
(96, 4, 119, 3, 1, '2025-01-27 08:02:03', '2025-01-27 08:02:03'),
(97, 4, 120, 77, 5, '2025-01-27 08:08:41', '2025-01-27 08:08:41'),
(98, 4, 121, 12, 1, '2025-01-27 08:12:33', '2025-01-27 08:12:33'),
(99, 4, 122, 30, 1, '2025-01-27 08:17:41', '2025-01-27 08:17:41'),
(100, 4, 123, 20, 1, '2025-01-27 08:21:32', '2025-01-27 08:21:32'),
(101, 4, 124, 75, 1, '2025-01-27 08:34:05', '2025-01-27 08:34:05'),
(102, 4, 125, 147, 1, '2025-01-27 08:39:10', '2025-01-27 08:39:10'),
(103, 4, 126, 12, 1, '2025-01-27 08:45:16', '2025-01-27 08:45:16'),
(104, 4, 127, 77, 5, '2025-01-27 08:50:51', '2025-01-27 08:50:51'),
(105, 4, 128, 400, 50, '2025-01-27 09:28:16', '2025-01-27 09:28:16'),
(106, 4, 129, 150, 50, '2025-01-27 09:31:52', '2025-01-27 09:31:52'),
(107, 4, 130, 150, 50, '2025-01-27 09:40:33', '2025-01-27 09:40:33'),
(108, 4, 131, 100, 50, '2025-01-27 09:46:18', '2025-01-27 09:46:18'),
(109, 4, 132, 200, 50, '2025-01-27 09:52:01', '2025-01-27 09:52:01'),
(110, 4, 133, 100, 50, '2025-01-27 09:56:04', '2025-01-27 09:56:04'),
(111, 3, 134, 50, 10, '2025-01-27 10:00:04', '2025-01-27 10:00:04'),
(112, 4, 135, 0, 50, '2025-01-27 10:03:30', '2025-01-27 10:03:30'),
(113, 4, 136, 150, 50, '2025-01-27 10:07:26', '2025-01-27 10:07:26'),
(114, 4, 137, 11, 1, '2025-01-27 10:35:48', '2025-01-27 10:35:48'),
(115, 4, 138, 4, 1, '2025-01-27 10:38:57', '2025-01-27 10:38:57'),
(116, 4, 139, 8, 1, '2025-01-27 10:44:37', '2025-01-27 10:44:37'),
(117, 4, 140, 1, 1, '2025-01-27 11:17:26', '2025-01-27 11:17:26'),
(118, 4, 141, 15, 1, '2025-01-27 11:22:07', '2025-01-27 11:22:07'),
(119, 4, 142, 1, 1, '2025-01-27 11:32:01', '2025-01-27 11:32:01'),
(120, 4, 143, 8, 1, '2025-01-27 11:42:01', '2025-01-27 11:42:01'),
(121, 4, 144, 3, 1, '2025-01-27 15:14:09', '2025-01-27 15:14:09'),
(122, 4, 145, 5, 1, '2025-01-27 15:18:00', '2025-01-27 15:18:00'),
(123, 4, 146, 5, 1, '2025-01-27 15:20:48', '2025-01-27 15:20:48'),
(124, 4, 147, 1, 1, '2025-01-27 15:42:42', '2025-01-27 15:42:42'),
(125, 4, 148, 14, 1, '2025-01-27 15:45:12', '2025-01-27 15:45:12'),
(126, 4, 149, 120, 10, '2025-01-27 15:57:06', '2025-01-27 15:57:06'),
(127, 4, 150, 22, 1, '2025-01-27 16:03:27', '2025-01-27 16:03:27'),
(128, 3, 151, 13, 1, '2025-01-27 16:07:52', '2025-01-27 16:07:52'),
(129, 4, 152, 280, 5, '2025-01-28 06:51:14', '2025-01-28 06:51:14'),
(130, 4, 153, 0, 0, '2025-01-28 06:53:43', '2025-01-28 06:53:43'),
(131, 4, 154, 0, 0, '2025-01-28 06:56:05', '2025-01-28 06:56:05'),
(132, 4, 155, 200, 5, '2025-01-28 06:59:09', '2025-01-28 06:59:09'),
(133, 4, 156, 89, 5, '2025-01-28 07:02:32', '2025-01-28 07:02:32'),
(134, 4, 157, 42, 5, '2025-01-28 07:05:23', '2025-01-28 07:05:23'),
(135, 4, 158, 0, 0, '2025-01-28 07:07:58', '2025-01-28 07:07:58'),
(136, 4, 159, 58, 5, '2025-01-28 07:11:08', '2025-01-28 07:11:08'),
(137, 3, 160, 12, 1, '2025-01-28 07:14:34', '2025-01-28 07:14:34'),
(138, 4, 161, 1, 1, '2025-01-28 07:19:19', '2025-01-28 07:19:19'),
(139, 4, 162, 19, 1, '2025-01-28 07:24:20', '2025-01-28 07:24:20'),
(140, 4, 163, 19, 1, '2025-01-28 07:28:24', '2025-01-28 07:28:24'),
(141, 4, 164, 100, 1, '2025-01-28 07:35:04', '2025-01-28 07:35:04'),
(142, 4, 165, 0, 0, '2025-01-28 07:44:18', '2025-01-28 07:44:18'),
(143, 4, 166, 32, 1, '2025-01-28 07:49:27', '2025-01-28 07:49:27'),
(144, 4, 167, 27, 1, '2025-01-28 07:53:01', '2025-01-28 07:53:01'),
(145, 4, 168, 0, 0, '2025-01-28 08:34:20', '2025-01-28 08:34:20'),
(146, 4, 169, 18, 1, '2025-01-28 08:48:35', '2025-01-28 08:48:35'),
(147, 4, 170, 20, 1, '2025-01-28 08:56:03', '2025-01-28 08:56:03'),
(148, 4, 171, 31, 1, '2025-01-28 09:00:40', '2025-01-28 09:00:40'),
(149, 4, 172, 28, 1, '2025-01-28 09:07:38', '2025-01-28 09:07:38'),
(150, 4, 173, 12, 1, '2025-01-28 09:21:51', '2025-01-28 09:21:51'),
(151, 4, 174, 90, 1, '2025-01-28 09:34:15', '2025-01-28 09:34:15'),
(152, 4, 175, 90, 1, '2025-01-28 10:11:48', '2025-01-28 10:11:48'),
(153, 4, 176, 133, 1, '2025-01-28 10:23:34', '2025-01-28 10:23:34'),
(154, 4, 177, 0, 0, '2025-01-28 10:33:32', '2025-01-28 10:33:32'),
(155, 4, 178, 41, 1, '2025-01-28 10:40:42', '2025-01-28 10:40:42'),
(156, 4, 179, 105, 1, '2025-01-29 15:32:40', '2025-01-29 15:32:40'),
(157, 4, 180, 0, 1, '2025-01-29 15:41:26', '2025-01-29 15:41:26'),
(158, 4, 181, 229, 1, '2025-01-29 15:52:28', '2025-01-29 15:52:28'),
(159, 4, 182, 220, 1, '2025-01-29 15:58:17', '2025-01-29 15:58:17'),
(160, 4, 183, 64, 1, '2025-01-29 16:01:08', '2025-01-29 16:01:08'),
(161, 4, 184, 5, 5, '2025-02-11 11:53:51', '2025-02-11 11:53:51');

-- --------------------------------------------------------

--
-- Structure de la table `stocks`
--

CREATE TABLE `stocks` (
  `id_stocks` int(11) NOT NULL,
  `nom_stocks` varchar(250) NOT NULL,
  `created_at_stocks` timestamp NOT NULL DEFAULT current_timestamp(),
  `updated_at_stocks` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Déchargement des données de la table `stocks`
--

INSERT INTO `stocks` (`id_stocks`, `nom_stocks`, `created_at_stocks`, `updated_at_stocks`) VALUES
(3, 'magasin', '2024-12-30 23:34:55', '2024-12-30 23:34:55'),
(4, 'boutique', '2024-12-31 03:56:18', '2025-01-14 18:08:25');

-- --------------------------------------------------------

--
-- Structure de la table `utilisateurs`
--

CREATE TABLE `utilisateurs` (
  `id_utilisateurs` int(11) NOT NULL,
  `id_personnels` int(11) NOT NULL,
  `username` varchar(250) NOT NULL,
  `password` varchar(250) NOT NULL,
  `created_at_utilisateurs` timestamp NOT NULL DEFAULT current_timestamp(),
  `updated_at_utilisateurs` timestamp NOT NULL DEFAULT current_timestamp(),
  `session_id` varchar(255) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Déchargement des données de la table `utilisateurs`
--

INSERT INTO `utilisateurs` (`id_utilisateurs`, `id_personnels`, `username`, `password`, `created_at_utilisateurs`, `updated_at_utilisateurs`, `session_id`) VALUES
(6, 5, 'rocky', '$2y$10$B3uj5hz6aqVB9xCyP6c7YeEv6rA2WXa5/IG5iGNKBKDXE6DeyENVu', '2025-01-14 18:07:25', '2025-01-15 16:06:19', 'kl15apm44curkamo4kfrk96huq'),
(7, 6, 'sorelle', '$2y$10$mQXLlnoHg9LbTNYIen4ra.9bTwEBbmNK0Dl6XNB3SD0WZNjpltRwq', '2025-01-15 16:32:53', '2025-01-15 16:32:53', 'o1etfmmnm5upancu1cnh0cdnb7'),
(8, 7, 'wilfried', '$2y$10$L70.gr9EO0kdecYxhqH9Tuy0dsAiryesR0xN9LTkD1b6OuSHlFjRm', '2025-01-16 11:37:14', '2025-01-16 11:37:14', '9d9fb1i1ljgoti3g98sl1tmni4');

-- --------------------------------------------------------

--
-- Structure de la table `ventes`
--

CREATE TABLE `ventes` (
  `id_ventes` int(11) NOT NULL,
  `id_personnels` int(11) NOT NULL,
  `id_clients` int(11) NOT NULL,
  `total_ventes` decimal(10,0) NOT NULL,
  `reduction_ventes` decimal(10,0) NOT NULL,
  `numero_facture_ventes` varchar(250) NOT NULL,
  `created_at_ventes` timestamp NOT NULL DEFAULT current_timestamp(),
  `updated_at_ventes` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Déchargement des données de la table `ventes`
--

INSERT INTO `ventes` (`id_ventes`, `id_personnels`, `id_clients`, `total_ventes`, `reduction_ventes`, `numero_facture_ventes`, `created_at_ventes`, `updated_at_ventes`) VALUES
(592, 5, 8, 5000, 0, '20250219-153523-FAC-67b5ec2b32531', '2025-02-19 14:35:23', '2025-02-19 14:35:23'),
(594, 5, 8, 2000, 0, '20250219-153802-FAC-67b5ecca95595', '2025-02-19 14:38:02', '2025-02-19 14:38:02'),
(595, 5, 8, 9000, 0, '20250219-154029-FAC-67b5ed5d40c03', '2025-02-19 14:40:29', '2025-02-19 14:40:29'),
(596, 5, 8, 9000, 0, '20250220-134337-FAC-67b723792eca4', '2025-02-20 12:43:37', '2025-02-20 12:43:37'),
(597, 5, 8, 3100, 0, '20250220-134537-FAC-67b723f100019', '2025-02-20 12:45:37', '2025-02-20 12:45:37');

-- --------------------------------------------------------

--
-- Structure de la table `ventes_produits`
--

CREATE TABLE `ventes_produits` (
  `id_ventes_produits` int(11) NOT NULL,
  `id_produits` int(11) NOT NULL,
  `id_ventes` int(11) NOT NULL,
  `quantite_ventes_produits` int(11) NOT NULL,
  `prix_ventes_produits` varchar(250) NOT NULL,
  `created_at_ventes_produits` timestamp NOT NULL DEFAULT current_timestamp(),
  `updated_at_ventes_produits` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Déchargement des données de la table `ventes_produits`
--

INSERT INTO `ventes_produits` (`id_ventes_produits`, `id_produits`, `id_ventes`, `quantite_ventes_produits`, `prix_ventes_produits`, `created_at_ventes_produits`, `updated_at_ventes_produits`) VALUES
(932, 30, 592, 1, '3500', '2025-02-19 14:35:23', '2025-02-19 14:35:23'),
(933, 31, 592, 1, '1500', '2025-02-19 14:35:23', '2025-02-19 14:35:23'),
(936, 53, 594, 1, '500', '2025-02-19 14:38:02', '2025-02-19 14:38:02'),
(937, 51, 594, 1, '1500', '2025-02-19 14:38:02', '2025-02-19 14:38:02'),
(938, 41, 595, 1, '5000', '2025-02-19 14:40:29', '2025-02-19 14:40:29'),
(939, 37, 595, 1, '4000', '2025-02-19 14:40:29', '2025-02-19 14:40:29'),
(940, 37, 596, 1, '4000', '2025-02-20 12:43:37', '2025-02-20 12:43:37'),
(941, 41, 596, 1, '5000', '2025-02-20 12:43:37', '2025-02-20 12:43:37'),
(942, 67, 597, 1, '1300', '2025-02-20 12:45:37', '2025-02-20 12:45:37'),
(943, 68, 597, 1, '1800', '2025-02-20 12:45:37', '2025-02-20 12:45:37');

--
-- Index pour les tables déchargées
--

--
-- Index pour la table `achats`
--
ALTER TABLE `achats`
  ADD PRIMARY KEY (`id_achats`);

--
-- Index pour la table `achats_produits`
--
ALTER TABLE `achats_produits`
  ADD PRIMARY KEY (`id_achats_produits`),
  ADD KEY `id_achats` (`id_achats`,`id_produits`),
  ADD KEY `id_produits_fournisseurs` (`id_produits`);

--
-- Index pour la table `ajustements_de_stocks`
--
ALTER TABLE `ajustements_de_stocks`
  ADD PRIMARY KEY (`id_ajustements_de_stocks`),
  ADD KEY `id_produits` (`id_quantite_en_stocks`);

--
-- Index pour la table `categorie_produits`
--
ALTER TABLE `categorie_produits`
  ADD PRIMARY KEY (`id_categorie_produits`);

--
-- Index pour la table `clients`
--
ALTER TABLE `clients`
  ADD PRIMARY KEY (`id_clients`);

--
-- Index pour la table `dettes_clients`
--
ALTER TABLE `dettes_clients`
  ADD PRIMARY KEY (`id_dettes_clients`),
  ADD KEY `id_clients` (`id_clients`),
  ADD KEY `id_ventes` (`id_ventes`);

--
-- Index pour la table `dettes_fournisseurs`
--
ALTER TABLE `dettes_fournisseurs`
  ADD PRIMARY KEY (`id_dettes_fournisseurs`),
  ADD KEY `id_fournisseurs` (`id_fournisseurs`);

--
-- Index pour la table `fournisseurs`
--
ALTER TABLE `fournisseurs`
  ADD PRIMARY KEY (`id_fournisseurs`);

--
-- Index pour la table `historique_transfert`
--
ALTER TABLE `historique_transfert`
  ADD PRIMARY KEY (`id_historique_transfert`),
  ADD KEY `id_stocks` (`id_stocks`),
  ADD KEY `id_produits` (`id_produits`);

--
-- Index pour la table `paiements_dettes_clients`
--
ALTER TABLE `paiements_dettes_clients`
  ADD PRIMARY KEY (`id_paiements_dettes_clients`),
  ADD KEY `id_dettes` (`id_dettes_clients`);

--
-- Index pour la table `paiements_dettes_fournisseurs`
--
ALTER TABLE `paiements_dettes_fournisseurs`
  ADD PRIMARY KEY (`id_paiements_dettes_fournisseurs`),
  ADD KEY `id_dettes_fournisseurs` (`id_dettes_fournisseurs`);

--
-- Index pour la table `personnels`
--
ALTER TABLE `personnels`
  ADD PRIMARY KEY (`id_personnels`);

--
-- Index pour la table `produits`
--
ALTER TABLE `produits`
  ADD PRIMARY KEY (`id_produits`),
  ADD KEY `id_fournisseurs` (`id_fournisseurs`),
  ADD KEY `id_categorie_produits` (`id_categorie_produits`);

--
-- Index pour la table `quantite_en_stocks`
--
ALTER TABLE `quantite_en_stocks`
  ADD PRIMARY KEY (`id_quantite_en_stocks`),
  ADD KEY `id_stocks` (`id_stocks`,`id_produits`),
  ADD KEY `id_produits` (`id_produits`);

--
-- Index pour la table `stocks`
--
ALTER TABLE `stocks`
  ADD PRIMARY KEY (`id_stocks`);

--
-- Index pour la table `utilisateurs`
--
ALTER TABLE `utilisateurs`
  ADD PRIMARY KEY (`id_utilisateurs`),
  ADD KEY `id_personnels` (`id_personnels`);

--
-- Index pour la table `ventes`
--
ALTER TABLE `ventes`
  ADD PRIMARY KEY (`id_ventes`),
  ADD KEY `id_personnels` (`id_personnels`,`id_clients`),
  ADD KEY `id_clients` (`id_clients`);

--
-- Index pour la table `ventes_produits`
--
ALTER TABLE `ventes_produits`
  ADD PRIMARY KEY (`id_ventes_produits`),
  ADD KEY `id_produits` (`id_produits`,`id_ventes`),
  ADD KEY `id_ventes` (`id_ventes`);

--
-- AUTO_INCREMENT pour les tables déchargées
--

--
-- AUTO_INCREMENT pour la table `achats`
--
ALTER TABLE `achats`
  MODIFY `id_achats` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=11;

--
-- AUTO_INCREMENT pour la table `achats_produits`
--
ALTER TABLE `achats_produits`
  MODIFY `id_achats_produits` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=20;

--
-- AUTO_INCREMENT pour la table `ajustements_de_stocks`
--
ALTER TABLE `ajustements_de_stocks`
  MODIFY `id_ajustements_de_stocks` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT pour la table `categorie_produits`
--
ALTER TABLE `categorie_produits`
  MODIFY `id_categorie_produits` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;

--
-- AUTO_INCREMENT pour la table `clients`
--
ALTER TABLE `clients`
  MODIFY `id_clients` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=13;

--
-- AUTO_INCREMENT pour la table `dettes_clients`
--
ALTER TABLE `dettes_clients`
  MODIFY `id_dettes_clients` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=22;

--
-- AUTO_INCREMENT pour la table `fournisseurs`
--
ALTER TABLE `fournisseurs`
  MODIFY `id_fournisseurs` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;

--
-- AUTO_INCREMENT pour la table `historique_transfert`
--
ALTER TABLE `historique_transfert`
  MODIFY `id_historique_transfert` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=15;

--
-- AUTO_INCREMENT pour la table `paiements_dettes_clients`
--
ALTER TABLE `paiements_dettes_clients`
  MODIFY `id_paiements_dettes_clients` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT pour la table `personnels`
--
ALTER TABLE `personnels`
  MODIFY `id_personnels` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;

--
-- AUTO_INCREMENT pour la table `produits`
--
ALTER TABLE `produits`
  MODIFY `id_produits` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=185;

--
-- AUTO_INCREMENT pour la table `quantite_en_stocks`
--
ALTER TABLE `quantite_en_stocks`
  MODIFY `id_quantite_en_stocks` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=162;

--
-- AUTO_INCREMENT pour la table `stocks`
--
ALTER TABLE `stocks`
  MODIFY `id_stocks` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;

--
-- AUTO_INCREMENT pour la table `utilisateurs`
--
ALTER TABLE `utilisateurs`
  MODIFY `id_utilisateurs` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;

--
-- AUTO_INCREMENT pour la table `ventes`
--
ALTER TABLE `ventes`
  MODIFY `id_ventes` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=598;

--
-- AUTO_INCREMENT pour la table `ventes_produits`
--
ALTER TABLE `ventes_produits`
  MODIFY `id_ventes_produits` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=944;

--
-- Contraintes pour les tables déchargées
--

--
-- Contraintes pour la table `achats_produits`
--
ALTER TABLE `achats_produits`
  ADD CONSTRAINT `achats_produits_ibfk_1` FOREIGN KEY (`id_achats`) REFERENCES `achats` (`id_achats`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Contraintes pour la table `ajustements_de_stocks`
--
ALTER TABLE `ajustements_de_stocks`
  ADD CONSTRAINT `ajustements_de_stocks_ibfk_1` FOREIGN KEY (`id_quantite_en_stocks`) REFERENCES `quantite_en_stocks` (`id_quantite_en_stocks`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Contraintes pour la table `dettes_clients`
--
ALTER TABLE `dettes_clients`
  ADD CONSTRAINT `dettes_clients_ibfk_1` FOREIGN KEY (`id_clients`) REFERENCES `clients` (`id_clients`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `dettes_clients_ibfk_2` FOREIGN KEY (`id_ventes`) REFERENCES `ventes` (`id_ventes`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Contraintes pour la table `dettes_fournisseurs`
--
ALTER TABLE `dettes_fournisseurs`
  ADD CONSTRAINT `dettes_fournisseurs_ibfk_1` FOREIGN KEY (`id_fournisseurs`) REFERENCES `fournisseurs` (`id_fournisseurs`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Contraintes pour la table `historique_transfert`
--
ALTER TABLE `historique_transfert`
  ADD CONSTRAINT `historique_transfert_ibfk_1` FOREIGN KEY (`id_stocks`) REFERENCES `stocks` (`id_stocks`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `historique_transfert_ibfk_2` FOREIGN KEY (`id_produits`) REFERENCES `produits` (`id_produits`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Contraintes pour la table `paiements_dettes_clients`
--
ALTER TABLE `paiements_dettes_clients`
  ADD CONSTRAINT `paiements_dettes_clients_ibfk_1` FOREIGN KEY (`id_dettes_clients`) REFERENCES `dettes_clients` (`id_dettes_clients`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Contraintes pour la table `paiements_dettes_fournisseurs`
--
ALTER TABLE `paiements_dettes_fournisseurs`
  ADD CONSTRAINT `paiements_dettes_fournisseurs_ibfk_1` FOREIGN KEY (`id_dettes_fournisseurs`) REFERENCES `dettes_fournisseurs` (`id_dettes_fournisseurs`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Contraintes pour la table `produits`
--
ALTER TABLE `produits`
  ADD CONSTRAINT `produits_ibfk_1` FOREIGN KEY (`id_fournisseurs`) REFERENCES `fournisseurs` (`id_fournisseurs`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `produits_ibfk_2` FOREIGN KEY (`id_categorie_produits`) REFERENCES `categorie_produits` (`id_categorie_produits`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Contraintes pour la table `quantite_en_stocks`
--
ALTER TABLE `quantite_en_stocks`
  ADD CONSTRAINT `quantite_en_stocks_ibfk_1` FOREIGN KEY (`id_produits`) REFERENCES `produits` (`id_produits`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `quantite_en_stocks_ibfk_2` FOREIGN KEY (`id_stocks`) REFERENCES `stocks` (`id_stocks`) ON DELETE CASCADE ON UPDATE NO ACTION;

--
-- Contraintes pour la table `utilisateurs`
--
ALTER TABLE `utilisateurs`
  ADD CONSTRAINT `utilisateurs_ibfk_1` FOREIGN KEY (`id_personnels`) REFERENCES `personnels` (`id_personnels`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Contraintes pour la table `ventes`
--
ALTER TABLE `ventes`
  ADD CONSTRAINT `ventes_ibfk_1` FOREIGN KEY (`id_personnels`) REFERENCES `personnels` (`id_personnels`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `ventes_ibfk_2` FOREIGN KEY (`id_clients`) REFERENCES `clients` (`id_clients`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Contraintes pour la table `ventes_produits`
--
ALTER TABLE `ventes_produits`
  ADD CONSTRAINT `ventes_produits_ibfk_1` FOREIGN KEY (`id_ventes`) REFERENCES `ventes` (`id_ventes`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `ventes_produits_ibfk_2` FOREIGN KEY (`id_produits`) REFERENCES `produits` (`id_produits`) ON DELETE CASCADE ON UPDATE CASCADE;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
