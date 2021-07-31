<?php declare(strict_types=1);

namespace Invariance\Datapunk\Ecs\System;

use Invariance\Datapunk\Ecs\EcsContext;

interface EcsInitSystem extends EcsSystem
{
    public function init(EcsContext $context): void;
}
