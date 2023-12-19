<?php
$title = 'bonlivraison';
include 'header.php';
include 'dbconnect.php';

///////////////ajouter details///////////////
if(isset($_POST['ajouter-details'])){
    $bonlivraison_Id = $_POST['bonlivraisonId'];
    $articleId = $_POST['articleId'];
    $qte = $_POST['qte'];


    if(isset($bonlivraison_Id)&& isset($articleId )&& isset($qte)){
        $sqlInsert = "INSERT INTO detail_bl(article_id,bl_id,qte) 
        VALUES ('$articleId','$bonlivraison_Id','$qte')";
        $resultInsert = $conn->query($sqlInsert);
        if ($resultInsert) {
                 ///
        }else{
            echo "Une erreur de l'ajout de la BonLivraison : " . $conn->error;
        }
    }else{
            echo "";  
        }
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
                        <form method="post" action="<?php echo $_SERVER["PHP_SELF"] . "?" . $_SERVER['QUERY_STRING']; ?>" >
                        <label for="">Article:</label> 
                            <select id="article_id" name="articleId">"
                                <?php
                                $sqlarticle = "SELECT * FROM article";
                                $resultarticle = $conn->query($sqlarticle);
                                while ($rowarticle = $resultarticle->fetch_assoc()) {
                                    echo "<option value='" . $rowarticle['id'] . "'>" . $rowarticle['designation'] . "</option>";
                                }
                                ?>
                            </select>
                            <input type="hidden" name="bonlivraisonId" value="<?php echo $_GET['bonlivraison']; ?>">
                            <input type="number" name="qte" id="Qte" min="1" value="1">
                        <button name="ajouter-details">ajouter</button>
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
                                <td><?php echo (($row["prix_ht"] + $row["tva"]) * $row["qte"]); ?></td>
                                <td>
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
    }
include 'footer.php';

?>