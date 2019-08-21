<?php
/**
 * Handles Fortnite Users.
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
 * Class Fortnite_User
 *
 * @category Varandas\FortniteApi
 * @package  Varandas\FortniteApi
 * @author   Sam Hoog Antink, André Varandas <andre.m.varandas@gmail.com>
 * @license  MIT License
 * @link     https://github.com/AndreVarandas/Fortnite-API
 */
class Fortnite_User
{
    private $_windows = ['alltime', 'season4', 'season5', 'season6', 'season7'];
    public $uid = null;
    /**
     * FortniteClient instance.
     *
     * @var FortniteClient
     */
    private $_Client;

    /**
     * Fortnite_User constructor.
     *
     * @param FortniteClient $client Instance.
     */
    public function __construct($client)
    {
        $this->_Client = $client;
    }

    /**
     * Get user id out of an username.
     *
     * @param string $username - The username to search for.
     *
     * @return mixed|string
     */
    public function id($username = '')
    {
        if (!empty($username)) {
            $return = json_decode(
                $this->_Client->httpCall(
                    'users/id?', ['username' => urlencode($username)]
                )
            );

            if (isset($return->error)) {
                return $return->errorMessage;
            } else {
                $this->uid = $return->data->uid;

                return $return;
            }
        }

        return 'Invalid username.';
    }

    /**
     * Get the user old v1 user stats.
     *
     * @param string $platform - The user platform.
     * 
     * @return mixed|string
     */
    public function v1Stats($platform = 'pc')
    {
        (empty($user_id) && !empty($this->uid)) ? $user_id = $this->uid: '';

        if (!empty($user_id) && !empty($platform)) {
            $return = json_decode(
                $this->_Client->httpCall(
                    'users/public/br_stats?',
                    [
                        'user_id' => $user_id,
                        'platform' => $platform
                    ]
                )
            );

            if (isset($return->error)) {
                return $return->errorMessage;
            } else {
                return $return;
            }
        }

        return 'Invalid user id.';
    }

    /**
     * Gets v2 stats for the current user.
     *
     * @return mixed|string
     */
    public function stats()
    {
        (empty($user_id) && !empty($this->uid)) ? $user_id = $this->uid: '';

        if (!empty($user_id)) {
            $return = json_decode(
                $this->_Client->httpCall(
                    'users/public/br_stats_v2?', ['user_id' => $user_id]
                )
            );

            if (isset($return->error)) {
                return $return->errorMessage;
            } else {
                return $return;
            }
        }

        return 'Invalid user id.';
    }
}