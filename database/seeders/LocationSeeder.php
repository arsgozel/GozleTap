<?php

namespace Database\Seeders;
use App\Models\Location;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class LocationSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $objs = [
            ['Aşgabat', 'Ashgabat', [
                ['Berzeňňi', 'Berzenni'],
                ['Bekrewe', null],
                ['Büzmeýin', 'Buzmeyin'],
            ]],
            ['Ahal', 'Akhal', [
                ['Ak bugdaý etraby', 'Ak bugday district'],
                ['Bäherden', 'Baherden'],
                ['Gökdepe', 'Gokdepe'],
                ['Kaka', null],
                ['Änew', 'Anew'],
                ['Tejen', null],
            ]],
            ['Balkan', 'Balkan', [
                ['Etrek', null],
                ['Balkanabat', null],
                ['Hazar', null],
                ['Türkmenbaşy', 'Turkmenbashy'],
            ]],
            ['Mary', 'Mary', [
                ['Ýolöten', 'Yoloten'],
                ['Mary', null],
                ['Sakarçäge', 'Sakarchage'],
                ['Serhetabat (Guşgy)', 'Serhetabat (Gushgy)'],
                ['Tagtabazar', null],
                ['Baýramaly', 'Bayramaly'],
            ]],
            ['Lebap', 'Lebap', [
                ['Darganata', null],
                ['Farap', null],
                ['Gazojak', null],
                ['Türkmenabat', 'Turkmenabat'],
                ['Köýtendag', 'Koytendag'],
                ['Kerki', null],
                ['Saýat', 'Sayat'],
                ['Çärjew', 'Charjew'],
            ]],
            ['Daşoguz', 'Dashoguz', [
                ['Akdepe', null],
                ['Gurbansoltan Eje', null],
                ['Boldumsaz', null],
                ['Daşoguz', 'Dashoguz'],
                ['Gubadag', null],
                ['Görogly (Tagta)', 'Gorogly (Tagta)'],
                ['Türkmenbaşy etraby ', 'Turkmenbashy district'],
                ['Ruhubelent etraby', 'Ruhubelent district'],
                ['Köneürgenç', 'Koneurgench'],
            ]],
        ];
        for ($i = 0; $i < count($objs); $i++) {
            $location = Location::create([
                'name_tm' => $objs[$i][0],
                'name_en' => $objs[$i][1],
                'sort_order' => $i + 1,
            ]);

            for ($j = 0; $j < count($objs[$i][2]); $j++) {
                Location::create([
                    'parent_id' => $location->id,
                    'name_tm' => $objs[$i][2][$j][0],
                    'name_en' => $objs[$i][2][$j][1],
                    'sort_order' => $j + 1,
                ]);
            }
        }
    }
}
