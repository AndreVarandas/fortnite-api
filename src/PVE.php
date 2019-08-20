<?php
/**
 * Handles PVE data.
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
 * Class Fortnite_PVE
 *
 * @category Varandas\FortniteApi
 * @package  Varandas\FortniteApi
 * @author   Sam Hoog Antink, André Varandas <andre.m.varandas@gmail.com>
 * @license  MIT License
 * @link     https://github.com/AndreVarandas/Fortnite-API
 */
class Fortnite_PVE
{
    /**
     * Instance of FortniteClient.
     *
     * @var FortniteClient
     */
    private $_Client;

    /**
     * Fortnite_PVE constructor.
     *
     * @param FortniteClient $client Instance
     */
    public function __construct($client)
    {
        $this->_Client = $client;
    }

    /**
     * Get the current PVE info.
     *
     * @return mixed
     */
    public function info()
    {
        $return = json_decode($this->_Client->httpCall('pveinfo/get', []));

        if (isset($return->error)) {
            return $return->errorMessage;
        } else {
            return $return;
        }
    }
}