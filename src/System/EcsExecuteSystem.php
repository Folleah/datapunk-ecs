<?php declare(strict_types=1);

namespace Invariance\Datapunk\Ecs\System;

use Invariance\Datapunk\Ecs\EcsContext;

interface EcsExecuteSystem extends EcsSystem
{
    public function execute(EcsContext $context): void;
}
