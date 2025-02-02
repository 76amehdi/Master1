-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Hôte : 127.0.0.1:3306
-- Généré le : lun. 27 jan. 2025 à 20:10
-- Version du serveur : 10.11.10-MariaDB
-- Version de PHP : 7.2.34

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Base de données : `u336179183_tiyya`
--

-- --------------------------------------------------------

--
-- Structure de la table `astuces_beaute`
--

CREATE TABLE `astuces_beaute` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `title` varchar(255) DEFAULT NULL,
  `category` varchar(255) NOT NULL,
  `text` text NOT NULL,
  `image` varchar(255) DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Déchargement des données de la table `astuces_beaute`
--

INSERT INTO `astuces_beaute` (`id`, `title`, `category`, `text`, `image`, `created_at`, `updated_at`) VALUES
(5, 'Masque Anti-âge à l’huile de Figue de Barbarie', 'Soins Visage', 'Après un démaquillage grâce à l\'Eau de Rose, appliquez l\'huile de Figue de Barbarie sur l\'ensemble du visage et du cou.\r\n\r\nCe soin gorgé de nutriments essentiels redonne à la peau dès la première application, soyeux, confort et vitalité.', 'files/astuces/17374829305120.webp', '2025-01-21 18:04:27', '2025-01-21 18:08:50');

-- --------------------------------------------------------

--
-- Structure de la table `carts`
--

CREATE TABLE `carts` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `user_id` varchar(255) DEFAULT NULL,
  `name` varchar(255) DEFAULT NULL,
  `email` varchar(255) DEFAULT NULL,
  `phone` varchar(255) DEFAULT NULL,
  `address` varchar(255) DEFAULT NULL,
  `product_title` varchar(255) DEFAULT NULL,
  `product_id` varchar(255) DEFAULT NULL,
  `price` varchar(255) DEFAULT NULL,
  `quantity` varchar(255) DEFAULT NULL,
  `unit` varchar(255) DEFAULT NULL,
  `image` varchar(255) DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Déchargement des données de la table `carts`
--

INSERT INTO `carts` (`id`, `user_id`, `name`, `email`, `phone`, `address`, `product_title`, `product_id`, `price`, `quantity`, `unit`, `image`, `created_at`, `updated_at`) VALUES
(238, '4', 'newuser@gmail.com', 'newuser@gmail.co', '0987654321', 'newuser@gmail.com', 'ggggg', '25', '200', '1', '400 g', 'products_images/17344382925071.jpg', '2025-01-20 11:48:28', '2025-01-20 11:48:28'),
(239, '4', 'newuser@gmail.com', 'newuser@gmail.co', '0987654321', 'newuser@gmail.com', 'ggggg', '25', '350', '1', '800 g', 'products_images/17344382925071.jpg', '2025-01-20 11:48:28', '2025-01-20 11:48:28');

-- --------------------------------------------------------

--
-- Structure de la table `categories`
--

CREATE TABLE `categories` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `category_name` varchar(255) NOT NULL,
  `image` varchar(255) DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Déchargement des données de la table `categories`
--

INSERT INTO `categories` (`id`, `category_name`, `image`, `created_at`, `updated_at`) VALUES
(18, 'Soins éclat', 'files/categorieImages/17374827755115.webp', '2025-01-21 18:06:15', '2025-01-21 18:06:15'),
(19, 'Soins Exfoliants', 'files/categorieImages/17374871022249.webp', '2025-01-21 19:18:22', '2025-01-21 19:18:22'),
(20, 'Soins Règènèrants', 'files/categorieImages/17374871411048.webp', '2025-01-21 19:19:01', '2025-01-22 01:14:54'),
(21, 'Soins Hydratants', 'files/categorieImages/17374874317625.webp', '2025-01-21 19:23:51', '2025-01-21 19:23:51'),
(22, 'Soins Rafraichissants', 'files/categorieImages/17374874826310.webp', '2025-01-21 19:24:42', '2025-01-21 19:24:42'),
(23, 'Soins purifiants', 'files/categorieImages/17374878701187.webp', '2025-01-21 19:31:10', '2025-01-21 19:31:10'),
(24, 'Soins cheveux', 'files/categorieImages/17374879091944.webp', '2025-01-21 19:31:49', '2025-01-21 19:31:49'),
(25, 'Accessoires', 'files/categorieImages/17375061121408.webp', '2025-01-22 00:35:12', '2025-01-22 00:35:12');

-- --------------------------------------------------------

--
-- Structure de la table `category_display`
--

CREATE TABLE `category_display` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `category_id` bigint(20) UNSIGNED NOT NULL,
  `display_image_path` varchar(255) NOT NULL,
  `display_order` int(11) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ;

--
-- Déchargement des données de la table `category_display`
--

INSERT INTO `category_display` (`id`, `category_id`, `display_image_path`, `display_order`, `created_at`, `updated_at`) VALUES
(7, 18, 'files/catdisplayImages/17375090704869.webp', 1, '2025-01-22 01:24:30', '2025-01-22 01:24:30'),
(8, 19, 'files/catdisplayImages/17375091108311.webp', 2, '2025-01-22 01:25:10', '2025-01-22 01:25:10'),
(9, 20, 'files/catdisplayImages/17375091274601.webp', 3, '2025-01-22 01:25:27', '2025-01-22 01:25:27'),
(10, 21, 'files/catdisplayImages/17375091429244.webp', 4, '2025-01-22 01:25:42', '2025-01-22 01:25:42');

-- --------------------------------------------------------

--
-- Structure de la table `contacts`
--

CREATE TABLE `contacts` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `email` varchar(255) NOT NULL,
  `phone` varchar(255) DEFAULT NULL,
  `message` text DEFAULT NULL,
  `localisation` varchar(255) DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Déchargement des données de la table `contacts`
--

INSERT INTO `contacts` (`id`, `email`, `phone`, `message`, `localisation`, `created_at`, `updated_at`) VALUES
(2, 'contact@tiyya.mr', '0600000000', 'message', 'https://maps.app.goo.gl/xwphXEqKUFUu3tNt6', '2025-01-16 23:20:29', '2025-01-25 21:33:57');

-- --------------------------------------------------------

--
-- Structure de la table `failed_jobs`
--

CREATE TABLE `failed_jobs` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `uuid` varchar(255) NOT NULL,
  `connection` text NOT NULL,
  `queue` text NOT NULL,
  `payload` longtext NOT NULL,
  `exception` longtext NOT NULL,
  `failed_at` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Structure de la table `featured_products`
--

CREATE TABLE `featured_products` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `product_id` bigint(20) UNSIGNED NOT NULL,
  `display_order` int(11) NOT NULL,
  `featured_image_path` varchar(255) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ;

--
-- Déchargement des données de la table `featured_products`
--

INSERT INTO `featured_products` (`id`, `product_id`, `display_order`, `featured_image_path`, `created_at`, `updated_at`) VALUES
(8, 97, 1, 'files/featuredproducts/17375109083452.webp', '2025-01-21 20:25:07', '2025-01-22 01:55:08'),
(9, 86, 2, 'files/featuredproducts/17376605196057.webp', '2025-01-21 20:25:25', '2025-01-24 18:38:57'),
(10, 102, 3, 'files/featuredproducts/17374911455877.webp', '2025-01-21 20:25:45', '2025-01-24 17:22:23');

-- --------------------------------------------------------

--
-- Structure de la table `fournisseurs`
--

CREATE TABLE `fournisseurs` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `name` varchar(255) NOT NULL,
  `email` varchar(255) DEFAULT NULL,
  `phone` varchar(255) DEFAULT NULL,
  `address` varchar(255) DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Déchargement des données de la table `fournisseurs`
--

INSERT INTO `fournisseurs` (`id`, `name`, `email`, `phone`, `address`, `created_at`, `updated_at`) VALUES
(3, 'Tiyya Maroc', 'tiyyamaroc@gmail.ma', '0600000000', '-', '2025-01-11 22:32:17', '2025-01-24 17:50:30');

-- --------------------------------------------------------

--
-- Structure de la table `homepage_settings`
--

CREATE TABLE `homepage_settings` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `currency` varchar(10) NOT NULL,
  `normal_delivery_price` decimal(10,2) NOT NULL,
  `free_delivery_threshold` decimal(10,2) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Déchargement des données de la table `homepage_settings`
--

INSERT INTO `homepage_settings` (`id`, `currency`, `normal_delivery_price`, `free_delivery_threshold`, `created_at`, `updated_at`) VALUES
(1, 'MRU', 50.00, 350.00, '2025-01-09 10:44:29', '2025-01-20 15:16:12');

-- --------------------------------------------------------

--
-- Structure de la table `migrations`
--

