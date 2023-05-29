<?php

namespace App\PortfolioManagementContext\Domain\Command\Order;

use App\Shared\Domain\Bus\Command\Command;

class CreateOrderCommand implements Command
{
    private string $id;
    private string $portfolioId;
    private string $allocationId;
    private int $shares;
    private string $type;

    public function __construct(string $id, string $portfolioId, string $allocationId, int $shares, string $type)
    {
        $this->id = $id;
        $this->portfolioId = $portfolioId;
        $this->allocationId = $allocationId;
        $this->shares = $shares;
        $this->type = $type;
    }


    public function getId(): string
    {
        return $this->id;
    }

    public function getPortfolioId(): string
    {
        return $this->portfolioId;
    }

    public function getAllocationId(): string
    {
        return $this->allocationId;
    }

    public function getShares(): int
    {
        return $this->shares;
    }

    public function getType(): string
    {
        return $this->type;
    }

}