<!DOCTYPE html>
<html>
<body>
    <a href="query.php">Search Repos</a><br>
    <a href="https://github.com/login/oauth/authorize?client_id=<?php echo file_get_contents("client_id.token"); ?>">Authorize via Github</a>
</body>
</html>
