<?php 
// Déterminer si on est en mode création ou modification
$isEdit = isset($data['tag']) && !empty($data['tag']);
$tag = $isEdit ? $data['tag'] : null;
?>
<header class="dashboard-header">
    <h2><?= $isEdit ? 'Modifier le tag' : 'Ajouter un nouveau tag' ?></h2>
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

<!-- CREATE/EDIT TAG FORM -->
<section class="content-section">
    <div class="section-header">
        <h3>Informations du tag</h3>
    </div>
    
    <form action="/admin/tag/<?= $isEdit ? 'update/'.$tag['id_tag'] : 'store' ?>" method="POST" class="form">
        <div class="form-row">
            <div class="form-group half">
                <label class="form-label">Nom</label>
                <input type="text" name="nom" class="form-control" placeholder="Nom du tag" required 
                       value="<?= $isEdit ? htmlspecialchars($tag['nom']) : '' ?>">
            </div>
            
            <div class="form-group half">
                <label class="form-label">Slug</label>
                <input type="text" name="slug" class="form-control" placeholder="mon-tag-slug" required 
                       value="<?= $isEdit ? htmlspecialchars($tag['slug']) : '' ?>">
            </div>
        </div>
        
        <div class="form-group">
            <label class="form-label">Description</label>
            <textarea name="description" class="form-control" placeholder="Description détaillée du tag..." rows="4"><?= $isEdit ? htmlspecialchars($tag['description'] ?? '') : '' ?></textarea>
        </div>
        
        <div class="form-row">
            <div class="form-group half">
                <label class="form-label">Couleur</label>
                <div class="color-picker-wrapper" style="display: flex; gap: 10px; align-items: center;">
                    <div class="color-preview" id="colorPreview" 
                         style="width: 40px; height: 40px; border-radius: 4px; border: 1px solid #ddd; cursor: pointer; background-color: <?= $isEdit ? htmlspecialchars($tag['couleur'] ?? '#333333') : '#333333' ?>;" 
                         onclick="document.getElementById('colorInput').click()"></div>
                    <input type="color" id="colorInput" name="couleur" 
                           value="<?= $isEdit ? htmlspecialchars($tag['couleur'] ?? '#333333') : '#333333' ?>" 
                           onchange="updateColorPreview(this.value)" style="opacity: 0; position: absolute; pointer-events: none;">
                    <input type="text" class="form-control" 
                           value="<?= $isEdit ? htmlspecialchars($tag['couleur'] ?? '#333333') : '#333333' ?>" 
                           id="colorText" onchange="updateColorFromText(this.value)" placeholder="#333333" style="flex: 1;">
                </div>
            </div>
            
            <div class="form-group half">
                <label class="form-label">Tag parent (optionnel)</label>
                <select name="parent_tag_id" class="form-control">
                    <option value="">Aucun parent</option>
                    <?php
                    // Récupérer tous les tags pour les afficher comme options parent
                    $allTags = model_tag_getAll();
                    foreach($allTags as $t) {
                        // Ne pas permettre à un tag d'être son propre parent
                        if(!$isEdit || $t['id_tag'] != $tag['id_tag']) {
                            $selected = ($isEdit && $tag['parent_tag_id'] == $t['id_tag']) ? 'selected' : '';
                            echo '<option value="'.$t['id_tag'].'" '.$selected.'>'.htmlspecialchars($t['nom']).'</option>';
                        }
                    }
                    ?>
                </select>
            </div>
        </div>
        
        <div class="form-group">
            <label class="form-label">Visibilité</label>
            <select name="visible" class="form-control">
                <option value="1" <?= ($isEdit && $tag['visible'] == 1) ? 'selected' : '' ?>>Visible</option>
                <option value="0" <?= ($isEdit && $tag['visible'] == 0) ? 'selected' : '' ?>>Caché</option>
            </select>
        </div>
        
        <div class="form-buttons">
            <a href="/admin/tag" class="btn-cancel">Annuler</a>
            <button type="submit" class="btn-save">Enregistrer</button>
        </div>
    </form>
</section>

<script>
function updateColorPreview(color) {
    document.getElementById('colorPreview').style.backgroundColor = color;
    document.getElementById('colorText').value = color;
}

function updateColorFromText(color) {
    if (color.match(/^#[0-9A-F]{6}$/i)) {
        document.getElementById('colorPreview').style.backgroundColor = color;
        document.getElementById('colorInput').value = color;
    }
}

// Auto-génération du slug basé sur le nom
document.querySelector('input[name="nom"]').addEventListener('input', function(e) {
    // Ne pas auto-générer si on est en mode édition et qu'il y a déjà un slug
    <?php if(!$isEdit): ?>
    const nom = e.target.value;
    const slug = nom.toLowerCase()
        .normalize('NFD').replace(/[\u0300-\u036f]/g, '') // Supprime les accents
        .replace(/[^a-z0-9\s-]/g, '') // Supprime les caractères spéciaux
        .replace(/\s+/g, '-') // Remplace les espaces par des tirets
        .replace(/-+/g, '-') // Supprime les tirets multiples
        .replace(/^-|-$/g, ''); // Supprime les tirets en début/fin
    
    document.querySelector('input[name="slug"]').value = slug;
    <?php endif; ?>
});
</script>