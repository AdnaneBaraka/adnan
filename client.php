<?php

$title = 'client';

include 'header.php';
include 'dbconnect.php';

if(isset($_POST['ajouter'])){
    $nouvellenom = $_POST['nouvelle_nom'];
    $nouvellprenom = $_POST['nouvelle_prenom'];
    $nouvelleadresse = $_POST['nouvelle_adresse'];
    $nouvelleville = $_POST['nouvelle_ville'];

    // التأكد من أن القيمة غير فارغة قبل إضافتها إلى قاعدة البيانات
    if (!empty($nouvellenom)) {
        $sqlInsert = "INSERT INTO client (nom,prenom,adresse,ville) 
        VALUES ('$nouvellenom','$nouvellprenom','$nouvelleadresse','$nouvelleville')";
        $resultInsert = $conn->query($sqlInsert);

        if ($resultInsert) {
            // echo "Ajouté avec succès";
        } else {
            echo "Une erreur s'est produite lors de l'ajout de la client : " . $conn->error;
        }
    } else {
        echo "";
    }
}
 //////////////delete///////////
 if (isset($_GET['delete']) && is_numeric($_GET['delete'])) {
    $clientdToDelete = $_GET['delete'];


    $sqlDelete = "DELETE FROM client WHERE id = $clientdToDelete";
    $resultDelete = $conn->query($sqlDelete);

    if ($resultDelete) {
        echo "";
    } else {
        echo "حدث خطأ أثناء حذف العائلة: " . $conn->error;
    }
}
                            

$sql = "SELECT * FROM client";

$result = $conn->query($sql);


?>
<div class="app-container">
    <?php
        include 'side-bar.php';
    ?>
        <div class="row w-100 my-4">
            <div class="col-8 mx-auto">
                 <div class="btn-container">
                    <button type="button" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#exampleModal">
                    Ajouter
                    </button>
                </div>
                <table class="table border m-auto">
                    <thead>
                        <tr>
                            <th scope="col">ID</th>
                            <th scope="col">Nom</th>
                            <th scope="col">Prenom</th>
                            <th scope="col">Adresse</th>
                            <th scope="col">Ville</th>
                            <th scope="col">Actions</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php 
                    
                    //
                        if ($result->num_rows > 0) {
    
                        while ($row = $result->fetch_assoc()) {
                    ?>
                        <tr>
                            <th scope="row"><?php echo($row["id"]);?></th>
                            <td><?php echo($row["nom"]); ?></td>
                            <td><?php echo($row["prenom"]); ?></td>
                            <td><?php echo($row["adresse"]); ?></td>
                            <td><?php echo($row["ville"]); ?></td>
                            <td>
                                <a class="btn btn-primary btn-sm " href="#edit-<?php   echo($row["id"]);?>" role="button"> Modifier </a>
                                <a class="btn btn-primary btn-sm" href="?delete=<?php echo $row['id']; ?>" role="button"> Supprimer </a> 
                            </td>
                        </tr>
    
                        <?php
                            }
                        }
                        ?>
        
                    </tbody>
                </table>
            </div>    
        </div>
</div>
<!-- Modal -->
<div class="modal fade" id="exampleModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <form method="post" action="">
            <div class="modal-content">
                <div class="modal-header">
                    <h1 class="modal-title fs-5" id="exampleModalLabel">Ajouter une client</h1>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                <Label>nom:</Label>  <input type="text" name="nouvelle_nom" class="form-control" placeholder="nom" aria-label="nom">
                <label for="">prenom:</label>  <input type="text" name="nouvelle_prenom" class="form-control" placeholder="prenom" aria-label="prenom">
                <label for="">adresse:</label>  <input type="text" name="nouvelle_adresse" class="form-control" placeholder="adresse" aria-label="adresse">
                <label for="">ville:</label>  <input type="text" name="nouvelle_ville" class="form-control" placeholder="ville" aria-label="ville">
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Annuler</button>
                    <button type="submit" class="btn btn-primary" name="ajouter">Enregistrer</button>
                </div>
            </div>
        </form>
    </div>  
</div>
<?php

include 'footer.php';

?>