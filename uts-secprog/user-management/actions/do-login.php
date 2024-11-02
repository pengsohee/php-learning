<?php

if (session_status() === PHP_SESSION_NONE) session_start();

function validateData(array $data) 
{
    if (empty($data['email'])) {
        $_SESSION['errors']['email'] = 'E-mail address must not be empty';
        return false;
    } else if (empty($data['password'])) {
        $_SESSION['errors']['password'] = 'Password must not be empty';
        return false;
    }

    return true;
}

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    if (!validateData($_POST)) {
        header('Location: /login.php');
        return;
    }

    // TODO: Logic to get user, also if user exists, save to session and redirect to home page
    $connection = new mysqli('db', 'dev_testing', 'dev_testing', 'dev_testing');

    $email = $_POST['email'];
    $password = $_POST['password'];

    $result = $connection->query("SELECT * FROM secured_users WHERE email = '$email'");

    // echo "<pre>";
    // var_dump($result->fetch_all(MYSQLI_ASSOC));
    // echo "</pre>";
    // die();

    if($result->num_rows < 1){
        header("Location: /login.php");
        exit;
    }
    
    $user = $result->fetch_assoc(); // buat ngambil 1 data user nya

    if(password_verify($password, $user['password']) === false){
        header("Location: /login.php");
        exit;
    }

    // cocokin password yang dihash pake sha1
    // if (sha1($password) === $user['password']);

    session_regenerate_id();
    $_SESSION['user'] = $user;

    header("Location: /home.php");
    exit;
} else {
    die("Not Authorized");
}