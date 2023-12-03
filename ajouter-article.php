<?php

$title = 'article';

include 'header.php';
include 'dbconnect.php';

?>
<div class="app-container">
    <?php
        include 'side-bar.php';
    ?>
        
        <form method="post" action="./article.php">
        <h1 class="" id="">Ajouter une article</h1>
        <label for="">designation:</label>  <input type="text" name="designation" class="form-control" placeholder="designation" aria-label="designation">
                <label for="">prix_ht:</label> <input type="number" name="prix_ht" class="form-control" placeholder="prix_ht" aria-label="prix_ht">
                <label for="">tva:</label> <input type="number" name="tva" class="form-control" placeholder="tva" aria-label="tva">
                <label for="">stock:</label> <input type="number" name="stock" class="form-control" placeholder="stock" aria-label="stock">
                <label for="">famille:</label> <select id="famille_id" name="famille_id">"
                                <?php
                                $sqlFamilles = "SELECT * FROM famille";
                                $resultFamilles = $conn->query($sqlFamilles);
                                while ($rowFamille = $resultFamilles->fetch_assoc()) {
                                    echo "<option value='" . $rowFamille['id'] . "'>" . $rowFamille['famille'] . "</option>";
                                }
                                ?>
                            </select>
            <button type="submit" id="enregistrer" class="btn btn-primary" name="ajouter">Enregistrer</button>
        </form>
</div>
<?php

include 'footer.php';

?>
