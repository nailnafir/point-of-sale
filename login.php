<?php
session_start();
// $koneksi = mysqli_connect("localhost","root","","db_pos");
include 'koneksi.php';
?>
<!DOCTYPE html>
<html lang="en">

<head>

    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="description" content="">
    <meta name="author" content="">

    <title>Login - Point Of Sale</title>

    <!-- Bootstrap Core CSS -->
    <link href="asset/bootstrap/css/bootstrap.min.css" rel="stylesheet">

    <!-- MetisMenu CSS -->
    <link href="asset/metisMenu/metisMenu.min.css" rel="stylesheet">

    <!-- Custom CSS -->
    <link href="asset/dist/css/sb-admin-2.css" rel="stylesheet">

    <!-- Custom Fonts -->
    <link href="asset/font-awesome/css/font-awesome.min.css" rel="stylesheet" type="text/css">

    <!-- HTML5 Shim and Respond.js IE8 support of HTML5 elements and media queries -->
    <!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
    <!--[if lt IE 9]>
        <script src="https://oss.maxcdn.com/libs/html5shiv/3.7.0/html5shiv.js"></script>
        <script src="https://oss.maxcdn.com/libs/respond.js/1.4.2/respond.min.js"></script>
    <![endif]-->

</head>

<body>

    <div class="container">
        <div class="row">
            <div class="col-md-4 col-md-offset-4">
                <div class="login-panel panel panel-default">
                    <div class="panel-heading text-center">
                        <h3 class="panel-title"><i><img src="asset/icon/cashier-machine.png" alt=""></i><br> Please Sign In</h3>
                    </div>
                    <div class="panel-body">
                        <form method="post" id="login">
                            <fieldset>
                                <div class="form-group">
                                    <input class="form-control" placeholder="Username" name="username" type="username" autofocus>
                                </div>
                                <div class="form-group">
                                    <input class="form-control" placeholder="Password" name="password" type="password" value="">
                                </div>
                                <!-- Change this to a button or input when using this as a form -->
                                <input type="submit" name="login" value="Login" class="btn btn-lg btn-success btn-block">
                            </fieldset>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- jQuery -->
    <script src="asset/jquery/jquery.min.js"></script>

    <!-- Bootstrap Core JavaScript -->
    <script src="asset/bootstrap/js/bootstrap.min.js"></script>

    <!-- Metis Menu Plugin JavaScript -->
    <script src="asset/metisMenu/metisMenu.min.js"></script>

    <!-- Custom Theme JavaScript -->
    <script src="asset/dist/js/sb-admin-2.js"></script>

    <script src="asset/jquery/jquery.validate.min.js"></script>
    <script src="asset/jquery/additional-methods.min.js"></script>
    
    <script src="asset/js/main.js"></script>

</body>

</html>
<?php
if(isset($_POST['login'])) {
    $username = $_POST['username'];
    // $password = sha1(md5($_POST['password']));
    // admin e99c9f59aba831a3e5d010836f94fbf76b81a065
    $password = md5($_POST['password']);

    $query = mysqli_query($koneksi, "SELECT * FROM tb_admin WHERE username = '$username' AND password = '$password'");
    $data = mysqli_fetch_array($query);
    if(mysqli_num_rows($query) >= 1) {
        $_SESSION['username'] = $data['username'];
        $_SESSION['id_karyawan'] = $data['id_karyawan'];

        echo "<script>alert('Berhasil Login');</script>";
        echo "<meta http-equiv='refresh' content='1;url=index.php' >";
    } else {
        echo "<script>alert('Gagal Login');</script>";
        echo "<meta http-equiv='refresh' content='1;url=login.php' >";
    }
}
?>