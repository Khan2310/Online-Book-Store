<?php
function response ($res, $statusCode = 200) {
  http_response_code($statusCode);
  echo json_encode($res);
  die();
};

function executeAndFetch ($query) {
  $result = [];
  oci_execute($query);
  oci_fetch_all($query, $result, null, null, OCI_FETCHSTATEMENT_BY_ROW);
  return $result;
};

function connectToDatabase() {
  $conn = oci_connect('anik', 'clojure', '192.168.56.101/orcl');
  if (!$conn) {
    $e = oci_error();
    response(json_encode([
      'success' => false,
      'errorMessage' => $e['message']
    ]), 503);
  }

  return $conn;
};

function getCurrentUser() {
  if(isset($_SESSION['user'])) {
    return $_SESSION['user'];
  }
  return NULL;
}

?>
