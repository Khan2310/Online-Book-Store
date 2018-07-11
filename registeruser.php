<?php
require 'common.php';
header('Content-Type: application/json');

session_start();

// check if values exist in $_POST;
if(!isset($_POST['email']) || !isset($_POST['name']) || !isset($_POST['password'])) {
  response( [
    'success' => false,
    'errorMessage' => 'Email, name or password cannot be empty'
    ] , 401); }

$name = $_POST['name'];
$email = $_POST['email'];
$password = $_POST['password'];

// validating password, UpperCase LowerCase, number and length must be 8
if(!preg_match('/^\S*(?=\S{8,})(?=\S*[a-z])(?=\S*[A-Z])(?=\S*[\d])\S*$/', $password)) {
  response( [
    'success' => false,
    'errorMessage' => 'Password must contain a lowercase, an uppercase, a number and must be 8 characters in length'
    ] , 401);
}

$conn = connectToDatabase();
// check if there is an existing user with the same email
$query = oci_parse($conn, 'SELECT email FROM users WHERE email = :email');
oci_bind_by_name($query, ':email', $email);
$r =  executeAndFetch($query);

if(count($r)) {
  response( [
    'success' => false,
    'errorMessage' => 'This email is already taken'
  ], 401);
}

$passwordHash = sha1($password);

// passed all validations, insert a new user in the database
$insertQuery = oci_parse($conn, 'INSERT INTO users (userid, email, name, password) VALUES
                                (userid_sequence.nextval, :email, :name, :password)');
oci_bind_by_name($insertQuery, ':email', $email);
oci_bind_by_name($insertQuery, ':name', $name);
oci_bind_by_name($insertQuery, ':password', $passwordHash);

if(oci_execute($insertQuery)) {
  response([
    'success' => true
  ], 200);
}
else {
  response([
    'success' => false,
    'errorMessage' => 'Something went wrong while creating new user'
  ], 501);
}
?>
