<?php

namespace App\PortfolioManagementContext\Domain\Command\Order;

use App\Shared\Domain\Bus\Command\Command;

class CompleteOrderCommand implements Command
{
    private string $id;

    private bool $completed;

    public function __construct(string $id, bool $completed)
    {
        $this->id = $id;
        $this->completed = $completed;
    }

    public function getId(): string
    {
        return $this->id;
    }

    public function isCompleted(): bool
    {
        return $this->completed;
    }

}