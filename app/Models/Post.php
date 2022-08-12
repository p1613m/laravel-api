<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Http\UploadedFile;
use Illuminate\Support\Facades\Storage;

class Post extends Model
{
    use HasFactory;

    protected $fillable = [
        'category_id',
        'user_id',
        'title',
        'content',
        'description',
        'image_path',
    ];

    public function category()
    {
        return $this->hasOne(Category::class, 'id', 'category_id');
    }

    public function user()
    {
        return $this->hasOne(User::class, 'id', 'user_id');
    }

    public function getImageUrlAttribute()
    {
        return Storage::url($this->image_path);
    }

    public function fillImage(UploadedFile $file)
    {
        $imageDirectory = 'public/images';
        $imageName = uniqid() . '.' . $file->getClientOriginalExtension();
        $file->storeAs($imageDirectory, $imageName);

        $this->image_path = $imageDirectory . '/' . $imageName;
        $this->save();
    }
}
