<section class="hero">
        <div class="hero-content">
            <h1>
                <?= $data['currentCategorie'] ? 
                    'Collection ' . htmlspecialchars($data['currentCategorie']['nom']) : 
                    'Collection d\'Œuvres' ?>
            </h1>
            <p>
                <?= $data['currentCategorie'] && $data['currentCategorie']['description'] ? 
                    htmlspecialchars($data['currentCategorie']['description']) : 
                    'Explorez notre sélection d\'œuvres d\'art uniques et exceptionnelles' ?>
            </p>
        </div>
    </section>
    
    <div class="filter-container">
        <div class="container filter">
            <!-- Barre de recherche -->
            <div class="search-section">
                <form action="/catalogue" method="GET" class="search-form">
                    <input type="text" name="search" placeholder="Rechercher une œuvre..." 
                           value="<?= htmlspecialchars($data['filters']['search'] ?? '') ?>" 
                           class="search-input">
                    <button type="submit" class="search-btn">
                        <i class="fas fa-search"></i>
                    </button>
                    <!-- Conserver les autres filtres -->
                    <?php if ($data['filters']['categorie']): ?>
                        <input type="hidden" name="categorie" value="<?= htmlspecialchars($data['filters']['categorie']) ?>">
                    <?php endif; ?>
                </form>
            </div>
            
            <div class="filter-categories">
                <a href="/catalogue" class="filter-btn <?= !$data['filters']['categorie'] ? 'active' : '' ?>">
                    Toutes les œuvres (<?= $data['pagination']['totalItems'] ?>)
                </a>
                <?php if (!empty($data['categories'])): ?>
                    <?php foreach($data['categories'] as $categorie): ?>
                        <a href="/catalogue?categorie=<?= urlencode($categorie['slug']) ?>" 
                           class="filter-btn <?= $data['filters']['categorie'] == $categorie['slug'] ? 'active' : '' ?>">
                            <?= htmlspecialchars($categorie['nom']) ?>
                        </a>
                    <?php endforeach; ?>
                <?php endif; ?>
            </div>
            
            <div class="sort-filter">
                <form action="/catalogue" method="GET" class="sort-form">
                    <select name="sort" class="sort-select" onchange="this.form.submit()">
                        <option value="recent" <?= $data['filters']['sort'] == 'recent' ? 'selected' : '' ?>>Plus récent</option>
                        <option value="price-asc" <?= $data['filters']['sort'] == 'price-asc' ? 'selected' : '' ?>>Prix croissant</option>
                        <option value="price-desc" <?= $data['filters']['sort'] == 'price-desc' ? 'selected' : '' ?>>Prix décroissant</option>
                        <option value="name" <?= $data['filters']['sort'] == 'name' ? 'selected' : '' ?>>Alphabétique</option>
                    </select>
                    
                    <!-- Conserver les autres filtres -->
                    <?php if ($data['filters']['categorie']): ?>
                        <input type="hidden" name="categorie" value="<?= htmlspecialchars($data['filters']['categorie']) ?>">
                    <?php endif; ?>
                    <?php if ($data['filters']['search']): ?>
                        <input type="hidden" name="search" value="<?= htmlspecialchars($data['filters']['search']) ?>">
                    <?php endif; ?>
                </form>
                
                <div class="view-toggle">
                    <button class="view-btn active" data-view="grid"><i class="fas fa-th"></i></button>
                    <button class="view-btn" data-view="list"><i class="fas fa-list"></i></button>
                </div>
            </div>
        </div>
    </div>

    <!-- Résultats et compteur -->
    <div class="container">
        <div class="results-info">
            <p>
                <?php if ($data['pagination']['totalItems'] > 0): ?>
                    Affichage de <?= ($data['pagination']['currentPage'] - 1) * $data['pagination']['itemsPerPage'] + 1 ?> 
                    à <?= min($data['pagination']['currentPage'] * $data['pagination']['itemsPerPage'], $data['pagination']['totalItems']) ?> 
                    sur <?= $data['pagination']['totalItems'] ?> œuvre(s)
                <?php else: ?>
                    Aucune œuvre trouvée
                <?php endif; ?>
                
                <?php if ($data['filters']['search']): ?>
                    pour "<strong><?= htmlspecialchars($data['filters']['search']) ?></strong>"
                <?php endif; ?>
                
                <?php if ($data['currentCategorie']): ?>
                    dans la catégorie "<strong><?= htmlspecialchars($data['currentCategorie']['nom']) ?></strong>"
                <?php endif; ?>
            </p>
            
            <?php if ($data['filters']['search'] || $data['filters']['categorie']): ?>
                <a href="/catalogue" class="clear-filters">Effacer les filtres</a>
            <?php endif; ?>
        </div>
    </div>
    
    <section class="gallery">
        <div class="container">
            <div class="gallery-grid" id="gallery-grid">
                <?php if(empty($data['items'])): ?>
                    <div class="no-results">
                        <i class="fas fa-search" style="font-size: 3rem; color: #ddd; margin-bottom: 20px;"></i>
                        <h3>Aucune œuvre trouvée</h3>
                        <p>Essayez de modifier vos critères de recherche ou explorez d'autres catégories.</p>
                        <a href="/catalogue" class="btn">Voir toutes les œuvres</a>
                    </div>
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
                                <?php if($item['statut'] != 'rupture' && ($item['quantite_stock'] ?? 0) > 0): ?>
                                <form action="/panier/add" method="POST" style="display: inline;">
                                    <input type="hidden" name="item_id" value="<?= $item['id_item'] ?>">
                                    <input type="hidden" name="quantity" value="1">
                                    <button type="submit" class="overlay-btn btn-cart">
                                        <i class="fas fa-shopping-cart"></i>
                                    </button>
                                </form>
                                <?php endif; ?>
                            </div>
                            <div class="art-info">
                                <h3 class="art-title"><?= htmlspecialchars($item['nom']) ?></h3>
                                
                                <!-- Catégorie avec fallback -->
                                <div class="art-category">
                                    <?php if (!empty($item['categorie_nom'])): ?>
                                        <a href="/catalogue?categorie=<?= urlencode($item['categorie_slug']) ?>">
                                            <?= htmlspecialchars($item['categorie_nom']) ?>
                                        </a>
                                    <?php elseif ($item['categorie_id']): ?>
                                        <?php  
                                        switch($item['categorie_id']) {
                                            case 1: echo "Peinture"; break;
                                            case 2: echo "Print"; break;
                                            case 3: echo "Asset 3D"; break;
                                            case 4: echo "Peinture à l'huile"; break;
                                            case 5: echo "Aquarelle"; break;
                                            default: echo "Catégorie " . $item['categorie_id'];
                                        }
                                        ?>
                                    <?php else: ?>
                                        Non catégorisé
                                    <?php endif; ?>
                                </div>
                                
                                <div class="art-price">
                                    <?php if($item['prix_promo']): ?>
                                        <span class="original-price">€ <?= number_format($item['prix'], 2, ',', ' ') ?></span>
                                        <span class="promo-price">€ <?= number_format($item['prix_promo'], 2, ',', ' ') ?></span>
                                    <?php else: ?>
                                        € <?= number_format($item['prix'], 2, ',', ' ') ?>
                                    <?php endif; ?>
                                </div>
                                
                                <!-- Badges de statut -->
                                <?php if($item['statut'] == 'rupture'): ?>
                                    <div class="art-status out-of-stock">Rupture de stock</div>
                                <?php elseif($item['statut'] == 'en_promotion' && $item['prix_promo']): ?>
                                    <div class="art-status on-sale">
                                        <?php 
                                        $reduction = round(100 - ($item['prix_promo'] / $item['prix'] * 100));
                                        echo "Promo -" . $reduction . "%";
                                        ?>
                                    </div>
                                <?php elseif($item['statut'] == 'en_promotion'): ?>
                                    <div class="art-status on-sale">Promotion !</div>
                                <?php endif; ?>
                            </div>
                        </div>
                    <?php endforeach; ?>
                <?php endif; ?>
            </div>
            
            <?php if ($data['pagination']['totalPages'] > 1): ?>
            <div class="pagination">
                <?php
                $currentPage = $data['pagination']['currentPage'];
                $totalPages = $data['pagination']['totalPages'];
                $baseUrl = '/catalogue?';
                
                // Construire l'URL de base avec les paramètres actuels
                $params = [];
                if ($data['filters']['categorie']) $params['categorie'] = $data['filters']['categorie'];
                if ($data['filters']['search']) $params['search'] = $data['filters']['search'];
                if ($data['filters']['sort'] != 'recent') $params['sort'] = $data['filters']['sort'];
                $baseUrl .= http_build_query($params) . ($params ? '&' : '');
                ?>
                
                <?php if ($currentPage > 1): ?>
                    <a href="<?= $baseUrl ?>page=<?= $currentPage - 1 ?>" class="page-nav">
                        <i class="fas fa-chevron-left"></i>
                    </a>
                <?php endif; ?>
                
                <?php
                $startPage = max(1, $currentPage - 2);
                $endPage = min($totalPages, $currentPage + 2);
                
                if ($startPage > 1):
                ?>
                    <a href="<?= $baseUrl ?>page=1" class="page-btn">1</a>
                    <?php if ($startPage > 2): ?>
                        <span class="page-dots">...</span>
                    <?php endif; ?>
                <?php endif; ?>
                
                <?php for ($i = $startPage; $i <= $endPage; $i++): ?>
                    <a href="<?= $baseUrl ?>page=<?= $i ?>" 
                       class="page-btn <?= $i == $currentPage ? 'active' : '' ?>">
                        <?= $i ?>
                    </a>
                <?php endfor; ?>
                
                <?php if ($endPage < $totalPages): ?>
                    <?php if ($endPage < $totalPages - 1): ?>
                        <span class="page-dots">...</span>
                    <?php endif; ?>
                    <a href="<?= $baseUrl ?>page=<?= $totalPages ?>" class="page-btn"><?= $totalPages ?></a>
                <?php endif; ?>
                
                <?php if ($currentPage < $totalPages): ?>
                    <a href="<?= $baseUrl ?>page=<?= $currentPage + 1 ?>" class="page-nav">
                        <i class="fas fa-chevron-right"></i>
                    </a>
                <?php endif; ?>
            </div>
            <?php endif; ?>
        </div>
    </section>

