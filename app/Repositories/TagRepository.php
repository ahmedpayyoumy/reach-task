<?php

namespace App\Repositories;

use App\Interfaces\TagRepositoryInterface;
use App\Models\Tag;

class TagRepository implements TagRepositoryInterface
{
    public function getAllTags()
    {
        return Tag::all();
    }

    public function getTagById($tagId)
    {
        return Tag::findOrFail($tagId);
    }

    public function deleteTag($tagId)
    {
        Tag::destroy($tagId);
    }

    public function createTag(array $tagDetails)
    {
        return Tag::create($tagDetails);
    }

    public function updateTag($tagId, array $newDetails)
    {
        return Tag::whereId($tagId)->update($newDetails);
    }
}
