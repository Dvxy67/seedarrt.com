<header class="dashboard-header">
    <h2>Gestion des Utilisateurs</h2>
    <div class="user-info">
        <div class="user-notifications">
            <svg viewBox="0 0 24 24"><path d="M21,19V20H3V19L5,17V11C5,7.9 7.03,5.17 10,4.29C10,4.19 10,4.1 10,4A2,2 0 0,1 12,2A2,2 0 0,1 14,4C14,4.1 14,4.19 14,4.29C16.97,5.17 19,7.9 19,11V17L21,19M14,21A2,2 0 0,1 12,23A2,2 0 0,1 10,21" /></svg>
            <span class="badge">3</span>
        </div>
        <div class="user-avatar">
            <img src="/api/placeholder/40/40" alt="Avatar">
        </div>
        <span class="user-name">Admin</span>
    </div>
</header>

<!-- USERS SECTION -->
<section class="content-section">
    <div class="section-header">
        <h3>Liste des Utilisateurs</h3>
        <a href="/admin/user/create" class="btn-add">
            <svg viewBox="0 0 24 24"><path d="M19,13H13V19H11V13H5V11H11V5H13V11H19V13Z" /></svg>
            Ajouter un utilisateur
        </a>
    </div>
    
    <div class="table-container">
        <table class="data-table">
            <thead>
                <tr>
                    <th>ID</th>
                    <th>Nom</th>
                    <th>Prénom</th>
                    <th>Login</th>
                    <th>Email</th>
                    <th>Niveau</th>
                    <th>Statut</th>
                    <th>Dernière connexion</th>
                    <th>Actions</th>
                </tr>
            </thead>
            <tbody>
            <?php if (!empty($data['users'])) : ?>
                <?php foreach ($data['users'] as $user) : ?>
                    <tr>
                        <td><?= htmlspecialchars($user['id_operateur']) ?></td>
                        <td><?= htmlspecialchars($user['nom']) ?></td>
                        <td><?= htmlspecialchars($user['prénom']) ?></td>
                        <td><?= htmlspecialchars($user['login']) ?></td>
                        <td><?= htmlspecialchars($user['email']) ?></td>
                        <td>
                            <span class="status-badge">
                                <?= htmlspecialchars($user['niveau_acces']) ?>
                            </span>
                        </td>
                        <td>
                            <?php if($user['statut'] == 'actif'): ?>
                                <span class="status-badge available">Actif</span>
                            <?php else: ?>
                                <span class="status-badge sold">Inactif</span>
                            <?php endif; ?>
                        </td>
                        <td>
                            <?= $user['derniere_connexion'] ? date('d/m/Y H:i', strtotime($user['derniere_connexion'])) : 'Jamais' ?>
                        </td>
                        <td>
                            <div class="action-buttons">
                                <a href="/admin/user/edit/<?= $user['id_operateur'] ?>" class="btn-edit">
                                    <svg viewBox="0 0 24 24"><path d="M20.71,7.04C21.1,6.65 21.1,6 20.71,5.63L18.37,3.29C18,2.9 17.35,2.9 16.96,3.29L15.12,5.12L18.87,8.87M3,17.25V21H6.75L17.81,9.93L14.06,6.18L3,17.25Z" /></svg>
                                </a>
                                <a href="/admin/user/toggle_status/<?= $user['id_operateur'] ?>" class="btn-status" title="Changer le statut">
                                    <svg viewBox="0 0 24 24"><path d="M12,3A9,9 0 0,0 3,12A9,9 0 0,0 12,21A9,9 0 0,0 21,12A9,9 0 0,0 12,3M12,19A7,7 0 0,1 5,12A7,7 0 0,1 12,5A7,7 0 0,1 19,12A7,7 0 0,1 12,19M12,9A3,3 0 0,0 9,12A3,3 0 0,0 12,15A3,3 0 0,0 15,12A3,3 0 0,0 12,9Z" /></svg>
                                </a>
                                <?php if(isset($_SESSION['active_user']) && $_SESSION['active_user'] != $user['id_operateur']): ?>
                                <a href="/admin/user/delete/<?= $user['id_operateur'] ?>" onclick="return confirm('Supprimer cet utilisateur ?');" class="btn-delete">
                                    <svg viewBox="0 0 24 24"><path d="M19,4H15.5L14.5,3H9.5L8.5,4H5V6H19M6,19A2,2 0 0,0 8,21H16A2,2 0 0,0 18,19V7H6V19Z" /></svg>
                                </a>
                                <?php endif; ?>
                            </div>
                        </td>
                    </tr>
                <?php endforeach; ?>
            <?php else : ?>
                <tr>
                    <td colspan="9" class="empty-message">Aucun utilisateur trouvé.</td>
                </tr>
            <?php endif; ?>
            </tbody>
        </table>
    </div>
</section>

<style>
.btn-status {
    background-color: #fff;
    border: 1px solid #ddd;
    padding: 8px;
    border-radius: 4px;
    cursor: pointer;
    transition: all 0.3s;
}
.btn-status:hover {
    background-color: #f0f0f0;
}
.btn-status svg {
    width: 16px;
    height: 16px;
    fill: #666;
}
</style>