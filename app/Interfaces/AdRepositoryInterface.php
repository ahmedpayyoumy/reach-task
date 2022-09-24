<?php

namespace App\Interfaces;

interface AdRepositoryInterface
{
    public function getAllAds();
    public function getAdById($adId);
    public function deleteAd($adId);
    public function createAd(array $adDetails);
    public function updateAd($adId, array $newDetails);
    public function searchAd($query);
}
