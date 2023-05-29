<?php

namespace App\PortfolioManagementContext\Application\Query\Portfolio;

use App\PortfolioManagementContext\Domain\Model\Portfolio\PortfolioRepository;
use App\PortfolioManagementContext\Domain\Query\FindAllPortfoliosQuery;
use App\Shared\Domain\Bus\Query\QueryHandler;
use App\Shared\Domain\Bus\Query\Response;
use App\Shared\Infrastructure\Bus\Query\JsonResponse;

class FindAllPortfoliosQueryHandler implements QueryHandler
{

    private PortfolioRepository $portfolioRepository;

    public function __construct(PortfolioRepository $portfolioRepository)
    {
        $this->portfolioRepository = $portfolioRepository;
    }


    public function __invoke(FindAllPortfoliosQuery $query): ?Response
    {
        $portfolio = $this->portfolioRepository->all();

        return new JsonResponse($portfolio);
    }


}