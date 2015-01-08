<?php

class HeyWatch {

  const HEYWATCH_URL = "https://heywatch.com";
  const USER_AGENT = "HeyWatch/2.0.0 (PHP)";

  public static function submit($config_content, $api_key=null) {
    $heywatch_url = self::HEYWATCH_URL;

    if(!$api_key) {
      $api_key = getenv("HEYWATCH_API_KEY");
    }

    if($url = getenv("HEYWATCH_URL"))
      $heywatch_url = $url;

    $ch = curl_init();
    curl_setopt($ch, CURLOPT_URL, $heywatch_url . "/api/v1/job");
    curl_setopt($ch, CURLOPT_USERPWD, $api_key . ":");
    curl_setopt($ch, CURLOPT_POST, 1);
    curl_setopt($ch, CURLOPT_POSTFIELDS, $config_content);
    curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
    curl_setopt($ch, CURLOPT_USERAGENT, self::USER_AGENT);
    curl_setopt($ch, CURLOPT_HTTPHEADER, array(
      'Content-Length: ' . strlen($config_content),
      'Content-Type: text/plain',
      'Accept: application/json')
    );

    $result = curl_exec($ch);
    return json_decode($result);
  }
}

?>