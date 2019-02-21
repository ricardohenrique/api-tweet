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

Example: /api/products

Request body Response Success:
Status Code: 200

     [
        {
            "lm": 9001,
            "name": "Teste name 01",
            "free_shipping": 0,
            "description": "Teste Description 01",
            "price": 100
        },
        {
            "lm": 9002,
            "name": "Teste name 02",
            "free_shipping": 1,
            "description": "Teste Description 02",
            "price": 200
        }
    ]
