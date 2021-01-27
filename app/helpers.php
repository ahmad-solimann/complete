<?php


use App\Models\CategoryDetails;
use Illuminate\Support\Str;

function getTranslatedName($id){
    $local = \Illuminate\Support\Facades\App::currentLocale();
    return ucwords(CategoryDetails::find($id)->translate($local)->name);
}
function isArabic(){
    if (\Illuminate\Support\Facades\App::currentLocale()=='ar')
        return true;
    return false;
}

function MoveCurrentProjectToProjects($id){
    $src ="/files/Admin Area/Current Projects/$id";
    $dest ="/files/Admin Area/Projects/$id";
    \Illuminate\Support\Facades\Storage::disk('public')->move($src,$dest);
}
function MoveProjectToCurrentProjects($id){
    $src ="/files/Admin Area/Projects/$id";
    $dest ="/files/Admin Area/Current Projects/$id";
    \Illuminate\Support\Facades\Storage::disk('public')->move($src,$dest);
}
