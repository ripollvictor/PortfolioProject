<?php

namespace App\PortfolioManagementContext\Domain\Model\Order;

use http\Exception\InvalidArgumentException;

class Order
{
    public const BUY_ORDER = 'buy';
    public const SELL_ORDER = 'sell';
    private string $id;
    private string $portfolioId;
    private string $allocationId;
    private int $shares;
    private string $type;
    private bool $completed;

    public function __construct(string $id, string $portfolioId, string $allocationId, int $shares, string $type)
    {
        $this->id = $id;
        $this->portfolioId = $portfolioId;
        $this->allocationId = $allocationId;
        $this->shares = $shares;
        $this->type = $type;
        $this->completed = false;
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

    public function isCompleted(): bool
    {
        return $this->completed;
    }

    public function setCompleted(bool $completed): void
    {
        $this->completed = $completed;
    }


}