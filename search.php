<?php
require 'common.php';
header('Content-Type: application/json');

session_start();

if(!isset($_POST['criteria']) || !isset($_POST['term'])) {
  response( [
    'success' => false,
    'errorMessage' => 'Search criteria and value must be supplied'
    ] , 401);
}

$criteria = $_POST['criteria'];
$searchTerm = $_POST['term'].'%';

// connecting to database
$conn = connectToDatabase();

$searchQuery =  oci_parse($conn, 'SELECT * FROM books WHERE UPPER('. $criteria . ') LIKE UPPER(:term)');
oci_bind_by_name($searchQuery, ':term', $searchTerm);
$bookList = executeAndFetch($searchQuery);

response( [
  'success' => true,
  'bookList' => $bookList
], 200);

?>
