<?php

namespace App\Story;

use App\Factory\AlbumFactory;
use Zenstruck\Foundry\Story;

final class DefaultAlbumsStory extends Story
{
    public function build(): void
    {
        AlbumFactory::createMany(10);
    }
}
