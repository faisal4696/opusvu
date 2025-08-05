<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Advertisement extends Model
{
    use HasFactory;

    protected $guarded = [
        'id','_token'
    ];

    public function createAdvertisement($data)
    {
        $qry = Advertisement::create($data);
        return $qry;
    }

    public function viewAdvertisements($id = null)

    {
        if($id){
            $qry = Advertisement::find($id);
            return $qry;
        }else{
            $qry = Advertisement::paginate(8);
            return $qry;
        }
    }

    public function deleteAdvertisement($id)
    {
        $advertisement = Advertisement::find($id);
        $qry = $advertisement->delete();
        return $qry;
    }
}
