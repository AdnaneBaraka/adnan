<?php
include 'dbconnect.php';
$delete= $_GET['delete'];
$delete1= $_GET['delete1'];
$sqlDelete = "DELETE FROM detail_bl where id=$delete ";
$resultDelete = $conn->query($sqlDelete);
if($resultDelete){
    header("Location: http://localhost/adnan/bon_de_livraison_details.php?bonlivraison=$delete1");

}
?>