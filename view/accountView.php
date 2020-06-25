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

            </form>

        </div>

    </div>

</section>

<?php $content = ob_get_clean(); ?>

<?php require('dashboard.php'); ?>
