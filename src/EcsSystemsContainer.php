<?php declare(strict_types=1);

namespace Invariance\Datapunk\Ecs;

use Invariance\Datapunk\Ecs\Exception\EcsException;
use Invariance\Datapunk\Ecs\Filter\EcsFilteredResult;
use Invariance\Datapunk\Ecs\Filter\EcsFilterIncluded;
use Invariance\Datapunk\Ecs\System\EcsExecuteSystem;
use Invariance\Datapunk\Ecs\System\EcsInitSystem;
use Invariance\Datapunk\Ecs\System\EcsSystem;

final class EcsSystemsContainer
{
    private EcsContext $context;
    /** @var EcsSystem[] */
    private array $systems;
    private bool $isInitialized = false;

    public function __construct(EcsContext $context)
    {
        $this->context = $context;
    }

    public function add(EcsSystem $system): self
    {
        $this->systems[] = $system;
        return $this;
    }

    public function init(): void
    {
        if ($this->isInitialized) {
            throw new EcsException("Systems already initialized.");
        }

        foreach ($this->systems as $system) {
            if ($system instanceof EcsInitSystem) {
                $system->init($this->context);
            }
        }

        $this->isInitialized = true;
    }

    public function execute(): void
    {
        if (!$this->isInitialized) {
            throw new EcsException("EcsSystems should be initialized before.");
        }

        foreach ($this->systems as $system) {
            if ($system instanceof EcsExecuteSystem) {
                $system->execute($this->context);
            }
        }
    }
}
