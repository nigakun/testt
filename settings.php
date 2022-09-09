<html>

<head>

  <title>Settings</title>
  <link href="style.css" rel="stylesheet" id="bootstrap-css">
  <meta http-equiv="X-UA-Compatible" content="IE=edge" />
  <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no" />
  <link rel="stylesheet" href="hyper.min.css?v=1.9">
  <style>
    .okay {
      height: 90vh;
    }
  </style>
  <?php
  session_start();
  $userLogged = false;
  if (isset($_SESSION['password'])) {
    $userLogged = true;
  }
  if ($userLogged !== true) {
    return header("location: ./?userLogged=false&__authentication=required");
  }
  $tg_btn_text = "Connect Now";
  $tg_nav_text = "Connect";
  $is_added = false;
  $is_ccs = "";
  if (isset($_SESSION['tgid'])) {
    $tg_btn_text = "Disconnect";
    $tg_nav_text = "Connected";
    $is_added = true;
    $is_ccs = "added";
  }
  if (isset($_POST['connid'])) {
    $_SESSION['tgid'] = $_POST['tgid'];
    return header("location: ./connect?is_webhook_added=true&message=connected");
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
              <a class="nav-link" href="./settings?page=current">Manage</a>
            </li>
            <li class="nav-item">
              <a class="nav-link addbot <?php echo $is_ccs; ?>" href="./connect?create_connection=true">
                <?php echo $tg_nav_text; ?>
              </a>
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
            
             
            <div class="card-body cvv form-login">
              <div class="md-form">
                <div class="col-md-12">
                  <div class="sheader">
                    <h4 class="title">Settings</h4>
                    <span>Manage app settings.</span>
                  </div>
                </div>
              </div>
            </div>

            <div class="card-body cvv form-login">
              <div class="md-form">
                <div class="col-md-12">




                  <center>
                    <?php if ($is_added === false) {  ?>
                      <form action="" method="post">
                        <div class="form-row">

                          <div class="form-group col-md-12">
                            <input type="number" class="form-control hyper_input" placeholder="Enter Telegram Id" name="tgid" id="tgid" required />
                          </div>


                          &nbsp;
                        </div>


                        <button class="btn btn-success hyperbtn" name="connid" id="passbtn"><b>Connect Now</b></button>
                      </form>
                    <?php } else { ?>
                      <div class="warner">
                        <h4>✅ Connected!</h4>
                        <span> Your telegram id has been connected. You can disconnect</span>
                        <br>
                        <button class="btn btn-success hyperbtn" id="disbtn"><b>Disconnect</b></button>
                        <br>
                      </div>
                      <br>
                      <div class="warner">
                        <h4>✅ Live!</h4>
                        <span> SK based gates has been updated.</span>
                        <br>
                        <button class="btn btn-success hyperbtn" id="disbtn"><b>Check Again</b></button>
                        <br>
                      </div>

                    <?php } ?>
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
  <script src="./hyper.js?v=1.6"></script>



  <footer>


  </footer>
</body>

</html>