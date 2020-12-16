<div class="card-body">
    <h5 class="card-title"><?= htmlentities($post->getName()) ?></h5>
    <p class="text-muted"><?= $post->getCreatedAt()->format('d F Y H:i') ?></p>
    <p><?= $post->getExcerpt() ?></p>
    <p>
        <a href="<?= $router->url('post', ['id' => $post->getId(), 'slug' => $post->getSlug()]) ?>"" class="btn
        btn-primary">More</a>
    </p>
</div>