<?php

namespace App\PortfolioManagementContext\Domain\Model\Portfolio;

use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;

class Portfolio
{

    private string $id;
    private Collection $allocations;

    public function __construct(string $id)
    {
        $this->id = $id;
        $this->allocations = new ArrayCollection();
    }

    public function getId(): string
    {
        return $this->id;
    }

    public function getAllocations(): Collection
    {
        return $this->allocations;
    }

    public function setAllocations(array $allocations): void
    {
        $this->removeAllocations();
        /** @var Allocation $allocation */
        foreach ($allocations as $allocation) {
            $this->allocations->add(new Allocation($allocation->getId(), $allocation->getShares(), $this));
        }
    }

    public function removeAllocation(Allocation $allocation): void
    {
        $this->allocations->removeElement($allocation);
    }

    private function removeAllocations(): void
    {
        foreach ($this->allocations as $allocation)
            $this->allocations->removeElement($allocation);
    }


}