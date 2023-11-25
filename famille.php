<?php

$title = 'Famille';

include 'header.php';
include 'dbconnect.php';

$sql = "SELECT * FROM famille";

$result = $conn->query($sql);


?>

<div class="app-container">
    <?php
    include 'side-bar.php';
    ?>
        <div class="d-flex justify-content-center container">
        <form method="post" action="">
            <input type="text" name="nouvelle_famille" placeholder="FAMILLE">
            <button type="submit" name="ajouter">ajouter</button>
        </form>
            <table class="table border m-auto">
                <thead>
                    <tr>
                        <th scope="col">ID</th>
                        <th scope="col">Famille</th>
                        <th scope="col">Actions</th>
                    </tr>
                </thead>
                <tbody>
                    <?php 
                    if(isset($_POST['ajouter'])){
                        $nouvelleFamille = $_POST['nouvelle_famille'];
                    
                        // التأكد من أن القيمة غير فارغة قبل إضافتها إلى قاعدة البيانات
                        if (!empty($nouvelleFamille)) {
                            $sqlInsert = "INSERT INTO famille (famille) VALUES ('$nouvelleFamille')";
                            $resultInsert = $conn->query($sqlInsert);
                    
                            if ($resultInsert) {
                                echo "Ajouté avec succès";
                            } else {
                                echo "Une erreur s'est produite lors de l'ajout de la famille : " . $conn->error;
                            }
                        } else {
                            echo "";
                        }
                    }
                    
                    // استعراض البيانات من قاعدة البيانات
                    $sql = "SELECT * FROM famille";
                    $result = $conn->query($sql);

                    
                    //
                        if ($result->num_rows > 0) {
    
                        while ($row = $result->fetch_assoc()) {
                    ?>
                        <tr>
                            <th scope="row"><?php echo($row["id"]);?></th>
                            <td><?php echo($row["famille"]); ?></td>
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

<?php

include 'footer.php';

?>