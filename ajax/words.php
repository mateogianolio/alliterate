<?php
require('../lib/sql.php');

$guess = $sql->escape_string($_GET['q']);

if(empty($guess)) {
  echo('');
  return;
}

$query = 'SELECT * FROM words WHERE word = "' . $guess . '" LIMIT 1';
$result = $sql->query($query);

if(!$result || !$result->num_rows) {
  echo('');
  return;
}

$row = $result->fetch_assoc();

echo(json_encode($row));
?>
