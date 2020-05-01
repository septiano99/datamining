<?php
    $host = "ec2-52-207-25-133.compute-1.amazonaws.com";
    $dbName = "d3p04j1bg6uce2";
    $user = "zlbsdgquhimfhe";
    $password = "ce6b7fd7e0c1666987a176f54305f8c0887e44af348a1d4d5c2ce9d8a94c6af7";
    $db = pg_connect("host=$host port=5432 dbname=$dbName user=$user password=$password");
    echo "<script>console.log('Connection DB " . $dbName . " Success' );</script>";
?>