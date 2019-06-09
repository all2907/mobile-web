<?php
session_start();
require_once '../koneksi.php';
$koneksi = new Koneksi();
$h = $koneksi->connect();
if (isset($_SESSION['admin'])){
	header("Location: index.php");
}
?>
<!doctype html>
<html lang="en">

<head>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <title>Login</title>
    <!-- Bootstrap CSS -->
    <link rel="stylesheet" href="../assets/vendor/bootstrap/css/bootstrap.min.css">
    <link href="../assets/vendor/fonts/circular-std/style.css" rel="stylesheet">
    <link rel="stylesheet" href="../css/concept/style.css">
    <link rel="stylesheet" href="../assets/vendor/fonts/fontawesome/css/fontawesome-all.css">
    <style>
    html,
    body {
        height: 100%;
    }

    body {
        display: -ms-flexbox;
        display: flex;
        -ms-flex-align: center;
        align-items: center;
        padding-top: 40px;
        padding-bottom: 40px;
    }
    </style>
</head>

<body>
    <!-- ============================================================== -->
    <!-- login page  -->
    <!-- ============================================================== -->
    <div class="splash-container">
        <div class="card ">
            <div class="card-header text-center"><span class="splash-description">LOGIN ADMIN</span></div>
            <div class="card-body">
                <form role="form" action="" method="post">
                    <div class="form-group">
                        <input name="username" required class="form-control form-control-lg" id="username" type="text" placeholder="Username" autocomplete="off">
                    </div>
                    <div class="form-group">
                        <input name="password" required class="form-control form-control-lg" id="password" type="password" placeholder="Password">
                    </div>
                    <button type="submit" class="btn btn-primary btn-lg btn-block">Sign in</button>
                </form>
            </div>
        </div>
    </div>

    <!-- ============================================================== -->
    <!-- end login page  -->
    <!-- ============================================================== -->
    <!-- Optional JavaScript -->
    <script src="../assets/vendor/jquery/jquery-3.3.1.min.js"></script>
    <script src="../assets/vendor/bootstrap/js/bootstrap.bundle.js"></script>
</body>
</html>

<?php
    if(isset($_POST['username'])){
      $uname = $_POST['username'];
      $mypassword = md5($_POST['password']);

      $hasil  =  mysqli_query($h, "SELECT * FROM admin WHERE username = '$uname'") or die('Could not look up user information; ' . mysqli_error($h));
      $data = mysqli_fetch_assoc($hasil);
      if ($uname=="" || $mypassword==""){
        echo "
        <script>
          window.alert('Username atau Password tidak boleh kosong');
          window.location='login.php'
        </script>
         ";
      }else if ($data['username'] == $uname){
        if ($data['password'] == $mypassword){
          $_SESSION['admin'] = $data['id_admin'];
          $_SESSION['nama'] = $data['nama'];
          echo "<meta http-equiv='refresh' content='0; url=index.php'>";
        }
        else{
          echo "
          <script>
            window.alert('Password salah');
            window.location='login.php'
          </script>
           ";
        }
      }else{
        echo "
        <script>
          window.alert('Anda tidak memiliki akses');
          window.location='login.php'
        </script>
         ";
      }
    }
 ?>
