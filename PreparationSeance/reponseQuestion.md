1)
Il s'installe avec composer :
composer require fakerphp/faker

2)
$faker = Faker\Factory::create('en_US');
for ($i = 0; $i < 3; $i++) {
    echo $faker->name() . "\n";
}

3) 
$date = DateTime =  new DateTime('2011-01-01T15:03:01.012345Z');
$date->format("Y-m-d(H:M)");

