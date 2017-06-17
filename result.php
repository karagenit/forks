<?php
    class Fork {
        public $data = 0;
        public $points = 0;
        function __construct($node) {
            $this->data = $node;
            $this->points += $node->watchers->totalCount;
            $this->points += $node->stargazers->totalCount;
            $this->points += $node->mentionableUsers->totalCount;
            $this->points += $node->issues->totalCount;
        }
    }

    session_start();
    require 'lib/curl-graphql.php';

    $token = $_SESSION['token'];
    if($token == "") {
        header("Location: http://caleb.techhounds.com/forks/auth.php");
        exit();
    }

    $owner = $_GET['owner'];
    $name = $_GET['name'];
    if($owner == "" || $name == "") {
        header("Location: http://caleb.techhounds.com/forks/query.html");
        exit();
    }

    $vars = json_encode(array("owner"=>$owner, "name"=>$name));
    $json = build_curl(file_get_contents("query.js"), $vars);
    $forks = json_decode(get_curl($token, $json));
    $sorted_forks = array();

    foreach($forks->data->repository->forks->edges as $edge) {
        $fork = new Fork($edge->node);
        $sorted_forks[$fork->data->nameWithOwner] = $fork; 
    }
    
    uasort($sorted_forks, function($a, $b)
    {
        return $a->points < $b->points;
    });
?>

<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="description" content="Find the most popular forks of a repository!">
    <meta name="author" content="Caleb Smith">

    <title>Github Fork Finder</title>

    <link href="./bootstrap/css/bootstrap.min.css" rel="stylesheet">
    <link href="./bootstrap/css/bootstrap-theme.min.css" rel="stylesheet">
  </head>

  <body>
    <div class="container">
      <h1 class="text-center">Lookup Results</h1>
      <div class="col-md-3"></div>
      <div class="col-md-6">
        <table class="table table-striped">
          <thead>
            <tr>
              <th>Repo</th>
              <th><span class="glyphicon glyphicon-star"></span></th>
              <th><span class="glyphicon glyphicon-eye-open"></span></th>
              <th><span class="glyphicon glyphicon-user"></span></th>
              <th><span class="glyphicon glyphicon-remove"></span></th>
            </tr>
          </thead>
          <tbody>
<?php
    foreach($sorted_forks as $name=>$fork) {
        echo "<tr>";
        echo "<th><a href=\"https://github.com/$name\">$name</a></th>";
        //echo "<th>$fork->points</th>";
        echo "<th>".$fork->data->stargazers->totalCount."</th>";
        echo "<th>".$fork->data->watchers->totalCount."</th>";
        echo "<th>".$fork->data->mentionableUsers->totalCount."</th>";
        echo "<th>".$fork->data->issues->totalCount."</th>";
        echo "</tr>";
    }
?>
          </tbody>
        </table>
<?php
    foreach($forks->errors as $error) {
        echo "<div class=\"alert alert-danger\" role=\"alert\">";
        echo $error->message;
        echo "</div>";  
    }
?>
      .</div>
    '</div>
  </body>
</html>
