<?php
/**
 * Gets Fortnite leaderboard.
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
 * Class Fortnite_Leaderboard
 *
 * @category Varandas\FortniteApi
 * @package  Varandas\FortniteApi
 * @author   Sam Hoog Antink, André Varandas <andre.m.varandas@gmail.com>
 * @license  MIT License
 * @link     https://github.com/AndreVarandas/Fortnite-API
 */
class Fortnite_Leaderboard
{
    private $_windows = ['kills', 'wins', 'matches', 'score'];
    /**
     * FortniteClient instance.
     *
     * @var FortniteClient
     */
    private $_Client;

    /**
     * Fortnite_Leaderboard constructor.
     *
     * @param FortniteClient $client Client instance.
     */
    public function __construct($client)
    {
        $this->_Client = $client;
    }

    /**
     * Top 20.000.000 most wins, kills, score, or matches played.
     *
     * @param int    $users_per_page - Number of users on each page.
     * @param int    $offset         - Number of results to skip.
     * @param string $window         - Choose between wins, kills, score or matches.
     * 
     * @return mixed|string
     */
    public function worldwide($users_per_page = 100, $offset = 0, $window = 'kills')
    {
        if (in_array($window, $this->_windows)) {
            $return = json_decode(
                $this->_Client->httpCall(
                    'leaderboards/worldwide',
                    ['users_per_page' => $users_per_page,
                        'offset' => $offset, 'window' => $window]
                )
            );

            if (isset($return->error)) {
                return $return->errorMessage;
            } else {
                return $return;
            }
        }

        return 'Invalid window.';
    }
}