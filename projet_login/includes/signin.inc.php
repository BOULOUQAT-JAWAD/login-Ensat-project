<?php

    if (isset($_POST['submit'])) {
        $CNE = $_POST['CNE'];
        $Password = $_POST['pwd'];

        require_once 'functions.inc.php';
        require_once 'connexion.php';

        if(CNE_exist($conn,$CNE) !== true){
            header("location: ../index.php?erreur=CNENotExist");
            exit;
        }
        signin_student($conn,$CNE,$Password);
    }
    else{
        header("location: ../signin.php");
        exit;
    }