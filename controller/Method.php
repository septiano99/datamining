<?php
    require "Classes/PHPExcel/IOFactory.php";
    include "Connection.php";

    $nip = $_GET['nip'];
    $method = $_POST['method'];
    $inputfilename = $_FILES['file']['tmp_name'];

    try {
        $inputfiletype = PHPExcel_IOFactory::identify($inputfilename);
        $objReader = PHPExcel_IOFactory::createReader($inputfiletype);
        $objPHPExcel = $objReader->load($inputfilename);
    } catch (Exception $e) {
        die('Error read "' . pathinfo($inputfilename, PATHINFO_BASENAME) . '": ' . $e->getMessage());
    }

    $sheet = $objPHPExcel->getSheet(0);
    $highestRow = $sheet->getHighestRow();
    $highestColumn = $sheet->getHighestColumn();

    for ($row = 2; $row <= $highestRow; $row++) {
        $rowData = $sheet->rangeToArray('A' . $row . ':' . $highestColumn . $row, NULL, TRUE, FALSE);
        $exceldata[] = $rowData[0];
    }

    $sql = "DELETE FROM t_confusion";
    $result = pg_query($sql);

    for ($i = 0; $i < count($exceldata); $i++) {
        $data = array();

        for ($j = 0; $j < count($exceldata[$i]); $j++) {
            if ($exceldata[$i][$j] == null) {
                array_push($data, "-1");
            } else {
                array_push($data, $exceldata[$i][$j]);
            }
        }

        $sql = "INSERT INTO t_confusion (kolek) VALUES ($data[0])";
        $result = pg_query($sql);
    }

    pg_close();

    if ($method == "KNN") {
        echo '<script>window.location = "KNearestNeighbor.php?nip=' . $nip . '";</script>';
    } else {
        echo '<script>window.location = "NaiveBayes.php?nip=' . $nip . '";</script>';
    }
?>