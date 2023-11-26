<?php

$title = 'caissier';

include 'header.php';
include 'dbconnect.php';

$sql = "SELECT * FROM caissier";

$result = $conn->query($sql);


?>
<div class="app-container">
    <?php
    include 'side-bar.php';
    ?>
        <div class="d-flex justify-content-center container">
            <table class="table border m-auto">
                <thead>
                    <tr>
                        <th scope="col">ID</th>
                        <th scope="col">Nom</th>
                        <th scope="col">Prenom</th>
                        <th scope="col">poste</th>
                        <th scope="col">admin</th>
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
                            <td><?php echo($row["nom"]); ?></td>
                            <td><?php echo($row["prenom"]); ?></td>
                            <td><?php echo($row["poste"]); ?></td>
                            <td><?php echo($row["admin"]); ?></td>
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