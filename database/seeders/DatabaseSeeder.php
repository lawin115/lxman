<?php

namespace Database\Seeders;

use App\Models\User;
use App\Models\Service; // << 1. Vê importê zêde bike
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB; // << 2. Vê importê zêde bike

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        // =======================================================
        // Beşa 1: Çêkirina Bikarhênerên Testê
        // =======================================================
        
        // Em dikarin bikarhênerên testê yên heyî jêbibin da ku dubare nebin
        User::query()->delete();

        // Bikarhênerekî testê yê giştî
        User::factory()->create([
            'name' => 'Bikarhênerê Testê',
            'email' => 'test@example.com',
            'role' => 'patient', // Mînak
        ]);

        // Em dikarin çend bikarhênerên din jî çêbikin
        User::factory()->create([
            'name' => 'Dektor Elî',
            'email' => 'doctor@example.com',
            'role' => 'doctor',
        ]);

        User::factory()->create([
            'name' => 'Skreter Sara',
            'email' => 'secretary@example.com',
            'role' => 'secretary',
        ]);
        
        User::factory(5)->create(['role' => 'patient']); // 5 nexweşên din

        
        // =======================================================
        // Beşa 2: Zêdekirina Xizmetguzariyan
        // =======================================================
 DB::statement('SET FOREIGN_KEY_CHECKS=0;');
        // Valakirina cedwelê berî zêdekirinê
        DB::table('services')->truncate();

        $services = [
            // 1. پشکنین و خۆپاراستن
            ['name' => 'پشکنینا دەستپێکی', 'price' => 25.00],
            ['name' => 'تیرۆژک (ئەشیعە)', 'price' => 15.00],
            ['name' => 'پاقژکرنا ددانان', 'price' => 50.00],
            ['name' => 'چارەسەریا فلۆرایدی', 'price' => 20.00],
            ['name' => 'گرتنا شقارتان (سیلانت)', 'price' => 30.00],
        
            // 2. پڕکرن و راستڤەکرن
            ['name' => 'پڕکرنا ددانی (حەشویێ سپی)', 'price' => 70.00],
            ['name' => 'مراندنا عەسەبی (ددانێ پێشیێ)', 'price' => 200.00],
            ['name' => 'مراندنا عەسەبی (ددانێ پاشیێ)', 'price' => 350.00],
            ['name' => 'تاج (قاپاغ) - زیرکۆن', 'price' => 300.00],
            ['name' => 'پرا ددانان (هەر ددانەک)', 'price' => 250.00],
        
            // 3. دەرئینان و جراحی
            ['name' => 'دەرئینانا ددانێ ئاسایی', 'price' => 60.00],
            ['name' => 'دەرئینانا ددانێ عەقلی (جراحی)', 'price' => 200.00],
            ['name' => 'چاندنا ددانان (ئیمپلانت)', 'price' => 1200.00],
            ['name' => 'زێدەکرنا هەستی (بۆ چاندنێ)', 'price' => 400.00],
        
            // 4. جوانکاری
            ['name' => 'سپی کرنا ددانان', 'price' => 250.00],
            ['name' => 'قەرتا پۆرسەلین (ڤینیر)', 'price' => 450.00],
            ['name' => 'بزڤرینا هۆلیوودی (هۆلیوود سمایل)', 'price' => 4000.00],
            ['name' => 'جوانکرنا ب کۆمپۆزیت (بۆندینگ)', 'price' => 120.00],
        
            // 5. راستڤەکرنا رێزێ (تقویم)
            ['name' => 'تێلکرنا ئاسایی (تقویم)', 'price' => 2000.00],
            ['name' => 'تێلکرنا شەفاف (ئینڤیزلاین)', 'price' => 3500.00],
            ['name' => 'قالبێ پاراستنێ (ریتەینەر)', 'price' => 150.00],
        ];

        // Zêdekirina xizmetguzariyan
        Service::insert($services);
 DB::statement('SET FOREIGN_KEY_CHECKS=1;');
        // Hûn dikarin li vir bangî seederên din jî bikin
        // $this->call([
        //     AnotherSeeder::class,
        // ]);
    }
}