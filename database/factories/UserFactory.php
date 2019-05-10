<?php

/* @var $factory \Illuminate\Database\Eloquent\Factory */

use App\Models\User as UserAlias;
use Illuminate\Support\Str;
use Faker\Generator as Faker;

/*
|--------------------------------------------------------------------------
| Models Factories
|--------------------------------------------------------------------------
|
| This directory should contain each of the model factory definitions for
| your application. Factories provide a convenient way to generate new
| model instances for testing / seeding your application's database.
|
*/
$persianFactory = \Faker\factory::create('fa_IR');
$factory->define(UserAlias::class, function (Faker $faker) use ($persianFactory) {
    return [
        'name'     => $persianFactory->name,
        'email'    => $faker->unique()->safeEmail,
        'password' => '$2y$10$92IXUNpkjO0rOQ5byMi.Ye4oKoEa3Ro9llC/.og/at2.uheWG/igi',
        'mobile'   => $persianFactory->mobileNumber,
    ];
});
