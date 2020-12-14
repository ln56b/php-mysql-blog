<!doctype html>
<html lang="en" class="h-100">
<head>
    <meta charset="UTF-8">
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title><?= $title ?? 'My website' ?></title>
    <!-- CSS only -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0-beta1/dist/css/bootstrap.min.css" rel="stylesheet"
          integrity="sha384-giJF6kkoqNQ00vy+HMDP7azOuL0xtbfIcaT9wjKHr8RbDVddVHyTfAAsrekwKmP1" crossorigin="anonymous">
</head>
<body class="d-flex flex-column h-100">
<nav class="navbar navbar-expand-lg navbar-dark bg-primary">
    <a href="" class="navbar-brand">My site</a>
</nav>

<div class="container" class="mt-4">
    <?= $content ?>
</div>
<footer class="bg-light py-4 footer mt-auto">
    <div class="container">
        <?php if (defined('DEBUG_TIME')): ?>
        This page was generated in <?= 1000 * round(microtime(true) - DEBUG_TIME )?> ms
        <?php endif; ?>
    </div>
</footer>
</body>
</html>
