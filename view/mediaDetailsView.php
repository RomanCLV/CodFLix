<?php ob_start(); ?>

<script type="text/javascript">
    /**
     * Set url with a new value on event select.onchange()
     * @param val  the new url
     */
    function selectionChanged(val) {
        location.href = val;
    }

    const tag = document.createElement('script');

    tag.src = "https://www.youtube.com/iframe_api";
    const firstScriptTag = document.getElementsByTagName('script')[0];
    firstScriptTag.parentNode.insertBefore(tag, firstScriptTag);

    let player;

    function onYouTubeIframeAPIReady() {
        player = new YT.Player('player', {
            events: {
                'onReady': onPlayerReady,
                'onStateChange': onPlayerStateChange
            }
        });
    }

    function onPlayerReady(event) {
        event.target.playVideo();
    }

    let done = false;

    function onPlayerStateChange(event) {
        if (event.data == YT.PlayerState.PLAYING && !done) {
            done = true;
            console.log(done);
        }
    }
    function stopVideo() {

    }
</script>

<div class="media-detail-main-container">
    <div class="media-detail-container">
        <a href="index.php?action=media" class="back">Retour</a>
        <p class="title">
            <?= $mediaDetail["title"]; ?>
        </p>
        <p class="info">
            <?= $mediaDetail["type"]; ?> |
            <?php
                if ($mediaDetail["duration"] != null) {
                    $time = explode(':', $mediaDetail['duration']);
                    if ($time[0] != 0) {
                        echo $time[0] . "h ";
                    }
                    echo $time[1] . "m ";
                    if ($time[2] != 0) {
                        echo $time[2] . "s";
                    }
                    echo " | ";
                }
            ?>
            <?= $mediaGender["name"]; ?> |
            <?php
                $date = explode('-', $mediaDetail["release_date"]);
                echo "$date[2] / $date[1] / $date[0]";
            ?>
        </p>
        <p class="summary">
            <?= $mediaDetail["summary"]; ?>
        </p>
    </div>

    <div class="media-detail-video-container">
        <div class="detail-video">
            <iframe id="<?= $mediaDetail["type"] === "Série" ? "playerSnd" : "player" ?>" src="<?=$mediaDetail['trailer_url'] . "?enablejsapi=1\""?> frameborder='0' allow='encrypted-media;' allowfullscreen></iframe>
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
                    $time = explode(':', $episodeSelected['duration']);
                    if ($time[0] != 0) {
                        echo $time[0] . "h ";
                    }
                    echo $time[1] . "m ";
                    echo $time[2] . "s";
                echo "</p>";
                echo "<p class=\"summary\">";
                    echo $episodeSelected['summary'];
                echo "</p>";
            echo "</div>";

            echo "<div class=\"media-detail-video-container\">";
                echo "<div class=\"detail-video\">";
                    echo "<iframe id=\"player\" src=\"" . $mediaDetail['trailer_url'] . "?enablejsapi=1\"> frameborder='0' allow='encrypted-media;' allowfullscreen></iframe>";
                echo "</div>";
            echo "</div>";
        echo "</div>";
    }
?>

<?php $content = ob_get_clean(); ?>

<?php require('dashboard.php'); ?>
