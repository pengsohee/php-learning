<?php

function validateData(array $data) 
{
    if (empty($data['name'])) {
        $_SESSION['errors']['name'] = 'Full name must not be empty';
        return false;
    } else if (empty($data['email'])) {
        $_SESSION['errors']['email'] = 'E-mail address must not be empty';
        return false;
    } else if (empty($data['password'])) {
        $_SESSION['errors']['password'] = 'Password must not be empty';
        return false;
    } else if (validatePassword($data['password']) === false){
        return false;
    } else if ($data['password'] !== $data['password_confirmation']) {
        $_SESSION['errors']['password_confirmation'] = 'Confirm password must be the same as inputted password';
        return false;
    } 

    return true;
}

function validatePassword($password){
    // check if the password is at least 8 chars long
    if(strlen($password) < 8){
        $_SESSION['errors']['password'] = 'Password must be atleast 8 characters';
        return false;
    }

    // check if the password contains at least one number
    if(!preg_match('/[0-9]/', $password)){
        $_SESSION['errors']['password'] = "Password must contain at least one number";
    }
    
    // check if the password contains at least one special character
    if(!preg_match('/[\W_]/', $password)){
        $_SESSION['errors']['password'] = "Password must contain at least one special character";
    }

    return true;
}

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    if (!validateData($_POST)) {
        header('Location: /register.php');
        return;
    }

    // TODO: Logic to register user and redirects user back to login page
    $name = $_POST['name'];
    $email = $_POST['email'];    
    $password = $_POST['password'];
    $hashedPassword = password_hash($password, PASSWORD_BCRYPT);

    $connection = new mysqli('db', 'dev_testing', 'dev_testing', 'dev_testing');
    $result = $connection->query("INSERT INTO secured_users (name, email, password) VALUES ('$name', '$email', '$hashedPassword')");

    // var_dump($result);
    // var_dump($email, $name, $hashedPassword);
    // die();

    if($result === false){
        header('Location: /register.php');
        exit;
    }

    session_regenerate_id();
    $_SESSION['user'] = $user;

    header('Location: /login.php');
    exit;

} else {
    die("Not Authorized");
}