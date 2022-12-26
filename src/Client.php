<?php

namespace DrMansaBono\DogApi;

use DrMansaBono\DogApi\Entity\Dog;
use DrMansaBono\DogApi\Enum\DogBreed;
use Laminas\Http\Client as HttpClient;
use Spatie\Image\Image;

class Client
{
    private const BASE_URL = 'https://dog.ceo/api/breed';

    private HttpClient $client;

    private DogBreed $breed;

    public function __construct(private readonly Dog $dog) {
        $this->client = new HttpClient();
        $this->breed = $this->dog->getBreed();


        $this->client->setOptions(options:[
            'maxredirects' => 0,
            'timeout'      => 30,
        ]);
    }

    final public function get(): self {
        if ($this->breed->isSubBread() && $this->breed->getMainBread()) {
            $uri = sprintf(
                '%s/%s/%s/images',
                self::BASE_URL,
                $this->breed->getMainBread()->breed(),
                $this->breed->breed(),
            );
        } else {
            $uri = sprintf(
                '%s/%s/images',
                self::BASE_URL,
                $this->breed->breed()
            );
        }

        $this->client->setUri(
            uri: $uri
        );

        return $this;
    }

    final public function random(int $totalImages = 1): self {
        if ($this->breed->isSubBread() && $this->breed->getMainBread()) {
            $uri = sprintf(
                '%s/%s/%s/images/random/%s',
                self::BASE_URL,
                $this->breed->getMainBread()->breed(),
                $this->breed->breed(),
                $totalImages === 1 ? '' : $totalImages,
            );
        } else {
            $uri = sprintf(
                '%s/%s/images/random/%s',
                self::BASE_URL,
                $this->breed->breed(),
                $totalImages === 1 ? '' : $totalImages,
            );
        }

        $this->client->setUri(
            uri: $uri
        );

        return $this;
    }

    final public function execute(): Dog
    {
        $response = $this->client->send();

        $responseObject = json_decode($response->getBody());

        $images = [];
        if (count($responseObject->message) > 0) {
            foreach ($responseObject->message as $image) {
                $images[] = Image::load($image);
            }
        }

        $this->dog->setImages($images);

     return $this->dog;
    }
}