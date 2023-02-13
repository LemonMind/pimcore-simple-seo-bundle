<?php

namespace Lemonmind\PimcoreSimpleSeoBundle\Model;

use Pimcore\Model\Asset\Image;

interface ObjectSeoInterface
{
    public function getSeoTitle(): ?string;

    public function getSeoDescription(): ?string;

    public function getSeoKeywords(): ?string;

    public function getSeoImage(): ?Image;
}
