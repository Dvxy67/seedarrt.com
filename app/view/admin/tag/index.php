<header class="dashboard-header">
            <h2>Gestion des Tags</h2>
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
        
        <!-- TAGS SECTION -->
        <section class="content-section" id="tags-section">
            <div class="section-header">
                <h3>Liste des Tags</h3>
                <a href="/admin/tag/create" class="btn-add">
                    <svg viewBox="0 0 24 24"><path d="M19,13H13V19H11V13H5V11H11V5H13V11H19V13Z" /></svg>
                    Ajouter un tag
                </a>
            </div>
            
            <div class="table-container">
                <table class="data-table">
                    <thead>
                        <tr>
                            <th>ID</th>
                            <th>Nom</th>
                            <th>Slug</th>
                            <th>Couleur</th>
                            <th>Items associés</th>
                            <th>Actions</th>
                        </tr>
                    </thead>
                    <tbody>
                    <?php if (!empty($data['tags'])) : ?>
                        <?php foreach ($data['tags'] as $tag) : ?>
                            <tr>
                                <td><?= htmlspecialchars($tag['id_tag']) ?></td>
                                <td><?= htmlspecialchars($tag['nom']) ?></td>
                                <td><?= htmlspecialchars($tag['slug']) ?></td>
                                <td>
                                    <div class="color-preview" style="background-color: <?= htmlspecialchars($tag['couleur']) ?>"></div>
                                    <span><?= htmlspecialchars($tag['couleur']) ?></span>
                                </td>
                                <td><?= htmlspecialchars($tag['nb_items'] ?? '0') ?></td>
                                <td>
                                    <a href="/admin/tag/edit/<?= $tag['id_tag'] ?>" class="action-link action-edit">✏️ Modifier</a>
                                    <a href="/admin/tag/delete/<?= $tag['id_tag'] ?>" onclick="return confirm('Supprimer ce tag ?');" class="action-link action-delete">🗑️ Supprimer</a>
                                </td>
                            </tr>
                        <?php endforeach; ?>
                    <?php else : ?>
                        <tr>
                            <td colspan="6" class="empty-message">Aucun tag trouvé.</td>
                        </tr>
                    <?php endif; ?>
                    </tbody>
                </table>
            </div>
        </section>