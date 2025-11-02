<?php 
    try {
        require __DIR__ . "../config/config.php";
    } catch (Exception $e) {
        echo("could not open config file!\nError details:\t" . $e);
    }

    try{
        $db_connection = mysqli_connect($db_server, $db_user, $db_password, $db_name);
    } catch(mysqli_sql_exception) {
        echo"could not connect";
    }

    if($db_connection) {
        echo("current status: connected<br>");
    }
?>