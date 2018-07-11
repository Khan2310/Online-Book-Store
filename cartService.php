<?php
require 'common.php';
session_start();
header('Content-Type: application/json');

if(!isset($_SESSION['user'])) {
  response([
    'success' => false,
    'errorMessage' => 'You are not logged in. Please login first to add books to cart.'
  ], 401);
}

$conn = connectToDatabase();

function addBookToCart($bookid, $userid) {
  global $conn;
  $query = oci_parse($conn, 'INSERT INTO cart (USERID, BOOKID, QUANTITY, IS_ACTIVE, CREATED_AT)
                            VALUES (:userid, :bookid, 1, 1, CURRENT_TIMESTAMP)');
  oci_bind_by_name($query, ':userid', $userid);
  oci_bind_by_name($query, ':bookid', $bookid);
  if(oci_execute($query)) {
    response([
      'success' => true
    ], 200);
  }
  else {
    response([
      'success' => false,
      'errorMessage' => 'Failed to add book to cart'
    ], 401);
  }
}

function removeBookFromCart($bookid, $userid) {
  global $conn;
  $query = oci_parse($conn, 'UPDATE cart SET IS_ACTIVE = 0 WHERE bookid = :bookid and userid = :userid');
  oci_bind_by_name($query, ':bookid', $bookid);
  oci_bind_by_name($query, ':userid', $userid);
  if(oci_execute($query)) {
    response([
      'success' => true
    ], 200);
  }
  else {
    response([
      'success' => false,
      'errorMessage' => 'Failed to remove book from cart'
    ], 401);
  }
}

function updateCartItemQuantity($bookid, $userid, $quantity) {
  global $conn;
  $query = oci_parse($conn, 'UPDATE cart SET QUANTITY = :quantity WHERE bookid = :bookid and userid = :userid');
  oci_bind_by_name($query, ':quantity', $quantity);
  oci_bind_by_name($query, ':bookid', $bookid);
  oci_bind_by_name($query, ':userid', $userid);
  if(oci_execute($query)) {
    response([
      'success' => true
    ], 200);
  }
  else { response([
      'success' => false,
      'errorMessage' => 'Failed to remove book from cart'
    ], 401);
  }
}

if(isset($_POST['action'])) {
  if($_POST['action'] === 'add') {
    //FIXME validate inputs
    addBookToCart($_POST['bookid'], $_SESSION['user']['USERID'], 1);
    response([
      'success' => true
    ], 200);
  }
  else if ($_POST['action'] === 'remove') {
    //FIXME validation
    removeBookFromCart($_POST['bookid'], $_SESSION['user']['USERID']);
    response([
      'success' => true
    ], 200);
  } else if ($_POST['action'] === 'updateQuantity') {
    //FIXME validation
    updateCartItemQuantity($_POST['bookid'], $_SESSION['user']['USERID'], $_POST['quantity']);
    response([
      'success' => true, ], 200);
  }
}
else {
  response([
    'success' => false,
    'errorMessage' => 'Invalid action'
  ], 401);
}

?>
