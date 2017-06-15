<?php
    $client_id = file_get_contents("client_id.token");
?>

<!DOCTYPE html>
<html>
<body>
    <a href="query.php">Search Repos</a><br>
    <a href="https://github.com/login/oauth/authorize?client_id=<?php echo $client_id; ?>">Authorize via Github</a>
</body>
</html>
