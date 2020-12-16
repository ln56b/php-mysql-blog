<?php

use App\Helpers\Text;
use App\Model\Post;

include '../config/conf.php';

$title = 'My website';
/** @var TYPE_NAME $db */
/** @var TYPE_NAME $user */
/** @var TYPE_NAME $password */
$pdo = new PDO('mysql:dbname='. $db . ';host=127.0.0.1', $user, $password, [
    PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION
]);
$count = (int)$pdo->query('SELECT COUNT(id) FROM post')->fetch(PDO::FETCH_NUM)[0];
// If no page param in url, set to 1.
$currentPage = (int)($_GET['page'] ?? 1);
// If this equals to 0 because the conversion ton int meant nothing, set to 1.
if ($currentPage <= 0) {
    throw new Exception('Invalid page number');
}
$query = $pdo->query("SELECT * FROM post ORDER BY created_at DESC LIMIT 12");
$posts = $query->fetchAll(PDO::FETCH_CLASS, Post::class);
?>

<h1>Posts</h1>

<div class="row">
    <?php foreach ($posts as $post): ?>
        <div class="col-md-3">
            <div class="card mb-3">
                <?php require 'card.php' ?>
            </div>
        </div>
    <?php endforeach; ?>
</div>
