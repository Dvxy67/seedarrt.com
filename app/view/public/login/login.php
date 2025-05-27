<?php
if($data['error'] ?? false){
    echo '<p>' . $data['error'] . '</p>';
}
?>    
    <div class="container">
        <div class="login-card">
            <div class="card-shine"></div>
            
            <div class="login-header">
                <h2>Connexion Sécurisée</h2>
                <p>Accédez à votre espace administrateur</p>
            </div>
            
            <form action="/checkin" method="POST">
                <div class="form-group">
                    <input type="text" class="form-control" name="username" placeholder="Votre identifiant">
                    <span class="form-label">Identifiant</span>
                </div>
                
                <div class="form-group">
                    <input type="password" class="form-control" name="mot_de_passe" placeholder="Votre mot de passe">
                    <span class="form-label">Mot de passe</span>
                </div>
                
                <button type="submit" class="btn-login">Se connecter</button>
                
                <div class="options">
                    <div class="remember-me">
                        <input type="checkbox" id="remember" checked>
                        <label for="remember">Se souvenir de moi</label>
                    </div>
                    
                    <div class="forgot-password">
                        <a href="#">Mot de passe oublié?</a>
                    </div>
                </div>
            </form>
        </div>
    </div>