<?php
/**
 * This is the main class, that orchestrates the library.
 *
 * PHP version 7
 *
 * @category Varandas\FortniteApi
 * @package  Varandas\FortniteApi
 * @author   Sam Hoog Antink, André Varandas <andre.m.varandas@gmail.com>
 * @license  MIT License
 * @link     https://github.com/AndreVarandas/Fortnite-API
 */

namespace Varandas\FortniteApi;

/**
 * Class FortniteClient
 *
 * @category Varandas\FortniteApi
 * @package  Varandas\FortniteApi
 * @author   Sam Hoog Antink, André Varandas <andre.m.varandas@gmail.com>
 * @license  MIT License
 * @link     https://github.com/AndreVarandas/Fortnite-API
 */
class FortniteClient
{
    private $_api_endpoint = 'https://fortnite-api.theapinetwork.com/';
    private $_response_code;

    protected $ch;

    public $auth;
    public $challenges;
    public $items;
    public $news;
    public $pve;
    public $user;
    public $weapons;

    /**
     * FortniteClient constructor.
     */
    public function __construct()
    {
        $this->auth = new Fortnite_Auth($this);
        $this->challenges = new Fortnite_Challenges($this);
        $this->items = new Fortnite_Items($this);
        $this->news = new Fortnite_News($this);
        $this->pve = new Fortnite_PVE($this);
        $this->user = new Fortnite_User($this);
        $this->weapons = new Fortnite_Weapons($this);
    }

    /**
     * Sets the authorization key.
     *
     * @param string $key The authorization key.
     *
     * @return void
     */
    public function setKey($key = '')
    {
        $this->auth->setKey($key);
    }

    /**
     * Exception Handler
     *
     * @param string $err - The error message to show.
     *
     * @return void
     */
    public static function exception($err = '')
    {
        die($err);
    }

    /**
     * Handles http requests.
     *
     * @param string $method - The endpoint path to call.
     * @param string $fields - The query strings.
     * @param bool   $custom - True if using a another endpoint than $_api_endpoint.
     *
     * @return bool|string
     */
    public function httpCall($method = '', $fields = '', $custom = false)
    {
        if (empty($this->auth->auth)) {
            FortniteClient::exception(
                'You have not set an API key. Use setKey() to set the API key.'
            );
        }

        if (empty($this->ch) || !function_exists('curl_reset')) {
            $this->ch = curl_init();
        } else {
            curl_reset($this->ch);
        }

        if ($custom == false) {
            $url = $this->_api_endpoint . $method;
        } else {
            $url = $method;
        }

        curl_setopt($this->ch, CURLOPT_URL, $url . http_build_query($fields));
        curl_setopt($this->ch, CURLOPT_RETURNTRANSFER, true);
        curl_setopt($this->ch, CURLOPT_TIMEOUT, 30);

        $headers = [
            'Authorization: ' . $this->auth->auth,
        ];

        curl_setopt($this->ch, CURLOPT_HTTPHEADER, $headers);
        curl_setopt($this->ch, CURLOPT_SSL_VERIFYHOST, 2);
        curl_setopt($this->ch, CURLOPT_SSL_VERIFYPEER, true);

        $body = curl_exec($this->ch);

        $this->_response_code = curl_getinfo($this->ch, CURLINFO_HTTP_CODE);

        if (curl_errno($this->ch)) {
            $msg = 'Unable to communicate with Fortnite API (
                ' . curl_errno($this->ch) . '): ' . curl_error($this->ch) . '.';

            $this->_unsetHttpCall();

            FortniteClient::exception($msg);
        }

        if (!function_exists('curl_reset')) {
            $this->_unsetHttpCall();
        }

        if ($this->_response_code != 200) {
            FortniteClient::exception(
                'Something wen\'t wrong. We couldn\'t give you an 200 header back - '
                    . $this->_response_code
            );
        }

        return $body;
    }

    /**
     * Clears Curl Handler
     *
     * @return void
     */
    private function _unsetHttpCall()
    {
        if (is_resource($this->ch)) {
            curl_close($this->ch);
            $this->ch = null;
        }
    }

    /**
     * Unset httpCall when disposed.
     */
    public function __destruct()
    {
        $this->_unsetHttpCall();
    }
}
