<?php

declare(strict_types=1);

namespace App\Tests;

use ApiPlatform\Core\Bridge\Symfony\Bundle\Test\ApiTestCase;
use App\Entity\Greeting;
use App\Entity\GreetingId;
use Doctrine\ORM\EntityManager;
use Doctrine\ORM\EntityRepository;
use PHPUnit\Framework\TestCase;

final class GreetingTest extends ApiTestCase
{
    public function testGetCollection(): void
    {
        $this->addGreeting();

        $response = self::createClient()->request(
            'GET',
            '/greetings',
            ['base_uri' => 'http://127.0.0.1',]
        );

        $this->assertResponseIsSuccessful();
        // Asserts that the returned content type is JSON-LD (the default)
        $this->assertResponseHeaderSame('content-type', 'application/ld+json; charset=utf-8');

        // Asserts that the returned JSON is a superset of this one
        $this->assertJsonContains([
            '@context' => '/contexts/Greeting',
            '@id' => '/greetings',
            '@type' => 'hydra:Collection',
        ]);

        // Asserts that the returned JSON is validated by the JSON Schema generated for this resource by API Platform
        // This generated JSON Schema is also used in the OpenAPI spec!
        $this->assertMatchesResourceCollectionJsonSchema(Greeting::class);
    }

    private function addGreeting(): void
    {
        self::bootKernel();
        /** @var EntityManager $entityManager */
        $entityManager = self::$container->get('doctrine')->getManager();

        $greeting = new Greeting(
            new GreetingId(10),
            'Hola',
        );

        $entityManager->persist($greeting);
        $entityManager->flush();
    }
}
