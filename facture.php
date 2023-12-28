<?php
$title = 'bonlivraison';
include 'header.php';
include 'dbconnect.php';

$totalSum = 0;


// function to get bonlivraison by id from table bonlivraison with mysqli
function getBonlivraisonById($conn, $bonlivraisonId)
{
    $sql ="SELECT bonlivraison.*, client.nom AS client_nom, caissier.nom AS caissier_nom
    FROM bonlivraison
    LEFT JOIN client ON bonlivraison.client_id = client.id
    LEFT JOIN caissier ON bonlivraison.caissier_id = caissier.id
    WHERE bonlivraison.id = $bonlivraisonId";

    $result = $conn->query($sql);
    $bonlivraisonRow = $result->fetch_assoc();
    return $bonlivraisonRow;
}
// function to get bon details by bonlivraisonId
function getBonDetailsByBonlivraisonId($conn, $bonlivraisonId)
{    
    $sql = "SELECT detail_bl.*, article.designation AS designation, article.prix_ht AS prix_ht, article.tva AS tva
                            FROM detail_bl
                            LEFT JOIN article ON detail_bl.article_id = article.id
                            WHERE detail_bl.bl_id = $bonlivraisonId";
    $result = $conn->query($sql);
    return $result;
}

if (isset($_GET['id'])) {
    $bonlivraisonId = $_GET['id'];
    $bonLivraisonRow = getBonlivraisonById($conn, $bonlivraisonId);
?>
<div class="container mt-4">
    <div class="bl">
        <center><h2 class="mb-4">Bon de livraison</h2></center>
        <input type="hidden" name="id" value="<?php echo "ID: " . $id; ?>">
        <div class="mb-2">Client: <b><?php echo $bonLivraisonRow['client_nom']; ?></b></div>
        <div class="mb-2">Caissier: <b><?php echo $bonLivraisonRow['caissier_nom']; ?></b></div>
        <div class="mb-2">Date: <b></b><?php echo $bonLivraisonRow['date']; ?></div>
        <div class="mb-2">Régle: <b></b><?php echo ($bonLivraisonRow['reglé'] == 1)?'Regle':'Non Regle'; ?></div>
        <hr class="my-4">
        <div class="table-responsive">
    <table class="table table-bordered">
        <thead>
            <tr>
                <th>Identifiant</th>
                <th scope="col">Designation</th>
                <th scope="col">prix</th>
                <th scope="col">Qte</th>
                <th>TTC</th>
            </tr>
        </thead>
        <tbody>
            <?php
            $result = getBonDetailsByBonlivraisonId($conn, $bonlivraisonId);
            while ($row = $result->fetch_assoc()) {
            ?>
                <tr>
                    <th scope="row"><?php echo($row["id"]);?></th>
                    <td><?php echo($row["designation"]); ?></td>
                    <td><?php echo(($row["prix_ht"] + $row["tva"])); ?></td>
                    <td> <?php echo $row["qte"]?> </td>
                    <td><?php  
                    $rowTotal = ($row["prix_ht"] + $row["tva"]) * $row["qte"];
                    $totalSum += $rowTotal;  
                    echo (($row["prix_ht"] + $row["tva"]) * $row["qte"]); ?></td>
                </tr>
            <?php
            }
        ?>
        </table>

        <div class='text-center mt-3'><p class='h4'>Montant total : <span class='MT'>
            <?php echo $totalSum; ?>
        </span></p></div>

</div>

<?php
}

mysqli_close($conn);

include 'footer.php';
?>