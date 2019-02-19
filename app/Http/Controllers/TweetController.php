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
        $getTweets = $this->tweetService->getSlicedRandomTweet();
        return response()->json($getTweets);
    }
}
