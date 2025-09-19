<?php 
// Déterminer si on est en mode création ou modification
$isEdit = isset($data['categorie']) && !empty($data['categorie']);
$categorie = $isEdit ? $data['categorie'] : null;
$formData = isset($data['data']) ? $data['data'] : $categorie; // Pour conserver les données en cas d'erreur
?>
<header class="dashboard-header">
    <h2><?= $isEdit ? 'Modifier la catégorie' : 'Ajouter une nouvelle catégorie' ?></h2>
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
        <h3>Informations de la catégorie</h3>
    </div>
    
    <form action="/admin/categorie/<?= $isEdit ? 'update/'.$categorie['id_categorie'] : 'store' ?>" method="POST" class="form">
        <div class="form-row">
            <div class="form-group half">
                <label class="form-label">Nom *</label>
                <input type="text" name="nom" class="form-control" placeholder="Nom de la catégorie" required 
                       value="<?= htmlspecialchars($formData['nom'] ?? '') ?>">
            </div>
            
            <div class="form-group half">
                <label class="form-label">Slug *</label>
                <input type="text" name="slug" class="form-control" placeholder="slug-de-la-categorie" required 
                       value="<?= htmlspecialchars($formData['slug'] ?? '') ?>">
                <small class="form-help">Utilisé dans les URLs. Lettres, chiffres et tirets uniquement.</small>
            </div>
        </div>
        
        <div class="form-group">
            <label class="form-label">Description</label>
            <textarea name="description" class="form-control" placeholder="Description de la catégorie..." rows="4"><?= htmlspecialchars($formData['description'] ?? '') ?></textarea>
        </div>
        
        <div class="form-row">
            <div class="form-group half">
                <label class="form-label">Catégorie parente</label>
                <select name="parent_id" class="form-control">
                    <option value="">Catégorie principale</option>
                    <?php if (isset($data['parentCategories'])): ?>
                        <?php foreach($data['parentCategories'] as $parent): ?>
                            <?php if (!$isEdit || $parent['id_categorie'] != $categorie['id_categorie']): ?>
                                <option value="<?= $parent['id_categorie'] ?>" 
                                        <?= (isset($formData['parent_id']) && $formData['parent_id'] == $parent['id_categorie']) ? 'selected' : '' ?>>
                                    <?= htmlspecialchars($parent['nom']) ?>
                                </option>
                            <?php endif; ?>
                        <?php endforeach; ?>
                    <?php endif; ?>
                </select>
            </div>
            
            <div class="form-group half">
                <label class="form-label">Ordre d'affichage</label>
                <input type="number" name="ordre" class="form-control" placeholder="0" min="0"
                       value="<?= htmlspecialchars($formData['ordre'] ?? '0') ?>">
                <small class="form-help">Plus le nombre est petit, plus la catégorie apparaîtra en premier.</small>
            </div>
        </div>
        
        <div class="form-row">
            <div class="form-group half">
                <label class="form-label">Image de la catégorie</label>
                <input type="text" name="image_url" class="form-control" 
                       placeholder="chemin/vers/image-categorie.jpg"
                       value="<?= htmlspecialchars($formData['image_url'] ?? '') ?>">
            </div>
            
            <div class="form-group half">
                <label class="form-label">Visibilité</label>
                <select name="visible" class="form-control">
                    <option value="1" <?= (!isset($formData['visible']) || $formData['visible'] == 1) ? 'selected' : '' ?>>Visible</option>
                    <option value="0" <?= (isset($formData['visible']) && $formData['visible'] == 0) ? 'selected' : '' ?>>Cachée</option>
                </select>
            </div>
        </div>
        
        <div class="form-buttons">
            <a href="/admin/categorie" class="btn-cancel">Annuler</a>
            <button type="submit" class="btn-save">
                <?= $isEdit ? 'Mettre à jour' : 'Créer la catégorie' ?>
            </button>
        </div>
    </form>
</section>

<script>
document.addEventListener('DOMContentLoaded', function() {
    // Auto-génération du slug basé sur le nom
    const nomInput = document.querySelector('input[name="nom"]');
    const slugInput = document.querySelector('input[name="slug"]');
    
    <?php if (!$isEdit): ?>
    nomInput.addEventListener('input', function(e) {
        const nom = e.target.value;
        const slug = nom.toLowerCase()
            .normalize('NFD').replace(/[\u0300-\u036f]/g, '') // Supprime les accents
            .replace(/[^a-z0-9\s-]/g, '') // Supprime les caractères spéciaux
            .replace(/\s+/g, '-') // Remplace les espaces par des tirets
            .replace(/-+/g, '-') // Supprime les tirets multiples
            .replace(/^-|-$/g, ''); // Supprime les tirets en début/fin
        
        slugInput.value = slug;
    });
    <?php endif; ?>
    
    // Validation du slug
    slugInput.addEventListener('input', function(e) {
        const value = e.target.value;
        // Supprimer les caractères non autorisés
        const cleanValue = value.toLowerCase().replace(/[^a-z0-9-]/g, '');
        if (value !== cleanValue) {
            e.target.value = cleanValue;
        }
    });
});
</script>

<style>
.alert {
    padding: 15px;
    margin-bottom: 20px;
    border-radius: 4px;
    font-weight: bold;
}

.alert-error {
    background-color: #f8d7da;
    border: 1px solid #f5c6cb;
    color: #721c24;
}

.alert-error ul {
    margin: 0;
    padding-left: 20px;
}

.form-help {
    display: block;
    margin-top: 4px;
    color: #666;
    font-size: 0.875rem;
}

.form-group.half {
    width: calc(50% - 10px);
}

.form-row {
    display: flex;
    gap: 20px;
    margin-bottom: 20px;
}

.form-group {
    margin-bottom: 20px;
}

.form-label {
    display: block;
    margin-bottom: 8px;
    font-weight: bold;
    color: #333;
}

.form-control {
    width: 100%;
    padding: 12px;
    border: 1px solid #ddd;
    border-radius: 4px;
    font-size: 14px;
}

.form-control:focus {
    outline: none;
    border-color: #007bff;
    box-shadow: 0 0 0 2px rgba(0,123,255,0.25);
}

textarea.form-control {
    resize: vertical;
}

.form-buttons {
    display: flex;
    gap: 15px;
    margin-top: 30px;
}

.btn-cancel, .btn-save {
    padding: 12px 24px;
    border-radius: 4px;
    text-decoration: none;
    font-weight: bold;
    cursor: pointer;
    border: none;
}

.btn-cancel {
    background: #6c757d;
    color: white;
}

.btn-save {
    background: #007bff;
    color: white;
}

.btn-cancel:hover {
    background: #5a6268;
}

.btn-save:hover {
    background: #0056b3;
}
</style>