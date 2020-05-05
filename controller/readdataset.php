<?php
    require "Classes/PHPExcel/IOFactory.php";
    include "connection.php";

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

    for ($row = 1; $row <= $highestRow; $row++) {
        $rowData = $sheet->rangeToArray('A' . $row . ':' . $highestColumn . $row, NULL, TRUE, FALSE);

        $sql = "INSERT INTO t_dataset (kolek, no_cif, tgl_lahir, jenis_kelamin, tgl_buka, tgl_jt, jwaktu_bln,
                    plafon, xangsur, angske, angsurpk, angsurbng, tgk_pokok, tgk_bunga, tgl_tgk_pokok, tgl_tgk_bunga,
                    xtgkp, xtgkb, hr_tgkp, hr_tgkb, kreditke, jenis_jam, nilaiagun) VALUES
                    ($rowData[0][0], '$rowData[0][1]', '$rowData[0][2]', $rowData[0][3], '$rowData[0][4]', '$rowData[0][5]', $rowData[0][6],
                    $rowData[0][7], $rowData[0][8], $rowData[0][9], $rowData[0][10], $rowData[0][11], $rowData[0][12], $rowData[0][13], '$rowData[0][14]', '$rowData[0][15]',
                    $rowData[0][16], $rowData[0][17], $rowData[0][18], $rowData[0][19], $rowData[0][20], '$rowData[0][21]', $rowData[0][22])";

        $result = pg_query($sql);
    }

//    $excel = PHPExcel_IOFactory::load('Data Ano clean.xlsx');
//    $excel->setActiveSheetIndex(0);
//
//    echo "<table>";
//    $i = 1;
//
//    while ($excel->getActiveSheet()->getCell('A', $i)->getValue() != "") {
//        $kolek = $excel->getActiveSheet()->getCell('A', $i)->getValue();
//        $no_cif = $excel->getActiveSheet()->getCell('B', $i)->getValue();
//        $tgl_lahir = $excel->getActiveSheet()->getCell('C', $i)->getValue();
//        $jns_kelamin = $excel->getActiveSheet()->getCell('D', $i)->getValue();
//        $tgl_buka = $excel->getActiveSheet()->getCell('E', $i)->getValue();
//        $tgl_jt = $excel->getActiveSheet()->getCell('F', $i)->getValue();
//        $jwaktu_bln = $excel->getActiveSheet()->getCell('G', $i)->getValue();
//        $plafon = $excel->getActiveSheet()->getCell('H', $i)->getValue();
//        $xangsur = $excel->getActiveSheet()->getCell('I', $i)->getValue();
//        $angske = $excel->getActiveSheet()->getCell('J', $i)->getValue();
//        $angsurpk = $excel->getActiveSheet()->getCell('K', $i)->getValue();
//        $angsurbng = $excel->getActiveSheet()->getCell('L', $i)->getValue();
//        $tgk_pokok = $excel->getActiveSheet()->getCell('M', $i)->getValue();
//        $tgk_bunga = $excel->getActiveSheet()->getCell('N', $i)->getValue();
//        $tgl_tgk_pokok = $excel->getActiveSheet()->getCell('O', $i)->getValue();
//        $tgl_tgk_bunga = $excel->getActiveSheet()->getCell('P', $i)->getValue();
//        $xtgkp = $excel->getActiveSheet()->getCell('Q', $i)->getValue();
//        $xtgkb = $excel->getActiveSheet()->getCell('R', $i)->getValue();
//        $hr_tgkp = $excel->getActiveSheet()->getCell('S', $i)->getValue();
//        $hr_tgkb = $excel->getActiveSheet()->getCell('T', $i)->getValue();
//        $kreditke = $excel->getActiveSheet()->getCell('U', $i)->getValue();
//        $jenis_jam = $excel->getActiveSheet()->getCell('V', $i)->getValue();
//        $nilaiagun = $excel->getActiveSheet()->getCell('W', $i)->getValue();
//
//        echo "
//            <tr>
//                <td>" . $kolek . "</td>
//                <td>" . $plafon . "</td>
//            </tr>
//        ";
//
//        $i++;
//    }

