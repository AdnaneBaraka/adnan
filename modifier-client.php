<?php

$title = 'client';

include 'header.php';
include 'dbconnect.php';


?>
<div class="app-container">
    <?php
    include 'side-bar.php';
    if (isset($_GET['client'])) {
        $clientsql = "SELECT * FROM client WHERE id = " . $_GET['client'];
        $result = $conn->query($clientsql);
    ?>
        <h1 class="modal-title fs-5" id="exampleModalLabel">Modifier une client</h1>
        <form method="post" action="./client.php">
            <?php 
                if ($result->num_rows > 0) {
                    while ($row = $result->fetch_assoc()) {
            ?>
            <Label>nom:</Label> <input value="<?php echo $row['nom'] ?>" type="text" name="nouvelle_nom" class="form-control" placeholder="nom" aria-label="nom">
            <label for="">prenom:</label> <input value="<?php echo $row['prenom'] ?>" type="text" name="nouvelle_prenom" class="form-control" placeholder="prenom" aria-label="prenom">
            <label for="">adresse:</label> <input value="<?php echo $row['adresse'] ?>" type="text" name="nouvelle_adresse" class="form-control" placeholder="adresse" aria-label="adresse">
            <label for="">ville:</label> <input value="<?php echo $row['ville'] ?>" type="text" name="nouvelle_ville" class="form-control" placeholder="ville" aria-label="ville">
            <input type="hidden" name="client" value="<?php echo $_GET['client'] ?>">
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