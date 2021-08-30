<?php

if (!function_exists('showCategories')) {
    function showCategories($categories, $idCategory = null, $parent_id = 0, $char = '')
    {
        foreach ($categories as $key => $category) {
            if ($category->parent_id == $parent_id) {
                $selected = $category->id == $idCategory ? 'selected' : '';
                echo '<option value="' . $category->id . '" ' . $selected . '>' . $char . $category->name . '</option>';
                unset($categories[$key]);
                showCategories($categories, $idCategory, $category->id, $char . ' -- ');
            }
        }
    }
}

