-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Servidor: 127.0.0.1
-- Tiempo de generación: 07-10-2025 a las 23:43:30
-- Versión del servidor: 10.4.32-MariaDB
-- Versión de PHP: 8.0.30

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Base de datos: `bookhub`
--

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `failed_jobs`
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
-- Estructura de tabla para la tabla `libros`
--

CREATE TABLE `libros` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `titulo` varchar(255) NOT NULL,
  `autor` varchar(255) NOT NULL,
  `precio` decimal(8,2) NOT NULL,
  `descripcion` text DEFAULT NULL,
  `imagen` varchar(255) DEFAULT NULL,
  `categoria` varchar(255) DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Volcado de datos para la tabla `libros`
--

INSERT INTO `libros` (`id`, `titulo`, `autor`, `precio`, `descripcion`, `imagen`, `categoria`, `created_at`, `updated_at`) VALUES
(1, 'Sit inventore nulla laboriosam.', 'Alexandrea Brakus', 89.75, 'Eos voluptate aliquid sit ipsum. Delectus quaerat atque et.', 'https://placehold.co/600x900/1f1f1f/fff?text=Manga', 'Ficción', '2025-10-07 19:05:42', '2025-10-07 23:58:59'),
(2, 'Voluptas voluptas.', 'Rosemarie D\'Amore', 105.30, 'Corrupti dolores dolorum cumque maiores. Ut quos dolores quod.', 'https://placehold.co/600x900/1f1f1f/fff?text=Manga', 'Historia', '2025-10-07 19:05:42', '2025-10-07 23:58:59'),
(3, 'Error molestiae.', 'Dr. Amir Hammes', 34.66, 'Dolor quia minus consequatur omnis est repudiandae sit. Autem non architecto id doloribus iure qui. Deserunt aut placeat qui numquam.', 'https://placehold.co/600x900/1f1f1f/fff?text=Manga', 'No Ficción', '2025-10-07 19:05:42', '2025-10-07 23:58:59'),
(4, 'Similique ipsa velit.', 'Beryl Cruickshank', 141.23, 'Facere quia tenetur modi aspernatur est quia corporis. Quia harum soluta vel sunt quisquam. Ullam corrupti inventore est nam voluptas deleniti unde.', 'https://placehold.co/600x900/111/fff?text=Book+Cover', 'Historia', '2025-10-07 19:05:42', '2025-10-07 23:58:59'),
(5, 'Omnis ducimus laborum.', 'Delaney Abbott', 105.44, 'Illo qui natus impedit cupiditate et omnis voluptatem. Ullam velit aut laudantium adipisci rerum quo.', 'https://placehold.co/600x900/111/fff?text=Book+Cover', 'No Ficción', '2025-10-07 19:05:42', '2025-10-07 23:58:59'),
(6, 'Mollitia quo iste.', 'Noemie Hudson', 11.38, 'Repellat quibusdam tenetur et delectus velit est molestiae ut. Eum qui aperiam et ea est dolor eos.', 'https://placehold.co/600x900/111/fff?text=Book+Cover', 'No Ficción', '2025-10-07 19:05:42', '2025-10-07 23:58:59'),
(7, 'Pariatur voluptatem debitis.', 'Dr. Lavada Olson II', 23.86, 'Voluptates consectetur nulla quia deserunt deleniti neque nisi. Laborum quod et corporis quod optio sunt. Repudiandae vero perferendis alias voluptatum est aut autem.', 'https://placehold.co/600x900/222/fff?text=Libro', 'Ficción', '2025-10-07 19:05:42', '2025-10-07 23:58:59'),
(8, 'Temporibus id in.', 'Mr. Gilberto Pacocha V', 23.87, 'Quae nisi quia tempore velit mollitia. Minima explicabo qui quos nulla.', 'https://placehold.co/600x900/1f1f1f/fff?text=Manga', 'Historia', '2025-10-07 19:05:42', '2025-10-07 23:58:59'),
(9, 'Cupiditate dignissimos praesentium.', 'Prof. Jettie Stracke PhD', 69.04, 'Ut et et necessitatibus. Sit itaque dolore recusandae aut et.', 'https://placehold.co/600x900/222/fff?text=Libro', 'Historia', '2025-10-07 19:05:42', '2025-10-07 23:58:59'),
(10, 'Praesentium quia.', 'Kiarra Shanahan DVM', 91.44, 'Expedita accusamus quibusdam quaerat illum quo et. Accusantium velit qui natus saepe est magnam. Laborum sed quis consequatur odit et enim.', 'https://placehold.co/600x900/111/fff?text=Book+Cover', 'No Ficción', '2025-10-07 19:05:42', '2025-10-07 23:58:59'),
(11, 'Aut illum pariatur eius.', 'Jameson Hills', 87.01, 'Eligendi repudiandae culpa quam eius voluptas numquam eius. Officiis sint aut earum omnis sint vel. Quis cupiditate tenetur amet vitae asperiores perferendis.', 'https://placehold.co/600x900/222/fff?text=Libro', 'Tecnología', '2025-10-07 19:05:42', '2025-10-07 23:58:59'),
(12, 'Sed nisi in ea.', 'Frankie Denesik', 22.36, 'Magni similique ut id rerum laborum sint natus. Delectus ipsam et culpa.', 'https://placehold.co/600x900/1f1f1f/fff?text=Manga', 'Historia', '2025-10-07 19:05:42', '2025-10-07 23:58:59'),
(13, 'One Piece', 'Eiichiro Oda', 12.99, 'Aventuras piratas en busca del One Piece.', 'https://placehold.co/600x900/222/fff?text=Libro', 'Shonen', '2025-10-07 19:57:43', '2025-10-07 23:58:59'),
(14, 'Naruto', 'Masashi Kishimoto', 11.99, 'La historia del ninja Naruto Uzumaki.', 'https://placehold.co/600x900/222/fff?text=Libro', 'Shonen', '2025-10-07 19:57:43', '2025-10-07 23:58:59'),
(15, 'Bleach', 'Tite Kubo', 10.99, 'Shinigamis, hollows y batallas épicas.', 'https://placehold.co/600x900/111/fff?text=Book+Cover', 'Shonen', '2025-10-07 19:57:43', '2025-10-07 23:58:59'),
(16, 'Attack on Titan', 'Hajime Isayama', 12.99, 'Humanidad vs titanes tras las murallas.', 'https://placehold.co/600x900/111/fff?text=Book+Cover', 'Seinen', '2025-10-07 19:57:43', '2025-10-08 00:31:33'),
(17, 'Fullmetal Alchemist', 'Hiromu Arakawa', 13.50, 'Los hermanos Elric y la alquimia.', 'https://placehold.co/600x900/111/fff?text=Book+Cover', 'Shonen', '2025-10-07 19:57:43', '2025-10-07 23:58:59'),
(18, 'Death Note', 'Tsugumi Ohba / Takeshi Obata', 12.00, 'Un cuaderno que puede matar y un duelo intelectual.', 'https://placehold.co/600x900/1f1f1f/fff?text=Manga', 'Seinen', '2025-10-07 19:57:43', '2025-10-07 23:58:59'),
(19, 'Demon Slayer', 'Koyoharu Gotouge', 11.50, 'Cazadores de demonios en la era Taisho.', 'https://placehold.co/600x900/222/fff?text=Libro', 'Shonen', '2025-10-07 19:57:43', '2025-10-07 23:58:59'),
(20, 'Jujutsu Kaisen', 'Gege Akutami', 12.20, 'Hechicería y maldiciones modernas.', 'https://placehold.co/600x900/222/fff?text=Libro', 'Shonen', '2025-10-07 19:57:43', '2025-10-07 23:58:59'),
(21, 'Chainsaw Man', 'Tatsuki Fujimoto', 12.90, 'Denji y la brutalidad de los demonios.', 'https://placehold.co/600x900/111/fff?text=Book+Cover', 'Seinen', '2025-10-07 19:57:43', '2025-10-07 23:58:59'),
(22, 'My Hero Academia', 'Kohei Horikoshi', 11.75, 'Héroes y estudiantes con “quirks”.', 'https://placehold.co/600x900/1f1f1f/fff?text=Manga', 'Shonen', '2025-10-07 19:57:43', '2025-10-07 23:58:59'),
(23, 'Spy x Family', 'Tatsuya Endo', 10.90, 'Una familia peculiar: espía, asesina y telépata.', 'https://placehold.co/600x900/222/fff?text=Libro', 'Shonen', '2025-10-07 19:57:43', '2025-10-07 23:58:59'),
(24, 'Tokyo Ghoul', 'Sui Ishida', 12.40, 'Ghouls y dilemas entre humanos y monstruos.', 'Tokyo Ghoul', 'Seinen', '2025-10-07 19:57:43', '2025-10-08 00:13:13'),
(25, 'Slam Dunk', 'Takehiko Inoue', 9.99, 'Baloncesto escolar con mucha pasión.', 'https://placehold.co/600x900/222/fff?text=Libro', 'Deportes', '2025-10-07 19:57:43', '2025-10-07 23:58:59'),
(26, 'Monster', 'Naoki Urasawa', 13.50, 'Thriller psicológico de altísimo nivel.', 'https://placehold.co/600x900/1f1f1f/fff?text=Manga', 'Seinen', '2025-10-07 19:57:43', '2025-10-07 23:58:59'),
(27, 'Vagabond', 'Takehiko Inoue', 14.50, 'Miyamoto Musashi en un arte visual magnífico.', 'https://placehold.co/600x900/1f1f1f/fff?text=Manga', 'Seinen', '2025-10-07 19:57:43', '2025-10-07 23:58:59');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `migrations`
--

