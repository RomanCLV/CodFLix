<?php
    ob_start();
?>

<script type="text/javascript">

    function onClickDeleteOne(value)
    {
        alert("del one : " + value.split("-")[1]);
    }

    function onClickDeleteAll(userId)
    {
        let sql = "DELETE FROM `history` WHERE id = " + userId;
        alert(sql);
    }

</script>

<div class="history-main-container">
    <div class="history-top-container">
        <a href="index.php?action=media" class="back">Retour</a>
    </div>
    <div>
        <a  class="btn btn-block bg-red"
            <?php
            echo "onclick='onClickDeleteAll('" . $_SESSION["user_id"] . "')";
            ?>
                href="index.php?action=history"
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
                           echo "<img 
                                     id='trashid-". $historySql[$key]["id"] . "'
                                     src='public/img/trash_icon.png'
                                     class='history-trash-icon'
                                     onclick='onClickDeleteOne(this.id)'
                                     />";
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