//    $allowedFileType = [
//        'application/vnd.ms-excel',
//        'text/xls',
//        'text/xlsx',
//        'application/vnd.openxmlformats-officedocument.spreadsheetml.sheet'
//    ];
//
//    $nip = $_POST['nip'];
//
//    if (in_array($_FILES["filepegawai"]["name"], $allowedFileType)) {
//
//        // upload file xls
//        $target = basename($_FILES['filepegawai']['name']) ;
//        move_uploaded_file($_FILES['filepegawai']['tmp_name'], $target);
//
//        // beri permisi agar file xls dapat di baca
//        chmod($_FILES['filepegawai']['name'],0777);
//
//        // mengambil isi file xls
//        $data = new Spreadsheet_Excel_Reader($_FILES['filepegawai']['name'],false);
//
//        // menghitung jumlah baris data yang ada
//        $totalRow = $data->rowcount($sheet_index=0);
//
//        $sql = "DELETE FROM t_dataset";
//        $result = pg_query($sql);
//
//        for ($i = 2; $i <= $totalRow; $i++) {
//            $kolek = $data->val($i, 1);
//            $no_cif = $data->val($i, 2);
//            $tgl_lahir = $data->val($i, 3);
//            $jns_kelamin = $data->val($i, 4);
//            $tgl_buka = $data->val($i, 5);
//            $tgl_jt = $data->val($i, 6);
//            $jwaktu_bln = $data->val($i, 7);
//            $plafon = $data->val($i, 8);
//            $xangsur = $data->val($i, 9);
//            $angske = $data->val($i, 10);
//            $angsurpk = $data->val($i, 11);
//            $angsurbng = $data->val($i, 12);
//            $tgk_pokok = $data->val($i, 13);
//            $tgk_bunga = $data->val($i, 14);
//            $tgl_tgk_pokok = $data->val($i, 15);
//            $tgl_tgk_bunga = $data->val($i, 16);
//            $xtgkp = $data->val($i, 17);
//            $xtgkb = $data->val($i, 18);
//            $hr_tgkp = $data->val($i, 19);
//            $hr_tgkb = $data->val($i, 20);
//            $kreditke = $data->val($i, 21);
//            $jenis_jam = $data->val($i, 22);
//            $nilaiagun = $data->val($i, 23);
//
//            $sql = "INSERT INTO t_dataset (kolek, no_cif, tgl_lahir, jenis_kelamin, tgl_buka, tgl_jt, jwaktu_bln,
//                    plafon, xangsur, angske, angsurpk, angsurbng, tgk_pokok, tgk_bunga, tgl_tgk_pokok, tgl_tgk_bunga,
//                    xtgkp, xtgkb, hr_tgkp, hr_tgkb, kreditke, jenis_jam, nilaiagun) VALUES
//                    ($kolek, '$no_cif', '$tgl_lahir', $jns_kelamin, '$tgl_buka', '$tgl_jt', $jwaktu_bln,
//                    $plafon, $xangsur, $angske, $angsurpk, $angsurbng, $tgk_pokok, $tgk_bunga, '$tgl_tgk_pokok', '$tgl_tgk_bunga',
//                    $xtgkp, $xtgkb, $hr_tgkp, $hr_tgkb, $kreditke, '$jenis_jam', $nilaiagun)";
//
//            $result = pg_query($sql);
//        }
//
//        // hapus kembali file .xls yang di upload tadi
//        unlink($_FILES['filepegawai']['name']);
//
//        echo '<script>alert("Proses Upload Dataset Berhasil")</script>';
//        echo '<script>window.location = "../pages/dataset.php?nip=' . $nip . '";</script>';
//    } else {
//        $type = "error";
//        $message = "Invalid File Type. Upload Excel File.";
//    }
?>