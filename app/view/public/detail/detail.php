<section class="breadcrumb">
    <div class="container">
        <ul>
            <li><a href="/home">Accueil</a></li>
            <li><a href="/catalogue">Catalogue</a></li>
            <li><?= htmlspecialchars($data['item']['nom']) ?></li>
        </ul>
    </div>
</section>

<section class="artwork-detail">
    <div class="container">
        <div class="artwork-container">
            <div class="artwork-gallery">
                <div class="main-image">
                    <img id="mainImage"
                         src="/uploads/item/<?= $data['item']['slug']?>/<?= $data['item']['image_url'] ?: '/api/placeholder/600/600' ?>"
                         alt="<?= htmlspecialchars($data['item']['nom']) ?>">
                </div>
                <div class="thumbnail-container">
                    <div class="thumbnail active" data-img="/uploads/item/<?= $data['item']['slug']?>/<?= $data['item']['image_url'] ?: '/api/placeholder/600/600' ?>">
                        <img src="/uploads/item/<?= $data['item']['slug']?>/<?= $data['item']['image_url'] ?: '/api/placeholder/600/600' ?>" alt="">
                    </div>
                </div>
            </div>

            <div class="artwork-info">
                <h1 class="artwork-title"><?= htmlspecialchars($data['item']['nom']) ?></h1>
                
                <div class="artwork-price">
                    <?php if($data['item']['prix_promo']): ?>
                        <span class="original-price">€ <?= number_format($data['item']['prix'], 2, ',', ' ') ?></span>
                        <span class="promo-price">€ <?= number_format($data['item']['prix_promo'], 2, ',', ' ') ?></span>
                    <?php else: ?>
                        € <?= number_format($data['item']['prix'], 2, ',', ' ') ?>
                    <?php endif; ?>
                </div>

                <!-- STATUT ET DISPONIBILITÉ -->
                <div class="artwork-status">
                    <?php if($data['item']['statut'] == 'rupture' || $data['item']['quantite_stock'] <= 0): ?>
                        <span class="status-badge out-of-stock">Rupture de stock</span>
                    <?php elseif($data['item']['statut'] == 'inactif'): ?>
                        <span class="status-badge unavailable">Non disponible</span>
                    <?php else: ?>
                        <span class="status-badge available">Disponible</span>
                        <?php if($data['item']['quantite_stock'] <= 5): ?>
                            <span class="stock-warning">Plus que <?= $data['item']['quantite_stock'] ?> en stock !</span>
                        <?php endif; ?>
                    <?php endif; ?>
                </div>

                <!-- FORMULAIRE D'AJOUT AU PANIER -->
                <?php if($data['item']['statut'] != 'rupture' && $data['item']['statut'] != 'inactif' && $data['item']['quantite_stock'] > 0): ?>
                <div class="add-to-cart-section">
                    <form action="/panier/add" method="POST" class="add-to-cart-form">
                        <input type="hidden" name="item_id" value="<?= $data['item']['id_item'] ?>">
                        
                        <div class="quantity-selector">
                            <label for="quantity">Quantité :</label>
                            <div class="quantity-controls">
                                <button type="button" class="qty-btn" data-action="decrease">-</button>
                                <input type="number" id="quantity" name="quantity" value="1" 
                                       min="1" max="<?= $data['item']['quantite_stock'] ?>" class="qty-input">
                                <button type="button" class="qty-btn" data-action="increase">+</button>
                            </div>
                        </div>
                        
                        <button type="submit" class="btn-add-to-cart">
                            <i class="fas fa-shopping-cart"></i>
                            Ajouter au panier
                        </button>
                    </form>
                </div>
                <?php endif; ?>

                <!-- INFORMATIONS TECHNIQUES -->
                <div class="artwork-specs">
                    <h3>Caractéristiques</h3>
                    <ul>
                        <?php if($data['item']['poids']): ?>
                        <li><strong>Poids :</strong> <?= $data['item']['poids'] ?> kg</li>
                        <?php endif; ?>
                        <?php if($data['item']['categorie_id']): ?>
                        <li><strong>Catégorie :</strong> 
                            <?php 
                            switch($data['item']['categorie_id']) {
                                case 1: echo "Peinture"; break;
                                case 2: echo "Print"; break;
                                case 3: echo "Asset 3D"; break;
                                case 4: echo "Peinture à l'huile"; break;
                                case 5: echo "Aquarelle"; break;
                                default: echo "Non catégorisé";
                            }
                            ?>
                        </li>
                        <?php endif; ?>
                        <li><strong>Référence :</strong> <?= htmlspecialchars($data['item']['slug']) ?></li>
                    </ul>
                </div>

                <div class="artwork-description">
                    <h3 class="description-title">Description</h3>
                    <div class="description-text">
                        <?= nl2br(htmlspecialchars($data['item']['description'])) ?>
                    </div>
                </div>

                <!-- ACTIONS SUPPLÉMENTAIRES -->
                <div class="artwork-actions">
                    <button class="btn-wishlist">
                        <i class="far fa-heart"></i>
                        Ajouter aux favoris
                    </button>
                    <button class="btn-share">
                        <i class="fas fa-share"></i>
                        Partager
                    </button>
                </div>
            </div>
        </div>
    </div>
