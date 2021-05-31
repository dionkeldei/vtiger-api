<?php

namespace dionkeldei\VtigerApi;

class CRMConfig extends CRMEdit{
    function Config(){
        $arr = array(
            'VT_USER'=>$this->accessUser,
            'VT_KEY'=>$this->accessToken,
            'VT_URL'=>$this->accessUrl
          );
        $arr = (object) $arr;
        return $arr;
    }
}
