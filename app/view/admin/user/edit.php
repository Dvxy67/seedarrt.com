<?php //formulaire modification ?>

<?php 
// Vérifier que l'utilisateur existe
if(!isset($data['user']) || empty($data['user'])) {
    header('Location: /admin/user');
    exit;
}
$user = $data['user'];
?>

<header class="dashboard-header">
    <h2>Modifier l'utilisateur</h2>
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

<!-- EDIT USER FORM -->
<section class="content-section">
    <div class="section-header">
        <h3>Informations de l'utilisateur</h3>
    </div>
    
    <?php if(isset($data['error'])): ?>
        <div class="alert alert-error">
            <?= htmlspecialchars($data['error']) ?>
        </div>
    <?php endif; ?>
    
    <form action="/admin/user/update" method="POST" class="form">
        <input type="hidden" name="id_operateur" value="<?= $user['id_operateur'] ?>">
        
        <div class="form-row">
            <div class="form-group half">
                <label class="form-label">Nom *</label>
                <input type="text" name="nom" class="form-control" 
                       value="<?= htmlspecialchars($user['nom']) ?>" 
                       placeholder="Nom de famille" required>
            </div>
            
            <div class="form-group half">
                <label class="form-label">Prénom *</label>
                <input type="text" name="prénom" class="form-control" 
                       value="<?= htmlspecialchars($user['prénom']) ?>" 
                       placeholder="Prénom" required>
            </div>
        </div>
        
        <div class="form-row">
            <div class="form-group half">
                <label class="form-label">Login *</label>
                <input type="text" name="login" class="form-control" 
                       value="<?= htmlspecialchars($user['login']) ?>" 
                       placeholder="Identifiant unique" required>
                <small class="form-help">Cet identifiant est utilisé pour la connexion</small>
            </div>
            
            <div class="form-group half">
                <label class="form-label">Email *</label>
                <input type="email" name="email" class="form-control" 
                       value="<?= htmlspecialchars($user['email']) ?>" 
                       placeholder="email@exemple.com" required>
            </div>
        </div>
        
        <div class="form-row">
            <div class="form-group half">
                <label class="form-label">Nouveau mot de passe</label>
                <input type="password" name="mot_de_passe" class="form-control" 
                       placeholder="Laisser vide pour conserver l'actuel" minlength="8">
                <small class="form-help">Minimum 8 caractères (laisser vide pour ne pas changer)</small>
            </div>
            
            <div class="form-group half">
                <label class="form-label">Confirmer le nouveau mot de passe</label>
                <input type="password" name="mot_de_passe_confirm" class="form-control" 
                       placeholder="Retapez le nouveau mot de passe">
            </div>
        </div>
        
        <div class="form-row">
            <div class="form-group half">
                <label class="form-label">Téléphone</label>
                <input type="tel" name="telephone" class="form-control" 
                       value="<?= htmlspecialchars($user['telephone'] ?? '') ?>" 
                       placeholder="+33 6 12 34 56 78">
            </div>
            
            <div class="form-group half">
                <label class="form-label">Niveau d'accès *</label>
                <select name="niveau_acces" class="form-control" required>
                    <option value="operateur" <?= $user['niveau_acces'] == 'operateur' ? 'selected' : '' ?>>
                        Opérateur
                    </option>
                    <option value="superviseur" <?= $user['niveau_acces'] == 'superviseur' ? 'selected' : '' ?>>
                        Superviseur
                    </option>
                    <option value="admin" <?= $user['niveau_acces'] == 'admin' ? 'selected' : '' ?>>
                        Administrateur
                    </option>
                </select>
            </div>
        </div>
        
        <div class="form-group">
            <label class="form-label">Statut</label>
            <select name="statut" class="form-control">
                <option value="actif" <?= $user['statut'] == 'actif' ? 'selected' : '' ?>>
                    Actif
                </option>
                <option value="inactif" <?= $user['statut'] == 'inactif' ? 'selected' : '' ?>>
                    Inactif
                </option>
            </select>
        </div>
        
        <div class="form-info">
            <p><strong>Date de création :</strong> 
               <?= date('d/m/Y à H:i', strtotime($user['date_creation'])) ?>
            </p>
            <?php if($user['derniere_connexion']): ?>
            <p><strong>Dernière connexion :</strong> 
               <?= date('d/m/Y à H:i', strtotime($user['derniere_connexion'])) ?>
            </p>
            <?php endif; ?>
        </div>
        
        <div class="form-buttons">
            <a href="/admin/user" class="btn-cancel">Annuler</a>
            <button type="submit" class="btn-save">Enregistrer les modifications</button>
        </div>
    </form>
</section>

<style>
.alert {
    padding: 12px 20px;
    margin-bottom: 20px;
    border-radius: 4px;
}
.alert-error {
    background-color: #fef2f2;
    color: #dc2626;
    border: 1px solid #fecaca;
}
.form-help {
    display: block;
    margin-top: 4px;
    color: #666;
    font-size: 0.875rem;
}
.form-info {
    background: #f8f9fa;
    padding: 15px;
    border-radius: 4px;
    margin-bottom: 20px;
}
.form-info p {
    margin: 5px 0;
    color: #666;
}
</style>

<script>
// Validation du mot de passe
document.querySelector('form').addEventListener('submit', function(e) {
    const password = document.querySelector('[name="mot_de_passe"]').value;
    const confirmPassword = document.querySelector('[name="mot_de_passe_confirm"]').value;
    
    // Si un mot de passe est saisi, vérifier la confirmation
    if (password && password !== confirmPassword) {
        e.preventDefault();
        alert('Les mots de passe ne correspondent pas !');
        return false;
    }
});
</script>