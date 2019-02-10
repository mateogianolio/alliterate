<?php
// ini_set('display_errors', 1);

$config = include('config.php');
$sql = new mysqli('localhost', $config['username'], $config['password'], $config['db']);

if ($sql->connect_errno) {
  die($sql->error);
}

function q($query) {
  global $sql;
  return $sql->query($query);
}

function getHighscore($ip) {
  $response = array(
    'highscore' => 0,
    'rank' => 1,
    'played' => 0,
    'top' => 0,
    'users' => 0,
  );

  $result = q('SELECT * FROM scores WHERE ip = "' . $ip . '" ORDER BY score DESC LIMIT 1');
  $response['highscore'] = $result->num_rows ? intval($result->fetch_assoc()['score']) : 0;

  $result = q('SELECT * FROM scores WHERE score > ' . $response['highscore'] . ' ORDER BY score DESC');
  if ($result->num_rows) {
    $response['rank'] = 1 + $result->num_rows;
    $response['top'] = $result->fetch_assoc()['score'];
  }

  $result = q('SELECT COUNT(*) FROM scores');
  $response['played'] = $result->fetch_assoc()['COUNT(*)'];

  q('INSERT INTO users (ip, last_activity) VALUES ("' . $ip . '", NOW()) ON DUPLICATE KEY UPDATE last_activity = NOW()');

  $result = q('SELECT COUNT(*) FROM users WHERE last_activity > NOW() - INTERVAL 5 MINUTE');
  $response['users'] = $result->fetch_assoc()['COUNT(*)'];

  return json_encode($response);
}

function verify($ip, $time, $words, $score, $letters) {
  if (round(floatval($time)) != 60) {
    return 'wrong time';
  }
  
  foreach ($words as $word) {
    if (!in_array($word[0], $letters)) {
      return 'wrong letter';
    }
  
    $result = q('SELECT * FROM words WHERE word = "' . $word . '" LIMIT 1');
    if (!$result->num_rows) {
      return 'wrong word';
    }
  }
  
  q('INSERT INTO scores (ip, score) VALUES("' . $ip . '", "' . $score . '")');
  q('INSERT INTO users (ip, last_activity) VALUES ("' . $ip . '", NOW()) ON DUPLICATE KEY UPDATE last_activity = NOW()');

  return 'success';
}

function getWord($word) {
  if (empty($word)) {
    return '';
  }

  $result = q('SELECT * FROM words WHERE word = "' . $word . '" LIMIT 1');
  return json_encode($result->fetch_assoc());
}
?>