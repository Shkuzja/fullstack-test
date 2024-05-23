<?php

/** @var array $errors */
/** @var array $comment */

?>
<<?= $this->extend('layout') ?>
<?= $this->section('title') ?>
Комментарии
<?= $this->endSection() ?>

<?= $this->section('content') ?>
<?= form_open('comments/edit/' . $comment['id'], ['id' => 'comment-form']) ?>
<div class="row">
    <div class="col-md-6">
        <input type="hidden" class="txt_csrfname" name="<?= csrf_token() ?>" value="<?= csrf_hash() ?>"/>
        <div id="email-field">
            <label for="email">Адресс электронной почты</label>
            <input id="email" required type="email" name="email" value="<?= $comment['email']; ?>"
                   class="form-control"/>
            <div class="block-error text-danger"><?= ($errors['email'] ?? ''); ?></div>
        </div>
        <br>
        <div id="content-field">
            <label for="content">Комментарий</label>
            <textarea id="content" required name="content" class="form-control"><?= $comment['content']; ?>"</textarea>
            <div class="block-error text-danger"><?= ($errors['content'] ?? ''); ?></div>
        </div>
        <br>
        <div id="created_at-field">
            <label for="created_at">Дата создания</label>
            <input id="created_at" required type="datetime-local" value="<?= $comment['created_at']; ?>"
                   name="created_at" class="form-control"/>
            <div class="block-error text-danger"><?= ($errors['created_at'] ?? ''); ?></div>
        </div>
        <br>
        <button type="submit" class="btn btn-primary"> сохранить</button>
        <br><br>
    </div>
</div>

<?= form_open('form') ?>
<?= $this->endSection() ?>
