<?php
/**
 * Handles FortniteApi items.
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
 * Class Fortnite_Items
 *
 * @category Varandas\FortniteApi
 * @package  Varandas\FortniteApi
 * @author   Sam Hoog Antink, André Varandas <andre.m.varandas@gmail.com>
 * @license  MIT License
 * @link     https://github.com/AndreVarandas/Fortnite-API
 */
class Fortnite_Items
{
    /**
     * FortniteClient instance
     *
     * @var FortniteClient
     */
    private $_Client;

    /**
     * Fortnite_Items constructor.
     *
     * @param FortniteClient $client FortniteClient instance.
     */
    public function __construct($client)
    {
        $this->_Client = $client;
    }

    /**
     * Gets the current store (BR)
     *
     * @return mixed
     */
    public function store()
    {
        $return = json_decode(
            $this->_Client->httpCall('store/get?', ['language' => 'en'])
        );

        if (isset($return->error)) {
            return $return->errorMessage;
        } else {
            return $return;
        }
    }

    /**
     * Gets the upcoming items (BR)
     *
     * @return mixed
     */
    public function upcoming()
    {
        $return = json_decode(
            $this->_Client->httpCall('upcoming/get?', ['language' => 'en'])
        );

        if (isset($return->error)) {
            return $return->errorMessage;
        } else {
            return $return;
        }
    }

    /**
     * Get a long list of all items in Fortnite,
     * from outfits to wraps. Everything is listed.
     *
     * @return mixed
     */
    public function list()
    {
        $return = json_decode($this->_Client->httpCall('items/list'));

        if (isset($return->error)) {
            return $return->errorMessage;
        } else {
            return $return;
        }
    }

    /**
     * Gets a random set of items.
     *
     * @return mixed
     */
    public function random()
    {
        $return = json_decode($this->_Client->httpCall('items/random'));

        if (isset($return->error)) {
            return $return->errorMessage;
        } else {
            return $return;
        }
    }

    /**
     * Get the most popular items.
     *
     * @return mixed
     */
    public function popular()
    {
        $return = json_decode($this->_Client->httpCall('items/popular'));

        if (isset($return->error)) {
            return $return->errorMessage;
        } else {
            return $return;
        }
    }

    /**
     * Get data for an item id.
     *
     * @param string $id The item id to search for
     *
     * @return mixed|string
     */
    public function data($id)
    {
        if (empty($id)) {
            return 'Invalid item id.';
        }

        $return = json_decode(
            $this->_Client->httpCall(
                'item/get?', ['id' => urlencode($id)]
            )
        );

        if (isset($return->error)) {
            return $return->errorMessage;
        } else {
            return $return;
        }
    }

    /**
     * Search for Fortnite BR items.
     *
     * Note: This is not connected with your Authorization key.
     * It's free to use and doesn't have any limits.
     *
     * @param string $name - The item to search for.
     *
     * @return mixed
     */
    public function search($name = '')
    {
        $return = json_decode(
            $this->_Client->httpCall(
                'https://fortnite-public-files.theapinetwork.com/search?query='
                . urlencode($name),
                [],
                true
            )
        );

        if (isset($return->error)) {
            return $return->msg;
        } else {
            return $return;
        }
    }
}