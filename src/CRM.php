<?php

namespace ibizaBMB\CRM;

class CRM extends CRMCreate{
        function __construct($url,$user,$token)
  {
      $this->accessUrl = $url;
      $this->accessUser = $user;
      $this->accessToken = $token;
  }

}
