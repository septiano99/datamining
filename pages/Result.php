<html>
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <title>DATA MINING | Admin</title>
    <meta content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no" name="viewport">
    <link rel="stylesheet" href="../style/css/bower_components/bootstrap/dist/css/bootstrap.min.css">
    <link rel="stylesheet" href="../style/css/bower_components/font-awesome/css/font-awesome.min.css">
    <link rel="stylesheet" href="../style/css/bower_components/Ionicons/css/ionicons.min.css">
    <link rel="stylesheet" href="../style/css/dist/css/AdminLTE.min.css">
    <link rel="stylesheet" href="../style/css/dist/css/skins/_all-skins.min.css">
    <link rel="stylesheet" href="../style/css/bower_components/morris.js/morris.css">
    <link rel="stylesheet" href="../style/css/bower_components/jvectormap/jquery-jvectormap.css">
    <link rel="stylesheet" href="../style/css/bower_components/bootstrap-datepicker/dist/css/bootstrap-datepicker.min.css">
    <link rel="stylesheet" href="../style/css/bower_components/bootstrap-daterangepicker/daterangepicker.css">
    <link rel="stylesheet" href="../style/css/plugins/bootstrap-wysihtml5/bootstrap3-wysihtml5.min.css">
    <script src="https://oss.maxcdn.com/html5shiv/3.7.3/html5shiv.min.js"></script>
    <script src="https://oss.maxcdn.com/respond/1.4.2/respond.min.js"></script>
    <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,600,700,300italic,400italic,600italic">
