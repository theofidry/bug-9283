<?php

declare(strict_types=1);

namespace App\Serializer;

use App\Entity\GreetingId;
use Symfony\Component\Serializer\Normalizer\DenormalizerInterface;
use Symfony\Component\Serializer\Normalizer\NormalizerInterface;

final class GreetingNormalizer implements DenormalizerInterface, NormalizerInterface
{
    public function supportsNormalization($data, string $format = null)
    {
        return $data instanceof GreetingId;
    }

    /**
     * @param GreetingId $id
     */
    public function normalize($id, string $format = null, array $context = [])
    {
        return $id->toInt();
    }

    public function supportsDenormalization($data, string $type, string $format = null)
    {
        return $type === GreetingId::class;
    }

    public function denormalize($data, string $type, string $format = null, array $context = [])
    {
        return new GreetingId((int) $data);
    }
}
