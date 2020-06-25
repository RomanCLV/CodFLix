<?php ob_start(); ?>

<!--Section: Contact v.2-->
<section class="mb-4">
    <div class="row">
        <div class="col-md-3">
            <a href="index.php" class="btn btn-block bg-blue"><span style="color: white">Retour</span></a>
        </div>
    </div>

    <!--Section heading-->
    <h2 class="h1-responsive font-weight-bold text-center my-4">Contactez-nous !</h2>
    <!--Section description-->
    <p class="text-center w-responsive mx-auto mb-5">Une question ? Un problème ? Envoyez-nous un mail.</p>

    <div class="row">

        <!--Grid column-->
        <div class="col-md-9 mb-md-0 mb-5">
            <form id="contact-form" name="contact-form" method="POST">

                <div class="row">
                    <div class="col-md-6">
                        <div class="md-form mb-0">
                            <input type="text" id="name" name="name" class="form-control" required>
                            <label for="name" class="">Nom</label>
                        </div>
                    </div>

                    <div class="col-md-6">
                        <div class="md-form mb-0">
                            <input type="email" id="email" name="email" class="form-control" required>
                            <label for="email" class="">Email</label>
                        </div>
                    </div>
                </div>

                <div class="row">
                    <div class="col-md-12">
                        <div class="md-form mb-0">
                            <input type="text" id="subject" name="subject" class="form-control" required>
                            <label for="subject" class="">Sujet</label>
                        </div>
                    </div>
                </div>

                <div class="row">
                    <div class="col-md-12">
                        <div class="md-form">
                            <textarea type="text" id="message" name="message" rows="2" class="form-control md-textarea" required></textarea>
                            <label for="message">Message</label>
                        </div>
                    </div>
                </div>

                <div class="form-group">
                    <div class="row">
                        <div class="col-md-6">
                            <input type="submit" name="Valider" class="btn btn-primary"/>
                        </div>
                    </div>
                </div>

                <?php
                $error_msg = null;
                $success_msg = null;
                    if (isset($_POST["Valider"])) {
                        $name = strlen($_POST["name"]) > 0 ? $_POST["name"] : null;
                        $email = strlen($_POST["email"]) > 0 ? $_POST["email"] : null;
                        $subject = strlen($_POST["subject"]) > 0 ? $_POST["subject"] : null;
                        $message = strlen($_POST["message"]) > 0 ? $_POST["message"] : null;

                        if ($name != null && $email != null && $subject != null && $message != null) {
                            $message = "Nom : " . $name . "\nMail : " . $email . "\nLe : " . date("j / m / Y") . "\nMessage :\n" . $message;
                            if (mail("contact@codflix.com",
                                $subject, $message, "From: ". $email)) {
                                $success_msg = "Mail envoyé";
                            }
                            else {
                                $error_msg = "Une erreur est survenue";
                            }
                        }
                        else {
                            $error_msg = "Veuillez remplir tous les champs";
                        }
                    }
                ?>



            </form>

            <div class="form-group">
                    <span class="success-msg">
                        <?= isset($success_msg) && $success_msg != null ? $success_msg : null; ?>
                    </span>
                <span class="error-msg">
                        <?= isset($error_msg) && $error_msg != null ? $error_msg : null; ?>
                    </span>
            </div>
        </div>

        <div class="col-md-3 text-center">
            <ul class="list-unstyled mb-0">
                <li><i class="fas fa-map-marker-alt fa-2x"></i>
                    <p>Cergy, Île-de-France, France</p>
                </li>

                <li><i class="fas fa-phone mt-4 fa-2x"></i>
                    <p>+33 1 45 85 43 66</p>
                </li>

                <li><i class="fas fa-envelope mt-4 fa-2x"></i>
                    <p><a href="mailto:contact@codflix.com">contact@codflix.com</a></p>
                </li>
            </ul>
        </div>

    </div>

</section>

<?php $content = ob_get_clean(); ?>

<?php require('dashboard.php'); ?>
