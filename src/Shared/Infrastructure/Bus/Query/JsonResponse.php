<?php

namespace App\Shared\Infrastructure\Bus\Query;

use App\Shared\Domain\Bus\Query\Response;
use JMS\Serializer\Naming\IdenticalPropertyNamingStrategy;
use JMS\Serializer\SerializerBuilder;
use JMS\Serializer\SerializerInterface;

class JsonResponse implements Response
{

    private string $json;
    private SerializerInterface $serializer;

    private int $status;


    public function __construct($data, int $status = 200)
    {
        $serializerbuilder = SerializerBuilder::create();
        $serializerbuilder->setPropertyNamingStrategy(new IdenticalPropertyNamingStrategy());
        $this->serializer = $serializerbuilder->build();
        $this->json = $this->serializer->serialize($data, 'json');
        $this->status = $status;
    }

    public function json(): string
    {
        return $this->json;
    }

    public function status(): int
    {
        return $this->status;
    }

    public function setStatus(int $status): void
    {
        $this->status = $status;
    }

}