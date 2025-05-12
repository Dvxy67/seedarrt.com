<?php

function render($partial, $data = []): void
{
    $skeletonPath = SITE_ROOT . 'app/view/public/skeleton.html';
    $partialPath = SITE_ROOT . "app/view/public/$partial";
    if (!file_exists($skeletonPath) || !file_exists($partialPath)) {
        http_response_code(500);
        echo "Template not found.";
        return;
    }

    // Load the skeleton
    $skeleton = file_get_contents($skeletonPath);

    // Load and parse the partial
    ob_start();
    include $partialPath;
    $partialContent = ob_get_clean();

    // Replace the placeholder
    if(isset($data['head_title'])){
        $skeleton = str_replace('%%HEAD_TITLE%%', $data['head_title'], $skeleton);
    }
    $page = str_replace('%%MAIN_CONTENT%%', $partialContent, $skeleton);

    echo $page;
}