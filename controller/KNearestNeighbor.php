<?php
    include "Connection.php";

    try {
        $dataset = array();
        $datasetClass = array();
        $testing = array();
        $testingOriginal = array();

        // Get all dataset from database
        $sqlDataset = "SELECT * FROM t_dataset";
        $resultDataset = pg_query($sqlDataset);
        while ($row = pg_fetch_row($resultDataset)) {
            $data = array();
            array_push($datasetClass, $row[1]);

            array_push($data, $row[2]);
            array_push($data, $row[4]);
            array_push($data, $row[7]);
            array_push($data, $row[8]);
            array_push($data, $row[9]);
            array_push($data, $row[10]);
            array_push($data, $row[11]);
            array_push($data, $row[12]);
            array_push($data, $row[13]);
            array_push($data, $row[14]);
            array_push($data, $row[17]);
            array_push($data, $row[18]);
            array_push($data, $row[19]);
            array_push($data, $row[20]);
            array_push($data, $row[21]);
            array_push($data, $row[23]);

            array_push($dataset, $data);
        }

        // Get all testing data from database
        $sqlTesting = "SELECT * FROM t_testing";
        $resultTesting = pg_query($sqlTesting);
        while ($row = pg_fetch_row($resultTesting)) {
            $data = array();
            array_push($data, $row[1]);
            array_push($data, $row[3]);
            array_push($data, $row[6]);
            array_push($data, $row[7]);
            array_push($data, $row[8]);
            array_push($data, $row[9]);
            array_push($data, $row[10]);
            array_push($data, $row[11]);
            array_push($data, $row[12]);
            array_push($data, $row[13]);
            array_push($data, $row[16]);
            array_push($data, $row[17]);
            array_push($data, $row[18]);
            array_push($data, $row[19]);
            array_push($data, $row[20]);
            array_push($data, $row[22]);
            array_push($testing, $data);

            $dataOriginal = array();
            array_push($dataOriginal, $row[1]);
            array_push($dataOriginal, $row[2]);
            array_push($dataOriginal, $row[3]);
            array_push($dataOriginal, $row[4]);
            array_push($dataOriginal, $row[5]);
            array_push($dataOriginal, $row[6]);
            array_push($dataOriginal, $row[7]);
            array_push($dataOriginal, $row[8]);
            array_push($dataOriginal, $row[9]);
            array_push($dataOriginal, $row[10]);
            array_push($dataOriginal, $row[11]);
            array_push($dataOriginal, $row[12]);
            array_push($dataOriginal, $row[13]);
            array_push($dataOriginal, $row[14]);
            array_push($dataOriginal, $row[15]);
            array_push($dataOriginal, $row[16]);
            array_push($dataOriginal, $row[17]);
            array_push($dataOriginal, $row[18]);
            array_push($dataOriginal, $row[19]);
            array_push($dataOriginal, $row[20]);
            array_push($dataOriginal, $row[22]);
            array_push($testingOriginal, $dataOriginal);
        }

        $sql = "DELETE FROM t_result";
        $result = pg_query($sql);

        // Menghitung jarak dengan Euclidean Distance
        for ($index = 0; $index < count($testing); $index++) {
            $ED = array();

            for ($i = 0; $i < count($dataset); $i++) {
                $dataED = array();
                array_push($dataED, 0.0); // nilai init euclidean distance
                array_push($dataED, $i);  // index dari dataset
                array_push($dataED, $datasetClass[$i]); // kelas dari dataset

                for ($count = 0; $count < count($testing[$index]); $count++) {
                    $dataED[0] += ($dataset[$i][$count] - $testing[$index][$count]) * ($dataset[$i][$count] - $testing[$index][$count]);
                }

                sqrt($dataED[0]);
                array_push($ED, $dataED);
            }

            // Sorting jarak dari terkecil hingga terbesar
            $lengthScan = count($ED) - 2;
            $tempData = array();

            for ($p = 0; $p <= $lengthScan; $p++) {
                for ($q = $p; $q <= $lengthScan + 1; $q++) {
                    if ($ED[$p][0] > $ED[$q][0]) {
                        $tempData = $ED[$p];
                        $ED[$p] = $ED[$q];
                        $ED[$q] = $tempData;
                    }
                }
            }

            // split sample from K value = 15
            $split = array();
            for ($s = 0; $s < 15; $s++) {
                $split[$s] = $ED[$s];
            }

            // check majority
            $kolek = -1;
            $count = 0;
            $resultData = 1;

            $counting = array();
            for ($c = 0; $c < count($split); $c++) {
                $dataSplit = $split[$c];
                if (!array_key_exists($dataSplit[2], $counting)) {
                    $init = 0;
                    $counting[$dataSplit[2]] = array();
                    array_push($counting[$dataSplit[2]], 1);
                } else {
                    $plus = $counting[$dataSplit[2]][0] + 1;
                    array_push($counting[$dataSplit[2]], $plus);
                }
            }

            foreach ($counting as $key => $value) {
                if ($count < $value[0]) {
                    $count = $value[0];
                    $resultData = $key;
                }
            }

            $test = $testingOriginal[$index];
//            $sql = "INSERT INTO t_result (kolek, no_cif, tgl_lahir, jenis_kelamin, tgl_buka, tgl_jt, jwaktu_bln,
//                    plafon, xangsur, angske, angsurpk, angsurbng, tgk_pokok, tgk_bunga, tgl_tgk_pokok, tgl_tgk_bunga,
//                    xtgkp, xtgkb, hr_tgkp, hr_tgkb, kreditke, jenis_jam, nilaiagun) VALUES
//                    ($resultData, '$test[0]', '$test[1]', $test[2], '$test[3]', '$test[4]', $test[5],
//                    $test[6], $test[7], $test[8], $test[9], $test[10], $test[11], $test[12], '$test[13]', '$test[14]',
//                    $test[15], $test[16], $test[17], $test[18], $test[19], '$test[20]', $test[21])";

            $sql = "INSERT INTO t_result (kolek, no_cif, tgl_lahir, jenis_kelamin, tgl_buka, tgl_jt, jwaktu_bln,
                    plafon, xangsur, angske, angsurpk) VALUES
                    ($resultData, '$test[0]', '$test[1]', $test[2], '$test[3]', '$test[4]', $test[5],
                    $test[6], $test[7], $test[8], $test[9])";

            $result = pg_query($sql);
        }
    } catch (Exception $e) {
        echo 'Caught exception: ',  $e->getMessage(), "\n";
    }
?>