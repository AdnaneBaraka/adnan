<?php

$title = 'caissier';

include 'header.php';
include 'dbconnect.php';

?>
<div class="app-container">
    <?php
        include 'side-bar.php';
    ?>
        
        <form method="post" action="./caissier.php">
        <h1 class="" id="">Ajouter une caissier</h1>
            <label for="">nom:</label>  <input type="text" name="nouvelle_nom" class="form-control" placeholder="nom" aria-label="nom">
            <label for="">prenom:</label>  <input type="text" name="nouvelle_prenom" class="form-control" placeholder="prenom" aria-label="prenom">
            <label for="">poste:</label>  <input type="text" name="nouvelle_poste" class="form-control" placeholder="poste" aria-label="poste">
            <label for="">admin:</label>  <input type="text" name="$nouvelleadmin" class="form-control" placeholder="admin" aria-label="admin">
            <button type="submit" id="enregistrer" class="btn btn-primary" name="ajouter">Enregistrer</button>
        </form>
</div>
<?php

include 'footer.php';

?>
