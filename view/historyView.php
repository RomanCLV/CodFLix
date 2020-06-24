<?php
    ob_start();
?>

<script type="text/javascript">
    if (location.href.split('?')[1].split('&').length > 1)
    {
        location.href = "index.php?action=history";
    }
</script>

<div class="history-main-container">
    <div class="history-top-container">
        <a href="index.php?action=media" class="back">Retour</a>
    </div>
    <div class="history-top-container">
        <a  class="btn btn-block bg-red"
            <?php
                echo "href='index.php?action=history&deleteall=". $_SESSION["user_id"] ."'";
            ?>
        >
            Efface l'historique
        </a>
    </div>

    <table class="history-bottom-container">
        <tbody class="history-bottom-container">
            <?php
                foreach ($history as $key => $media)
                {
                    $rowStyle = $key % 2 === 0 ? "class='history-row1'" : "class='history-row2'";

                    $title = $media["title"];
                    $saison = null;
                    $episode = null;
                    $started = "Non commencé";
                    $started = $watchDurations[$key] == 0 ? "Non commencé" :
                        ($watchDurations[$key] >= $media["duration"] ? "Terminé" : "En cours");

                    if ($media["type"] === "Série")
                    {
                        $serie_episode = Media::getEpisodeById($episodesIds[$key]);
                        $saison = "Saison " . $serie_episode["saison"];
                        $episode =  "Episode " . $serie_episode["episode"];
                    }

                    echo "<tr $rowStyle>";
                        echo "<td class='history-trash-icon-container'>";
                            echo "<a href=index.php?action=history&delete=" . $historySql[$key]["id"] . ">";
                                echo "<img
                                         src='public/img/trash_icon.png'
                                         class='history-trash-icon'
                                         />";
                            echo "</a>";
                        echo "</td>";
                        echo "<td>$title </td>";
                        if ($saison != null) echo "<td>$saison </td>";
                        if ($episode != null) echo "<td>$episode</td>";
                        echo "<td>$started</td>";
                    echo "</tr>";
                }
            ?>
        </tbody>
    </table>

</div>


<?php $content = ob_get_clean(); ?>

<?php require('dashboard.php'); ?>
