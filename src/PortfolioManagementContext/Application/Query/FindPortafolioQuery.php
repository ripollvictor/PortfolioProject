<?php

namespace App\PortfolioManagementContext\Application\Query;


use App\Shared\Domain\Bus\Query\Query;

class FindPortafolioQuery implements Query
{
    private string $id;

    public function __construct(string $id)
    {
        $this->id = $id;
    }

    public function getId(): string
    {
        return $this->id;
    }

}