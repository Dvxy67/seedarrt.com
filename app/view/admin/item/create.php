<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Ajouter un nouvel item - ArtGallery</title>
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Cormorant+Garamond:wght@400;500;600;700&family=Montserrat:wght@300;400;500;600&display=swap" rel="stylesheet">
    <style>
        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
        }

        body {
            font-family: 'Montserrat', sans-serif;
            height: 100vh;
            overflow: hidden;
            background: linear-gradient(125deg, rgba(0, 40, 20, 1) 0%, rgba(6, 55, 30, 1) 45%, rgba(2, 70, 40, 1) 100%);
            display: flex;
            position: relative;
        }

        body::before {
            content: '';
            position: absolute;
            top: 0;
            left: 0;
            width: 100%;
            height: 100%;
            background: 
                radial-gradient(circle at 15% 85%, rgba(52, 211, 153, 0.15) 0%, transparent 40%),
                radial-gradient(circle at 85% 15%, rgba(16, 185, 129, 0.15) 0%, transparent 40%),
                radial-gradient(circle at 75% 75%, rgba(35, 180, 130, 0.1) 0%, transparent 30%),
                radial-gradient(circle at 25% 25%, rgba(70, 230, 170, 0.08) 0%, transparent 30%);
            z-index: 2;
            pointer-events: none;
        }

        /* Sidebar */
        .sidebar {
            position: relative;
            z-index: 10;
            width: 280px;
            background: rgba(0, 40, 20, 0.7);
            backdrop-filter: blur(10px);
            border-right: 1px solid rgba(255, 255, 255, 0.1);
            display: flex;
            flex-direction: column;
            height: 100vh;
            padding: 2rem 1.5rem;
        }

        .logo {
            display: flex;
            align-items: center;
            margin-bottom: 3rem;
        }

        .logo svg {
            width: 36px;
            height: 36px;
            fill: rgba(255, 255, 255, 0.9);
        }

        .logo-text {
            margin-left: 1rem;
            font-family: 'Cormorant Garamond', serif;
        }

        .logo-text h1 {
            color: #fff;
            font-size: 1.6rem;
            font-weight: 600;
            letter-spacing: 1px;
            margin-bottom: -5px;
        }

        .logo-text p {
            color: rgba(255, 255, 255, 0.7);
            font-size: 0.8rem;
            letter-spacing: 3px;
            text-transform: uppercase;
        }

        .main-nav {
            flex: 1;
        }

        .main-nav ul {
            list-style: none;
        }

        .main-nav ul li {
            margin-bottom: 0.5rem;
        }

        .main-nav ul li a {
            display: flex;
            align-items: center;
            color: rgba(255, 255, 255, 0.7);
            padding: 0.8rem 1rem;
            text-decoration: none;
            border-radius: 8px;
            transition: all 0.3s ease;
            font-size: 0.95rem;
            font-weight: 500;
        }

        .main-nav ul li a svg {
            width: 20px;
            height: 20px;
            fill: rgba(255, 255, 255, 0.7);
            margin-right: 1rem;
            transition: all 0.3s ease;
        }

        .main-nav ul li a:hover {
            background: rgba(255, 255, 255, 0.1);
            color: rgba(52, 211, 153, 1);
        }

        .main-nav ul li a:hover svg {
            fill: rgba(52, 211, 153, 1);
        }

        .main-nav ul li.active a {
            background: rgba(52, 211, 153, 0.2);
            color: rgba(52, 211, 153, 1);
        }

        .main-nav ul li.active a svg {
            fill: rgba(52, 211, 153, 1);
        }

        .logout {
            border-top: 1px solid rgba(255, 255, 255, 0.1);
            padding-top: 1rem;
            margin-top: 1rem;
        }

        .logout a {
            display: flex;
            align-items: center;
            color: rgba(255, 255, 255, 0.7);
            padding: 0.8rem 1rem;
            text-decoration: none;
            border-radius: 8px;
            transition: all 0.3s ease;
            font-size: 0.95rem;
            font-weight: 500;
        }

        .logout a svg {
            width: 20px;
            height: 20px;
            fill: rgba(255, 255, 255, 0.7);
            margin-right: 1rem;
            transition: all 0.3s ease;
        }

        .logout a:hover {
            background: rgba(255, 255, 255, 0.1);
            color: rgba(255, 99, 99, 1);
        }

        .logout a:hover svg {
            fill: rgba(255, 99, 99, 1);
        }

        /* Main Content */
        .main-content {
            flex: 1;
            position: relative;
            z-index: 10;
            padding: 2rem 2.5rem;
            overflow-y: auto;
            height: 100vh;
        }

        .dashboard-header {
            display: flex;
            justify-content: space-between;
            align-items: center;
            margin-bottom: 2rem;
            padding-bottom: 1.5rem;
            border-bottom: 1px solid rgba(255, 255, 255, 0.1);
        }

        .dashboard-header h2 {
            font-family: 'Cormorant Garamond', serif;
            color: white;
            font-size: 2rem;
            font-weight: 600;
            letter-spacing: 0.5px;
        }

        .user-info {
            display: flex;
            align-items: center;
        }

        .user-notifications {
            position: relative;
            margin-right: 1.5rem;
        }

        .user-notifications svg {
            width: 24px;
            height: 24px;
            fill: rgba(255, 255, 255, 0.8);
            cursor: pointer;
            transition: all 0.3s ease;
        }

        .user-notifications svg:hover {
            fill: rgba(52, 211, 153, 1);
        }

        .badge {
            position: absolute;
            top: -5px;
            right: -5px;
            width: 18px;
            height: 18px;
            background: rgba(52, 211, 153, 1);
            color: white;
            border-radius: 50%;
            font-size: 0.7rem;
            display: flex;
            justify-content: center;
            align-items: center;
            font-weight: 500;
        }

        .user-avatar {
            width: 40px;
            height: 40px;
            border-radius: 50%;
            overflow: hidden;
            margin-right: 1rem;
            border: 2px solid rgba(52, 211, 153, 0.7);
        }

        .user-avatar img {
            width: 100%;
            height: 100%;
            object-fit: cover;
        }

        .user-name {
            color: white;
            font-size: 0.95rem;
            font-weight: 500;
        }

        /* Content Sections */
        .content-section {
            background: rgba(255, 255, 255, 0.05);
            backdrop-filter: blur(10px);
            border-radius: 16px;
            border: 1px solid rgba(255, 255, 255, 0.1);
            padding: 2rem;
            margin-bottom: 2rem;
        }

        .section-header {
            display: flex;
            justify-content: space-between;
            align-items: center;
            margin-bottom: 1.5rem;
            padding-bottom: 1rem;
            border-bottom: 1px solid rgba(255, 255, 255, 0.1);
        }

        .section-header h3 {
            font-family: 'Cormorant Garamond', serif;
            color: white;
            font-size: 1.5rem;
            font-weight: 600;
        }

        /* Form Styles */
        .form {
            width: 100%;
        }

        .form-group {
            margin-bottom: 1.5rem;
            position: relative;
        }

        .form-row {
            display: flex;
            gap: 1.5rem;
            margin-bottom: 1.5rem;
        }

        .form-group.half {
            flex: 1;
            position: relative;
        }

        .form-control {
            width: 100%;
            background: rgba(255, 255, 255, 0.1);
            border: 1px solid rgba(255, 255, 255, 0.2);
            border-radius: 8px;
            padding: 1rem 1.2rem;
            font-size: 0.95rem;
            color: white;
            transition: all 0.3s ease;
        }

        .form-control:focus {
            outline: none;
            border-color: rgba(52, 211, 153, 0.5);
            box-shadow: 0 0 0 3px rgba(52, 211, 153, 0.25);
            background: rgba(255, 255, 255, 0.15);
        }

        .form-control::placeholder {
            color: rgba(255, 255, 255, 0.5);
        }

        textarea.form-control {
            min-height: 100px;
            resize: vertical;
        }

        select.form-control {
            appearance: none;
            background-image: url("data:image/svg+xml,%3Csvg xmlns='http://www.w3.org/2000/svg' viewBox='0 0 24 24' fill='white' width='18px' height='18px'%3E%3Cpath d='M7 10l5 5 5-5z'/%3E%3C/svg%3E");
            background-repeat: no-repeat;
            background-position: right 10px center;
        }

        .form-label {
            display: block;
            margin-bottom: 0.5rem;
            color: rgba(255, 255, 255, 0.9);
            font-size: 0.9rem;
            font-weight: 500;
        }

        .form-buttons {
            display: flex;
            justify-content: flex-end;
            gap: 1rem;
            margin-top: 2rem;
        }

        .btn-cancel {
            background: rgba(255, 255, 255, 0.1);
            border: 1px solid rgba(255, 255, 255, 0.2);
            border-radius: 8px;
            padding: 0.8rem 1.5rem;
            color: rgba(255, 255, 255, 0.8);
            font-size: 0.95rem;
            font-weight: 500;
            cursor: pointer;
            transition: all 0.3s ease;
            text-decoration: none;
            display: inline-flex;
            align-items: center;
            justify-content: center;
        }

        .btn-cancel:hover {
            background: rgba(255, 255, 255, 0.15);
        }

        .btn-save {
            background: linear-gradient(95deg, rgba(52, 211, 153, 0.9), rgba(16, 185, 129, 0.9));
            border: none;
            border-radius: 8px;
            padding: 0.8rem 1.5rem;
            color: white;
            font-size: 0.95rem;
            font-weight: 500;
            cursor: pointer;
            transition: all 0.3s ease;
            box-shadow: 0 4px 15px rgba(16, 185, 129, 0.25);
        }

        .btn-save:hover {
            transform: translateY(-2px);
            box-shadow: 0 8px 20px rgba(16, 185, 129, 0.35);
        }

        /* Responsive Styles */
        @media (max-width: 992px) {
            .form-row {
                flex-direction: column;
                gap: 0;
            }
        }

        @media (max-width: 768px) {
            body {
                flex-direction: column;
                overflow-y: auto;
            }
            
            .sidebar {
                width: 100%;
                height: auto;
                padding: 1rem;
                border-right: none;
                border-bottom: 1px solid rgba(255, 255, 255, 0.1);
            }
            
            .logo {
                margin-bottom: 1.5rem;
            }
            
            .main-nav {
                display: none;
            }
            
            .main-content {
                height: auto;
                padding: 1.5rem;
            }
            
            .dashboard-header {
                flex-direction: column;
                align-items: flex-start;
                gap: 1rem;
            }
            
            .user-info {
                width: 100%;
                justify-content: flex-end;
            }
        }

        /* File Upload */
        .file-upload {
            position: relative;
        }

        .file-input {
            width: 0.1px;
            height: 0.1px;
            opacity: 0;
            overflow: hidden;
            position: absolute;
            z-index: -1;
        }

        .file-label {
            display: flex;
            align-items: center;
            justify-content: center;
            gap: 0.5rem;
            width: 100%;
            background: rgba(255, 255, 255, 0.1);
            border: 1px solid rgba(255, 255, 255, 0.2);
            border-radius: 8px;
            padding: 1rem;
            cursor: pointer;
            transition: all 0.3s ease;
            color: rgba(255, 255, 255, 0.7);
        }

        .file-label:hover {
            background: rgba(255, 255, 255, 0.15);
            border-color: rgba(52, 211, 153, 0.4);
        }

        .file-label svg {
            width: 20px;
            height: 20px;
            fill: rgba(52, 211, 153, 0.9);
        }
    </style>
