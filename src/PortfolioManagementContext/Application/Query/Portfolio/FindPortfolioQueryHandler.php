<?php

namespace App\PortfolioManagementContext\Application\Query\Portfolio;

use App\PortfolioManagementContext\Domain\Model\Portfolio\PortfolioRepository;
use App\PortfolioManagementContext\Domain\Query\FindPortfolioQuery;
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


    public function __invoke(FindPortfolioQuery $query): ?Response
    {
        $portfolio = $this->portfolioRepository->byId($query->getId());

        if (!$portfolio)
            return new JsonResponse("", 404);

        return new JsonResponse($portfolio);
    }


}