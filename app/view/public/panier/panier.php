<section class="hero">
    <div class="hero-content">
        <h1>Mon Panier</h1>
        <p>Finalisez votre commande d'œuvres d'art</p>
    </div>
</section>

<main>
    <section class="cart-section">
        <div class="container">
            <?php if(isset($_SESSION['cart_message'])): ?>
                <div class="alert alert-success">
                    <?= htmlspecialchars($_SESSION['cart_message']) ?>
                    <?php unset($_SESSION['cart_message']); ?>
                </div>
            <?php endif; ?>
            
            <?php if(isset($_SESSION['cart_error'])): ?>
                <div class="alert alert-error">
                    <?= htmlspecialchars($_SESSION['cart_error']) ?>
                    <?php unset($_SESSION['cart_error']); ?>
                </div>
            <?php endif; ?>

            <?php if(empty($data['cart_items'])): ?>
                <div class="empty-cart">
                    <div class="empty-cart-icon">
                        <i class="fas fa-shopping-cart"></i>
                    </div>
                    <h2>Votre panier est vide</h2>
                    <p>Découvrez notre collection d'œuvres d'art uniques</p>
                    <a href="/catalogue" class="btn btn-primary">Parcourir le catalogue</a>
                </div>
            <?php else: ?>
                <div class="cart-content">
                    <div class="cart-items">
                        <h2>Articles dans votre panier (<?= $data['cart_count'] ?>)</h2>
                        
                        <?php foreach($data['cart_items'] as $item): ?>
                            <div class="cart-item">
                                <div class="item-image">
                                    <?php if($item['image_url']): ?>
                                        <img src="/uploads/item/<?= $item['slug'] ?>/<?= $item['image_url'] ?>" 
                                             alt="<?= htmlspecialchars($item['nom']) ?>">
                                    <?php else: ?>
                                        <img src="/api/placeholder/150/150" alt="<?= htmlspecialchars($item['nom']) ?>">
                                    <?php endif; ?>
                                </div>
                                
                                <div class="item-details">
                                    <h3><?= htmlspecialchars($item['nom']) ?></h3>
                                    <p class="item-price">
                                        <?php if($item['prix_promo']): ?>
                                            <span class="original-price">€ <?= number_format($item['prix'], 2, ',', ' ') ?></span>
                                            <span class="promo-price">€ <?= number_format($item['prix_promo'], 2, ',', ' ') ?></span>
                                        <?php else: ?>
                                            € <?= number_format($item['unit_price'], 2, ',', ' ') ?>
                                        <?php endif; ?>
                                    </p>
                                </div>
                                
                                <div class="item-quantity">
                                    <form action="/panier/update" method="POST" class="quantity-form">
                                        <input type="hidden" name="cart_line_id" value="<?= $item['cart_line_id'] ?>">
                                        <label>Quantité:</label>
                                        <input type="number" name="quantity" value="<?= $item['quantity'] ?>" 
                                               min="1" max="10" class="quantity-input">
                                        <button type="submit" class="btn-update">Mettre à jour</button>
                                    </form>
                                </div>
                                
                                <div class="item-subtotal">
                                    <p class="subtotal-label">Sous-total:</p>
                                    <p class="subtotal-price">€ <?= number_format($item['subtotal'], 2, ',', ' ') ?></p>
                                </div>
                                
                                <div class="item-actions">
                                    <form action="/panier/remove" method="POST">
                                        <input type="hidden" name="cart_line_id" value="<?= $item['cart_line_id'] ?>">
                                        <button type="submit" class="btn-remove" 
                                                onclick="return confirm('Supprimer cet article du panier ?');">
                                            <i class="fas fa-trash"></i>
                                        </button>
                                    </form>
                                </div>
                            </div>
                        <?php endforeach; ?>
                        
                        <div class="cart-actions">
                            <a href="/catalogue" class="btn btn-secondary">Continuer mes achats</a>
                            <form action="/panier/clear" method="POST" style="display: inline;">
                                <button type="submit" class="btn btn-danger" 
                                        onclick="return confirm('Vider complètement le panier ?');">
                                    Vider le panier
                                </button>
                            </form>
                        </div>
                    </div>
                    
                    <div class="cart-summary">
                        <h3>Résumé de la commande</h3>
                        
                        <div class="summary-line">
                            <span>Sous-total:</span>
                            <span>€ <?= number_format($data['total'], 2, ',', ' ') ?></span>
                        </div>
                        
                        <div class="summary-line">
                            <span>Frais de livraison:</span>
                            <span>Calculés à l'étape suivante</span>
                        </div>
                        
                        <div class="summary-total">
                            <span>Total:</span>
                            <span class="total-price">€ <?= number_format($data['total'], 2, ',', ' ') ?></span>
                        </div>
                        
                        <a href="/panier/checkout" class="btn btn-primary btn-block">
                            Procéder au paiement
                        </a>
                        
                        <div class="payment-methods">
                            <p>Moyens de paiement acceptés:</p>
                            <div class="payment-icons">
                                <i class="fab fa-cc-visa"></i>
                                <i class="fab fa-cc-mastercard"></i>
                                <i class="fab fa-cc-paypal"></i>
                                <i class="fab fa-cc-stripe"></i>
                            </div>
                        </div>
                        
                        <div class="security-info">
                            <i class="fas fa-lock"></i>
                            <p>Paiement 100% sécurisé</p>
                        </div>
                    </div>
                </div>
            <?php endif; ?>
        </div>
    </section>
