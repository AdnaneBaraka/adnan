<div class="row w-100 my-4">
            <div class="col-8 mx-auto">
                     <div class="btn-container">
                     <a href="./ajouter-article.php" class="btn btn-primary">Ajouter</a>
                    </div>
    
                <table class="table border m-auto">
                    <thead>
                        <tr>
                            <th scope="col">ID</th>
                            <th scope="col">Designation</th>
                            <th scope="col">prix_ht</th>
                            <th scope="col">Tva</th>
                            <th scope="col">Stock</th>
                            <th scope="col">famille</th>
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
                                <td><?php echo($row["prix_ht"]); ?></td>
                                <td><?php echo($row["tva"]); ?></td>
                                <td><?php echo($row["stock"]); ?></td>
                                <td><?php echo($row["famille"]); ?></td>
                                <td>
                                <a class="btn btn-primary btn-sm edit-btn" href="./modifier-article.php?article=<?php echo $row['id']; ?>">
                                    Modifier
                                </a>
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