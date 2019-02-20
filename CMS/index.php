<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <title>Administrador Global Pack</title>
    <!-- Tell the browser to be responsive to screen width -->
    <meta content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no" name="viewport">
    <!-- Bootstrap 3.3.7 -->
    <link rel="stylesheet" href="/cms/css/bootstrap.min.css">
    <!-- Font Awesome -->
    <link rel="stylesheet" href="/cms/vendor/components/font-awesome/css/fontawesome-all.min.css">

    <link rel="stylesheet" href="/cms/css/login.min.css">
    <!-- HTML5 Shim and Respond.js IE8 support of HTML5 elements and media queries -->
    <!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
    <!--[if lt IE 9]>
    <script src="https://oss.maxcdn.com/html5shiv/3.7.3/html5shiv.min.js"></script>
    <script src="https://oss.maxcdn.com/respond/1.4.2/respond.min.js"></script>
    <![endif]-->
    <!-- Google Font -->
    <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,600,700,300italic,400italic,600italic">
</head>
<body class="hold-transition login-page">
    
    <div class="container">
        <div class="login-box">
            <div class="login-logo">
                <a href="/cms"><img src="/cms/img/logo.png" style="width:200px;" /></a>
            </div>
            <!-- /.login-logo -->
            <div class="login-box-body">
                <p class="login-box-msg">Inserta tu usuario y contraseña para acceder.</p>

                <form id="acceso">
                    <div class="form-group has-feedback">
                        <input type="text" class="form-control" placeholder="Email" name="adminuser">
                        <span class="glyphicon glyphicon-envelope form-control-feedback"></span>
                    </div>
                    <div class="form-group has-feedback">
                        <input type="password" class="form-control" placeholder="Password" name="adminpass">
                        <span class="glyphicon glyphicon-lock form-control-feedback"></span>
                    </div>
                    
                        <!-- /.col -->
                        <div class="col-lg-12 text-center">
                            <button type="submit" class="btn btn-cms" onclick="LoginAdmin();">Acceder</button>
                        </div>
                        <!-- /.col -->
                    
                </form>
            </div>
            <!-- /.login-box-body -->
        </div>
    </div>
<!-- /.login-box -->

<!-- jQuery 3 -->
<script src="/cms/js/jquery-3.3.1.min.js"></script>
<!-- Bootstrap 3.3.7 -->
<script src="/cms/js/bootstrap.min.js"></script>

<script>
  
    function LoginAdmin() {
        var login = {};
        $('#acceso').serializeArray().map(function (x) { login[x.name] = x.value; });
        $.ajax({
            url: '/api/interfaces/admin/Ilogin.php?fun=LoginCMS',
            type: "POST",
            data: JSON.stringify(login),
            cache: false,
            dataType: "json",
            contentType: "application/json; charset=utf-8",
            beforeSend: function () {
                
            },
            success: function (data) {
                
                if (data.status) {
                    window.location.replace("/cms/principal.php");
                } else {
                    window.location.replace("/cms/index.php");
                }
            },
            error: function (request, status, error) {
                window.location.replace("/cms/index.php");
            }
        })
    }
</script>
</body>
</html>
