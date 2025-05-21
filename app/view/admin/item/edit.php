<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <title>Modifier l'item <?= htmlspecialchars($item['nom']) ?></title>
</head>
<body>

    <h1>✏️ Modifier l’item : <?= htmlspecialchars($item['nom']) ?></h1>

    <form action="/admin/item/update?id=<?= $item['id_item'] ?>" method="POST">
        <label>Slug :
            <input type="text" name="slug" value="<?= htmlspecialchars($item['slug']) ?>" required>
        </label><br><br>

        <label>Nom :
            <input type="text" name="nom" value="<?= htmlspecialchars($item['nom']) ?>" required>
        </label><br><br>

        <label>Description :<br>
            <textarea name="description" rows="4" cols="50"><?= htmlspecialchars($item['description']) ?></textarea>
        </label><br><br>

        <label>Prix (€) :
            <input type="number" step="0.01" name="prix" value="<?= $item['prix'] ?>" required>
        </label><br><br>

        <label>Prix promo (€) :
            <input type="number" step="0.01" name="prix_promo" value="<?= $item['prix_promo'] ?>">
        </label><br><br>

        <label>Quantité en stock :
            <input type="number" name="quantite_stock" value="<?= $item['quantite_stock'] ?>" required>
        </label><br><br>

        <label>ID de catégorie :
            <input type="number" name="categorie_id" value="<?= $item['categorie_id'] ?>">
        </label><br><br>

        <label>Image (URL ou chemin relatif) :
            <input type="text" name="image_url" value="<?= htmlspecialchars($item['image_url']) ?>">
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
            <input type="number" step="0.001" name="poids" value="<?= $item['poids'] ?>">
        </label><br><br>

        <button type="submit">💾 Enregistrer les modifications</button>
        <a href="/admin/item">Annuler</a>
    </form>

</body>
</html>
