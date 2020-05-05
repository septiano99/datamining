<?php
    require "Classes/PHPExcel/IOFactory.php";
    include "connection.php";

    $nip = $_POST['nip'];
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

    $sql = "DELETE FROM t_dataset";
    $result = pg_query($sql);

    foreach ($exceldata as $index => $excelraw) {
        $data = array();

        foreach ($excelraw as $excelcolumn) {
            array_push($data, $excelcolumn);
        }

        $sql = "INSERT INTO t_dataset (kolek, no_cif, tgl_lahir, jenis_kelamin, tgl_buka, tgl_jt, jwaktu_bln,
                    plafon, xangsur, angske, angsurpk, angsurbng, tgk_pokok, tgk_bunga, tgl_tgk_pokok, tgl_tgk_bunga,
                    xtgkp, xtgkb, hr_tgkp, hr_tgkb, kreditke, jenis_jam, nilaiagun) VALUES
                    ($data[0], '$data[1]', '$data[2]', $data[3], '$data[4]', '$data[5]', $data[6],
                    $data[7], $data[8], $data[9], $data[10], $data[11], $data[12], $data[13], '$data[14]', '$data[15]',
                    $data[16], $data[17], $data[18], $data[19], $data[20], '$data[21]', $data[22])";

        $result = pg_query($sql);
    }

    echo '<script>alert("Proses Upload Dataset Berhasil")</script>';
    echo '<script>window.location = "../pages/dataset.php?nip=' . $nip . '";</script>';
?>