
        <header class="dashboard-header">
            <h2>Gestion des Items</h2>
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
        
        <!-- ITEMS SECTION -->
        <section class="content-section" id="items-section">
            <div class="section-header">
                <h3>Liste des Items</h3>
                <a href="/admin/item/create" class="btn-add">
                    <svg viewBox="0 0 24 24"><path d="M19,13H13V19H11V13H5V11H11V5H13V11H19V13Z" /></svg>
                    Ajouter un item
                </a>
            </div>
            
            <div class="table-container">
                <table class="data-table">
                    <thead>
                        <tr>
                            <th>ID</th>
                            <th>Nom</th>
                            <th>Slug</th>
                            <th>Prix</th>
                            <th>Statut</th>
                            <th>Image</th>
                            <th>Actions</th>
                        </tr>
                    </thead>
                    <tbody>
                    <?php if (!empty($data['items'])) : ?>
                        <?php foreach ($data['items'] as $item) : ?>
                            <tr>
                                <td><?= htmlspecialchars($item['id_item']) ?></td>
                                <td><?= htmlspecialchars($item['nom']) ?></td>
                                <td><?= htmlspecialchars($item['slug']) ?></td>
                                <td><?= htmlspecialchars($item['prix']) ?> €</td>
                                <td>
                                    <?php 
                                        $statusClass = '';
                                        switch($item['statut']) {
                                            case 'disponible':
                                                $statusClass = 'available';
                                                break;
                                            case 'réservé':
                                                $statusClass = 'reserved';
                                                break;
                                            case 'vendu':
                                                $statusClass = 'sold';
                                                break;
                                        }
                                    ?>
                                    <span class="status-badge <?= $statusClass ?>"><?= htmlspecialchars($item['statut']) ?></span>
                                </td>
                                <td>
                                    <?php if ($item['image_url']) : ?>
                                        <img src="/<?= $item['image_url'] ?>" alt="<?= $item['nom'] ?>" class="item-thumbnail">
                                    <?php else : ?>
                                        <span>Aucune image</span>
                                    <?php endif; ?>
                                </td>
                                <td>
                                    <a href="/admin/item/edit/<?= $item['id_item'] ?>" class="action-link action-edit">✏️ Modifier</a>
                                    <a href="/admin/item/delete/<?= $item['id_item'] ?>" onclick="return confirm('Supprimer cet item ?');" class="action-link action-delete">🗑️ Supprimer</a>
                                </td>
                            </tr>
                        <?php endforeach; ?>
                    <?php else : ?>
                        <tr>
                            <td colspan="7" class="empty-message">Aucun item trouvé.</td>
                        </tr>
                    <?php endif; ?>
                    </tbody>
                </table>
            </div>
        </section>
    