<style>
.search-section {
    margin-bottom: 20px;
}

.search-form {
    display: flex;
    max-width: 400px;
}

.search-input {
    flex: 1;
    padding: 12px;
    border: 1px solid #ddd;
    border-radius: 4px 0 0 4px;
    font-size: 14px;
}

.search-btn {
    background: #007bff;
    color: white;
    border: none;
    padding: 12px 16px;
    border-radius: 0 4px 4px 0;
    cursor: pointer;
}

.results-info {
    display: flex;
    justify-content: space-between;
    align-items: center;
    margin-bottom: 30px;
    padding: 15px 0;
    border-bottom: 1px solid #eee;
}

.clear-filters {
    color: #dc3545;
    text-decoration: none;
    font-weight: bold;
}

.clear-filters:hover {
    text-decoration: underline;
}

.no-results {
    text-align: center;
    padding: 60px 20px;
    grid-column: 1 / -1;
}

.art-category a {
    color: #666;
    text-decoration: none;
    font-size: 0.9rem;
}

.art-category a:hover {
    color: #007bff;
    text-decoration: underline;
}

.art-status {
    font-size: 0.8rem;
    font-weight: bold;
    padding: 4px 8px;
    border-radius: 4px;
    margin-top: 8px;
    display: inline-block;
}

