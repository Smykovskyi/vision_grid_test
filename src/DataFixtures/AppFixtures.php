<?php

namespace App\DataFixtures;

use App\Entity\Carrier;
use App\Entity\Price;
use App\ValueObject\Money;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Persistence\ObjectManager;

class AppFixtures extends Fixture
{
    public function load(ObjectManager $manager): void
    {
        $transcompany = new Carrier();
        $transcompany->setTitle('Transcompany');

        $packgroup = new Carrier();
        $packgroup->setTitle('Packgroup');


        $pricePackgroup = new Price(new Money(100, 'EUR'));
        $pricePackgroup->setTitle('PackGroup price');
        $pricePackgroup->setCarrier($packgroup);
        $pricePackgroup->setDescription('1 EUR per 1 kg');

        $priceTranscompany = new Price(new Money(2000, 'EUR'));
        $priceTranscompany->setTitle('Transcompany price');
        $priceTranscompany->setCarrier($transcompany);
        $priceTranscompany->setDescription('if parcel weight is <= 10 kg → 20 EUR');

        $priceTranscompany1 = new Price(new Money(10000, 'EUR'));
        $priceTranscompany1->setTitle('Transcompany price 1');
        $priceTranscompany1->setCarrier($transcompany);
        $priceTranscompany1->setDescription('if parcel weight is > 10 kg → 100 EUR');


        $manager->persist($transcompany);
        $manager->persist($packgroup);
        $manager->persist($pricePackgroup);
        $manager->persist($priceTranscompany);
        $manager->persist($priceTranscompany1);
        $manager->flush();
    }
}
