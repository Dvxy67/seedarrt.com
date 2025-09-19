<header class="dashboard-header">
    <h2>Gestion des Catégories</h2>
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

<?php
// Afficher les messages de succès/erreur
if (isset($_GET['success'])) {
    $messages = [
        'created' => 'Catégorie créée avec succès',
        'updated' => 'Catégorie mise à jour avec succès',
        'deleted' => 'Catégorie supprimée avec succès'
    ];
    echo '<div class="alert alert-success">' . ($messages[$_GET['success']] ?? 'Opération réussie') . '</div>';
}

if (isset($_GET['error'])) {
    $messages = [
        'not_found' => 'Catégorie non trouvée',
        'create_failed' => 'Erreur lors de la création',
        'update_failed' => 'Erreur lors de la mise à jour',
        'has_items' => 'Impossible de supprimer : des items sont associés à cette catégorie'
    ];
    echo '<div class="alert alert-error">' . ($messages[$_GET['error']] ?? 'Erreur') . '</div>';
}
?>

<section class="content-section">
    <div class="section-header">
        <h3>Liste des Catégories</h3>
        <a href="/admin/categorie/create" class="btn-add">
            <svg viewBox="0 0 24 24"><path d="M19,13H13V19H11V13H5V11H11V5H13V11H19V13Z" /></svg>
            Ajouter une catégorie
        </a>
    </div>
    
    <div class="table-container">
        <table class="data-table">
            <thead>
                <tr>
                    <th>ID</th>
                    <th>Nom</th>
                    <th>Slug</th>
                    <th>Parent</th>
                    <th>Ordre</th>
                    <th>Items</th>
                    <th>Statut</th>
                    <th>Actions</th>
                </tr>
            </thead>
            <tbody>
            <?php if (!empty($data['categories'])) : ?>
                <?php foreach ($data['categories'] as $categorie) : ?>
                    <tr>
                        <td><?= htmlspecialchars($categorie['id_categorie']) ?></td>
                        <td>
                            <strong><?= htmlspecialchars($categorie['nom']) ?></strong>
                            <?php if ($categorie['description']): ?>
                                <br><small style="color: #666;"><?= htmlspecialchars(substr($categorie['description'], 0, 60)) ?>...</small>
                            <?php endif; ?>
                        </td>
                        <td><code><?= htmlspecialchars($categorie['slug']) ?></code></td>
                        <td>
                            <?php if ($categorie['parent_id']): ?>
                                <span class="parent-badge">Sous-catégorie</span>
                            <?php else: ?>
                                <span class="parent-badge main">Principale</span>
                            <?php endif; ?>
                        </td>
                        <td><?= htmlspecialchars($categorie['ordre']) ?></td>
                        <td>
                            <span class="item-count"><?= $categorie['nb_items'] ?? 0 ?></span>
                        </td>
                        <td>
                            <?php if($categorie['visible']): ?>
                                <span class="status-badge available">Visible</span>
                            <?php else: ?>
                                <span class="status-badge sold">Caché</span>
                            <?php endif; ?>
                        </td>
                        <td>
                            <div class="action-buttons">
                                <a href="/admin/categorie/edit/<?= $categorie['id_categorie'] ?>" class="btn-edit" title="Modifier">
                                    <svg viewBox="0 0 24 24"><path d="M20.71,7.04C21.1,6.65 21.1,6 20.71,5.63L18.37,3.29C18,2.9 17.35,2.9 16.96,3.29L15.12,5.12L18.87,8.87M3,17.25V21H6.75L17.81,9.93L14.06,6.18L3,17.25Z" /></svg>
                                </a>
                                <?php if ($categorie['nb_items'] == 0): ?>
                                    <a href="/admin/categorie/delete/<?= $categorie['id_categorie'] ?>" 
                                       onclick="return confirm('Supprimer cette catégorie ?');" 
                                       class="btn-delete" title="Supprimer">
                                        <svg viewBox="0 0 24 24"><path d="M19,4H15.5L14.5,3H9.5L8.5,4H5V6H19M6,19A2,2 0 0,0 8,21H16A2,2 0 0,0 18,19V7H6V19Z" /></svg>
                                    </a>
                                <?php else: ?>
                                    <button class="btn-delete disabled" title="Impossible de supprimer : des items sont associés" disabled>
                                        <svg viewBox="0 0 24 24"><path d="M19,4H15.5L14.5,3H9.5L8.5,4H5V6H19M6,19A2,2 0 0,0 8,21H16A2,2 0 0,0 18,19V7H6V19Z" /></svg>
                                    </button>
                                <?php endif; ?>
                            </div>
                        </td>
                    </tr>
                <?php endforeach; ?>
            <?php else : ?>
                <tr>
                    <td colspan="8" class="empty-message">Aucune catégorie trouvée.</td>
                </tr>
            <?php endif; ?>
            </tbody>
        </table>
    </div>
</section>

<style>
.alert {
    padding: 15px;
    margin-bottom: 20px;
    border-radius: 4px;
    font-weight: bold;
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

.parent-badge {
    padding: 3px 8px;
    border-radius: 12px;
    font-size: 0.8rem;
    font-weight: bold;
}

.parent-badge.main {
    background: #e3f2fd;
    color: #1565c0;
}

.parent-badge:not(.main) {
    background: #fff3e0;
    color: #ef6c00;
}

.item-count {
    background: #f0f0f0;
    padding: 4px 8px;
    border-radius: 10px;
    font-weight: bold;
}

.btn-delete.disabled {
    opacity: 0.5;
    cursor: not-allowed;
}

.btn-delete.disabled:hover {
    background-color: #dc3545;
}

code {
    background: #f8f9fa;
    padding: 2px 6px;
    border-radius: 3px;
    font-family: 'Courier New', monospace;
    font-size: 0.9rem;
}

.empty-message {
    text-align: center;
    color: #666;
    font-style: italic;
    padding: 40px 20px;
}
</style>