<?php
    ob_start();
?>

<div class="form-group">
    <div class="row">
        <div class="col-md-3">
            <a href="index.php?action=media" class="btn btn-block bg-blue"><span style="color: white">Retour</span></a>
        </div>

        <div class="col-md-5">
            <address class="btn btn-block bg-black">
                <strong>Contacter nous :</strong>
                <a href="mailto:contact@codflix.com">contact@codflix.com</a>
            </address>
        </div>
    </div>
</div>

<?php $content = ob_get_clean(); ?>

<?php require('dashboard.php'); ?>
