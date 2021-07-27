<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class InstagramGallery extends Model
{
    protected $guarded = ['id'];

    protected $appends = ['image'];

    public function getImageAttribute()
    {
        $image = $this->get_string_between($this->embed, 'data-instgrm-permalink="', '/?utm_source=ig_embed&amp;utm_campaign=loading') . '/media?size=l';
        try {
            $image_contents = file_get_contents($image);
            return 'data:image/jpg;base64,' . base64_encode($image_contents);
        } catch (\Throwable $th) {
            \Log::info($th->getMessage());
            return "";
        }
    }

    public function get_string_between($string, $start, $end){
        $string = ' ' . $string;
        $ini = strpos($string, $start);
        if ($ini == 0) return '';
        $ini += strlen($start);
        $len = strpos($string, $end, $ini) - $ini;
        return substr($string, $ini, $len);
    }
}
