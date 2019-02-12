<?php

namespace App\Service;

use \GuzzleHttp\Client as HttpClient;

class TweetService
{
    /**
     * @const $baseUrlApi
     */
    public const TWEETNUMBER = 45;

    /**
     * @var $baseUrlApi
     */
    public $baseUrlApi;

    /**
     * @var $apiVersion
     */
    public $apiVersion;

    /**
     * Constructor class
     * @access public
     * @return void
     */
    public function __construct()
    {
        $this->baseUrlApi = getenv('TWEET_API');
        $this->apiVersion = getenv('TWEET_API_VERSION');
    }

    /**
     * Get token GLPI
     * @access public
     * @return object
     */
    public function getToken(): object
    {
        $client = new HttpClient([
            'base_uri' => "$this->baseUrlApi/$this->apiVersion/"
        ]);
        $response = $client->request('POST', 'auth');
        return json_decode($response->getBody()->getContents());
    }

    /**
     * Get tweets
     * @access public
     * @param string $token
     * @return array
     */
    public function getTweet(string $token): array
    {
        $client = new HttpClient([
            'base_uri' => "$this->baseUrlApi/$this->apiVersion/",
            'headers'  => ['Authorization' => 'Bearer '.$token]
        ]);
        $response = $client->request('GET', 'statuses/home_timeline.json');
        return json_decode($response->getBody()->getContents());
    }

    /**
     * Get Sliced Random Tweet
     * @access public
     * @param array $data
     * @return object
     */
    public function getSlicedRandomTweet(object $data): array
    {
        $rand = rand(0, count($data));
        $tweet = $data[$rand];
        $tweets = [];

        for ($i=0; $i < ceil(strlen($tweet) / self::TWEETNUMBER); $i++) {
            $tweets[] = substr($tweet, (self::TWEETNUMBER * $i), (self::TWEETNUMBER * ($i + 1)));
        }

        return $tweets;
    }

    /**
     * Get mock token
     * @access public
     * @return object
     */
    public function getMockToken(): object
    {
        $token = '{"token": "eyJhbGciOiJIUzI1NiIsInR5cCI6IkpXVCJ9.eyJkYXRhIjp7ImlkIjoxLCJuYW1lIjoiWnVsIERpZ3RhbCJ9LCJpYXQiOjE1NDk5MzE4NzksImV4cCI6MTU0OTkzMTkzOX0.d83wbx86AK9kkO3B7Uy0cIz_SWEddSv7EwMOkcf1s_g"}';

        return json_decode($token);
    }

    /**
     * Get mock tweets
     * @access public
     * @return object
     */
    public function getMockTweet(): object
    {
        return json_decode(file_get_contents(public_path('default.json')));
    }
}
