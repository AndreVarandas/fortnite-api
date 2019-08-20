<?php
/**
 * Handles Fortnite Weapons.
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
 * Class Fortnite_Weapons
 *
 * @category Varandas\FortniteApi
 * @package  Varandas\FortniteApi
 * @author   Sam Hoog Antink, André Varandas <andre.m.varandas@gmail.com>
 * @license  MIT License
 * @link     https://github.com/AndreVarandas/Fortnite-API
 */
class Fortnite_Weapons
{
    /**
     * FortniteClient instance.
     *
     * @var FortniteClient
     */
    private $_Client;

    /**
     * Fortnite_Weapons constructor.
     *
     * @param FortniteClient $client Instance.
     */
    public function __construct($client)
    {
        $this->_Client = $client;
    }

    /**
     * Get Fortnite Weapons.
     *
     * @return mixed
     */
    public function get()
    {
        $return = json_decode($this->_Client->httpCall('weapons/get', []));

        if (isset($return->error)) {
            return $return->errorMessage;
        } else {
            return $return;
        }
    }
}
