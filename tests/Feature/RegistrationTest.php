<?php

namespace Tests\Feature;

use App\Http\Controllers\Auth\RegisterController;
use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;
use Mockery;
use Tests\TestCase;
use Faker\Factory as FakerFactory;

class RegistrationTest extends TestCase
{
    use RefreshDatabase;

    public function testUserRegistration()
    {


        // Przygotowujemy dane testowe
        $faker = FakerFactory::create();

        $data = [
            'name' => $faker->firstName,
            'surname' => $faker->lastName,
            'phone' => $faker->phoneNumber,
            'email' => $faker->email,
            'password' => $faker->password,  // Pamiętaj, że Faker może nie generować bezpiecznych haseł
            'password_confirmation' => $faker->password,
            'city' => $faker->city,
            'zip_code' => $faker->postcode,
            'street' => $faker->streetName,
            'home_number' => $faker->buildingNumber,
        ];

        $user = User::create([
            'name' => $data['name'],
            'surname' => $data['surname'],
            'phone_number' => $data['phone'],
            'email' => $data['email'],
            'password' => Hash::make($data['password']),
        ]);

        $user->address()->create([
            'city' => $data['city'],
            'zip_code' => $data['zip_code'],
            'street' => $data['street'],
            'home_no' => $data['home_number'],
        ]);

        $user->save();

        $this->assertTrue(Hash::check($data['password'], $user->password));
    }
}
