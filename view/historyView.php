<?php
    ob_start();
?>

<div>
    <div class="form-group">
        <div class="row">
            <div class="col-md-3">
                <a href="index.php?action=media" class="btn btn-block bg-blue"><span style="color: white">Retour</span></a>
            </div>
            <div class="col-md-6">
                <a  class="btn btn-block bg-red"
                    <?php
                    echo "href='index.php?action=history&deleteall=". $_SESSION["user_id"] ."'";
                    ?>
                >
                    <span style="color: white">Effacer l'historique</span>
                </a>
            </div>
        </div>
    </div>

    <table class="table table-striped">
        <thead>
            <tr>
                <th> </th>
                <th>Film / Série</th>
                <th>Saison</th>
                <th>Épisode</th>
                <th>Statut</th>
            </tr>
        </thead>
        <tbody>
            <?php
                if (sizeof($history) === 0)
                {
                    echo "<tr class='history-empty-container'><td>Votre historique est vide</td></tr>";
                }
                else
                {
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

                        echo "<tr>";
                            echo "<td>";
                                echo "<a href=index.php?action=history&delete=" . $historySql[$key]["id"] . ">";
                                    echo "<img
                                             src='public/img/trash_icon.png'
                                             class='history-trash-icon'
                                             />";
                                echo "</a>";
                            echo "</td>";
                            echo "<td>$title </td>";
                            echo "<td>$saison </td>";
                            echo "<td>$episode</td>";
                            echo "<td>$started</td>";
                        echo "</tr>";
                    }
                }
            ?>
        </tbody>
    </table>

</div>


<?php $content = ob_get_clean(); ?>

<?php require('dashboard.php'); ?>
