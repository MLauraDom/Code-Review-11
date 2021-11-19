SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


CREATE DATABASE IF NOT EXISTS `fswd14_cr11_petadoption_LauraMoldovan` DEFAULT CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci;
USE `fswd14_cr11_petadoption_LauraMoldovan`;


--
-- Tabellenstruktur für Tabelle `animals`
--
CREATE TABLE `animals` (
  `id` int(11) NOT NULL PRIMARY KEY AUTO_INCREMENT,
  `name` varchar(255) NOT NULL,
  `breed` varchar(50) NOT NULL,
  `size` varchar(50) NOT NULL,
  `location` varchar(255) NOT NULL,
  `description` varchar(255) NOT NULL,
  `hobby` varchar(50) NOT NULL,
  `age` INT NOT NULL,
  `picture` varchar(255) DEFAULT NULL,
  `status` boolean DEFAULT 1
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Daten für Tabelle `animals`
--

INSERT INTO `animals` VALUES
(1, 'Kitty', 'Cat', 'large', 'Burggasse 14', 'A beautiful brown female cat who is waiting to take her home.', 'Sleeping, eating, playing', 9, 'bigcat.jpg', true),
(2, 'Tom', 'Cat', 'small', 'Praterstrasse 23', 'A beautiful striped little male cat who is waiting to take him home.', 'Sleeping, eating, playing', 1, 'lilcat.jpg', false),
(3, 'Malty', 'Maltese Dog', 'large', 'Neustiftgasse 44', 'A beautiful white little female dog who is waiting to take her home.', 'Sleeping, eating, playing', 1, 'maltese.jpg', true),
(4, 'Gino', 'French Buldog', 'large', 'Burggasse 14', 'A beautiful brown male french Buldog who is waiting to take him home.', 'Sleeping, eating, playing', 8, 'pug.jpg', true),
(5, 'Goldie', 'Fightfish', 'small', 'Praterstrasse 23', 'A beautiful orange fightfish who is waiting to take him home.', 'Swimming, eating, fighting', 1, 'fish.jpg', false),
(6, 'Guy', 'Guineea pig', 'small', 'Neustiftgasse 44', 'A beautiful white/brown little male Guineea Pig who is waiting to take him home.', 'Sleeping, eating, playing', 1, 'guinea-pig.jpg', true),
(7, 'Moussie', 'Hamster', 'small', 'Burggasse 14', 'A beautiful brown/white male Hamster who is waiting to take him home.', 'Running, eating, playing', 2, 'hamster.jpg', true),
(8, 'Stela', 'Horse', 'large', 'Praterstrasse 23', 'A beautiful white female horse who is waiting to take her home.', 'Running, eating, Sleeping', 10, 'horse.jpg', false),
(9, 'Dany', 'Iguana', 'small', 'Neustiftgasse 44', 'A beautiful green female Iguana who is waiting to take her home.', 'Sleeping, eating, playing', 9, 'iguana.jpg', true),
(10, 'Paully', 'Parrot', 'small', 'Burggasse 14', 'A beautiful colorfull male Parrot who is waiting to take him home.', 'Talking, eating, playing', 2, 'parrot.jpg', true),
(11, 'Bunny', 'Rabbit', 'small', 'Praterstrasse 23', 'A beautiful female rabbit who is waiting to take her home.', 'Running, eating, sleeping', 10, 'rabbit.jpg', true),
(12, 'Spidey', 'Tarantula', 'small', 'Neustiftgasse 44', 'A beautiful female Tarantula who is waiting to take her home.', 'Sleeping, eating, playing', 9, 'tarantula.jpg', false);

-- --------------------------------------------------------


--
-- Tabellenstruktur für Tabelle `user`
--
CREATE TABLE `user` (
  `id` int(11) NOT NULL PRIMARY KEY AUTO_INCREMENT,
  `fname` varchar(255) NOT NULL,
  `lname` varchar(255) NOT NULL,
  `password` varchar(255) NOT NULL,
  `email` varchar(255) NOT NULL,
  `address` varchar(512) NOT NULL,
  `phone` varchar(255) NOT NULL,
  `picture` varchar(255) DEFAULT NULL,
  `status` varchar(4) NOT NULL DEFAULT 'user'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Daten für Tabelle `user`
--

INSERT INTO `user` VALUES
(1, "Laura", "Moldovan", "LauraM", "laura.duduma@gmail.com", "Romania, Oravita, 6790, Andrei Saguna, 32", "+40 765 322 590", "laura.jpg", "user"),
(2, "Britney", "Spears", "Brit.S", "britney@gmail.com", "U.S.A., Los Angeles, 4327, Heaven Street, 77/7", "+1 207-200 3904", "britney.jpg", "user"),
(3, "Beyonce", "Knowless", "QueenB", "beyonce@gmail.com", "France, Paris, 5577, Champ d'Elisee, 3/2/7", "+33 677 85 49 754", "beyonce.jpg", "user"),
(4, "Sebastian", "Kurz", "BastiK", "seby.kurz@gmail.com", "Austria, Vienna, 1150, Neubaugürtel, 19/14", "+43 660 85 39 704", "kurz.jpg", "user"),
(5, "Channing", "Tatum", "MagicMike", "channing@gmail.com", "U.S.A., Beverly Hills, 90210, Brenda & Brandon, 12/4", "+1 207-200 4455", "tatum.jpg", "user"),
(6, "Vladimir", "Putin", "VladP", "vladimir@gmail.com", "Rusia, Moscow, 9099, Kokoshnik, 33/3", "+7 333 44 55 666", "putin.jpg", "user"),
(7, "Jackye", "Chan", "KungFu", "karate@gmail.com", "Japan, Tokyo, 5465, Driffting Street, 8/2", "+81 555 85 39 009", "jchan.jpg", "user"),
(8, "Jay", "Z", "Jay-Z", "jay_z@gmail.com",  "France, Paris, 5577, Champ d'Elisee, 3/2/1", "+33 677 95 77 904", "jayz.jpg", "user"),
(9, "Dominic", "Moldovan", "DomM", "domm@gmail.com", "Romania, Oravita, 6790, Andrei Saguna, 38", "+40 765 322 590", "dominic.jpg", "user"),
(10, "Stana", "Izbasa", "SteauaR", "s.izbasa@gmail.com","Romania, Timisoara, 23980, Brancoveanu, 42/5/7", "+40 721 85 66 95", "stana.jpg", "user"),
(11, "Dragana", "Mirkovic", "DragaM", "dm@gmail.com", "Austria, Vienna, 1100 Brunnweg, 4/10/8", "+43 660 85 39 704", "dragam.jpg", "user"),
(12, "William", "Shakespeare", "WillyBoy", "shakespeare@gmail.com", "Germany, Berlin, 8990, Burggasse, 22/3", "+49 443 89 59 994", "willy.jpg", "user");



CREATE TABLE `adoption` (
  `id` int NOT NULL PRIMARY KEY AUTO_INCREMENT,
  `a_date` date NOT NULL,
  `fk_user` int NOT NULL,
  `fk_pet` int NOT NULL,
  FOREIGN KEY (fk_user) REFERENCES user(id) ON DELETE CASCADE
  FOREIGN KEY (fk_pet) REFERENCES animals(id) ON DELETE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;