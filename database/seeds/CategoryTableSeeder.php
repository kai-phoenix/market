<?php

use Illuminate\Database\Seeder;
use App\Category;

//Categoryの初期値設定
class CategoryTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('categories')->delete();
        Category::create([
            'id'=>1,
            'name'=>'fashion',
            'created_at'=>now(),
            'updated_at'=>now(),
            ]);
        Category::create([
            'id'=>2,
            'name'=>'food',
            'created_at'=>now(),
            'updated_at'=>now(),
            ]);
        Category::create([
            'id'=>3,
            'name'=>'ticket',
            'created_at'=>now(),
            'updated_at'=>now(),
            ]);
    }
}
