<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Catalogue | Artiste Peintre</title>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    <link rel="stylesheet" href="styles_catalogue.css">
</head>
<body>
    <header>
        <div class="container header-container">
            <div class="logo">Seedarrt</div>
            <nav>
                <ul>
                    <li><a href="#">Accueil</a></li>
                    <li><a href="#">À propos</a></li>
                    <li><a href="#">Catalogue</a></li>
                    <li><a href="#">Lors</a></li>
                    <li><a href="#">Contact</a></li>
                </ul>
            </nav>
        </div>
    </header>
    
    <section class="hero">
        <div class="hero-content">
            <h1>Collection d'Œuvres</h1>
            <p>Explorez notre sélection d'œuvres d'art uniques et exceptionnelles</p>
        </div>
    </section>
    
    <div class="filter-container">
        <div class="container filter">
            <div class="filter-categories">
                <button class="filter-btn active">Toutes les œuvres</button>
                <button class="filter-btn">Peintures à l'huile</button>
                <button class="filter-btn">Acryliques</button>
                <button class="filter-btn">Aquarelles</button>
                <button class="filter-btn">Prints</button>
                <button class="filter-btn">Asset 3D</button>
            </div>
            <div class="sort-filter">
                <select class="sort-select">
                    <option value="recent">Plus récent</option>
                    <option value="price-asc">Prix croissant</option>
                    <option value="price-desc">Prix décroissant</option>
                    <option value="name">Alphabétique</option>
                </select>
                <div class="view-toggle">
                    <button class="view-btn active"><i class="fas fa-th"></i></button>
                    <button class="view-btn"><i class="fas fa-list"></i></button>
                </div>
            </div>
        </div>
    </div>
    
    <section class="gallery">
        <div class="container">
            <div class="gallery-grid">

            <div class="gallery-grid">
    <?php if(empty($items)): ?>
        <p>Aucune œuvre n'a été trouvée.</p>
    <?php else: ?>
        <?php foreach($items as $item): ?>
            <div class="art-item">
                <div class="art-image">
                    <?php if(!empty($item['image_url'])): ?>
                        <img src="<?= htmlspecialchars($item['image_url']) ?>" alt="<?= htmlspecialchars($item['nom']) ?>">
                    <?php else: ?>
                        <img src="/api/placeholder/600/400" alt="<?= htmlspecialchars($item['nom']) ?>">
                    <?php endif; ?>
                </div>
                <div class="art-overlay">
                    <button class="overlay-btn">Voir détails</button>
                </div>
                <div class="art-info">
                    <h3 class="art-title"><?= htmlspecialchars($item['nom']) ?></h3>
                    
                    <!-- Affichage simplifié de la catégorie -->
                    <div class="art-category">
                        <?php 
                        if($item['categorie_id'] == 1) echo "Peinture";
                        elseif($item['categorie_id'] == 2) echo "Print";
                        elseif($item['categorie_id'] == 3) echo "Asset 3D";
                        else echo "Non catégorisé";
                        ?>
                    </div>
                    
                    <!-- Affichage simplifié du prix -->
                    <div class="art-price">
                        <?php if($item['prix_promo']): ?>
                            <span style="text-decoration: line-through;">€ <?= number_format($item['prix'], 2, ',', ' ') ?></span>
                            <span style="color: red;">€ <?= number_format($item['prix_promo'], 2, ',', ' ') ?></span>
                        <?php else: ?>
                            € <?= number_format($item['prix'], 2, ',', ' ') ?>
                        <?php endif; ?>
                    </div>
                    
                    <!-- Indicateur de statut simple -->
                    <?php if($item['statut'] == 'rupture'): ?>
                        <div style="color: red;">Rupture de stock</div>
                    <?php endif; ?>
                </div>
            </div>
        <?php endforeach; ?>
    <?php endif; ?>
