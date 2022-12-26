<?php

namespace DrMansaBono\DogApi\Entity;

use DrMansaBono\DogApi\Enum\DogBreed;
use Spatie\Image\Image;

class Dog
{
    /**
     * @var  Image[] $images
     */
    private array $images = [];

    public function __construct(private readonly DogBreed $breed)
    {
    }

    public function hasImages(): bool
    {
        return count($this->images) > 0;
    }

    /**
     * @param Image[] $images
     */
    final public function setImages(array $images): self
    {
        $this->images = $images;
        return $this;
    }

    /**
     * @return Image[]
     */
    final public function getImages(): array
    {
        return $this->images;
    }

    public function isSubBreed(): bool {
        return $this->breed->isSubBread();
    }

    final public function getBreed(): DogBreed
    {
        return $this->breed;
    }
}