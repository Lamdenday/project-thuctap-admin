<?php

namespace App\Helpers;

class CategoryHelper
{
    public static function getCategoryMultiLevel($categories, $char = '')
    {
        $html = '';
        foreach ($categories as $key => $category) {

                $html .= ' <option value="' . $category->id . '">' . $char .' '. $category->title . '</option> ';
                unset($categories[$key]);

        }
        return $html;
    }
}
