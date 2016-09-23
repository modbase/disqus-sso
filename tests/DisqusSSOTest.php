<?php

namespace Modbase\Disqus;

/**
 * Overloads the global PHP time
 * method so that we control
 * the time given back.
 * @return int
 */
function time()
{
    return 1451606400;
}

use PHPUnit_Framework_TestCase;

require_once(__DIR__ . '/../src/Modbase/Disqus/Disqus.php');
require_once(__DIR__ . '/../vendor/illuminate/support/helpers.php');

class DisqusTest extends PHPUnit_Framework_TestCase
{

    protected $publicKey = 'ZoW14D70cVOLTIF2kagkPHCiGpO2hipYiarj84zfoORAP4e3rRpPGJ7bghMtZKgc';
    protected $privateKey = '3UV2XVGKOUTEyhINHXve9YyOJKPDUV1VvywoffK6l6O6UNZIpi5P2Ea9eK3Q086a';
    protected $userData = [
        'id' => 1,
        'username' => 'test',
        'email' => 'test@test.com',
        'avatar' => 'https://api.adorable.io/avatars/285/abott@adorable.png',
        'url' => 'http://google.com'
    ];

    /**
     * Test to see if the payload is
     * correct when all user data is
     * supplied
     * @return void
     */
    public function testAllUserdata()
    {
        $expectedPayload = 'eyJpZCI6MSwidXNlcm5hbWUiOiJ0ZXN0IiwiZW1haWwiOiJ0ZXN0QHRlc3QuY29tIiwiYXZhdGFyIjoiaHR0cHM6XC9cL2FwaS5hZG9yYWJsZS5pb1wvYXZhdGFyc1wvMjg1XC9hYm90dEBhZG9yYWJsZS5wbmciLCJ1cmwiOiJodHRwOlwvXC9nb29nbGUuY29tIn0= c8187eeb2e33b33c69672e4a4e3d47f525bbe044 1451606400';

        $disqus = new Disqus($this->publicKey, $this->privateKey);
        $payload = $disqus->payload($this->userData);

        $this->assertEquals($expectedPayload, $payload);
    }

    /**
     * Test to see if the payload is
     * correct when some user data is
     * missing.
     * @return void
     */
    public function testMissingUserdata()
    {
        $expectedPayload = 'eyJpZCI6MSwidXNlcm5hbWUiOiJ0ZXN0IiwiZW1haWwiOiJ0ZXN0QHRlc3QuY29tIiwidXJsIjoiaHR0cDpcL1wvZ29vZ2xlLmNvbSJ9 7b742d7d3065a7c4c74eac204bff1dc40f549fbb 1451606400';

        $disqus = new Disqus($this->publicKey, $this->privateKey);

        $userData = $this->userData;
        unset($userData['avatar']);

        $payload = $disqus->payload($userData);

        $this->assertEquals($expectedPayload, $payload);
    }
}
