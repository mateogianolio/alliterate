<?php
// ini_set('display_errors', 1);

$config = include('config.php');
$sql = new mysqli('localhost', $config['username'], $config['password'], $config['db']);

if ($sql->connect_errno) {
  die($sql->error);
}

function getHighscore($ip) {
  global $sql;

  $response = array(
    'highscore' => 0,
    'rank' => 0,
    'played' => 0,
    'top' => 0,
    'users' => 0,
  );

  $query = 'SELECT * FROM scores WHERE ip = "' . $ip . '" ORDER BY score DESC LIMIT 1';
  $result = $sql->query($query);

  $row = $result->fetch_assoc();
  $response['highscore'] = $result->num_rows ? intval($row['score']) : 0;

  $query = 'SELECT * FROM scores WHERE score > ' . $response['highscore'] . ' ORDER BY score DESC';
  $result = $sql->query($query);

  $response['rank'] = 1 + $result->num_rows;
  
  $row = $result->fetch_assoc();
  
  if ($result->num_rows) {
    $response['top'] = $row['score'];
  }

  $query = 'SELECT COUNT(*) FROM scores';
  $result = $sql->query($query);

  $row = $result->fetch_assoc();
  $response['played'] = $row['COUNT(*)'];

  $query = 'INSERT INTO users (ip, last_activity) VALUES ("' . $ip . '", NOW()) ON DUPLICATE KEY UPDATE last_activity = NOW()';
  $result = $sql->query($query);

  $query = 'SELECT COUNT(*) FROM users WHERE last_activity > NOW() - INTERVAL 5 MINUTE';
  $result = $sql->query($query);

  $row = $result->fetch_assoc();
  $response['users'] = $row['COUNT(*)'];

  return json_encode($response);
}

function verify($ip, $time, $words, $score, $letters) {
  global $sql;

  if (round(floatval($time)) != 60) {
    return 'wrong time';
  }
  
  foreach ($words as $word) {
    if (!in_array($word[0], $letters)) {
      return 'wrong letter';
    }
  
    $query = 'SELECT * FROM words WHERE word = "' . $word . '" LIMIT 1';
    $result = $sql->query($query);
    
    if (!$result->num_rows) {
      return 'wrong word';
    }
  }
  
  $query = 'INSERT INTO scores (ip, score) VALUES("' . $ip . '", "' . $score . '")';
  $result = $sql->query($query);

  $query = 'INSERT INTO users (ip, last_activity) VALUES ("' . $ip . '", NOW()) ON DUPLICATE KEY UPDATE last_activity = NOW()';
  $result = $sql->query($query);

  return 'success';
}

function getWord($word) {
  global $sql;

  if (empty($word)) {
    return '';
  }

  $query = 'SELECT * FROM words WHERE word = "' . $word . '" LIMIT 1';
  $result = $sql->query($query);

  $row = $result->fetch_assoc();

  return json_encode($row);
}
?>