<?php
/**
 * Gets season challenges.
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
 * Class Fortnite_Challenges
 *
 * @category Varandas\FortniteApi
 * @package  Varandas\FortniteApi
 * @author   Sam Hoog Antink, André Varandas <andre.m.varandas@gmail.com>
 * @license  MIT License
 * @link     https://github.com/AndreVarandas/Fortnite-API
 */
class Fortnite_Challenges
{
    /**
     * Reference to the FortniteClient instance
     *
     * @var FortniteClient
     */
    private $_Client;

    /**
     * Fortnite_Challenges constructor.
     *
     * @param FortniteClient $client FortniteClient instance
     */
    public function __construct($client)
    {
        $this->_Client = $client;
    }

    /**
     * Get challenges for season.
     *
     * @param string $season   Season to look for
     * @param string $language Content language
     *
     * @return mixed|string
     */
    public function get($season = 'current', $language = 'en')
    {
        $return = json_decode(
            $this->_Client->httpCall(
                'challenges/get?', ['season' => $season, 'language' => $language]
            )
        );

        if (isset($return->error)) {
            return $return->errorMessage;
        } else {
            return $return;
        }
    }
}
