<?php
require('../lib/sql.php');

if(empty($_POST)) {
  echo('no data');
  exit;
}

$ip = hash('sha256', $_SERVER['REMOTE_ADDR']);
$time = $sql->escape_string($_POST['time']);
$words = $_POST['words'];
$score = $sql->escape_string($_POST['score']);
$letters = $_POST['letters'];

if(count(array_unique($letters)) < count($letters)) {
  echo('not unique');
  exit;
}

foreach($words as $word) {
  if(!in_array($word[0], $letters)) {
    echo('wrong letter');
    exit;
  }

  $query = 'SELECT * FROM words WHERE word = "' . $word . '" LIMIT 1';
  $result = $sql->query($query);
  
  if(!$result || !$result->num_rows) {
    echo('wrong word');
    exit;
  }
}

$query = 'INSERT INTO scores (ip, score) VALUES("' . $ip . '", "' . $score . '")';
if($sql->query($query))
  echo('success');
?>