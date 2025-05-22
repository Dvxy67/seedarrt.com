
        <header class="dashboard-header">
            <h2>Ajouter un nouvel item</h2>
            <div class="user-info">
                <div class="user-notifications">
                    <svg viewBox="0 0 24 24"><path d="M21,19V20H3V19L5,17V11C5,7.9 7.03,5.17 10,4.29C10,4.19 10,4.1 10,4A2,2 0 0,1 12,2A2,2 0 0,1 14,4C14,4.1 14,4.19 14,4.29C16.97,5.17 19,7.9 19,11V17L21,19M14,21A2,2 0 0,1 12,23A2,2 0 0,1 10,21" /></svg>
                    <span class="badge">3</span>
                </div>
                <div class="user-avatar">
                    <img src="/api/placeholder/40/40" alt="Avatar">
                </div>
                <span class="user-name">Seedart</span>
            </div>
        </header>
        
        <!-- CREATE ITEM FORM -->
        <section class="content-section">
            <div class="section-header">
                <h3>Informations de l'item</h3>
            </div>
            
            <form action="/admin/item/store" method="POST" class="form">
                <div class="form-row">
                    <div class="form-group half">
                        <label class="form-label">Nom</label>
                        <input type="text" name="nom" class="form-control" placeholder="Nom de l'item" required>
                    </div>
                    
                    <div class="form-group half">
                        <label class="form-label">Slug</label>
                        <input type="text" name="slug" class="form-control" placeholder="mon-item-slug" required>
                    </div>
                </div>
                
                <div class="form-group">
                    <label class="form-label">Description</label>
                    <textarea name="description" class="form-control" placeholder="Description détaillée de l'item..." rows="4"></textarea>
                </div>
                
                <div class="form-row">
                    <div class="form-group half">
                        <label class="form-label">Prix (€)</label>
                        <input type="number" step="0.01" name="prix" class="form-control" placeholder="0.00" required>
                    </div>
                    
                    <div class="form-group half">
                        <label class="form-label">Prix promo (€)</label>
                        <input type="number" step="0.01" name="prix_promo" class="form-control" placeholder="0.00">
                    </div>
                </div>
                
                <div class="form-row">
                    <div class="form-group half">
                        <label class="form-label">Quantité en stock</label>
                        <input type="number" name="quantite_stock" class="form-control" placeholder="0" required>
                    </div>
                    
                    <div class="form-group half">
                        <label class="form-label">ID de catégorie</label>
                        <input type="number" name="categorie_id" class="form-control" placeholder="ID de la catégorie">
                    </div>
                </div>
                
                <div class="form-row">
                    <div class="form-group half">
                        <label class="form-label">Statut</label>
                        <select name="statut" class="form-control">
                            <option value="actif">Actif</option>
                            <option value="inactif">Inactif</option>
                            <option value="en_promotion">En promotion</option>
                            <option value="rupture">Rupture</option>
                        </select>
                    </div>
                    
                    <div class="form-group half">
                        <label class="form-label">Poids (kg)</label>
                        <input type="number" step="0.001" name="poids" class="form-control" placeholder="0.000">
                    </div>
                </div>
                
                <div class="form-group">
                    <label class="form-label">Image (URL ou chemin relatif)</label>
                    <input type="text" name="image_url" class="form-control" placeholder="chemin/vers/image.jpg">
                </div>
                
                <div class="form-buttons">
                    <a href="/admin/item" class="btn-cancel">Annuler</a>
                    <button type="submit" class="btn-save">Enregistrer</button>
                </div>
            </form>
        </section>