<?php

namespace Lemonmind\PimcoreSimpleSeoBundle\SeoMetaGenerator;

class TitlePatternConfiguration
{
    private ?string $before;
    private ?string $after;

    public function __construct(array $configuration)
    {
        $this->before = $configuration['before'];
        $this->after = $configuration['after'];
    }

    public function getBefore(): ?string
    {
        return $this->before;
    }

    public function getAfter(): ?string
    {
        return $this->after;
    }
}