</main>

<style>
.cart-section {
    padding: 60px 0;
    min-height: 500px;
}

.alert {
    padding: 15px;
    margin-bottom: 20px;
    border-radius: 4px;
}

.alert-success {
    background-color: #d4edda;
    border: 1px solid #c3e6cb;
    color: #155724;
}

.alert-error {
    background-color: #f8d7da;
    border: 1px solid #f5c6cb;
    color: #721c24;
}

.empty-cart {
    text-align: center;
    padding: 80px 20px;
}

.empty-cart-icon {
    font-size: 100px;
    color: #ddd;
    margin-bottom: 30px;
}

.empty-cart h2 {
    font-size: 2rem;
    margin-bottom: 15px;
}

.cart-content {
    display: grid;
    grid-template-columns: 1fr 400px;
    gap: 40px;
}

.cart-item {
    display: grid;
    grid-template-columns: 150px 1fr auto auto auto;
    gap: 20px;
    padding: 20px;
    background: white;
    border: 1px solid #eee;
    border-radius: 8px;
    margin-bottom: 20px;
    align-items: center;
}

.item-image img {
    width: 100%;
    border-radius: 4px;
}

.item-details h3 {
    font-size: 1.2rem;
    margin-bottom: 10px;
}

.original-price {
    text-decoration: line-through;
    color: #999;
}

.promo-price {
    color: #e74c3c;
    font-weight: bold;
}

.quantity-input {
    width: 60px;
    padding: 5px;
    margin: 0 10px;
}

.btn-update {
    background: #4CAF50;
    color: white;
    border: none;
    padding: 5px 15px;
    border-radius: 4px;
    cursor: pointer;
}

.btn-remove {
    background: #e74c3c;
    color: white;
    border: none;
    padding: 10px;
    border-radius: 4px;
    cursor: pointer;
}

.cart-summary {
    background: #f8f9fa;
    padding: 30px;
    border-radius: 8px;
    position: sticky;
    top: 20px;
}

.summary-line {
    display: flex;
    justify-content: space-between;
    margin-bottom: 15px;
    padding-bottom: 15px;
    border-bottom: 1px solid #dee2e6;
}

.summary-total {
    display: flex;
    justify-content: space-between;
    font-size: 1.3rem;
    font-weight: bold;
    margin: 20px 0;
}

.btn-block {
    width: 100%;
    padding: 15px;
    font-size: 1.1rem;
}

.payment-methods {
    margin-top: 30px;
    text-align: center;
}

.payment-icons {
    display: flex;
    justify-content: center;
    gap: 15px;
    font-size: 2rem;
    color: #666;
    margin-top: 10px;
}

.security-info {
    display: flex;
    align-items: center;
    justify-content: center;
    gap: 10px;
    margin-top: 20px;
    color: #28a745;
}

@media (max-width: 1024px) {
    .cart-content {
        grid-template-columns: 1fr;
    }
    
    .cart-summary {
        position: relative;
    }
    
    .cart-item {
        grid-template-columns: 100px 1fr;
    }
}
</style>