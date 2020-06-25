<?php ob_start(); ?>

<div class="row">
    <div class="col-md-12">
        <form method="post">
            <div class="form-group has-btn">

                <select class="custom-select col-2" name="selectDate">
                    <option value="before" <?= $searchDate === "before" ? "selected" : "" ?>>Avant</option>
                    <option value="after" <?= $searchDate === "after" ? "selected" : "" ?>>Après</option>
                </select>
                <input type="date" name="inputDate" class="input-group col-2" value="<?= $searchDateDay ?>" />

                <select class="custom-select  col-2" name="selectGender">
                    <option value='null' <?= $searchGenre == null ? "selected" : "" ?>>Genre</option>
                    <?php
                        foreach ($genres as $gender) {
                            $item = $gender["name"];
                            echo "<option value='$item' " . ($searchGenre == $item ? "selected" : "") . ">$item</option>";
                        }
                    ?>
                </select>
                <select class="custom-select  col-2" name="selectType">
                    <option value='null'>Type</option>
                    <?php
                    foreach ($types as $type) {
                        $item = $type["type"];
                        echo "<option value='$item' " . ($searchType == $item ? "selected" : "") . ">$item</option>";
                    }
                    ?>
                </select>

                <input type="search" id="search" name="title" value="<?= $searchTitle; ?>" class="form-control"
                       placeholder="Rechercher un film ou une série">
                <button type="submit" class="btn btn-block bg-red">Valider</button>

            </div>
        </form>
    </div>
</div>

<div class="media-list">
    <?php
        foreach ($medias as $media):
            $get = "index.php?media=" . $media['id'];
            if ($media["type"] === "Série") {
                $get .= "&saison=1&episode=1";
            }
    ?>
    <a class="item" href="<?= $get; ?>">
        <div class="video">
            <div>
                <iframe allowfullscreen="" frameborder="0" src="<?= $media['trailer_url']; ?>"></iframe>
            </div>
        </div>
        <div class="title"><?= $media['title']; ?></div>
        <?php
            $date = explode('-', $media['release_date']);
            $date = $date[2] . " / " . $date[1]  . " / " . $date[0];
        ?>
        <div class="text-md-center">
            <div class="text-decoration-none">
                <span style="color: white">
                    <?= $date ?>
                </span>
            </div>
        </div>
    </a>
    <?php endforeach; ?>
</div>

<?php $content = ob_get_clean(); ?>

<?php require('dashboard.php'); ?>
