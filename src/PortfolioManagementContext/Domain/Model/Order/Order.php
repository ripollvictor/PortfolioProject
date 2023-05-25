<?php

namespace App\PortfolioManagementContext\Domain\Model\Order;

class Order
{
    private string $id;
    private string $portfolio;
    private string $allocation;
    private int $shares;
    private string $type;
    private bool $completed;

    public function __construct(string $id, string $portfolio, string $allocation, int $shares, string $type, bool $completed)
    {
        $this->id = $id;
        $this->portfolio = $portfolio;
        $this->allocation = $allocation;
        $this->shares = $shares;
        $this->type = $type;
        $this->completed = $completed;
    }

    public function getId(): string
    {
        return $this->id;
    }

    public function getPortfolio(): string
    {
        return $this->portfolio;
    }

    public function getAllocation(): string
    {
        return $this->allocation;
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



}