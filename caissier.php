<?php

$title = ' ncaissier';

include 'header.php';
include 'dbconnect.php';

if(isset($_POST['modifier'])){
    $nouvellenom = $_POST['nouvelle_nom'];
    $nouvellprenom = $_POST['nouvelle_prenom'];
    $nouvelleaposte = $_POST['nouvelle_poste'];
    $nouvelleadmin = $_POST['nouvelle_admin'];
    $caissierId = $_POST['caissier'];
    // التأكد من أن القيمة غير فارغة قبل إضافتها إلى قاعدة البيانات
    if (!empty($nouvellenom)) {
        $sqlUpdate = "UPDATE caissier SET nom ='$nouvellenom',prenom='$nouvellprenom',poste ='$nouvelleaposte ', admin ='$nouvelleadmin' WHERE id=$caissierId";
        $resultUpdate = $conn->query($sqlUpdate);

        if ($resultUpdate) {
            // echo "modifieravec succès";
        } else {
            echo "Une erreur s'est produite lors de modifier de la caissier : " . $conn->error;
        }
    } else {
        echo "";
    }
}
                             //////////////ajouter/////////////////
if(isset($_POST['ajouter'])){
    $nouvellenom = $_POST['nouvelle_nom'];
    $nouvellprenom = $_POST['nouvelle_prenom'];
    $nouvelleaposte = $_POST['nouvelle_poste'];
    $nouvelleadmin = $_POST['nouvelle_admin'];

    // التأكد من أن القيمة غير فارغة قبل إضافتها إلى قاعدة البيانات
    if (!empty($nouvellenom)) {
        $sqlInsert = "INSERT INTO caissier (nom,prenom,poste, admin) 
        VALUES ('$nouvellenom','$nouvellprenom','$nouvelleaposte ','$nouvelleadmin')";
        $resultInsert = $conn->query($sqlInsert);

        if ($resultInsert) {
            header("Location: caissier.php");
            exit();
        } else {
            echo "Une erreur s'est produite lors de l'ajout de la caissier : " . $conn->error;
        }
    } else {
        echo "";
    }
}
 //////////////delete///////////
 if (isset($_GET['delete']) && is_numeric($_GET['delete'])) {
    $caissierIdToDelete = $_GET['delete'];


    $sqlDelete = "DELETE FROM caissier WHERE id = $caissierIdToDelete";
    $resultDelete = $conn->query($sqlDelete);

    if ($resultDelete) {
        echo "";
    } else {
        echo "حدث خطأ أثناء حذف العائلة: " . $conn->error;
    }
}

$sql = "SELECT * FROM caissier";

$result = $conn->query($sql);


?>
<div class="app-container">
    <?php
    include 'side-bar.php';
    ?>
        <div class="row w-100 my-4">
            <div class="col-8 mx-auto">
                <div class="btn-container">
                <a href="./ajouter-caissier.php" class="btn btn-primary">Ajouter</a>
                </div>
                <table class="table border m-auto">
                    <thead>
                        <tr>
                            <th scope="col">ID</th>
                            <th scope="col">Nom</th>
                            <th scope="col">Prenom</th>
                            <th scope="col">poste</th>
                            <th scope="col">Role</th>
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
                                <td><?php echo($row["poste"]); ?></td>
                                <td><?php echo(($row["admin"] == 1)?'Admin':'User'); ?></td>
                                <td>
                                    <a class="btn btn-primary btn-sm edit-btn" href="./modifier-caissier.php?caissier=<?php   echo$row["id"];?>" role="button"> Modifier </a>
                                    <a class="btn btn-primary btn-sm " href="?delete=<?php   echo($row["id"]);?>" role="button"> Supprimer </a>
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
<!-- <div class="modal fade" id="exampleModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <form method="post" action="">
            <div class="modal-content">
                <div class="modal-header">
                    <h1 class="modal-title fs-5" id="exampleModalLabel">Ajouter une caissier</h1>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                <label for="">nom:</label>  <input type="text" name="nouvelle_nom" class="form-control" placeholder="nom" aria-label="nom">
                <label for="">prenom:</label>  <input type="text" name="nouvelle_prenom" class="form-control" placeholder="prenom" aria-label="prenom">
                <label for="">poste:</label>  <input type="text" name="nouvelle_poste" class="form-control" placeholder="poste" aria-label="poste">
                <label for="">admin:</label>  <input type="text" name="$nouvelleadmin" class="form-control" placeholder="admin" aria-label="admin">
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Annuler</button>
                    <button type="submit" class="btn btn-primary" name="ajouter">Enregistrer</button>
                </div>
            </div>
        </form>
    </div>  
</div> -->
<?php

include 'footer.php';

?>