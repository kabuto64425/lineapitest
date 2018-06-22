<?php
  
  if(!isset($_COOKIE['names'])) {
    $data = "https://spreadsheets.google.com/feeds/list/18DtL1BZ7KvPToRWVPgJ4EYcH8q2HK9WPs-ruUAShJf4/od6/public/values?alt=json";
    $json = file_get_contents($data);
    $json_decode = json_decode($json);
    
    $names = $json_decode->feed->entry;
    setcookie(‘names’, $names, time()+60*60*24*7);
  } else {
    $names = $_COOKIE['names'];
  }
  
  if(!isset($_COOKIE['count'])) {
    echo 'aaa';
    setcookie(‘count’, 0, time()+60*60*24*7);
  }
  if($_SERVER['REQUEST_METHOD'] === 'POST'){
    setcookie(‘count’, $_COOKIE['count'] + 1, time()+60*60*24*7);
  }
    
  $count = $_COOKIE['count'];
    
  echo $names[$count]->{'gsx$問題文'}->{'$t'};
  echo '</br>';
  echo $names[$count]->{'gsx$答'}->{'$t'};
  echo $_COOKIE['count'];
  
?>

<form action="index.php" method="POST">
  <input type="submit" value="submit">
</form>
