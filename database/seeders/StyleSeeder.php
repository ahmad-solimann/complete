<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class StyleSeeder extends Seeder
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
        $jsonString = file_get_contents("C:\Users\Manaf\Desktop\\test\\valeria-sys\public\storage\categories\styles.json");
        $data = json_decode($jsonString, true);
        for($i=0; $i< sizeof($data);$i++) {
            $this->arrayJsonToDB($data[$i], null);
        }
    }
    public function insertStyle ($type,$number,$name){
        $id = DB::table('styles')->insert([
            'type' => $type,
            'number' => $number,
            'name'=> $name
        ]);
        return $id;
    }

    public function arrayJsonToDB ($data){
        foreach($data as $styleType => $stylesArray){
            foreach($data[$styleType] as $index => $content){
                $styleNumber=0;
                $styleName="";
                foreach($content as $columnName => $value){

                    switch ($columnName){
                        case 'styleNumber':{
                            $styleNumber=$value;
                            break;
                        }
                        case 'name': {
                            $styleName=$value;
                        }
                        default :
                            { }
                    }
                }
                $this->insertStyle($styleType,$styleNumber,$styleName);
            }
        }
    }
}
