<?php

    if (isset($_POST["submit"])) {
        $Nom = $_POST["Nom"];
        $Prenom = $_POST["Prenom"];
        $Email = $_POST["Email"];
        $CNE = $_POST["CNE"];
        $MotDePasse = $_POST["pwd"];

        require_once 'connexion.php';
        require_once 'functions.inc.php';

        if(CNE_exist($conn,$CNE) !== false){
            header("location: ../signup.php?erreur=CNEExist");
            exit;
        }

        create_student($conn,$Nom,$Prenom,$Email,$CNE);
        create_account($conn,$CNE,$MotDePasse);
    }
    else{
        header("location: ../signup.php");
        exit;
    }