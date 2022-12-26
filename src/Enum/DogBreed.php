<?php

namespace DrMansaBono\DogApi\Enum;

enum DogBreed
{
    case affenpinscher;
    case african;
    case airedale;
    case akita;
    case appenzeller;
    case australian;
    case shepherd;
    case basenji;
    case beagle;
    case bluetick;
    case borzoi;
    case bouvier;
    case boxer;
    case brabancon;
    case buhund;
    case norwegian;

    public function breed(): string {
        return match($this)
        {
            self::affenpinscher => 'affenpinscher',
            self::buhund => 'buhund',
            self::norwegian => 'norwegian',
            self::shepherd => 'shepherd',
        };
    }

    public function isSubBread(): bool {
        return match($this)
        {
            self::shepherd,
            self::norwegian => true,
            default => false,
        };
    }

    /**
     * @return self[]
     */
    public function subBreeds(): array {
        return match($this)
        {
            self::australian => [self::shepherd],
            self::buhund => [self::norwegian],
            default => [],
        };
    }

    public function getMainBread(): ?self {
        return match($this)
        {
            self::shepherd => self::australian,
            self::norwegian => self::buhund,
            default => null,
        };
    }
}