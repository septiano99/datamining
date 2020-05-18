<?php
    include "Connection.php";
    $nip = $_GET['nip'];

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
            array_push($dataOriginal, $row[21]);
            array_push($dataOriginal, $row[22]);
            array_push($testingOriginal, $dataOriginal);
        }

        $sql = "DELETE FROM t_result";
        $result = pg_query($sql);

        // Menghitung jarak dengan Euclidean Distance
        for ($index = 0; $index < count($testing); $index++) {
            error_log("============================ TEST DATA " . $index . "====================================");
            $dataTest = $testing[$index];

            // Menghitung probabilitas class (Prob Ci)
            $probCi = array();
            for ($i = 0; $i < count($dataset); $i++) {
                if (!array_key_exists($datasetClass[$i], $probCi)) {
                    $probCi[$datasetClass[$i]] = array();
                    array_push($probCi[$datasetClass[$i]], 1);
                } else {
                    $plus = $probCi[$datasetClass[$i]][0] + 1;
                    array_push($probCi[$datasetClass[$i]], $plus);
                }
            }

            $resultProdCi = array();
            foreach ($probCi as $key => $value) {
                $devide = $value[0] / count($dataset);
                $resultProdCi[$key] = array();
                array_push($resultProdCi[$key], $devide);
            }

            error_log("----------------------- Probabilitas Ci -------------------------------");
            foreach ($resultProdCi as $key => $value) {
                error_log($key . " => " . $value[0]);
            }
            error_log("-----------------------------------------------------------------------");

            // Menghitung probabilitas arrtibute (Prob XCi)
            $resultProbXCi = array();
            foreach ($probCi as $key => $value) {
                $dataColumn = array();

                for ($column = 0; $column < count($dataTest); $column++) {
                    $calculate = 0;

                    for ($ii = 0; $ii < count($dataset); $ii++) {
                        if ($key == $datasetClass[$ii] && $dataTest[$column] == $dataset[$ii][$column]) {
                            $calculate++;
                        }
                    }

                    $resultCalculate = $calculate / $value[0];
                    array_push($dataColumn, $resultCalculate);
                }

                $resultProbXCi[$key] = array();
                array_push($resultProbXCi[$key], $dataColumn);
            }

            // Multiply probabilitas attribute
            $resultMultiplyProbXCi = array();
            foreach ($resultProbXCi as $key => $value) {
                $calcAtt = 0;

                $att = 0;
                for (; $att < count($value[0]); $att++) {
                    if ($value[0][$att] != 0) {
                        $calcAtt = $value[0][$att];
                        break;
                    }
                }

                for ($atts = $att; $atts < count($value[0]); $atts++) {
                    if ($value[0][$att] != 0) {
                        $calcAtt = ($calcAtt * $value[0][$atts]) + 1 / 1;
                    }
                }

                $resultMultiplyProbXCi[$key] = array();
                array_push($resultMultiplyProbXCi[$key], $calcAtt);
            }

            error_log("----------------------- Probabilitas XCi ------------------------------");
            foreach ($resultMultiplyProbXCi as $key => $value) {
                error_log($key . " => " . $value[0]);
            }
            error_log("-----------------------------------------------------------------------");

            // Multiply probabilitas class dengan probabilitas class (Ci * XCi)
            error_log("---------------------- Probabilitas Final -----------------------------");
            $compare = -1;
            $resultData = 1;
            foreach ($resultProdCi as $key => $value) {
                $finalCount = ($resultMultiplyProbXCi[$key][0] * $value[0]) + 2 / 1;
                $finalCount = 100 - $finalCount;

                if ($compare < $finalCount) {
                    $compare = $finalCount;
                    $resultData = $key;
                }
            }
            error_log("Result : " . $resultData . " (" . $compare . ")");
            error_log("-----------------------------------------------------------------------");
            error_log("=============================== END ===================================");

            $test = $testingOriginal[$index];
            $sql = "INSERT INTO t_result (kolek, no_cif, tgl_lahir, jenis_kelamin, tgl_buka, tgl_jt, jwaktu_bln,
                    plafon, xangsur, angske, angsurpk, angsurbng, tgk_pokok, tgl_tgk_pokok, tgl_tgk_bunga,
                    xtgkp, xtgkb, hr_tgkp, hr_tgkb, kreditke, jenis_jam, nilaiagun) VALUES
                    ($resultData, '$test[0]', '$test[1]', $test[2], '$test[3]', '$test[4]', $test[5],
                    $test[6], $test[7], $test[8], $test[9], $test[10], $test[11], '$test[13]', '$test[14]',
                    $test[15], $test[16], $test[17], $test[18], $test[19], '$test[20]', $test[21])";

            $result = pg_query($sql);
        }


        echo '<script>alert("Proses Prediksi Selesai Menggunakan Metode Naive Bayes")</script>';
        echo '<script>window.location = "../pages/Result.php?nip=' . $nip . '";</script>';
    } catch (Exception $e) {
        echo 'Caught exception: ',  $e->getMessage(), "\n";
    }

    pg_close();
?>