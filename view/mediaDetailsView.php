<?php
    ob_start();
?>

<script type="text/javascript">
    /**
     * Set url with a new value on event select.onchange()
     * @param val  the new url
     */
    function selectionChanged(val) {
        location.href = val;
    }
</script>

<div class="media-detail-main-container">
    <div class="media-detail-container">
        <a href="index.php?action=media" class="back">Retour</a>
        <p class="title">
            <?= $mediaDetail["title"]; ?>
        </p>
        <p class="info">
            <?= $mediaDetail["type"]; ?> | <?= $mediaGender["name"]; ?> | <?= $mediaDetail["release_date"]; ?>
        </p>

        <p class="summary">
            <?= $mediaDetail["summary"]; ?>
        </p>
    </div>

    <div class="media-detail-video-container">
        <div class="detail-video">
            <iframe allowfullscreen="" frameborder="0" src="<?= $mediaDetail['trailer_url']; ?>" >
            </iframe>
        </div>
    </div>
</div>

<?php
    if ($mediaDetail["type"] === "Série") {
        echo "<div class=\"media-detail-main-container\">";
            echo "<div class=\"media-detail-container\">";

                echo "<div class='saison-episode-container'>";
                    echo "<select name=\"mediaDetailSaison\" id='mediaDetailSaison' onchange='selectionChanged(this.value)'>";
                        foreach ($saisons as $saison) {
                            $link = "index.php?media=" . $_GET["media"] . "&amp;saison=" . $saison . "&amp;episode=1";
                            $selected = $saison == $_GET["saison"] ? "selected" : "";
                            echo "<option value=\"$link\" $selected>Saison $saison</option>";
                        }
                    echo "</select>";

                    echo "<select name=\"mediaDetailEpisode\" id='mediaDetailEpisode' onchange='selectionChanged(this.value)'>";
                        foreach ($episodes as $key => $episode) {
                            $link = "index.php?media=" . $_GET["media"] . "&amp;saison=" . $_GET["saison"] . "&amp;episode=" . ($key + 1);

                            $selected = ($key + 1) == $_GET["episode"] ? "selected" : "";
                            echo "<option value=\"$link\" $selected>$episode</option>";
                        }
                    echo "</select>";


                echo "</div>";

                echo "<p class=\"info\">";
                    echo $episodeSelected['duration'];
                echo "</p>";
                echo "<p class=\"summary\">";
                    echo $episodeSelected['summary'];
                echo "</p>";
            echo "</div>";

            echo "<div class=\"media-detail-video-container\">";
                echo "<div class=\"detail-video\">";
                    echo "<iframe allowfullscreen=\"\" frameborder=\"0\" src=\"" . $episodeSelected["url"] . "\"></iframe>";
                echo "</div>";
            echo "</div>";
        echo "</div>";
    }
?>

<?php $content = ob_get_clean(); ?>

<?php require('dashboard.php'); ?>
