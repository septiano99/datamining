<?php
    $nip = $_GET['nip'];
    $method = $_POST['method'];

    if ($method == "KNN") {
        echo '<script>window.location = "KNearestNeighbor.php?nip=' . $nip . '";</script>';
    } else {
        echo '<script>window.location = "NaiveBayes.php?nip=' . $nip . '";</script>';
    }
?>