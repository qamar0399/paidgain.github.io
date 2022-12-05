<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\Categorymeta;
use App\Models\Termcategory;
use Str;
use Auth;


class Category extends Model
{
    use HasFactory;

    protected $fillable = [
        'type',
        'lang',
        'category_id',
        'other',
        'name',
        'slug',
        'status',
        'featured',
        'menu_status',
    ];

    public function makeSlug($title,$type){
       $slug_gen=Str::slug($title);
       $slug=Category::where('type',$type)->where('slug',$slug_gen)->count();
       if ($slug > 0) {
          $slug_count=$slug+1;
          $slug=$slug_gen.$slug_count;
          return $this->makeSlug($slug,$type);
       }

       return $slug_gen;
    }

    public function categories()
    {
      return $this->hasMany(Category::class,'category_id','id');
    }

    public function parent()
    {
      return $this->hasOne(Category::class,'id','category_id');
    }

    public function preview()
    {
      return $this->hasOne(Categorymeta::class)->where('type','preview');
    }

    public function icon()
    {
      return $this->hasOne(Categorymeta::class)->where('type','icon');
    }

    public function description()
    {
      return $this->hasOne(Categorymeta::class)->where('type','description');
    }

    public function childrenCategories()
    {
      return $this->hasMany(Category::class,'category_id','id')->with('categories');
    }

    public function meta()
    {
      return $this->hasOne(Categorymeta::class);
    }

    public function metas()
    {
      return $this->hasMany(Categorymeta::class);
    }

    public function termcategories()
    {
      return $this->hasMany(Termcategory::class);
    }

    public function getMeta($key)
    {
        return json_decode(optional($this->hasOne(Categorymeta::class, 'category_id', 'id')
            ->where('type', '=', $key)->first())->value);
    }

}
