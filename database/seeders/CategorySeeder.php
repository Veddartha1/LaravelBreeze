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
        $category1 = new Category();
        $category1->name = "Electrónica";
        $category1->image = "public/img/default.jpeg";
        $category1->save();

        $category2 = new Category();
        $category2->name = "Hogar";
        $category2->image = "public/img/default.jpeg";
        $category2->save();

        $category3 = new Category();
        $category3->name = "Motor";
        $category3->image = "public/img/default.jpeg";
        $category3->save();
    }
}
