<?php

namespace App\PortfolioManagementContext\Domain\Model\Order;

interface OrderRepository
{
    public function byId(string $id): ?Order;

    public function all(): array;

    public function save(Order $order): void;
}