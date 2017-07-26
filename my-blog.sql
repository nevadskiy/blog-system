-- phpMyAdmin SQL Dump
-- version 4.6.5.2
-- https://www.phpmyadmin.net/
--
-- Хост: 127.0.0.1:3306
-- Час створення: Лип 26 2017 р., 16:56
-- Версія сервера: 5.5.53
-- Версія PHP: 7.1.0

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- База даних: `my-blog`
--

-- --------------------------------------------------------

--
-- Структура таблиці `bugs`
--

CREATE TABLE `bugs` (
  `id` int(10) UNSIGNED NOT NULL,
  `name` varchar(255) NOT NULL,
  `done_status` tinyint(1) DEFAULT '0'
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Дамп даних таблиці `bugs`
--

INSERT INTO `bugs` (`id`, `name`, `done_status`) VALUES
(11, 'Dont let user gets username with spaces and !@#!@$', 1),
(12, 'Change flashMessage for something better', 1),
(14, 'Finish createPost action', 1),
(15, 'Создать экшен \"мой профиль\"', 1),
(16, 'Set titles for pages', 0),
(17, 'fix field names for validator inputs', 1),
(18, 'Full Refactor class Validator', 1),
(19, 'Category must exists in categories table', 1),
(20, 'Fix register view', 1),
(22, 'fix short content saving \'...\'', 1),
(23, 'Fix data format in posts', 1),
(25, 'rewrite adminpanel view', 1),
(26, 'createpost method PREVIEW image for post', 1),
(27, 'fix footer view', 1),
(28, 'Fix post create action errors', 1),
(30, 'if isnt found article with url id then 404 error', 0),
(31, 'categories controll action', 1),
(32, 'fix profile button click outline effect', 1),
(33, 'Add info about max post image file size', 1),
(34, 'add function VIEWS on index action at posts', 1),
(36, 'Fix dates at posts and comments to \'1 day ago\' or 9 Jule', 1),
(38, 'fix description in create post method', 0),
(39, 'fix selected category after error in edit and create post action', 1),
(41, 'add SEARCH', 0),
(42, 'all users list with cont off comments and pubs', 1),
(44, 'notification button', 1),
(45, 'main template function to main controller', 1),
(46, 'last activity string to user profile', 1),
(47, 'favs on single post page', 1);

-- --------------------------------------------------------

--
-- Структура таблиці `categories`
--

CREATE TABLE `categories` (
  `id` int(11) UNSIGNED NOT NULL,
  `name` varchar(45) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Дамп даних таблиці `categories`
--

INSERT INTO `categories` (`id`, `name`) VALUES
(1, 'IT'),
(2, 'Cars'),
(3, 'Food'),
(4, 'Design');

-- --------------------------------------------------------

--
-- Структура таблиці `comments`
--

CREATE TABLE `comments` (
  `id` int(11) UNSIGNED NOT NULL,
  `post_id` int(11) UNSIGNED NOT NULL,
  `author_id` int(11) UNSIGNED NOT NULL,
  `body` text NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Дамп даних таблиці `comments`
--

INSERT INTO `comments` (`id`, `post_id`, `author_id`, `body`, `created_at`) VALUES
(1, 24, 42, 'Парень молодец!', '2017-07-26 13:14:15');

-- --------------------------------------------------------

--
-- Структура таблиці `fav_posts`
--

CREATE TABLE `fav_posts` (
  `id` int(11) UNSIGNED NOT NULL,
  `post_id` int(11) UNSIGNED NOT NULL,
  `user_id` int(11) UNSIGNED NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Дамп даних таблиці `fav_posts`
--

INSERT INTO `fav_posts` (`id`, `post_id`, `user_id`) VALUES
(1, 24, 42);

-- --------------------------------------------------------

--
-- Структура таблиці `password_tokens`
--

CREATE TABLE `password_tokens` (
  `id` int(11) UNSIGNED NOT NULL,
  `token` varchar(64) NOT NULL,
  `user_id` int(11) UNSIGNED NOT NULL,
  `expire` datetime NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Структура таблиці `posts`
--

CREATE TABLE `posts` (
  `id` int(11) UNSIGNED NOT NULL,
  `title` varchar(255) NOT NULL,
  `content` text,
  `description` varchar(255) NOT NULL,
  `post_image` varchar(150) DEFAULT NULL,
  `category_id` int(11) UNSIGNED DEFAULT NULL,
  `views_count` int(11) UNSIGNED DEFAULT '0',
  `author_id` int(11) UNSIGNED DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `created_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Дамп даних таблиці `posts`
--

INSERT INTO `posts` (`id`, `title`, `content`, `description`, `post_image`, `category_id`, `views_count`, `author_id`, `updated_at`, `created_at`) VALUES
(24, 'Junior, который в первый день работы удалил базу данных с production', '<p>Опубликованная 10 дней назад заметка собрала более 23 тысяч положительных голосов на Reddit и разошлась по другим специализированным ресурсам вроде&nbsp;<a href=\"https://thenewstack.io/junior-dev-deleted-production-database/\">The New Stack</a>. Суть истории такова:</p>\r\n<blockquote>\r\n<p>Сегодня был мой первый день на работе в роли младшего разработчика программного обеспечения (Junior Software Developer) и моя первая позиция после университета, не являющаяся стажировкой. К сожалению, я сильно напортачил.<br /><br />Мне дали документ с информацией о том, как настроить локальное окружение для разработки. Инструкции включают запуск маленького скрипта для создания личной копии БД с тестовыми данными. После запуска определённой команды я должен был скопировать URL/пароль/юзера базы данных из её вывода и настроить dev-окружение, указав там эту базу. К сожалению, вместо копирования данных нужной команды я по какой-то причине использовал значения из самого документа.<br /><br />К несчастью, оказалось, что указанные там значения &mdash; от базы данных в production (не знаю, почему они задокументированы в инструкции по настройке dev-окружения). Далее, как понимаю, тесты добавили ненастоящие данные и очистили существующие, то есть между запусками тестов все данные из БД в production были удалены. Честное слово, не имел представления, что я сделал, а чтобы это выяснить/осознать, кому-то из коллег потребовалось даже не полчаса.<br /><br />Когда начало проясняться, что же на самом деле произошло, технический директор сказал мне покинуть работу и больше не возвращаться. Он также сообщил, что из-за важности потерянных данных к делу подключат юристов. Я просил и умолял позволить мне как-то помочь реабилитироваться, однако ответом мне было, что я &laquo;полностью всё потерял&raquo;.</p>\r\n</blockquote>', 'Опубликованная 10 дней назад заметка собрала более 23 тысяч положительных голосов на Reddit и разошлась по другим специализированным ресурс...', 'public/img/posts/d16042133833e7830ce5aebbcebc7124.jpeg', 1, 52, 42, NULL, '2017-07-26 13:13:52');

-- --------------------------------------------------------

--
-- Структура таблиці `roles`
--

CREATE TABLE `roles` (
  `id` int(11) UNSIGNED NOT NULL,
  `role_name` varchar(45) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Дамп даних таблиці `roles`
--

INSERT INTO `roles` (`id`, `role_name`) VALUES
(1, 'User'),
(2, 'Admin');

-- --------------------------------------------------------

--
-- Структура таблиці `tags`
--

CREATE TABLE `tags` (
  `id` int(11) UNSIGNED NOT NULL,
  `name` varchar(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Структура таблиці `users`
--

CREATE TABLE `users` (
  `id` int(11) UNSIGNED NOT NULL,
  `username` varchar(50) NOT NULL,
  `password` varchar(255) NOT NULL,
  `salt` varchar(64) NOT NULL,
  `role_id` int(11) UNSIGNED NOT NULL DEFAULT '1',
  `created_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `del_flag` tinyint(1) UNSIGNED NOT NULL DEFAULT '0'
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Дамп даних таблиці `users`
--

INSERT INTO `users` (`id`, `username`, `password`, `salt`, `role_id`, `created_at`, `del_flag`) VALUES
(42, 'nevada', '240881fcc20079790cdade447d7708b35ba151a9e7b76e92774836793c73b719', '43e84d1b22560dd1101032e7fe3e2a3ed1ff1b303324cc0dfdde98234eb7ab61', 1, '2017-07-26 13:09:55', 0);

-- --------------------------------------------------------

--
-- Структура таблиці `users_profiles`
--

CREATE TABLE `users_profiles` (
  `user_id` int(11) UNSIGNED NOT NULL,
  `email` varchar(50) DEFAULT NULL,
  `first_name` varchar(50) DEFAULT NULL,
  `last_name` varchar(50) DEFAULT NULL,
  `birth_day` date DEFAULT NULL,
  `city` varchar(50) DEFAULT NULL,
  `avatar` varchar(255) NOT NULL,
  `last_activity` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Дамп даних таблиці `users_profiles`
--

INSERT INTO `users_profiles` (`user_id`, `email`, `first_name`, `last_name`, `birth_day`, `city`, `avatar`, `last_activity`) VALUES
(42, 'kalaidavitalii@gmail.com', 'Виталий', 'Калайда', '1996-02-08', 'Ужгород', 'public/img/avatars/c70e80548531d28a258390a5eb31e205.jpg', '2017-07-26 13:38:29');

-- --------------------------------------------------------

--
-- Структура таблиці `users_sessions`
--

CREATE TABLE `users_sessions` (
  `id` int(11) NOT NULL,
  `user_id` int(11) NOT NULL,
  `hash` varchar(64) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Індекси збережених таблиць
--

--
-- Індекси таблиці `bugs`
--
ALTER TABLE `bugs`
  ADD PRIMARY KEY (`id`);

--
-- Індекси таблиці `categories`
--
ALTER TABLE `categories`
  ADD PRIMARY KEY (`id`);

--
-- Індекси таблиці `comments`
--
ALTER TABLE `comments`
  ADD PRIMARY KEY (`id`),
  ADD KEY `comments_ibfk_2` (`author_id`),
  ADD KEY `comments_ibfk_1` (`post_id`);

--
-- Індекси таблиці `fav_posts`
--
ALTER TABLE `fav_posts`
  ADD PRIMARY KEY (`id`),
  ADD KEY `post_id` (`post_id`),
  ADD KEY `user_id` (`user_id`);

--
-- Індекси таблиці `password_tokens`
--
ALTER TABLE `password_tokens`
  ADD PRIMARY KEY (`id`);

--
-- Індекси таблиці `posts`
--
ALTER TABLE `posts`
  ADD PRIMARY KEY (`id`),
  ADD KEY `author_id` (`author_id`),
  ADD KEY `category_id` (`category_id`);

--
-- Індекси таблиці `roles`
--
ALTER TABLE `roles`
  ADD PRIMARY KEY (`id`);

--
-- Індекси таблиці `tags`
--
ALTER TABLE `tags`
  ADD PRIMARY KEY (`id`);

--
-- Індекси таблиці `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `username` (`username`),
  ADD KEY `role_id` (`role_id`);

--
-- Індекси таблиці `users_profiles`
--
ALTER TABLE `users_profiles`
  ADD PRIMARY KEY (`user_id`);

--
-- Індекси таблиці `users_sessions`
--
ALTER TABLE `users_sessions`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `hash` (`hash`),
  ADD UNIQUE KEY `user_id` (`user_id`);

--
-- AUTO_INCREMENT для збережених таблиць
--

--
-- AUTO_INCREMENT для таблиці `bugs`
--
ALTER TABLE `bugs`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=48;
--
-- AUTO_INCREMENT для таблиці `categories`
--
ALTER TABLE `categories`
  MODIFY `id` int(11) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;
--
-- AUTO_INCREMENT для таблиці `comments`
--
ALTER TABLE `comments`
  MODIFY `id` int(11) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;
--
-- AUTO_INCREMENT для таблиці `fav_posts`
--
ALTER TABLE `fav_posts`
  MODIFY `id` int(11) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;
--
-- AUTO_INCREMENT для таблиці `password_tokens`
--
ALTER TABLE `password_tokens`
  MODIFY `id` int(11) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=38;
--
-- AUTO_INCREMENT для таблиці `posts`
--
ALTER TABLE `posts`
  MODIFY `id` int(11) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=25;
--
-- AUTO_INCREMENT для таблиці `roles`
--
ALTER TABLE `roles`
  MODIFY `id` int(11) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;
--
-- AUTO_INCREMENT для таблиці `tags`
--
ALTER TABLE `tags`
  MODIFY `id` int(11) UNSIGNED NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT для таблиці `users`
--
ALTER TABLE `users`
  MODIFY `id` int(11) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=43;
--
-- AUTO_INCREMENT для таблиці `users_sessions`
--
ALTER TABLE `users_sessions`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;
--
-- Обмеження зовнішнього ключа збережених таблиць
--

--
-- Обмеження зовнішнього ключа таблиці `comments`
--
ALTER TABLE `comments`
  ADD CONSTRAINT `comments_ibfk_1` FOREIGN KEY (`post_id`) REFERENCES `posts` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `comments_ibfk_2` FOREIGN KEY (`author_id`) REFERENCES `users` (`id`);

--
-- Обмеження зовнішнього ключа таблиці `fav_posts`
--
ALTER TABLE `fav_posts`
  ADD CONSTRAINT `fav_posts_ibfk_1` FOREIGN KEY (`post_id`) REFERENCES `posts` (`id`),
  ADD CONSTRAINT `fav_posts_ibfk_2` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`);

--
-- Обмеження зовнішнього ключа таблиці `posts`
--
ALTER TABLE `posts`
  ADD CONSTRAINT `posts_ibfk_1` FOREIGN KEY (`author_id`) REFERENCES `users` (`id`),
  ADD CONSTRAINT `posts_ibfk_2` FOREIGN KEY (`category_id`) REFERENCES `categories` (`id`);

--
-- Обмеження зовнішнього ключа таблиці `users`
--
ALTER TABLE `users`
  ADD CONSTRAINT `users_ibfk_1` FOREIGN KEY (`role_id`) REFERENCES `roles` (`id`);

--
-- Обмеження зовнішнього ключа таблиці `users_profiles`
--
ALTER TABLE `users_profiles`
  ADD CONSTRAINT `users_profiles_ibfk_1` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`);

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
