<?php
require('../lib/sql.php');

$word = $sql->escape_string($_GET['q']);

echo(getWord($word));
?>
