<?php

$title = 'article';

include 'header.php';
include 'dbconnect.php';


?>
<div class="app-container">
    <?php
    include 'side-bar.php';
    if (isset($_GET['article'])) {
        $articleId = $_GET['article'];
        $articlesql = "SELECT * FROM article WHERE id = $articleId";
        $result = $conn->query($articlesql);
    ?>     
        <form method="post" action="./article.php">
        <h1 class="" id="">Modifier une article</h1>
            <?php 
                if ($result->num_rows > 0) {
                    while ($row = $result->fetch_assoc()) {
            ?>
                <label for="">designation:</label>  <input value="<?php echo $row['designation'] ?>" type="text" name="designation" class="form-control" placeholder="designation" aria-label="designation">
                <label for="">prix_ht:</label> <input value="<?php echo $row['prix_ht'] ?>" type="number" name="prix_ht" class="form-control" placeholder="prix_ht" aria-label="prix_ht">
                <label for="">tva:</label> <input value="<?php echo $row['tva'] ?>" type="number" name="tva" class="form-control" placeholder="tva" aria-label="tva">
                <label for="">stock:</label> <input value="<?php echo $row['stock'] ?>" type="number" name="stock" class="form-control" placeholder="stock" aria-label="stock">
                <label for="">famille:</label> <select value="<?php echo $row['famille_id'] ?>" id="famille_id" name="famille_id">"
                                <?php
                                $sqlFamilles = "SELECT * FROM famille";
                                $resultFamilles = $conn->query($sqlFamilles);
                                while ($rowFamille = $resultFamilles->fetch_assoc()) {
                                    $selected = ($rowFamille['id'] == $row['famille_id']) ? 'selected' : '';
                                    echo "<option value='" . $rowFamille['id'] . "' $selected>" . $rowFamille['famille'] . "</option>";
                                }
                                ?>
                            </select>
            <input type="hidden" name="article" value="<?php echo $_GET['article'] ?>">
            
            <?php        
            }
            }
            ?>
            <button type="submit" id="enregistrer" class="btn btn-primary" name="modifier">Enregistrer</button>
        </form>

    <?php
    }
    ?>
</div>
<?php

include 'footer.php';

?>