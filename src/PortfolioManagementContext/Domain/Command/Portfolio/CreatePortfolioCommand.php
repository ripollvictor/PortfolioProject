<?php

namespace App\PortfolioManagementContext\Domain\Command\Portfolio;

use App\Shared\Domain\Bus\Command\Command;

class CreatePortfolioCommand implements Command
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