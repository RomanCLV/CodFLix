<?php ob_start(); ?>

<div id="home">
    <div class="banner">
        <div class="container">
            <div class="row">
                <div class="col-md-12">
                    <h1 class="title">Cod<span>'Flix</span></h1>
                    <p>
                        <strong>Not Found :'(</strong>
                    </p>
                </div>
            </div>
            <div class="row btn-container">
                <div class="col-md-6 offset-3"><a href="index.php" class="btn btn-block bg-red">Cod'Flix</a></div>
            </div>
        </div>
    </div>
</div>

<?php $content = ob_get_clean(); ?>

<?php require('base.php'); ?>
