<?php

namespace App;

use Illuminate\Support\Facades\Storage;
use Illuminate\Database\Eloquent\Model;

class Trip extends Model
{
    // difficulty_grade = [1 = beginner, 2= easy, 3= moderate, 4= difficult, 5= advance]

    protected $appends = ['difficulty_grade_value', 'imageUrl', 'thumbImageUrl', 'mediumImageUrl', 'mapImageUrl', 'link', 'galleryLink', 'pdf_link', 'trip_activity_type'];

    public function getDifficultyGradeValueAttribute()
    {
        $difficulty_grade = [
            '1' => 'beginner',
            '2' => 'easy',
            '3' => 'moderate',
            '4' => 'difficult',
            '5' => 'advance'
        ];

        if ($this->difficulty_grade) {
            return strtoupper($difficulty_grade[$this->difficulty_grade]);
        } else {
            return "beginner";
        }
    }

    public function similar_trips()
    {
        return $this->belongsToMany(Trip::class, 'similar_trips', 'parent_id', 'trip_id');
    }

    public function addon_trips()
    {
        return $this->belongsToMany(Trip::class, 'addon_trips', 'parent_id', 'trip_id');
    }

    public function destination()
    {
        return $this->belongsToMany(Destination::class);
    }

    public function getDestinationAttribute()
    {
        return $this->destination()->first();
    }

    public function region()
    {
        return $this->belongsToMany(Region::class);
    }

    public function getRegionAttribute()
    {
        return $this->region()->first();
    }

    public function activities()
    {
        return $this->belongsToMany(Activity::class);
    }

    public function trip_info()
    {
        return $this->hasOne(TripInfo::class);
    }

    public function trip_include_exclude()
    {
        return $this->hasOne(TripIncludeExclude::class);
    }

    public function trip_seo()
    {
        return $this->hasOne(TripSeo::class);
    }

    public function trip_itineraries()
    {
        return $this->hasMany(TripItinerary::class);
    }

    public function trip_galleries()
    {
        return $this->hasMany(TripGallery::class);
    }

    public function getImageUrlAttribute()
    {
        if (count($this->trip_galleries) > 0) {
            return $this->trip_galleries[0]->imageUrl;
        }

        return config('constants.default_hero_banner');
    }

    public function getMapImageUrlAttribute()
    {
        if (isset($this->attributes['map_file_name']) && !empty($this->attributes['map_file_name'])) {
            $image_url = url('/storage/trips');
            return $image_url . '/' . $this->attributes['id'] . '/' . $this->attributes['map_file_name'];
        }
        return config('constants.default_image_url');
    }

    public function getPdfLinkAttribute()
    {
        if (isset($this->attributes['pdf_file_name']) && !empty($this->attributes['pdf_file_name'])) {
            $image_url = url('/storage/trips');
            return $image_url . '/' . $this->attributes['id'] . '/' . $this->attributes['pdf_file_name'];
        }
        return "";
    }

    public function getThumbImageUrlAttribute()
    {
        if (count($this->trip_galleries) > 0) {
            return $this->trip_galleries[0]->thumbImageUrl;
        }

        return config('constants.default_thumb_image_url');
    }

    public function getMediumImageUrlAttribute()
    {
        if (count($this->trip_galleries) > 0) {
            return $this->trip_galleries[0]->mediumImageUrl;
        }

        return config('constants.default_medium_image_url');
    }


    // this is a recommended way to declare event handlers
    public static function boot()
    {
        parent::boot();
        static::deleting(function ($trip) { // before delete() method call this
            $trip->region()->detach();
            $trip->destination()->detach();
            $trip->activities()->detach();
            $trip->trip_info()->delete();
            $trip->trip_include_exclude()->delete();
            if($trip->trip_seo()->delete()) {
                $path = 'public/trip-seos/';
                Storage::deleteDirectory($path . $trip->id);
            }
            $trip->trip_itineraries()->delete();
            $path = 'public/trip-galleries/';
            if ($trip->trip_galleries()->delete()) {
                Storage::deleteDirectory($path . $trip->id);
            }
        });
    }

    public function trip_reviews()
    {
        return $this->hasMany('App\TripReview');
    }

    public function trip_faqs()
    {
        return $this->hasMany('App\TripFaq');
    }

    public function getLinkAttribute()
    {
        return route('front.trips.show', ['slug' => $this->attributes['slug']]);
    }

    public function getGalleryLinkAttribute()
    {
        return route('front.trips.galleries', ['slug' => $this->attributes['slug']]);
    }

    public function trip_departures()
    {
        return $this->hasMany('App\TripDeparture');
    }

    public function getTripActivityTypeAttribute()
    {
        if (iterator_count($this->activities)) {
            return $this->activities->first()->name;
        }

        return "Trekking";
    }
}
