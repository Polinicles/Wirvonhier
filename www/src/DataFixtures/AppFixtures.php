<?php

namespace App\DataFixtures;

use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Common\Persistence\ObjectManager;
use Wirvonhier\Domain\Entity\Event;
use Wirvonhier\Domain\Entity\Place;
use Wirvonhier\Domain\Entity\Post;
use Wirvonhier\Domain\Entity\User;

class AppFixtures extends Fixture
{
    /* Create some basic entities for tests */
    public function load(ObjectManager $manager)
    {
        for ($i = 0; $i < 10; $i++) {
            $user = new User();
            $user->setEmail('user'.$i.'@mail.com');
            $manager->persist($user);
            $place = new Place();
            $place->setType('type'.$i);
            $place->setLatitude((float)'41.43674'.$i);
            $place->setLongitude((float)'2.17826'.$i);
            $manager->persist($place);
            $event = new Event();
            $event->setType('type'.$i);
            $event->setPlace($place);
            $manager->persist($event);
            $post  = new Post();
            $post->setAuthor($user);
            $post->setEvent($event);
            $manager->persist($post);
        }

        $manager->flush();
    }
}
