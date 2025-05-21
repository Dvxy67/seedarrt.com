<main class="main-content">
        <header class="dashboard-header">
            <h2>Tableau de bord</h2>
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
        
        <div class="dashboard-stats">
            <div class="stat-card">
                <div class="stat-icon">
                    <svg viewBox="0 0 24 24"><path d="M12,4.5C7,4.5 2.73,7.61 1,12C2.73,16.39 7,19.5 12,19.5C17,19.5 21.27,16.39 23,12C21.27,7.61 17,4.5 12,4.5M12,17A5,5 0 0,1 7,12A5,5 0 0,1 12,7A5,5 0 0,1 17,12A5,5 0 0,1 12,17M12,9A3,3 0 0,0 9,12A3,3 0 0,0 12,15A3,3 0 0,0 15,12A3,3 0 0,0 12,9Z" /></svg>
                </div>
                <div class="stat-info">
                    <h3>1,254</h3>
                    <p>Vues totales</p>
                </div>
            </div>
            
            <div class="stat-card">
                <div class="stat-icon">
                    <svg viewBox="0 0 24 24"><path d="M18,17H10.5L12.5,15H18M6,17V15H8.5L6,17M14,13H18V11H14M6,13H12V11H6M18,9H13L14.5,7.5H18M6,9H9.5L11,7.5H6M6,5V3H18V5H6Z" /></svg>
                </div>
                <div class="stat-info">
                    <h3>28</h3>
                    <p>Œuvres en ligne</p>
                </div>
            </div>
            
            <div class="stat-card">
                <div class="stat-icon">
                    <svg viewBox="0 0 24 24"><path d="M12,18.54L19.37,12.8L21,14.07L12,21.07L3,14.07L4.62,12.81L12,18.54M12,16L3,9L12,2L21,9L12,16M12,4.53L6.26,9L12,13.47L17.74,9L12,4.53Z" /></svg>
                </div>
                <div class="stat-info">
                    <h3>12</h3>
                    <p>Tags actifs</p>
                </div>
            </div>
            
            <div class="stat-card">
                <div class="stat-icon">
                    <svg viewBox="0 0 24 24"><path d="M17,18C15.89,18 15,18.89 15,20A2,2 0 0,0 17,22A2,2 0 0,0 19,20C19,18.89 18.1,18 17,18M1,2V4H3L6.6,11.59L5.24,14.04C5.09,14.32 5,14.65 5,15A2,2 0 0,0 7,17H19V15H7.42A0.25,0.25 0 0,1 7.17,14.75C7.17,14.7 7.18,14.66 7.2,14.63L8.1,13H15.55C16.3,13 16.96,12.58 17.3,11.97L20.88,5.5C20.95,5.34 21,5.17 21,5A1,1 0 0,0 20,4H5.21L4.27,2M7,18C5.89,18 5,18.89 5,20A2,2 0 0,0 7,22A2,2 0 0,0 9,20C9,18.89 8.1,18 7,18Z" /></svg>
                </div>
                <div class="stat-info">
                    <h3>5</h3>
                    <p>Ventes ce mois</p>
                </div>
            </div>
        </div>
        
        <!-- OEUVRES SECTION -->
        <section class="content-section" id="oeuvres-section">
            <div class="section-header">
                <h3>Gestion des Œuvres</h3>
                <button class="btn-add" id="add-artwork-btn">
                    <svg viewBox="0 0 24 24"><path d="M19,13H13V19H11V13H5V11H11V5H13V11H19V13Z" /></svg>
                    Ajouter une œuvre
                </button>
            </div>
            
            <div class="table-container">
                <table class="data-table">
                    <thead>
                        <tr>
                            <th>Image</th>
                            <th>Titre</th>
                            <th>Date</th>
                            <th>Prix (€)</th>
                            <th>Status</th>
                            <th>Tags</th>
                            <th>Actions</th>
                        </tr>
                    </thead>
                    <tbody>
                        <tr>
                            <td><img src="/api/placeholder/60/45" alt="Œuvre 1" class="artwork-thumbnail"></td>
                            <td>Paysage de montagne</td>
                            <td>12/03/2025</td>
                            <td>1 200</td>
                            <td><span class="status-badge available">Disponible</span></td>
                            <td>
                                <div class="tag-list">
                                    <span class="tag">Montagne</span>
                                    <span class="tag">Nature</span>
                                </div>
                            </td>
                            <td>
                                <div class="action-buttons">
                                    <button class="btn-edit"><svg viewBox="0 0 24 24"><path d="M20.71,7.04C21.1,6.65 21.1,6 20.71,5.63L18.37,3.29C18,2.9 17.35,2.9 16.96,3.29L15.12,5.12L18.87,8.87M3,17.25V21H6.75L17.81,9.93L14.06,6.18L3,17.25Z" /></svg></button>
                                    <button class="btn-delete"><svg viewBox="0 0 24 24"><path d="M19,4H15.5L14.5,3H9.5L8.5,4H5V6H19M6,19A2,2 0 0,0 8,21H16A2,2 0 0,0 18,19V7H6V19Z" /></svg></button>
                                </div>
                            </td>
                        </tr>
                        <tr>
                            <td><img src="/api/placeholder/60/45" alt="Œuvre 2" class="artwork-thumbnail"></td>
                            <td>Abstraction bleue</td>
                            <td>05/04/2025</td>
                            <td>850</td>
                            <td><span class="status-badge sold">Vendu</span></td>
                            <td>
                                <div class="tag-list">
                                    <span class="tag">Abstrait</span>
                                    <span class="tag">Bleu</span>
                                </div>
                            </td>
                            <td>
                                <div class="action-buttons">
                                    <button class="btn-edit"><svg viewBox="0 0 24 24"><path d="M20.71,7.04C21.1,6.65 21.1,6 20.71,5.63L18.37,3.29C18,2.9 17.35,2.9 16.96,3.29L15.12,5.12L18.87,8.87M3,17.25V21H6.75L17.81,9.93L14.06,6.18L3,17.25Z" /></svg></button>
                                    <button class="btn-delete"><svg viewBox="0 0 24 24"><path d="M19,4H15.5L14.5,3H9.5L8.5,4H5V6H19M6,19A2,2 0 0,0 8,21H16A2,2 0 0,0 18,19V7H6V19Z" /></svg></button>
                                </div>
                            </td>
                        </tr>
                        <tr>
                            <td><img src="/api/placeholder/60/45" alt="Œuvre 3" class="artwork-thumbnail"></td>
                            <td>Portrait en lumière</td>
                            <td>18/04/2025</td>
                            <td>1 500</td>
                            <td><span class="status-badge reserved">Réservé</span></td>
                            <td>
                                <div class="tag-list">
                                    <span class="tag">Portrait</span>
                                    <span class="tag">Lumière</span>
                                </div>
                            </td>
                            <td>
                                <div class="action-buttons">
                                    <button class="btn-edit"><svg viewBox="0 0 24 24"><path d="M20.71,7.04C21.1,6.65 21.1,6 20.71,5.63L18.37,3.29C18,2.9 17.35,2.9 16.96,3.29L15.12,5.12L18.87,8.87M3,17.25V21H6.75L17.81,9.93L14.06,6.18L3,17.25Z" /></svg></button>
                                    <button class="btn-delete"><svg viewBox="0 0 24 24"><path d="M19,4H15.5L14.5,3H9.5L8.5,4H5V6H19M6,19A2,2 0 0,0 8,21H16A2,2 0 0,0 18,19V7H6V19Z" /></svg></button>
                                </div>
                            </td>
                        </tr>
                        <tr>
                            <td><img src="/api/placeholder/60/45" alt="Œuvre 4" class="artwork-thumbnail"></td>
                            <td>Nature morte</td>
                            <td>02/05/2025</td>
                            <td>950</td>
                            <td><span class="status-badge available">Disponible</span></td>
                            <td>
                                <div class="tag-list">
                                    <span class="tag">Nature morte</span>
                                    <span class="tag">Classique</span>
                                </div>
                            </td>
                            <td>
                                <div class="action-buttons">
                                    <button class="btn-edit"><svg viewBox="0 0 24 24"><path d="M20.71,7.04C21.1,6.65 21.1,6 20.71,5.63L18.37,3.29C18,2.9 17.35,2.9 16.96,3.29L15.12,5.12L18.87,8.87M3,17.25V21H6.75L17.81,9.93L14.06,6.18L3,17.25Z" /></svg></button>
                                    <button class="btn-delete"><svg viewBox="0 0 24 24"><path d="M19,4H15.5L14.5,3H9.5L8.5,4H5V6H19M6,19A2,2 0 0,0 8,21H16A2,2 0 0,0 18,19V7H6V19Z" /></svg></button>
                                </div>
                            </td>
                        </tr>
                    </tbody>
                </table>
            </div>
            
            <!-- Add Artwork Modal -->
            <div class="modal" id="add-artwork-modal">
                <div class="modal-content">
                    <div class="modal-header">
                        <h3>Ajouter une nouvelle œuvre</h3>
                        <button class="modal-close">&times;</button>
                    </div>
                    <div class="modal-body">
                        <form class="form">
                            <div class="form-group">
                                <input type="text" class="form-control" id="artwork-title" placeholder="Titre de l'œuvre">
                                <span class="form-label">Titre</span>
                            </div>
                            
                            <div class="form-row">
                                <div class="form-group half">
                                    <input type="date" class="form-control" id="artwork-date">
                                    <span class="form-label">Date de création</span>
                                </div>
                                
                                <div class="form-group half">
                                    <input type="number" class="form-control" id="artwork-price" placeholder="Prix en €">
                                    <span class="form-label">Prix (€)</span>
                                </div>
                            </div>
                            
                            <div class="form-group">
                                <select class="form-control" id="artwork-status">
                                    <option value="available">Disponible</option>
                                    <option value="reserved">Réservé</option>
                                    <option value="sold">Vendu</option>
                                </select>
                                <span class="form-label">Statut</span>
                            </div>
                            
                            <div class="form-group">
                                <div class="tag-selector">
                                    <span class="selected-tag">Nature<button class="remove-tag">&times;</button></span>
                                    <span class="selected-tag">Montagne<button class="remove-tag">&times;</button></span>
                                    <input type="text" class="tag-input" placeholder="Ajouter des tags...">
                                </div>
                                <span class="form-label">Tags</span>
                            </div>
                            
                            <div class="form-group">
                                <textarea class="form-control" id="artwork-description" placeholder="Description de l'œuvre" rows="4"></textarea>
                                <span class="form-label">Description</span>
                            </div>
                            
                            <div class="form-group">
                                <div class="file-upload">
                                    <input type="file" id="artwork-image" class="file-input">
                                    <label for="artwork-image" class="file-label">
                                        <svg viewBox="0 0 24 24"><path d="M19,13H13V19H11V13H5V11H11V5H13V11H19V13Z" /></svg>
                                        <span>Sélectionner une image</span>
                                    </label>
                                    <div class="file-preview" id="file-preview"></div>
                                </div>
                            </div>
                            
                            <div class="form-buttons">
                                <button type="button" class="btn-cancel">Annuler</button>
                                <button type="submit" class="btn-save">Enregistrer</button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </section>
        
        <!-- TAGS SECTION -->
        <section class="content-section" id="tags-section">
            <div class="section-header">
                <h3>Gestion des Tags</h3>
                <button class="btn-add" id="add-tag-btn">
                    <svg viewBox="0 0 24 24"><path d="M19,13H13V19H11V13H5V11H11V5H13V11H19V13Z" /></svg>
                    Ajouter un tag
                </button>
            </div>
            
            <div class="tag-cards">
                <div class="tag-card">
                    <div class="tag-header">
                        <h4>Nature</h4>
                        <div class="tag-stats">18 œuvres</div>
                    </div>
                    <div class="tag-actions">
                        <button class="btn-edit"><svg viewBox="0 0 24 24"><path d="M20.71,7.04C21.1,6.65 21.1,6 20.71,5.63L18.37,3.29C18,2.9 17.35,2.9 16.96,3.29L15.12,5.12L18.87,8.87M3,17.25V21H6.75L17.81,9.93L14.06,6.18L3,17.25Z" /></svg></button>
                        <button class="btn-delete"><svg viewBox="0 0 24 24"><path d="M19,4H15.5L14.5,3H9.5L8.5,4H5V6H19M6,19A2,2 0 0,0 8,21H16A2,2 0 0,0 18,19V7H6V19Z" /></svg></button>
                    </div>
                </div>
                
                <div class="tag-card">
                    <div class="tag-header">
                        <h4>Abstrait</h4>
                        <div class="tag-stats">7 œuvres</div>
                    </div>
                    <div class="tag-actions">
                        <button class="btn-edit"><svg viewBox="0 0 24 24"><path d="M20.71,7.04C21.1,6.65 21.1,6 20.71,5.63L18.37,3.29C18,2.9 17.35,2.9 16.96,3.29L15.12,5.12L18.87,8.87M3,17.25V21H6.75L17.81,9.93L14.06,6.18L3,17.25Z" /></svg></button>
                        <button class="btn-delete"><svg viewBox="0 0 24 24"><path d="M19,4H15.5L14.5,3H9.5L8.5,4H5V6H19M6,19A2,2 0 0,0 8,21H16A2,2 0 0,0 18,19V7H6V19Z" /></svg></button>
                    </div>
                </div>
                
                <div class="tag-card">
                    <div class="tag-header">
                        <h4>Portrait</h4>
                        <div class="tag-stats">5 œuvres</div>
                    </div>
                    <div class="tag-actions">
                        <button class="btn-edit"><svg viewBox="0 0 24 24"><path d="M20.71,7.04C21.1,6.65 21.1,6 20.71,5.63L18.37,3.29C18,2.9 17.35,2.9 16.96,3.29L15.12,5.12L18.87,8.87M3,17.25V21H6.75L17.81,9.93L14.06,6.18L3,17.25Z" /></svg></button>
                        <button class="btn-delete"><svg viewBox="0 0 24 24"><path d="M19,4H15.5L14.5,3H9.5L8.5,4H5V6H19M6,19A2,2 0 0,0 8,21H16A2,2 0 0,0 18,19V7H6V19Z" /></svg></button>
                    </div>
                </div>
                
                <div class="tag-card">
                    <div class="tag-header">
                        <h4>Montagne</h4>
                        <div class="tag-stats">4 œuvres</div>
                    </div>
                    <div class="tag-actions">
                        <button class="btn-edit"><svg viewBox="0 0 24 24"><path d="M20.71,7.04C21.1,6.65 21.1,6 20.71,5.63L18.37,3.29C18,2.9 17.35,2.9 16.96,3.29L15.12,5.12L18.87,8.87M3,17.25V21H6.75L17.81,9.93L14.06,6.18L3,17.25Z" /></svg></button>
                        <button class="btn-delete"><svg viewBox="0 0 24 24"><path d="M19,4H15.5L14.5,3H9.5L8.5,4H5V6H19M6,19A2,2 0 0,0 8,21H16A2,2 0 0,0 18,19V7H6V19Z" /></svg></button>
                    </div>
                </div>
                
                <div class="tag-card">
                    <div class="tag-header">
                        <h4>Lumière</h4>
                        <div class="tag-stats">3 œuvres</div>
                    </div>
                    <div class="tag-actions">
                        <button class="btn-edit"><svg viewBox="0 0 24 24"><path d="M20.71,7.04C21.1,6.65 21.1,6 20.71,5.63L18.37,3.29C18,2.9 17.35,2.9 16.96,3.29L15.12,5.12L18.87,8.87M3,17.25V21H6.75L17.81,9.93L14.06,6.18L3,17.25Z" /></svg></button>
                        <button class="btn-delete"><svg viewBox="0 0 24 24"><path d="M19,4H15.5L14.5,3H9.5L8.5,4H5V6H19M6,19A2,2 0 0,0 8,21H16A2,2 0 0,0 18,19V7H6V19Z" /></svg></button>
                    </div>
                </div>
                
                <div class="tag-card">
                    <div class="tag-header">
                        <h4>Bleu</h4>
                        <div class="tag-stats">3 œuvres</div>
                    </div>
                    <div class="tag-actions">
                        <button class="btn-edit"><svg viewBox="0 0 24 24"><path d="M20.71,7.04C21.1,6.65 21.1,6 20.71,5.63L18.37,3.29C18,2.9 17.35,2.9 16.96,3.29L15.12,5.12L18.87,8.87M3,17.25V21H6.75L17.81,9.93L14.06,6.18L3,17.25Z" /></svg></button>
                        <button class="btn-delete"><svg viewBox="0 0 24 24"><path d="M19,4H15.5L14.5,3H9.5L8.5,4H5V6H19M6,19A2,2 0 0,0 8,21H16A2,2 0 0,0 18,19V7H6V19Z" /></svg></button>
                    </div>
                </div>
                
                <div class="tag-card">
                    <div class="tag-header">
                        <h4>Classique</h4>
                        <div class="tag-stats">2 œuvres</div>
                    </div>
                    <div class="tag-actions">
                        <button class="btn-edit"><svg viewBox="0 0 24 24"><path d="M20.71,7.04C21.1,6.65 21.1,6 20.71,5.63L18.37,3.29C18,2.9 17.35,2.9 16.96,3.29L15.12,5.12L18.87,8.87M3,17.25V21H6.75L17.81,9.93L14.06,6.18L3,17.25Z" /></svg></button>
                        <button class="btn-delete"><svg viewBox="0 0 24 24"><path d="M19,4H15.5L14.5,3H9.5L8.5,4H5V6H19M6,19A2,2 0 0,0 8,21H16A2,2 0 0,0 18,19V7H6V19Z" /></svg></button>
                    </div>
                </div>
            </div>
            
            <!-- Add Tag Modal -->
            <div class="modal" id="add-tag-modal">
                <div class="modal-content">
                    <div class="modal-header">
                        <h3>Ajouter un nouveau tag</h3>
                        <button class="modal-close">&times;</button>
                    </div>
                    <div class="modal-body">
                        <form class="form">
                            <div class="form-group">
                                <input type="text" class="form-control" id="tag-name" placeholder="Nom du tag">
                                <span class="form-label">Nom</span>
                            </div>
                            
                            <div class="form-group">
                                <textarea class="form-control" id="tag-description" placeholder="Description du tag (optionnel)" rows="3"></textarea>
                                <span class="form-label">Description</span>
                            </div>
                            
                            <div class="form-buttons">
                                <button type="button" class="btn-cancel">Annuler</button>
                                <button type="submit" class="btn-save">Enregistrer</button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </section>
    </main>