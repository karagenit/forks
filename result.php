<?php
    require 'util-result.php';
    $finder = new ForkFinder();
    $sorted_forks = $finder->forks;
    $errors = $finder->errors;
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
    foreach($errors as $error) {
        echo "<div class=\"alert alert-danger\" role=\"alert\">";
        echo $error->message;
        echo "</div>";  
    }
?>
      .</div>
    '</div>
  </body>
</html>
