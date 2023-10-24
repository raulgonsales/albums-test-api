<?php

namespace App\Story;

use App\Factory\ImageFactory;
use Zenstruck\Foundry\Story;

final class DefaultImagesStory extends Story
{
    public function build(): void
    {
        ImageFactory::createMany(50);
    }
}
