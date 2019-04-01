<?php

use App\{
    AccessType as AccessTypeModel, User as UserModel
};
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;
class UserSeed extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $users = UserModel::get();

        if($users->count() == 0) {
            $adminTypeAccess = AccessTypeModel::where('type', 'admin')->first();
            $userTypeAccess = AccessTypeModel::where('type', 'admin')->first();

            UserModel::create([
                'name'  => 'Admin',
                'email' => 'admin@goal.com',
                'password' => Hash::make('123123'),
                'access_type_id' => $adminTypeAccess->id,
                'description' => '.',
                'api_token' => '.',
            ]);

            UserModel::create([
                'name'  => 'User',
                'email' => 'user@goal.com',
                'password' => Hash::make('123123'),
                'access_type_id' => $userTypeAccess->id,
                'description' => '.',
                'api_token' => '.'
            ]);
        }
    }
}
