<?php

namespace FbMessengerBot;

class Config {
    public $verifiyToken;
    public $accessToken;

    public function __construct($params = null)
    {
        $this->setVerifiyToken($params['verifiy_token']);
        $this->setAccessToken($params['access_token']);
    }

    public function setVerifiyToken($verifiyToken)
    {
        $this->verifiyToken = $verifiyToken;
    }

    public function getVerifiyToken()
    {
        return $verifiyToken;
    }

    public function setAccessToken($accessToken)
    {
        $this->accessToken = $accessToken;
    }

    public function getAccessToken()
    {
        return $accessToken;
    }
}
