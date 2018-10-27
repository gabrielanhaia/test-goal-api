<?php

use App\AccessType as AccessTypeModel;
use Illuminate\Database\Seeder;

class UserTypeSeed extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $types = ['user', 'admin', 'developer'];

        foreach ($types as $type) {
            AccessTypeModel::create([
                'type' => $type
            ]);
        }
    }
}
