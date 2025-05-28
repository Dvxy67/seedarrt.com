<section class="breadcrumb">
    <div class="container">
        <ul>
            <li><a href="/home">Accueil</a></li>
            <li><a href="/catalogue">Catalogue</a></li>
            <li><?= htmlspecialchars($item['nom']) ?></li>
        </ul>
    </div>
</section>

<section class="artwork-detail">
    <div class="container">
        <div class="artwork-container">
            <div class="artwork-gallery">
                <div class="main-image">
                    <img id="mainImage"
                         src="<?= $item['image_url'] ?: '/api/placeholder/600/600' ?>"
                         alt="<?= htmlspecialchars($item['nom']) ?>">
                </div>
                <div class="thumbnail-container">
                    <!-- Miniatures (placeholders here) -->
                    <div class="thumbnail active" data-img="<?= $item['image_url'] ?: '/api/placeholder/600/600' ?>">
                        <img src="<?= $item['image_url'] ?: '/api/placeholder/600/600' ?>" alt="">
                    </div>
                    <!-- Ajouter d'autres vignettes si disponibles -->
                </div>
            </div>

            <div class="artwork-info">
                <h1 class="artwork-title"><?= htmlspecialchars($item['nom']) ?></h1>
                <div class="artwork-price">
                    <?= number_format($item['prix'], 2, ',', ' ') ?> €
                </div>

                <div class="artwork-description">
                    <h3 class="description-title">Description</h3>
                    <div class="description-text">
                        <?= nl2br(htmlspecialchars($item['description'])) ?>
                    </div>
                </div>
                <!-- Autres sections (tags, caractéristiques...) -->
            </div>
        </div>
    </div>
</section>

<!-- Conserver ou externaliser le script de galerie si nécessaire -->
<script>
    const thumbnails = document.querySelectorAll('.thumbnail');
    const mainImage = document.getElementById('mainImage');
    thumbnails.forEach(th => {
        th.addEventListener('click', () => {
            thumbnails.forEach(t => t.classList.remove('active'));
            th.classList.add('active');
            mainImage.src = th.dataset.img;
        });
    });
</script>
