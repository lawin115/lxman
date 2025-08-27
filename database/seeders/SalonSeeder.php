<?php
namespace Database\Seeders;
use Illuminate\Database\Seeder;
use App\Models\Service;
use App\Models\Package;

class SalonSeeder extends Seeder
{
    public function run(): void
    {
        Service::create(['name' => 'Sertaşîn', 'description' => 'Qes, şûştin û hişkkirin.', 'price' => 15.00, 'image_url' => 'images/haircut.jpg']);
        Service::create(['name' => 'Reşkirina Rihê', 'description' => 'Stîl û reşkirina rihê.', 'price' => 10.00, 'image_url' => 'images/beard.jpg']);
        Service::create(['name' => 'Hemama Tirkî', 'description' => 'Paqijî û rehetî.', 'price' => 40.00, 'image_url' => 'images/hamam.jpg']);

        Package::create(['name' => 'Pakêja Zava', 'details' => 'Sertaşîn, maskê rûyî, hemam, mesac.', 'price' => 150.00, 'image_url' => 'images/groom.jpg']);
    }
}
```    *   ڤى کۆدی بکاربینە بۆ زێدەکرنا ڤان داتایان:
```bash
php artisan db:seed --class=SalonSeeder