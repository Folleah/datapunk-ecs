<?php

namespace Invariance\Datapunk\Ecs;

class EcsConfig
{
    public int $entitiesCacheSize = 512;
    public int $componentsPoolCacheSize = 128;
    public int $cachedFiltersSize = 128;
}