<?php

namespace App\Http\Controllers;

use Couchbase\View;
use Illuminate\Http\Request;

class CategoryController extends Controller
{
    public function show($id) : \Illuminate\Contracts\Foundation\Application|\Illuminate\Contracts\View\Factory|\Illuminate\Contracts\View\View|\Illuminate\Foundation\Application
    {
        $categories = \App\Models\Category::all();
        $result = array();
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
                    $name = $category['name'];
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
                        $result[] = $banner['picture'];
                        $count++;
                    }
                }
                break;
            }
        }
        return \view('category', ['name' => $name, 'banners' => $result, 'count' => count($result)]);
    }
}
