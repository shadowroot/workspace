-- phpMyAdmin SQL Dump
-- version 3.3.9.2
-- http://www.phpmyadmin.net
--
-- Počítač: localhost
-- Vygenerováno: Čtvrtek 01. prosince 2011, 00:04
-- Verze MySQL: 5.5.10
-- Verze PHP: 5.3.6

SET SQL_MODE="NO_AUTO_VALUE_ON_ZERO";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8 */;

--
-- Databáze: `test`
--

-- --------------------------------------------------------

--
-- Struktura tabulky `orders`
--

CREATE TABLE IF NOT EXISTS `orders` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `jmeno` text COLLATE utf8_czech_ci NOT NULL,
  `prijmeni` text COLLATE utf8_czech_ci NOT NULL,
  `ulice` text COLLATE utf8_czech_ci NOT NULL,
  `mesto` text COLLATE utf8_czech_ci NOT NULL,
  `psc` varchar(255) COLLATE utf8_czech_ci NOT NULL,
  `email` text COLLATE utf8_czech_ci NOT NULL,
  `telefon` text COLLATE utf8_czech_ci NOT NULL,
  `sleva` text COLLATE utf8_czech_ci NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 COLLATE=utf8_czech_ci AUTO_INCREMENT=2 ;

--
-- Vypisuji data pro tabulku `orders`
--

INSERT INTO `orders` (`id`, `jmeno`, `prijmeni`, `ulice`, `mesto`, `psc`, `email`, `telefon`, `sleva`) VALUES
(1, 'jonny', 'shadow', 'nekde 1234', 'mesto ', '5454', 'shadowroot666@gmail.com', '165165', '55555');
