<?php
$title = 'bonlivraison';
include 'header.php';
include 'dbconnect.php';

 //////////////delete///////////
 if (isset($_GET['delete']) && is_numeric($_GET['delete'])) {
    $bonlivraisonToDelete = $_GET['delete'];


    $sqlDelete = "DELETE FROM bonlivraison WHERE id = $bonlivraisonToDelete";
    $resultDelete = $conn->query($sqlDelete);

    if ($resultDelete) {
        echo "";
    } else {
        echo "حدث خطأ أثناء حذف العائلة: " . $conn->error;
    }
}

$sql = "SELECT * FROM bonlivraison";

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
                            <th scope="col">Date</th>
                            <th scope="col">Réglé</th>
                            <th scope="col">Client</th>
                            <th scope="col">Caissier</th>
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
                                <td><?php echo($row["date"]); ?></td>
                                <td><?php echo($row["reglé"]); ?></td>
                                <td><?php echo($row["client_id"]); ?></td>
                                <td><?php echo($row["caissier_id"]); ?></td>
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