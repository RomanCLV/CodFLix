<?php
    ob_start();
?>

<div class="media-detail-main-container">
    <div class="media-detail-container">
        <a href="index.php" class="back">Retour</a>
        <address>
            <strong>Contacter nous :</strong>
            <a href="mailto:contact@codflix.com">contact@codflix.com</a>
        </address>
    </div>
</div>


<?php $content = ob_get_clean(); ?>

<?php require('dashboard.php'); ?>
