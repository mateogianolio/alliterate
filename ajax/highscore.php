<?php
require('../lib/sql.php');

$ip = hash('sha256', $_SERVER['REMOTE_ADDR']);

echo(getHighscore($ip));
?>