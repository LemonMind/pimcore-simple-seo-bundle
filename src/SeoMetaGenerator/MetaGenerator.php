<?php

namespace Lemonmind\PimcoreSimpleSeoBundle\SeoMetaGenerator;

use Leogout\Bundle\SeoBundle\Provider\SeoGeneratorProvider;
use Leogout\Bundle\SeoBundle\Seo\Basic\BasicSeoGenerator;
use Leogout\Bundle\SeoBundle\Seo\Og\OgSeoGenerator;
use Leogout\Bundle\SeoBundle\Seo\Twitter\TwitterSeoGenerator;

class MetaGenerator implements SeoMetaGeneratorInterface
{
    private SeoGeneratorProvider $seoGeneratorProvider;
    private ?string $title = null;
    private ?string $description = null;
    private ?string $url = null;
    private ?string $keywords = null;
    private ?string $image = null;
    private bool $isNoIndex = false;

    private string $thumbnailName;

    public function __construct(array $configuration ,SeoGeneratorProvider $seoGeneratorProvider)
    {
        $this->seoGeneratorProvider = $seoGeneratorProvider;
        $this->thumbnailName = $configuration['thumbnail_name'];
    }

    public function generate(): void
    {
        if (is_null($this->title) || is_null($this->url)) {
            return;
        }

        /**
         * @var BasicSeoGenerator $basic
         */
        $basic = $this->seoGeneratorProvider->get('basic');
        $basic->setTitle($this->title)
            ->setCanonical($this->url);

        if (!is_null($this->keywords)) {
            $basic->setKeywords($this->keywords);
        }

        if ($this->isNoIndex) {
            $basic->setRobots(false, false);
        }

        /**
         * @var TwitterSeoGenerator $twitter
         */
        $twitter = $this->seoGeneratorProvider->get('twitter');
        $twitter
            ->setTitle($this->title)
            ->setCard('summary');

        /**
         * @var OgSeoGenerator $og
         */
        $og = $this->seoGeneratorProvider->get('og');
        $og
            ->setTitle($this->title)
            ->setUrl($this->url)
            ->setType('website');

        if (!is_null($this->description)) {
            $basic->setDescription($this->description);
            $twitter->setDescription($this->description);
            $og->setDescription($this->description);
        }

        if (!is_null($this->image)) {
            $twitter->setImage($this->image);
            $og->setImage($this->image);
        }
    }

    public function setTitle(?string $title): self
    {
        // todo: create pattern ( title + | FirmName )
        $this->title = $title;

        return $this;
    }

    public function setDescription(?string $description): self
    {
        $this->description = $description;

        return $this;
    }

    public function setKeywords(?string $keywords): self
    {
        $this->keywords = $keywords;

        return $this;
    }

    public function setImage(?string $image): self
    {
        $this->image = $image;

        return $this;
    }

    public function setIsNoIndex(bool $isNoIndex): self
    {
        $this->isNoIndex = $isNoIndex;

        return $this;
    }

    public function setUrl(?string $url): self
    {
        $this->url = $url;

        return $this;
    }

    /**
     * @return string
     */
    public function getThumbnailName(): string
    {
        return $this->thumbnailName;
    }
}
