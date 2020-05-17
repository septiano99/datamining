<?php
    require "Classes/PHPExcel/IOFactory.php";
    include "Connection.php";

    $nip = $_GET['nip'];
    $inputfilename = $_FILES['file']['tmp_name'];
    $exceldata = array();

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

    $sql = "DELETE FROM t_testing";
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

        $sql = "INSERT INTO t_testing (no_cif, tgl_lahir, jenis_kelamin, tgl_buka, tgl_jt, jwaktu_bln,
                        plafon, xangsur, angske, angsurpk, angsurbng, tgk_pokok, tgk_bunga, tgl_tgk_pokok, tgl_tgk_bunga,
                        xtgkp, xtgkb, hr_tgkp, hr_tgkb, kreditke, jenis_jam, nilaiagun) VALUES
                        ('$data[0]', '$data[1]', $data[2], '$data[3]', '$data[4]', $data[5],
                        $data[6], $data[7], $data[8], $data[9], $data[10], $data[11], $data[12], '$data[13]', '$data[14]',
                        $data[15], $data[16], $data[17], $data[18], $data[19], '$data[20]', $data[21])";

        $result = pg_query($sql);
    }

    echo '<script>alert("Proses Upload Data Testing Berhasil")</script>';
    echo '<script>window.location = "../pages/Testing.php?nip=' . $nip . '";</script>';
?>