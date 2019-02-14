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
        $rand = rand(0, (count($data) - 1));
        $tweet = $data[$rand];
        $tweets = [];

        $words = $this->getWordsFromString($tweet);
        $finalData = $this->makeTweetsFromArrayWords($words);

        dd($finalData);

        return $finalData;
    }

    /**
     * Make Tweets From an Array Words
     * @access public
     * @param array $words
     * @return array
     */
    public function makeTweetsFromArrayWords(array $words): array
    {
        $dataReturn     = [];
        $tweetWords     = [];
        $validateLength = 0;
        $tweetNumber    = 1;

        foreach ($words as $key => $word) {
            $nextString     = array_merge($tweetWords, [$word]);
            $validateLength = mb_strlen(implode(' ', $nextString), 'utf8');
            
            if($validateLength >= self::TWEETNUMBER) {
                $validateLength = 0;
                $dataReturn[]   = $this->buildTweet($tweetWords, $tweetNumber);
                $tweetWords     = [];
                $tweetNumber++;
            }
            $tweetWords[] = $word;

            if(end($words) == $word){
                $dataReturn[] = $this->buildTweet($tweetWords, $tweetNumber);
            }
        }

        return $dataReturn;
    }

    public function buildTweet(array $array, int $number): string
    {
        return "Tweet #$number: " . implode(' ', $array);
    }

    /**
     * Get Words From String
     * @access public
     * @param string $string
     * @return array
     */
    public function getWordsFromString(string $string): array
    {
        $arrayWords = explode(' ', $string);
        foreach ($arrayWords as $key => $value) {
            if($value == ""){
                unset($arrayWords[$key]);
            }
        }

        return $arrayWords;
    }


    /**
     * Get Count From Words
     * @access public
     * @param string $string
     * @return array
     */
    public function getCountFromWords(array $words): array
    {
        $wordsWithCount = [];
        foreach ($words as $key => $value) {
            $wordsWithCount[$key]['len'] = mb_strlen($value, 'utf8');
            $wordsWithCount[$key]['word'] = $value;
        }

        return $wordsWithCount;
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
     * @return array
     */
    public function getMockTweet(): array
    {
        return json_decode(file_get_contents(public_path('default.json')));
    }
}
