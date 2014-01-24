<?php
class TranslateMe {
	private $apiKey = '';
	private $apiURL = 'https://api.datamarket.azure.com/Data.ashx/Bing/MicrosoftTranslator/v1/';
	public $treatedURL = '';
	public $response = '';
	public $status = '';
	public $error = '';
	public $oldText = '';
	public $newText = '';
	public $curlError = '';
	
	public function __construct($apiKey) {
		$this->apiKey = $apiKey;
	}
	private function createUrl($input, $to, $from, $type) {
		$text = (!empty($input)) ? 'Text='.urlencode("'".$input."'") : '';
		$to = (!empty($to)) ? $to = '&To='. urlencode("'".$to."'") : '';
		$from = (!empty($from)) ? '&From='. urlencode("'".$from."'") : '';
		$format = '$format=json';
		$top = '$top=100';
		$params = $text . $from . $to .'&'. $format .'&'. $top ;
		if($type == 'Translate' ) {
			$this->treatedURL = $this->apiURL. $type.'?'. $params;
		} elseif ($type == 'GetLanguagesForTranslation' ){
			$this->treatedURL = $this->apiURL. $type.'?'. $top.'&'. $format;
		}    
		return true;
	}
	private function processTranslation() {
		$init = curl_init();
		curl_setopt($init, CURLOPT_RETURNTRANSFER, 1);
		curl_setopt($init, CURLOPT_SSL_VERIFYPEER, false);
		curl_setopt($init, CURLOPT_HTTPHEADER, array(
		"Authorization: Basic " . base64_encode($this->apiKey . ":" . $this->apiKey)
		));
		curl_setopt($init, CURLOPT_URL, $this->treatedURL);
		curl_setopt($init, CURLOPT_FOLLOWLOCATION, true);
		$data = curl_exec($init);
		if(curl_errno($init)) {
		   $this->curlError = curl_error($init);
		}
		curl_close($init);
		return $data;
	}
	public function translate($text, $to, $from="en", $type="Translate") {
		$this->oldText = $text;
		$this->status = $this->createURL($this->oldText, $to, $from, $type);
		$this->response = $this->processTranslation();
		$data = json_decode($this->response, true);
	    $this->newText = $data['d']['results'][0]['Text'];
		empty($data);
		//return $this->newText;
		return $this->newText;
	}
}
class Translator {

    private $language	= 'en';
	private $lang 		= array();
	
	public function __construct($language){
		$this->language = $language;
	}
	
    private function findString($str) {
        if (array_key_exists($str, $this->lang[$this->language])) {
			echo $this->lang[$this->language][$str];
			return;
        }
        echo $str;
    }
    
	private function splitStrings($str) {
        return explode('==',trim($str));
    }
	
	public function __($str) {	
        if (!array_key_exists($this->language, $this->lang)) {
            if (file_exists('languages/'.$this->language.'.txt')) {
                $strings = array_map(array($this,'splitStrings'),file('languages/'.$this->language.'.txt'));
                foreach ($strings as $k => $v) {
					$this->lang[$this->language][$v[0]] = $v[1];
                }
                return $this->findString($str);
            }
            else {
                echo $str;
            }
        }
        else {
            return $this->findString($str);
        }
    }
}
?>