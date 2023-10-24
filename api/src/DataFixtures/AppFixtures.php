<?php

namespace App\DataFixtures;

use App\Story\DefaultAlbumsStory;
use App\Story\DefaultImagesStory;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Persistence\ObjectManager;

class AppFixtures extends Fixture
{
    public function load(ObjectManager $manager): void
    {
        DefaultAlbumsStory::load();
        DefaultImagesStory::load();
    }
}
