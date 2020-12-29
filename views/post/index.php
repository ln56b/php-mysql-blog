<?php

use App\Connection;
use App\Helpers\Text;
use App\Model\Post;
use App\URL;
use PharIo\Manifest\ElementCollectionException;

$title = 'My website';
include '../config/conf.php';
/** @var TYPE_NAME $db */
/** @var TYPE_NAME $user */
/** @var TYPE_NAME $password */
$pdo = Connection::getPDO($db, $user, $password);
$page = $_GET['page'] ?? 1;

$currentPage = URL::getPositiveInt('page', 1);

$count = (int)$pdo->query('SELECT COUNT(id) FROM post')->fetch(PDO::FETCH_NUM)[0];
$perPage = 12;
$pages = ceil($count / $perPage);
// If no page param in url, set to 1.

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
