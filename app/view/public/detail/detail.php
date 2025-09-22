
<!-- Breadcrumb -->
<section class="breadcrumb">
    <div class="container">
        <ul>
            <li><a href="/home">Accueil</a></li>
            <li><a href="/catalogue">Catalogue</a></li>
            <li><?= htmlspecialchars($data['item']['nom']) ?></li>
        </ul>
    </div>
</section>

<!-- Section détail de l'œuvre -->
<section class="artwork-detail">
    <div class="container">
        <div class="artwork-container">
            <!-- Galerie d'images -->
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

            <!-- Informations de l'œuvre -->
            <div class="artwork-info">
                <h1 class="artwork-title"><?= htmlspecialchars($data['item']['nom']) ?></h1>
                
                <!-- Prix harmonisé -->
                <div class="artwork-price">
                    <?php if($data['item']['prix_promo']): ?>
                        <span class="original-price">€ <?= number_format($data['item']['prix'], 2, ',', ' ') ?></span>
                        <span class="promo-price">€ <?= number_format($data['item']['prix_promo'], 2, ',', ' ') ?></span>
                    <?php else: ?>
                        € <?= number_format($data['item']['prix'], 2, ',', ' ') ?>
                    <?php endif; ?>
                </div>

                <!-- Statut et disponibilité harmonisés -->
                <div class="artwork-status">
                    <?php if($data['item']['statut'] == 'rupture' || $data['item']['quantite_stock'] <= 0): ?>
                        <span class="status-badge out-of-stock">
                            <i class="fas fa-times-circle"></i>
                            Rupture de stock
                        </span>
                    <?php elseif($data['item']['statut'] == 'inactif'): ?>
                        <span class="status-badge unavailable">
                            <i class="fas fa-pause-circle"></i>
                            Non disponible
                        </span>
                    <?php else: ?>
                        <span class="status-badge available">
                            <i class="fas fa-check-circle"></i>
                            Disponible
                        </span>
                        <?php if($data['item']['quantite_stock'] <= 5): ?>
                            <span class="stock-warning">
                                <i class="fas fa-exclamation-triangle"></i>
                                Plus que <?= $data['item']['quantite_stock'] ?> en stock !
                            </span>
                        <?php endif; ?>
                    <?php endif; ?>
                </div>

                <!-- Formulaire d'ajout au panier harmonisé -->
                <?php if($data['item']['statut'] != 'rupture' && $data['item']['statut'] != 'inactif' && $data['item']['quantite_stock'] > 0): ?>
                <div class="add-to-cart-section">
                    <form action="/panier/add" method="POST" class="add-to-cart-form">
                        <input type="hidden" name="item_id" value="<?= $data['item']['id_item'] ?>">
                        
                        <div class="quantity-selector">
                            <label for="quantity">Quantité :</label>
                            <div class="quantity-controls">
                                <button type="button" class="qty-btn" data-action="decrease">
                                    <i class="fas fa-minus"></i>
                                </button>
                                <input type="number" id="quantity" name="quantity" value="1" 
                                       min="1" max="<?= $data['item']['quantite_stock'] ?>" class="qty-input">
                                <button type="button" class="qty-btn" data-action="increase">
                                    <i class="fas fa-plus"></i>
                                </button>
                            </div>
                        </div>
                        
                        <button type="submit" class="btn-add-to-cart">
                            <i class="fas fa-shopping-cart"></i>
                            Ajouter au panier
                        </button>
                    </form>
                </div>
                <?php endif; ?>

                <!-- Caractéristiques harmonisées -->
                <div class="artwork-specs">
                    <h3>Caractéristiques</h3>
                    <ul>
                        <?php if($data['item']['poids']): ?>
                        <li>
                            <strong>Poids :</strong> 
                            <span><?= $data['item']['poids'] ?> kg</span>
                        </li>
                        <?php endif; ?>
                        <?php if($data['item']['categorie_id']): ?>
                        <li>
                            <strong>Catégorie :</strong> 
                            <span>
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
                            </span>
                        </li>
                        <?php endif; ?>
                        <li>
                            <strong>Référence :</strong> 
                            <span><?= htmlspecialchars($data['item']['slug']) ?></span>
                        </li>
                    </ul>
                </div>

                <!-- Description harmonisée -->
                <div class="artwork-description">
                    <h3 class="description-title">Description</h3>
                    <div class="description-text">
                        <?= nl2br(htmlspecialchars($data['item']['description'])) ?>
                    </div>
                </div>

                <!-- Actions harmonisées -->
                <div class="artwork-actions">
                    <button class="btn-wishlist">
                        <i class="far fa-heart"></i>
                        <span>Ajouter aux favoris</span>
                    </button>
                    <button class="btn-share">
                        <i class="fas fa-share-alt"></i>
                        <span>Partager</span>
                    </button>
                </div>
            </div>
        </div>
    </div>
