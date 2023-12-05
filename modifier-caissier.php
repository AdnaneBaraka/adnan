<?php
$title = 'caissier';

include 'header.php';
include 'dbconnect.php';


?>
<div class="app-container">
    <?php
    include 'side-bar.php';
    if (isset($_GET['caissier'])) {
        $caissierId = $_GET['caissier'];
        $caissiersql = "SELECT * FROM caissier WHERE id = $caissierId ";
        $result = $conn->query($caissiersql);
    ?>     
        <form method="post" action="./caissier.php">
        <h1 class="" id="">Modifier une caissier</h1>
            <?php 
                if ($result->num_rows > 0) {
                    while ($row = $result->fetch_assoc()) {
            ?>
            <label for="">nom:</label>  <input value="<?php echo $row['nom'] ?>" type="text" name="nouvelle_nom" class="form-control" placeholder="nom" aria-label="nom">
            <label for="">prenom:</label>  <input value="<?php echo $row['prenom'] ?>" type="text" name="nouvelle_prenom" class="form-control" placeholder="prenom" aria-label="prenom">
            <label for="">poste:</label>  <input value="<?php echo $row['poste'] ?>" type="text" name="nouvelle_poste" class="form-control" placeholder="poste" aria-label="poste">
            <label for="">admin:</label>  <input value="<?php echo $row['admin'] ?>" type="text" name="$nouvelle_admin" class="form-control" placeholder="admin" aria-label="admin">
            <input type="hidden" name="caissier" value="<?php echo $_GET['caissier'] ?>">
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