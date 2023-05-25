<?php

namespace App\PortfolioManagementContext\Application\Command;

use App\PortfolioManagementContext\Domain\Command\Portfolio\CreatePortfolioCommand;
use App\PortfolioManagementContext\Domain\Model\Portfolio\Portfolio;
use App\PortfolioManagementContext\Domain\Model\Portfolio\PortfolioRepository;
use App\Shared\Domain\Bus\Command\CommandHandler;

class CreatePortfolioCommandHandler implements CommandHandler
{

    private PortfolioRepository $portfolioRepository;

    public function __construct(PortfolioRepository $portfolioRepository)
    {
        $this->portfolioRepository = $portfolioRepository;
    }

    public function __invoke(CreatePortfolioCommand $command): void
    {
        $portfolio = new Portfolio($command->getId());
        $this->portfolioRepository->save($portfolio);
    }


}