</div>
                
                <!-- Art Item 2 -->
                <div class="art-item">
                    <div class="art-image">
                        <img src="/api/placeholder/600/400" alt="Œuvre d'art 2">
                    </div>
                    <div class="art-overlay">
                        <button class="overlay-btn">Voir détails</button>
                    </div>
                    <div class="art-info">
                        <h3 class="art-title">Sérénité Azurée</h3>
                        <div class="art-category">Acrylique</div>
                        <div class="art-price">€ 3,800</div>
                    </div>
                </div>
                
                <!-- Art Item 3 -->
                <div class="art-item">
                    <div class="art-image">
                        <img src="/api/placeholder/600/400" alt="Œuvre d'art 3">
                    </div>
                    <div class="art-overlay">
                        <button class="overlay-btn">Voir détails</button>
                    </div>
                    <div class="art-info">
                        <h3 class="art-title">Lumière d'Été</h3>
                        <div class="art-category">Aquarelle</div>
                        <div class="art-price">€ 2,950</div>
                    </div>
                </div>
                
                <!-- Art Item 4 -->
                <div class="art-item">
                    <div class="art-image">
                        <img src="/api/placeholder/600/400" alt="Œuvre d'art 4">
                    </div>
                    <div class="art-overlay">
                        <button class="overlay-btn">Voir détails</button>
                    </div>
                    <div class="art-info">
                        <h3 class="art-title">Mélancolie Nocturne</h3>
                        <div class="art-category">Peinture à l'huile</div>
                        <div class="art-price">€ 6,100</div>
                    </div>
                </div>
                
                <!-- Art Item 5 -->
                <div class="art-item">
                    <div class="art-image">
                        <img src="/api/placeholder/600/400" alt="Œuvre d'art 5">
                    </div>
                    <div class="art-overlay">
                        <button class="overlay-btn">Voir détails</button>
                    </div>
                    <div class="art-info">
                        <h3 class="art-title">Élégance Abstraite</h3>
                        <div class="art-category">Acrylique</div>
                        <div class="art-price">€ 4,500</div>
                    </div>
                </div>
                
                <!-- Art Item 6 -->
                <div class="art-item">
                    <div class="art-image">
                        <img src="/api/placeholder/600/400" alt="Œuvre d'art 6">
                    </div>
                    <div class="art-overlay">
                        <button class="overlay-btn">Voir détails</button>
                    </div>
                    <div class="art-info">
                        <h3 class="art-title">Harmonie Dorée</h3>
                        <div class="art-category">Œuvre sur papier</div>
                        <div class="art-price">€ 3,200</div>
                    </div>
                </div>
            </div>
            
            <div class="pagination">
                <button class="page-nav"><i class="fas fa-chevron-left"></i></button>
                <button class="page-btn active">1</button>
                <button class="page-btn">2</button>
                <button class="page-btn">3</button>
                <button class="page-btn">4</button>
                <button class="page-nav"><i class="fas fa-chevron-right"></i></button>
            </div>
        </div>
    </section>
    
    <footer>
        <div class="container">
            <div class="footer-content">
                <div>
                    <div class="footer-logo">Artiste</div>
                    <p class="footer-desc">Créateur d'œuvres d'art exclusives, inspirées par la beauté de la nature et l'émotion humaine. Chaque pièce est une expression unique de passion et de créativité.</p>
                    <div class="social-icons">
                        <a href="#" class="social-icon"><i class="fab fa-instagram"></i></a>
                        <a href="#" class="social-icon"><i class="fab fa-facebook"></i></a>
                        <a href="#" class="social-icon"><i class="fab fa-pinterest"></i></a>
                        <a href="#" class="social-icon"><i class="fab fa-twitter"></i></a>
                    </div>
                </div>
                
                <div>
                    <h4 class="footer-title">Liens rapides</h4>
                    <ul class="footer-links">
                        <li><a href="#">Accueil</a></li>
                        <li><a href="#">À propos</a></li>
                        <li><a href="#">Catalogue</a></li>
                        <li><a href="#">Lors</a></li>
                        <li><a href="#">Contact</a></li>
                        <li><a href="#">Politique de confidentialité</a></li>
                    </ul>
                </div>
                
                <div>
                    <h4 class="footer-title">Contact</h4>
                    <p class="footer-contact"><i class="fas fa-map-marker-alt"></i> 123 Rue du Capitalism, 1030 Schaerbeeck</p>
                    <p class="footer-contact"><i class="fas fa-phone"></i> +33 1 23 45 67 89</p>
                    <p class="footer-contact"><i class="fas fa-envelope"></i> contact@artiste.com</p>
                </div>
            </div>
            
            <div class="copyright">
                © 2025 Artiste Seedarrt. Tous droits réservés.
            </div>
        </div>
    </footer>
</body>
</html>