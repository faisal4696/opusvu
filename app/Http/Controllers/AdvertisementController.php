<?php

namespace App\Http\Controllers;

use App\Models\Advertisement;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\Storage;

class AdvertisementController extends Controller
{
    private $advertisement;

    public function __construct(Advertisement $advertisement)
    {
        $this->advertisement = $advertisement;
    }

    public function viewAdvertisements()
    {
        $advertisements = $this->advertisement->viewAdvertisements();
        return view('admin.view-advertisement',compact('advertisements'));
    }

    public function addAdvertisement(Request $request)
    {
        $request->validate([
            'place' => 'required',
            'link' => 'required',
            'image' => 'required|image|mimes:jpg,png,jpeg,gif',
        ]);
        $formData = $request->all();
        $filename = time() . '-' . $request->file('image')->getClientOriginalName();
        Storage::disk('addImages')->put($filename, file_get_contents($request->file('image')->getRealPath()));
        $formData['image'] = 'uploads/advertisements-images/'.$filename;
        $newAdvertisement = $this->advertisement->createAdvertisement($formData);
        if ($newAdvertisement) {
            Session::flash('success', 'New Advertisement Added Successfully');
            return back();
        } else {
            Session::flash('error', 'Something Error Try Again Later');
            return back();
        }
    }

    public function deleteAdvertisement($id)
    {
        $delete = $this->advertisement->deleteAdvertisement($id);
        if ($delete) {
            Session::flash('success', 'Advertisement Deleted Successfully');
            return back();
        } else {
            Session::flash('error', 'Something Error Try Again Later');
            return back();
        }
    }

    public function editAdvertisement(Request $request)
    {
        $advertisement = $this->advertisement->viewAdvertisements($request->advertisement_id);
        if($request->hasFile('image')) {
            $request->validate([
                'image' => 'image|mimes:jpg,png,jpeg,gif',
            ]);
            $filename = time() . '-' . $request->file('image')->getClientOriginalName();
            Storage::disk('addImages')->put($filename, file_get_contents($request->file('image')->getRealPath()));
            $advertisement->image = 'uploads/advertisements-images/' . $filename;
        }
        if($request->place != null){
            $advertisement->place = $request->place;
        }
        if($request->link != null){
            $advertisement->link = $request->link;
        }
        $save = $advertisement->save();
        if ($save) {
            Session::flash('success', 'Advertisement Udate Successfully');
            return back();
        } else {
            Session::flash('error', 'Something Error Try Again Later');
            return back();
        }
    }
}
