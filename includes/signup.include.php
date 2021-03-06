<?php 

if (isset($_POST["submit"])) {
    
    $name = $_POST["name"];
    $email = $_POST["email"];
    $username = $_POST["username"];
    $password = $_POST["password"];
    $confirmpassword = $_POST["confirmpassword"];

    require_once 'db.include.php';
    require_once 'actions.include.php';

    if (emptyInput($name,$email,$username,$password, $confirmpassword) !== false) {
        header("location: ../signup.php?error=emptyInput");
        exit();
    }

    if (invalidUsername($username) !== false) {
        header("location: ../signup.php?error=invalidUsername");
        exit();
    }

    if (invalidEmail($email) !== false) {
        header("location: ../signup.php?error=invalidEmail");
        exit();
    }

    if (passwordMatch($password,$confirmpassword) !== false) {
        header("location: ../signup.php?error=passwordsDoNotMatch");
        exit();
    }

    if (usernameEmailExists($conn, $username, $email) !== false) {
        exit();
    }

    createUser($conn, $name, $email, $username, $password);
    
} else {
    header("location: ../signup.php");
    exit();
}

