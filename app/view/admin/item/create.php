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

<?php if (isset($data['errors']) && !empty($data['errors'])): ?>
    <div class="alert alert-error">
        <ul style="margin: 0; padding-left: 20px;">
            <?php foreach ($data['errors'] as $error): ?>
                <li><?= htmlspecialchars($error) ?></li>
            <?php endforeach; ?>
        </ul>
    </div>
<?php endif; ?>

<section class="content-section">
    <div class="section-header">
        <h3>Informations de l'item</h3>
    </div>
    
    <form action="/admin/item/store" method="POST" class="form" enctype="multipart/form-data">
        <div class="form-row">
            <div class="form-group half">
                <label class="form-label">Nom *</label>
                <input type="text" name="nom" class="form-control" placeholder="Nom de l'item" required
                       value="<?= htmlspecialchars($data['data']['nom'] ?? '') ?>">
            </div>
            
            <div class="form-group half">
                <label class="form-label">Slug *</label>
                <input type="text" name="slug" class="form-control" placeholder="mon-item-slug" required
                       value="<?= htmlspecialchars($data['data']['slug'] ?? '') ?>">
                <small class="form-help">Utilisé dans les URLs. Lettres, chiffres et tirets uniquement.</small>
            </div>
        </div>
        
        <div class="form-group">
            <label class="form-label">Description</label>
            <textarea name="description" class="form-control" placeholder="Description détaillée de l'item..." rows="4"><?= htmlspecialchars($data['data']['description'] ?? '') ?></textarea>
        </div>
        
        <div class="form-row">
            <div class="form-group half">
                <label class="form-label">Prix (€) *</label>
                <input type="number" step="0.01" name="prix" class="form-control" placeholder="0.00" required
                       value="<?= htmlspecialchars($data['data']['prix'] ?? '') ?>">
            </div>
            
            <div class="form-group half">
                <label class="form-label">Prix promo (€)</label>
                <input type="number" step="0.01" name="prix_promo" class="form-control" placeholder="0.00"
                       value="<?= htmlspecialchars($data['data']['prix_promo'] ?? '') ?>">
            </div>
        </div>
        
        <div class="form-row">
            <div class="form-group half">
                <label class="form-label">Quantité en stock</label>
                <input type="number" name="quantite_stock" class="form-control" placeholder="0" min="0"
                       value="<?= htmlspecialchars($data['data']['quantite_stock'] ?? '0') ?>">
            </div>
            
            <div class="form-group half">
                <label class="form-label">Catégorie</label>
                <select name="categorie_id" class="form-control">
                    <option value="">Sélectionner une catégorie</option>
                    <?php if (isset($data['categories'])): ?>
                        <?php foreach($data['categories'] as $categorie): ?>
                            <option value="<?= $categorie['id_categorie'] ?>" 
                                    <?= (isset($data['data']['categorie_id']) && $data['data']['categorie_id'] == $categorie['id_categorie']) ? 'selected' : '' ?>>
                                <?= htmlspecialchars($categorie['nom']) ?>
                            </option>
                        <?php endforeach; ?>
                    <?php endif; ?>
                </select>
            </div>
        </div>
        
        <div class="form-row">
            <div class="form-group half">
                <label class="form-label">Statut</label>
                <select name="statut" class="form-control">
                    <option value="actif" <?= (!isset($data['data']['statut']) || $data['data']['statut'] == 'actif') ? 'selected' : '' ?>>Actif</option>
                    <option value="inactif" <?= (isset($data['data']['statut']) && $data['data']['statut'] == 'inactif') ? 'selected' : '' ?>>Inactif</option>
                    <option value="en_promotion" <?= (isset($data['data']['statut']) && $data['data']['statut'] == 'en_promotion') ? 'selected' : '' ?>>En promotion</option>
                    <option value="rupture" <?= (isset($data['data']['statut']) && $data['data']['statut'] == 'rupture') ? 'selected' : '' ?>>Rupture</option>
                </select>
            </div>
            
            <div class="form-group half">
                <label class="form-label">Poids (kg)</label>
                <input type="number" step="0.001" name="poids" class="form-control" placeholder="0.000"
                       value="<?= htmlspecialchars($data['data']['poids'] ?? '') ?>">
            </div>
        </div>
        
        <div class="form-group">
            <label class="form-label">Image</label>
            <div class="image-upload-section">
                <div class="upload-options">
                    <input type="file" id="image-file" name="image_file" accept="image/*" class="file-input">
                    <label for="image-file" class="file-label">
                        <svg viewBox="0 0 24 24" width="20" height="20">
                            <path d="M14,2H6A2,2 0 0,0 4,4V20A2,2 0 0,0 6,22H18A2,2 0 0,0 20,20V8L14,2M18,20H6V4H13V9H18V20Z" />
                        </svg>
                        Choisir un fichier
                    </label>
                    <span class="upload-separator">ou</span>
                    <input type="text" name="image_url" class="form-control" placeholder="URL de l'image"
                           value="<?= htmlspecialchars($data['data']['image_url'] ?? '') ?>">
                </div>
                <div id="image-preview" class="image-preview"></div>
            </div>
        </div>
        
        <div class="form-buttons">
            <a href="/admin/item" class="btn-cancel">Annuler</a>
            <button type="submit" class="btn-save">Enregistrer</button>
        </div>
    </form>
