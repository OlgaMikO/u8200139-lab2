<?php

use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/

Route::get('/category/{id}', function ($id) {
    $categories = \App\Models\Category::all();
    foreach ($categories as $category)
    {
        if($category['category_id'] == $id)
        {
            if(!$category['activity'])
            {
                abort(404);
            }
            else
            {
                $count = 0;
                $banners = $category->banners;
                $filtered = $banners->filter(function ($value, $key) {
                    return (strtotime($value['active_from']) > strtotime(date('Y-m-d H:i:s'))) &&
                        (strtotime($value['active_to']) < strtotime(date('Y-m-d H:i:s'))) &&
                        ($value["activity"]);
                })->all();
                uasort($filtered, function ($a1, $a2) {
                    if($a1 == $a2) return 0;
                    return ($a1 > $a2) ? -1 : 1;
                });

                foreach ($filtered as $banner)
                {
                    if($count == 5)
                    {
                        break;
                    }
                    print_r('<img src='.$banner['picture'].'></br>');
                    $count++;
                }
            }
            break;
        }
    }

});
