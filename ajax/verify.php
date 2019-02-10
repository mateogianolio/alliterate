<?php
require('../lib/sql.php');

$ip = hash('sha256', $_SERVER['REMOTE_ADDR']);
$time = $sql->escape_string($_POST['time']);
$words = $_POST['words'];
$score = $sql->escape_string($_POST['score']);
$letters = $_POST['letters'];

echo(verify($ip, $time, $words, $score, $letters));
?>