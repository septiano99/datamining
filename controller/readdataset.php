<?php
    include "excel_reader2.php";
    include "connection.php";

    $allowedFileType = [
        'application/vnd.ms-excel',
        'text/xls',
        'text/xlsx',
        'application/vnd.openxmlformats-officedocument.spreadsheetml.sheet'
    ];

    $nip = $_POST['nip'];

    if (in_array($_FILES["file"]["type"], $allowedFileType)) {

        $targetPath = '../upload/' . $_FILES['file']['name'];
        move_uploaded_file($_FILES["file"]["type"], $targetPath);

        // beri permisi agar file xls dapat di baca
        chmod($_FILES["file"]["type"],0777);

        $data = new Spreadsheet_Excel_Reader($_FILES["file"]["type"]);
        $totalRow = $data->rowcount($sheet_index=0);

        $sql = "DELETE FROM t_dataset";
        $result = pg_query($sql);

        for ($i = 2; $i <= $totalRow; $i++) {
            $kolek = $data->val($i, 1);
            $no_cif = $data->val($i, 2);
            $tgl_lahir = $data->val($i, 3);
            $jns_kelamin = $data->val($i, 4);
            $tgl_buka = $data->val($i, 5);
            $tgl_jt = $data->val($i, 6);
            $jwaktu_bln = $data->val($i, 7);
            $plafon = $data->val($i, 8);
            $xangsur = $data->val($i, 9);
            $angske = $data->val($i, 10);
            $angsurpk = $data->val($i, 11);
            $angsurbng = $data->val($i, 12);
            $tgk_pokok = $data->val($i, 13);
            $tgk_bunga = $data->val($i, 14);
            $tgl_tgk_pokok = $data->val($i, 15);
            $tgl_tgk_bunga = $data->val($i, 16);
            $xtgkp = $data->val($i, 17);
            $xtgkb = $data->val($i, 18);
            $hr_tgkp = $data->val($i, 19);
            $hr_tgkb = $data->val($i, 20);
            $kreditke = $data->val($i, 21);
            $jenis_jam = $data->val($i, 22);
            $nilaiagun = $data->val($i, 23);

            $sql = "INSERT INTO t_dataset (kolek, no_cif, tgl_lahir, jenis_kelamin, tgl_buka, tgl_jt, jwaktu_bln,
                    plafon, xangsur, angske, angsurpk, angsurbng, tgk_pokok, tgk_bunga, tgl_tgk_pokok, tgl_tgk_bunga,
                    xtgkp, xtgkb, hr_tgkp, hr_tgkb, kreditke, jenis_jam, nilaiagun) VALUES 
                    ($kolek, '$no_cif', '$tgl_lahir', $jns_kelamin, '$tgl_buka', '$tgl_jt', $jwaktu_bln, 
                    $plafon, $xangsur, $angske, $angsurpk, $angsurbng, $tgk_pokok, $tgk_bunga, '$tgl_tgk_pokok', '$tgl_tgk_bunga',
                    $xtgkp, $xtgkb, $hr_tgkp, $hr_tgkb, $kreditke, '$jenis_jam', $nilaiagun)";

            $result = pg_query($sql);
        }

        echo '<script>alert("Proses Upload Dataset Berhasil")</script>';
        echo '<script>window.location = "../pages/dataset.php?nip=' . $nip . '";</script>';
    } else {
        $type = "error";
        $message = "Invalid File Type. Upload Excel File.";
    }
?>