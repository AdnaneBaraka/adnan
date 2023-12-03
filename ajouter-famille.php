<?php

$title = 'famille';

include 'header.php';
include 'dbconnect.php';

?>
<div class="app-container">
    <?php
        include 'side-bar.php';
    ?>
        
        <form method="post" action="./famille.php">
        <h1 class="" id="">Ajouter une famille</h1>
        <label for="">famille:</label>
        <input type="text" name="nouvelle_famille" class="form-control" placeholder="FAMILLE" aria-label="FAMILLE">
            <button type="submit" id="enregistrer" class="btn btn-primary" name="ajouter">Enregistrer</button>
        </form>
</div>
<?php

include 'footer.php';

?>
