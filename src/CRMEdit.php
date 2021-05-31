<?php

namespace ibizaBMB\CRM;

use GuzzleHttp\Client;

class CRMEdit extends CRMConn{
    
     function Select($table,$field=null,$id=null){
        $client = new Client(); //GuzzleHttp\Client  
        $vtiger = $this->Connect();
        $sessionId = $vtiger->result->sessionName;
        if($field == null && $id == null){
            $query = "SELECT * FROM $table;";
        }else{
            $query = "SELECT * FROM $table WHERE $field = '$id';";
        }
        
          $queryParam = urldecode($query);
          // Obtener la cuenta
           $getUserDetail = $client->request('GET', VT_URL, [
               'query' => [
                   'sessionName' => $sessionId,
                   'operation' => 'query',
                   'query' => $queryParam
               ]
           ]);
         $query_result = json_decode($getUserDetail->getBody()->getContents());
         $query_result->conn = $vtiger;
         return $query_result;
    }
    
    function Update($table,$id,$array){
        $vtiger = $this->Connect();
        $sessionId = $vtiger->result->sessionName;
        $client = new Client(); //GuzzleHttp\Client  
        // Obtener el contacto que se modificara
                 $reponse = $client->request('GET', VT_URL, [
                     'query' => [
                         'sessionName' => $sessionId,
                         'operation' => 'retrieve',
                         'id' => $id
                     ]
                 ]);
                $jsonResponse = json_decode($reponse->getBody()->getContents());
                $retrievedObject = $jsonResponse->result;
                $assigned = $jsonResponse->result->assigned_user_id;
                //Arreglo con datos que se modificaran al contacto
                
                foreach($array as $key => $value){
                    $retrievedObject->$key = $value;
                }
                $objectJson = json_encode($retrievedObject);
                //Modificacion del contacto
                $updatecontact = $client->request('POST', VT_URL, [
                    'form_params' => [
                        'sessionName' => $sessionId,
                        'operation' => 'update', 
                        'element' => $objectJson
                        ]
                ]);
                $arr = array(
              'status'=>$updatecontact->getStatusCode(),
              'response'=>json_decode($updatecontact->getBody()->getContents())
              );
              
              $arr = (object) $arr;
              return $arr;
    }
}
