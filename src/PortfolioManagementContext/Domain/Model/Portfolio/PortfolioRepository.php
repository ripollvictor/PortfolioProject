<?php

namespace App\PortfolioManagementContext\Domain\Model\Portfolio;

interface PortfolioRepository
{
    public function byId(string $id): ?Portfolio;
    public function save(Portfolio $portfolio): void;
}