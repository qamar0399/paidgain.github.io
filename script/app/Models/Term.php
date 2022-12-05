<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Str;
use App\Models\Termmeta;
use App\Models\Termmedia;
use App\Models\Category;
use App\Models\Productoption;
use App\Models\Termcategory;


class Term extends Model
{
    use HasFactory;

    protected $fillable = ['title', 'type', 'lang', 'slug', 'status'];

    // Relation To TermsMeta
    public function page()
    {
        return $this->hasOne(Termmeta::class, 'term_id')->where('key', 'page');
    }

    // Relation To TermsMeta
    public function excerpt()
    {
        return $this->hasOne(Termmeta::class, 'term_id')->where('key', 'excerpt');
    }

    // Relation To TermsMeta
    public function description()
    {
        return $this->hasOne(Termmeta::class, 'term_id')->where('key', 'description');
    }

    public function postmeta()
    {
        return $this->hasOne(Termmeta::class, 'term_id')->where('key', 'meta');
    }

    public function preview()
    {
        return $this->hasOne(Termmeta::class, 'term_id')->where('key', 'preview');
    }

    public function icon()
    {
        return $this->hasOne(Termmeta::class, 'term_id')->where('key', 'icon');
    }


    public function thumbnail()
    {
        return $this->hasOne(Termmeta::class, 'term_id')->where('key', 'thumbnail');
    }

    public function meta()
    {
        return $this->hasOne(Termmeta::class);
    }

    public function categories()
    {
      return $this->belongsToMany(Category::class,'termcategories');
    }

     public function categorieswithone()
    {
      return $this->hasOne(Termcategory::class,'term_id');
    }

    public function tags()
    {
      return $this->belongsToMany(Category::class,'termcategories')->where('type','tag')->select('id','name','type','slug');
    }

    public function casetags()
    {
      return $this->belongsToMany(Category::class,'termcategories')->where('type','case_tag')->select('id','name','type','slug');
    }

    public function lawyer(){
        return $this->belongsToMany(Category::class,'termcategories')->where('type','lawyer')->select('id','name','type','slug');
    }

    public function category()
    {
      return $this->belongsToMany(Category::class,'termcategories')->where('type','category')->select('id','name','type','slug');
    }


     public function blogcategory()
    {
      return $this->belongsToMany(Category::class,'termcategories')->where('type','blog_category')->select('id','name','type','slug');
    }

    public function brands()
    {
      return $this->belongsToMany(Category::class,'termcategories')->where('type','brand')->select('id','name','type','slug');
    }

    public function termcategories()
    {
      return $this->hasMany(Termcategory::class);
    }

    public function user()
    {
      return $this->belongsTo(User::class);
    }
}
