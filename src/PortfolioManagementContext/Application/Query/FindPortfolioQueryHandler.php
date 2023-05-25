<?php

namespace App\PortfolioManagementContext\Application\Query;

use App\PortfolioManagementContext\Domain\Model\Portfolio\PortfolioRepository;
use App\Shared\Domain\Bus\Query\QueryHandler;
use App\Shared\Domain\Bus\Query\Response;
use App\Shared\Infrastructure\Bus\Query\JsonResponse;

class FindPortfolioQueryHandler implements QueryHandler
{

    private PortfolioRepository $portfolioRepository;

    public function __construct(PortfolioRepository $portfolioRepository)
    {
        $this->portfolioRepository = $portfolioRepository;
    }


    public function __invoke(FindPortafolioQuery $query): ?Response
    {
        $portfolio = $this->portfolioRepository->byId($query->getId());

        return new JsonResponse($portfolio);
    }


}