<?php

namespace Database\Seeders;

use App\Models\Category;
use App\Models\CategoryDetails;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class CategorySeeder extends Seeder
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

    public function seeding () {
        $jsonString = file_get_contents("C:\Users\Manaf\Desktop\\test\\valeria-sys\public\storage\categories\categoriesFinal.json");
        $data = json_decode($jsonString, true);
        $k=0;
        for($i=0; $i< sizeof($data);$i++) {
            $this->arrayJsonToDB($data[$i], null);
        }
    }
    public function insertCategory ($categoryName,$parentId){
        $id = DB::table('categories')->insertGetId([
                'name' => $categoryName,
                //'category_details_id' => $this->getCategoryDetailsId(strtolower($categoryName)),
                'parent_id' => $parentId,
            ]);
        $category= Category::find($id);
        $cDetails = CategoryDetails::find($id);
        if(isset($cDetails)){
            $category->category_details_id=$id;
            $category->save();
        }
        return $id;
    }

    public function arrayJsonToDB ($data,$parentId = null){
            foreach($data as $category => $value){
                if ($category!='name') {
                    $parentId= $this->insertCategory($category,$parentId);
                    foreach ($data[$category] as $index1 => $val2) {
                        $this->arrayJsonToDB($val2, $parentId);
                    }
                }
                else {
                    if (isset($value))
                    $parentId =$this->insertCategory($value,$parentId);
                }
            }
        }

        public function getCategoryDetailsId ($categoryName){
           $categoryDetails= CategoryDetails::whereTranslation('name',$categoryName)->first();
           if (isset($categoryDetails))
           return $categoryDetails->id;

           return null;
        }

}
