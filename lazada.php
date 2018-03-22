<?php
$content = "";
$curl = curl_init();

curl_setopt_array($curl, array(
  CURLOPT_URL => "https://www.lazada.vn/chan-vay/?q=Chan+Vay+Ngan&from=hp_mostpopular",
  CURLOPT_RETURNTRANSFER => true,
  CURLOPT_ENCODING => "",
  CURLOPT_MAXREDIRS => 10,
  CURLOPT_TIMEOUT => 30,
  CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
  CURLOPT_CUSTOMREQUEST => "GET",
  CURLOPT_HTTPHEADER => array(
    "Cache-Control: no-cache"
  ),
));

$response = curl_exec($curl);
$err = curl_error($curl);

curl_close($curl);

if ($err) {
  echo "cURL Error #:" . $err;
} else {
  //echo $response;
}


//$content = file_get_contents('lazada.txt');
$content = $response;

preg_match("#<script>window.pageData=(.*)</script>#", $content, $match);

$data = [];
if($match && isset($match[1])){
  $data = json_decode($match[1] , true);
}

echo "<pre>";
print_r($data);
