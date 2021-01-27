<?php

namespace Database\Seeders;

use App\Models\CategoryDetails;
use App\Models\Style;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class CategoryStylesSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $this->seeding();
    }
    public function seeding(){
        $categories = CategoryDetails::all()->where('has_styles',1);
        $styles = Style::all()->where('type','Design');
        foreach ($categories as $category){
            switch ($category->name){
                case 'pop ups & temporary':
                case 'offices':
                case 'retail':
                case 'mixed use':
                case 'food & beverage':
                case 'hotels & resorts':
                case 'healthcare & wellness':
                case 'bars & nightclubs':
                case 'private houses':
                {
                    foreach ($styles as $style){
                        $this->insertCategoryStyle($category->id,$style->id);
                    }
                    break;
                }
                default:
                    {
                        break;
                    }
            }
        }
    }
    public function insertCategoryStyle($categoryId,$styleId){
        DB::table('category_styles')->insert([
            'category_id' => $categoryId,
            'style_id' => $styleId
        ]);
    }
}
