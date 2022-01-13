<?php

function create_student($conn,$Nom,$Prenom,$Email,$CNE){
    $sql = "INSERT INTO student (Nom,Prenom,Email,CNE) VALUES (?,?,?,?) ;";
    
    $stmt = mysqli_stmt_init($conn);
    if(!mysqli_stmt_prepare($stmt,$sql)){
        header("location: ../signup.php?error=stmtfailed");
        exit();
    }

    mysqli_stmt_bind_param($stmt,"ssss",$Nom,$Prenom,$Email,$CNE);
    mysqli_stmt_execute($stmt);
    mysqli_stmt_close($stmt);

}
function get_student_id($conn,$CNE){
    $sql = "SELECT * FROM student WHERE CNE = ?;";
    $stmt = mysqli_stmt_init($conn);
    if(!mysqli_stmt_prepare($stmt,$sql)){
        header("location: ../signup.php?error=stmtfailed");
        exit();
    }

    mysqli_stmt_bind_param($stmt,"s",$CNE);
    mysqli_stmt_execute($stmt);

    $resultData = mysqli_stmt_get_result($stmt);

    if($row = mysqli_fetch_assoc($resultData)){
        return $row;
    }
    else{
        $result = false;
        return $result;
    }
}
function CNE_exist($conn,$CNE){
    if(get_student_id($conn,$CNE) !== false){
        return true;
    }
    else{
        return false;
    }
}
function create_account($conn,$CNE,$MotDePasse){

    $row = get_student_id($conn,$CNE);
    $id_student = $row["id_student"];
    $stat = "true";

    $sql = "INSERT INTO account (id_student,CNE,MotDePasse,stat) VALUES (?,?,?,?) ;";
    
    $stmt = mysqli_stmt_init($conn);
    if(!mysqli_stmt_prepare($stmt,$sql)){
        header("location: ../signup.php?error=stmtfailed");
        exit();
    }

    $hashedPwd = password_hash($MotDePasse,PASSWORD_DEFAULT);

    mysqli_stmt_bind_param($stmt,"isss",$id_student,$CNE,$hashedPwd,$stat);
    mysqli_stmt_execute($stmt);
    mysqli_stmt_close($stmt);

    header("location: ../index.php?signup=succes");
    exit();

}
function signin_student($conn,$CNE,$Password){
    $row = get_student_id($conn,$CNE);
    $id_student = $row['id_student'];

    $sql = "SELECT * FROM account WHERE CNE = ? OR id_student = ?;";

    $stmt = mysqli_stmt_init($conn);
    mysqli_stmt_prepare($stmt,$sql);
    mysqli_stmt_bind_param($stmt,"si",$CNE,$id_student);
    mysqli_stmt_execute($stmt);

    $resultData = mysqli_stmt_get_result($stmt);
    $row2 = mysqli_fetch_assoc($resultData);

    $pwd = $row2['MotDePasse'];

    $checkPassword = password_verify($Password,$pwd);

    if($checkPassword === false){
        header("location: ../index.php?erreur=wrongPwd");
        exit();
    }else{
        session_start();
        $_SESSION['CNE'] = $CNE;
        header("location: ../liste_etudiant.php");
        exit();
    }
}