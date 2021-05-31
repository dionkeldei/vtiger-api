<?php

namespace dionkeldei\VtigerApi;

use GuzzleHttp\Client;

class CRMCreate extends CRMConfig{

    function Create($table,$contactData){
    $client = new Client();
    $vtiger = $this->Connect();
    $sessionId = $vtiger->result->sessionName;
    $objectJson = json_encode($contactData);
    $createcontact = $client->request('POST', VT_URL, [
        'form_params' => [
            'sessionName' => $sessionId,
            'operation' => 'create',
            'element' => $objectJson,
            'elementType' => $table
        ]
    ]);
    $jsonResponse= json_decode($createcontact->getBody()->getContents());
    return $jsonResponse;
    }
}
