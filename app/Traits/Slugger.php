<?php

namespace App\Traits;

use Illuminate\Database\Eloquent\Model;

trait Slugger
{
    /**
     * CREATE UNIQUE SLUG
     * @param $value
     * @param $model
     * @param string $field
     * @return string
     */
    public function createSlug($value, $model, $field = 'slug')
    {
        $slug = str_slug($value);

        $duplicate = $model::where($field, $slug)->first();

        if ($duplicate) {
            $slug = $slug . '-' . rand(0, 100000);
        }

        return $slug;
    }
}
