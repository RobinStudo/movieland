SET FOREIGN_KEY_CHECKS=0;
SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";

/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;


INSERT INTO `cast` (`movie_id`, `person_id`) VALUES
(1, 5),
(1, 6),
(2, 3),
(2, 4),
(3, 3);

INSERT INTO `category` (`id`, `label`) VALUES
(1, 'Action'),
(2, 'Romance');

INSERT INTO `movie` (`id`, `title`, `summary`, `poster`, `released_at`, `all_public`, `category_id`, `director_id`) VALUES
(1, 'Titanic', 'Southampton, 10 avril 1912. Le paquebot le plus grand et le plus moderne du monde, réputé pour son insubmersibilité, le \"Titanic\", appareille pour son premier voyage. Quatre jours plus tard, il heurte un iceberg. A son bord, un artiste pauvre et une grande bourgeoise tombent amoureux.', 'https://m.media-amazon.com/images/I/71svirLP6GL._AC_UF1000,1000_QL80_.jpg', '1998-01-07', 1, 2, 2),
(2, 'Piège de cristal\r\n', 'Un policier new-yorkais, John McClane, est séparé de sa femme Holly, cadre dans une puissante multinationale japonaise, la Nakatomi Corporation. Venu à Los Angeles passer les fêtes avec elle, il se rend à la tour Nakatomi où le patron donne une grande soirée. Tandis que John s\'isole pour téléphoner, un groupe de terroristes allemands, dirigé par Hans Gruber, pénètre dans l\'immeuble.', 'https://media.senscritique.com/media/000012315612/0/piege_de_cristal.jpg', '1988-09-21', 0, 1, 1),
(3, 'Armageddon', 'Alors qu\'elle se trouve en mission en orbite terrestre, la navette Atlantis est détruite par une pluie de météorites qui termine sa course sur New York. Ceci est le prélude d\'une catastrophe majeure : un astéroïde de la taille du Texas va s\'écraser sur Terre dans dix-huit jours. Dan Truman, directeur des opérations de vol à la NASA, envisage la mission de la dernière chance : envoyer des astronautes sur l\'astéroïde pour qu\'ils y creusent un puits dans lequel sera insérée une charge nucléaire.', 'https://www.ecranlarge.com/content/uploads/2019/11/rrggzjmfv4pfhvi4tbmczeirvsz-848-200x300.jpg', '1998-08-05', 1, 1, 7);

INSERT INTO `person` (`id`, `firstname`, `lastname`, `birthdate`) VALUES
(1, 'John', 'McTiernan', '1951-01-08'),
(2, 'James', 'Cameron', '1954-08-16'),
(3, 'Bruce', 'Willis', '1955-03-19'),
(4, 'Alan', 'Rickman', '1946-02-21'),
(5, 'Leonardo', 'DiCaprio', '1974-11-11'),
(6, 'Kate', 'Winslet', '1975-10-05'),
(7, 'Michael', 'Bay', '1965-02-17');
SET FOREIGN_KEY_CHECKS=1;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
