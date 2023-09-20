<?php

namespace Database\Seeders;

use App\Models\BusinessProfile;
use App\Models\User;
use Illuminate\Database\Seeder;
use Faker\Factory as Faker;
use Illuminate\Support\Facades\Hash;

class CompanySeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
      $faker= Faker::create();
    for($i=0; $i<50; $i++){
        $user= new User;
       $user->email= $faker->companyEmail;           ;
       $user->password=Hash::make($faker->password);
       $user->save();

       $business_profile= new BusinessProfile;
       $business_profile->user_id=$user['id'];
       $business_profile->business_name=$faker->name;
       $business_profile->business_type=$faker->word;
       $business_profile->address=$faker->address;
       $business_profile->city=$faker->city;
       $business_profile->post_code=$faker->postcode;                          ;
       $business_profile->country=$faker->country;
       $business_profile->primary_phone=$faker->phoneNumber;
       $business_profile->business_type=$faker->word;
       $business_profile->save();
    }
       
       
    }
}
