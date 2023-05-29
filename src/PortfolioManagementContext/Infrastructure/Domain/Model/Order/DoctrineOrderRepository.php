<?php

    namespace App\PortfolioManagementContext\Infrastructure\Domain\Model\Order;

use App\PortfolioManagementContext\Domain\Model\Order\Order;
use App\PortfolioManagementContext\Domain\Model\Order\OrderRepository;
use App\PortfolioManagementContext\Domain\Model\Portfolio\Portfolio;
use App\PortfolioManagementContext\Domain\Model\Portfolio\PortfolioRepository;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;
class DoctrineOrderRepository extends ServiceEntityRepository implements OrderRepository
{

    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, Order::class);
    }

    public function byId(string $id): ?Order
    {
    return $this->find($id);
    }

    public function all(): array {
        return $this->findAll();
    }

    public function save(Order $order): void
    {
        $this->_em->persist($order);
        $this->_em->flush();
    }
}