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

<div class="container fa-text-height bg-dark">

    <div class="row text-white text-white">
        <div class="col-xs-12 col-md-6">
            <div class="row">
                <div class="col-md-4">
                    <a href="index.php?action=media" class="btn btn-block bg-blue"><span style="color: white">Retour</span></a>
                </div>
            </div>

            <p class="display-4">
                <?= $mediaDetail["title"]; ?>
            </p>
            <p class="text-md-center h4">
                <span class="badge badge-pill badge-secondary"><?= $mediaDetail["type"]; ?></span>
                <?php
                    if ($mediaDetail["duration"] != null) {
                        $time = explode(':', $mediaDetail['duration']);

                        echo "<span class=\"badge badge-pill badge-secondary\">";
                        if ($time[0] != 0) {
                            echo $time[0] . "h ";
                        }
                        echo $time[1] . "m ";
                        if ($time[2] != 0) {
                            echo $time[2] . "s";
                        }
                        echo "</span>";
                    }
                ?>
                <span class="badge badge-pill badge-secondary"><?= $mediaGender["name"]; ?></span>
                <span class="badge badge-pill badge-secondary">
                    <?php
                        $date = explode('-', $mediaDetail["release_date"]);
                        echo "$date[2] / $date[1] / $date[0]";
                    ?>
                </span>
            </p>
            <p class="text-justify">
                <?= $mediaDetail["summary"]; ?>
            </p>
        </div>
        <div class="col-xs-12 col-md-6">
            <div class="embed-responsive embed-responsive-16by9">
                <iframe id="<?= $mediaDetail["type"] === "Série" ? "playerSnd" : "player" ?>"
                        src="<?=$mediaDetail['trailer_url'] . "?enablejsapi=1"?>"
                        frameborder='0' allow='encrypted-media;' allowfullscreen></iframe>
            </div>
        </div>
    </div>
    <br />
    <?php
        if ($mediaDetail["type"] === "Série"):
    ?>
        <div class="row text-white text-white">
            <div class="col-xs-12 col-md-6">
                <div class="row">
                    <div class="col-md-4">
                        <select class="custom-select " name="mediaDetailSaison"  id='mediaDetailSaison'  onchange='selectionChanged(this.value)'>
                            <?php
                            foreach ($saisons as $saison):
                                $selected = $saison == $_GET["saison"] ? "selected" : "";
                                $link = "index.php?media=" . $_GET["media"] . "&amp;saison=" . $saison . "&amp;episode=1";
                                ?>
                                <option value='<?= $link?> '<?= $selected?>>Saison <?= $saison?></option>
                            <?php endforeach; ?>
                        </select>
                    </div>
                    <div class="col-md-4">
                        <select class="custom-select" name="mediaDetailEpisode" id='mediaDetailEpisode' onchange='selectionChanged(this.value)'>
                            <?php
                            foreach ($episodes as $key => $episode):
                                $link = "index.php?media=" . $_GET["media"] . "&amp;saison=" . $_GET["saison"] . "&amp;episode=" . ($key + 1);
                                $selected = ($key + 1) == $_GET["episode"] ? "selected" : "";
                                ?>
                                <option value='<?= $link?> '<?= $selected?>><?= $episode?></option>
                            <?php endforeach; ?>
                        </select>
                    </div>

                    <div class="col-md-4">
                        <p class="text-md-center h4">
                            <span class="badge badge-pill badge-secondary">
                                <?php
                                $time = explode(':', $episodeSelected['duration']);
                                if ($time[0] != 0) {
                                    echo $time[0] . "h ";
                                }
                                echo $time[1] . "m ";
                                echo $time[2] . "s";
                                ?>
                            </span>
                        </p>
                    </div>
                </div>
                <br />
                <p class="text-justify">
                    <?= $episodeSelected['summary']; ?>
                </p>
            </div>
            <div class="col-xs-12 col-md-6">
                <div class="embed-responsive embed-responsive-16by9">
                    <iframe id='player'
                            src="<?=$episodeSelected['url'] . "?enablejsapi=1"?>"
                            frameborder='0' allow='encrypted-media;' allowfullscreen></iframe>
                </div>
            </div>
        </div>
    <?php
        endif;
    ?>
</div>

<?php $content = ob_get_clean(); ?>

<?php require('dashboard.php'); ?>
