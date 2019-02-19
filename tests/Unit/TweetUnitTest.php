<?php

namespace Tests\Unit;

use Tests\TestCase;
use Illuminate\Foundation\Testing\RefreshDatabase;
use App\Service\TweetService;

class TweetUnitTest extends TestCase
{
    /**
     * @var variable to service tweet
     */
    public $serviceTweet;

    public function setUp()
    {
        parent::setUp();
        $this->serviceTweet = new TweetService;
    }

    /**
     * test get token test
     *
     * @return void
     */
    public function testGetTokenTest()
    {
        $token = $this->serviceTweet->getToken();
        $this->assertInstanceOf(\stdClass::class, $token);
    }

    /**
     * test get tweet
     *
     * @return void
     */
    public function testGetTweet()
    {
        $token = $this->serviceTweet->getToken();
        $tweet = $this->serviceTweet->getTweet($token->token);

        $this->assertTrue(isset($tweet[0]->text));
        $this->assertTrue(is_string($tweet[0]->text));
    }

    /**
     * test get mock token test
     *
     * @return void
     */
    public function testGetMockTokenTest()
    {
        $token = $this->serviceTweet->getMockToken();
        $this->assertInstanceOf(\stdClass::class, $token);
    }

    /**
     * test get mock tweet
     *
     * @return void
     */
    public function testGetMockTweet()
    {
        $tweet = $this->serviceTweet->getMockTweet();

        $this->assertTrue(isset($tweet[0]->text));
        $this->assertTrue(is_string($tweet[0]->text));
    }

    /**
     * test get sliced random tweet
     *
     * @return void
     */
    public function testGetSlicedRandomTweet()
    {
        $data = $this->serviceTweet->getSlicedRandomTweet();
        $this->assertTrue(is_object($data));
    }

    /**
     * test get rand value from array
     *
     * @return void
     */
    public function testGetRandValueFromArray()
    {
        $data = [
            'teste 1',
            'teste 2',
            'teste 3'
        ];
        $data = $this->serviceTweet->getRandValueFromArray($data);
        $this->assertTrue(is_string($data));
    }

    /**
     * test get words from string
     *
     * @return void
     */
    public function testGetWordsFromString()
    {
        $string = 'Hello World';
        $data = $this->serviceTweet->getWordsFromString($string);
        $this->assertTrue(is_array($data));
    }

    /**
     * test make tweets from array words
     *
     * @return void
     */
    public function testMakeTweetsFromArrayWords()
    {
        $data = [
            'Hello',
            'World'
        ];
        $data = $this->serviceTweet->makeTweetsFromArrayWords($data);
        $this->assertTrue(is_array($data));
    }


    /**
     * test build tweet
     *
     * @return void
     */
    public function testBuildTweet()
    {
        $data = [
            'Hello',
            'World'
        ];
        $data = $this->serviceTweet->buildTweet($data, 1);
        $this->assertTrue(is_string($data));
    }
}
