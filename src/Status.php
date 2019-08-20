<?php
/**
 * Handles Fortnite Status.
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
 * Class Fortnite_Status
 *
 * @category Varandas\FortniteApi
 * @package  Varandas\FortniteApi
 * @author   Sam Hoog Antink, André Varandas <andre.m.varandas@gmail.com>
 * @license  MIT License
 * @link     https://github.com/AndreVarandas/Fortnite-API
 */
class Fortnite_Status
{
    private $_status = null;
    private $_Client;

    /**
     * Fortnite_Status constructor.
     *
     * @param FortniteClient $client Instance.
     */
    public function __construct($client)
    {
        $this->_Client = $client;
    }

    /**
     * Server status (UP or DOWN)
     *
     * @return mixed
     */
    public function status()
    {
        $this->fetch();

        return $this->_status->status;
    }

    /**
     * Server message (Directly from Epic Games)
     *
     * @return mixed
     */
    public function message()
    {
        $this->fetch();

        return $this->_status->message;
    }

    /**
     * Fortnite version (something like v4.0, v4.1 etc.)
     *
     * @return mixed
     */
    public function version()
    {
        $this->fetch();

        return $this->_status->version;
    }

    /**
     * Get time.
     *
     * @param string $type   - Since or duration.
     * @param string $option - Seconds
     *
     * @return mixed
     */
    public function time($type = 'since', $option = 'seconds')
    {
        $this->fetch();

        return $this->_status->time->$type->$option;
    }

    /**
     * Fetching the current server status.
     *
     * @return mixed
     */
    public function fetch()
    {
        if ($this->_status == null) {
            $return = json_decode(
                $this->_Client->httpCall('status/fortnite_server_status', [])
            );

            if (isset($return->error)) {
                FortniteClient::Exception($return->errorMessage);
            } else {
                $this->_status = $return;

                return $return;
            }
        }

        return null;
    }
}