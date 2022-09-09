<html>

<head>

  <title>DO-NOT-HONOR</title>
  <link href="style.css" rel="stylesheet" id="bootstrap-css">
  <meta http-equiv="X-UA-Compatible" content="IE=edge" />
  <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no" />
  <link rel="stylesheet" href="hyper.min.css?v=2.3">
  <link
    rel="stylesheet"
    href="https://cdnjs.cloudflare.com/ajax/libs/animate.css/4.1.1/animate.min.css"
  />
  <style>
  nav.navbar.navbar-expand-lg.navbar-light.bg-light {
    padding: 1px;
    background: transparent !important;
    box-shadow: none;
}
  select#curr {
    padding: 9px;
    font-family: var(--hyper-font)!important;
    border: none;
    font-weight: 400;
    -webkit-text-fill-color: #d5ddd5;
    background: #18191e!important;
    box-shadow: 0 1px 2px #0000005c;
    border-bottom: solid 1px;
  }
  textarea#lista {
    margin-top: 15px;
    font-family: "Bebas Neue";
    background: #1a1b20!important;
  }
  .logo_large_med {
    text-transform: uppercase;
    font-size: 13px;
    letter-spacing: 2px;
    font-family: monospace;
    background: linear-gradient(45deg,#12ff00,#28a743);
  }
  input.form-control.hyper_input {
    font-family: var(--hyper-font)!important;
    border: none;
    padding-bottom: 4px;
    font-weight: 400;
    -webkit-text-fill-color: #d5ddd5;
    background: #1d1e24!important;
    box-shadow: 0 1px 2px #0000005c;
    border-bottom: solid 1px;
    border-image: linear-gradient(45deg,#12ff00,#28a743) 1;
}
nav.navbar.navbar-expand-lg.navbar-light.bg-light {
    padding: 1px;
    background: #18191e!important;
    box-shadow: none;
}
textarea#lista {
    margin-top: 15px;
    font-family: "Bebas Neue";
    background: #1d1e24!important;
    border-bottom: solid 1px!important;
    border: none;
    border-radius: 0;
    color: #fff!important;
    -webkit-text-fill-color: #fff;
    box-shadow: 0 1px 2px #0000005c;
    border-image: linear-gradient(45deg,#12ff00,#28a743) 1;}
  a.nav-link.addbot {
    color: #f35205!important;
    background: transparent;
    padding: 3px 0 0;
    border: none;
    border-radius: 1px;
    margin-top: 5px;
}
  .card-body.cvv.form-login {
    margin-top: 0;
    background: #18191e!important;
    padding: 0 19px;
  }
  
  button#mostra4,button#mostra,button#mostra3,button#mostra2 {
    font-size: 17px;
    margin: 17px 40px;
  }
      .card-body {
    -ms-flex: 1 1 auto;
    background-color: #1c1e24!important;
    flex: 1 1 auto;
    padding: 1.25rem;
    border-top: none;
    border-image: linear-gradient(80deg,#4b00ff,#ef1450) 1;
    box-shadow: 0 1px 3px #00000040;
}
.logo_large_med{
    margin-top:20px;
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
  ?>
</head>

<body class="hyper_container">
<div class="gline"></div>
  <div class="okay">
  
    <center>
     
          <div class="logo_large_med"></div>
       
    </center>
    
   
    <center>
      <div class="container">
        <div class="row">
          <div class="card col-md-12">

            <div class="card-body cvv mchk form-login">
              <div class="md-form">
                <div class="col-md-12">
                  <center>
                    <div class="md-form" id="tbar">
                      <span>CVV</span>&nbsp<span id="cLive" class="badge badge-success">0 </span>

                      <span>Checked</span>&nbsp<span id="total" class="badge badge-info">0 </span>
                      <span>Total</span>&nbsp<span id="carregadas" class="badge badge-dark">0 </span>
                    </div><br>
                    <textarea type="text"  placeholder="Drop Cards Here" id="lista" class="md-textarea form-control" rows="4"></textarea>
                  </center>
                  &nbsp;
                  <br>
                  <center>
                    
                    <div class="form-row">
                      
                      <div class="form-group col-md-12" id="skCon">
                        <input type="text" class="form-control hyper_input" placeholder="Enter Live SK KEY" id="skkey" required />
                      </div>
                      <div class="form-group col-md-6" id="curCon">
                        <select name="curr" id="curr" class="form-control hyper_input">
                          <option value="curr">Currency</option>
                          <option value="inr">Indian</option>
                          <option value="usd">US Dollar</option>
                          <option value="eur">European</option>
                        </select>
                      </div>

                      <div class="form-group col-md-6">
                        <input type="number" class="form-control hyper_input" placeholder="Amount" id="amount" required />
                      </div>
                      
                      <div class="form-group col-md-6">
                        <input type="number" class="form-control hyper_input" placeholder="Telegram Id" id="teleid" required />
                      </div>
                    </div>

                    <button class="btn btn-success hyperbtn" id="testar" onclick="start_hyper()"><b>Start Check</b></button>
                  </center>
                </div>
              </div>
    </center>
  </div>
  <br>
  <div class="container">
    <div class="col-md-12">
      <div class="card wd">
        <div class="pos1">
          <button id="mostra4" class="btn btn-success">Show</button><br>
        </div>
        <div class="pos2">
        </div>
        <div class="card-body cvv">
          <h6 class="card-title">Hits - <span id="cLive3" class="badge badge-success">0</span></h6>
          <div id="bode4"><span id=".charged" class="charged"></span>
          </div>
        </div>
      </div>
    </div>
    &nbsp;&nbsp;&nbsp;</br>
    <div class="col-md-12">
      <div class="card wd">
        <div class="pos3">
          <button id="mostra" class="btn btn-success">Show</button><br>
        </div>
        <div class="pos4">
        </div>
        <div class="card-body cvv">
          <h6 class="card-title">cvv - <span id="cLive2" class="badge badge-success">0</span></h6>
          <div id="bode"><span id=".aprovadas" class="aprovadas"></span>
          </div>
        </div>
      </div>
    </div>
    &nbsp;&nbsp;&nbsp;</br>

    <div class="col-md-12">
      <div class="card wd">
        <div class="pos5">
          <button id="mostra3" class="btn btn-warning">Show</button><br>
        </div>
        <div class="pos6">
        </div>
        <div class="card-body ccn">
          <h6 class="card-title">ccn - <span id="cWarn2" class="badge badge-warning">0</span></h6>
          <div id="bode3"><span id=".edrovadas" class="edrovadas"></span>
          </div>
        </div>
      </div>
    </div>
    &nbsp;&nbsp;&nbsp;</br>

    <div class="col-md-12">
      <div class="card wd hyper_dead">
        <div class="pos5">
          <button id="mostra2" class="btn btn-danger">Show</button><br>
        </div>
        <div class="pos6">
        </div>
        <div class="card-body hyper_dead">

          <h6 class="card-title">ded - <span id="cDie2" class="badge badge-danger">0</span></h6>
          <div id="bode2"><span id=".reprovadas" class="reprovadas"></span>
          </div>
        </div>
      </div>
    </div>
  </div>
  </div>
  </div>
  </div>
  <br>

  </center>

  <center>
    <p class="hyper_credit">CHECKER BY <a href="https://t.me/hyperxd" class="link">TEAM HYPER</a></p>
  </center>
  </div>


  <script src="./script.js"></script>
  <script src="https://code.jquery.com/jquery-3.6.0.min.js" type="text/javascript"></script>
  <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.3/umd/popper.min.js"></script>
  <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.1.3/js/bootstrap.min.js"></script>
  <script src="./tata.js"></script>
  <script src="./hyper.min.js?v=2.5"></script>



  <footer>


  </footer>
</body>

</html>