</head>
<body class="hold-transition skin-blue sidebar-mini">
<div class="wrapper">
    <header class="main-header">
        <a href="dashboard.php?nip=<?php echo $_GET['nip']; ?>" class="logo">
            <span class="logo-mini"><b>D</b>M</span>
            <span class="logo-lg"><b>Data</b>Mining</span>
        </a>

        <nav class="navbar navbar-static-top">
            <a href="#" class="sidebar-toggle" data-toggle="push-menu" role="button">
                <span class="sr-only">Toggle navigation</span>
            </a>

            <div class="navbar-custom-menu">
                <ul class="nav navbar-nav">
                    <li class="dropdown user user-menu">
                        <a href="#" class="dropdown-toggle" data-toggle="dropdown">
                            <span class="hidden-xs"><?php echo $_GET['nip']; ?></span>
                        </a>
                        <ul class="dropdown-menu">
                            <!-- Menu Footer-->
                            <li class="user-footer">
                                <div class="pull-right">
                                    <form action="../controller/Logout.php" method="get">
                                        <input type="submit" class="btn btn-default btn-flat" value="Sign out">
                                    </form>
                                </div>
                            </li>
                        </ul>
                    </li>
                </ul>
            </div>
        </nav>
    </header>
    <aside class="main-sidebar">
        <section class="sidebar">
            <br>
            <br>
            <!--MENU SLIDER-->
            <ul class="sidebar-menu" data-widget="tree">
                <li class="header">MAIN MENU</li>
                <li><a href="Dataset.php?nip=<?php echo $_GET['nip']; ?>"><i class="pull-right-container"></i>Dataset</a></li>
                <li><a href="Testing.php?nip=<?php echo $_GET['nip']; ?>"><i class="pull-right-container"></i>Data Tesing</a></li>
                <li><a href="Result.php?nip=<?php echo $_GET['nip']; ?>"><i class="pull-right-container"></i>Result</a></li>
            </ul>
        </section>
    </aside>

    <div class="content-wrapper">
        <section class="content-header">
            <h1>
                Result Classification
            </h1>
        </section>
        <section class="content">
            <form method="post" enctype="multipart/form-data" action="../controller/Method.php?nip=<?php echo $_GET['nip']; ?>">
                Lakukan prediksi
                <br/>
                <select name="method" id="method">
                    <option value="KNN">K-Nearest Neighbors</option>
                    <option value="NB">Naive Bayes</option>
                </select>
                <br/><br/>
                Pilih File Pembanding:
                <br/>
                <input name="file" type="file" required="required" accept=".xls,.xlsx">
                <br/><br/>
                <input name="upload" type="submit" value="Start">
            </form>
            <br/>
            <h1>
                RESULT
            </h1>
            <div style="overflow-x:auto;">
                <?php
                    include '../controller/Connection.php';
                    $kolek1to1 = 0;
                    $kolek1to2 = 0;
                    $kolek1to3 = 0;
                    $kolek1to4 = 0;
                    $kolek1to5 = 0;

                    $kolek2to1 = 0;
                    $kolek2to2 = 0;
                    $kolek2to3 = 0;
                    $kolek2to4 = 0;
                    $kolek2to5 = 0;

                    $kolek3to1 = 0;
                    $kolek3to2 = 0;
                    $kolek3to3 = 0;
                    $kolek3to4 = 0;
                    $kolek3to5 = 0;

                    $kolek4to1 = 0;
                    $kolek4to2 = 0;
                    $kolek4to3 = 0;
                    $kolek4to4 = 0;
                    $kolek4to5 = 0;

                    $kolek5to1 = 0;
                    $kolek5to2 = 0;
                    $kolek5to3 = 0;
                    $kolek5to4 = 0;
                    $kolek5to5 = 0;

                    $positive = 0;
                    $negative = 0;

                    $rowResult = array();
                    $sql = "SELECT * FROM t_result";
                    $result1 = pg_query($sql);
                    while ($row = pg_fetch_row($result1)) {
                        array_push($rowResult, $row[4]);
                    }

                    $sql = "SELECT * FROM t_confusion";
                    $result2 = pg_query($sql);
                    $index = 0;
                    while ($row = pg_fetch_row($result2)) {
                        $dataRes = $rowResult[$index];
                        if ($row[1] == 1) {
                            if ($dataRes[1] == 1) {
                                $kolek1to1++;
                                $positive++;
                            } else if ($dataRes[1] == 2) {
                                $kolek1to2++;
                                $negative++;
                            } else if ($dataRes[1] == 3) {
                                $kolek1to3++;
                                $negative++;
                            } else if ($dataRes[1] == 4) {
                                $kolek1to4++;
                                $negative++;
                            } else if ($dataRes[1] == 5) {
                                $kolek1to5++;
                                $negative++;
                            }
                        } else if ($row[1] == 2) {
                            if ($dataRes[1] == 1) {
                                $kolek2to1++;
                                $negative++;
                            } else if ($dataRes[1] == 2) {
                                $kolek2to2++;
                                $positive++;
                            } else if ($dataRes[1] == 3) {
                                $kolek2to3++;
                                $negative++;
                            } else if ($dataRes[1] == 4) {
                                $kolek2to4++;
                                $negative++;
                            } else if ($dataRes[1] == 5) {
                                $kolek2to5++;
                                $negative++;
                            }
                        } else if ($row[1] == 3) {
                            if ($dataRes[1] == 1) {
                                $kolek3to1++;
                                $negative++;
                            } else if ($dataRes[1] == 2) {
                                $kolek3to2++;
                                $negative++;
                            } else if ($dataRes[1] == 3) {
                                $kolek3to3++;
                                $positive++;
                            } else if ($dataRes[1] == 4) {
                                $kolek3to4++;
                                $negative++;
                            } else if ($dataRes[1] == 5) {
                                $kolek3to5++;
                                $negative++;
                            }
                        } else if ($row[1] == 4) {
                            if ($dataRes[1] == 1) {
                                $kolek4to1++;
                                $negative++;
                            } else if ($dataRes[1] == 2) {
                                $kolek4to2++;
                                $negative++;
                            } else if ($dataRes[1] == 3) {
                                $kolek4to3++;
                                $negative++;
                            } else if ($dataRes[1] == 4) {
                                $kolek4to4++;
                                $positive++;
                            } else if ($dataRes[1] == 5) {
                                $kolek4to5++;
                                $negative++;
                            }
                        } else if ($row[1] == 5) {
                            if ($dataRes[1] == 1) {
                                $kolek5to1++;
                                $negative++;
                            } else if ($dataRes[1] == 2) {
                                $kolek5to2++;
                                $negative++;
                            } else if ($dataRes[1] == 3) {
                                $kolek5to3++;
                                $negative++;
                            } else if ($dataRes[1] == 4) {
                                $kolek5to4++;
                                $negative++;
                            } else if ($dataRes[1] == 5) {
                                $kolek5to5++;
                                $positive++;
                            }
                        }

                        $index++;
                    }

                    pg_close();
                    error_log("Positive : " . $positive);
                    error_log("Negative : " . $negative);
                ?>
                <h3 style="text-align: center">Confusion Matrix</h3>
                <table border="1" style="margin-left: auto; margin-right: auto;">
                    <tr>
                        <th><b>Positive</b></th>
                        <th><b>Negative</b></th>
                    </tr>
                    <tr>
                        <td><?php echo $positive; ?></td>
                        <td><?php echo $negative; ?></td>
                    </tr>
                </table>
                <br/><br/>
                <table border="1">
                    <tr>
                        <th><b>Kolek</b></th>
                        <th>No CIF</th>
                        <th>Jenis Kelamin</th>
                        <th>Jangka Waktu/Bulan</th>
                        <th>Plafon</th>
                        <th>XAngsuran</th>
                        <th>Angsuran Ke</th>
                        <th>Angsur PK</th>
                        <th>Angsur BNG</th>
                        <th>Tunggak Pokok</th>
                        <th>Tunggak Bunga</th>
                        <th>XTGKP</th>
                        <th>XTGKB</th>
                        <th>HR_TGKP</th>
                        <th>HT_TGKB</th>
                        <th>Kredit Ke</th>
                        <th>Nilai Agunan</th>
                    </tr>
                    <?php
                    include '../controller/Connection.php';
                    
                    $sql = "SELECT * FROM t_result";
                    $result = pg_query($sql);
                    while ($row = pg_fetch_row($result)) {

                        ?>
                        <tr>
                            <td><b><?php echo $row[1]; ?></b></td>
                            <td><?php echo $row[2]; ?></td>
                            <td><?php echo $row[4]; ?></td>
                            <td><?php echo $row[7]; ?></td>
                            <td><?php echo $row[8]; ?></td>
                            <td><?php echo $row[9]; ?></td>
                            <td><?php echo $row[10]; ?></td>
                            <td><?php echo $row[11]; ?></td>
                            <td><?php echo $row[12]; ?></td>
                            <td><?php echo $row[13]; ?></td>
                            <td><?php echo $row[14]; ?></td>
                            <td><?php echo $row[17]; ?></td>
                            <td><?php echo $row[18]; ?></td>
                            <td><?php echo $row[19]; ?></td>
                            <td><?php echo $row[20]; ?></td>
                            <td><?php echo $row[21]; ?></td>
                            <td><?php echo $row[23]; ?></td>
                        </tr>
                        <?php
                    }

                    pg_close();
                    ?>
                </table>
            </div>
        </section>
    </div>

    <aside class="control-sidebar control-sidebar-dark">
        <ul class="nav nav-tabs nav-justified control-sidebar-tabs">
            <li><a href="#control-sidebar-home-tab" data-toggle="tab"><i class="fa fa-home"></i></a></li>
            <li><a href="#control-sidebar-settings-tab" data-toggle="tab"><i class="fa fa-gears"></i></a></li>
        </ul>

    </aside>
    <div class="control-sidebar-bg"></div>
