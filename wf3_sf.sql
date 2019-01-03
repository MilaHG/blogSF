-- phpMyAdmin SQL Dump
-- version 4.7.7
-- https://www.phpmyadmin.net/
--
-- Hôte : 127.0.0.1
-- Généré le :  jeu. 03 jan. 2019 à 16:50
-- Version du serveur :  10.1.30-MariaDB
-- Version de PHP :  7.1.14

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Base de données :  `wf3_sf`
--

-- --------------------------------------------------------

--
-- Structure de la table `address`
--

CREATE TABLE `address` (
  `id` int(11) NOT NULL,
  `person_id` int(11) NOT NULL,
  `street` longtext NOT NULL,
  `zip_code` varchar(5) NOT NULL,
  `town` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Structure de la table `article`
--

CREATE TABLE `article` (
  `id` int(11) NOT NULL,
  `author_id` int(11) NOT NULL,
  `category_id` int(11) NOT NULL,
  `title` varchar(255) NOT NULL,
  `content` longtext NOT NULL,
  `description` longtext NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Déchargement des données de la table `article`
--

INSERT INTO `article` (`id`, `author_id`, `category_id`, `title`, `content`, `description`) VALUES
(1, 2, 1, 'Tomates Mozza', '<p class=\"p10 \"><span class=\"dblock bold txt-dark-gray\">&Eacute;TAPE 1</span></p>\r\n<p class=\"p10 \">Lavez les tomates et coupez-les en tranches de tomates. Taillez la mozzarella en lamelles de m&ecirc;me &eacute;paisseur. Lavez, effeuillez le basilic et ciselez-le grossi&egrave;rement.</p>\r\n<p class=\"p10 \"><span class=\"dblock bold txt-dark-gray\">&Eacute;TAPE 2</span></p>\r\n<p class=\"p10 \">Dressez les tranches de tomates et la mozzarella en couronne sur 4 assiettes, en alternant une tranche de tomates puis une tranche de mozzarella. Parsemez de basilic.</p>\r\n<p class=\"p10 \"><span class=\"dblock bold txt-dark-gray\">&Eacute;TAPE 3</span></p>\r\n<p class=\"p10 \">Assaisonnez ensuite d&rsquo;huile d&rsquo;olive et de vinaigre balsamique. Salez, poivrez. Servez frais.</p>', 'Un repas sous le soleil italien avec cette recette de salade tomate-mozzarella. Facile et rapide à réaliser, cette recette est idéale pour vous faire plaisir le temps d\'un déjeuner ensoleillé. Une délicieuse mozzarella italienne associée à des tomates fraîches de saison, on adore l\'été et on en redemande !'),
(2, 2, 1, 'Salade César', '<p class=\"p10 \"><span class=\"dblock bold txt-dark-gray\">&Eacute;TAPE 1</span></p>\r\n<p class=\"p10 \">&Eacute;mincez les blancs de poulet, placez-les dans un plat et versez le jus d\'1/2 citron dessus, laissez mariner au minimum 4 heures au frigo.</p>\r\n<p class=\"p10 \"><span class=\"dblock bold txt-dark-gray\">&Eacute;TAPE 2</span></p>\r\n<p class=\"p10 \">Coupez 2 biscottes en miettes, ajoutez un peu d\'&eacute;pice aux biscottes &eacute;cras&eacute;es, salez et poivrez. Dans une po&ecirc;le anti-adh&eacute;sive, ajoutez une noix de beurre. Panez chaque blanc de poulet marin&eacute; dans la chapelure aux &eacute;pices et mettez-les dans la po&ecirc;le chaude. Laissez cuire environ 3 &agrave; 4 min, jusqu\'&agrave; ce que les aiguillettes de poulet soient cuites.</p>\r\n<p class=\"p10 \"><span class=\"dblock bold txt-dark-gray\">&Eacute;TAPE 3</span></p>\r\n<p class=\"p10 \">Dressez les assiettes individuellement ou mettez tous les ingr&eacute;dients dans un saladier.</p>\r\n<p class=\"p10 \"><span class=\"dblock bold txt-dark-gray\">&Eacute;TAPE 4</span></p>\r\n<p class=\"p10 \">M&eacute;langez la salade, les biscottes bris&eacute;es en morceaux, les croutons, l\'&eacute;chalote &eacute;minc&eacute;e, les copeaux de parmesan et le poulet &eacute;minc&eacute;. Dans un bol, pr&eacute;parez la vinaigrette avec la cr&egrave;me fra&icirc;che, la moutarde, le jus de citron, un peu de parmesan et un peu de vinaigre balsamique (facultatif). Assaisonnez avec le sel et le poivre. Servez cette salade caesar en entr&eacute;e ou en plat unique.</p>', 'Vous rechercher une salade composée fraîcheur ou un repas light pour votre soirée ? Alors, ne bougez pas vous êtes au bon endroit ! Cette recette de salade césar rappelle la saison estivale et les soirées au bord de la piscine. Qu\'en dites-vous ?'),
(3, 2, 2, 'Gratin de courgette', '<p class=\"p10 \"><span class=\"dblock bold txt-dark-gray\">&Eacute;TAPE 1</span></p>\r\n<p class=\"p10 \">Pr&eacute;chauffez le four th.6 (180&deg;C).</p>\r\n<p class=\"p10 \"><span class=\"dblock bold txt-dark-gray\">&Eacute;TAPE 2</span></p>\r\n<p class=\"p10 \">Lavez et s&eacute;chez les courgettes, coupez les extr&eacute;mit&eacute;s, r&acirc;pez-les avec la peau.</p>\r\n<p class=\"p10 \"><span class=\"dblock bold txt-dark-gray\">&Eacute;TAPE 3</span></p>\r\n<p class=\"p10 \">Dans une jatte, m&eacute;langez les courgettes r&acirc;p&eacute;es, le fromage de ch&eacute;vre frais, l\'huile d\'olive (j\'ai voulu accentuer en go&ucirc;t \"noisette\" en apportant 1/2 c. &agrave; soupe d\'huile de noisettes, et donc 1,5 c. &agrave; soupe d\'huile d\'olive), la menthe hach&eacute;e, la semoule de bl&eacute; fine, la chapelure, poivrez mais ne salez pas &agrave; cause du fromage qui l\'est d&eacute;j&agrave;.</p>\r\n<p class=\"p10 \"><span class=\"dblock bold txt-dark-gray\">&Eacute;TAPE 4</span></p>\r\n<p class=\"p10 \">Egalisez le dessus de la pr&eacute;paration dans un plat &agrave; gratin, et saupoudrez le dessus du plat, de noisettes concass&eacute;es (pour moi ce fut avec de la poudre de noisettes).</p>\r\n<div id=\"dynInfeed2\" class=\"dynInFeed\">&nbsp;</div>\r\n<p class=\"p10 \"><span class=\"dblock bold txt-dark-gray\">&Eacute;TAPE 5</span></p>\r\n<p class=\"p10 \">Enfournez pendant 25 min.</p>\r\n<p class=\"p10 \"><span class=\"dblock bold txt-dark-gray\">&Eacute;TAPE 6</span></p>\r\n<p class=\"p10 \">D&eacute;gustez ti&eacute;de ou froid, avec des d&eacute;s de tomate fra&icirc;che, c\'est d&eacute;licieux !</p>', 'Gratin de courgettes, chèvre frais, noisettes et menthe');

-- --------------------------------------------------------

--
-- Structure de la table `category`
--

CREATE TABLE `category` (
  `id` int(11) NOT NULL,
  `name` varchar(20) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Déchargement des données de la table `category`
--

INSERT INTO `category` (`id`, `name`) VALUES
(1, 'Entrées'),
(2, 'Plats');

-- --------------------------------------------------------

--
-- Structure de la table `comment`
--

CREATE TABLE `comment` (
  `id` int(11) NOT NULL,
  `article_id` int(11) NOT NULL,
  `user_id` int(11) NOT NULL,
  `title` varchar(255) NOT NULL,
  `content` longtext NOT NULL,
  `date` datetime DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Déchargement des données de la table `comment`
--

INSERT INTO `comment` (`id`, `article_id`, `user_id`, `title`, `content`, `date`) VALUES
(1, 1, 3, 'commentaire de calimero', 'tomates rouges ou vertes ?', '2019-01-03 16:46:58');

-- --------------------------------------------------------

--
-- Structure de la table `person`
--

CREATE TABLE `person` (
  `id` int(11) NOT NULL,
  `firstname` varchar(255) NOT NULL,
  `lastname` varchar(255) NOT NULL,
  `email` varchar(255) NOT NULL,
  `birth_date` date NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Structure de la table `user`
--

CREATE TABLE `user` (
  `id` int(11) NOT NULL,
  `username` varchar(30) NOT NULL,
  `password` varchar(255) NOT NULL,
  `lastname` varchar(255) NOT NULL,
  `firstname` varchar(255) NOT NULL,
  `email` varchar(255) NOT NULL,
  `role` varchar(20) NOT NULL,
  `avatar` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Déchargement des données de la table `user`
--

INSERT INTO `user` (`id`, `username`, `password`, `lastname`, `firstname`, `email`, `role`, `avatar`) VALUES
(2, 'testtest', '$2y$13$9KCT804FDoepN3JMr9S4POEMaugo.yRRcrUNhqH8CqPYdrhpjXwe.', 'test', 'test', 'moi@test.com', 'ROLE_ADMIN', '3f2c136dde0d88225b1bac955b018513.png'),
(3, 'calimero', '$2y$13$fLbbstJC6es10M/kQpfv5.S50f/fliakmtme.PB3Y7GdRuxr2gDDq', 'Diallo', 'Alpha', 'alpha@calimero.fr', 'ROLE_USER', '96509c1cf3616eebf311714dc0c6792c.jpeg');

--
-- Index pour les tables déchargées
--

--
-- Index pour la table `address`
--
ALTER TABLE `address`
  ADD PRIMARY KEY (`id`);

--
-- Index pour la table `article`
--
ALTER TABLE `article`
  ADD PRIMARY KEY (`id`);

--
-- Index pour la table `category`
--
ALTER TABLE `category`
  ADD PRIMARY KEY (`id`);

--
-- Index pour la table `comment`
--
ALTER TABLE `comment`
  ADD PRIMARY KEY (`id`);

--
-- Index pour la table `person`
--
ALTER TABLE `person`
  ADD PRIMARY KEY (`id`);

--
-- Index pour la table `user`
--
ALTER TABLE `user`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT pour les tables déchargées
--

--
-- AUTO_INCREMENT pour la table `address`
--
ALTER TABLE `address`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT pour la table `article`
--
ALTER TABLE `article`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT pour la table `category`
--
ALTER TABLE `category`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT pour la table `comment`
--
ALTER TABLE `comment`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT pour la table `person`
--
ALTER TABLE `person`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT pour la table `user`
--
ALTER TABLE `user`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
