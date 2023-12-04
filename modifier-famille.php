<?php

$title = 'famille';

include 'header.php';
include 'dbconnect.php';

?>

<div class="app-container">
    <?php
    include 'side-bar.php';
    
    if (isset($_GET['famille'])) {
        // Ensure $_GET['famille'] is properly sanitized to prevent SQL injection
        $familleId = mysqli_real_escape_string($conn, $_GET['famille']);
        
        $famillesql = "SELECT * FROM famille WHERE id = $familleId";
        $result = $conn->query($famillesql);

        if (!$result) {
            echo "Error: " . $conn->error;
        }
    ?>     
        <form method="post" action="./famille.php">
            <h1 class="" id="">Modifier une Famille</h1>
            <?php 
            if ($result->num_rows > 0) {
                while ($row = $result->fetch_assoc()) {
            ?>
                    <label for="">Famille:</label>
                    <input value="<?php echo $row['famille'] ?>" type="text" name="nouvelle_famille" class="form-control" placeholder="FAMILLE" aria-label="FAMILLE">
                    <input type="hidden" name="Famille" value="<?php echo $familleId ?>">
            <?php       
                }
            }
            ?>
            <button type="submit" id="enregistrer" class="btn btn-primary" name="modifier">Enregistrer</button>
        </form>
    <?php
    }
    ?>
</div>

<?php

include 'footer.php';

?>
