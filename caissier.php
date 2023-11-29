<?php

$title = 'caissier';

include 'header.php';
include 'dbconnect.php';

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
            // echo "Ajouté avec succès";
        } else {
            echo "Une erreur s'est produite lors de l'ajout de la client : " . $conn->error;
        }
    } else {
        echo "";
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
                            <th scope="col">poste</th>
                            <th scope="col">admin</th>
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
                                <td><?php echo($row["admin"]); ?></td>
                                <td>
                                    <a class="btn btn-primary btn-sm " href="#edit-<?php   echo($row["id"]);?>" role="button"> Modifier </a>
                                    <a class="btn btn-primary btn-sm " href="#delete-<?php   echo($row["id"]);?>" role="button"> Supprimer </a>
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
                    <h1 class="modal-title fs-5" id="exampleModalLabel">Ajouter une famille</h1>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                nom: <input type="text" name="nouvelle_nom" class="form-control" placeholder="nom" aria-label="nom">
                prenom: <input type="text" name="nouvelle_prenom" class="form-control" placeholder="prenom" aria-label="prenom">
                poste: <input type="text" name="nouvelle_poste" class="form-control" placeholder="poste" aria-label="poste">
                admin: <input type="text" name="$nouvelleadmin" class="form-control" placeholder="admin" aria-label="admin">
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