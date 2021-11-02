<?php
// if (!headers_sent($file, $line))
// {
// header("Location: $link");
// exit;
// // Trigger an error here
// }
// else
// {
// echo "Headers sent in $file on line $line";
// exit;
// }
?>
<?php
$this->extend('templates/template');
$this->section('content');
?>

<h1>Hello Home</h1>
<?php if (session()->getFlashdata('msg')) : ?>
    <div class="alert alert-primary" role="alert">
        <?= session()->getFlashdata('msg'); ?>
    </div>
<?php endif; ?>
<form action="/home/save" method="POST">
    <div class="row mb-3">
        <div class="col-sm-10">
            <input type="text" class="form-control" id="url" name="url" required>
        </div>
    </div>
    <button type="submit" class="btn btn-primary">Generate link</button>

</form>

<?= $this->endSection(); ?>