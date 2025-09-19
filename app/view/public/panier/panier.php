<section class="hero">
    <div class="hero-content">
        <h1>Mon Panier</h1>
        <p>Finalisez votre commande d'œuvres d'art</p>
    </div>
</section>

<main>
    <section class="panier-container">
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
                <div class="panier-vide">
                    <div class="panier-vide-content">
                        <div class="panier-vide-icon">
                            <i class="fas fa-shopping-cart"></i>
                        </div>
                        <h2>Votre panier est vide</h2>
                        <p>Découvrez notre collection d'œuvres d'art uniques</p>
                        <a href="/catalogue" class="btn btn-primary btn-large">Parcourir le catalogue</a>
                    </div>
                </div>
            <?php else: ?>
                <div class="panier-content">
                    <div class="panier-liste">
                        <div class="panier-header">
                            <h2>Articles dans votre panier</h2>
                            <span class="panier-count"><?= $data['cart_count'] ?></span>
                        </div>

                        <?php foreach($data['cart_items'] as $item): ?>
                            <div class="panier-item">
                                <div class="item-image">
                                    <?php if($item['image_url']): ?>
                                        <img src="/uploads/item/<?= $item['slug'] ?>/<?= $item['image_url'] ?>"
                                             alt="<?= htmlspecialchars($item['nom']) ?>">
                                    <?php else: ?>
                                        <img src="/api/placeholder/150/150" alt="<?= htmlspecialchars($item['nom']) ?>">
                                    <?php endif; ?>
                                </div>
                                
                                <div class="item-details">
                                    <h3 class="item-title"><?= htmlspecialchars($item['nom']) ?></h3>
                                    <p class="item-price">
                                        <?php if($item['prix_promo']): ?>
                                            <span class="price-original">€ <?= number_format($item['prix'], 2, ',', ' ') ?></span>
                                            <span class="price-promo">€ <?= number_format($item['prix_promo'], 2, ',', ' ') ?></span>
                                        <?php else: ?>
                                            <span class="price-current">€ <?= number_format($item['unit_price'], 2, ',', ' ') ?></span>
                                        <?php endif; ?>
                                    </p>
                                </div>

                                <div class="item-quantity">
                                    <form action="/panier/update" method="POST" class="quantity-form">
                                        <input type="hidden" name="cart_line_id" value="<?= $item['cart_line_id'] ?>">
                                        <label>Quantité:</label>
                                        <input type="number" name="quantity" value="<?= $item['quantity'] ?>"
                                               min="1" max="10" class="qty-input">
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
                        
                        <div class="panier-actions">
                            <a href="/catalogue" class="btn btn-secondary">Continuer mes achats</a>
                            <form action="/panier/clear" method="POST" class="panier-clear-form">
                                <button type="submit" class="btn btn-danger"
                                        onclick="return confirm('Vider complètement le panier ?');">
                                    Vider le panier
                                </button>
                            </form>
                        </div>
                    </div>

                    <div class="summary-card">
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

                        <div class="summary-actions">
                            <a href="/panier/checkout" class="btn btn-primary btn-block">
                                Procéder au paiement
                            </a>
                        </div>

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
