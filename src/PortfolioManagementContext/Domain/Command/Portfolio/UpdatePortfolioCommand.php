<?php

namespace App\PortfolioManagementContext\Domain\Command\Portfolio;

use App\Shared\Domain\Bus\Command\Command;

class UpdatePortfolioCommand implements Command
{
    private string $id;

    private array $allocations;

    public function __construct(string $id, array $allocations)
    {
        $this->id = $id;
        $this->allocations = $allocations;
    }

    public function getId(): string
    {
        return $this->id;
    }

    public function getAllocations(): array
    {
        return $this->allocations;
    }

}