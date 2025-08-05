<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Category extends Model
{
    use HasFactory;

//    protected $fillable = [
//        'name',
//    ];

    protected $guarded = [
        'id','_token'
    ];

    public function video()
    {
        return $this->hasMany(Video::class);
    }

    public function createCategory($data)
    {
        $query = Category::create($data);
        return $query;
    }

    public function getCategories($id=null)
    {
        if($id == null){
            $query = Category::all();
            return $query;
        }else{
            $query = Category::where('id',$id)->first();
            return $query;
        }
    }

    public function deleteCategory($id)
    {
        $category = Category::find($id);
        $query = $category->delete();
        return $query;
    }

    public function updateCategory($id,$data)
    {
        $query = Category::where('id',$id)->update($data);
        return $query;
    }
}
