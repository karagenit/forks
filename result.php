<?php
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

    foreach($forks->data->repository->forks->edges as $fork) {
        $sorted_forks[$fork->node->nameWithOwner] = $fork->node->watchers->totalCount;
        $sorted_forks[$fork->node->nameWithOwner] += $fork->node->stargazers->totalCount;
        $sorted_forks[$fork->node->nameWithOwner] += $fork->node->mentionableUsers->totalCount;
        $sorted_forks[$fork->node->nameWithOwner] += $fork->node->issues->totalCount;
    }
    
    arsort($sorted_forks);
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
      <div class="col-md-3"></div>
      <div class="col-md-6">
        <table class="table table-striped">
          <thead>
            <tr>
              <th>Repo</th>
              <th>Value</th>
            </tr>
          </thead>
          <tbody>
<?php
    foreach($sorted_forks as $fork=>$points) {
        echo "<tr>";
        echo "<th>$fork</th>";
        echo "<th>$points</th>";
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
      </div>
    </div>
  </body>
</html>
