<?php

namespace App\PortfolioManagementContext\Application\Command\Portfolio;

use App\PortfolioManagementContext\Domain\Command\Portfolio\UpdatePortfolioCommand;
use App\PortfolioManagementContext\Domain\Exception\PortfolioNotFoundException;
use App\PortfolioManagementContext\Domain\Model\Portfolio\PortfolioRepository;
use App\Shared\Domain\Bus\Command\CommandHandler;

class UpdatePortfolioCommandHandler implements CommandHandler
{

    private PortfolioRepository $portfolioRepository;

    public function __construct(PortfolioRepository $portfolioRepository)
    {
        $this->portfolioRepository = $portfolioRepository;
    }

    public function __invoke(UpdatePortfolioCommand $command): void
    {
        $portfolio = $this->portfolioRepository->byId($command->getId());

        if (!$portfolio) {
            throw new PortfolioNotFoundException();
        }

        $portfolio->setAllocations($command->getAllocations());

        $this->portfolioRepository->save($portfolio);
    }


}