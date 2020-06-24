<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8"/>
    <title>Cod'Flix</title>

    <link href="public/lib/bootstrap/css/bootstrap.min.css" rel="stylesheet"/>
    <link href="public/lib/font-awesome/css/all.min.css" rel="stylesheet"/>

    <link href="public/css/partials/partials.css" rel="stylesheet"/>
    <link href="public/css/layout/layout.css" rel="stylesheet"/>
</head>


<body>
<div class="wrapper d-flex align-items-stretch">
    <nav id="sidebar">
        <h2 class="title">Bienvenue</h2>
        <div class="sidebar-menu">
            <ul>
                <?php
                    if (isset($_SESSION["user_id"]))
                    {

                        if (isset($_GET["action"]) && $_GET["action"] === "media")
                        {
                            echo "<li class=\"active\"><a href=\"index.php?action=media\">Médias</a></li>";
                        }
                        else
                        {
                            echo "<li><a href=\"index.php?action=media\">Médias</a></li>";
                        }

                        if (isset($_GET["action"]) && $_GET["action"] === "history")
                        {
                            echo "<li class=\"active\"><a href=\"index.php?action=history\">Historique</a></li>";
                        }
                        else
                        {
                            echo "<li><a href=\"index.php?action=history\">Historique</a></li>";
                        }

                        if (isset($_GET["action"]) && $_GET["action"] === "contactus")
                        {
                            echo "<li class=\"active\"><a href=\"index.php?action=contactus\">Nous contacter</a></li>";
                        }
                        else
                        {
                            echo "<li><a href=\"index.php?action=contactus\">Nous contacter</a></li>";
                        }
                        echo "<li><a href=\"index.php?action=logout\">Me déconnecter</a></li>";
                    }
                ?>
            </ul>
        </div>
    </nav>

    <!-- Page Content  -->
    <div id="content">
        <div class="header">
            <h2 class="title">Cod<span>'Flix</span></h2>
            <div class="toggle-menu d-block d-md-none">
                <button type="button" id="sidebarCollapse" class="btn btn-primary">
                    <i class="fas fa-bars"></i>
                    <span class="sr-only">Toggle Menu</span>
                </button>
            </div>
        </div>
        <div class="content p-4">
            <?= $content; ?>
        </div>
        <footer>Copyright Cod'Flix</footer>
    </div>
</div>

<script src="public/lib/jquery/js/jquery-3.5.0.min"></script>
<script src="public/lib/bootstrap/js/bootstrap.min.js"></script>

<script src="public/js/script.js"></script>
</body>

</html>
