<?php

/**
 * Created by PhpStorm.
 * User: eduardo
 * Date: 15/03/16
 * Time: 17:27
 */
class Token
{
    private static $token;

    /**
     * @return mixed
     */
    public static function getToken()
    {
        self::setToken(md5('seg' . $_SERVER['REMOTE_ADDR'] . $_SERVER['HTTP_USER_AGENT']));
        return self::$token;
    }

    /**
     * @param mixed $token
     */
    private static function setToken($token)
    {
        self::$token = $token;
    }

    public static function setTokenForm()
    {
        self::$token = md5(microtime() * microtime());
    }

    public static function getTokenForm()
    {
        self::setTokenForm();
        return self::$token;
    }


}