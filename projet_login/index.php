<?php
    require_once 'header.html';
?>

<center>
    <div>
        <form action="includes/signin.inc.php" method="post">
            <input type="text" name="CNE" placeholder="CNE ..." required><br/><br/>
            <input type="password" name="pwd" placeholder="password ..." required><br/><br/>
            <button type="submit" name="submit">Sign in</button>
            <input type="reset" value="Annuler">
        </form>
        <a href="signup.php">sign up</a>
    </div>
    <?php
        if(isset($_GET['signup'])){
            if($_GET['signup'] == "succes"){
                echo "<h3>vous êtes inscrit</h3>";
            }
        }
        if(isset($_GET['erreur'])){
            $erreur = $_GET['erreur'];
            if($erreur === "CNENotExist"){
                echo "<h3>Error! nous n'avons pas trouver votre CNE,
                Cliquer sur sign up pour creer un compte</h3>";
            }
            if($erreur === "wrongPwd"){
                echo "<h3>Error! mauvais mot de passe, réessayer</h3>";
            }
        }
    ?>
</center>
    
</body>
</html>