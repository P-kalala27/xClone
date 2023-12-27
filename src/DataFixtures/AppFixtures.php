<?php

namespace App\DataFixtures;

use App\Entity\MicroPost;
use DateTime;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Persistence\ObjectManager;

class AppFixtures extends Fixture
{
    public function load(ObjectManager $manager): void
    {
        $micropost = new MicroPost();
        $micropost->setTitle('First post');
        $micropost->setText('welcom welcom welcom');
        $micropost->setCreated(new DateTime());
        $manager->persist($micropost);

        $micropost4 = new MicroPost();
        $micropost4->setTitle('Jesus is king');
        $micropost4->setText('he give me life');
        $micropost4->setCreated(new DateTime());
        $manager->persist($micropost4);

        $micropost2 = new MicroPost();
        $micropost2->setTitle('weird think a seen');
        $micropost2->setText('then i was like');
        $micropost2->setCreated(new DateTime());
        $manager->persist($micropost2);

        $micropost3 = new MicroPost();
        $micropost3->setTitle('Happy or not');
        $micropost3->setText('Marry christmas yal');
        $micropost3->setCreated(new DateTime());
        $manager->persist($micropost3);

        $manager->flush();
    }
}
