    
<?php
function home() {

    // Exemple : récupération de données à afficher dans le dashboard
    $stmt = db()->query('SELECT COUNT(*) as total_items FROM item');
    $result = $stmt->fetch();
    $totalItems = $result['total_items'];

    $pageCss = 'styles_dashboard.css';

    render('dashboard.php', [
        'totalItems' => $totalItems,
        'head_tittle' => 'Dashboard | Admin | Seedarrt',
        'pageCss' => $pageCss
        ], 
        'admin'
);
}