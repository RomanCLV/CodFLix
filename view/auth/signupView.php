<?php ob_start(); ?>

<div class="landscape">
    <div class="bg-black">
        <div class="row no-gutters">
            <div class="col-md-6 full-height bg-white">
                <div class="auth-container">
                    <h2><span>Cod</span>'Flix</h2>
                    <h3>Inscription</h3>

                    <form method="post" action="index.php?action=signup" class="custom-form">

                        <div class="form-group">
                            <label for="email">Adresse email</label>
                            <input type="email" name="email" value="" id="email" class="form-control" required/>
                        </div>

                        <div class="form-group">
                            <label for="password">Mot de passe</label>
                            <input type="password" name="password" id="password" class="form-control" required/>
                        </div>

                        <div class="form-group">
                            <label for="password_confirm">Confirmez votre mot de passe</label>
                            <input type="password" name="password_confirm" id="password_confirm" class="form-control"
                                   required/>
                        </div>

                        <div class="form-group">
                            <div class="row">
                                <div class="col-md-6">
                                    <input type="submit" name="Valider" class="btn btn-block bg-red"/>
                                </div>
                                <div class="col-md-6">
                                    <a href="index.php?action=login" class="btn btn-block bg-blue">Connexion</a>
                                </div>
                            </div>
                        </div>
                        <div class="form-group">
                            <div class="row btn-container">
                                <div class="col-md-6 offset-3">
                                    <a href="index.php?action=contactus"
                                       class="btn btn-block bg-success">Contactez-nous</a>
                                </div>
                            </div>
                        </div>

                        <?php
                            if (isset($_POST["Valider"])) {
                                $result = signUpUser();
                                $success_msg = $result["success_msg"];
                                $error_msg = $result["error_msg"];
                            }
                        ?>
                        <span class="success-msg">
                            <?= isset($success_msg) && $success_msg != null ? $success_msg : null; ?>
                        </span>
                        <span class="error-msg">
                            <?= isset($error_msg) && $error_msg != null ? $error_msg : null; ?>
                        </span>
                    </form>
                </div>
            </div>
            <div class="col-md-6 full-height">
                <div class="auth-container">
                    <h1>Bienvenue sur Cod'Flix !</h1>
                </div>
            </div>
        </div>
    </div>
</div>

<?php $content = ob_get_clean(); ?>

<?php require(__DIR__ . '/../base.php'); ?>
