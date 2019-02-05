<?php
require('../lib/sql.php');
require('../lib/functions.php');

if(empty($_POST))
  exit;

$ip = hash('sha256', $_SERVER['REMOTE_ADDR']);
$time = $sql->escape_string($_POST['time']);
$words = $_POST['words'];
$score = $sql->escape_string($_POST['score']);
$letters = $_POST['letters'];
$points = 0;

if(count(array_unique($letters)) < count($letters))
  exit;

if(round($time) != 60)
  exit;

foreach($words as $word) {
  if(!in_array($word[0], $letters))
    exit;
  
  $data = json_decode(getWord($word));
  if(!$data)
    exit;
  
  $points += $data->points;
}

if($points != $score)
  exit;

$query = 'INSERT INTO scores (ip, score) VALUES("' . $ip . '", "' . $score . '")';
if($sql->query($query))
  $response = 'success';

echo($response);
?>