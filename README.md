# Dog API Client
![Api Key needed](https://img.shields.io/badge/API%20KEY-Not%20needed-red?style=for-the-badge)
![Api Key needed](https://img.shields.io/badge/Free%20API-Yes-green?style=for-the-badge)
![GitHub code size in bytes](https://img.shields.io/github/languages/code-size/dr-mansa-bono/dog-api-client?style=for-the-badge)
![GitHub repo file count](https://img.shields.io/github/directory-file-count/dr-mansa-bono/dog-api-client?style=for-the-badge)

Api Client for the internet's biggest collection of open source dog pictures.

# Usage

```php
use DrMansaBono\DogApi\Client;
use DrMansaBono\DogApi\Entity\Dog;
use DrMansaBono\DogApi\Enum\DogBreed;

$response = (New Client(dog: new Dog(breed: DogBreed::norwegian)))->get()->execute();

$response = (New Client(dog: new Dog(breed: DogBreed::norwegian)))->random(5)->execute();
```