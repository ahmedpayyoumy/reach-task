<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Ad extends Model
{
    use HasFactory;

    protected $fillable = ['type', 'title', 'description', 'starts_date', 'starts_time', 'category_id', 'advertiser_id'];

    protected $hidden = ['pivot'];

    public function advertiser()
    {
        return $this->belongsTo(Advertiser::class);
    }

    public function category()
    {
        return $this->belongsTo(Category::class);
    }

    public function tags()
    {
        return $this->belongsToMany(Tag::class, 'ad_tags');
    }

    public function scopeFilter($query)
    {
        if(request('category') ?? false) {
            $query->where('category_id', '=', request('category'));
        }

        if(request('advertiser') ?? false) {
            $query->where('advertiser_id', '=', request('advertiser'));
        }

        if (request('tags') ?? false){
            $tags = request('tags');
            $query->when(count($tags),function ($query)use ($tags) {
                $query->whereHas('tags', function($q) use ($tags) {
                    $q->where( function($q) use ($tags) {
                        $q->whereIn('tags.id', $tags);
                    });
                });
            });
        }
    }
}
