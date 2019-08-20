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
     * Get user devices - returns an array.
     *
     * @param string $username - The username to search for.
     *
     * @return string|array
     */
    public function getDevices($username = '')
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
                return $return->platforms;
            }
        }

        return 'Invalid username.';
    }

    /**
     * Get username out of an user id (can be multiple in an array)
     *
     * @param null $ids - The user id to search for.
     *
     * @return mixed|string
     */
    public function getUsernameFromId($ids = null)
    {
        if (!empty($ids) && is_array($ids)) {
            $return = json_decode(
                $this->_Client->httpCall(
                    'users/username%20out%20of%20id', ['ids' => $ids]
                )
            );

            if (isset($return->error)) {
                return $return->errorMessage;
            } else {
                return $return;
            }
        }

        return 'Usernames are invalid.';
    }

    /**
     * Get the user stats.
     *
     * @param string $platform - The user platform.
     * @param string $window   - Time frame
     * 
     * @return mixed|string
     */
    public function stats($platform = 'pc', $window = 'alltime')
    {
        (empty($user_id) && !empty($this->uid)) ? $user_id = $this->uid: '';
        (!in_array($window, $this->_windows)) ? $window = 'alltime' : '';

        if (!empty($user_id) && !empty($platform)) {
            $return = json_decode(
                $this->_Client->httpCall(
                    'users/public/br_stats_v2',
                    ['user_id' => $user_id, 'platform'
                        => $platform, 'window' => $window]
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
     * Match tracking - We can only show cached matches that are cached
     * by using stats().
     * The first time asking for user matches can take a while because
     * we are calculating all matches.
     *
     * @param string $platform - The player platform.
     * @param string $window   - Time frame
     * @param int    $rows     - Number of rows
     * 
     * @return mixed|string
     */
    public function matches($platform = 'pc', $window = 'alltime', $rows = 15)
    {
        (empty($user_id) && !empty($this->uid)) ? $user_id = $this->uid: '';
        (!in_array($window, $this->_windows)) ? $window = 'alltime' : '';
        (!is_numeric($rows)) ? $rows = 15 : '';

        if (!empty($user_id) && !empty($platform) && !empty($rows)) {
            $return = json_decode(
                $this->_Client->httpCall(
                    'users/public/matches',
                    ['user_id' => $user_id, 'platform'
                        => $platform, 'window' => $window, 'rows' => $rows]
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