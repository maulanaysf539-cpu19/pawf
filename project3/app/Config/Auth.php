<?php

namespace Config;

use Myth\Auth\Config\Auth as AuthConfig;

class Auth extends AuthConfig
{
    /**
     * Disable email activation during registration.
     */
    public $requireActivation = null;
}
