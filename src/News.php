<?php
/**
 * Handles Fortnite news.
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
 * Class Fortnite_News
 *
 * @category Varandas\FortniteApi
 * @package  Varandas\FortniteApi
 * @author   Sam Hoog Antink, André Varandas <andre.m.varandas@gmail.com>
 * @license  MIT License
 * @link     https://github.com/AndreVarandas/Fortnite-API
 */
class Fortnite_News
{
    /**
     * Instance of the FortniteClient
     *
     * @var FortniteClient
     */
    private $_Client;

    /**
     * Fortnite_News constructor.
     *
     * @param FortniteClient $client - An instance of the client.
     */
    public function __construct($client)
    {
        $this->_Client = $client;
    }

    /**
     * Last 15 news messages.
     *
     * @param string $type     - News type.
     * @param string $language - News language.
     *
     * @return mixed
     */
    public function get($type = 'br', $language = 'en')
    {
        $type = ((empty($type)) ? 'br' : $type);
        
        $return = json_decode(
            $this->_Client->httpCall($type . '_motd/get', ['language' => $language])
        );

        if (isset($return->error)) {
            return $return->errorMessage;
        } else {
            return $return;
        }
    }
}