CREATE TABLE `migrations` (
  `id` int(10) UNSIGNED NOT NULL,
  `migration` varchar(255) NOT NULL,
  `batch` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Déchargement des données de la table `migrations`
--

INSERT INTO `migrations` (`id`, `migration`, `batch`) VALUES
(1, '2014_10_12_000000_create_users_table', 1),
(2, '2014_10_12_100000_create_password_reset_tokens_table', 1),
(3, '2014_10_12_200000_add_two_factor_columns_to_users_table', 1),
(4, '2019_08_19_000000_create_failed_jobs_table', 1),
(5, '2019_12_14_000001_create_personal_access_tokens_table', 1),
(6, '2023_04_23_203544_create_sessions_table', 1),
(7, '2023_05_01_112737_create_categories_table', 1),
(8, '2023_05_01_125620_create_products_table', 1),
(9, '2023_05_03_185136_create_carts_table', 1),
(10, '2023_05_04_102600_create_orders_table', 1),
(11, '2024_12_12_115717_create_user_roles_table', 1),
(12, '2024_12_12_123622_add_trigger_to_insert_roles_for_usertype_1', 1),
(13, '2024_12_12_125148_add_trigger_insert_default_roles_after_update_on_users', 2),
(14, '2024_12_17_103821_add_image_to_categories_table', 3),
(15, '2024_12_19_212450_create_fournisseurs_table', 4),
(16, '2024_12_19_212619_create_purchases_table', 4),
(17, '2024_12_22_211752_add_fields_to_product_table', 5),
(18, '2024_12_22_224331_create_promotions_table', 6),
(19, '2024_12_22_224836_add_colors_to_products_table', 7),
(20, '2024_12_30_143658_update_purchases_table', 8),
(21, '2024_12_30_144006_update_purchases_table', 9),
(22, '2024_12_30_144326_update_purchases_table', 10),
(23, '2024_12_30_144422_update_purchases_table', 11),
(24, '2024_12_30_144554_update_purchases_table', 12),
(25, '2024_12_30_151349_update_purchases_table', 13),
(26, '2024_12_30_200612_create_purchasedetails_table', 14),
(27, '2024_12_30_204306_create_purchasedetails_table', 15),
(28, '2024_12_31_202750_create_purchase_payments_table', 16),
(29, '2025_01_02_220012_alter_carts_table', 17),
(30, '2025_01_02_220356_create_cart_items_table', 18),
(31, '2025_01_04_201855_add_unit_to_carts_table', 19),
(32, '2025_01_08_110631_add_fields_to_orders_table', 20),
(33, '2025_01_08_110816_create_order_details_table', 20),
(34, '2025_01_09_111606_create_homepage_settings_table', 21),
(35, '2025_01_09_111610_create_featured_products_table', 21),
(36, '2025_01_09_111611_create_category_display_table', 21),
(37, '2025_01_12_020634_create_astuces_beaute_table', 22),
(38, '2025_01_12_100808_create_astuces_beaute_table', 23),
(39, '2025_01_15_225505_create_astuces_beaute_table', 24),
(40, '2025_01_16_232659_create_contacts_table', 25);

-- --------------------------------------------------------

--
-- Structure de la table `orders`
--

CREATE TABLE `orders` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `name` varchar(255) DEFAULT NULL,
  `email` varchar(255) DEFAULT NULL,
  `phone` varchar(255) DEFAULT NULL,
  `address` varchar(255) DEFAULT NULL,
  `product_title` varchar(255) DEFAULT NULL,
  `product_id` varchar(255) DEFAULT NULL,
  `price` varchar(255) DEFAULT NULL,
  `quantity` varchar(255) DEFAULT NULL,
  `image` varchar(255) DEFAULT NULL,
  `tracking_id` varchar(255) DEFAULT NULL,
  `delivery_status` enum('processing','packaging','shipped','on_the_way','delivered') DEFAULT NULL,
  `payment_status` enum('pending','paid','cancelled','refunded','cash_on_delivery','failed') DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `delivery_country` varchar(255) DEFAULT NULL,
  `delivery_firstname` varchar(255) DEFAULT NULL,
  `delivery_lastname` varchar(255) DEFAULT NULL,
  `delivery_company` varchar(255) DEFAULT NULL,
  `delivery_address` varchar(255) DEFAULT NULL,
  `delivery_apartment` varchar(255) DEFAULT NULL,
  `delivery_postcode` varchar(255) DEFAULT NULL,
  `delivery_city` varchar(255) DEFAULT NULL,
  `delivery_phone` varchar(255) DEFAULT NULL,
  `delivery_save_data` tinyint(1) NOT NULL DEFAULT 0,
  `delivery_sms_offers` tinyint(1) NOT NULL DEFAULT 0,
  `billing_country` varchar(255) DEFAULT NULL,
  `billing_firstname` varchar(255) DEFAULT NULL,
  `billing_lastname` varchar(255) DEFAULT NULL,
  `billing_company` varchar(255) DEFAULT NULL,
  `billing_address` varchar(255) DEFAULT NULL,
  `billing_apartment` varchar(255) DEFAULT NULL,
  `billing_postcode` varchar(255) DEFAULT NULL,
  `billing_city` varchar(255) DEFAULT NULL,
  `billing_phone` varchar(255) DEFAULT NULL,
  `payment` varchar(255) DEFAULT NULL,
  `contact_email_or_phone` varchar(255) DEFAULT NULL,
  `contact_newsletter` tinyint(1) NOT NULL DEFAULT 0
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Structure de la table `order_details`
--

CREATE TABLE `order_details` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `order_id` bigint(20) UNSIGNED NOT NULL,
  `product_id` varchar(255) NOT NULL,
  `product_title` varchar(255) NOT NULL,
  `price` decimal(10,2) NOT NULL,
  `quantity` int(11) NOT NULL,
  `product_weight` varchar(255) DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Structure de la table `password_reset_tokens`
--

CREATE TABLE `password_reset_tokens` (
  `email` varchar(255) NOT NULL,
  `token` varchar(255) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Structure de la table `personal_access_tokens`
--

CREATE TABLE `personal_access_tokens` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `tokenable_type` varchar(255) NOT NULL,
  `tokenable_id` bigint(20) UNSIGNED NOT NULL,
  `name` varchar(255) NOT NULL,
  `token` varchar(64) NOT NULL,
  `abilities` text DEFAULT NULL,
  `last_used_at` timestamp NULL DEFAULT NULL,
  `expires_at` timestamp NULL DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Structure de la table `products`
--

CREATE TABLE `products` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `title` varchar(255) NOT NULL,
  `description` text NOT NULL,
  `qty` decimal(8,2) NOT NULL,
  `brand` varchar(255) DEFAULT NULL,
  `category_id` bigint(20) UNSIGNED NOT NULL,
  `warehouse_id` bigint(20) UNSIGNED NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `ingredient` varchar(255) DEFAULT NULL,
  `utilisation` varchar(255) DEFAULT NULL,
  `result` varchar(255) DEFAULT NULL,
  `colors` longtext CHARACTER SET utf8mb4 COLLATE utf8mb4_bin DEFAULT NULL CHECK (json_valid(`colors`)),
  `recuperation_from_shop` tinyint(1) NOT NULL DEFAULT 1
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Déchargement des données de la table `products`
--

INSERT INTO `products` (`id`, `title`, `description`, `qty`, `brand`, `category_id`, `warehouse_id`, `created_at`, `updated_at`, `ingredient`, `utilisation`, `result`, `colors`, `recuperation_from_shop`) VALUES
(60, 'Rhassoul Somptueux au Miel', '<p>Le délice d’une peau ultra douce. LE Véritable ‘’Terre qui lave’’…</p><p>Provenant de région de Missour... Un merveilleux produit de la terre enrichi de miel très doux, ce qui prouve une fois de plus que la nature regorge de remèdes propres et très efficaces. Ce produit a été spécialement formulé pour s’appliquer à la peau, à laquelle il redonne en un instant éclat et douceur. Le miel pur, aux vertus adoucissantes, laisse la peau souple et soyeuse, tandis que l’huile essentielle de petit grain à la délicate senteur d\'oranger la parfume.</p><p><strong>Ingrédients</strong> : Poudre de rhassoul et le miel</p><p><strong>Utilisation</strong> : En cabine ou au hammam : s’applique en masque sur le visage et le corps pour une peau ultra douce.</p><p><strong>Résultat</strong> : Connu pour ses vertus purifiantes, ce rhassoul à base de miel redonne brillance et éclat pour une peau douce et lumineuse.</p>', 1.00, 'Tiyya', 18, 1, '2025-01-21 19:58:04', '2025-01-26 20:21:17', NULL, NULL, NULL, 'null', 1),
(61, 'Rhassoul aux huiles essentielles', '<p>La volupté d’une peau purifiée. LE Véritable ‘’Terre qui lave’’…</p><p>Le Rhassoul provenant de la région de Missour, fait de l’argile la plus noble, d’une finesse et d’une douceur incomparable, vous offre un plaisir d’utilisation unique. Il contient des huiles essentielles relaxantes procurant une sensation de bien-être absolu. Sa présentation en poudre permet d’obtenir instantanément un masque de beauté qui vous enveloppe d’une douceur parfumée. Il est essentiel pour purifier et affiner le grain de peau, assainir le cuir chevelu et faire briller vos cheveux.</p>', 1.00, 'Tiyya', 18, 1, '2025-01-21 20:06:48', '2025-01-26 20:21:17', '<p>Poudre de henné, pétales de roses séchées et huile essentielle de petit grain.&nbsp;</p>', '<p>Une fois par semaine lors du hammam seul ou en mélange avec le savon noir pour la brillance et l’éclat du corps et des cheveux.</p>', '<p>Redonne éclat et lumière à la peau et aux cheveux.</p>', 'null', 1),
(62, 'Henné doux à la Rose', '<p>Lumière sur le cheveu et sur le corps. LA poudre aux multiples facettes provenant de la région de Tata.&nbsp;</p><p>Ce henné végétal de qualité que l’on aura transformé en pâte soyeuse avec un peu d’eau tiède, crée à l\'application de magnifiques reflets sur cheveux et corps, sa composition en pétales de rose à la note aromatique délicate et en huile essentielle de petit grain les parfument.</p>', 1.00, 'Tiyya', 18, 1, '2025-01-21 20:09:07', '2025-01-26 20:21:17', '<p>Poudre de henné, pétales de roses séchées et huile essentielle de petit grain.&nbsp;</p>', '<p>Une fois par semaine lors du hammam seul ou en mélange avec le savon noir pour la brillance et l’éclat du corps et des cheveux.</p>', '<p>Redonne éclat et lumière à la peau et aux cheveux.</p>', 'null', 1),
(63, 'Nila Bleu', '<p>Fine poudre naturelle, utilisée pour ses propriétés cosmétiques, naturellement&nbsp;bleu indigo que l’on trouve originairement en Inde. Elle est de nature 100%&nbsp;minérale, vu qu’elle se présente sous forme de roche que l’on récupère puis&nbsp;qu’on réduit en poudre.</p>', 1.00, 'tiyya', 18, 1, '2025-01-21 20:29:44', '2025-01-26 20:21:17', NULL, '<p>Mélangez une cuillère à café normale de poudre de nila avec une contenance de<br>3 cuillères à soupe d\'eau. Appliquer le mélange dans les zones à éclaircir(main, coude, genou, aisselles). Evitez une application sur tous le corps.</p>', '<p>Eclaircie, unifie le teint et adoucit les zones dites rugueuses.</p>', 'null', 1),
(68, 'Savon Noir', '<p>Savon Noir authentique de Marrakech, dont la pâte onctueuse est à base d’olive selon la recette traditionnelle marocaine.</p><p>Cet exfoliant naturel sans parfum, redonne à la peau éclat et douceur.</p><p><strong>Ingrédient</strong>&nbsp;: L’huile d’olive</p><p><strong>Utilisation</strong>&nbsp;: Chaque semaine, au hammam ou à la maison, à utiliser en friction sur tout le corps, attendre 2 à 5 minutes avant de rincer.&nbsp;Ainsi votre&nbsp;peau sera prête à l’exfoliation avec le gant de crin Tiyya.</p><p><strong>Résultat</strong>&nbsp;: Exfolie, nettoie et débarrasse la peau de ses toxines.&nbsp;</p>', 1.00, 'Tiyya', 19, 1, '2025-01-21 23:21:16', '2025-01-26 20:21:17', NULL, NULL, NULL, 'null', 1),
(69, 'Savon Noir aux huiles essentielles', '<p>La jouissance d’une peau exfoliée. LE bien-être garanti…</p><p>Ce produit culte fait partie de l\'essentiel du rituel hammam traditionnel.</p><p>Savon Noir d’exception de Marrakech, enrichi en huiles essentielles aux vertus assainissantes et purifiantes. Agréablement parfumé, il laisse la peau parfaitement douce et saine, débarrassée de ses toxines et revitalisée. Les essences de romarin, eucalyptus et petit grain ont également un pouvoir relaxant qui apporte une agréable sensation de détente et de bien-être.</p><p><strong>Ingrédients</strong> : L’huile d’olive et les huiles essentielles de romarin, d’eucalyptus et de petit grain.</p><p><strong>Utilisation</strong> : Chaque semaine, au hammam ou à la maison, à utiliser en friction sur tout le corps, attendre 2 à 5 minutes avant de rincer.&nbsp;Ainsi votre&nbsp;peau sera prête à l’exfoliation avec le gant de crin Tiyya.</p><p><strong>Résultat</strong> : Exfolie, nettoie et débarrasse la peau de ses toxines.&nbsp;</p>', 1.00, 'Tiyya', 19, 1, '2025-01-21 23:22:52', '2025-01-26 20:21:17', NULL, NULL, NULL, 'null', 1),
(70, 'Fluide gommant à l\'orange', '<p>Véritable cure de jouvence, le fluide gommant à l’orange permet de purifier la surface de l’épiderme, participe à la bonne circulation du sang en revitalisant votre peau et stimule le renouvellement cellulaire. Son parfum frais et énergisant diffuse généreusement une senteur fruitée.</p><p><strong>Ingrédients</strong> : Cristaux de sucre de canne, cristaux de sel marin et l\'huile essentielle d’orange.</p><p><strong>Utilisation</strong> : Appliquez sur une peau humidifiée en mouvements circulaires, puis rincez pour éliminer toute trace de sel. Renouvelez chaque semaine.</p><p><strong>Résultat</strong> : Une peau saine, douce et radieuse est révélée.</p>', 1.00, 'Tiyya', 19, 1, '2025-01-21 23:26:08', '2025-01-26 20:21:17', NULL, NULL, NULL, 'null', 1),
(71, 'Fluide gommant senteur thé vert', '<p>Votre peau vous réclame douceur et éclat ? Sublimez-la en intégrant dans votre routine beauté le fluide gommant senteur thé vert.</p><p>Il permet d’éliminer les cellules mortes, favorise une meilleure oxygénation de la peau et stimule la microcirculation. Sa fragrance unique, audacieuse et inattendue évoque la pureté innée et la transparence de l’instant ou le corps et l’esprit redécouvrent des sensations originales, vivantes et intenses.</p><p><strong>Ingrédients</strong> : Cristaux de sucre de canne, cristaux de sel marin et le parfum thé vert</p><p><strong>Utilisation</strong> : Appliquez sur une peau humidifiée en mouvement circulaires, puis rincez pour éliminer toute trace de sel. Renouvelez chaque semaine.</p><p><strong>Résultat&nbsp;: </strong>Une peau douce, exfoliée et revitalisée.</p>', 1.00, 'Tiyya', 19, 1, '2025-01-21 23:27:26', '2025-01-26 20:21:17', NULL, NULL, NULL, 'null', 1),
(72, 'Savon exfoliant à l\'argan', '<p>Savon exfoliant à l\'Argan Tiyya 100 % naturel. Peut être appliqué sur tout le corps et le visage.</p><p>Issus d’un procédé de fabrication artisanale. La base végétale utilisée est l’huile d’olive. Certifié sans colorant, sans conservateur, sans tensioactif et sans parabène.</p><p><strong>Utilisation</strong>&nbsp;: Appliquez sur une peau humidifiée, sur le visage et le corps pour une peau bien nettoyée.</p><p><strong>Résultat</strong>&nbsp;: Adoucit et subliment votre peau pour un teint éclatant et frais pour une hydratation optimale garantie.</p>', 1.00, 'Tiyya', 19, 1, '2025-01-21 23:28:59', '2025-01-26 20:21:17', NULL, NULL, NULL, 'null', 1),
(73, 'Savon exfoliant au miel', '<p>Le savon exfoliant au Miel Tiyya 100 % naturel. Il peut&nbsp; être appliqué sur tout le corps et le visage.&nbsp;</p><p>Issus d’un procédé de fabrication artisanale. La base végétale utilisée est l’huile d’olive. Certifié sans colorant, sans conservateur, sans tensioactif et sans parabène.</p><p><strong>Utilisation</strong>&nbsp;: Appliquez sur une peau humidifiée, sur le visage et le corps pour une peau bien nettoyée.</p><p><strong>Résultat</strong>&nbsp;: Adoucit et subliment votre peau pour un teint éclatant et frais pour une hydratation optimale garantie.</p>', 1.00, 'Tiyya', 19, 1, '2025-01-21 23:30:23', '2025-01-26 20:21:17', NULL, NULL, NULL, 'null', 1),
(74, 'Savon exfoliant nigelle', '<p>Le savon exfoliant Nigelle Tiyya 100 % naturel. Il peut&nbsp; être appliqué sur tout le corps et le visage.&nbsp;</p><p>Issus d’un procédé de fabrication artisanale. La base végétale utilisée est l’huile d’olive. Certifié sans colorant, sans conservateur, sans tensioactif et sans parabène.</p><p><strong>Utilisation</strong>&nbsp;: Appliquez sur une peau humidifiée, sur le visage et le corps pour une peau bien nettoyée.</p><p><strong>Résultat</strong>&nbsp;: Adoucit et subliment votre peau pour un teint éclatant et frais pour une hydratation optimale garantie.</p>', 1.00, 'Tiyya', 19, 1, '2025-01-21 23:37:51', '2025-01-26 20:21:17', NULL, NULL, NULL, 'null', 1),
(75, 'Savon exfoliant au romarin', '<p>Le savon exfoliant au Romarin Tiyya 100 % naturel. Il peut&nbsp; être appliqué sur tout le corps et le visage.&nbsp;</p><p>Issus d’un procédé de fabrication artisanale. La base végétale utilisée est l’huile d’olive. Certifié sans colorant, sans conservateur, sans tensioactif et sans parabène.</p><p><strong>Utilisation</strong>&nbsp;: Appliquez sur une peau humidifiée, sur le visage et le corps pour une peau bien nettoyée.</p><p><strong>Résultat</strong>&nbsp;: Adoucit et subliment votre peau pour un teint éclatant et frais pour une hydratation optimale garantie.</p>', 1.00, 'Tiyya', 19, 1, '2025-01-21 23:39:59', '2025-01-26 20:21:17', NULL, NULL, NULL, 'null', 1),
(76, 'Savon exfoliant senteur lavande', '<p>Le savon exfoliant senteur Lavande Tiyya 100 % naturel. Il peut&nbsp; être appliqué sur tout le corps et le visage.&nbsp;</p><p>Issus d’un procédé de fabrication artisanale. La base végétale utilisée est l’huile d’olive. Certifié sans colorant, sans conservateur, sans tensioactif et sans parabène.</p><p><strong>Utilisation</strong>&nbsp;: Appliquez sur une peau humidifiée, sur le visage et le corps pour une peau bien nettoyée.</p><p><strong>Résultat</strong>&nbsp;: Adoucit et subliment votre peau pour un teint éclatant et frais pour une hydratation optimale garantie.</p>', 1.00, 'Tiyya', 19, 1, '2025-01-21 23:41:33', '2025-01-26 20:21:17', NULL, NULL, NULL, 'null', 1),
(77, 'Savon exfoliant à huile d\'olive', '<p>Le savon exfoliant Olive Tiyya 100 % naturel. Il peut&nbsp; être appliqué sur tout le corps et le visage.&nbsp;</p><p>Issus d’un procédé de fabrication artisanale. La base végétale utilisée est l’huile d’olive. Certifié sans colorant, sans conservateur, sans tensioactif et sans parabène.</p><p><strong>Utilisation</strong>&nbsp;: Appliquez sur une peau humidifiée, sur le visage et le corps pour une peau bien nettoyée.</p><p><strong>Résultat</strong>&nbsp;: Adoucit et subliment votre peau pour un teint éclatant et frais pour une hydratation optimale garantie.</p>', 1.00, 'Tiyya', 19, 1, '2025-01-21 23:42:36', '2025-01-26 20:21:17', NULL, NULL, NULL, 'null', 1),
(78, 'Kit 3 savons exfoliants - Aromatique 3 (Argan, Miel, Romarin)', '<p>Les savons exfoliants Tiyya sont des produits 100 % naturels. Ils peuvent être appliqués sur tout le corps et le visage. Tiyya propose 3 parfums différents :</p><ul><li>Savon Exfoliant à l’Argan</li><li>Savon Exfoliant au Miel</li><li>Savon Exfoliant au Romarin</li></ul><p>Ils sont issus d’un procédé de fabrication artisanale. La base végétale utilisée est l’huile d’olive. Ils sont certifiés sans colorant, sans conservateur, sans tensioactif et sans parabène.</p><p><strong>Utilisation</strong>&nbsp;: Appliquez sur une peau humidifiée, sur le visage et le corps pour une peau bien nettoyée.</p><p><strong>Résultat</strong>&nbsp;: Ils adoucissent et subliment votre peau pour un teint éclatant et frais&nbsp;pour une hydratation optimale garantie.</p>', 0.00, 'Tiyya', 19, 1, '2025-01-21 23:43:56', '2025-01-21 23:43:56', NULL, NULL, NULL, 'null', 1),
(79, 'Kit 3 savons exfoliants - Aromatique 2 (Olive, Lavande, Nigelle)', '<p>Les savons exfoliants Tiyya sont des produits 100 % naturels. Ils peuvent être appliqués sur tout le corps et le visage. Tiyya propose 3 parfums différents :</p><ul><li>Savon Exfoliant à l’huile d’Olive</li><li>Savon Exfoliant senteur Lavande</li><li>Savon Exfoliant Nigelle</li></ul><p>Ils sont issus d’un procédé de fabrication artisanale. La base végétale utilisée est l’huile d’olive. Ils sont certifiés sans colorant, sans conservateur, sans tensioactif et sans parabène.</p><p><strong>Utilisation</strong>&nbsp;: Appliquez sur une peau humidifiée, sur le visage et le corps pour une peau bien nettoyée.</p><p><strong>Résultat</strong>&nbsp;: Ils adoucissent et subliment votre peau pour un teint éclatant et frais&nbsp;pour une hydratation optimale garantie.</p>', 0.00, 'Tiyya', 19, 1, '2025-01-21 23:44:34', '2025-01-21 23:44:34', NULL, NULL, NULL, 'null', 1),
(80, 'Kit 3 savons exfoliants - Aromatique 1 (Lavande, Romarin, Nigelle)', '<p>Les savons exfoliants Tiyya sont des produits 100 % naturels. Ils peuvent être appliqués sur tout le corps et le visage. Tiyya propose 3 parfums différents :</p><ul><li>Savon Exfoliant senteur Lavande</li><li>Savon Exfoliant au Romarin</li><li>Savon Exfoliant Nigelle</li></ul><p>Ils sont issus d’un procédé de fabrication artisanale. La base végétale utilisée est l’huile d’olive. Ils sont certifiés sans colorant, sans conservateur, sans tensioactif et sans parabène.</p><p><strong>Utilisation</strong>&nbsp;: Appliquez sur une peau humidifiée, sur le visage et le corps pour une peau bien nettoyée.</p><p><strong>Résultat</strong>&nbsp;: Ils adoucissent et subliment votre peau pour un teint éclatant et frais&nbsp;pour une hydratation optimale garantie.</p>', 0.00, 'Tiyya', 19, 1, '2025-01-21 23:45:32', '2025-01-21 23:45:32', NULL, NULL, NULL, 'null', 1),
(81, 'Kit 3 savons exfoliants - Hydratation (Argan, Olive, Miel)', '<p>Les savons exfoliants Tiyya sont des produits 100 % naturels. Ils peuvent être appliqués sur tout le corps et le visage. Tiyya propose 6 parfums différents :</p><ul><li>Savon Exfoliant à l’huile d’Olive</li><li>Savon Exfoliant à l’Argan</li><li>Savon Exfoliant au Miel</li><li>Savon Exfoliant senteur Lavande</li><li>Savon Exfoliant au Romarin</li><li>Savon Exfoliant Nigelle</li></ul><p>Ils sont issus d’un procédé de fabrication artisanale. La base végétale utilisée est l’huile d’olive. Ils sont certifiés sans colorant, sans conservateur, sans tensioactif et sans parabène.</p><p><strong>Utilisation</strong>&nbsp;: Appliquez sur une peau humidifiée, sur le visage et le corps pour une peau bien nettoyée.</p><p><strong>Résultat</strong>&nbsp;: Ils adoucissent et subliment votre peau pour un teint éclatant et frais et surtout une hydratation optimale garantie.</p>', 0.00, 'Tiyya', 19, 1, '2025-01-21 23:46:24', '2025-01-21 23:46:24', NULL, NULL, NULL, 'null', 1),
(82, 'Kit savons exfoliants de 6', '<p>Les savons exfoliants Tiyya sont des produits 100 % naturels. Ils peuvent être appliqués sur tout le corps et le visage. Tiyya propose 6 parfums différents :</p><ul><li>Savon Exfoliant à l’huile d’Olive</li><li>Savon Exfoliant à l’Argan</li><li>Savon Exfoliant au Miel</li><li>Savon Exfoliant senteur Lavande</li><li>Savon Exfoliant au Romarin</li><li>Savon Exfoliant Nigelle</li></ul><p>Ils sont issus d’un procédé de fabrication artisanale. La base végétale utilisée est l’huile d’olive. Ils sont certifiés sans colorant, sans conservateur, sans tensioactif et parabène.</p><p><strong>Utilisation</strong>&nbsp;: Appliquez sur une peau humidifiée, sur le visage et le corps pour une peau bien nettoyée.</p><p><strong>Résultat</strong>&nbsp;: Ils adoucissent et subliment votre peau pour un teint éclatant et frais pour une hydratation optimale garantie.</p>', 0.00, 'Tiyya', 19, 1, '2025-01-21 23:47:29', '2025-01-21 23:47:29', NULL, NULL, NULL, 'null', 1),
(84, 'Huile d\'Argan Bio*', '<p>Le bonheur d’une peau nourrie. LE soin naturel du corps et des cheveux…</p><p>Une huile miraculeuse ! Ses vertus régénératrices et réparatrices font d’elle un atout beauté par excellence pour notre peau et nos cheveux. Précieuse huile, issue des fruits de l’arganier, arbre emblématique des régions du sud du Maroc d\'Agadir, a des effets réparateurs et antioxydants spectaculaires.</p><p>Chez Tiyya, l’Huile d’Argan Bio* est totalement pure et issue d’une première pression à froid pour conserver intactes toutes ses propriétés. Elle nourrit, hydrate, régénère et cicatrise l’épiderme, ainsi que la pointe des cheveux abîmés et les ongles cassants.</p><p><strong>Ingrédient</strong>&nbsp;: 100% Huile d\'Argan</p><p><strong>Utilisation</strong> : A appliquer régulièrement <strong>le soir</strong> sur la peau préalablement nettoyée par l’eau de rose : En masque nourrissant pour les cheveux secs et abimés, en modelage doux pour adoucir les traits du visage et relaxer les mains, en massage pour hydrater et nourrir en profondeur la peau.</p><p><strong>Résultat</strong> : Votre peau et cheveux sont nourris, régénérés et bien hydratés.&nbsp;</p><p><i>* Cosmétique Ecologique et Biologique Certifiée par Ecocert, Greenlife et labélisée; Cosmébio</i></p>', 1.00, 'Tiyya', 20, 1, '2025-01-21 23:50:32', '2025-01-26 20:21:17', NULL, NULL, NULL, 'null', 1),
(85, 'Huile de Jeunesse à la Figue de Barbarie', '<p>L’élixir d’une peau jeune et souple. LE meilleur cosmétique antiride naturel…</p><p>Rare et précieuse, l\'huile de figue de barbarie est extraite des graines d\'une espèce de cactus de la région de Sidi Ifni. Cette huile fait merveille pour maintenir la souplesse et la tonicité de la peau. Tiyya enchante aujourd\'hui les peaux assoiffées et dévitalisées avec l\'Huile de Jeunesse, ce soin révèle les pouvoirs secrets du figuier de Barbarie. Face au temps qui passe, au stress et à la fatigue qui marquent les traits, l\'Huile de Jeunesse apporte une intense sensation de réconfort.</p><p>Alliance subtile de trois huiles vertueuses –figue de barbarie, argan et amande – ce soin, gorgé de nutriments essentiels, redonne à la peau, dès les premières applications, souplesse, confort, et vitalité.</p><p><strong>Ingrédients</strong> : Les huiles pures et précieuses de graines de figue de barbarie, d’argan et d’amande.</p><p><strong>Utilisation</strong> : Appliquez quelques gouttes sur le visage puis massez délicatement en mouvements circulaires, elle s’utilise comme un sérum de beauté, juste avant la crème <strong>du soir </strong>de façon&nbsp;régulière.</p><p><strong>Résultat</strong> : Cette huile précieuse est exceptionnelle pour lutter contre les premiers signes du vieillissement. La peau redevient ferme et souple.</p>', 1.00, 'Tiyya', 20, 1, '2025-01-21 23:51:42', '2025-01-26 20:21:17', NULL, NULL, NULL, 'null', 1),
(86, 'Huile de pépins de figue de barbarie', '<p>Huile de pépins de figue de barbarie, 100% naturelle et de première pression&nbsp;à froid. Un puissant anti-âge !</p><p><strong>Utilisation</strong> :&nbsp;Déposez une fine couche d\'huile en massage très doux sur le visage, le cou et les&nbsp;mains.&nbsp;A utiliser le soir avant le coucher.</p><p><strong>Résultat</strong> : Maintient souplesse, fermeté et tonicité de la peau.</p>', 1.00, 'Tiyya', 20, 1, '2025-01-21 23:53:22', '2025-01-26 20:21:17', NULL, NULL, NULL, 'null', 1),
(87, 'Amande délice : Huile sèche senteur amande', '<p>Enveloppez-vous par un parfum raffiné et rempli de douceur. Cette huile sèche senteur amande diffuse des notes suaves qui vous transporteront au-delà des sens.</p><p><strong>Ingrédients :</strong>&nbsp;Huile d\'argan, huile de pépins de raisin, huile de macadamia, huile de sésame et huile de tournesol.</p><p><strong>Utilisation :</strong>&nbsp;Se vaporise sur le corps, s\'utilise aussi en mouvements circulaires pour les massages et en capillaire sur les longueurs et les pointes.</p><p><strong>Résultat :</strong>&nbsp;Cheveu hydraté,&nbsp;peau nourrie, douce et illuminée.&nbsp;</p>', 1.00, 'Tiyya', 21, 1, '2025-01-22 00:05:53', '2025-01-26 20:21:17', NULL, NULL, NULL, 'null', 1),
(88, 'Rose Sublime : Huile sèche senteur rose', '<p>Infiniment sensuelle, raffinée et intrigante ! Un parfum d’exception, entre les nuances de la délicatesse de la rose et de l’exotisme de l’oud, cette huile sèche senteur rose vous permettra d\'hydrater, de nourrir et de sublimer votre peau au quotidien.</p><p><strong>Ingrédients :&nbsp;</strong>Huile d\'argan, huile de pépins de raisin, huile de macadamia, huile de sésame et huile de tournesol.&nbsp;</p><p><strong>Utilisation :&nbsp;</strong>Se vaporise sur le corps, s\'utilise aussi en mouvements circulaires pour les massages et en capillaire sur les longueurs et les pointes.&nbsp;</p><p><strong>Résultat :</strong>&nbsp;Cheveu hydraté,&nbsp;peau nourrie, douce et illuminée.&nbsp;</p>', 1.00, 'Tiyya', 21, 1, '2025-01-22 00:07:59', '2025-01-26 20:21:17', NULL, NULL, NULL, 'null', 1),
(89, 'Jasmin éternel : Huile sèche senteur jasmin', '<p>La senteur apaisante de l’huile sèche Jasmin est reconnaissable entre mille, et ses notes sucrées et fleuries diffusent et éveillent les sens pour un plaisir olfactif unique.</p><p><strong>Ingrédients :</strong> Huile d\'argan, huile de pépins de raisin, huile de macadamia, huile de sésame et huile de tournesol.</p><p><strong>Utilisation :</strong> Se vaporise sur le corps, s\'utilise aussi en mouvements circulaires pour les massages et en capillaire sur les longueurs et les pointes.</p><p><strong>Résultat :</strong>&nbsp;Cheveu hydraté,&nbsp;peau nourrie, douce et illuminée.&nbsp;</p>', 1.00, 'Tiyya', 21, 1, '2025-01-22 00:09:45', '2025-01-26 20:21:17', NULL, NULL, NULL, 'null', 1),
(90, 'Néroli Ancestral : Huile sèche senteur néroli', '<p>Une huile sèche aux notes pétillantes, toniques et lumineuses du Néroli enveloppe le corps d’un délicat nuage de parfum rafraîchissant et préserve l’hydratation de la peau et la réconforte en douceur. Elle sera votre meilleur allié pour une peau nourrie.</p><p><strong>Ingrédients : </strong>Huile d\'argan, huile de pépins de raisin, huile de macadamia, huile de sésame et huile de tournesol.&nbsp;</p><p><strong>Utilisation : </strong>Se vaporise sur le corps, s\'utilise aussi en mouvements circulaires pour les massages et en capillaire sur les longueurs et les pointes.&nbsp;</p><p><strong>Résultat :</strong>&nbsp;Cheveu hydraté,&nbsp;peau nourrie, douce et illuminée.&nbsp;</p>', 1.00, 'Tiyya', 21, 1, '2025-01-22 00:11:14', '2025-01-26 20:21:17', NULL, NULL, NULL, 'null', 1),
(91, 'Eau de Rose Certifiée Bio*', '<p>La joie d’une peau tonifiée&nbsp;: La vie en rose et en Bio…</p><p>L’eau de rose certifiée bio* de Kelaat Mgouna est utilisée depuis l’antiquité pour ses vertus nettoyantes et antibactériennes. L’époque étant au retour au naturel, elle revient en force et on aurait tort de s’en priver.</p><p>Sa senteur naturelle et unique, fidèle aux notes de la fleur à la rosée du matin !</p><p>Douce et apaisante, elle est particulièrement recommandée pour nettoyer le visage et ôter les dernières traces de maquillage.</p><p><strong>Ingrédient :</strong>&nbsp;Eau florale de Rose</p><p><strong>Utilisation&nbsp;:</strong> Appliquez sur le visage matin et soir pour retrouver une peau revitalisée, démaquillée et un teint éclatant.</p><p><strong>Résultat&nbsp;:</strong> &nbsp;Peau douce, nette et apaisée</p><p><i>*Cosmétique Ecologique et Biologique Certifiée par Ecocert, Greenlife et labélisée; Cosmébio</i></p>', 1.00, 'Tiyya', 22, 1, '2025-01-22 00:18:49', '2025-01-26 20:21:17', NULL, NULL, NULL, 'null', 1),
(92, 'Eau de Fleur d\'Oranger Certifiée Bio*', '<p>Le plaisir d’une peau rafraichie. L’eau Calmante …</p><p>C\'est l\'eau florale par excellence des personnes stressés, tendues. Elle est réputée pour ses propriétés rafraichissantes et calmantes. Elle détend, assouplie et adoucie la peau tout en laissant un parfum très agréable.</p><p>L’Eau de Fleur d’Oranger certifiée Bio* prenant de Dar Belamri parfume et revitalise votre peau. Pendant l’été, vous pouvez également placer le flacon dans votre réfrigérateur pour vous rafraîchir instantanément.</p><p><strong>Ingrédient :</strong>&nbsp;Eau florale d\'Orange</p><p><strong>Utilisation :</strong> Quotidienne. S’applique en vaporisation sur le corps et le visage.</p><p><strong>Résultat :</strong> Calmante et adoucissante, l’eau de fleur d’oranger rafraichît et apaise la peau tout en laissant un parfum très agréable.</p><p><i>*Cosmétique Ecologique et Biologique Certifiée par Ecorcert, Greenlife et labélisée; Cosmébio</i></p>', 1.00, 'Tiyya', 22, 1, '2025-01-22 00:20:19', '2025-01-26 20:21:17', NULL, NULL, NULL, 'null', 1),
(93, 'Déodorant à la Pierre d\'Alun', '<p>La Pierre d\'Alun, minéral translucide issu de la cristallisation de sels minéraux, possède des vertus astringentes connues depuis des siècles. Le déodorant Tiyya Pierre d\'Alun est une solution 100 % naturelle pour dissimuler les petits désagréments de la transpiration, empêcher la fermentation et neutraliser les bactéries responsables des mauvaises odeurs.</p><p><strong>Utilisation</strong> : Mouiller la Pierre avec de l’eau froide et frotter légèrement la peau. Appliquer aux aisselles, aux pieds et sur toute autre partie du corps où la transpiration est excessive.</p><p><strong>Résultat</strong> : Peau fraîche.</p>', 1.00, 'Tiyya', 22, 1, '2025-01-22 00:23:08', '2025-01-26 20:21:17', NULL, NULL, NULL, 'null', 1),
(94, 'Argile Rouge', '<p>Poudre purifiante d\'argile rouge, un soin ancestral, ‘’ bonne mine’’ par excellence. Incroyablement riche en oxyde de fer, dont elle puise sa couleur.</p><p><strong>Utilisation</strong> :&nbsp;Réalisez une pâte d’argile (en rajoutant de l\'eau tiède) à appliquer directement sur la peau en masque une fois par semaine pendant 10 à 15 minutes, puis rincez à l’eau claire. A utiliser en masque pour purifier et nettoyer la peau en profondeur.</p><p><strong>Résultat</strong> : La peau est nettoyée et purifiée, elle retrouve tout son éclat. Convient parfaitement à tous types de peaux.</p>', 1.00, 'Tiyya', 23, 1, '2025-01-22 00:25:10', '2025-01-26 20:21:17', NULL, NULL, NULL, 'null', 1),
(95, 'Argile blanche', '<p>Riche en minéraux et oligo-éléments, utilisée comme soin de beauté pour&nbsp;plus d\'éclat, et utilisée dans l’antiquité comme agent thérapeutique universel. Provenant&nbsp;de la terre, son utilisation remonte à la nuit des temps.</p><p><strong>Utilisation</strong> :&nbsp;Mélangez l’argile blanche aux eaux florales, eau minérale tiède ou aux huiles végétales&nbsp;et appliquez en couche épaisse, laissez poser 15 minutes et rincez à l’eau claire.</p><p><strong>Résultat</strong> :&nbsp;La peau est nettoyée et purifiée, elle retrouve tout son éclat.</p>', 1.00, 'Tiyya', 23, 1, '2025-01-22 00:26:24', '2025-01-26 20:21:17', NULL, NULL, NULL, 'null', 1),
(96, 'Argile verte', '<p>Riche en minéraux, , l’argile verte purifie et nettoie la peau en profondeur. Elle contient du fer, potassium, magnésium, sodium, et du zinc. Convient parfaitement à tous types de peaux.</p><p><br><strong>Utilisation: </strong>Réaliser une pâte d’argile verte à appliquer directement sur la peau en masque, une fois par semaine pendant 10 min, puis rincez à l’eau claire.&nbsp;<br>&nbsp;</p><p>&nbsp;</p><p><strong>Résultat</strong> :&nbsp;La peau est nettoyée et purifiée, elle retrouve tout son éclat.</p>', 1.00, 'Tiyya', 23, 1, '2025-01-22 00:27:28', '2025-01-26 20:21:17', NULL, NULL, NULL, 'null', 1),
(97, 'SYNERGIE VEGETALE - Huile de soin cheveux', '<p><i><strong>Synergie de cinq huiles végétales&nbsp;</strong></i></p><p>Avocat régénérante, et coco, protectrice, s\'unissent au ricin, au jojoba et à l\'argan pour compléter cette fusion, offrant ainsi à vos cheveux brillance et douceur.</p><p>Ces huiles, réputées pour leurs bienfaits capillaires, sont&nbsp;enrichie de quatre huiles essentielles pour une application en soin cheveux 2 heures avant le shampoing.</p><p><strong>A appliquer le soir et à conserver à l\'abri du soleil et de la chaleur.&nbsp;</strong></p>', 0.00, 'Tiyya', 24, 1, '2025-01-22 00:31:54', '2025-01-22 00:31:54', NULL, NULL, NULL, 'null', 1),
(98, 'Huile végétale de Ricin', '<p><strong>Nourrissante &amp; revitalisante&nbsp;</strong></p><p>Cette huile représente un véritable ingrédient naturel pour enrichir votre rituel de soins, offrant une solution idéale pour vos diverses préparations cosmétiques.</p><p>Nourrissante et revitalisante, elle améliore la qualité des cheveux en leur offrant éclat et douceur grâce à son effet brillant.</p><p><strong>Base de préparation de soin.&nbsp;</strong></p><p><strong>A appliquer le soir et à conserver à l\'abri du soleil et de la chaleur.&nbsp;</strong></p>', 0.00, 'Tiyya', 24, 1, '2025-01-22 00:32:51', '2025-01-22 00:32:51', NULL, NULL, NULL, 'null', 1),
(99, 'Macérât huileux de romarin', '<p>Ce macérât huileux de romarin se révèle être un véritable trésor pour les soins capillaires.</p><p>Répartir celui-ci sur les longueurs et les pointes, laissez poser comme masque capillaire au moins 30 minutes avant de laver avec votre shampoing.</p><p><strong>Base de préparation de soin.&nbsp;</strong></p><p><strong>A appliquer le soir et à conserver à l\'abri du soleil et de la chaleur.&nbsp;</strong></p>', 0.00, 'Tiyya', 24, 1, '2025-01-22 00:33:34', '2025-01-22 00:33:34', NULL, NULL, NULL, 'null', 1),
(100, 'Trousse Hammam', '<p>Cette trousse imperméable ravira tous ceux qui souhaitent découvrir l’expérience unique d’un hammam traditionnel marocain.</p><p>Elle contient : L’unique Savon noir aux huiles essentielles pour purifier et parfumer votre peau, l’incontournable Rhassoul aux huiles essentielles pour adoucir votre peau et prendre soin de votre cuir chevelu et l’indispensable gant Tiyya pour débarrasser le corps des impuretés, le tout dans une jolie trousse transparente avec le logo Tiyya.</p><p><strong>Utilisation</strong> : L\'essentiel du Hammam.</p>', 0.00, 'Tiyya', 25, 1, '2025-01-22 00:36:52', '2025-01-22 00:36:52', NULL, NULL, NULL, 'null', 1),
(101, 'TIYYA - Coffret Miniatures', '<p>Un hammam improvisé, un petit week-end organisé ou encore un joli cadeau recherché? Le coffret miniature de Tiyya s’avère être très pratique et riche en découverte.</p><p><strong>Le coffret miniatures TIYYA</strong> se compose de 6 produits :</p><p>- Eau de rose certifiée Bio* Miniature 30 ml</p><p>- Eau de fleur d’oranger certifiée bio* Miniature 30 ml</p><p>- Huile d’argan Bio* 50 ml</p><p>- Savon noir aux huiles essentielles Miniature 50 ml</p><p>- Rhassoul somptueux au miel Miniature 50 ml</p><p>- Henné à la rose Miniature 50 ml</p><p>&nbsp;</p><p>&nbsp;</p><p>*Cosmétique écologique et biologique certifiée par EcocertGreenlife et labelisée cosmébio</p>', 1.00, 'Tiyya', 25, 1, '2025-01-22 00:38:00', '2025-01-26 20:21:17', NULL, NULL, NULL, 'null', 1),
(102, 'TIYYA - KIT HAMMAM : Harmonie Orientale', '<p>Plongez dans l\'expérience relaxante du kit hammam Tiyya, où la caresse soyeuse du savon noir réveillera vos sens, laissant votre peau satinée. Le rhassoul, secret ancestral, enveloppera votre corps dans une étreinte purifiante, capturant la magie et les bienfaits des rituels marocains. Accompagné d\'un gant de gommage, chaque mouvement révélera une harmonie délicate d\'éclat et de renouveau.</p><p><strong>Le Kit Hammam&nbsp;</strong>se compose de 3 produits :</p><p><br>&nbsp;</p><p>- Savon noir aux huiles essentielles Miniature 50 ml</p><p>- Rhassoul somptueux au miel Miniature 50 ml</p><p>- Gant TIYYA</p>', 1.00, 'Tiyya', 25, 1, '2025-01-22 00:39:57', '2025-01-26 20:21:17', NULL, NULL, NULL, 'null', 1),
(103, 'TIYYA - Boîte 3 pots miniatures', '<p>Un hammam improvisé, un petit week-end organisé ou encore un joli cadeau recherché?&nbsp;</p><p>Notre Boîte miniatures Tiyya s’avère être très pratique et riche en découverte.</p><p><strong>La boîte 3 pots miniatures TIYYA</strong> se compose de 3 produits :</p><p>&nbsp;</p><p>- Savon noir aux huiles essentielles Miniature 50 ml</p><p>- Rhassoul somptueux au miel Miniature 50 ml</p><p>- Henné à la rose Miniature 50 ml</p>', 1.00, 'Tiyya', 25, 1, '2025-01-22 00:41:16', '2025-01-26 20:21:17', NULL, NULL, NULL, 'null', 1),
(104, 'Trousse Voyage - Escapade Sensorielle', '<p>Cette trousse contient :&nbsp;</p><p>- Eau de rose* - <strong>30ml</strong></p><p>- Huile d\'Argan* - <strong>50ml</strong></p><p>- Savon noir aux huiles essentielles -&nbsp;<strong>50ml&nbsp;</strong></p><p>- Rhassoul somptueux au miel – <strong>50ml</strong></p><p>- Fluide gommant à l\'orange – <strong>50ml</strong></p><p>- Gant Tiyya</p><p>&nbsp;</p><p><i>* Cosmétique Ecologique et Biologique Certifiée par Ecocert, Greenlife et labélisée; Cosmébio</i></p><p>Vos produits seront dans une trousse de <strong>22,5 x 15,5 cm.</strong></p>', 1.00, 'Tiyya', 25, 1, '2025-01-22 00:42:08', '2025-01-26 20:21:17', NULL, NULL, NULL, 'null', 1),
(106, 'Trousse Voyage - Rituel Hammam', '<p>Cette trousse ravira tous ceux qui souhaitent découvrir l’expérience unique d’un hammam traditionnel marocain.</p><p>Cette trousse contient :&nbsp;</p><p>- Eau de rose* - <strong>30ml</strong></p><p>- Eau de fleur d’oranger* - <strong>30ml</strong></p><p>- Savon noir et savon noir aux huiles essentielles - <strong>50ml</strong></p><p>- Rhassoul aux huiles essentielles – <strong>50ml</strong></p><p>- Rhassoul somptueux au miel – <strong>50ml</strong></p><p>- Henné doux à la rose – <strong>50ml</strong></p><p>- Gant Tiyya</p><p>&nbsp;</p><p><i>* Cosmétique Ecologique et Biologique Certifiée par Ecocert, Greenlife et labélisée; Cosmébio</i></p><p>Vos produits seront dans une trousse de <strong>22,5 x 15,5 cm.</strong></p><p><br>&nbsp;</p>', 1.00, 'Tiyya', 25, 1, '2025-01-22 00:45:53', '2025-01-26 20:21:17', NULL, NULL, NULL, 'null', 1),
(107, 'Trousse Voyage - Découverte du rituel soin rafraichissant à la Rose', '<p>Evadez-vous en beauté et vivez des expériences sensorielles inoubliables avec cette trousse de voyage Tiyya.</p><p>La trousse contient :</p><p>-Rose sublime&nbsp;: Huile sèche senteur rose – <strong>100ml</strong></p><p>-Eau de rose* - <strong>30ml</strong></p><p>-Henné doux à la rose – <strong>50ml</strong></p><p>- Savon exfoliant nigelle – <strong>80gr</strong></p><p>- Déodorant à la pierre d’Alun – <strong>60gr</strong></p><p><i>* Cosmétique Ecologique et Biologique Certifiée par Ecocert, Greenlife et labélisée; Cosmébio</i></p><p>Vos produits seront dans une trousse de <strong>22,5 x 15,5 cm.</strong></p>', 1.00, 'Tiyya', 25, 1, '2025-01-22 00:46:52', '2025-01-26 20:21:17', NULL, NULL, NULL, 'null', 1),
(108, 'Trousse Voyage - Rituel soin Miel & Fleur d\'oranger', '<p>Succombez aux délices réconfortants du miel et de la fleur d’oranger avec le rituel de soins de cette trousse de voyage Tiyya :</p><p>Cette trousse contient :<br>- Néroli ancestral&nbsp;:&nbsp; Huile sèche senteur néroli – <strong>100ml</strong><br>- Eau de fleur d’oranger – <strong>30 ml</strong><br>- Savon exfoliant au miel – <strong>80gr</strong><br>- Huile d’argan* - <strong>50ml</strong><br>- Rhassoul somptueux au miel – <strong>50ml</strong></p><p><i>* Cosmétique Ecologique et Biologique Certifiée par Ecocert, Greenlife et labélisée; Cosmébio</i></p><p>Vos produits seront dans une trousse de <strong>22,5 x 15,5 cm.</strong></p>', 1.00, 'Tiyya', 25, 1, '2025-01-22 00:48:39', '2025-01-26 20:21:17', NULL, NULL, NULL, 'null', 1),
(109, 'Coffret Senteurs de Vie', '<ul><li>Fluide gommant à l\'Orange - <strong>50ml</strong></li><li>Fluide gommant senteur Thé vert - <strong>50ml</strong></li><li>Amande délice - Huile sèche senteur Amande -<strong>&nbsp;30ml</strong></li><li>Jasmin éternel - Huile sèche senteur Jasmin -<strong> 30ml</strong></li><li>Néroli ancestral - Huile sèche senteur Néroli -&nbsp;<strong>30ml</strong></li><li>Rose sublime - Huile sèche senteur Rose-&nbsp;<strong>30ml</strong></li></ul>', 0.00, 'Tiyya', 25, 1, '2025-01-22 00:49:35', '2025-01-22 00:50:05', NULL, NULL, NULL, 'null', 1),
(110, 'TIYYA - Coffret Miniatures Prestige', '<p><strong>Le coffret miniatures prestige TIYYA</strong> se compose de 6 produits :</p><ul><li><strong>Miniature Savon noir</strong> aux huiles essentielles&nbsp; 50 ml&nbsp;</li><li><strong>Miniature</strong> Rhassoul somptueux au Miel 50 ml&nbsp;&nbsp;</li><li>Huile de jeunesse à la figue de barbarie - <strong>Retail&nbsp;</strong></li><li><strong>Miniature</strong> Néroli Ancestral - Huile sèche senteur néroli</li><li><strong>Miniature</strong> Rose sublime - Huile sèche senteur rose</li><li><strong>Miniature</strong> Fluide gommant à l’orange</li></ul>', 1.00, 'Tiyya', 25, 1, '2025-01-22 00:51:00', '2025-01-26 20:21:17', NULL, NULL, NULL, 'null', 1),
(111, 'TIYYA - Coffret Miniatures Prestige', '<p><strong>Le coffret miniatures prestige TIYYA</strong> se compose de 6 produits :</p><ul><li><strong>Miniature Savon noir</strong> aux huiles essentielles 50 ml&nbsp;</li><li><strong>Miniature</strong> Rhassoul somptueux au Miel 50 ml&nbsp;&nbsp;</li><li>Huile de jeunesse à la figue de barbarie - <strong>Retail&nbsp;</strong></li><li><strong>Miniature</strong> Amande délice - Huile sèche senteur amande 30 ml</li><li><strong>Miniature</strong> Jasmin éternel- Huile sèche senteur jasmin 30 ml</li><li><strong>Miniature</strong> Fluide gommant senteur Thé vert 50 ml</li></ul>', 0.00, 'Tiyya', 25, 1, '2025-01-22 00:51:42', '2025-01-22 00:53:24', NULL, NULL, NULL, 'null', 1),
(112, 'Brosse Bois Tiyya', '<p>Conseil d\'utilisation : Brosse ovale en bamboo et bois avec logo Tiyya</p><p><br>&nbsp;</p>', 0.00, 'Tiyya', 25, 1, '2025-01-22 00:52:36', '2025-01-22 00:52:36', NULL, NULL, NULL, 'null', 1),
(113, 'Sac Essentiels de Douceur', '<p>Ce kit contient :&nbsp;</p><ul><li>Fluide gommant à l\'Orange - <strong>50ml</strong></li><li>Fluide gommant senteur Thé vert - <strong>50ml</strong></li></ul><p><strong>Au choix : 2 Huiles sèches</strong></p><ul><li>Amande délice - Huile sèche senteur Amande -<strong>&nbsp;30ml</strong></li><li>Jasmin éternel - Huile sèche senteur Jasmin -<strong> 30ml</strong></li><li>Néroli ancestral - Huile sèche senteur Néroli -&nbsp;<strong>30ml</strong></li><li>Rose sublime - Huile sèche senteur Rose-&nbsp;<strong>30ml</strong></li></ul>', 0.00, 'Tiyya', 25, 1, '2025-01-22 00:53:16', '2025-01-22 00:53:16', NULL, NULL, NULL, 'null', 1),
(115, 'Coffret tarbouche', '<p>Conseil d\'utilisation : Coffret forme tarbouche rouge petit modèle</p>', 1.00, 'Tiyya', 25, 1, '2025-01-26 18:04:39', '2025-01-26 20:21:17', NULL, NULL, NULL, 'null', 1),
(116, 'Savon fleur miel', '<p>Conseil d\'utilisation : Savons en forme de rose parfumés</p>', 1.00, 'Tiyya', 25, 1, '2025-01-26 18:10:57', '2025-01-26 20:21:17', NULL, NULL, NULL, 'null', 1),
(117, 'Savon fleur d\'Oranger', '<p>Conseil d\'utilisation : Savons en forme de rose parfumés</p>', 1.00, 'Tiyya', 25, 1, '2025-01-26 18:11:59', '2025-01-26 20:21:17', NULL, NULL, NULL, 'null', 1),
(118, 'Savon fleur Jasmin', '<p>Conseil d\'utilisation : Savons en forme de rose parfumés</p>', 1.00, 'Tiyya', 25, 1, '2025-01-26 18:12:47', '2025-01-26 20:21:17', NULL, NULL, NULL, 'null', 0),
(119, 'Savon fleur citron', '<p>Conseil d\'utilisation : Savons en forme de rose parfumés</p>', 1.00, 'Tiyya', 25, 1, '2025-01-26 18:13:26', '2025-01-26 20:21:17', NULL, NULL, NULL, 'null', 1),
(120, 'Savon fleur Thé vert', '<p>Conseil d\'utilisation : Savons en forme de rose parfumés</p><p><br>&nbsp;</p>', 1.00, 'Tiyya', 25, 1, '2025-01-26 18:14:04', '2025-01-26 20:21:17', NULL, NULL, NULL, 'null', 1),
(121, 'Savon fleur rose', '<p>Conseil d\'utilisation : Savons en forme de rose parfumés</p>', 1.00, 'Tiyya', 25, 1, '2025-01-26 18:14:47', '2025-01-26 20:21:17', NULL, NULL, NULL, 'null', 1),
(122, 'Savon fleur verveine', '<p>Conseil d\'utilisation : Savons en forme de rose parfumés</p>', 1.00, 'Tiyya', 25, 1, '2025-01-26 18:16:24', '2025-01-26 20:21:17', NULL, NULL, NULL, 'null', 1),
(123, 'Savon fleur Musc', '<p>Conseil d\'utilisation : Savons en forme de rose parfumés</p>', 1.00, 'Tiyya', 25, 1, '2025-01-26 18:17:15', '2025-01-26 20:21:17', NULL, NULL, NULL, 'null', 1),
(124, 'Bougie Fleur d\'oranger Tiyya', '<p>Conseil d\'utilisation : Bougie senteur fleur d\'oranger avec logo Tiyya - habillage simili cuir</p>', 1.00, 'Tiyya', 25, 1, '2025-01-26 18:19:11', '2025-01-26 20:21:17', NULL, NULL, NULL, 'null', 1),
(125, 'Serviette Tiyya', '<p>Conseil d\'utilisation : Serviette en coton avec motif brodé petit modèle.</p>', 0.00, 'Tiyya', 25, 1, '2025-01-26 20:26:08', '2025-01-26 20:26:08', NULL, NULL, NULL, '[\"Dor\\u00e9\",\"Rose\",\"Argent\\u00e9\"]', 1);

-- --------------------------------------------------------

--
-- Structure de la table `product_images`
--

CREATE TABLE `product_images` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `product_id` bigint(20) UNSIGNED NOT NULL,
  `image_path` varchar(255) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Déchargement des données de la table `product_images`
--

INSERT INTO `product_images` (`id`, `product_id`, `image_path`, `created_at`, `updated_at`) VALUES
(82, 61, 'files/products_images/17374900087352.webp', '2025-01-21 20:06:48', '2025-01-21 20:06:48'),
(83, 61, 'files/products_images/17374900086879.webp', '2025-01-21 20:06:48', '2025-01-21 20:06:48'),
(84, 61, 'files/products_images/17374900085697.webp', '2025-01-21 20:06:48', '2025-01-21 20:06:48'),
(85, 62, 'files/products_images/17374901473125.webp', '2025-01-21 20:09:07', '2025-01-21 20:09:07'),
(86, 62, 'files/products_images/17374901472166.webp', '2025-01-21 20:09:07', '2025-01-21 20:09:07'),
(87, 62, 'files/products_images/17374901472516.webp', '2025-01-21 20:09:07', '2025-01-21 20:09:07'),
(88, 63, 'files/products_images/17374913845510.webp', '2025-01-21 20:29:44', '2025-01-21 20:29:44'),
(89, 63, 'files/products_images/17374913845958.webp', '2025-01-21 20:29:44', '2025-01-21 20:29:44'),
(90, 63, 'files/products_images/17374913849436.webp', '2025-01-21 20:29:44', '2025-01-21 20:29:44'),
(101, 60, 'files/products_images/17375008017676.webp', '2025-01-21 23:06:41', '2025-01-21 23:06:41'),
(102, 60, 'files/products_images/17375008014958.webp', '2025-01-21 23:06:41', '2025-01-21 23:06:41'),
(103, 60, 'files/products_images/17375008018637.webp', '2025-01-21 23:06:41', '2025-01-21 23:06:41'),
(104, 60, 'files/products_images/17375008016386.webp', '2025-01-21 23:06:41', '2025-01-21 23:06:41'),
(106, 68, 'files/products_images/17375016769322.webp', '2025-01-21 23:21:16', '2025-01-21 23:21:16'),
(107, 68, 'files/products_images/17375016764718.webp', '2025-01-21 23:21:16', '2025-01-21 23:21:16'),
(108, 68, 'files/products_images/17375016766048.webp', '2025-01-21 23:21:16', '2025-01-21 23:21:16'),
(109, 68, 'files/products_images/17375016762775.webp', '2025-01-21 23:21:16', '2025-01-21 23:21:16'),
(110, 69, 'files/products_images/17375017727344.webp', '2025-01-21 23:22:52', '2025-01-21 23:22:52'),
(111, 69, 'files/products_images/17375017728089.webp', '2025-01-21 23:22:52', '2025-01-21 23:22:52'),
(112, 69, 'files/products_images/17375017729196.webp', '2025-01-21 23:22:52', '2025-01-21 23:22:52'),
(113, 69, 'files/products_images/17375017722447.webp', '2025-01-21 23:22:52', '2025-01-21 23:22:52'),
(114, 69, 'files/products_images/17375017727597.webp', '2025-01-21 23:22:52', '2025-01-21 23:22:52'),
(115, 70, 'files/products_images/17375019688040.webp', '2025-01-21 23:26:08', '2025-01-21 23:26:08'),
(116, 70, 'files/products_images/17375019698803.webp', '2025-01-21 23:26:09', '2025-01-21 23:26:09'),
(117, 70, 'files/products_images/17375019692379.webp', '2025-01-21 23:26:09', '2025-01-21 23:26:09'),
(118, 70, 'files/products_images/17375019694512.webp', '2025-01-21 23:26:09', '2025-01-21 23:26:09'),
(119, 71, 'files/products_images/17375020469487.webp', '2025-01-21 23:27:26', '2025-01-21 23:27:26'),
(120, 71, 'files/products_images/17375020467646.webp', '2025-01-21 23:27:26', '2025-01-21 23:27:26'),
(121, 71, 'files/products_images/17375020469197.webp', '2025-01-21 23:27:26', '2025-01-21 23:27:26'),
(122, 71, 'files/products_images/17375020463857.webp', '2025-01-21 23:27:26', '2025-01-21 23:27:26'),
(123, 72, 'files/products_images/17375021397531.webp', '2025-01-21 23:28:59', '2025-01-21 23:28:59'),
(124, 72, 'files/products_images/17375021399722.webp', '2025-01-21 23:28:59', '2025-01-21 23:28:59'),
(125, 73, 'files/products_images/17375022238807.webp', '2025-01-21 23:30:23', '2025-01-21 23:30:23'),
(126, 73, 'files/products_images/17375022237356.webp', '2025-01-21 23:30:23', '2025-01-21 23:30:23'),
(127, 74, 'files/products_images/17375026717898.webp', '2025-01-21 23:37:51', '2025-01-21 23:37:51'),
(128, 74, 'files/products_images/17375026717363.webp', '2025-01-21 23:37:51', '2025-01-21 23:37:51'),
(129, 75, 'files/products_images/17375027998999.webp', '2025-01-21 23:39:59', '2025-01-21 23:39:59'),
(130, 75, 'files/products_images/17375027993738.webp', '2025-01-21 23:39:59', '2025-01-21 23:39:59'),
(131, 76, 'files/products_images/17375028931574.webp', '2025-01-21 23:41:33', '2025-01-21 23:41:33'),
(132, 76, 'files/products_images/17375028936702.webp', '2025-01-21 23:41:33', '2025-01-21 23:41:33'),
(133, 77, 'files/products_images/17375029562790.webp', '2025-01-21 23:42:36', '2025-01-21 23:42:36'),
(134, 77, 'files/products_images/17375029567868.webp', '2025-01-21 23:42:36', '2025-01-21 23:42:36'),
(135, 78, 'files/products_images/17375030361063.webp', '2025-01-21 23:43:56', '2025-01-21 23:43:56'),
(136, 79, 'files/products_images/17375030749046.webp', '2025-01-21 23:44:34', '2025-01-21 23:44:34'),
(137, 80, 'files/products_images/17375031322526.webp', '2025-01-21 23:45:32', '2025-01-21 23:45:32'),
(138, 81, 'files/products_images/17375031844622.webp', '2025-01-21 23:46:24', '2025-01-21 23:46:24'),
(139, 82, 'files/products_images/17375032492426.webp', '2025-01-21 23:47:29', '2025-01-21 23:47:29'),
(142, 84, 'files/products_images/17375034329677.webp', '2025-01-21 23:50:32', '2025-01-21 23:50:32'),
(143, 84, 'files/products_images/17375034326038.webp', '2025-01-21 23:50:32', '2025-01-21 23:50:32'),
(144, 85, 'files/products_images/17375035028615.webp', '2025-01-21 23:51:42', '2025-01-21 23:51:42'),
(145, 86, 'files/products_images/17375036027035.webp', '2025-01-21 23:53:22', '2025-01-21 23:53:22'),
(146, 86, 'files/products_images/17375036026278.webp', '2025-01-21 23:53:22', '2025-01-21 23:53:22'),
(147, 87, 'files/products_images/17375043814146.webp', '2025-01-22 00:05:53', '2025-01-22 00:06:21'),
(148, 87, 'files/products_images/17375043532212.webp', '2025-01-22 00:05:53', '2025-01-22 00:05:53'),
(149, 87, 'files/products_images/17375043532740.webp', '2025-01-22 00:05:53', '2025-01-22 00:05:53'),
(150, 87, 'files/products_images/17375043539434.webp', '2025-01-22 00:05:53', '2025-01-22 00:05:53'),
(151, 88, 'files/products_images/17375044795904.webp', '2025-01-22 00:07:59', '2025-01-22 00:07:59'),
(152, 88, 'files/products_images/17375044791122.webp', '2025-01-22 00:07:59', '2025-01-22 00:07:59'),
(153, 88, 'files/products_images/17375044797555.webp', '2025-01-22 00:07:59', '2025-01-22 00:07:59'),
(154, 88, 'files/products_images/17375044791356.webp', '2025-01-22 00:07:59', '2025-01-22 00:07:59'),
(155, 89, 'files/products_images/17375045856367.webp', '2025-01-22 00:09:45', '2025-01-22 00:09:45'),
(156, 89, 'files/products_images/17375045853636.webp', '2025-01-22 00:09:45', '2025-01-22 00:09:45'),
(157, 89, 'files/products_images/17375045854629.webp', '2025-01-22 00:09:45', '2025-01-22 00:09:45'),
(158, 89, 'files/products_images/17375045851012.webp', '2025-01-22 00:09:45', '2025-01-22 00:09:45'),
(159, 90, 'files/products_images/17375046749736.webp', '2025-01-22 00:11:14', '2025-01-22 00:11:14'),
(160, 90, 'files/products_images/17375046745696.webp', '2025-01-22 00:11:14', '2025-01-22 00:11:14'),
(161, 90, 'files/products_images/17375046743123.webp', '2025-01-22 00:11:14', '2025-01-22 00:11:14'),
(162, 90, 'files/products_images/17375046749442.webp', '2025-01-22 00:11:14', '2025-01-22 00:11:14'),
(163, 91, 'files/products_images/17375051294865.webp', '2025-01-22 00:18:49', '2025-01-22 00:18:49'),
(164, 91, 'files/products_images/17375051293066.webp', '2025-01-22 00:18:49', '2025-01-22 00:18:49'),
(165, 92, 'files/products_images/17375052194137.webp', '2025-01-22 00:20:19', '2025-01-22 00:20:19'),
(166, 92, 'files/products_images/17375052198865.webp', '2025-01-22 00:20:19', '2025-01-22 00:20:19'),
(167, 93, 'files/products_images/17375053884282.webp', '2025-01-22 00:23:08', '2025-01-22 00:23:08'),
(168, 93, 'files/products_images/17375053883594.webp', '2025-01-22 00:23:08', '2025-01-22 00:23:08'),
(169, 94, 'files/products_images/17375055105207.webp', '2025-01-22 00:25:10', '2025-01-22 00:25:10'),
(170, 94, 'files/products_images/17375055107598.webp', '2025-01-22 00:25:10', '2025-01-22 00:25:10'),
(171, 94, 'files/products_images/17375055101133.webp', '2025-01-22 00:25:10', '2025-01-22 00:25:10'),
(172, 95, 'files/products_images/17375055844980.webp', '2025-01-22 00:26:24', '2025-01-22 00:26:24'),
(173, 95, 'files/products_images/17375055844684.webp', '2025-01-22 00:26:24', '2025-01-22 00:26:24'),
(174, 95, 'files/products_images/17375055843917.webp', '2025-01-22 00:26:24', '2025-01-22 00:26:24'),
(175, 96, 'files/products_images/17375056487248.webp', '2025-01-22 00:27:28', '2025-01-22 00:27:28'),
(176, 96, 'files/products_images/17375056487206.webp', '2025-01-22 00:27:28', '2025-01-22 00:27:28'),
(177, 96, 'files/products_images/17375056485948.webp', '2025-01-22 00:27:28', '2025-01-22 00:27:28'),
(178, 97, 'files/products_images/17375059148588.webp', '2025-01-22 00:31:54', '2025-01-22 00:31:54'),
(179, 97, 'files/products_images/17375059144635.webp', '2025-01-22 00:31:54', '2025-01-22 00:31:54'),
(180, 98, 'files/products_images/17375059717132.webp', '2025-01-22 00:32:51', '2025-01-22 00:32:51'),
(181, 98, 'files/products_images/17375059712319.webp', '2025-01-22 00:32:51', '2025-01-22 00:32:51'),
(182, 99, 'files/products_images/17375060142547.webp', '2025-01-22 00:33:34', '2025-01-22 00:33:34'),
(183, 99, 'files/products_images/17375060149839.webp', '2025-01-22 00:33:34', '2025-01-22 00:33:34'),
(184, 100, 'files/products_images/17375062125440.webp', '2025-01-22 00:36:52', '2025-01-22 00:36:52'),
(185, 101, 'files/products_images/17375062803227.webp', '2025-01-22 00:38:00', '2025-01-22 00:38:00'),
(186, 101, 'files/products_images/17375062808500.webp', '2025-01-22 00:38:00', '2025-01-22 00:38:00'),
(187, 102, 'files/products_images/17375063973554.webp', '2025-01-22 00:39:57', '2025-01-22 00:39:57'),
(188, 103, 'files/products_images/17375064762961.webp', '2025-01-22 00:41:16', '2025-01-22 00:41:16'),
(189, 104, 'files/products_images/17375065281345.webp', '2025-01-22 00:42:08', '2025-01-22 00:42:08'),
(191, 106, 'files/products_images/17375067533456.webp', '2025-01-22 00:45:53', '2025-01-22 00:45:53'),
(192, 107, 'files/products_images/17375068121369.webp', '2025-01-22 00:46:52', '2025-01-22 00:46:52'),
(193, 108, 'files/products_images/17375069198468.webp', '2025-01-22 00:48:39', '2025-01-22 00:48:39'),
(194, 109, 'files/products_images/17375069751900.webp', '2025-01-22 00:49:35', '2025-01-22 00:49:35'),
(195, 110, 'files/products_images/17375070603935.webp', '2025-01-22 00:51:00', '2025-01-22 00:51:00'),
(196, 110, 'files/products_images/17375070603125.webp', '2025-01-22 00:51:00', '2025-01-22 00:51:00'),
(197, 111, 'files/products_images/17375071023907.webp', '2025-01-22 00:51:42', '2025-01-22 00:51:42'),
(198, 111, 'files/products_images/17375071025531.webp', '2025-01-22 00:51:42', '2025-01-22 00:51:42'),
(199, 112, 'files/products_images/17375071565061.webp', '2025-01-22 00:52:36', '2025-01-22 00:52:36'),
(200, 112, 'files/products_images/17375071568604.webp', '2025-01-22 00:52:36', '2025-01-22 00:52:36'),
(201, 113, 'files/products_images/17375071966511.webp', '2025-01-22 00:53:16', '2025-01-22 00:53:16'),
(203, 115, 'files/products_images/17379148754063.png', '2025-01-26 18:04:39', '2025-01-26 18:07:55'),
(204, 115, 'files/products_images/17379148755112.png', '2025-01-26 18:04:39', '2025-01-26 18:07:55'),
(205, 115, 'files/products_images/17379148751743.png', '2025-01-26 18:04:39', '2025-01-26 18:07:55'),
(206, 115, 'files/products_images/17379148754347.png', '2025-01-26 18:04:39', '2025-01-26 18:07:55'),
(207, 116, 'files/products_images/17379150572870.webp', '2025-01-26 18:10:57', '2025-01-26 18:10:57'),
(208, 117, 'files/products_images/17379151199373.webp', '2025-01-26 18:11:59', '2025-01-26 18:11:59'),
(209, 118, 'files/products_images/17379151674440.webp', '2025-01-26 18:12:47', '2025-01-26 18:12:47'),
(210, 119, 'files/products_images/17379152061411.webp', '2025-01-26 18:13:26', '2025-01-26 18:13:26'),
(211, 120, 'files/products_images/17379152443676.webp', '2025-01-26 18:14:04', '2025-01-26 18:14:04'),
(212, 121, 'files/products_images/17379153279044.webp', '2025-01-26 18:14:47', '2025-01-26 18:15:27'),
(213, 122, 'files/products_images/17379153843177.webp', '2025-01-26 18:16:24', '2025-01-26 18:16:24'),
(214, 123, 'files/products_images/17379154351375.webp', '2025-01-26 18:17:15', '2025-01-26 18:17:15'),
(215, 124, 'files/products_images/17379155517430.webp', '2025-01-26 18:19:11', '2025-01-26 18:19:11'),
(216, 125, 'files/products_images/17379231682197.webp', '2025-01-26 20:26:08', '2025-01-26 20:26:08'),
(217, 125, 'files/products_images/17379231689745.webp', '2025-01-26 20:26:08', '2025-01-26 20:26:08'),
(218, 125, 'files/products_images/17379231685513.webp', '2025-01-26 20:26:08', '2025-01-26 20:26:08'),
(219, 125, 'files/products_images/17379231685290.webp', '2025-01-26 20:26:08', '2025-01-26 20:26:08'),
(220, 125, 'files/products_images/17379231684632.webp', '2025-01-26 20:26:08', '2025-01-26 20:26:08'),
(221, 125, 'files/products_images/17379231686289.webp', '2025-01-26 20:26:08', '2025-01-26 20:26:08');

-- --------------------------------------------------------

--
-- Structure de la table `product_units`
--

CREATE TABLE `product_units` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `product_id` bigint(20) UNSIGNED NOT NULL,
  `unit` varchar(255) DEFAULT NULL,
  `price` decimal(8,2) NOT NULL,
  `discount_price` decimal(8,2) DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Déchargement des données de la table `product_units`
--

INSERT INTO `product_units` (`id`, `product_id`, `unit`, `price`, `discount_price`, `created_at`, `updated_at`) VALUES
(149, 63, '240 g', 1501.00, NULL, '2025-01-21 23:11:52', '2025-01-21 23:11:52'),
(156, 68, '250 ml', 262.00, NULL, '2025-01-21 23:21:23', '2025-01-21 23:21:23'),
(159, 70, '200 ml', 695.00, NULL, '2025-01-21 23:26:09', '2025-01-21 23:26:09'),
(162, 73, '80 gr', 154.00, NULL, '2025-01-21 23:30:23', '2025-01-21 23:30:23'),
(163, 72, '80 gr', 209.00, NULL, '2025-01-21 23:30:42', '2025-01-21 23:30:42'),
(164, 71, '200 ml', 695.00, NULL, '2025-01-21 23:31:19', '2025-01-21 23:31:19'),
(165, 74, '80 gr', 154.00, NULL, '2025-01-21 23:37:51', '2025-01-21 23:37:51'),
(166, 75, '80 gr', 154.00, NULL, '2025-01-21 23:39:59', '2025-01-21 23:39:59'),
(167, 76, '80 gr', 154.00, NULL, '2025-01-21 23:41:33', '2025-01-21 23:41:33'),
(168, 77, '80 gr', 154.00, NULL, '2025-01-21 23:42:36', '2025-01-21 23:42:36'),
(169, 78, 'Pack de 3 savons', 0.00, NULL, '2025-01-21 23:43:56', '2025-01-21 23:43:56'),
(170, 79, 'Pack de 3 savons', 0.00, NULL, '2025-01-21 23:44:34', '2025-01-21 23:44:34'),
(171, 80, 'Pack de 3 savons', 0.00, NULL, '2025-01-21 23:45:32', '2025-01-21 23:45:32'),
(172, 81, 'Pack de 3 savons', 0.00, NULL, '2025-01-21 23:46:24', '2025-01-21 23:46:24'),
(173, 82, 'Pack de 6 savons', 0.00, NULL, '2025-01-21 23:47:29', '2025-01-21 23:47:29'),
(176, 84, '50 ml', 0.00, NULL, '2025-01-21 23:50:32', '2025-01-21 23:50:32'),
(177, 84, '1 L', 576.00, NULL, '2025-01-21 23:50:32', '2025-01-21 23:50:32'),
(178, 85, '50 ml', 943.00, NULL, '2025-01-21 23:51:42', '2025-01-21 23:51:42'),
(182, 87, '100 ml', 663.00, NULL, '2025-01-22 00:06:21', '2025-01-22 00:06:21'),
(184, 88, '100 ml', 663.00, NULL, '2025-01-22 00:08:13', '2025-01-22 00:08:13'),
(185, 89, '100 ml', 663.00, NULL, '2025-01-22 00:09:45', '2025-01-22 00:09:45'),
(186, 90, '100 ml', 663.00, NULL, '2025-01-22 00:11:14', '2025-01-22 00:11:14'),
(191, 93, '60 gr', 545.00, NULL, '2025-01-22 00:23:08', '2025-01-22 00:23:08'),
(192, 94, '200 g', 663.00, NULL, '2025-01-22 00:25:10', '2025-01-22 00:25:10'),
(193, 95, '200 g', 663.00, NULL, '2025-01-22 00:26:24', '2025-01-22 00:26:24'),
(195, 97, '60 ml', 0.00, NULL, '2025-01-22 00:31:54', '2025-01-22 00:31:54'),
(196, 98, '60 ml', 0.00, NULL, '2025-01-22 00:32:51', '2025-01-22 00:32:51'),
(197, 99, '60 ml', 0.00, NULL, '2025-01-22 00:33:34', '2025-01-22 00:33:34'),
(198, 100, 'Trousse Hammam', 621.00, NULL, '2025-01-22 00:36:52', '2025-01-22 00:36:52'),
(200, 101, 'Bordeaux', 1885.00, NULL, '2025-01-22 00:38:13', '2025-01-22 00:38:13'),
(201, 102, 'Blanc', 621.00, NULL, '2025-01-22 00:39:57', '2025-01-22 00:39:57'),
(202, 103, 'Blanc', 698.00, NULL, '2025-01-22 00:41:16', '2025-01-22 00:41:16'),
(203, 104, 'Sensorielle', 1648.00, NULL, '2025-01-22 00:42:08', '2025-01-22 00:42:08'),
(206, 107, '1', 1773.00, NULL, '2025-01-22 00:46:52', '2025-01-22 00:46:52'),
(207, 108, '1', 1676.00, NULL, '2025-01-22 00:48:39', '2025-01-22 00:48:39'),
(211, 109, '1', 0.00, NULL, '2025-01-22 00:50:05', '2025-01-22 00:50:05'),
(214, 112, '1', 0.00, NULL, '2025-01-22 00:52:36', '2025-01-22 00:52:36'),
(215, 113, '1', 0.00, NULL, '2025-01-22 00:53:16', '2025-01-22 00:53:16'),
(216, 111, 'Bordeaux', 0.00, NULL, '2025-01-22 00:53:24', '2025-01-22 00:53:24'),
(217, 96, '200 g', 663.00, NULL, '2025-01-22 00:53:42', '2025-01-22 00:53:42'),
(218, 92, '125 ml', 293.00, NULL, '2025-01-26 17:41:03', '2025-01-26 17:41:03'),
(219, 92, '1 litre', 0.00, NULL, '2025-01-26 17:41:03', '2025-01-26 17:41:03'),
(220, 91, '200 ml', 321.00, NULL, '2025-01-26 17:42:04', '2025-01-26 17:42:04'),
(221, 91, '1 L', 0.00, NULL, '2025-01-26 17:42:04', '2025-01-26 17:42:04'),
(222, 61, '250 ml', 304.00, NULL, '2025-01-26 17:45:32', '2025-01-26 17:45:32'),
(223, 61, '2.3 litre', 0.00, NULL, '2025-01-26 17:45:32', '2025-01-26 17:45:32'),
(224, 60, '250 ml', 342.00, NULL, '2025-01-26 17:46:23', '2025-01-26 17:46:23'),
(225, 60, '2,3 litre', 0.00, NULL, '2025-01-26 17:46:23', '2025-01-26 17:46:23'),
(226, 69, '250 ml', 314.00, NULL, '2025-01-26 17:46:52', '2025-01-26 17:46:52'),
(227, 69, '3,8 litre', 0.00, NULL, '2025-01-26 17:46:52', '2025-01-26 17:46:52'),
(228, 62, '250 ml', 342.00, NULL, '2025-01-26 17:47:34', '2025-01-26 17:47:34'),
(229, 62, '2.5 litre', 0.00, NULL, '2025-01-26 17:47:34', '2025-01-26 17:47:34'),
(230, 86, '20 ml', 2709.00, NULL, '2025-01-26 17:52:03', '2025-01-26 17:52:03'),
(231, 106, 'U', 1641.00, NULL, '2025-01-26 17:53:31', '2025-01-26 17:53:31'),
(232, 110, 'Bordeaux', 2443.00, NULL, '2025-01-26 17:56:09', '2025-01-26 17:56:09'),
(236, 115, 'Grand modèle', 908.00, NULL, '2025-01-26 18:08:10', '2025-01-26 18:08:10'),
(237, 116, '1', 175.00, NULL, '2025-01-26 18:10:57', '2025-01-26 18:10:57'),
(238, 117, '1', 175.00, NULL, '2025-01-26 18:11:59', '2025-01-26 18:11:59'),
(239, 118, '1', 175.00, NULL, '2025-01-26 18:12:47', '2025-01-26 18:12:47'),
(240, 119, '1', 175.00, NULL, '2025-01-26 18:13:26', '2025-01-26 18:13:26'),
(241, 120, '1', 175.00, NULL, '2025-01-26 18:14:04', '2025-01-26 18:14:04'),
(243, 121, '1', 175.00, NULL, '2025-01-26 18:15:27', '2025-01-26 18:15:27'),
(244, 122, '1', 175.00, NULL, '2025-01-26 18:16:24', '2025-01-26 18:16:24'),
(245, 123, '1', 175.00, NULL, '2025-01-26 18:17:15', '2025-01-26 18:17:15'),
(246, 124, '1', 873.00, NULL, '2025-01-26 18:19:11', '2025-01-26 18:19:11'),
(247, 125, '30x30', 314.00, NULL, '2025-01-26 20:26:08', '2025-01-26 20:26:08');

-- --------------------------------------------------------

--
-- Structure de la table `promotions`
--

CREATE TABLE `promotions` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `product_id` bigint(20) UNSIGNED NOT NULL,
  `old_price` decimal(10,2) NOT NULL,
  `percentage` decimal(5,2) NOT NULL,
  `new_price` decimal(10,2) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Structure de la table `purchasedetails`
--

CREATE TABLE `purchasedetails` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `purchase_id` bigint(20) UNSIGNED NOT NULL,
  `product_id` bigint(20) UNSIGNED NOT NULL,
  `product_unit_id` bigint(20) UNSIGNED NOT NULL,
  `quantity` int(11) NOT NULL,
  `unit_price` decimal(10,2) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Structure de la table `purchases`
--

CREATE TABLE `purchases` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `fournisseur_id` bigint(20) UNSIGNED NOT NULL,
  `warehouse_id` bigint(20) UNSIGNED NOT NULL,
  `purchase_date` timestamp NOT NULL DEFAULT current_timestamp(),
  `payment_status` enum('unpaid','partial','paid') NOT NULL DEFAULT 'unpaid',
  `amount_to_pay` decimal(10,2) NOT NULL DEFAULT 0.00,
  `reduction` decimal(10,2) NOT NULL DEFAULT 0.00,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Structure de la table `purchase_payments`
--

CREATE TABLE `purchase_payments` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `purchase_id` bigint(20) UNSIGNED NOT NULL,
  `amount` decimal(15,2) NOT NULL,
  `payment_method` varchar(255) DEFAULT NULL,
  `transaction_reference` varchar(255) DEFAULT NULL,
  `payment_date` date NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Structure de la table `sessions`
--

CREATE TABLE `sessions` (
  `id` varchar(255) NOT NULL,
  `user_id` bigint(20) UNSIGNED DEFAULT NULL,
  `ip_address` varchar(45) DEFAULT NULL,
  `user_agent` text DEFAULT NULL,
  `payload` longtext NOT NULL,
  `last_activity` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Déchargement des données de la table `sessions`
--

INSERT INTO `sessions` (`id`, `user_id`, `ip_address`, `user_agent`, `payload`, `last_activity`) VALUES
('aSGzpKZSHY8GHvGaXlaoCHaY1mftWZDIqJ28pK43', NULL, '196.121.86.45', 'WhatsApp/2.2504.1 W', 'YTozOntzOjY6Il90b2tlbiI7czo0MDoiSkVOMXNwUnJVelNWYWlWeWdjc084NlNwT05ZZmZ2RUFTYTdUSG9USiI7czo5OiJfcHJldmlvdXMiO2E6MTp7czozOiJ1cmwiO3M6Mjk6Imh0dHBzOi8vdHV0by50aXl5YS5tci9mci9ob21lIjt9czo2OiJfZmxhc2giO2E6Mjp7czozOiJvbGQiO2E6MDp7fXM6MzoibmV3IjthOjA6e319fQ==', 1737985277),
('bg5LQUxZad7zvml5X26BPnFn1M5QU9HvrTkcTc7z', NULL, '196.121.86.45', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/131.0.0.0 Safari/537.36', 'YToyOntzOjY6Il90b2tlbiI7czo0MDoiVDM5Q2k2b2NNdU10VWxjODExamJYU1ltdDFhNHhKME5sYUpqYlJwMyI7czo2OiJfZmxhc2giO2E6Mjp7czozOiJvbGQiO2E6MDp7fXM6MzoibmV3IjthOjA6e319fQ==', 1738008607),
('BqkqyQP8pSPGenJTiYbd7Og0cMWUTn5LFIn4gMSX', NULL, '197.230.59.5', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/131.0.0.0 Safari/537.36', 'YTozOntzOjY6Il90b2tlbiI7czo0MDoidmQ2NmROQVZTZlBFSE0zc2ZWYTJmTG16Q2lPcllJcVJUZXdQRktOYyI7czo5OiJfcHJldmlvdXMiO2E6MTp7czozOiJ1cmwiO3M6MzA6Imh0dHBzOi8vdHV0by50aXl5YS5tci9mci9sb2dpbiI7fXM6NjoiX2ZsYXNoIjthOjI6e3M6Mzoib2xkIjthOjA6e31zOjM6Im5ldyI7YTowOnt9fX0=', 1737985055),
('ctcF1Ku4lzdOmcdA5ONuYi4yi9NaHQckAQWQCeBT', NULL, '185.248.85.16', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/110.0.0.0 Safari/537.36', 'YTozOntzOjY6Il90b2tlbiI7czo0MDoiUUxTVnp1ZEtraTB3bmdnR3hWNjBMOHlpV0tkRzRQaUcwd1hqTkFzQyI7czo5OiJfcHJldmlvdXMiO2E6MTp7czozOiJ1cmwiO3M6Mjk6Imh0dHBzOi8vdHV0by50aXl5YS5tci9mci9ob21lIjt9czo2OiJfZmxhc2giO2E6Mjp7czozOiJvbGQiO2E6MDp7fXM6MzoibmV3IjthOjA6e319fQ==', 1737987769),
('NIlnSNs6RPabVaVPKiiqNKyIfAhwIKCcDyVnLB9z', NULL, '196.121.86.45', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/131.0.0.0 Safari/537.36', 'YToyOntzOjY6Il90b2tlbiI7czo0MDoiT0U2UVpRZ1dYODJ4dnVsbGlYQ25QU3Z1TEZPWUREYkE5M3ZHbnQ0YyI7czo2OiJfZmxhc2giO2E6Mjp7czozOiJvbGQiO2E6MDp7fXM6MzoibmV3IjthOjA6e319fQ==', 1737985701),
('skM9AkSxkYFova5Ou35tFv22qwkxWu77DJFb2nz0', NULL, '196.121.86.45', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/131.0.0.0 Safari/537.36', 'YTozOntzOjY6Il90b2tlbiI7czo0MDoiYWpYODVFMzhab0JOVWFkU215UG9ubVp1SGNROHRpSXB1R0tDdnZtVyI7czo5OiJfcHJldmlvdXMiO2E6MTp7czozOiJ1cmwiO3M6Mjk6Imh0dHBzOi8vdHV0by50aXl5YS5tci9mci9ob21lIjt9czo2OiJfZmxhc2giO2E6Mjp7czozOiJvbGQiO2E6MDp7fXM6MzoibmV3IjthOjA6e319fQ==', 1737993787),
('xApYrO0cB5668GQaJrCk2bCzdHMuaI7Gwbau5eDg', NULL, '196.121.86.45', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/131.0.0.0 Safari/537.36', 'YTozOntzOjY6Il90b2tlbiI7czo0MDoiQ1FBeXZqQUtBNWpLMWhXMFdkR3NzUzhieXY4ZTExdjdXMG1jTk1MWSI7czo5OiJfcHJldmlvdXMiO2E6MTp7czozOiJ1cmwiO3M6MzM6Imh0dHBzOi8vdHV0by50aXl5YS5tci91c2VyL2xvZ291dCI7fXM6NjoiX2ZsYXNoIjthOjI6e3M6Mzoib2xkIjthOjA6e31zOjM6Im5ldyI7YTowOnt9fX0=', 1737985700);

-- --------------------------------------------------------

--
-- Structure de la table `users`
--

CREATE TABLE `users` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `name` varchar(255) NOT NULL,
  `email` varchar(255) NOT NULL,
  `phone` varchar(255) DEFAULT NULL,
  `address` varchar(255) DEFAULT NULL,
  `usertype` varchar(255) NOT NULL DEFAULT '0',
  `email_verified_at` timestamp NOT NULL DEFAULT current_timestamp(),
  `password` varchar(255) NOT NULL,
  `two_factor_secret` text DEFAULT NULL,
  `two_factor_recovery_codes` text DEFAULT NULL,
  `two_factor_confirmed_at` timestamp NULL DEFAULT NULL,
  `remember_token` varchar(100) DEFAULT NULL,
  `current_team_id` bigint(20) UNSIGNED DEFAULT NULL,
  `profile_photo_path` varchar(2048) DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Déchargement des données de la table `users`
--

INSERT INTO `users` (`id`, `name`, `email`, `phone`, `address`, `usertype`, `email_verified_at`, `password`, `two_factor_secret`, `two_factor_recovery_codes`, `two_factor_confirmed_at`, `remember_token`, `current_team_id`, `profile_photo_path`, `created_at`, `updated_at`) VALUES
(1, 'admin', 'admin@tiyya.mr', '0600000000', 'admin admin h', '1', '2024-12-12 12:48:28', '$2y$10$ATXVQevSFIZ9HOK1Qee6V.r3G.ovUCxjSxHNihWIh3vGnkEpLcx3W', NULL, NULL, NULL, NULL, NULL, NULL, '2024-12-12 11:48:28', '2025-01-21 20:28:28');

-- --------------------------------------------------------

--
-- Structure de la table `user_roles`
--

CREATE TABLE `user_roles` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `user_id` bigint(20) UNSIGNED NOT NULL,
  `manage_categories` tinyint(1) NOT NULL DEFAULT 0,
  `manage_products` tinyint(1) NOT NULL DEFAULT 0,
  `manage_users` tinyint(1) NOT NULL DEFAULT 0,
  `manage_orders` tinyint(1) NOT NULL DEFAULT 0,
  `manage_warehouses` tinyint(1) NOT NULL DEFAULT 0,
  `admin` tinyint(1) NOT NULL DEFAULT 0,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Déchargement des données de la table `user_roles`
--

INSERT INTO `user_roles` (`id`, `user_id`, `manage_categories`, `manage_products`, `manage_users`, `manage_orders`, `manage_warehouses`, `admin`, `created_at`, `updated_at`) VALUES
(1, 1, 1, 1, 1, 1, 1, 1, NULL, '2025-01-12 12:06:41');

-- --------------------------------------------------------

--
-- Structure de la table `warehouses`
--

CREATE TABLE `warehouses` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `name` varchar(255) NOT NULL,
  `location` varchar(255) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Déchargement des données de la table `warehouses`
--

INSERT INTO `warehouses` (`id`, `name`, `location`, `created_at`, `updated_at`) VALUES
(1, 'Tiyya Mauritanie', 'Local 1', '2024-12-12 13:04:33', '2025-01-27 00:13:02');

--
-- Index pour les tables déchargées
--

--
-- Index pour la table `astuces_beaute`
--
ALTER TABLE `astuces_beaute`
  ADD PRIMARY KEY (`id`);

--
-- Index pour la table `carts`
--
ALTER TABLE `carts`
  ADD PRIMARY KEY (`id`);

--
-- Index pour la table `categories`
--
ALTER TABLE `categories`
  ADD PRIMARY KEY (`id`);

--
-- Index pour la table `category_display`
--
ALTER TABLE `category_display`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `category_display_display_order_unique` (`display_order`),
  ADD KEY `category_display_category_id_foreign` (`category_id`);

--
-- Index pour la table `contacts`
--
ALTER TABLE `contacts`
  ADD PRIMARY KEY (`id`);

--
-- Index pour la table `failed_jobs`
--
ALTER TABLE `failed_jobs`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `failed_jobs_uuid_unique` (`uuid`);

--
-- Index pour la table `featured_products`
--
ALTER TABLE `featured_products`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `featured_products_display_order_unique` (`display_order`),
  ADD KEY `featured_products_product_id_foreign` (`product_id`);

--
-- Index pour la table `fournisseurs`
--
ALTER TABLE `fournisseurs`
  ADD PRIMARY KEY (`id`);

--
-- Index pour la table `homepage_settings`
--
ALTER TABLE `homepage_settings`
  ADD PRIMARY KEY (`id`);

--
-- Index pour la table `migrations`
--
ALTER TABLE `migrations`
  ADD PRIMARY KEY (`id`);

--
-- Index pour la table `orders`
--
ALTER TABLE `orders`
  ADD PRIMARY KEY (`id`);

--
-- Index pour la table `order_details`
--
ALTER TABLE `order_details`
  ADD PRIMARY KEY (`id`),
  ADD KEY `order_details_order_id_foreign` (`order_id`);

--
-- Index pour la table `password_reset_tokens`
--
ALTER TABLE `password_reset_tokens`
  ADD PRIMARY KEY (`email`);

--
-- Index pour la table `personal_access_tokens`
--
ALTER TABLE `personal_access_tokens`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `personal_access_tokens_token_unique` (`token`),
  ADD KEY `personal_access_tokens_tokenable_type_tokenable_id_index` (`tokenable_type`,`tokenable_id`);

--
-- Index pour la table `products`
--
ALTER TABLE `products`
  ADD PRIMARY KEY (`id`),
  ADD KEY `products_warehouse_id_foreign` (`warehouse_id`);

--
-- Index pour la table `product_images`
--
ALTER TABLE `product_images`
  ADD PRIMARY KEY (`id`),
  ADD KEY `product_images_product_id_foreign` (`product_id`);

--
-- Index pour la table `product_units`
--
ALTER TABLE `product_units`
  ADD PRIMARY KEY (`id`),
  ADD KEY `product_units_product_id_foreign` (`product_id`);

--
-- Index pour la table `promotions`
--
ALTER TABLE `promotions`
  ADD PRIMARY KEY (`id`),
  ADD KEY `promotions_product_id_foreign` (`product_id`);

--
-- Index pour la table `purchasedetails`
--
ALTER TABLE `purchasedetails`
  ADD PRIMARY KEY (`id`),
  ADD KEY `purchasedetails_purchase_id_foreign` (`purchase_id`),
  ADD KEY `purchasedetails_product_id_foreign` (`product_id`),
  ADD KEY `purchasedetails_product_unit_id_foreign` (`product_unit_id`);

--
-- Index pour la table `purchases`
--
ALTER TABLE `purchases`
  ADD PRIMARY KEY (`id`),
  ADD KEY `purchases_fournisseur_id_foreign` (`fournisseur_id`),
  ADD KEY `purchases_warehouse_id_foreign` (`warehouse_id`);

--
-- Index pour la table `purchase_payments`
--
ALTER TABLE `purchase_payments`
  ADD PRIMARY KEY (`id`),
  ADD KEY `purchase_payments_purchase_id_foreign` (`purchase_id`);

--
-- Index pour la table `sessions`
--
ALTER TABLE `sessions`
  ADD PRIMARY KEY (`id`),
  ADD KEY `sessions_user_id_index` (`user_id`),
  ADD KEY `sessions_last_activity_index` (`last_activity`);

--
-- Index pour la table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `users_email_unique` (`email`);

--
-- Index pour la table `user_roles`
--
ALTER TABLE `user_roles`
  ADD PRIMARY KEY (`id`),
  ADD KEY `user_roles_user_id_foreign` (`user_id`);

--
-- Index pour la table `warehouses`
--
ALTER TABLE `warehouses`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT pour les tables déchargées
--

--
-- AUTO_INCREMENT pour la table `astuces_beaute`
--
ALTER TABLE `astuces_beaute`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT pour la table `carts`
--
ALTER TABLE `carts`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=249;

--
-- AUTO_INCREMENT pour la table `categories`
--
ALTER TABLE `categories`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=26;

--
-- AUTO_INCREMENT pour la table `category_display`
--
ALTER TABLE `category_display`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT pour la table `contacts`
--
ALTER TABLE `contacts`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT pour la table `failed_jobs`
--
ALTER TABLE `failed_jobs`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT pour la table `featured_products`
--
ALTER TABLE `featured_products`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT pour la table `fournisseurs`
--
ALTER TABLE `fournisseurs`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT pour la table `homepage_settings`
--
ALTER TABLE `homepage_settings`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT pour la table `migrations`
--
ALTER TABLE `migrations`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=41;

--
-- AUTO_INCREMENT pour la table `orders`
--
ALTER TABLE `orders`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=76;

--
-- AUTO_INCREMENT pour la table `order_details`
--
ALTER TABLE `order_details`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=69;

--
-- AUTO_INCREMENT pour la table `personal_access_tokens`
--
ALTER TABLE `personal_access_tokens`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT pour la table `products`
--
ALTER TABLE `products`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=126;

--
-- AUTO_INCREMENT pour la table `product_images`
--
ALTER TABLE `product_images`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=222;

--
-- AUTO_INCREMENT pour la table `product_units`
--
ALTER TABLE `product_units`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=248;

--
-- AUTO_INCREMENT pour la table `promotions`
--
ALTER TABLE `promotions`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT pour la table `purchasedetails`
--
ALTER TABLE `purchasedetails`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=78;

--
-- AUTO_INCREMENT pour la table `purchases`
--
ALTER TABLE `purchases`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=44;

--
-- AUTO_INCREMENT pour la table `purchase_payments`
--
ALTER TABLE `purchase_payments`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=29;

--
-- AUTO_INCREMENT pour la table `users`
--
ALTER TABLE `users`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=18;

--
-- AUTO_INCREMENT pour la table `user_roles`
--
ALTER TABLE `user_roles`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=17;

--
-- AUTO_INCREMENT pour la table `warehouses`
--
ALTER TABLE `warehouses`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- Contraintes pour les tables déchargées
--

--
-- Contraintes pour la table `category_display`
--
ALTER TABLE `category_display`
  ADD CONSTRAINT `category_display_category_id_foreign` FOREIGN KEY (`category_id`) REFERENCES `categories` (`id`) ON DELETE CASCADE;

--
-- Contraintes pour la table `featured_products`
--
ALTER TABLE `featured_products`
  ADD CONSTRAINT `featured_products_product_id_foreign` FOREIGN KEY (`product_id`) REFERENCES `products` (`id`) ON DELETE CASCADE;

--
-- Contraintes pour la table `order_details`
--
ALTER TABLE `order_details`
  ADD CONSTRAINT `order_details_order_id_foreign` FOREIGN KEY (`order_id`) REFERENCES `orders` (`id`) ON DELETE CASCADE;

--
-- Contraintes pour la table `products`
--
ALTER TABLE `products`
  ADD CONSTRAINT `products_warehouse_id_foreign` FOREIGN KEY (`warehouse_id`) REFERENCES `warehouses` (`id`) ON DELETE CASCADE;

--
-- Contraintes pour la table `product_images`
--
ALTER TABLE `product_images`
  ADD CONSTRAINT `product_images_product_id_foreign` FOREIGN KEY (`product_id`) REFERENCES `products` (`id`) ON DELETE CASCADE;

--
-- Contraintes pour la table `product_units`
--
ALTER TABLE `product_units`
  ADD CONSTRAINT `product_units_product_id_foreign` FOREIGN KEY (`product_id`) REFERENCES `products` (`id`) ON DELETE CASCADE;

--
-- Contraintes pour la table `promotions`
--
ALTER TABLE `promotions`
  ADD CONSTRAINT `promotions_product_id_foreign` FOREIGN KEY (`product_id`) REFERENCES `products` (`id`) ON DELETE CASCADE;

--
-- Contraintes pour la table `purchasedetails`
--
ALTER TABLE `purchasedetails`
  ADD CONSTRAINT `purchasedetails_product_id_foreign` FOREIGN KEY (`product_id`) REFERENCES `products` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `purchasedetails_product_unit_id_foreign` FOREIGN KEY (`product_unit_id`) REFERENCES `product_units` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `purchasedetails_purchase_id_foreign` FOREIGN KEY (`purchase_id`) REFERENCES `purchases` (`id`) ON DELETE CASCADE;

--
-- Contraintes pour la table `purchases`
--
ALTER TABLE `purchases`
  ADD CONSTRAINT `purchases_fournisseur_id_foreign` FOREIGN KEY (`fournisseur_id`) REFERENCES `fournisseurs` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `purchases_warehouse_id_foreign` FOREIGN KEY (`warehouse_id`) REFERENCES `warehouses` (`id`) ON DELETE CASCADE;

--
-- Contraintes pour la table `purchase_payments`
--
ALTER TABLE `purchase_payments`
  ADD CONSTRAINT `purchase_payments_purchase_id_foreign` FOREIGN KEY (`purchase_id`) REFERENCES `purchases` (`id`) ON DELETE CASCADE;

--
-- Contraintes pour la table `user_roles`
--
ALTER TABLE `user_roles`
  ADD CONSTRAINT `user_roles_user_id_foreign` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`) ON DELETE CASCADE;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
