<?php

use Illuminate\Database\Seeder;

use App\User;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $users = [
            [
                'name' => 'Lorenzo',
                'lastname' => 'Antonelli',
                'email' => 'lorenzo@mail.com',
                'password'=> bcrypt('password123'),
                'company_name' => 'Jumbotron S.R.L',
                'address_head_office' => 'Via Roma 21',
                'p_iva' => '10692170011'
            ],
            [
                'name' => 'Nicola',
                'lastname' => 'Milani',
                'email' => 'nicola@mail.com',
                'password'=> bcrypt('password123'),
                'company_name' => 'Milani S.R.L',
                'address_head_office' => 'Via Garibaldi 33',
                'p_iva' => '10692170021'
            ],
            [
                'name' => 'Jacopo',
                'lastname' => 'Zandonà',
                'email' => 'jacopo@mail.com',
                'password'=> bcrypt('password123'),
                'company_name' => 'Zandonà S.R.L',
                'address_head_office' => 'Via Pò 44',
                'p_iva' => '10692170034'
            ],
            [
                'name' => 'Simone',
                'lastname' => 'Marzolla',
                'email' => 'simone@mail.com',
                'password'=> bcrypt('password123'),
                'company_name' => 'Swinow S.R.L',
                'address_head_office' => 'Corso Fiume 211',
                'p_iva' => '10692170067'
            ],
            [
                'name' => 'Giordano',
                'lastname' => 'Vita',
                'email' => 'giordano@mail.com',
                'password'=> bcrypt('password123'),
                'company_name' => 'Vita S.R.L',
                'address_head_office' => 'Corso Vittorio Emanuele 311',
                'p_iva' => '10692170099'
            ],
        ];

        foreach ($users as $key => $user) {
            User::create($user);
        }
    }
}
