<?php

    namespace App\PortfolioManagementContext\Infrastructure\Domain\Model\Portfolio;

use App\PortfolioManagementContext\Domain\Model\Portfolio\Portfolio;
use App\PortfolioManagementContext\Domain\Model\Portfolio\PortfolioRepository;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;
class DoctrinePortfolioRepository extends ServiceEntityRepository implements PortfolioRepository
{

    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, Portfolio::class);
    }

    public function byId(string $id): ?Portfolio
    {
    return $this->find($id);
    }

    public function all(): array {
        return $this->findAll();
    }

    public function save(Portfolio $portfolio): void
    {
        $this->_em->persist($portfolio);
        $this->_em->flush();
    }
}