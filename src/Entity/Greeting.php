<?php

namespace App\Entity;

use ApiPlatform\Core\Annotation\ApiResource;
use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Validator\Constraints as Assert;

/**
 * @ORM\Entity
 * @ApiResource()
 */
class Greeting
{
    /**
     * The entity ID
     *
     * @ORM\Id
     * @ORM\GeneratedValue
     * @ORM\Column(type="greeting_id")
     */
    public GreetingId $id;

    /**
     * A nice person
     *
     * @ORM\Column
     * @Assert\NotBlank
     */
    public string $name = '';

    public function __construct(GreetingId $id, string $name)
    {
        $this->id = $id;
        $this->name = $name;
    }
}