.art-status.out-of-stock {
    background: #f8d7da;
    color: #721c24;
}

.art-status.on-sale {
    background: #d4edda;
    color: #155724;
}

.btn-cart {
    background: #28a745 !important;
    border: none;
    padding: 8px;
    margin-left: 5px;
}

.original-price {
    text-decoration: line-through;
    color: #999;
    margin-right: 8px;
}

.promo-price {
    color: #dc3545;
    font-weight: bold;
}

.pagination {
    display: flex;
    justify-content: center;
    align-items: center;
    gap: 5px;
    margin-top: 40px;
}

.page-nav, .page-btn {
    padding: 10px 15px;
    text-decoration: none;
    background: white;
    border: 1px solid #ddd;
    border-radius: 4px;
    color: #333;
    transition: all 0.3s;
}

.page-btn.active {
    background: #007bff;
    color: white;
    border-color: #007bff;
}

.page-nav:hover, .page-btn:hover {
    background: #f8f9fa;
}

.page-dots {
    padding: 10px 5px;
    color: #999;
}

@media (max-width: 768px) {
    .filter {
        flex-direction: column;
        gap: 15px;
    }
    
    .filter-categories {
        overflow-x: auto;
        white-space: nowrap;
        padding-bottom: 10px;
    }
    
    .results-info {
        flex-direction: column;
        gap: 10px;
        text-align: center;
    }
    
    .pagination {
        flex-wrap: wrap;
        gap: 3px;
    }
    
    .page-nav, .page-btn {
        padding: 8px 12px;
        font-size: 14px;
    }
}
</style>

<script>
document.addEventListener('DOMContentLoaded', function() {
    // Boutons de vue (grille/liste)
    const viewBtns = document.querySelectorAll('.view-btn');
    const gallery = document.getElementById('gallery-grid');
    
    viewBtns.forEach(btn => {
        btn.addEventListener('click', function() {
            viewBtns.forEach(b => b.classList.remove('active'));
            this.classList.add('active');
            
            const view = this.dataset.view;
            gallery.className = view === 'list' ? 'gallery-list' : 'gallery-grid';
        });
    });
});
</script>