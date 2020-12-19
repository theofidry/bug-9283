<?php

declare(strict_types=1);

namespace App\Entity;

use Stringable;

final class GreetingId implements Stringable
{
    private int $value;

    public function __construct(int $value)
    {
        $this->value = $value;
    }

    public function toInt(): int
    {
        return $this->value;
    }

    public function __toString()
    {
        return (string) $this->value;
    }
}
