<?php

namespace App\Tests\PortfolioManagementContext\Application\Command\Portfolio;

use App\PortfolioManagementContext\Application\Command\Portfolio\UpdatePortfolioCommandHandler;
use App\PortfolioManagementContext\Domain\Command\Portfolio\UpdatePortfolioCommand;
use App\PortfolioManagementContext\Domain\Exception\PortfolioNotFoundException;
use App\PortfolioManagementContext\Domain\Model\Portfolio\Allocation;
use App\PortfolioManagementContext\Domain\Model\Portfolio\Portfolio;
use App\PortfolioManagementContext\Domain\Model\Portfolio\PortfolioRepository;
use PHPUnit\Framework\TestCase;

class UpdatePortfolioCommandHandlerTest extends TestCase
{
    public function testInvoke(): void
    {
        $portfolioId = 'aPortfolioId';
        $existingPortfolio = new Portfolio($portfolioId);
        $allocations = [new Allocation('anAllocationId', 1, $existingPortfolio)];
        $command = new UpdatePortfolioCommand($portfolioId, $allocations);


        $portfolioRepositoryMock = $this->createMock(PortfolioRepository::class);
        $portfolioRepositoryMock->method('byId')
            ->with($portfolioId)
            ->willReturn($existingPortfolio);

        $portfolioRepositoryMock->expects($this->once())
            ->method('save')
            ->with($existingPortfolio);

        $handler = new UpdatePortfolioCommandHandler($portfolioRepositoryMock);

        $handler->__invoke($command);

        $this->assertEquals($allocations, $existingPortfolio->getAllocations()->toArray());
    }

    public function testInvokeWithNonExistingPortfolio(): void
    {
        $portfolioId = 'aPortfolioId';
        $existingPortfolio = new Portfolio($portfolioId);
        $allocations = [new Allocation('anAllocationId', 1, $existingPortfolio)];
        $command = new UpdatePortfolioCommand($portfolioId, $allocations);

        $portfolioRepositoryMock = $this->createMock(PortfolioRepository::class);
        $portfolioRepositoryMock->method('byId')
            ->with($portfolioId)
            ->willReturn(null);

        $portfolioRepositoryMock->expects($this->never())
            ->method('save');

        $handler = new UpdatePortfolioCommandHandler($portfolioRepositoryMock);

        $this->expectException(PortfolioNotFoundException::class);

        $handler->__invoke($command);
    }
}
