<?php


use App\Http\Controllers\Admin\AdminController;
use App\Http\Controllers\Admin\ProjectController;
use App\Http\Controllers\QuestionnaireController;
use App\Http\Controllers\UserController;
use App\Models\Category;
use App\Models\CategoryDetails;
use App\Models\CategoryDetailsTranslation;
use App\Models\Designer;
use App\Models\Team;
use App\Models\ThreeDModel;
use App\Notifications\SubmittedQuestionnaire;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Cache;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Session;


/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/
Route::group(['prefix' => 'admin/file-manager', 'middleware' => ['admin', 'auth']], function () {
    \UniSharp\LaravelFilemanager\Lfm::routes();
});

Route::get('lang/{locale}', function ($locale) {
    Session()->put('locale',$locale);
    return redirect()->back();
});

Route::get('local/{local}',function($local) {
    Session::put('local',$local);
    return redirect()->back();
})->name('change.language');
//Admin Area
Route::get('/admin', [AdminController::class,'dashboard'])->name('admin.dashboard')->middleware(['auth','admin','localization']);
Route::group(['middleware' => ['admin','localization'], 'prefix' => 'admin','as'=> 'admin.'], function () {
    Route::post('/verify', [AdminController::class,'verifyUser'])->name('verify');
    Route::post('/users/get-username-autocomplete',[\App\Http\Controllers\Admin\UserController::class,'getUsernameAutocomplete'])->name('users.get-username-autocomplete');


    Route::resource('users', \App\Http\Controllers\Admin\UserController::class);
    Route::resource('admins', AdminController::class);
    Route::resource('projects', ProjectController::class);
    Route::get('send-info/projects/{id}', [ProjectController::class,'SendInfoAboutUpdates'])->name('projects.send-info');
    Route::post('send-info/projects/{id}', [ProjectController::class,'StoreUpdates'])->name('projects.store-updates');
    Route::post('move-project/projects/', [ProjectController::class,'moveProject'])->name('projects.move-project');
    Route::post('restore-project/projects/', [ProjectController::class,'restoreProject'])->name('projects.restore-project');
    Route::get('project-history/projects/{id}', [ProjectController::class,'showProjectHistory'])->name('projects.history');
    Route::resource('questionnaires', \App\Http\Controllers\Admin\QuestionnaireController::class);
    Route::get('/notifications/count',[App\Http\Controllers\Admin\NotificationsController::class,'count'])->name('notifications-count');
    Route::get('/notifications/get',[App\Http\Controllers\Admin\NotificationsController::class,'get'])->name('notifications-get');
    Route::get('/notifications/all',[App\Http\Controllers\Admin\NotificationsController::class,'all'])->name('notifications-all');
    Route::delete('/notifications/remove/{id}',[App\Http\Controllers\Admin\NotificationsController::class,'remove'])->name('notifications-remove');
    Route::post('/notifications/mark-as-read',[App\Http\Controllers\Admin\NotificationsController::class,'markAsRead'])->name('notifications-mark-as-read');
});

Route::group(['middleware' => ['consulting.auth','localization']],function () {
    Route::resource('users', UserController::class);
    Route::resource('questionnaires', QuestionnaireController::class);
    Route::resource('profiles',\App\Http\Controllers\ProfileController::class)->middleware('auth');
    Route::resource('projects',\App\Http\Controllers\ProjectController::class)->middleware('auth');
});




//TODO home page user
Route::get('/test', function () {
        return view('test');
})->name('users.home');

Route::get('/', function () {
    $categories = Category::where('parent_id',1)->get();
    $models = ThreeDModel::paginate(6);
    $designers = Designer::all();
    $teams = Team::where('choice',true)->get();
    return view('users.home',compact(['categories','teams','models','designers']));
})->name('users.home')->middleware(['localization']);

Auth::routes();





Route::get('/showModel', function () {
    $models = ThreeDModel::paginate(6);
    return view('users.models.show',compact(['models']));
})->name('model.show')->middleware(['localization']);

//TODO form Questionnaire API
Route::get('/category/{id}', [App\Http\Controllers\CategoriesController::class, 'getCategory'])->name('categories');
Route::get('/grandparent/{id}', [App\Http\Controllers\CategoriesController::class, 'grandparent'])->name('grand');
Route::get('/category', [App\Http\Controllers\CategoriesController::class, 'parent'])->name('parent');
Route::post('createproject', [App\Http\Controllers\QuestionnaireController::class, 'store']);
Route::get('/styles/{id}', [App\Http\Controllers\CategoriesController::class, 'styles'])->name('styles');
Route::get('isAuth', [\App\Http\Controllers\CategoriesController::class, 'isAuth'])->name('isAuth');





Route::group(['middleware' => ['localization']],function(){
    Route::resource('designers',\App\Http\Controllers\Admin\DesignerController::class);
    Route::resource('teams',\App\Http\Controllers\Admin\TeamController::class);
    Route::resource('contacts',\App\Http\Controllers\Admin\ContactController::class);
    Route::resource('model',\App\Http\Controllers\Admin\ThreeDModelController::class);
});

Route::get('/choice', [\App\Http\Controllers\Admin\TeamController::class, 'choice'])->name('choice');

Route::get('payment/{id}', [\App\Http\Controllers\PayPalController::class,'payment'])->name('payment');
Route::get('download/{id}', [\App\Http\Controllers\PayPalController::class,'download'])->name('download');


//TODO File manager user
Route::get('directory/{dir}/{id}',[\App\Http\Controllers\DirectoryController::class,'getDir'])->name('openDir');
Route::post('dir/{dir}/{id}',[\App\Http\Controllers\DirectoryController::class,'upload'])->name('upload.file');
Route::get('down/{down}',[\App\Http\Controllers\DirectoryController::class,'download'])->name('down');
Route::get('image/{filename}',[\App\Http\Controllers\DirectoryController::class,'getPubliclyStorgeFile'])->name('image.display');
Route::get('read/{file}',[\App\Http\Controllers\DirectoryController::class,'read'])->name('read');




