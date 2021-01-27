<?php

namespace Database\Seeders;

use App\Models\Category;
use App\Models\CategoryDetails;
use Illuminate\Database\Seeder;

class ImagesSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {

        $architectureDirectory = 'C:\Users\Manaf\Desktop\test\valeria-sys\public\images\architecture';
        $architectureImages = glob($architectureDirectory . "/*.*");
        $this->convertName($architectureImages,$architectureDirectory);

        $categoryDirectory = 'C:\Users\Manaf\Desktop\test\valeria-sys\public\images\category';
        $categoryImages = glob($categoryDirectory . "/*.*");
        $this->convertName($categoryImages,$categoryDirectory);

        $interiorDirectory = 'C:\Users\Manaf\Desktop\test\valeria-sys\public\images\interior';
        $interiorImages = glob($interiorDirectory . "/*.*");
        $this->convertName($interiorImages,$interiorDirectory);

        $landscapeDirectory = 'C:\Users\Manaf\Desktop\test\valeria-sys\public\images\landscape';
        $landscapeImages = glob($landscapeDirectory . "/*.*");
        $this->convertName($landscapeImages,$landscapeDirectory);

        $quickConsultingDirectory = 'C:\Users\Manaf\Desktop\test\valeria-sys\public\images\quick consulting';
        $quichConsultingImages = glob($quickConsultingDirectory . "/*.*");
        $this->convertName($quichConsultingImages,$quickConsultingDirectory);

        $this->convertNameInDb();

        $categories = Category::all();
        foreach ($categories as $category) {
            if ($category->parent_id == null || $category->parent_id == 2 || $category->parent_id == 124){
                $category->update([
                    'image_icon'=> "images/interior/".$category->name . ".png"
                ]);
            }
            if ($category->parent_id == 3 || $category->parent_id == 8 || $category->parent_id == 13 || $category->parent_id == 17
                || $category->parent_id == 23 || $category->parent_id == 28 || $category->parent_id == 31
                || $category->parent_id == 125 || $category->parent_id == 130 || $category->parent_id == 135 || $category->parent_id == 139 || $category->parent_id == 145
                || $category->parent_id == 150 || $category->parent_id == 153 || $category->parent_id == 160){
                $category->update([
                    'image'=> "images/interior/".$category->name .".jpg",
                    'image_opacity'=> "images/interior/".$category->name ."-opacity.jpg"
                ]);
            }
            if ($category->parent_id == 41 || $category->parent_id == 163) {
                $category->update([
                    'image_icon' => "images/architecture/" . $category->name . ".png"
                ]);
            }
            if ($category->parent_id == 70 || $category->parent_id == 67 || $category->parent_id == 52 || $category->parent_id == 47
                || $category->parent_id == 76 || $category->parent_id == 62 || $category->parent_id == 56 || $category->parent_id == 56 || $category->parent_id == 42 ||
                $category->parent_id == 198 || $category->parent_id == 192 || $category->parent_id == 189 || $category->parent_id == 184
                || $category->parent_id == 164 || $category->parent_id == 169 || $category->parent_id == 174 || $category->parent_id == 178
            ) {
                $category->update([
                    'image' => "images/architecture/" . $category->name . ".jpg",
                    'image_opacity' => "images/architecture/" . $category->name . "-opacity.jpg"
                ]);
            }

            if ($category->parent_id == 83 || $category->parent_id == 205) {
                $category->update([
                    'image' => "images/landscape/" . $category->name . ".jpg",
                    'image_opacity' => "images/landscape/" . $category->name . "-opacity.jpg"
                ]);
            }
            if ($category->parent_id == 239) {
                $category->update([
                    'image' => "images/quick consulting/" . $category->name . ".jpg",
                    'image_opacity' => "images/quick consulting/" . $category->name . "-opacity.jpg"
                ]);
            }
            if ($category->parent_id == 117 || $category->parent_id == 1){
                $category->update([
                    'image' => "images/category/" . $category->name . ".jpg",
                    'image_opacity' => "images/category/" . $category->name . "-opacity.jpg"
                ]);
            }
        }
    }

    private function convertName($imagesPaths, $path){
        foreach($imagesPaths as $imagePath){
            $imageName = basename($imagePath);
            rename($imagePath, $path.'\\'.strtolower($imageName));

        }
    }

    private function convertNameInDb(){
        $categories =  Category::all();
        foreach($categories as $category)
        {
            $category->update([
                'name' => strtolower($category->name)
            ]);
        }
    }

}
