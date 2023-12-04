<?php

$title = 'client';

include 'header.php';
include 'dbconnect.php';

if(isset($_POST['modifier'])){
    $nouvellenom = $_POST['nouvelle_nom'];
    $nouvellprenom = $_POST['nouvelle_prenom'];
    $nouvelleadresse = $_POST['nouvelle_adresse'];
    $nouvelleville = $_POST['nouvelle_ville'];
    $client = $_POST['client'];

    // التأكد من أن القيمة غير فارغة قبل إضافتها إلى قاعدة البيانات
    if (!empty($nouvellenom)) {
        $sqlUpdate = "UPDATE client SET nom='$nouvellenom', prenom='$nouvellprenom', adresse='$nouvelleadresse', ville='$nouvelleville' WHERE id=$client";
        $resultInsert = $conn->query($sqlUpdate);

        if ($resultInsert) {
            // echo "modifier avec succès";
        } else {
            echo "Une erreur s'est produite lors de modifier de la client : " . $conn->error;
        }
    } else {
        echo "";
    }
}
                             //////////////ajouter/////////////////
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
                    <a href="./ajouter-client.php" class="btn btn-primary">Ajouter</a>
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
                                <a class="btn btn-primary btn-sm edit-btn" href="./modifier-client.php?client=<?php echo $row['id']; ?>">
                                    Modifier
                                </a>
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

<!-- <div class="modal fade" id="exampleModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
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
                    <button type="submit" id="enregistrer" class="btn btn-primary" name="ajouter">Enregistrer</button>
                </div>
            </div>
        </form>
    </div>  
</div> -->
<!-- Add a JavaScript function to handle the Edit button click -->
<!-- <script>
    document.addEventListener('DOMContentLoaded', function () {
        var editButtons = document.querySelectorAll('.edit-btn');
        var editClientIdInput = document.getElementById('editClientId');

        for(let index = 0; index < editButtons.length; index++) {
            editButtons[index]
        }

        editButtons.forEach(function (button) {
            button.addEventListener('click', function () {
                var clientId = button.getAttribute('data-client-id');
                editClientIdInput.value = clientId;

                // Retrieve client information from the corresponding row and populate the modal form
                var row = button.closest('tr');
                document.querySelector('input[name="nouvelle_nom"]').value = row.cells[1].textContent;
                document.querySelector('input[name="nouvelle_prenom"]').value = row.cells[2].textContent;
                document.querySelector('input[name="nouvelle_adresse"]').value = row.cells[3].textContent;
                document.querySelector('input[name="nouvelle_ville"]').value = row.cells[4].textContent;
                document.getElementById('enregistrer').setAttribute('name','modifier')
            });
        });
    });
</script> -->
<?php

include 'footer.php';

?>