</head>
<body>
    <div class="overlay"></div>
    
    <!-- Sidebar -->
    <aside class="sidebar">
        <div class="logo">
            <svg viewBox="0 0 24 24">
                <path d="M21,16.5C21,16.88 20.79,17.21 20.47,17.38L12.57,21.82C12.41,21.94 12.21,22 12,22C11.79,22 11.59,21.94 11.43,21.82L3.53,17.38C3.21,17.21 3,16.88 3,16.5V7.5C3,7.12 3.21,6.79 3.53,6.62L11.43,2.18C11.59,2.06 11.79,2 12,2C12.21,2 12.41,2.06 12.57,2.18L20.47,6.62C20.79,6.79 21,7.12 21,7.5V16.5M12,4.15L6.04,7.5L12,10.85L17.96,7.5L12,4.15M5,15.91L11,19.29V12.58L5,9.21V15.91M19,15.91V9.21L13,12.58V19.29L19,15.91Z" />
            </svg>
            <div class="logo-text">
                <h1>ArtGallery</h1>
                <p>Administration</p>
            </div>
        </div>
        
        <nav class="main-nav">
            <ul>
                <li><a href="/admin/dashboard"><svg viewBox="0 0 24 24"><path d="M13,3V9H21V3M13,21H21V11H13M3,21H11V15H3M3,13H11V3H3V13Z" /></svg> Dashboard</a></li>
                <li class="active"><a href="/admin/item"><svg viewBox="0 0 24 24"><path d="M18,17H10.5L12.5,15H18M6,17V15H8.5L6,17M14,13H18V11H14M6,13H12V11H6M18,9H13L14.5,7.5H18M6,9H9.5L11,7.5H6M6,5V3H18V5H6Z" /></svg> Items</a></li>
                <li><a href="/admin/tags"><svg viewBox="0 0 24 24"><path d="M21.41,11.58L12.41,2.58C12.04,2.21 11.53,2 11,2H4C2.9,2 2,2.9 2,4V11C2,11.53 2.21,12.04 2.59,12.41L11.59,21.41C11.96,21.78 12.47,22 13,22C13.53,22 14.04,21.79 14.41,21.41L21.41,14.41C21.79,14.04 22,13.53 22,13C22,12.47 21.79,11.96 21.41,11.58M5.5,7C4.67,7 4,6.33 4,5.5C4,4.67 4.67,4 5.5,4C6.33,4 7,4.67 7,5.5C7,6.33 6.33,7 5.5,7Z" /></svg> Tags</a></li>
                <li><a href="/admin/profile"><svg viewBox="0 0 24 24"><path d="M12,4A4,4 0 0,1 16,8A4,4 0 0,1 12,12A4,4 0 0,1 8,8A4,4 0 0,1 12,4M12,14C16.42,14 20,15.79 20,18V20H4V18C4,15.79 7.58,14 12,14Z" /></svg> Profil</a></li>
            </ul>
        </nav>
        
        <div class="logout">
            <a href="/admin/logout"><svg viewBox="0 0 24 24"><path d="M16,17V14H9V10H16V7L21,12L16,17M14,2A2,2 0 0,1 16,4V6H14V4H5V20H14V18H16V20A2,2 0 0,1 14,22H5A2,2 0 0,1 3,20V4A2,2 0 0,1 5,2H14Z" /></svg> Déconnexion</a>
        </div>
    </aside>
    
    <!-- Main Content -->
    <main class="main-content">
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
    </main>
    
    <script>
        // JavaScript pour interactions
        document.addEventListener('DOMContentLoaded', function() {
            // Auto-génération du slug à partir du nom
            const nomInput = document.querySelector('input[name="nom"]');
            const slugInput = document.querySelector('input[name="slug"]');
            
            if (nomInput && slugInput) {
                nomInput.addEventListener('input', function() {
                    // Transformation simple du nom en slug
                    let slug = this.value.toLowerCase()
                        .replace(/[^\w\s-]/g, '') // Supprime les caractères spéciaux
                        .replace(/[\s_-]+/g, '-') // Remplace espaces et underscores par des tirets
                        .replace(/^-+|-+$/g, ''); // Enlève les tirets au début et à la fin
                    
                    slugInput.value = slug;
                });
            }
        });
    </script>
</body>
</html>