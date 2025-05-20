<?php

function render($partial, $data = [], $zone = 'public'): void
{
    // 1. Définir les chemins du squelette et du fichier de contenu partiel (la vue)
    $skeletonPath = SITE_ROOT . "app/view/$zone/skeleton.html";
    $partialPath = SITE_ROOT . "app/view/$zone/$partial";

    // 2. Vérifier que les deux fichiers existent bien
    if (!file_exists($skeletonPath) || !file_exists($partialPath)) {
        http_response_code(500);
        echo "Template not found.";
        return;
    }

    // 3. Charger le squelette HTML comme une chaîne de texte
    $skeleton = file_get_contents($skeletonPath);

    // 4. Charger et capturer le contenu généré par le fichier partiel (vue spécifique)
    ob_start();
    include $partialPath;
    $partialContent = ob_get_clean();

    // 5. Remplacer le titre dans le squelette si une valeur a été fournie
    if(isset($data['head_title'])){
        $skeleton = str_replace('%%HEAD_TITLE%%', $data['head_title'], $skeleton);
    }

    // 6. Injecter dynamiquement la balise <link> CSS si un fichier CSS est défini
    if (isset($data['pageCss'])) {
        $cssLink = '<link rel="stylesheet" href="/css/' . htmlspecialchars($data['pageCss']) . '">';
        $skeleton = str_replace('<!--CSS_DYNAMIC_HOOK-->', $cssLink, $skeleton);
    } else {
        // Retirer le hook s'il n'est pas utilisé
        $skeleton = str_replace('<!--CSS_DYNAMIC_HOOK-->', '', $skeleton);
    }

    // 7. Insérer le contenu HTML principal dans le squelette
    $page = str_replace('%%MAIN_CONTENT%%', $partialContent, $skeleton);
    // 8. Afficher la page finale au navigateur
    echo $page;
}