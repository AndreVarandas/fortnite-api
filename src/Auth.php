<?php
/**
 * Manager of the authorization key.
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
 * Class Fortnite_Auth
 *
 * @category Varandas\FortniteApi
 * @package  Varandas\FortniteApi
 * @author   Sam Hoog Antink, André Varandas <andre.m.varandas@gmail.com>
 * @license  MIT License
 * @link     https://github.com/AndreVarandas/Fortnite-API
 */
class Fortnite_Auth
{
    public $auth;
    private $_Client;

    /**
     * Fortnite_Auth constructor.
     *
     * @param FortniteClient $client FortniteClient instance.
     */
    public function __construct($client)
    {
        $this->_Client = $client;
    }

    /**
     * Sets the current authentication key.
     *
     * @param string $key - The authentication key.
     *
     * @return string|void
     */
    public function setKey($key = '')
    {
        if (!empty($key)) {
            $this->auth = $key;

            return '';
        }

        FortniteClient::exception('Invalid API key.');
    }
}