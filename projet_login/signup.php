<?php 
    require_once 'header.html';
?>

    <center>
        <div>
            <h2>    Sign Up    </h2>
            <form action="includes/signup.inc.php" method="post">
                <input type="text" name="Nom" placeholder="Nom ..." required><br/><br/>
                <input type="text" name="Prenom" placeholder="prenom ..." required><br/><br/>
                <input type="text" name="Email" placeholder="Email ..." required><br/><br/>
                <input type="text" name="CNE" placeholder="CNE ..." required><br/><br/>
                <input type="password" name="pwd" placeholder="password ..." required><br/><br/>
                <button type="submit" name="submit">Sign Up</button>
            </form>
        </div>
        <?php
            if(isset($_GET['erreur'])){
                $erreur = $_GET['erreur'];
                if($erreur == "CNEExist"){
                    echo "<h3>Erreur! il y a deja un compte avec ce CNE</h3>";
                }
            }
            
        ?>
        </center>
    
</body>
</html>