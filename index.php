<html>
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <title>DATA MINING | Admin</title>
    <meta content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no" name="viewport">
    <!-- Bootstrap 3.3.7 -->
    <link rel="stylesheet" href="style/css/bower_components/bootstrap/dist/css/bootstrap.min.css">
    <link rel="stylesheet" href="style/css/bower_components/font-awesome/css/font-awesome.min.css">
    <link rel="stylesheet" href="style/css/bower_components/Ionicons/css/ionicons.min.css">
    <link rel="stylesheet" href="style/css/dist/css/AdminLTE.min.css">
    <link rel="stylesheet" href="style/css/plugins/iCheck/square/blue.css">
    <script src="https://oss.maxcdn.com/html5shiv/3.7.3/html5shiv.min.js"></script>
    <script src="https://oss.maxcdn.com/respond/1.4.2/respond.min.js"></script>
    <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,600,700,300italic,400italic,600italic">
</head>
<style>
    #grad1 {
        height: 200px;
        background-color: blue; /* For browsers that do not support gradients */
        background-image: linear-gradient(#2BC0E4, #EAECC6); /* Standard syntax (must be last) */
    }
</style>
<body class="hold-transition login-page" id ="grad1">
<form action="controller/Login.php" method="post" onSubmit="return validasi()">
    <div class="login-box">
        <div class="login-logo">
            <b>DATA MINING</b>SYSTEM
        </div>

        <div class="login-box-body">
            <p class="login-box-msg">Login</p>
            <div class="form-group has-feedback">
                <input type="text" class="form-control" placeholder="NIP" name="nip" id="nip">
                <span class="glyphicon glyphicon-envelope form-control-feedback"></span>
            </div>
            <div class="form-group has-feedback">
                <input type="password" class="form-control" placeholder="Password" name="password" id="password">
                <span class="glyphicon glyphicon-lock form-control-feedback"></span>
            </div>
            <div class="row">
                <div class="col-xs-12">
                    <button type="submit" class="btn btn-primary btn-block btn-flat">Sign In</button>
                </div>
            </div>
            <br/>
        </div>
    </div>
</form>

<script type="text/javascript">
    function validasi() {
        var username = document.getElementById("nip").value;
        var password = document.getElementById("password").value;
        if (username != "" && password!="") {
            return true;
        }else{
            alert('NIP dan Password harus di isi !');
            return false;
        }
    }
</script>
<script src="style/css/bower_components/jquery/dist/jquery.min.js"></script>
<script src="style/css/bower_components/bootstrap/dist/js/bootstrap.min.js"></script>
<script src="style/css/plugins/iCheck/icheck.min.js"></script>
<script>
    $(function () {
        $('input').iCheck({
            checkboxClass: 'icheckbox_square-blue',
            radioClass: 'iradio_square-blue',
            increaseArea: '20%' /* optional */
        });
    });
</script>
</body>
</html>
