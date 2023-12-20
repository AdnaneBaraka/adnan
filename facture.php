<?php
$title = 'bonlivraison';
include 'header.php';
include 'dbconnect.php';
?>

<?php
$bonLivraisonRow = null;
$statementDetailBl = null;
$id = isset($_GET['id']) ? $_GET['id'] : null;

if ($_SERVER['REQUEST_METHOD'] === "GET" && isset($_GET['id'])) {
    $id = $_GET['id'];
    
    // Query for BonLivraison
    $queryBonLivraison = "SELECT * FROM BonLivraison WHERE id = ?";
    $statementBonLivraison = mysqli_prepare($conn, $queryBonLivraison);
    mysqli_stmt_bind_param($statementBonLivraison, 'i', $id);
    mysqli_stmt_execute($statementBonLivraison);
    $resultBonLivraison = mysqli_stmt_get_result($statementBonLivraison);
    $bonLivraisonRow = mysqli_fetch_assoc($resultBonLivraison);

    // Query for DetailBL
    $queryDetailBl = "SELECT * FROM detail_bl WHERE bl_id = ?";
    $statementDetailBl = mysqli_prepare($conn, $queryDetailBl);
    mysqli_stmt_bind_param($statementDetailBl, 'i', $id);
    mysqli_stmt_execute($statementDetailBl);
    $resultDetailBl = mysqli_stmt_get_result($statementDetailBl);

    if ($bonLivraisonRow) {
        $client_id = $bonLivraisonRow['client_id'];
        $caissier_id = $bonLivraisonRow['caissier_id'];

        // Query for Client
        $queryClient = "SELECT nom, prenom FROM client WHERE id = ?";
        $statementClient = mysqli_prepare($conn, $queryClient);
        mysqli_stmt_bind_param($statementClient, 'i', $client_id);
        mysqli_stmt_execute($statementClient);
        $resultClient = mysqli_stmt_get_result($statementClient);
        $clientRow = mysqli_fetch_assoc($resultClient);

        // Query for Caissier
        $queryCaissier = "SELECT nom, prenom FROM caissier WHERE id = ?";
        $statementCaissier = mysqli_prepare($conn, $queryCaissier);
        mysqli_stmt_bind_param($statementCaissier, 'i', $caissier_id);
        mysqli_stmt_execute($statementCaissier);
        $resultCaissier = mysqli_stmt_get_result($statementCaissier);
        $caissierRow = mysqli_fetch_assoc($resultCaissier);
        
        if (!$clientRow || !$caissierRow) {
            header("Location: error.php");
            exit();
        }
    }


}
mysqli_close($conn);
?>


<div class="container mt-4">
    <div class="bl">
        <center><h2 class="mb-4">Bon de livraison</h2></center>
        <input type="hidden" name="id" value="<?php echo "ID: " . $id; ?>">
        <div class="mb-2">Client: <b><?php echo (isset($clientRow)) ? $clientRow['nom'] . ' ' . $clientRow['prenom'] : ''; ?></b></div>
        <div class="mb-2">Caissier: <b><?php echo (isset($caissierRow)) ? $caissierRow['nom'] . ' ' . $caissierRow['prenom'] : ''; ?></b></div>
        <div class="mb-2">Date: <b><?php echo ($bonLivraisonRow) ? $bonLivraisonRow['date'] : ''; ?></b></div>
        <div class="mb-2">Régle: <b><?php echo ($bonLivraisonRow) ? $bonLivraisonRow['reglé'] : ''; ?></b></div>
        <hr class="my-4">
        <div class="table-responsive">
    <table class="table table-bordered">
        <thead>
            <tr>
                <th>Identifiant</th>
                <th>Famille</th>
                <th>Article</th>
                <th>Quantité</th>
                <th>Prix + TVA</th>
                <th>TTC</th>
                <th>Action</th>
            </tr>
        </thead><?php

        $totalTTC = 0;

        while ($detailRow = ($resultDetailBl ? mysqli_fetch_assoc($resultDetailBl) : null)) {
            $articleId = $detailRow['article_id'];

            $queryArticle = "SELECT famille.famille, article.designation, article.prix, article.tva
                             FROM article
                             INNER JOIN famille ON article.famille_id = famille.id
                             WHERE article.id = ?";

            $statementArticle = mysqli_prepare($conn, $queryArticle);
            mysqli_stmt_bind_param($statementArticle, 'i', $articleId);
            mysqli_stmt_execute($statementArticle);
            $resultArticle = mysqli_stmt_get_result($statementArticle);
            $articleRow = mysqli_fetch_assoc($resultArticle);

            if ($articleRow) {
                $totalTTC += ($articleRow['prix'] + $articleRow['tva']) * $detailRow['qte'];

                echo "<tr>";
                echo "<td>" . $detailRow['id'] . "</td>";
                echo "<td>" . $articleRow['famille'] . "</td>";
                echo "<td>" . $articleRow['designation'] . "</td>";
                echo "<td>" . $detailRow['qte'] . "</td>";
                echo "<td>" . ($articleRow['prix'] + $articleRow['tva']) . "</td>";
                echo "<td>" . ($articleRow['prix'] + $articleRow['tva']) * $detailRow['qte'] . "</td>";
                echo "<td>";
                echo '<button class="btn btn-danger"><a href="delete.php?id=' . $detailRow['id'] . '&table=detail_BL">Supprimer</a></button>';
                echo '<button class="btn btn-warning"><a href="edit/editFacture.php?id=' . $detailRow['id'] . '&table=detail_BL &articleID=' . $detailRow['article_id'] . '&BL_id=' . $detailRow['bl_id'] . '&Qte=' . $detailRow['qte'] . '">Modifier</a></button>';
                echo "</td>";
                echo "</tr>";
            }
        }
        mysqli_stmt_close($statementArticle);
        echo "</table>";

        echo "<div class='text-center mt-3'><p class='h4'>Montant total : <span class='MT'>" . $totalTTC . "</span></p></div>";

        ?>
</div>

<!-- ... (unchanged HTML code) ... -->

<?php
include 'footer.php';
?>