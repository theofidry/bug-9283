<?php

declare(strict_types=1);

namespace App\Type;

use App\Entity\GreetingId;
use Doctrine\DBAL\Platforms\AbstractPlatform;
use Doctrine\DBAL\Types\BigIntType;

final class GreetingIdType extends BigIntType
{
    public function getName()
    {
        return 'greeting_id';
    }

    public function convertToPHPValue($value, AbstractPlatform $platform)
    {
        return $value === null ? null : new GreetingId((int) $value);
    }

    public function convertToDatabaseValue($value, AbstractPlatform $platform)
    {
        return $value === null ? $value : $value->toInt();
    }

    public function requiresSQLCommentHint(AbstractPlatform $platform)
    {
        return true;
    }
}
