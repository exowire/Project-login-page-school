<?php if (isset($_POST["login"])) {
    $email = $_POST['email'];
    $password = $_POST['password'];

    include('dbh.inc.php');
    include('functions.inc.php');

    if (emptyInputLogin($email, $password) !== false) {
        header("location:../login.php?error=emptyinput");
        exit();
    }
    if (invalidEmail($email) !== false) {
        header("location:../login.php?error=invalidEmail");
        exit();
    }

}
else { 
    header("location:../login.php");
    exit();
}