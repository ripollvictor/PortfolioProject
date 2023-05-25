<?php

namespace App\PortfolioManagementContext\Domain\Model\Portfolio;

class Allocation
{
    private string $id;
    private int $shares;

    private Portfolio $portfolio;

    public function __construct(string $id, int $shares, Portfolio $portfolio)
    {
        $this->id = $id;
        $this->shares = $shares;
        $this->portfolio = $portfolio;
    }


    public function getId(): string
    {
        return $this->id;
    }

    public function getShares(): int
    {
        return $this->shares;
    }

    public function getPortfolio(): Portfolio
    {
        return $this->portfolio;
    }




}