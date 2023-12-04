<?php

$title = 'article';

include 'header.php';
include 'dbconnect.php';
if(isset($_POST['modifier'])){
    $nouvelledesignation = $_POST['designation'];
    $nouvelleprix_ht = $_POST['prix_ht'];
    $nouvelletva = $_POST['tva'];
    $nouvellestock = $_POST['stock'];
    $nouvelleFamille = $_POST['famille_id'];
    $articleId = $_POST['article'];

    // التأكد من أن القيمة غير فارغة قبل إضافتها إلى قاعدة البيانات
    if (!empty($nouvelledesignation)) {
        $sqlUpdate = "UPDATE article SET designation='$nouvelledesignation', prix_ht=$nouvelleprix_ht, tva='$nouvelletva', stock='$nouvellestock', famille_id='$nouvelleFamille' WHERE id=$articleId";

        $resultUpdate = $conn->query($sqlUpdate);

        if ($resultUpdate) {
            // echo "Ajouté avec succès";
        } else {
            echo "Une erreur s'est produite lors de modifier de la article : " . $conn->error;
        }
    } else {
        echo "";
    }
}

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
                     <a href="./ajouter-article.php" class="btn btn-primary">Ajouter</a>
                    </div>
    
                <table class="table border m-auto">
                    <thead>
                        <tr>
                            <th scope="col">ID</th>
                            <th scope="col">Designation</th>
                            <th scope="col">prix_ht</th>
                            <th scope="col">Tva</th>
                            <th scope="col">Stock</th>
                            <th scope="col">famille</th>
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
                                <a class="btn btn-primary btn-sm edit-btn" href="./modifier-article.php?article=<?php echo $row['id']; ?>">
                                    Modifier
                                </a>
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
<?php

include 'footer.php';
