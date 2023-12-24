<?php
$title = 'bonlivraison';
include 'header.php';
include 'dbconnect.php';
$bonlivraisonId = $_GET['bonlivraison'];
$totalSum = 0;
///////////////ajouter details///////////////
if(isset($_POST['ajouter-details'])){
    $bonlivraison_Id = $_POST['bonlivraisonId'];
    $articleId = $_POST['articleId'];
    $qte = $_POST['qte'];


    if(isset($bonlivraison_Id)&& isset($articleId )&& isset($qte)){
        $sqlInsert = "INSERT INTO detail_bl(article_id,bl_id,qte) 
        VALUES ('$articleId','$bonlivraison_Id','$qte')";
        $resultInsert = $conn->query($sqlInsert);
    }
     
    header("Location: http://localhost/adnan/bon_de_livraison_details.php?bonlivraison=$bonlivraisonId");     

}
//////////////delete///////////
if (isset($_GET['delete']) && is_numeric($_GET['delete'])) {
    $detail_bldToDelete = $_GET['delete'];


    $sqlDelete = "DELETE FROM detail_bl WHERE id = $detail_bldToDelete";
    $resultDelete = $conn->query($sqlDelete);

    if ($resultDelete) {
        echo "ggggggggggg";
    } else {
        echo "حدث خطأ أثناء حذف العائلة: " . $conn->error;
    }
    header("Location: bon_de_livraison_details.php");
    exit();
}

?>

<div class="app-container">
    <?php
    include 'side-bar.php';
    if (isset($_GET['bonlivraison'])) {
        $bonlivraisonId = $_GET['bonlivraison'];

    ?>
    
    <div class="row w-100 my-4">
            <div class="col-8 mx-auto">
                     <div class="btn-container">
                        <form method="post" action="<?php echo $_SERVER["PHP_SELF"] . "?" . $_SERVER['QUERY_STRING']; ?>">
                            <label for="">Article:</label> 
                                <select id="article_id" name="articleId">
                                    <?php
                                        $sqlarticle = "SELECT * FROM article";
                                        $resultarticle = $conn->query($sqlarticle);
                                        while ($rowarticle = $resultarticle->fetch_assoc()) {
                                            echo "<option value='" . $rowarticle['id'] . "'>" . $rowarticle['designation'] . "</option>";
                                        }
                                    ?>
                               
                            <input type="hidden" name="bonlivraisonId" value="<?php echo $_GET['bonlivraison']; ?>">
                            <input type="number" name="qte" id="Qte" min="1" value="1">
                            <button type="submit" name="ajouter-details">ajouter</button>
                        </form>

                    </div>
    
                <table class="table border m-auto">
                    <thead>
                        <tr>
                            <th scope="col">ID</th>
                            <th scope="col">Designation</th>
                            <th scope="col">prix</th>
                            <th scope="col">Qte</th>
                            <th scope="col">Total</th>
                            <th scope="col">Action</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php 
                            $sql = "SELECT detail_bl.*, article.designation AS designation, article.prix_ht AS prix_ht, article.tva AS tva
                            FROM detail_bl
                            LEFT JOIN article ON detail_bl.article_id = article.id
                            WHERE detail_bl.bl_id = $bonlivraisonId";
                        
                        $result = $conn->query($sql);
                        //
                            if ($result->num_rows > 0) {
        
                            while ($row = $result->fetch_assoc()) {
                        ?>
                            <tr>
                                <th scope="row"><?php echo($row["id"]);?></th>
                                <td><?php echo($row["designation"]); ?></td>
                                <td><?php echo(($row["prix_ht"] + $row["tva"])); ?></td>
                                <td> <input type="number" value="<?php echo $row["qte"]?>" name="Qte" id="Qte"> </td>
                                <td><?php  $rowTotal = ($row["prix_ht"] + $row["tva"]) * $row["qte"];
    $totalSum += $rowTotal;  echo (($row["prix_ht"] + $row["tva"]) * $row["qte"]); ?></td>
                                <td>
                                <button class="btn btn-danger"><a href="suprimer.php?delete=<?php echo $row['id']; ?>&delete1=<?php echo $bonlivraisonId; ?>">Supprimer</a></button>


                                </td>
                            </tr>
        
                        <?php

                            }
                        }
                        ?>
        <?php
while ($row = $result->fetch_assoc()) {
 
    ?>
    <tr>
        <!-- ... (your existing code) ... -->
        <td><?php echo $rowTotal; ?></td>
        <!-- ... (your existing code) ... -->
    </tr>
<?php
}
?>
<tr>
    <td colspan="4"></td>
    <td>Total:</td>
    <td><?php echo $totalSum; ?></td>
    <td></td>
</tr>

                    </tbody>
                </table>
            </div>    
        </div>
</div>
<?php
    }
include 'footer.php';

?>