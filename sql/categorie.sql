-- Table des catégories
CREATE TABLE `categorie` (
  `id_categorie` int NOT NULL AUTO_INCREMENT,
  `nom` varchar(100) COLLATE utf8mb4_general_ci NOT NULL,
  `slug` varchar(120) COLLATE utf8mb4_general_ci NOT NULL,
  `description` text COLLATE utf8mb4_general_ci,
  `image_url` varchar(255) COLLATE utf8mb4_general_ci DEFAULT NULL,
  `parent_id` int DEFAULT NULL,
  `ordre` int DEFAULT '0',
  `visible` tinyint(1) DEFAULT '1',
  `date_creation` datetime DEFAULT CURRENT_TIMESTAMP,
  PRIMARY KEY (`id_categorie`),
  UNIQUE KEY `slug_unique` (`slug`),
  KEY `parent_id` (`parent_id`),
  FOREIGN KEY (`parent_id`) REFERENCES `categorie` (`id_categorie`) ON DELETE SET NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- Insertion des catégories de base
INSERT INTO `categorie` (`nom`, `slug`, `description`, `ordre`, `visible`) VALUES
('Peinture à l\'huile', 'peinture-huile', 'Œuvres réalisées à la peinture à l\'huile sur toile', 1, 1),
('Acrylique', 'acrylique', 'Peintures acryliques sur différents supports', 2, 1),
('Aquarelle', 'aquarelle', 'Œuvres délicates à l\'aquarelle', 3, 1),
('Prints', 'prints', 'Reproductions et impressions d\'art', 4, 1),
('Assets 3D', 'assets-3d', 'Créations numériques et objets 3D', 5, 1),
('Dessins', 'dessins', 'Croquis, fusains et dessins au crayon', 6, 1);