<?php

namespace App\Http\Controllers;
use GuzzleHttp\Client;
use Illuminate\Http\Request;
use Storage;
use App\Service\TweetService;

class TweetController extends Controller
{
    /**
     * @var $tweetService
     */
    public $tweetService;

    /**
     * Constructor class
     * @access public
     * @return void
     */
    public function __construct(TweetService $tweetService)
    {
        $this->tweetService = $tweetService;
    }

    public function tweet()
    {
    	$token = $this->tweetService->getToken();
    	$dataJson = collect($this->tweetService->getTweet($token->token))->pluck('text');
        $getTweets = $this->tweetService->getSlicedRandomTweet($dataJson);
        return response()->json($getTweets);
    }
}
