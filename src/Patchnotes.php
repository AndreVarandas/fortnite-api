<?php
/**
 * Handles Fortnite patch notes.
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
 * Class Fortnite_PatchNotes
 *
 * @category Varandas\FortniteApi
 * @package  Varandas\FortniteApi
 * @author   Sam Hoog Antink, André Varandas <andre.m.varandas@gmail.com>
 * @license  MIT License
 * @link     https://github.com/AndreVarandas/Fortnite-API
 */
class Fortnite_PatchNotes
{
    /**
     * FortniteClient instance.
     *
     * @var FortniteClient
     */
    private $_Client;

    /**
     * Fortnite_PatchNotes constructor.
     *
     * @param FortniteClient $client Client instance.
     */
    public function __construct($client)
    {
        $this->_Client = $client;
    }

    /**
     * Gets patch notes.
     *
     * @return mixed
     */
    public function get()
    {
        $return = json_decode($this->_Client->httpCall('patchnotes/get', []));

        if (isset($return->error)) {
            return $return->errorMessage;
        } else {
            return $return;
        }
    }
}