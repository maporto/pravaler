<?php

use Illuminate\Database\Seeder;
use App\Instituicao as InstituicaoEntity;

class InstituicaoSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $faker = \Faker\Factory::create('pt_BR');
        for ($i = 0; $i < 50; $i++) {
			InstituicaoEntity::create([
				'nome' => $faker->name,
				'cnpj'  => $faker->cnpj(true),
				// 'sexo' => rand(0, 1) ? 'M' : 'F',
				// 'dataNascimento' => $faker->date(),
				// 'celular' => $faker->cellphoneNumber(false),
				// 'rg' => '12345678911',
				// 'email' => $faker->email(),
			]);
		}
    }
}
