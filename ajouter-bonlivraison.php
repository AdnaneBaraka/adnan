<?php

$title = 'bonlivraison';

include 'header.php';
include 'dbconnect.php';

?>
<div class="app-container">
    <?php
        include 'side-bar.php';
    ?>
        
        <form method="post" action="./bonlivraison.php" >
            <h1 class="" id="">Ajouter une bonlivraison</h1>
                    <label for="">Data</label> <input type="date" name="date" class="form-control" placeholder="date" aria-label="date">
                    <label for="">Caissier:</label> 
                        <select id="caissier_id" name="caissier_nom">"
                            <?php
                            $sqlcaissier = "SELECT * FROM caissier";
                            $resultcaissier = $conn->query($sqlcaissier);
                            while ($rowcaissier = $resultcaissier->fetch_assoc()) {
                                echo "<option value='" . $rowcaissier['id'] . "'>" . $rowcaissier['prenom'] . "</option>";
                            }
                            ?>
                        </select><br>
                    <label for="">Client:</label> 
                        <select id="client_id" name="client_nom">"
                            <?php
                            $sqlclient = "SELECT * FROM client";
                            $resultclient = $conn->query($sqlclient);
                            while ($rowclient = $resultclient->fetch_assoc()) {
                                echo "<option value='" . $rowclient['id'] . "'>" . $rowclient['prenom'] . "</option>";
                            }
                            ?>
                        </select><br>
                    <label for="">Réglé:</label>  
                        <select name="reglé" class="form-select" aria-label="Default select example">
                            <option value="1">Réglé</option>
                            <option value="0">Non Réglé</option>
                        </select>
                <button type="submit" id="enregistrer" class="btn btn-primary" name="ajouter">valide</button>
            </form>



            <div class="row w-100 my-4">
            <div class="col-8 mx-auto">
                     <div class="btn-container">
                    <input type="text">
                    
                     <button>ajouter</button>
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
                        
                        //
                            if ($result->num_rows > 0) {
        
                            while ($row = $result->fetch_assoc()) {
                        ?>
                            <tr>
                                <th scope="row"><?php echo($row["id"]);?></th>
                                <td><?php echo($row["designation"]); ?></td>
                                <td><?php echo($row["prix"]); ?></td>
                                <td><?php echo($row["qte"]); ?></td>
                                <td><?php echo($row["total"]); ?></td>
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

include 'footer.php';

?>
