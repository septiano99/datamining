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
                                    <form action="../controller/logout.php" method="get">
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
                <li><a href="dataset.php?nip=<?php echo $_GET['nip']; ?>"><i class="pull-right-container"></i>Dataset</a></li>
                <li><a href="testing.php?nip=<?php echo $_GET['nip']; ?>"><i class="pull-right-container"></i>Data Tesing</a></li>
                <li><a href="result.php?nip=<?php echo $_GET['nip']; ?>"><i class="pull-right-container"></i>Result</a></li>
            </ul>
        </section>
    </aside>

    <div class="content-wrapper">
        <section class="content-header">
            <h1>
                Insert Data Testing
            </h1>
        </section>
        <section class="content">
            <form method="post" enctype="multipart/form-data" action="../controller/readtesting.php?nip=<?php echo $_GET['nip']; ?>">
                Pilih File Testing:
                <br/>
                <input name="file" type="file" required="required" accept=".xls,.xlsx">
                <br/><br/>
                <input name="upload" type="submit" value="Import">
            </form>
            <br/>
            <h1>
                DATA TESTING
            </h1>
            <div style="overflow-x:auto;">
                <table border="1">
                    <tr>
                        <th>No CIF</th>
                        <th>Tanggal Lahir</th>
                        <th>Jenis Kelamin</th>
                        <th>Tgl Buka</th>
                        <th>Tgl Jatuh Tempo </th>
                        <th>Jangka Waktu/Bulan</th>
                        <th>Plafon</th>
                        <th>XAngsuran</th>
                        <th>Angsuran Ke</th>
                        <th>Angsur PK</th>
                        <th>Angsur BNG</th>
                        <th>Tunggak Pokok</th>
                        <th>Tunggak Bunga</th>
                        <th>Tgl Tunggak Pokok</th>
                        <th>Tgl Tunggak Bunga</th>
                        <th>XTGKP</th>
                        <th>XTGKB</th>
                        <th>HR_TGKP</th>
                        <th>HT_TGKB</th>
                        <th>Kredit Ke</th>
                        <th>Jenis Jam</th>
                        <th>Nilai Agunan</th>
                    </tr>
                    <?php
                    include '../controller/connection.php';

                    $sql = "SELECT * FROM t_testing";
                    $result = pg_query($sql);
                    while ($row = pg_fetch_row($result)) {

                        ?>
                        <tr>
                            <td><?php echo $row[1]; ?></td>
                            <td><?php echo $row[2]; ?></td>
                            <td><?php echo $row[3]; ?></td>
                            <td><?php echo $row[4]; ?></td>
                            <td><?php echo $row[5]; ?></td>
                            <td><?php echo $row[6]; ?></td>
                            <td><?php echo $row[7]; ?></td>
                            <td><?php echo $row[8]; ?></td>
                            <td><?php echo $row[9]; ?></td>
                            <td><?php echo $row[10]; ?></td>
                            <td><?php echo $row[11]; ?></td>
                            <td><?php echo $row[12]; ?></td>
                            <td><?php echo $row[13]; ?></td>
                            <td><?php echo $row[14]; ?></td>
                            <td><?php echo $row[15]; ?></td>
                            <td><?php echo $row[16]; ?></td>
                            <td><?php echo $row[17]; ?></td>
                            <td><?php echo $row[18]; ?></td>
                            <td><?php echo $row[19]; ?></td>
                            <td><?php echo $row[20]; ?></td>
                            <td><?php echo $row[21]; ?></td>
                            <td><?php echo $row[22]; ?></td>
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
