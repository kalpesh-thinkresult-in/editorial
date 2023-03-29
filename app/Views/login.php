<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Editorial | Log in (v2)</title>

    <!-- Google Font: Source Sans Pro -->
    <link rel="stylesheet"
        href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,400i,700&display=fallback">
    <!-- Font Awesome -->
    <link rel="stylesheet" href="<?= base_url() ?>assets/adminlte/plugins/fontawesome-free/css/all.min.css">
    <!-- icheck bootstrap -->
    <link rel="stylesheet" href="<?= base_url() ?>assets/adminlte/plugins/icheck-bootstrap/icheck-bootstrap.min.css">
    <!-- Theme style -->
    <link rel="stylesheet" href="<?= base_url() ?>assets/adminlte/dist/css/adminlte.min.css">
</head>

<body class="hold-transition login-page">
    <div class="login-box">
        <!-- /.login-logo -->
        <div class="card card-outline card-primary">
            <div class="card-header text-center">
                <a href="<?= base_url() ?>assets/adminlte/index2.html" class="h1"><b>Edito</b>rial</a>
            </div>
            <div class="card-body">
                <p class="login-box-msg">Sign in to start your session</p>
                <div class="tokend">
                    <form action="" method="post">
                        <div class="input-group mb-3">
                            <input type="email" class="form-control text-input1" placeholder="Email">
                            <div class="input-group-append">
                                <div class="input-group-text">
                                    <span class="fas fa-envelope"></span>
                                </div>
                            </div>
                        </div>
                        <div class="input-group mb-3">
                            <input type="password" class="form-control text-input2" placeholder="Password">
                            <div class="input-group-append">
                                <div class="input-group-text">
                                    <span class="fas fa-lock"></span>
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-8">
                                <span class="text-danger error">Invalid Credentials !!!</span>
                            </div>
                            <!-- /.col -->
                            <div class="col-4">
                                <button type="button" class="btn btn-primary btn-block btn-blue">Sign In</button>
                            </div>
                            <!-- /.col -->
                        </div>
                    </form>
                    <p class="mb-1">
                        <a href="forgot-password.html">I forgot my password</a>
                    </p>
                    <p class="mb-0">
                        <a href="register.html" class="text-center">Register a new membership</a>
                    </p>
                </div>
                <div class="tokend-t text-center">
                    <div class="spinner-border" role="status"></div>
                </div>
            </div>
            <!-- /.card-body -->
        </div>
        <!-- /.card -->
    </div>
    <!-- /.login-box -->

    <!-- jQuery -->
    <script src="<?= base_url() ?>assets/adminlte/plugins/jquery/jquery.min.js"></script>
    <!-- Bootstrap 4 -->
    <script src="<?= base_url() ?>assets/adminlte/plugins/bootstrap/js/bootstrap.bundle.min.js"></script>
    <!-- AdminLTE App -->
    <script src="<?= base_url() ?>assets/adminlte/dist/js/adminlte.min.js"></script>
    <script>
        $(document).ready(function () {
            $(".text-input1").focus();
            $(".tokend-t").hide();
            $(".error").hide();

            $(".btn-blue").click(function () {
                if ($(".text-input1").val() == "") {
                    alert("Enter email");
                    return false;
                }
                if ($(".text-input2").val() == "") {
                    alert("Enter password");
                    return false;
                }
                var dataobj = {
                    email: $(".text-input1").val(),
                    pwd: $(".text-input2").val()
                };
                $(".tokend").hide();
                $(".tokend-t").show();
                $(".error").hide();
                $.post("<?= base_url() ?>login/authuser", dataobj, function (data, status) {
                    if (data == "true") {
                        window.location = "<?= base_url() ?>dashboard";
                    }
                    else {
                        $(".error").show();
                        $(".tokend").show();
                        $(".tokend-t").hide();
                    }
                });
            });

            $('.text-input2').keypress(function (e) {
                if (e.which == 13) {
                    jQuery(this).blur();
                    jQuery('.btn-blue').focus().click();
                }
            });
        });

    </script>
</body>

</html>