</section>

<script>

document.addEventListener('DOMContentLoaded', function() {
    
    // ===== CONTRÔLES DE QUANTITÉ AMÉLIORÉS =====
    const qtyInput = document.getElementById('quantity');
    const qtyBtns = document.querySelectorAll('.qty-btn');
    
    if (qtyInput && qtyBtns.length > 0) {
        qtyBtns.forEach(btn => {
            btn.addEventListener('click', function() {
                const action = this.dataset.action;
                const currentValue = parseInt(qtyInput.value) || 1;
                const max = parseInt(qtyInput.max) || 999;
                const min = parseInt(qtyInput.min) || 1;
                
                if (action === 'increase' && currentValue < max) {
                    qtyInput.value = currentValue + 1;
                    // Animation de feedback
                    this.style.transform = 'scale(0.9)';
                    setTimeout(() => this.style.transform = '', 150);
                } else if (action === 'decrease' && currentValue > min) {
                    qtyInput.value = currentValue - 1;
                    // Animation de feedback
                    this.style.transform = 'scale(0.9)';
                    setTimeout(() => this.style.transform = '', 150);
                }
                
                // Mise à jour du prix total si nécessaire
                updateTotalPrice();
            });
        });
        
        // Validation de la saisie manuelle avec feedback visuel
        qtyInput.addEventListener('input', function() {
            const value = parseInt(this.value) || 1;
            const max = parseInt(this.max) || 999;
            const min = parseInt(this.min) || 1;
            
            if (value < min) {
                this.value = min;
                showFeedback('La quantité minimum est ' + min, 'warning');
            } else if (value > max) {
                this.value = max;
                showFeedback('Stock disponible : ' + max + ' unités', 'warning');
            }
            
            updateTotalPrice();
        });
        
        // Animation focus sur l'input
        qtyInput.addEventListener('focus', function() {
            this.parentElement.style.boxShadow = '0 0 0 3px rgba(27, 77, 77, 0.2)';
        });
        
        qtyInput.addEventListener('blur', function() {
            this.parentElement.style.boxShadow = '';
        });
    }

    // ===== GALERIE D'IMAGES AMÉLIORÉE =====
    const thumbnails = document.querySelectorAll('.thumbnail');
    const mainImage = document.getElementById('mainImage');
    
    if (thumbnails.length > 0 && mainImage) {
        thumbnails.forEach(thumbnail => {
            thumbnail.addEventListener('click', function() {
                // Retirer la classe active de toutes les miniatures
                thumbnails.forEach(t => t.classList.remove('active'));
                
                // Ajouter la classe active à la miniature cliquée
                this.classList.add('active');
                
                // Effet de transition sur l'image principale
                mainImage.style.opacity = '0.7';
                mainImage.style.transform = 'scale(0.98)';
                
                setTimeout(() => {
                    mainImage.src = this.dataset.img;
                    mainImage.style.opacity = '1';
                    mainImage.style.transform = 'scale(1)';
                }, 200);
            });
        });
    }

    // ===== GESTION DU FORMULAIRE D'AJOUT AU PANIER =====
    const addToCartForm = document.querySelector('.add-to-cart-form');
    const addToCartBtn = document.querySelector('.btn-add-to-cart');
    
    if (addToCartForm && addToCartBtn) {
        addToCartForm.addEventListener('submit', function(e) {
            e.preventDefault();
            
            // Animation du bouton
            const originalText = addToCartBtn.innerHTML;
            addToCartBtn.innerHTML = '<i class="fas fa-spinner fa-spin"></i> Ajout en cours...';
            addToCartBtn.disabled = true;
            
            // Simulation d'ajout (remplacez par votre logique AJAX)
            setTimeout(() => {
                // Succès
                addToCartBtn.innerHTML = '<i class="fas fa-check"></i> Ajouté au panier !';
                addToCartBtn.style.background = 'linear-gradient(135deg, #28a745 0%, #20c997 100%)';
                
                setTimeout(() => {
                    addToCartBtn.innerHTML = originalText;
                    addToCartBtn.disabled = false;
                    addToCartBtn.style.background = '';
                }, 2000);
                
                // Soumission réelle du formulaire
                // this.submit(); // Décommentez pour la soumission réelle
                
            }, 1000);
        });
    }

    // ===== EFFETS DE RIPPLE SUR LES BOUTONS =====
    function createRipple(event) {
        const button = event.currentTarget;
        const rect = button.getBoundingClientRect();
        const size = Math.max(rect.height, rect.width);
        const x = event.clientX - rect.left - size / 2;
        const y = event.clientY - rect.top - size / 2;
        
        const ripple = document.createElement('span');
        ripple.style.cssText = `
            position: absolute;
            border-radius: 50%;
            background: rgba(255, 255, 255, 0.3);
            transform: scale(0);
            animation: ripple 0.6s linear;
            width: ${size}px;
            height: ${size}px;
            left: ${x}px;
            top: ${y}px;
            pointer-events: none;
        `;
        
        button.appendChild(ripple);
        
        setTimeout(() => {
            ripple.remove();
        }, 600);
    }
    
    // Application de l'effet ripple à tous les boutons
    document.querySelectorAll('.btn-add-to-cart, .qty-btn, .btn-wishlist, .btn-share').forEach(btn => {
        btn.addEventListener('click', createRipple);
    });

    // ===== GESTION DES FAVORIS =====
    const wishlistBtn = document.querySelector('.btn-wishlist');
    
    if (wishlistBtn) {
        wishlistBtn.addEventListener('click', function() {
            const icon = this.querySelector('i');
            const text = this.querySelector('span');
            const isWishlisted = this.classList.contains('wishlisted');
            
            if (isWishlisted) {
                // Retirer des favoris
                icon.className = 'far fa-heart';
                text.textContent = 'Ajouter aux favoris';
                this.classList.remove('wishlisted');
                this.style.color = '#666';
                showFeedback('Retiré des favoris', 'info');
            } else {
                // Ajouter aux favoris
                icon.className = 'fas fa-heart';
                text.textContent = 'Dans vos favoris';
                this.classList.add('wishlisted');
                this.style.color = '#1B4D4D';
                
                // Animation de coeur
                icon.style.transform = 'scale(1.3)';
                icon.style.color = '#e74c3c';
                setTimeout(() => {
                    icon.style.transform = 'scale(1)';
                    icon.style.color = '';
                }, 300);
                
                showFeedback('Ajouté aux favoris', 'success');
            }
        });
    }

    // ===== PARTAGE =====
    const shareBtn = document.querySelector('.btn-share');
    
    if (shareBtn) {
        shareBtn.addEventListener('click', function() {
            if (navigator.share) {
                navigator.share({
                    title: document.title,
                    url: window.location.href
                });
            } else {
                // Fallback : copier l'URL
                navigator.clipboard.writeText(window.location.href).then(() => {
                    showFeedback('Lien copié dans le presse-papier', 'success');
                });
            }
        });
    }

    // ===== FONCTION DE FEEDBACK =====
    function showFeedback(message, type = 'info') {
        const feedback = document.createElement('div');
        feedback.className = `feedback feedback-${type}`;
        feedback.textContent = message;
        feedback.style.cssText = `
            position: fixed;
            top: 20px;
            right: 20px;
            padding: 12px 20px;
            border-radius: 8px;
            color: white;
            font-family: 'Montserrat', sans-serif;
            font-size: 14px;
            font-weight: 500;
            z-index: 10000;
            transform: translateX(100%);
            transition: transform 0.3s ease;
            box-shadow: 0 4px 12px rgba(0, 0, 0, 0.15);
        `;
        
        // Couleurs selon le type
        const colors = {
            success: 'linear-gradient(135deg, #28a745, #20c997)',
            warning: 'linear-gradient(135deg, #ffc107, #fd7e14)',
            error: 'linear-gradient(135deg, #dc3545, #e83e8c)',
            info: 'linear-gradient(135deg, #1B4D4D, #2A7373)'
        };
        
        feedback.style.background = colors[type] || colors.info;
        
        document.body.appendChild(feedback);
        
        // Animation d'entrée
        setTimeout(() => {
            feedback.style.transform = 'translateX(0)';
        }, 100);
        
        // Animation de sortie
        setTimeout(() => {
            feedback.style.transform = 'translateX(100%)';
            setTimeout(() => feedback.remove(), 300);
        }, 3000);
    }

    // ===== MISE À JOUR DU PRIX TOTAL =====
    function updateTotalPrice() {
        // Cette fonction peut être étendue pour calculer le prix total
        // basé sur la quantité sélectionnée
    }
});

// ===== CSS POUR LES ANIMATIONS =====
const style = document.createElement('style');
style.textContent = `
    @keyframes ripple {
        to {
            transform: scale(4);
            opacity: 0;
        }
    }
    
    .qty-input {
        transition: all 0.3s ease;
    }
    
    .main-image img {
        transition: all 0.3s ease;
    }
    
    .btn-wishlist.wishlisted {
        background-color: rgba(27, 77, 77, 0.05) !important;
        border-color: #1B4D4D !important;
    }
`;
document.head.appendChild(style);

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