<?php

use App\Helpers\Text;
use App\Model\Post;
use PharIo\Manifest\ElementCollectionException;

include '../config/conf.php';

$title = 'My website';
/** @var TYPE_NAME $db */
/** @var TYPE_NAME $user */
/** @var TYPE_NAME $password */
$pdo = new PDO('mysql:dbname=' . $db . ';host=127.0.0.1', $user, $password, [
    PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION
]);

$page = $_GET['page'] ?? 1;

// Useful for SEO as it avoids an infinity of url made of float numbers
if (!filter_var($page, FILTER_VALIDATE_INT)) {
    throw new Exception('The page number should be an integer');
}

// Useful for SEO as well as page 1 does not exist in params
if ($page === '1') {
    header('Location: ' . $router->url('home'));
    http_response_code(301);
    exit();
}
$count = (int)$pdo->query('SELECT COUNT(id) FROM post')->fetch(PDO::FETCH_NUM)[0];
$perPage = 12;
$pages = ceil($count / $perPage);
// If no page param in url, set to 1.
$currentPage = (int)$page;

// If this equals to 0 because the conversion ton int meant nothing, set to 1.
if ($currentPage <= 0) {
    throw new Exception('Invalid page number');
}
if ($currentPage > $pages) {
    throw new Exception('This page does not exist');
}
$offset = $perPage * ($currentPage - 1);
$query = $pdo->query("SELECT * FROM post ORDER BY created_at DESC LIMIT $perPage OFFSET $offset");
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

<div class="d-flex justify-content-between my-4">
    <?php if ($currentPage > 1): ?>
        <?php
        $link = $router->url('home');
        if ($currentPage > 2) $link .= '?page=' . ($currentPage - 1);
        ?>
        <a href="<?= $link ?>" class="btn btn-primary">&laquo; Previous page</a>
    <?php endif ?>
    <?php if ($currentPage < $pages): ?>
        <a href="<?= $router->url('home') ?>?page=<?= $currentPage + 1 ?>" class="btn btn-primary ml-auto">Next page
            &raquo;</a>
    <?php endif ?>
</div>
