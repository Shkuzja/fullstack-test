<<?= $this->extend('layout') ?>
<?= $this->section('title') ?>
Комментарии
<?= $this->endSection() ?>

<?= $this->section('content') ?>

<div class="alert alert-primary">
    <h1>Контент который обсуждается в комментариях</h1>
</div>
<div id="comments-container"></div>
<br>

<?= form_open('comments', ['id' => 'comment-form']) ?>

<div class="row">
    <div class="col-md-6">
        <input type="hidden" class="txt_csrfname" name="<?= csrf_token() ?>" value="<?= csrf_hash() ?>"/>
        <div id="email-field">
            <label for="email">Адресс электронной почты</label>
            <input id="email" required type="email" name="email" class="form-control"/>
            <div class="block-error text-danger"></div>
        </div>
        <br>
        <div id="content-field">
            <label for="content">Комментарий</label>
            <textarea id="content" required name="content" class="form-control"></textarea>
            <div class="block-error text-danger"></div>
        </div>
        <br>
        <button type="submit" class="btn btn-primary"> отправить комментарий</button>
        <br><br>
    </div>
</div>

<?= form_open('form') ?>
</div>

<script type="text/javascript">
    $(document).ready(function () {
        $(document).on('submit', '#comment-form', function (e) {
            e.preventDefault();
            $form = $(e.target);
            $form.find('.block-error').html('');

            $.ajax({
                url: $form.prop('action'),
                data: $form.serializeArray(),
                method: "POST"
            }).done(function (response) {
                if (response.success) {
                    $form.find(':input').val('');
                    getComments();
                } else {
                    for (const key in response.errors) {
                        $('#' + key + '-field .block-error').html(response.errors[key]);
                    }
                }
            }).error(function () {
                alert('Произошла ошибка.')
            });

            alert('dsd');
        });

        $(document).on('click', '#comments-pager a', function (e) {
            e.preventDefault();
            getComments(getURLParameter($(e.currentTarget).attr('href'), 'page'))
        });

        getComments();

        function getURLParameter(url, name) {
            return (RegExp(name + '=' + '(.+?)(&|$)').exec(url) || [, null])[1];
        }

        function getComments(page = 1) {
            $.ajax({
                url: '<?= site_url('comments/get-comments')?>',
                data: {page: page},
                method: "GET"
            }).done(function (response) {
                $('#comments-container').html(response.content);
            })
        }
    });
</script>

<?= $this->endSection() ?>