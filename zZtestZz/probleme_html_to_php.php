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
    </div>
</section>