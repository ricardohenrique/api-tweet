# API Tweet

API to make tweets
### Installation

This API requires [PHP](http://www.php.net/) v7.0+ to run.

Clone the project:
```sh
$ git clone https://github.com/ricardohenrique/api-tweet.git
```

Go to folder:
```sh
$ cd api-tweet
```

Install the dependencies:
```sh
$ composer install
```

Create your .env:
```sh
$ cp .env.example .env
```

Create your app key:
```sh
$ php artisan key:generate
```

### API Resources


| Method | URI | Description |
| ------ | ------ | ------ |
| GET | [/api/tweet](#get-tweet) | List all tweets |


### GET /api/tweet

Example: /api/tweet

Request body Response Success:
Status Code: 200

    {
        "0": "Tweet #1: @correfrotinha, Olá, sua informação foi",
        "1": "Tweet #2: registrada para providências. Agradecemos o",
        "2": "Tweet #3: contato."
    }
