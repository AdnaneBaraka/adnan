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
            <label for="">Role:</label>  <select name="nouvelle_admin" class="form-select" aria-label="Default select example">
                <option value="1">Admin</option>
                <option value="0">User</option>
                </select>
            <button type="submit" id="enregistrer" class="btn btn-primary" name="ajouter">Enregistrer</button>
        </form>
</div>
<?php

include 'footer.php';

?>
