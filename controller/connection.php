<?php
    $host = "ec2-18-232-143-90.compute-1.amazonaws.com";
    $dbName = "dbvnr5qt9dco7q";
    $user = "mhwokbyoflkkvc";
    $password = "1749b4963d9b4bd285e939bd82d382c95ae7b9ca5ecbfc4b570eba0fa89ec7e1";
    $db = pg_connect("host=$host port=5432 dbname=$dbName user=$user password=$password");
    echo "<script>console.log('Connection DB " . $dbName . " Success' );</script>";
?>