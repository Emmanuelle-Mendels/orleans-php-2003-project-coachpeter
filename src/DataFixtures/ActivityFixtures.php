<?php

namespace App\DataFixtures;

use App\Entity\Activity;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Common\DataFixtures\DependentFixtureInterface;
use Doctrine\Common\Persistence\ObjectManager;
use Faker;

class ActivityFixtures extends Fixture implements DependentFixtureInterface
{
    public function load(ObjectManager $manager)
    {
        $faker  =  Faker\Factory::create('fr_FR');
        for ($i=0; $i<=20; $i++) {
            $activity = new Activity();
            $activity->setTitle($faker->realtext(30));
            $activity->setDescription($faker->realtext(500));
            $activity->setPicture('5efb4c78016b8221718658.jpg');
            $activity->setPictogram('haltere');
            $activity->setFocus(1);
            $activity->setCategory($this->getReference(rand(1, 10)));
            $manager->persist($activity);
        }
        $manager->flush();
    }

    public function getDependencies()
    {
        return [CoachingCategoryFixtures::class];
    }
}
