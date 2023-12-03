<?php

$title = 'client';

include 'header.php';
include 'dbconnect.php';

?>
<div class="app-container">
    <?php
        include 'side-bar.php';
    ?>
        
        <form method="post" action="./client.php">
        <h1 class="" id="">Ajouter une client</h1>
            <Label>nom:</Label>  <input type="text" name="nouvelle_nom" class="form-control" placeholder="nom" aria-label="nom">
            <label for="">prenom:</label>  <input type="text" name="nouvelle_prenom" class="form-control" placeholder="prenom" aria-label="prenom">
            <label for="">adresse:</label>  <input type="text" name="nouvelle_adresse" class="form-control" placeholder="adresse" aria-label="adresse">
            <label for="">ville:</label>  <input type="text" name="nouvelle_ville" class="form-control" placeholder="ville" aria-label="ville">
            <button type="submit" id="enregistrer" class="btn btn-primary" name="ajouter">Enregistrer</button>
        </form>
</div>
<?php

include 'footer.php';

?>
