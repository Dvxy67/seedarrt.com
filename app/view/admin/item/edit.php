
    <h1>✏️ Modifier l’item : <?= htmlspecialchars($items['nom']) ?></h1>

    <form action="/admin/item/update/<?= $items['id_item'] ?>" method="POST">
        <label>Slug :
            <input type="text" name="slug" value="<?= htmlspecialchars($items['slug']) ?>" required>
        </label><br><br>

        <label>Nom :
            <input type="text" name="nom" value="<?= htmlspecialchars($items['nom']) ?>" required>
        </label><br><br>

        <label>Description :<br>
            <textarea name="description" rows="4" cols="50"><?= htmlspecialchars($items['description']) ?></textarea>
        </label><br><br>

        <label>Prix (€) :
            <input type="number" step="0.01" name="prix" value="<?= $items['prix'] ?>" required>
        </label><br><br>

        <label>Prix promo (€) :
            <input type="number" step="0.01" name="prix_promo" value="<?= $items['prix_promo'] ?>">
        </label><br><br>

        <label>Quantité en stock :
            <input type="number" name="quantite_stock" value="<?= $items['quantite_stock'] ?>" required>
        </label><br><br>

        <label>ID de catégorie :
            <input type="number" name="categorie_id" value="<?= $items['categorie_id'] ?>">
        </label><br><br>

        <label>Image (URL ou chemin relatif) :
            <input type="text" name="image_url" value="<?= htmlspecialchars($items['image_url']) ?>">
        </label><br><br>

        <label>Statut :
            <select name="statut">
                <option value="actif" <?= $item['statut'] === 'actif' ? 'selected' : '' ?>>Actif</option>
                <option value="inactif" <?= $item['statut'] === 'inactif' ? 'selected' : '' ?>>Inactif</option>
                <option value="en_promotion" <?= $item['statut'] === 'en_promotion' ? 'selected' : '' ?>>En promotion</option>
                <option value="rupture" <?= $item['statut'] === 'rupture' ? 'selected' : '' ?>>Rupture</option>
            </select>
        </label><br><br>

        <label>Poids (kg) :
            <input type="number" step="0.001" name="poids" value="<?= $items['poids'] ?>">
        </label><br><br>

        <button type="submit">💾 Enregistrer les modifications</button>
        <a href="/admin/item">Annuler</a>
    </form>