CREATE TABLE `migrations` (
  `id` int(10) UNSIGNED NOT NULL,
  `migration` varchar(255) NOT NULL,
  `batch` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Volcado de datos para la tabla `migrations`
--

INSERT INTO `migrations` (`id`, `migration`, `batch`) VALUES
(1, '2014_10_12_000000_create_users_table', 1),
(2, '2014_10_12_100000_create_password_resets_table', 1),
(3, '2019_08_19_000000_create_failed_jobs_table', 1),
(4, '2019_12_14_000001_create_personal_access_tokens_table', 1),
(5, '2025_10_07_152929_create_libros_table', 1),
(6, '2025_10_07_152959_create_noticias_table', 1),
(7, '2025_10_07_161445_add_is_admin_to_users_table', 2),
(8, '2025_10_07_170000_add_categoria_to_noticias_table', 3);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `noticias`
--

CREATE TABLE `noticias` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `titulo` varchar(255) NOT NULL,
  `contenido` text NOT NULL,
  `imagen` varchar(255) DEFAULT NULL,
  `categoria` varchar(255) DEFAULT NULL,
  `fecha` date NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Volcado de datos para la tabla `noticias`
--

INSERT INTO `noticias` (`id`, `titulo`, `contenido`, `imagen`, `categoria`, `fecha`, `created_at`, `updated_at`) VALUES
(1, 'Consequatur maiores itaque aliquid quia.', 'Aut minus nemo ad nam laudantium itaque distinctio. Alias eum minus eius odit asperiores aperiam rerum. Qui corporis nostrum totam eius dolorem pariatur quo.', 'https://placehold.co/1200x600/1f1f1f/fff?text=Noticia', NULL, '2025-09-01', '2025-10-07 19:05:42', '2025-10-07 23:59:00'),
(2, 'Aut hic qui et odit porro.', 'Velit quidem nam qui laboriosam sit tempore cum. Fugiat aliquam esse eveniet quos. Sit facilis voluptas quaerat qui reiciendis sed velit. Aliquid culpa recusandae delectus in eius nemo impedit tempora.', 'https://placehold.co/1200x600/222/fff?text=Anime+News', NULL, '2025-08-27', '2025-10-07 19:05:42', '2025-10-07 23:59:00'),
(3, 'Ut sit mollitia vero quas eos.', 'Dolor sint et laboriosam quo accusantium accusamus dolor commodi. Et quia commodi animi vel provident. Molestias hic veniam odit iste eos.', 'https://placehold.co/1200x600/1f1f1f/fff?text=Noticia', NULL, '2025-09-21', '2025-10-07 19:05:42', '2025-10-07 23:59:00'),
(4, 'Voluptate ea at et perferendis et vitae.', 'Iure ipsam ut culpa. Et incidunt culpa voluptas quasi. Illo libero totam et nam alias animi. Consequatur nihil quia et vitae assumenda est corporis.', 'https://placehold.co/1200x600/222/fff?text=Anime+News', NULL, '2025-09-10', '2025-10-07 19:05:42', '2025-10-07 23:59:00'),
(5, 'Saepe vitae earum labore impedit nam.', 'Ea minus ab dolorem quia modi et repudiandae a. Dolore quia officiis atque. Qui consequatur facilis minima esse minus beatae.', 'https://placehold.co/1200x600/111/fff?text=News+Banner', NULL, '2025-08-13', '2025-10-07 19:05:42', '2025-10-07 23:59:00'),
(6, 'Dignissimos suscipit magnam vel.', 'Ullam asperiores harum quas dicta et repudiandae. Assumenda vel quas veritatis ex. Repellat quam veritatis error. Molestias eveniet reiciendis dolorum qui aut.', 'https://placehold.co/1200x600/111/fff?text=News+Banner', NULL, '2025-08-08', '2025-10-07 19:05:42', '2025-10-07 23:59:00'),
(7, 'Nueva temporada de Jujutsu Kaisen anunciada', 'Se confirma la producción de una nueva temporada con adaptación del arco siguiente.', 'https://placehold.co/1200x600/111/fff?text=News+Banner', NULL, '2025-10-02', '2025-10-07 19:57:43', '2025-10-07 23:59:00'),
(8, 'Chainsaw Man revela artes del próximo volumen', 'Tatsuki Fujimoto comparte bocetos que muestran el tono del nuevo capítulo.', 'https://placehold.co/1200x600/111/fff?text=News+Banner', NULL, '2025-09-27', '2025-10-07 19:57:43', '2025-10-07 23:59:00'),
(9, 'One Piece alcanza un nuevo hito de ventas', 'La serie supera récords históricos en tiradas y lecturas globales.', 'https://placehold.co/1200x600/1f1f1f/fff?text=Noticia', NULL, '2025-09-22', '2025-10-07 19:57:43', '2025-10-07 23:59:00'),
(10, 'Anunciada película de Spy x Family', 'La familia Forger regresa a la gran pantalla con una historia original.', 'https://placehold.co/1200x600/222/fff?text=Anime+News', NULL, '2025-09-17', '2025-10-07 19:57:43', '2025-10-07 23:59:00'),
(11, 'Demon Slayer muestra trailer del arco siguiente', 'El nuevo avance destaca la animación y el desarrollo de personajes.', 'https://placehold.co/1200x600/1f1f1f/fff?text=Noticia', NULL, '2025-09-12', '2025-10-07 19:57:43', '2025-10-07 23:59:00'),
(12, 'Fullmetal Alchemist recibe nueva edición conmemorativa', 'Incluye arte adicional y comentarios de Hiromu Arakawa.', 'https://placehold.co/1200x600/1f1f1f/fff?text=Noticia', NULL, '2025-09-07', '2025-10-07 19:57:43', '2025-10-07 23:59:00');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `password_resets`
--

CREATE TABLE `password_resets` (
  `email` varchar(255) NOT NULL,
  `token` varchar(255) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `personal_access_tokens`
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
-- Estructura de tabla para la tabla `users`
--

CREATE TABLE `users` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `name` varchar(255) NOT NULL,
  `email` varchar(255) NOT NULL,
  `email_verified_at` timestamp NULL DEFAULT NULL,
  `password` varchar(255) NOT NULL,
  `is_admin` tinyint(1) NOT NULL DEFAULT 0,
  `remember_token` varchar(100) DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Volcado de datos para la tabla `users`
--

INSERT INTO `users` (`id`, `name`, `email`, `email_verified_at`, `password`, `is_admin`, `remember_token`, `created_at`, `updated_at`) VALUES
(1, 'Admin BookHub', 'admin@bookhub.test', NULL, '$2y$10$T/a5e1JUkLnv5j6zTP0cmeUZFuBphfHsmt.VJ1De6qouyXmWQ4g8W', 1, NULL, '2025-10-07 19:16:35', '2025-10-07 19:57:43'),
(2, 'Usuario BookHub', 'usuario@bookhub.test', NULL, '$2y$10$nqtaS85nx6IApJebAvFtYebP6ADu6uj13cwEVLn.JDxQ9rVtwEU4e', 0, NULL, '2025-10-07 19:16:36', '2025-10-07 19:57:43');

--
-- Índices para tablas volcadas
--

--
-- Indices de la tabla `failed_jobs`
--
ALTER TABLE `failed_jobs`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `failed_jobs_uuid_unique` (`uuid`);

--
-- Indices de la tabla `libros`
--
ALTER TABLE `libros`
  ADD PRIMARY KEY (`id`);

--
-- Indices de la tabla `migrations`
--
ALTER TABLE `migrations`
  ADD PRIMARY KEY (`id`);

--
-- Indices de la tabla `noticias`
--
ALTER TABLE `noticias`
  ADD PRIMARY KEY (`id`);

--
-- Indices de la tabla `password_resets`
--
ALTER TABLE `password_resets`
  ADD PRIMARY KEY (`email`);

--
-- Indices de la tabla `personal_access_tokens`
--
ALTER TABLE `personal_access_tokens`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `personal_access_tokens_token_unique` (`token`),
  ADD KEY `personal_access_tokens_tokenable_type_tokenable_id_index` (`tokenable_type`,`tokenable_id`);

--
-- Indices de la tabla `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `users_email_unique` (`email`);

--
-- AUTO_INCREMENT de las tablas volcadas
--

--
-- AUTO_INCREMENT de la tabla `failed_jobs`
--
ALTER TABLE `failed_jobs`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT de la tabla `libros`
--
ALTER TABLE `libros`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=28;

--
-- AUTO_INCREMENT de la tabla `migrations`
--
ALTER TABLE `migrations`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;

--
-- AUTO_INCREMENT de la tabla `noticias`
--
ALTER TABLE `noticias`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=13;

--
-- AUTO_INCREMENT de la tabla `personal_access_tokens`
--
ALTER TABLE `personal_access_tokens`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT de la tabla `users`
--
ALTER TABLE `users`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
