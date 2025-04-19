<?php
namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class PegawaiSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $user = User::create([
            'name'           => 'example',
            'email'          => 'example@gmail.com',
            'password'       => Hash::make('12345678'),
            'id_jabatan'     => null,
            'nip'            => 112233,
            'telepon'        => 8932177,
            'jenis_kelamin'  => 'P',
            'tempat_lahir'   => 'Bandung',
            'tgl_lahir'      => '2000-02-19',
            'status_pegawai' => 1,
            'agama'          => 'islam',
            'profile'        => null,
        ]);

        $user->assignRole('user');

      

    
}
}
