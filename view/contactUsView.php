<?php
    ob_start();
?>

<div class="media-detail-main-container">
    <div class="media-detail-container">
        <a href="index.php?action=media" class="back">Retour</a>
        <p>Contacter nous :</p>
        <p>codflix@gmail.com</p>
    </div>
</div>


<?php $content = ob_get_clean(); ?>

<?php require('dashboard.php'); ?>
