-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Hôte : 127.0.0.1
-- Généré le : sam. 13 déc. 2025 à 11:53
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
-- Base de données : `p8_tasklinder`
--

-- --------------------------------------------------------

--
-- Structure de la table `doctrine_migration_versions`
--

CREATE TABLE `doctrine_migration_versions` (
  `version` varchar(191) NOT NULL,
  `executed_at` datetime DEFAULT NULL,
  `execution_time` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Déchargement des données de la table `doctrine_migration_versions`
--

INSERT INTO `doctrine_migration_versions` (`version`, `executed_at`, `execution_time`) VALUES
('DoctrineMigrations\\Version20251208132837', '2025-12-08 14:34:20', 261);

-- --------------------------------------------------------

--
-- Structure de la table `employe`
--

CREATE TABLE `employe` (
  `id` int(11) NOT NULL,
  `prenom` varchar(255) NOT NULL,
  `nom` varchar(255) NOT NULL,
  `email` varchar(255) NOT NULL,
  `date_entree` date NOT NULL,
  `statut_id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Déchargement des données de la table `employe`
--

INSERT INTO `employe` (`id`, `prenom`, `nom`, `email`, `date_entree`, `statut_id`) VALUES
(1, 'Marvin', 'Etha', 'bauch.dorris@rice.com', '2025-04-27', 1),
(2, 'Stoltenberg', 'Trent', 'hnicolas@metz.net', '2021-03-08', 2),
(3, 'Prohaska', 'Milo', 'luisa00@gmail.com', '2025-02-08', 3),
(4, 'Rice', 'Leif', 'sasha61@flatley.net', '2024-06-05', 4),
(5, 'Ernser', 'Raoul', 'arlie88@gusikowski.info', '2023-11-11', 5),
(6, 'Cole', 'Demetris', 'greta.klocko@hotmail.com', '2022-07-08', 5),
(7, 'Schultz', 'Chanelle', 'dare.alva@hotmail.com', '2024-12-14', 3),
(8, 'Gleason', 'Nathanael', 'pschultz@gmail.com', '2022-10-05', 1),
(9, 'Gleichner', 'Robin', 'daphnee.sipes@halvorson.com', '2025-11-24', 1),
(10, 'Kerluke', 'Jany', 'treutel.christa@nader.net', '2023-07-22', 1),
(11, 'Steuber', 'Rachael', 'garrick77@gmail.com', '2025-04-02', 5),
(12, 'Rau', 'Bertram', 'walter.elisa@gmail.com', '2025-10-09', 4),
(13, 'Runte', 'Pansy', 'qbecker@marquardt.com', '2022-05-06', 4),
(14, 'Crona', 'Shawna', 'zdavis@douglas.org', '2024-08-09', 1),
(15, 'Reilly', 'Ambrose', 'ybraun@zieme.net', '2024-01-13', 2);

-- --------------------------------------------------------

--
-- Structure de la table `messenger_messages`
--

CREATE TABLE `messenger_messages` (
  `id` bigint(20) NOT NULL,
  `body` longtext NOT NULL,
  `headers` longtext NOT NULL,
  `queue_name` varchar(190) NOT NULL,
  `created_at` datetime NOT NULL,
  `available_at` datetime NOT NULL,
  `delivered_at` datetime DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Structure de la table `projet`
--

CREATE TABLE `projet` (
  `id` int(11) NOT NULL,
  `titre` varchar(255) NOT NULL,
  `est_archive` tinyint(4) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Déchargement des données de la table `projet`
--

INSERT INTO `projet` (`id`, `titre`, `est_archive`) VALUES
(1, 'Yost, Hauck and Dibbert', 0),
(2, 'Schaden-Stanton', 0),
(3, 'Spencer LLC', 0),
(4, 'Casper, Cartwright and Murray', 0),
(5, 'Moore-Keebler', 0),
(10, 'test', 1);

-- --------------------------------------------------------

--
-- Structure de la table `projet_employe`
--

CREATE TABLE `projet_employe` (
  `projet_id` int(11) NOT NULL,
  `employe_id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Déchargement des données de la table `projet_employe`
--

INSERT INTO `projet_employe` (`projet_id`, `employe_id`) VALUES
(1, 2),
(1, 8),
(1, 10),
(2, 7),
(2, 8),
(2, 9),
(2, 10),
(2, 11),
(2, 13),
(2, 15),
(3, 7),
(3, 8),
(3, 10),
(3, 13),
(3, 14),
(4, 4),
(4, 7),
(5, 2),
(5, 3),
(5, 4),
(5, 7),
(5, 8),
(5, 9),
(5, 13),
(5, 15);

-- --------------------------------------------------------

--
-- Structure de la table `statut_employe`
--

CREATE TABLE `statut_employe` (
  `id` int(11) NOT NULL,
  `libelle` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Déchargement des données de la table `statut_employe`
--

INSERT INTO `statut_employe` (`id`, `libelle`) VALUES
(1, 'CDI'),
(2, 'CDD'),
(3, 'Stagiaire'),
(4, 'Alternant'),
(5, 'Freelance');

-- --------------------------------------------------------

--
-- Structure de la table `tache`
--

CREATE TABLE `tache` (
  `id` int(11) NOT NULL,
  `titre` varchar(255) NOT NULL,
  `description` longtext DEFAULT NULL,
  `deadline` date DEFAULT NULL,
  `statut` enum('To Do','Doing','Done') NOT NULL DEFAULT 'To Do',
  `projet_id` int(11) NOT NULL,
  `employe_assigne_id` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Déchargement des données de la table `tache`
--

INSERT INTO `tache` (`id`, `titre`, `description`, `deadline`, `statut`, `projet_id`, `employe_assigne_id`) VALUES
(1, 'Vero enim ea qui est excepturi.', 'At non consequatur odit quidem quaerat error. Incidunt accusantium dolorem eveniet ut quia veniam est. Voluptatem omnis ab ratione unde.', '2025-12-14', 'Doing', 2, 11),
(2, 'Aliquam facilis et eum.', 'Est quis itaque architecto eos. Nemo reprehenderit suscipit omnis beatae reprehenderit. Accusantium tempora velit odit.', '2026-02-28', 'Doing', 1, 15),
(3, 'In sint quia.', 'Dolorum ut omnis sunt rem vitae quos. Atque ipsam velit ipsum ipsum necessitatibus at officiis.', NULL, 'To Do', 1, 12),
(4, 'Cupiditate molestias occaecati saepe beatae.', NULL, '2026-02-05', 'To Do', 1, 11),
(5, 'Aut vitae nam ut voluptatem et.', 'Sunt dolor est ad dolore impedit. Ab sunt dolor excepturi reiciendis est sed pariatur explicabo. Asperiores quis harum excepturi atque dolores voluptas et.', '2026-02-19', 'Doing', 5, 1),
(6, 'Sint officia necessitatibus dolores et et.', 'Ea voluptatem harum ut accusamus numquam vitae. Cupiditate est odit inventore provident non eius voluptatem. Rerum officiis voluptas voluptas debitis doloremque eveniet maiores.', NULL, 'Done', 2, 10),
(7, 'Dolor qui saepe.', 'Accusamus quo pariatur ut sit ab asperiores eaque nesciunt. Quo ipsam molestiae similique. Earum id est magni.', NULL, 'To Do', 5, 6),
(8, 'Dolor nesciunt totam.', 'Et voluptates ipsa distinctio cumque. Voluptatem rerum consequatur doloribus nisi velit quibusdam provident cumque. Qui dolores recusandae dolores laboriosam harum dolorum amet dolores.', '2025-12-26', 'Doing', 4, 7),
(9, 'Voluptatem expedita aliquam.', 'Temporibus provident ut consequatur eum temporibus. Atque possimus molestiae qui doloribus. Et consequatur aut sunt aut similique.', '2025-12-12', 'Doing', 4, 4),
(10, 'Ducimus commodi laudantium voluptas iste reprehenderit.', 'Aut est quas qui repudiandae earum. Est sed non aut alias.', NULL, 'Doing', 2, 11),
(11, 'Sed officia corporis quisquam.', 'Enim et et temporibus quis et consequatur tempore optio. Consequuntur sed voluptas maiores aut omnis architecto. Doloremque ipsam non nostrum aliquid laboriosam qui recusandae.', NULL, 'Doing', 1, 8),
(12, 'Alias minus in distinctio.', 'Sed nostrum et tenetur vel laborum. Fuga incidunt sit ut id. Animi beatae beatae et eveniet vel voluptate totam.', '2026-02-01', 'Done', 2, NULL),
(13, 'Eos alias voluptates molestiae explicabo ex.', NULL, '2026-01-24', 'Doing', 4, NULL),
(14, 'Tempore adipisci alias fuga laudantium.', 'Quis perspiciatis ipsa et sed recusandae et in. Omnis neque iste deserunt consequatur qui et. Ea aut molestiae ut maiores eum.', NULL, 'To Do', 2, 15),
(15, 'Et dolores omnis est.', 'Quae molestiae eligendi voluptas facere. Ipsum ut ut repellendus voluptatum est dolores culpa. Doloribus quia optio nesciunt autem rerum.', '2026-01-01', 'Done', 3, 2),
(16, 'Cum quisquam sit qui sed.', NULL, '2025-12-31', 'Done', 4, NULL),
(17, 'Qui quod aliquam odit quia.', 'Qui et possimus dicta non. Id aut dolore nobis nobis.', '2026-02-23', 'Doing', 4, 13),
(18, 'Voluptatibus dolorem beatae officia quis.', NULL, '2026-01-28', 'Done', 1, NULL),
(19, 'Qui ea nihil perferendis ut.', 'Asperiores sed natus nemo dicta nihil. Et omnis eum neque aut et est. Est repellat pariatur nesciunt ea error.', '2025-12-31', 'Doing', 5, 14),
(20, 'Eum et esse tempore illo.', 'Recusandae non cum dolor voluptatibus. Culpa et pariatur et quasi et omnis blanditiis. Nulla aliquid ab nisi.', '2025-12-11', 'To Do', 4, NULL),
(21, 'Minus nesciunt et.', 'Soluta quibusdam placeat aperiam commodi ea. Officia est pariatur sint delectus dignissimos incidunt.', '2026-01-22', 'Done', 2, 1),
(22, 'Aut in autem sit.', 'Quis consequatur velit excepturi tempore sequi voluptas expedita. Ex incidunt exercitationem recusandae et. Impedit voluptatem reprehenderit accusamus tempore rerum qui.', '2026-03-02', 'Done', 3, 2),
(23, 'Quia ex qui consectetur commodi.', 'Molestiae ducimus doloribus quis nisi distinctio laboriosam molestias non. Accusantium et minima officiis quos voluptates. Harum qui tempore asperiores distinctio consectetur assumenda vitae.', NULL, 'Doing', 1, 2),
(24, 'Harum impedit tenetur doloremque cumque incidunt.', 'Rerum possimus aut omnis aut qui porro. Provident ut quod architecto architecto aperiam enim.', NULL, 'Done', 4, 4),
(25, 'Consectetur veritatis rerum assumenda molestias.', 'Alias et dolore ut quos exercitationem. Iusto fuga numquam qui officia.', '2025-12-23', 'Doing', 4, 14),
(26, 'Tenetur provident provident impedit.', NULL, NULL, 'Doing', 5, 7),
(27, 'Impedit doloremque sunt doloribus quis.', NULL, NULL, 'To Do', 1, NULL),
(28, 'Dolore reiciendis ea itaque qui.', 'In expedita reprehenderit molestiae similique ea. Tempore id odit consequatur assumenda officia ea libero facilis. Explicabo tempora dolores temporibus sunt.', '2026-03-03', 'Doing', 4, 4),
(29, 'Natus nulla qui quisquam inventore commodi.', 'Distinctio ratione voluptatibus cum molestiae autem vitae nemo. Magnam rerum blanditiis quasi rem sed et.', '2026-01-03', 'Doing', 4, NULL),
(30, 'Rem voluptas sapiente voluptatem placeat.', 'Totam ut facilis quis quis est veritatis non. Eaque eum tenetur et vel et ut rerum tenetur.', '2025-12-15', 'Done', 5, 4),
(31, 'Sed aut aut.', NULL, '2026-02-20', 'Done', 2, NULL),
(32, 'Alias rerum officia optio iure iusto.', 'Explicabo necessitatibus voluptates itaque deserunt neque. Dolores fugit aliquid sit natus. Non impedit eum aut sit consequatur consequatur a.', NULL, 'Done', 4, 6),
(33, 'Atque at quisquam quod quam incidunt.', 'Omnis id vel accusantium commodi est animi quaerat. Officia nihil est ut asperiores. Facilis in quaerat quia quia eveniet inventore soluta.', '2025-12-11', 'To Do', 4, 14),
(34, 'Nemo voluptas provident blanditiis officia aut.', 'Molestiae veniam omnis laudantium in. Est aut iure non quo aut iste provident.', NULL, 'To Do', 1, NULL),
(35, 'Doloremque eos et nobis.', 'Porro ipsam consequuntur nihil libero tempora placeat voluptate quia. Nulla optio est voluptatem non assumenda quod sapiente. Eos incidunt est asperiores ut id rerum distinctio.', NULL, 'Doing', 4, 1),
(36, 'Cumque corporis odit culpa optio.', 'Veniam odio vero recusandae voluptatibus est temporibus sapiente. Et odit sequi ducimus ut similique. Assumenda qui voluptatem fugit velit ut doloribus rem doloremque.', NULL, 'Doing', 2, 8),
(37, 'Consequatur vel ut.', 'Molestiae aut unde minus officiis qui. Veritatis nobis dolore necessitatibus dolores quia rerum adipisci.', '2026-02-15', 'To Do', 3, 11),
(38, 'Quia aspernatur rem porro.', 'Cupiditate sint pariatur deleniti. Error veniam ea veritatis minus et.', '2026-01-01', 'Doing', 4, 6),
(39, 'Eligendi ducimus ex illum.', 'Esse occaecati est reprehenderit quibusdam consectetur ex. Quia atque excepturi qui dolorem. Reprehenderit in cupiditate quasi veritatis deserunt.', '2026-02-21', 'To Do', 2, 12),
(40, 'Fugiat dicta fugit dolores voluptas consequatur.', NULL, NULL, 'Doing', 3, 7),
(41, 'Voluptatem consequatur sequi optio dolore.', 'Sit earum aut quos perspiciatis est est. Rerum et omnis esse ut nihil.', NULL, 'To Do', 3, 13),
(42, 'Voluptatem soluta aut porro.', NULL, '2025-12-19', 'To Do', 3, 5),
(43, 'Consequuntur exercitationem tempore est ea.', 'Provident reprehenderit quam saepe ut aperiam. Veniam doloribus ex tempore alias.', '2026-01-11', 'Done', 3, 14),
(44, 'Sunt illo fugiat soluta sit explicabo.', 'Tempore magni voluptates quis consequatur quia. Perspiciatis placeat blanditiis rerum quis voluptatem id et libero. Commodi voluptatum ut aliquam illo.', '2026-01-17', 'Doing', 5, 9),
(45, 'Possimus quibusdam sed.', 'Modi incidunt ut voluptatem odio quia delectus. Quia quasi sed delectus similique laborum sint sequi quos. Illum officia autem eum quia quo.', '2026-02-13', 'To Do', 4, 13),
(46, 'Saepe qui cum maxime qui placeat.', NULL, '2026-02-04', 'Doing', 4, 12),
(47, 'Maiores soluta harum aliquid iure.', 'Qui sint quam optio sed rerum. Quia veniam magni praesentium est repellendus rerum consectetur.', '2026-02-09', 'Done', 3, NULL),
(48, 'Ducimus ex et.', 'Omnis magni et laborum consequatur minus voluptatem. Qui aliquam totam molestiae perferendis nihil.', NULL, 'To Do', 1, NULL),
(49, 'Eligendi inventore dolorem tempore.', 'Sed est pariatur et magni facilis magni perferendis neque. Perspiciatis explicabo qui sunt odit. Sequi sint voluptatem eveniet dolorum quisquam qui.', '2026-02-26', 'Done', 1, 2),
(50, 'Incidunt maxime repellendus et eos.', NULL, '2025-12-09', 'Done', 1, 8),
(51, 'Dolores delectus consequuntur quae.', 'Et enim recusandae voluptatum sit soluta quas. Aperiam laboriosam et distinctio temporibus quia omnis. Aperiam itaque magni qui qui pariatur sapiente quod labore.', '2026-01-26', 'Doing', 1, 12),
(52, 'Cumque ad dolorem et.', NULL, NULL, 'Done', 3, 8),
(53, 'Odio ad amet.', NULL, NULL, 'Done', 3, 5),
(54, 'Molestiae sit quibusdam excepturi excepturi quas.', 'Similique ducimus et ab qui voluptate excepturi. Ea occaecati doloremque non aut culpa rerum.', NULL, 'Done', 3, NULL),
(55, 'Dolorem corrupti voluptatem consequatur veniam sint.', NULL, '2026-01-20', 'Doing', 5, NULL),
(56, 'Ipsa qui veritatis eligendi culpa.', 'Enim deleniti dolor voluptas maxime. Delectus nisi iure enim. Autem aut rerum nesciunt doloremque corporis.', '2026-02-13', 'Doing', 2, 5),
(57, 'Labore quasi incidunt non.', NULL, NULL, 'Done', 3, 3),
(58, 'Quia quia eveniet ut aliquid sed.', 'Reiciendis animi vitae tenetur tenetur distinctio sequi quae. Et vero dolorum omnis necessitatibus ut ut nostrum.', '2026-02-02', 'Doing', 4, 4),
(59, 'Sunt at eaque.', 'Impedit occaecati quis aperiam sed. Consequuntur rerum natus occaecati natus placeat nihil.', '2026-01-03', 'Doing', 3, 14),
(60, 'Voluptatibus perspiciatis odit dolor repudiandae modi.', 'A debitis et quidem reprehenderit est quia fuga. Culpa quas rerum rerum est maxime.', '2026-02-28', 'Done', 5, NULL),
(61, 'Sequi molestias quas dolorem ut corrupti.', 'Fugit sint veniam architecto adipisci eaque qui. Sunt et nobis voluptatem sed tenetur laboriosam.', NULL, 'Done', 4, 5),
(62, 'Quia tenetur error.', 'Eum ipsum et necessitatibus magni nemo saepe voluptate. Qui adipisci atque rem enim accusamus cumque et. Ipsa laboriosam tempore distinctio voluptates aut laboriosam enim asperiores.', '2026-03-07', 'Doing', 5, NULL),
(63, 'Qui iure cum.', 'Laborum incidunt libero qui doloribus assumenda. Ab sint omnis facilis occaecati omnis facilis.', '2026-01-01', 'Doing', 1, 15),
(64, 'Maiores autem ea deserunt natus sequi.', NULL, NULL, 'To Do', 5, 7),
(65, 'Molestias modi dolorem voluptate.', 'Adipisci laboriosam facilis ut ea omnis. Pariatur quia tempore eos error et necessitatibus voluptas.', '2026-01-09', 'Doing', 3, 5),
(66, 'Tenetur incidunt quia.', 'Omnis dolore inventore aut reiciendis dolore assumenda. Temporibus et ut velit impedit deleniti veniam.', '2026-01-24', 'To Do', 3, 15),
(67, 'Corporis est et ad excepturi.', NULL, '2025-12-20', 'Done', 3, 11),
(68, 'Nemo sunt porro repudiandae aut.', NULL, NULL, 'Doing', 2, 13),
(69, 'At quisquam aliquam voluptates quasi.', 'Recusandae aut architecto ut est laudantium voluptatem atque. Fuga at accusantium id quia autem.', '2026-01-24', 'To Do', 1, 6),
(70, 'Quis qui iste.', 'Aut magnam voluptatem quam. Ea nesciunt hic eaque et. Molestiae pariatur veniam nemo eaque est.', '2025-12-22', 'To Do', 1, NULL),
(71, 'Harum non sunt.', 'Et quidem et et vel. Laborum sit iusto velit iste cupiditate neque laudantium et. Cumque et mollitia libero molestias ratione.', NULL, 'Doing', 5, 10),
(72, 'Consequatur repellat in mollitia id quas.', NULL, '2026-01-28', 'Doing', 5, 7),
(73, 'Sit perspiciatis ducimus rerum explicabo.', NULL, '2025-12-31', 'Doing', 3, 8),
(74, 'Sunt modi sint eum.', 'Quos qui sint dolor nesciunt. At omnis veritatis cupiditate impedit aperiam.', '2026-02-01', 'Done', 4, NULL),
(75, 'Fugiat aut maiores et.', NULL, NULL, 'Doing', 4, 14),
(76, 'Nihil nihil officia molestias voluptas sed.', NULL, NULL, 'Doing', 5, 9),
(77, 'Consequuntur non cupiditate ut.', NULL, '2026-02-25', 'To Do', 5, 2),
(78, 'Et aliquid voluptatem.', NULL, NULL, 'Doing', 2, 6),
(79, 'Velit et tenetur rerum.', 'Placeat doloremque incidunt esse veritatis qui ex culpa. Est inventore ipsam asperiores.', '2026-03-03', 'Doing', 2, 9),
(80, 'Laboriosam minima et nemo.', 'Incidunt exercitationem magnam atque cum aut. Et fugit omnis vel labore et quibusdam. Quidem et incidunt asperiores sint est.', '2026-02-03', 'Done', 5, 8),
(81, 'Error omnis ipsam et ad ducimus.', 'Explicabo nam exercitationem fuga est inventore. Et quisquam asperiores debitis soluta.', NULL, 'To Do', 2, 4),
(82, 'Dolore ipsam maiores perferendis modi.', 'Autem et voluptas qui. Minima debitis dicta incidunt aut ut nam sed.', '2026-03-08', 'Doing', 1, 12),
(83, 'Consequatur cumque qui.', 'Nobis ea ut earum ullam nobis et. Ad dolores ipsam soluta consequatur ut excepturi nulla. Repudiandae ipsa recusandae dignissimos quis.', NULL, 'To Do', 5, 2),
(84, 'Voluptate recusandae ut at.', NULL, '2026-02-21', 'Doing', 2, 15),
(85, 'Placeat et quae nisi.', 'Aut ex nesciunt doloribus error debitis qui dolorum. Ipsam a dolore id enim aut.', '2026-03-04', 'To Do', 4, 9),
(86, 'Praesentium esse in ut accusamus.', NULL, NULL, 'Done', 1, NULL),
(87, 'Nostrum harum aliquid blanditiis vero inventore.', NULL, '2025-12-12', 'Doing', 2, 3),
(88, 'Autem error eveniet minima.', 'Qui deleniti id doloremque earum architecto. Reiciendis possimus aut nobis. Sit et laudantium voluptas est fugiat quo aliquid.', '2026-01-30', 'Done', 2, 7),
(89, 'Mollitia autem provident ea eius sit.', 'Rerum voluptates perferendis qui. Sit dolore ipsa sed nihil iusto qui quo vitae. Veritatis eos molestiae tempora dolor accusamus illum vel magnam.', NULL, 'To Do', 5, 12),
(90, 'Recusandae harum ut dolor.', NULL, '2026-02-10', 'Doing', 5, 3),
(91, 'Nesciunt est sint veniam.', NULL, '2025-12-21', 'Doing', 3, 9),
(92, 'Occaecati atque quidem at.', NULL, '2026-02-01', 'Doing', 1, 5),
(93, 'Veniam ullam ea ipsam ea id.', 'Quia eum dolores earum. Autem eum in dolore sed.', '2026-01-30', 'Done', 3, 7),
(94, 'Ea corporis est nulla et.', NULL, '2026-02-13', 'To Do', 5, 5),
(95, 'Non explicabo labore.', 'Ipsum tempora eveniet vel saepe. Delectus et quia aut praesentium.', '2026-03-07', 'Done', 4, 4),
(96, 'Ex voluptates vel accusantium.', 'Ad ducimus ducimus iste minus. Distinctio rerum velit non temporibus repellat ab.', '2026-02-05', 'To Do', 3, 7),
(97, 'Est tenetur et vitae est.', 'Necessitatibus mollitia dolorem impedit ut error. Molestias quod magni blanditiis amet enim doloribus harum. Quibusdam recusandae dolores ipsum vero voluptatum voluptatum.', NULL, 'Done', 4, 13),
(98, 'Illo aut iste quia quis.', 'Dolorem molestiae fugiat eaque quia quas. Ea qui nihil aut qui id libero quidem.', '2026-02-14', 'Doing', 2, 12),
(99, 'Perferendis deleniti possimus consequuntur.', NULL, NULL, 'Done', 5, 2),
(100, 'Voluptatum commodi consequatur doloremque qui dolore.', NULL, '2026-03-01', 'Done', 4, NULL);

--
-- Index pour les tables déchargées
--

--
-- Index pour la table `doctrine_migration_versions`
--
ALTER TABLE `doctrine_migration_versions`
  ADD PRIMARY KEY (`version`);

--
-- Index pour la table `employe`
--
ALTER TABLE `employe`
  ADD PRIMARY KEY (`id`),
  ADD KEY `IDX_F804D3B9F6203804` (`statut_id`);

--
-- Index pour la table `messenger_messages`
--
ALTER TABLE `messenger_messages`
  ADD PRIMARY KEY (`id`),
  ADD KEY `IDX_75EA56E0FB7336F0` (`queue_name`),
  ADD KEY `IDX_75EA56E0E3BD61CE` (`available_at`),
  ADD KEY `IDX_75EA56E016BA31DB` (`delivered_at`);

--
-- Index pour la table `projet`
--
ALTER TABLE `projet`
  ADD PRIMARY KEY (`id`);

--
-- Index pour la table `projet_employe`
--
ALTER TABLE `projet_employe`
  ADD PRIMARY KEY (`projet_id`,`employe_id`),
  ADD KEY `IDX_7A2E8EC8C18272` (`projet_id`),
  ADD KEY `IDX_7A2E8EC81B65292` (`employe_id`);

--
-- Index pour la table `statut_employe`
--
ALTER TABLE `statut_employe`
  ADD PRIMARY KEY (`id`);

--
-- Index pour la table `tache`
--
ALTER TABLE `tache`
  ADD PRIMARY KEY (`id`),
  ADD KEY `IDX_93872075C18272` (`projet_id`),
  ADD KEY `IDX_93872075CB25077` (`employe_assigne_id`);

--
-- AUTO_INCREMENT pour les tables déchargées
--

--
-- AUTO_INCREMENT pour la table `employe`
--
ALTER TABLE `employe`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=19;

--
-- AUTO_INCREMENT pour la table `messenger_messages`
--
ALTER TABLE `messenger_messages`
  MODIFY `id` bigint(20) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT pour la table `projet`
--
ALTER TABLE `projet`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=11;

--
-- AUTO_INCREMENT pour la table `statut_employe`
--
ALTER TABLE `statut_employe`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT pour la table `tache`
--
ALTER TABLE `tache`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=104;

--
-- Contraintes pour les tables déchargées
--

--
-- Contraintes pour la table `employe`
--
ALTER TABLE `employe`
  ADD CONSTRAINT `FK_F804D3B9F6203804` FOREIGN KEY (`statut_id`) REFERENCES `statut_employe` (`id`);

--
-- Contraintes pour la table `projet_employe`
--
ALTER TABLE `projet_employe`
  ADD CONSTRAINT `FK_7A2E8EC81B65292` FOREIGN KEY (`employe_id`) REFERENCES `employe` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `FK_7A2E8EC8C18272` FOREIGN KEY (`projet_id`) REFERENCES `projet` (`id`) ON DELETE CASCADE;

--
-- Contraintes pour la table `tache`
--
ALTER TABLE `tache`
  ADD CONSTRAINT `FK_93872075C18272` FOREIGN KEY (`projet_id`) REFERENCES `projet` (`id`),
  ADD CONSTRAINT `FK_93872075CB25077` FOREIGN KEY (`employe_assigne_id`) REFERENCES `employe` (`id`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
