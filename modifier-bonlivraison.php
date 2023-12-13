<?php

$title = 'bonlivraison';

include 'header.php';
include 'dbconnect.php';


?>
<div class="app-container">
    <?php
    include 'side-bar.php';
    if (isset($_GET['bonlivraison'])) {
        $bonlivraisonId = $_GET['bonlivraison'];
        $bonlivraisonsql = "SELECT * FROM bonlivraison WHERE id = $bonlivraisonId";
        $result = $conn->query($bonlivraisonsql);
    ?>     
        <form method="post" action="./bonlivraison.php">
        <h1 class="" id="">Modifier une abonlivraison</h1>
            <?php 
                if ($result->num_rows > 0) {
                    while ($row = $result->fetch_assoc()) {
            ?>
                <label for="">Data</label> <input value="<?php echo $row['date'] ?>"  type="date" name="date" class="form-control" placeholder="date" aria-label="date">
                <label for="">Caissier:</label> <select value="<?php echo $row['caissier_nom'] ?>" id="caissier_id" name="caissier_nom">"
                            <?php
                            $sqlcaissier = "SELECT * FROM caissier";
                            $resultcaissier = $conn->query($sqlcaissier);
                            while ($rowcaissier = $resultcaissier->fetch_assoc()) {
                                $selected = ($rowcaissier['id'] == $row['caissier_nom']) ? 'selected' : '';
                                echo "<option value='" . $rowcaissier['id'] . "'$selected>" . $rowcaissier['prenom'] . "</option>";
                            }
                            ?>
                </select><br>

                <label for="">Client:</label> <select value="<?php echo $row['client_nom'] ?>" id="client_id" name="client_nom">"
                            <?php
                            $sqlclient = "SELECT * FROM client";
                            $resultclient = $conn->query($sqlclient);
                            while ($rowclient = $resultclient->fetch_assoc()) {
                                $selected = ($rowclient['id'] == $row['client_nom']) ? 'selected' : '';
                                echo "<option value='" . $rowclient['id'] . "'$selected>" . $rowclient['prenom'] . "</option>";
                            }
                            ?>
                </select><br>
                <label for="reglé">Réglé:</label>
                <select name="reglé" class="form-select" aria-label="Default select example" required>
                    <option value="1" <?php echo ($row['reglé'] == 1) ? 'selected' : ''; ?>>Réglé</option>
                    <option value="0" <?php echo ($row['reglé'] == 0) ? 'selected' : ''; ?>>Non Réglé</option>
                </select>

                            
            <input type="hidden" name="bonlivraison" value="<?php echo  $bonlivraisonId?>">
            
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