</section>

<script>
document.addEventListener('DOMContentLoaded', function() {
    // Auto-génération du slug basé sur le nom (seulement en création)
    const nomInput = document.querySelector('input[name="nom"]');
    const slugInput = document.querySelector('input[name="slug"]');
    
    nomInput.addEventListener('input', function(e) {
        // Ne pas auto-générer si le slug a déjà été modifié manuellement
        if (slugInput.dataset.modified !== 'true') {
            const nom = e.target.value;
            const slug = nom.toLowerCase()
                .normalize('NFD').replace(/[\u0300-\u036f]/g, '') // Supprime les accents
                .replace(/[^a-z0-9\s-]/g, '') // Supprime les caractères spéciaux
                .replace(/\s+/g, '-') // Remplace les espaces par des tirets
                .replace(/-+/g, '-') // Supprime les tirets multiples
                .replace(/^-|-$/g, ''); // Supprime les tirets en début/fin
            
            slugInput.value = slug;
        }
    });
    
    // Marquer le slug comme modifié manuellement
    slugInput.addEventListener('input', function() {
        this.dataset.modified = 'true';
    });
    
    // Prévisualisation d'image
    const fileInput = document.getElementById('image-file');
    const urlInput = document.querySelector('input[name="image_url"]');
    const preview = document.getElementById('image-preview');
    
    fileInput.addEventListener('change', function(e) {
        const file = e.target.files[0];
        if (file) {
            const reader = new FileReader();
            reader.onload = function(e) {
                preview.innerHTML = `<img src="${e.target.result}" alt="Prévisualisation" style="max-width: 300px; max-height: 200px; object-fit: contain;">`;
            };
            reader.readAsDataURL(file);
            urlInput.value = ''; // Vider l'URL si un fichier est choisi
        }
    });
    
    urlInput.addEventListener('input', function(e) {
        const url = e.target.value.trim();
        if (url) {
            preview.innerHTML = `<img src="${url}" alt="Prévisualisation" style="max-width: 300px; max-height: 200px; object-fit: contain;" onerror="this.style.display='none'">`;
            fileInput.value = ''; // Vider le fichier si une URL est saisie
        } else {
            preview.innerHTML = '';
        }
    });
    
    // Validation du prix promo
    const prixInput = document.querySelector('input[name="prix"]');
    const promoInput = document.querySelector('input[name="prix_promo"]');
    
    promoInput.addEventListener('input', function() {
        const prix = parseFloat(prixInput.value) || 0;
        const promo = parseFloat(this.value) || 0;
        
        if (promo > prix && prix > 0) {
            alert('Le prix promo ne peut pas être supérieur au prix normal');
            this.value = '';
        }
    });
});
</script>

<style>
.alert-error {
    background-color: #f8d7da;
    border: 1px solid #f5c6cb;
    color: #721c24;
    padding: 15px;
    margin-bottom: 20px;
    border-radius: 4px;
    font-weight: bold;
}

.form-help {
    display: block;
    margin-top: 4px;
    color: #666;
    font-size: 0.875rem;
}

.image-upload-section {
    background: #f8f9fa;
    padding: 20px;
    border-radius: 8px;
    border: 2px dashed #dee2e6;
}

.upload-options {
    display: flex;
    align-items: center;
    gap: 15px;
    margin-bottom: 15px;
}

.file-input {
    display: none;
}

.file-label {
    background: #007bff;
    color: white;
    padding: 10px 20px;
    border-radius: 4px;
    cursor: pointer;
    display: flex;
    align-items: center;
    gap: 8px;
    transition: background 0.3s;
}

.file-label:hover {
    background: #0056b3;
}

.upload-separator {
    color: #666;
    font-weight: bold;
}

.image-preview {
    text-align: center;
    margin-top: 15px;
}

.image-preview img {
    border: 1px solid #ddd;
    border-radius: 4px;
    box-shadow: 0 2px 4px rgba(0,0,0,0.1);
}
</style>