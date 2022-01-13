<?php
    session_start();
    require_once 'header.html';
    if(isset($_SESSION['CNE'])){
?>
<style>
    table {
        font-family: arial, sans-serif;
        border-collapse: collapse;
        width: 80%;
    }
    td, th {
        border: 1px solid #dddddd;
        text-align: left;
        padding: 8px;
    }
</style>
    <form action="includes/logout.inc.php">
        <input type="submit" value="logout">
    </form>
    <center>
        <h2>liste des etudiant</h2>
        <table>
            <tr>
                <th>Nom</th>
                <th>Prénom</th>
                <th>Email</th>
                <th>CNE</th>
            </tr>

        <?php
            require 'includes/connexion.php';
            $sql = "SELECT * FROM student ;";
            $stmt = mysqli_stmt_init($conn);

            mysqli_stmt_prepare($stmt,$sql);
            mysqli_stmt_execute($stmt);
        
            $resultData = mysqli_stmt_get_result($stmt);

            while ($row = mysqli_fetch_assoc($resultData)) {
        ?>
                <tr>
                    <td><?php echo $row['Nom']; ?></td>
                    <td><?php echo $row['Prenom']; ?></td>
                    <td><?php echo $row['Email']; ?></td>
                    <td><?php echo $row['CNE']; ?></td>
                </tr>	
        <?php
            }
            }
        ?>
        </table>
        
    </center>
    