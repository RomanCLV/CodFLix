<?php
    ob_start();
?>

<div class="landscape">
  <div class="bg-black">
    <div class="row no-gutters">
      <div class="col-md-6 full-height bg-white">
        <div class="auth-container">
          <h2><span>Cod</span>'Flix</h2>
          <h3>Activation</h3>
            <?php
                if ( isset($_GET["id"]) )
                {
                    User::Activation($_GET["id"]);
                }
                else
                {
                    $error_msg = "Aucun ID détecté";
                }
            ?>
            <form method="post" action="index.php?action=signup" class="custom-form">
                <div class="form-group">
                    <div class="row">
                        <div class="col-md-12">
                            <a href="index.php?action=login" class="btn btn-block bg-blue">Connexion</a>
                        </div>
                    </div>
                </div>
                <span class="error-msg">
                  <?= isset($error_msg) && $error_msg != null ? $error_msg : null; ?>
                </span>
            </form>
        </div>
      </div>
      <div class="col-md-6 full-height">
        <div class="auth-container">
          <h1>Merci d'avoir activé votre compte Cod'Flix !</h1>
        </div>
      </div>
    </div>
  </div>
</div>

<?php $content = ob_get_clean(); ?>

<?php require( __DIR__ . '/../base.php'); ?>
