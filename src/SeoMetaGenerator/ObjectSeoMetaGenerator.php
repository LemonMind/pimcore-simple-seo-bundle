<?php

namespace Lemonmind\PimcoreSimpleSeoBundle\SeoMetaGenerator;

use Lemonmind\PimcoreSimpleSeoBundle\Model\ObjectSeoInterface;
use Pimcore\Model\Asset\Image;
use Pimcore\Tool;

class ObjectSeoMetaGenerator
{
    private MetaGenerator $seoMetaGenerator;

    public function __construct(MetaGenerator $seoMetaGenerator)
    {
        $this->seoMetaGenerator = $seoMetaGenerator;
    }

    private ?string $backupSeoTitle = null;
    private ?string $backupSeoDescription = null;

    public function generate(ObjectSeoInterface $object, string $url, bool $isNoIndex = false): void
    {
        $title = $object->getSeoTitle();

        if (empty($title) && $this->backupSeoTitle) {
            $title = $this->backupSeoTitle;
        }

        $description = $object->getSeoDescription();

        if (empty($description) && $this->backupSeoDescription) {
            $description = $this->backupSeoDescription;
        }

        $this->seoMetaGenerator
            ->setTitle($title)
            ->setDescription($description)
            ->setKeywords($object->getSeoKeywords())
            ->setUrl(Tool::getHostUrl() . $url)
            ->setImage($this->prepareImage($object->getSeoImage()))
            ->setIsNoIndex($isNoIndex)
            ->generate();
    }

    public function setBackupSeoTitle(?string $backupSeoTitle): self
    {
        $this->backupSeoTitle = $backupSeoTitle;

        return $this;
    }

    public function setBackupSeoDescription(?string $backupSeoDescription): self
    {
        $this->backupSeoDescription = $backupSeoDescription;

        return $this;
    }

    private function prepareImage(?Image $image): ?string
    {
        if (is_null($image)) {
            return null;
        }

        $thumbnail = $image->getThumbnail($this->seoMetaGenerator->getThumbnailName());

        return Tool::getHostUrl() . $thumbnail->getPath();
    }
}
