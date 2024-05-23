<?php

/** @var array $comments */
/** @var \CodeIgniter\Pager\Pager $pager */
?>
<div class="container">
    <?php foreach ($comments as $comment): ?>
        <div class="row alert alert-warning">
            <div class="col-md-1">
                <?= $comment['id'] ?>
            </div>
            <div class="col-md-2">
                <?= $comment['email'] ?><br> <?= $comment['created_at'] ?>
            </div>
            <div class="col-md-7">
                <?= $comment['content'] ?>
            </div>
            <div class="col-md-2">
                <a href="<?= site_url('comments/edit/' . $comment['id']); ?>" class="btn btn-primary">изменить</a>
            </div>
        </div>
    <?php endforeach; ?>
    <div id="comments-pager">
        <?= $pager->links() ?>
    </div>
</div>

