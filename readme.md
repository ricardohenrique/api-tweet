# API Tweet

API to make tweets
### Installation

This API requires [Docker](https://www.docker.com/).

Clone the project:
```sh
$ git clone https://github.com/ricardohenrique/api-tweet.git
```

Go to folder:
```sh
$ cd api-tweet
```

Execute image:
```sh
$ docker build -t zuldigital/engineer-exam .
```

Run server:
```sh
$ docker run -p 8484:8484 —rm zuldigital/engineer-exam
```

Access the url http://0.0.0.0:8484/api/tweet


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
