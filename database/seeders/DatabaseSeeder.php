<?php

require_once __DIR__ . '/Seeder.php';
require_once __DIR__ . '/AkunTableSeeder.php';
require_once __DIR__ . '/AdminTableSeeder.php';
require_once __DIR__ . '/UserTableSeeder.php';
require_once __DIR__ . '/KategoriTableSeeder.php';
require_once __DIR__ . '/BukuTableSeeder.php';
require_once __DIR__ . '/PeminjamanTableSeeder.php';
require_once __DIR__ . '/PengembalianTableSeeder.php';

class DatabaseSeeder extends Seeder
{
    public function run()
    {
        $this->call(AkunTableSeeder::class);
        $this->call(AdminTableSeeder::class);
        $this->call(UserTableSeeder::class);
        $this->call(KategoriTableSeeder::class);
        $this->call(BukuTableSeeder::class);
        $this->call(PeminjamanTableSeeder::class);
        $this->call(PengembalianTableSeeder::class);
    }
}
?>