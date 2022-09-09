<html>

<head>

  <title>Login</title>
  <link href="style.css" rel="stylesheet" id="bootstrap-css">
  <meta http-equiv="X-UA-Compatible" content="IE=edge" />
  <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no" />
  <link rel="stylesheet" href="hyper.min.css?v=2.3">
  <style>
    .okay {
      height: 90vh;
    }
  </style>
  <?php
  $config = array("password" => "do-not-honor");
  function gentok($length = 10)
  {
    $characters = '0123456789abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ';
    $charactersLength = strlen($characters);
    $randomString = '';
    for ($i = 0; $i < $length; $i++) {
      $randomString .= $characters[rand(0, $charactersLength - 1)];
    }
    return $randomString;
  }
  session_start();
  $userLogged = false;
  if (isset($_SESSION['password'])) {
    $userLogged = true;
  }
  if ($userLogged === true) {
    return header("location: ./checker?userLogged=true");
  }
  if (isset($_POST['lgbtn'])) {
    $password = $_POST['password'];

    if ($password === $config['password']) {
      $_SESSION['password'] = $config['password'];
      return header("location: ./checker?userLogged=true");
    } else {
      return header("location: ./?userLogged=false&__authentication=failed&incorrect=true");
    }
  }
  ?>
</head>

<body class="hyper_container">

  <div class="okay">
    <nav class="navbar navbar-expand-lg fixed-top navbar-light bg-light">
      <div class="container-fluid">
        <a class="navbar-brand" href="#">
          <div class="logo_large_med"></div>
        </a>
        <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
          <span class="navbar-toggler-icon"></span>
        </button>

        <div class="collapse navbar-collapse" id="navbarSupportedContent">
          <ul class="navbar-nav ml-auto">
            <li class="nav-item active">
              <a class="nav-link" href="#">Home <span class="sr-only">(current)</span></a>
            </li>
            <li class="nav-item">
              <a class="nav-link" href="./checker?page=current">Checker</a>
            </li>
            <li class="nav-item">
              <a class="nav-link" href="./settings?utm_source=index">Manage</a>
            </li>
            <li class="nav-item">
              <a class="nav-link addbot" target="_blank" href="https://t.me/hyperxd">Join</a>
            </li>

          </ul>

        </div>
      </div>
    </nav>

    <br>
    <center>
      <div class="container">
        <div class="row">
          <div class="card col-md-12">
            <br>
            <br>
            <br>
            <br>
            <br>
            <br>
            <br>
            
            <div class="card-body loginf cvv form-login">
              <div class="md-form">
                <div class="col-md-12">
                <?php if (isset($_GET['incorrect'])) {
                    if ($_GET['incorrect'] === "true") {
                      echo "<center class='text-muted wrn_txt'>Incorrect login</center>";
                    } else if ($_GET['message'] === "banned_aacount") {
                      echo "<center class='text-muted wrn_txt'> Looks like account got banned!</center>";
                    }
                  } ?>
                  <br>

                  <center>

                    <div class="form-row">
<form action="" method="post">
                      <div class="form-group col-md-12">
                        <input type="text" class="form-control hyper_input" name="password" placeholder="Enter Password" id="passid" required />
                      </div>

                    </div>


                    <button class="btn btn-success hyperbtn" name="lgbtn" id="passbtn"><b>Grant Access</b></button>
                    </form>
                    <br>

                  </center>

                </div>
              </div>
    </center>
  </div>

  </div>
  </div>
  </div>
  <br>

  </center>

  <center>
    <p class="hyper_credit">Built v<a href="https://t.me/hyperxd" class="link">1.1.0b</a></p>
  </center>
  </div>


  <script src="./script.js"></script>
  <script src="https://code.jquery.com/jquery-3.6.0.min.js" type="text/javascript"></script>
  <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.3/umd/popper.min.js"></script>
  <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.1.3/js/bootstrap.min.js"></script>
  <script src="./tata.js"></script>



  <footer>


  </footer>
</body>

</html>