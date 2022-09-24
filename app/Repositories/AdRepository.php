<?php

namespace App\Repositories;

use App\Interfaces\AdRepositoryInterface;
use App\Models\Ad;

class AdRepository implements AdRepositoryInterface
{
    public function getAllAds()
    {
        return Ad::query()->filter([request()->all()])->get();
    }

    public function getAdById($adId)
    {
        return Ad::with(['tags' => function($query) { return $query->select('name'); }])->findOrFail($adId);
    }

    public function deleteAd($adId)
    {
        Ad::destroy($adId);
    }

    public function createAd(array $adDetails)
    {
        dd($adDetails);
        $ad = Ad::create($adDetails);
        $ad->tags()->sync((array)$adDetails['tags']);
        return $ad;
    }

    public function updateAd($adId, array $newDetails)
    {
        $tags = $newDetails['tags'];
        unset($newDetails['tags']);
        $ad = Ad::whereId($adId)->update($newDetails);
        Ad::whereId($adId)->first()->tags()->sync((array)$tags);
        return $ad;
    }

    public function searchAd($tags = [], $advertiser = null, $category = null)
    {
        $query = Ad::query();
        if($category) {
            $query->where('category_id', '=', $category);
        }
        if ($advertiser) {
            $query->where('advertiser_id', '=', $advertiser);
        }
        if (!empty($tags)){
            $query->when(count($tags),function ($query)use ($tags) {
                $query->whereHas('location', function($q) use ($tags) {
                    $q->where( function($q) use ($tags) {
                        foreach ($tags as $tag) {
                            dd($tag);
                            $q->Where('id', '=', $tag);
                        }
                    });
                });
            });
        }
        return $query->get();
    }
}
