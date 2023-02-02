<?php

namespace Database\Seeders;

use App\Models\Category;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class CategorySeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $objs = [
            ['Mugallym', 'Teacher', [
                ['Inlis dili mugallym', null],
                ['Rus dili mugallym', null],
                ['Fizika mugallym', null],
                ['Himiya mugallym', null,],
                ['Matematika mugallym', null,],
            ]],
            ['Programmist', null, [
                ['Front-end programmist', null],
                ['Back-end programmist', null],
                ['Full-stack programmist', null],
            ]],
            ['Aşpez', null, [
                ['Baş aşpez', null],
                ['Kömekçi aşpez', null],
            ]],
            ['Lukman', 'Cook', [
                ['Newropatolog', null],
                ['Stomatolog', null],
            ]],
        ];

        for ($i = 0; $i < count($objs); $i++) {
            $category = Category::create([
                'name_tm' => $objs[$i][0],
                'name_en' => $objs[$i][1],
                'sort_order' => $i + 1,
            ]);

            for ($j = 0; $j < count($objs[$i][2]); $j++) {
                Category::create([
                    'parent_id' => $category->id,
                    'name_tm' => $objs[$i][2][$j][0],
                    'name_en' => $objs[$i][2][$j][1],
                    'sort_order' => $j + 1,
                ]);
            }
        }
    }
}
