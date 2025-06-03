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
            <?php if(empty($data['items'])): ?>
                <p>Aucune œuvre n'a été trouvée.</p>
            <?php else: ?>
                <?php foreach($data['items'] as $item): ?>
                    <div class="art-item">
                        <div class="art-image">
                            <?php if(!empty($item['image_url'])): ?>
                                <img src="/uploads/item/<?= $item['slug']?>/<?= $item['image_url'];?>" alt="<?= htmlspecialchars($item['nom']) ?>">
                            <?php else: ?>
                                <img src="/api/placeholder/600/400" alt="<?= htmlspecialchars($item['nom']) ?>">
                            <?php endif; ?>
                        </div>
                        <div class="art-overlay">
                            <a href="/catalogue/detail/<?= $item['slug'];?>" class="overlay-btn">Voir détails</a>
                        </div>
                        <div class="art-info">
                            <h3 class="art-title"><?= htmlspecialchars($item['nom']) ?></h3>
                            
                            <!-- Affichage simplifié de la catégorie -->
                            <div class="art-category">
                                <?php  
                                if($item['categorie_id'] == 1) echo "Peinture";
                                elseif($item['categorie_id'] == 2) echo "Print";
                                elseif($item['categorie_id'] == 3) echo "Asset 3D";
                                elseif($item['categorie_id'] == 4) echo "Peinture à l'huile";
                                elseif($item['categorie_id'] == 5) echo "Aquarelle";
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
    </div>
</section>
            
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
    