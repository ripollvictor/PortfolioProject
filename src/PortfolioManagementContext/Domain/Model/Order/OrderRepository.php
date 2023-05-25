<?php

namespace App\PortfolioManagementContext\Domain\Model\Order;

interface OrderRepository
{
    public function byId(int $id): ?Order;

    public function save(Order $portfolio): void;
}