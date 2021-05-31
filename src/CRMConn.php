<?php

namespace dionkeldei\VtigerApi;

use GuzzleHttp\Client;

class CRMConn{
    function Connect(){
        ////////////////////////CONEXION VTIGER////////////////////////
          $client = new Client(); //GuzzleHttp\Client
          ////Obtener Get Challenge para utilizar en el logue al CRM/////
          $reponse = $client->request('GET', $this->accessUrl, [
              'query' => [
                  'operation' => 'getchallenge',
                  'username' => $this->accessUser
              ]
          ]);
          /////////decodificar la respuesta del Get Challengue///////////
          $challenge = json_decode($reponse->getBody());

          ////////////Si falla al obtener el Get Challenge///////////////
          if($reponse->getStatusCode() !== 200 || !$challenge->success) {
              die('getchallenge failed: ' . $challenge['error']['errorMessage']);
          }
          //////////Crear un token con el challenge obtenido/////////////
          $token = $challenge->result->token;
          /////Crear una unica llave con el challengetoken y accesskey para loguearnos al CRM/////
          $generatedkey = md5($token . $this->accessToken);
          ///////logueo al CRM utilizando username y accesskey//////////
          $reponse = $client->request('POST', $this->accessUrl, [
              'form_params' => [
                  'operation' => 'login',
                  'username' => $this->accessUser,
                  'accessKey' => $generatedkey
              ]
          ]);
          ///////decodificar la respuesta del logueo $response///////////
          $login_result = json_decode($reponse->getBody()->getContents());
          //////////////////Si falla el logueo al CRM////////////////////
          if($reponse->getStatusCode() !== 200 || !$login_result->success) {
              die('login failed: ' . $login_success['error']['errorMsg']);
          }
          /////Obtener el sessionId y user Id del logueo//////
          return $login_result;
    }
}
