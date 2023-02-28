-- phpMyAdmin SQL Dump
-- version 5.2.0
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Czas generowania: 28 Lut 2023, 14:24
-- Wersja serwera: 10.4.25-MariaDB
-- Wersja PHP: 8.1.10

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Baza danych: `news_article_system`
--

-- --------------------------------------------------------

--
-- Struktura tabeli dla tabeli `article`
--

CREATE TABLE `article` (
  `id_article` int(11) NOT NULL,
  `id_author` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Struktura tabeli dla tabeli `article_content`
--

CREATE TABLE `article_content` (
  `id_article` int(11) NOT NULL,
  `article_title` varchar(75) NOT NULL,
  `article_content` blob NOT NULL,
  `creation_date` date NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Struktura tabeli dla tabeli `authors`
--

CREATE TABLE `authors` (
  `id_author` int(11) NOT NULL,
  `author_name` varchar(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Zrzut danych tabeli `authors`
--

INSERT INTO `authors` (`id_author`, `author_name`) VALUES
(1, 'Timothy Ferris'),
(2, 'Richard Feynman'),
(3, 'Daniel Kahneman'),
(4, 'Taleb Nassim Nicholas');

--
-- Indeksy dla zrzutów tabel
--

--
-- Indeksy dla tabeli `article_content`
--
ALTER TABLE `article_content`
  ADD PRIMARY KEY (`id_article`);

--
-- Indeksy dla tabeli `authors`
--
ALTER TABLE `authors`
  ADD PRIMARY KEY (`id_author`);

--
-- AUTO_INCREMENT dla zrzuconych tabel
--

--
-- AUTO_INCREMENT dla tabeli `article_content`
--
ALTER TABLE `article_content`
  MODIFY `id_article` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT dla tabeli `authors`
--
ALTER TABLE `authors`
  MODIFY `id_author` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
