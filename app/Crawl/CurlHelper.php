<?php 
namespace App\Crawl;
use ModuleCrawler\Helper\Curl;
class CurlHelper
{
	const HEADERS = array(
	    "Accept: */*",
	    "Cache-Control: no-cache",
	    "Connection: keep-alive",
	    "User-Agent: Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/76.0.3809.132 Safari/537.36",
	    "cache-control: no-cache",
	    "Content-Type: application/x-www-form-urlencoded; charset=shift_jis"
	);
    public function exeCurl($url, $type = 'GET', $data = null, $headers = []){
		$curl = curl_init();
		$params = array(
			CURLOPT_URL => $url,
			CURLOPT_RETURNTRANSFER => true,
			CURLOPT_ENCODING => "",
			CURLOPT_MAXREDIRS => 10,
			CURLOPT_TIMEOUT => 15,
			CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
			CURLOPT_CUSTOMREQUEST => $type,
			CURLOPT_FOLLOWLOCATION => true,
			CURLOPT_SSL_VERIFYHOST => 0,
			CURLOPT_SSL_VERIFYPEER => 0
		);
		if ($type == 'POST' && is_string($data)) {
			$params[CURLOPT_POSTFIELDS] = $data;
		}
		if($type == 'POST' && is_array($data)){
			// $params[CURLOPT_POSTFIELDS] = 'data[User][username]=admin1&data[User][password]=phuongdong@@';
			$params[CURLOPT_POSTFIELDS] = http_build_query($data);
		}
		if ($type == 'GET' && is_array($data)) {
			$params[CURLOPT_URL] = $url.'?'.http_build_query($data);
		}
		if(is_array($headers) && count($headers) == 0){
			$headers = $this::HEADERS;
		}
		curl_setopt ($curl, CURLOPT_COOKIEJAR, 'ck.txt'); 
		curl_setopt ($curl, CURLOPT_COOKIEFILE, 'ck.txt'); 
		$params[CURLOPT_HTTPHEADER] = $headers;
		curl_setopt_array($curl, $params);
		$res = curl_exec($curl); 
		$status = curl_getinfo($curl, CURLINFO_HTTP_CODE); 
		$err = curl_error($curl); 
		curl_close($curl);
		if ($err) { 
			return ['status' => $status, 'err' => $err];
		} else {
			return ['status' => $status, 'res' => $res];
		}
	}
}