</section>

<!-- CSS pour le style -->
<style>
.artwork-status {
    margin: 20px 0;
}

.status-badge {
    padding: 8px 16px;
    border-radius: 20px;
    font-weight: bold;
    text-transform: uppercase;
    font-size: 0.9rem;
}

.status-badge.available {
    background: #d4edda;
    color: #155724;
}

.status-badge.out-of-stock {
    background: #f8d7da;
    color: #721c24;
}

.status-badge.unavailable {
    background: #fff3cd;
    color: #856404;
}

.stock-warning {
    color: #dc3545;
    font-weight: bold;
    margin-left: 10px;
}

.add-to-cart-section {
    background: #f8f9fa;
    padding: 25px;
    border-radius: 10px;
    margin: 30px 0;
}

.quantity-selector {
    margin-bottom: 20px;
}

.quantity-selector label {
    display: block;
    margin-bottom: 10px;
    font-weight: bold;
}

.quantity-controls {
    display: flex;
    align-items: center;
    gap: 0;
    width: fit-content;
}

.qty-btn {
    background: #6c757d;
    color: white;
    border: none;
    width: 40px;
    height: 40px;
    cursor: pointer;
    font-size: 1.2rem;
    display: flex;
    align-items: center;
    justify-content: center;
}

.qty-btn:first-child {
    border-radius: 5px 0 0 5px;
}

.qty-btn:last-child {
    border-radius: 0 5px 5px 0;
}

.qty-btn:hover {
    background: #5a6268;
}

.qty-input {
    width: 60px;
    height: 40px;
    text-align: center;
    border: 1px solid #ced4da;
    border-left: none;
    border-right: none;
    font-size: 1rem;
}

.btn-add-to-cart {
    background: #007bff;
    color: white;
    border: none;
    padding: 15px 30px;
    border-radius: 5px;
    font-size: 1.1rem;
    cursor: pointer;
    width: 100%;
    display: flex;
    align-items: center;
    justify-content: center;
    gap: 10px;
    transition: background 0.3s;
}

.btn-add-to-cart:hover {
    background: #0056b3;
}

.artwork-specs {
    margin: 30px 0;
}

.artwork-specs ul {
    list-style: none;
    padding: 0;
}

.artwork-specs li {
    padding: 5px 0;
    border-bottom: 1px solid #eee;
}

.artwork-actions {
    margin-top: 30px;
    display: flex;
    gap: 15px;
}

.btn-wishlist, .btn-share {
    background: #f8f9fa;
    border: 1px solid #dee2e6;
    padding: 10px 20px;
    border-radius: 5px;
    cursor: pointer;
    display: flex;
    align-items: center;
    gap: 8px;
    transition: all 0.3s;
}

.btn-wishlist:hover, .btn-share:hover {
    background: #e9ecef;
    transform: translateY(-1px);
}
</style>

<script>
// JavaScript pour les contrôles de quantité
document.addEventListener('DOMContentLoaded', function() {
    const qtyInput = document.getElementById('quantity');
    const qtyBtns = document.querySelectorAll('.qty-btn');
    
    qtyBtns.forEach(btn => {
        btn.addEventListener('click', function() {
            const action = this.dataset.action;
            const currentValue = parseInt(qtyInput.value) || 1;
            const max = parseInt(qtyInput.max) || 999;
            
            if (action === 'increase' && currentValue < max) {
                qtyInput.value = currentValue + 1;
            } else if (action === 'decrease' && currentValue > 1) {
                qtyInput.value = currentValue - 1;
            }
        });
    });
    
    // Validation de la saisie manuelle
    qtyInput.addEventListener('change', function() {
        const value = parseInt(this.value) || 1;
        const max = parseInt(this.max) || 999;
        
        if (value < 1) this.value = 1;
        if (value > max) this.value = max;
    });
});

// Galerie d'images
const thumbnails = document.querySelectorAll('.thumbnail');
const mainImage = document.getElementById('mainImage');
thumbnails.forEach(th => {
    th.addEventListener('click', () => {
        thumbnails.forEach(t => t.classList.remove('active'));
        th.classList.add('active');
        mainImage.src = th.dataset.img;
    });
});
</script>