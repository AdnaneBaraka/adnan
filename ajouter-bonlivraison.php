<?php

$title = 'bonlivraison';

include 'header.php';
include 'dbconnect.php';

?>
<div class="app-container">
    <?php
        include 'side-bar.php';
    ?>
        
        <form method="post" action="./bonlivraison.php" >
            <h1 class="" id="">Ajouter une bonlivraison</h1>
                    <label for="">Data</label> <input type="date" name="date" class="form-control" placeholder="date" aria-label="date">
                    <label for="">Caissier:</label> 
                        <select id="caissier_id" name="caissier_nom">"
                            <?php
                            $sqlcaissier = "SELECT * FROM caissier";
                            $resultcaissier = $conn->query($sqlcaissier);
                            while ($rowcaissier = $resultcaissier->fetch_assoc()) {
                                echo "<option value='" . $rowcaissier['id'] . "'>" . $rowcaissier['prenom'] . "</option>";
                            }
                            ?>
                        </select><br>
                    <label for="">Client:</label> 
                        <select id="client_id" name="client_nom">"
                            <?php
                            $sqlclient = "SELECT * FROM client";
                            $resultclient = $conn->query($sqlclient);
                            while ($rowclient = $resultclient->fetch_assoc()) {
                                echo "<option value='" . $rowclient['id'] . "'>" . $rowclient['prenom'] . "</option>";
                            }
                            ?>
                        </select><br>
                    <label for="">Réglé:</label>  
                        <select name="reglé" class="form-select" aria-label="Default select example">
                            <option value="1">Réglé</option>
                            <option value="0">Non Réglé</option>
                        </select>
                <button type="submit" id="enregistrer" class="btn btn-primary" name="ajouter">valide</button>
            </form>
</div>
<?php

include 'footer.php';

?>
