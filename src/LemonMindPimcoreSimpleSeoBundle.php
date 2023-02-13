<?php

namespace Lemonmind\PimcoreSimpleSeoBundle;

use Pimcore\Extension\Bundle\AbstractPimcoreBundle;
use Pimcore\Extension\Bundle\Traits\PackageVersionTrait;

class LemonMindPimcoreSimpleSeoBundle extends AbstractPimcoreBundle
{
    use PackageVersionTrait;

    public function getComposerPackageName(): string
    {
        return 'lemonmind/pimcore-simple-seo-bundle';
    }

    public function getJsPaths()
    {
        return [
            '/bundles/lemonmindpimcoresimpleseo/js/pimcore/startup.js'
        ];
    }
}
