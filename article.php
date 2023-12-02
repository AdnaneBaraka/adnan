<?php

$title = 'article';

include 'header.php';
include 'dbconnect.php';

if(isset($_POST['ajouter'])){
    $nouvelledesignation = $_POST['designation'];
    $nouvelleprix_ht = $_POST['prix_ht'];
    $nouvelletva = $_POST['tva'];
    $nouvellestock = $_POST['stock'];
    $nouvelleFamille = $_POST['famille_id'];

    // التأكد من أن القيمة غير فارغة قبل إضافتها إلى قاعدة البيانات
    if (!empty($nouvelledesignation)) {
        $sqlInsert = "INSERT INTO article (designation,prix_ht,tva,stock,famille_id) 
        VALUES ('$nouvelledesignation','$nouvelleprix_ht','$nouvelletva ','$nouvellestock','$nouvelleFamille')";
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
    $articledToDelete = $_GET['delete'];


    $sqlDelete = "DELETE FROM article WHERE id = $articledToDelete";
    $resultDelete = $conn->query($sqlDelete);

    if ($resultDelete) {
        echo "";
    } else {
        echo "حدث خطأ أثناء حذف العائلة: " . $conn->error;
    }
}
$sql = "SELECT * FROM article";

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
                            <th scope="col">Designation</th>
                            <th scope="col">prix_ht</th>
                            <th scope="col">Tva</th>
                            <th scope="col">Stock</th>
                            <th scope="col">famille_id</th>
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
                                <td><?php echo($row["designation"]); ?></td>
                                <td><?php echo($row["prix_ht"]); ?></td>
                                <td><?php echo($row["tva"]); ?></td>
                                <td><?php echo($row["stock"]); ?></td>
                                <td><?php echo($row["famille_id"]); ?></td>
                                <td>
                                    <a class="btn btn-primary btn-sm " href="#edit-<?php   echo($row["id"]);?>" role="button"> Modifier </a>
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
<div class="modal fade" id="exampleModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <form method="post" action="">
            <div class="modal-content">
                <div class="modal-header">
                    <h1 class="modal-title fs-5" id="exampleModalLabel">Ajouter une article</h1>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                <label for="">designation:</label>  <input type="text" name="designation" class="form-control" placeholder="designation" aria-label="designation">
                <label for="">prix_ht:</label> <input type="number" name="prix_ht" class="form-control" placeholder="prix_ht" aria-label="prix_ht">
                <label for="">tva:</label> <input type="number" name="tva" class="form-control" placeholder="tva" aria-label="tva">
                <label for="">stock:</label> <input type="number" name="stock" class="form-control" placeholder="stock" aria-label="stock">
                <label for="">famille</label> <<select id="famille_id" name="famille_id">">
                                <?php
                                $sqlFamilles = "SELECT * FROM famille";
                                $resultFamilles = $conn->query($sqlFamilles);
                                while ($rowFamille = $resultFamilles->fetch_assoc()) {
                                    echo "<option value='" . $rowFamille['id'] . "'>" . $rowFamille['famille'] . "</option>";
                                }
                                ?>
                            </select>
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
