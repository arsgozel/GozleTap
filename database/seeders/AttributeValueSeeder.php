<?php

namespace Database\Seeders;

use App\Models\Attribute;
use App\Models\AttributeValue;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class AttributeValueSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $objs = [
            ['name_tm' => 'Jynsy', 'name_en' => 'Gender', 'job_name' => true, 'values' => [
                ['name_tm' => 'Erkek', 'name_en' => 'Male'],
                ['name_tm' => 'Aýal', 'name_en' => 'Female'],
                ['name_tm' => '-', 'name_en' => null],
            ]],
            ['name_tm' => 'Bilimi', 'name_en' => 'Education', 'job_name' => true, 'values' => [
                ['name_tm' => 'Ýokary hünär bilimi', 'name_en' => null],
                ['name_tm' => 'Doly däl ýokary bilimi', 'name_en' => null],
                ['name_tm' => 'Orta hünär bilimi', 'name_en' => null],
                ['name_tm' => 'Hünär tehniki bilimi', 'name_en' => null],
                ['name_tm' => 'Orta bilimi', 'name_en' => null],
                ['name_tm' => '-', 'name_en' => null],
            ]],
            ['name_tm' => 'Iş güni', 'name_en' => 'Work_time', 'job_name' => true, 'values' => [
                ['name_tm' => 'Doly iş güni', 'name_en' => null],
                ['name_tm' => 'Doly däl iş güni', 'name_en' => null],
                ['name_tm' => 'Smenaly', 'name_en' => null],
                ['name_tm' => 'Möwsümleýin', 'name_en' => null],
                ['name_tm' => 'Wagtlaýyn usulda', 'name_en' => null],
                ['name_tm' => '-', 'name_en' => null],
            ]],
            ['name_tm' => 'Iş tejribesi', 'name_en' => 'Experience', 'job_name' => true, 'values' => [
                ['name_tm' => '1 ýyl', 'name_en' => null],
                ['name_tm' => '1-2 ýyl', 'name_en' => null],
                ['name_tm' => '2-3 ýyl', 'name_en' => null],
                ['name_tm' => '3-4 ýyl', 'name_en' => null],
                ['name_tm' => '4-5 ýyl', 'name_en' => null],
                ['name_tm' => '5-6 ýyl', 'name_en' => null],
                ['name_tm' => '-', 'name_en' => null],
            ]],
        ];

        for ($i = 0; $i < count($objs); $i++) {
            $attribute = Attribute::create([
                'name_tm' => $objs[$i]['name_tm'],
                'name_en' => $objs[$i]['name_en'],
                'job_name' => $objs[$i]['job_name'],
                'sort_order' => $i + 1,
            ]);

            for ($j = 0; $j < count($objs[$i]['values']); $j++) {
                AttributeValue::create([
                    'attribute_id' => $attribute->id,
                    'name_tm' => $objs[$i]['values'][$j]['name_tm'],
                    'name_en' => $objs[$i]['values'][$j]['name_en'],
                    'sort_order' => $j + 1,
                ]);
            }
        }
    }
}
