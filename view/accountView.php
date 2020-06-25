<?php ob_start(); ?>

<!--Section: Contact v.2-->
<section class="mb-4">
    <div class="row">
        <div class="col-md-3">
            <a href="index.php" class="btn btn-block bg-blue"><span style="color: white">Retour</span></a>
        </div>
    </div>

    <!--Section heading-->
    <h2 class="h1-responsive font-weight-bold text-center my-4">Mon compte</h2>

    <div class="row">

        <div class="col-md-6 mb-md-0 mb-5">
            <form id="contact-form" name="contact-form-email" method="POST">
                <div class="row">
                    <div class="col-md-10">
                        <div class="md-form mb-0">
                            <?php
                                if ($userData["isActive"]):
                            ?>
                                <div class="row">
                                    <div class="col-md-12">
                                        <p class="btn btn-success">Votre compte est activé.</p>
                                    </div>
                                </div>
                            <?php
                                else:
                            ?>
                                <div class="row">
                                    <div class="col-md-12">
                                        <p>Votre compte n'est pas activé.</p>
                                    </div>
                                </div>

                                <div class="row">
                                    <div class="col-md-8">
                                        <input type="submit" name="sendEmailActivation" value="Renvoyer un email de confirmation" class="btn btn-success"/>
                                    </div>
                                </div>
                                <?php
                                    if (isset($success_msg)):
                                ?>
                                    <div class="row">
                                        <div class="col-md-12">
                                            <p><?= $success_msg ?></p>
                                        </div>
                                    </div>
                                <?php
                                    endif;
                                ?>
                            <?php
                                endif;
                            ?>
                        </div>
                    </div>
                </div>
                <br />
                <div class="row">
                    <div class="col-md-10">
                        <div class="md-form mb-0">
                            <input type="email" class="form-control" disabled value="<?= $userData["email"] ?>">
                            <label>Mon email</label>
                        </div>
                    </div>
                </div>
            </form>
        </div>

        <div class="col-md-6 mb-md-0 mb-5">
            <form id="contact-form" name="contact-form-email" method="POST">
                <div class="row">
                    <div class="col-md-12">
                        <p class="btn btn-danger">Not working</p>
                    </div>
                </div>
                <div class="row">
                    <div class="col-md-10">
                        <div class="md-form mb-0">
                            <input type="email" id="newEmail" name="newEmail" class="form-control" >
                            <label for="newEmail" class="">Nouvel email</label>
                        </div>
                    </div>
                </div>
                <div class="row">
                    <div class="col-md-10">
                        <div class="md-form mb-0">
                            <input type="email" id="newEmailConfirm" name="newEmailConfirm" class="form-control"
                                   >
                            <label for="newEmailConfirm" class="">Confirmer le nouvel email</label>
                        </div>
                    </div>
                </div>
                <div class="row">
                    <div class="col-md-8">
                        <input type="submit" name="changeEmail" value="Changer de mail" class="btn btn-success"/>
                    </div>
                </div>
            </form>
            <br />
            <form id="contact-form" name="contact-form-password" method="POST">
                <div class="row">
                    <div class="col-md-12">
                        <p class="btn btn-danger">Not working</p>
                    </div>
                </div>
                <div class="row">
                    <div class="col-md-10">
                        <div class="md-form mb-0">
                            <input type="password" id="currentPassword" name="currentPassword" class="form-control"
                                   required>
                            <label for="currentPassword" class="">Mot de passe actuel</label>
                        </div>
                    </div>
                </div>
                <div class="row">
                    <div class="col-md-10">
                        <div class="md-form mb-0">
                            <input type="password" id="newPassword" name="newPassword" class="form-control" required>
                            <label for="newPassword" class="">Nouveau mot de passe</label>
                        </div>
                    </div>
                </div>
                <div class="row">
                    <div class="col-md-10">
                        <div class="md-form mb-0">
                            <input type="password" id="newPasswordConfirm" name="newPasswordConfirm"
                                   class="form-control" required>
                            <label for="newPasswordConfirm" class="">Confirmer le nouveau mot de passe</label>
                        </div>
                    </div>
                </div>
                <div class="row">
                    <div class="col-md-8">
                        <input type="submit" name="changePassword" value="Changer de mot de passe" class="btn btn-success"/>
                    </div>
                </div>
            </form>
        </div>

    </div>

</section>

<?php $content = ob_get_clean(); ?>

<?php require('dashboard.php'); ?>
