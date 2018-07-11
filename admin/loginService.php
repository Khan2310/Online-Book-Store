<?php
require 'common.php';
header('Content-Type: application/json');

session_start();

if(!isset($_POST['email']) || !isset($_POST['password'])) {
  response( [
    'success' => false,
    'errorMessage' => 'Email, password cannot be empty'
    ] , 401);
}

$email = $_POST['email'];
$password = $_POST['password'];
$conn = connectToDatabase();
$findUserQuery = oci_parse($conn, 'SELECT * FROM users WHERE email = :email');
oci_bind_by_name($findUserQuery, ':email', $email);

$user = executeAndFetch($findUserQuery);

if(count($user)) {
  //check password equality
  $user = $user[0];
  if($user['PASSWORD'] === sha1($password)) {
    //successful

    $_SESSION['user'] = $user;
    response([
      'success' => true,
      'userInfo' => $user
    ], 200);
  }
  else {
    response([
      'success' => false,
      'errorMessage' => "Email or password didn't match"
    ], 401);
  }
}
else {
  response([
    'success' => false,
    'errorMessage' => "Email or password didn't match"
  ], 401);
}