</div>



<script src="../style/css/bower_components/jquery/dist/jquery.min.js"></script>
<script src="../style/css/bower_components/jquery-ui/jquery-ui.min.js"></script>
<script>
    $.widget.bridge('uibutton', $.ui.button);
</script>
<script src="../style/css/bower_components/bootstrap/dist/js/bootstrap.min.js"></script>
<script src="../style/css/bower_components/raphael/raphael.min.js"></script>
<script src="../style/css/bower_components/morris.js/morris.min.js"></script>
<script src="../style/css/bower_components/jquery-sparkline/dist/jquery.sparkline.min.js"></script>
<script src="../style/css/plugins/jvectormap/jquery-jvectormap-1.2.2.min.js"></script>
<script src="../style/css/plugins/jvectormap/jquery-jvectormap-world-mill-en.js"></script>
<script src="../style/css/bower_components/jquery-knob/dist/jquery.knob.min.js"></script>
<script src="../style/css/bower_components/moment/min/moment.min.js"></script>
<script src="../style/css/bower_components/bootstrap-daterangepicker/daterangepicker.js"></script>
<script src="../style/css/bower_components/bootstrap-datepicker/dist/js/bootstrap-datepicker.min.js"></script>
<script src="../style/css/plugins/bootstrap-wysihtml5/bootstrap3-wysihtml5.all.min.js"></script>
<script src="../style/css/bower_components/jquery-slimscroll/jquery.slimscroll.min.js"></script>
<script src="../style/css/bower_components/fastclick/lib/fastclick.js"></script>
<script src="../style/css/dist/js/adminlte.min.js"></script>
<script src="../style/css/dist/js/pages/dashboard.js"></script>
<script src="../style/css/dist/js/demo.js"></script>
</body>
</html>
