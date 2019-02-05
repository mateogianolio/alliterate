<?php
require('../lib/sql.php');

$response = array(
  'highscore' => 0,
  'rank' => 0,
  'played' => 0,
  'top' => 0
);

$ip = hash('sha256', $_SERVER['REMOTE_ADDR']);

$query = 'SELECT * FROM scores WHERE ip = "' . $ip . '" ORDER BY score DESC LIMIT 1';
$result = $sql->query($query);

if($result)
  $row = $result->fetch_assoc();

$response['highscore'] = $result->num_rows ? intval($row['score']) : 0;

$query = 'SELECT * FROM scores WHERE score > ' . $response['highscore'] . ' ORDER BY score DESC';
$result = $sql->query($query);

if($result) {
  $response['rank'] = 1 + $result->num_rows;
  
  $row = $result->fetch_assoc();
  
  if($result->num_rows)
    $response['top'] = $row['score'];
}

$query = 'SELECT COUNT(*) FROM scores';
$result = $sql->query($query);

if($result)
  $row = $result->fetch_assoc();

$response['played'] = $row['COUNT(*)'];

echo(json_encode($response));
?>