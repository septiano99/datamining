<?php
    $host = "ec2-54-161-208-31.compute-1.amazonaws.com";
    $dbName = "dl7s8o74qnp8k";
    $user = "tqlccckautcmwv";
    $password = "252c19eee6936f6e91959793ed87619f9071092272e34c42ecd20f8d9aba59ef";
    $db = pg_connect("host=$host port=5432 dbname=$dbName user=$user password=$password");
    echo "<script>console.log('Connection DB " . $dbName . " Success' );</script>";
?>