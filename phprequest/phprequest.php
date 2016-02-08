<?php
class Request
{
  private $_options;

  /**
  * Créé une instance de Request, paramètres à passer sous forme d'un array ['key'=>'value'] ici $options[]
  * @param array<string> $options['header'] OPTIONNAL header http à inclure dans toutes les requetes
  * @param string|json $options['responseType'] OPTIONNAL encodage de la réponse attendu
  * @param string $options['baseUrl'] OPTIONNAL url de base de l'api relative à toutes les requetes
  * @return new Request
  */
  function __construct($options = [])
  {
    $this->_options['header'] = array_key_exists('header', $options) ? $options['header'] : [];
    $this->_options['responseType'] = array_key_exists('responseType', $options) ? $options['responseType'] : false;
    $this->_options['baseUrl'] = array_key_exists('baseUrl', $options) ? $options['baseUrl'] : "";
  }

  /**
  * PRIVATE création et execution d'une requete avec curl
  * @param string $url path url
  * @param string $method http method POST|GET|UPDATE|PATCH|DELETE
  * @param array[type<string>=>array[<key>=><value>]] $params OPTIONNAL data à envoyer, ex ['json'=>['key1'=>'value1', 'key2':'value2'...]]
  * @param array[type<string>=>array<mixed>] $option utilisé pour passer des options, actuellement il ni a que le header de personnalisable ici ex ['header'=>['header1', 'header2'...]]
  * @return array['statuscode'=>integer, 'request'=>request<object>, 'body'=>response<array|string>]
  */
  private function baseRequest($url, $method, $params = false, $options = [])
  {
    $ch = curl_init();
    $tempHeader = array_key_exists('header', $options) ? array_merge($this->_options['header'], $options['header']) : $this->_options['header'];
    if ($params) {
      $type = array_keys($params)[0];
      switch ($type) {
        case 'json':
          $data = json_encode($params[$type]);
          $tempHeader[] = "Content-Type: application/json";
          break;
        case 'form':
          $data = http_build_query($params[$type]);
          $tempHeader[] = "Content-Type: application/x-www-form-urlencoded";
          break;
        default:
          $data = $params[$type];
          break;
      }
      curl_setopt($ch, CURLOPT_POST, 1);
      curl_setopt($ch, CURLOPT_POSTFIELDS, $data);
    }
    curl_setopt($ch, CURLOPT_URL, $this->_options['baseUrl'].$url);
    curl_setopt($ch, CURLOPT_CUSTOMREQUEST, $method);
    curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
    curl_setopt($ch,CURLOPT_HTTPHEADER,$tempHeader);
    curl_setopt($ch, CURLOPT_FOLLOWLOCATION, true);
    $curlres = curl_exec($ch);
    if ($this->_options['responseType']) {
      switch ($this->_options['responseType']) {
        case 'json':
          $res = json_decode($curlres);
          break;
        default:
          $res = $curlres;
          break;
      }
    }
    else {
      $res = $curlres;
    }
    return [
      "statuscode" => curl_getinfo($ch, CURLINFO_HTTP_CODE),
      "request" => curl_getinfo($ch),
      "body" => $res,
      "error" => (!$curlres) ? curl_error($ch) : false
    ];
    curl_close($ch);
  }

  //CREATE
  /**
  * Execute une requete de methode POST
  * @param string $url path url
  * @param array[type<string>=>array[<key>=><value>]] $params OPTIONNAL data à envoyer, ex ['json'=>['key1'=>'value1', 'key2':'value2'...]]
  *        type doit soit être 'json' soit 'form'
  *        json set le header à 'Content-Type: application/json'
  *        form set le header à 'Content-Type: application/x-www-form-urlencoded'
  * @param array[type<string>=>array<mixed>] $option utilisé pour passer des options, actuellement il ni a que le header de personnalisable ici ex ['header'=>['header1', 'header2'...]]
  * @return array['statuscode'=>integer, 'request'=>request<object>, 'body'=>response<array|string>]
  */
  public function post($url, $params, $options = [])
  {
    return $this->baseRequest($url, 'POST', $params, $options);
  }
  //READ
  /**
  * Execute une requete de methode GET
  * @param string $url path url
  * @param array[type<string>=>array<mixed>] $option utilisé pour passer des options, actuellement il ni a que le header de personnalisable ici ex ['header'=>['header1', 'header2'...]]
  * @return array['statuscode'=>integer, 'request'=>request<object>, 'body'=>response<array|string>]
  */
  public function get($url, $options = [])
  {
    return $this->baseRequest($url, 'GET', false, $options);
  }
  //UPDATE
  /**
  * Execute une requete de methode UPDATE
  * @param string $url path url
  * @param array[type<string>=>array[<key>=><value>]] $params OPTIONNAL data à envoyer, ex ['json'=>['key1'=>'value1', 'key2':'value2'...]]
  *        type doit soit être 'json' soit 'form'
  *        json set le header à 'Content-Type: application/json'
  *        form set le header à 'Content-Type: application/x-www-form-urlencoded'
  * @param array[type<string>=>array<mixed>] $option utilisé pour passer des options, actuellement il ni a que le header de personnalisable ici ex ['header'=>['header1', 'header2'...]]
  * @return array['statuscode'=>integer, 'request'=>request<object>, 'body'=>response<array|string>]
  */
  public function patch($url, $params, $options = [])
  {
    return $this->baseRequest($url, 'PATCH', $params, $options);
  }
  //DELETE
  /**
  * Execute une requete de methode DELETE
  * @param string $url path url
  * @param array[type<string>=>array[<key>=><value>]] $params OPTIONNAL data à envoyer, ex ['json'=>['key1'=>'value1', 'key2':'value2'...]]
  *        type doit soit être 'json' soit 'form'
  *        json set le header à 'Content-Type: application/json'
  *        form set le header à 'Content-Type: application/x-www-form-urlencoded'
  * @param array[type<string>=>array<mixed>] $option utilisé pour passer des options, actuellement il ni a que le header de personnalisable ici ex ['header'=>['header1', 'header2'...]]
  * @return array['statuscode'=>integer, 'request'=>request<object>, 'body'=>response<array|string>]
  */
  public function delete($url, $params, $options = [])
  {
    return $this->baseRequest($url, 'DELETE', $params, $options);
  }
  //CUSTOM
  /**
  * Execute une requete de methode DELETE
  * @param string $url path url
  * @param string $method http method POST|GET|UPDATE|PATCH|DELETE
  * @param array[type<string>=>array[<key>=><value>]] $params OPTIONNAL data à envoyer, ex ['json'=>['key1'=>'value1', 'key2':'value2'...]]
  *        type doit soit être 'json' soit 'form'
  *        json set le header à 'Content-Type: application/json'
  *        form set le header à 'Content-Type: application/x-www-form-urlencoded'
  * @param array[type<string>=>array<mixed>] $option utilisé pour passer des options, actuellement il ni a que le header de personnalisable ici ex ['header'=>['header1', 'header2'...]]
  * @return array['statuscode'=>integer, 'request'=>request<object>, 'body'=>response<array|string>]
  */
  public function custom($url, $method, $params, $options = [])
  {
    return $this->baseRequest($url, $method, $params, $options);
  }
}
?>
