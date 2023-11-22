<?php

namespace App\Http\Controllers;

use App\Http\Requests\OfferRequest;
use App\Models\OffreEmploi;
use App\Models\User;
use PDF;

class AdminController extends Controller
{
    public function getAllOffers()
    {
        $offers = OffreEmploi::with('users')->get();
        return response()->json(['success'=>true,'data'=>$offers]);
    }

    public function getOffer($id)
    {
        $offer = OffreEmploi::with('users')->where('id',$id)->first();
        return response()->json(['success'=>true,'data'=>$offer]);
    }

    public function createOffer(OfferRequest $request)
    {
        $offer = OffreEmploi::create([
            'title'=>$request->title,
            'description'=>$request->description,
        ]);
        return response()->json(['success'=>true,'messsage'=>'offer created successfully','data'=>$offer]);
    }

    public function updateOffer(OfferRequest $request,$id)
    {
        $offer = OffreEmploi::with('users')->where('id',$id)->first();
        $offer->update([
            'title'=>$request->title,
            'description'=>$request->description,
        ]);
        return response()->json(['success'=>true,'messsage'=>'offer updated successfully','data'=>$offer]);
    }

    public function deleteOffer($id)
    {
        $offer = OffreEmploi::with('users')->where('id',$id)->first();
        $offer->delete();
        return response()->json(['success'=>true,'messsage'=>'offer deleted successfully']);
    }

    public function downloadCV($id) 
    {
        $user = User::findOrfail($id);
        $pdf = PDF::loadView('cv', compact('user'));
        
        return $pdf->download('cv.pdf');
    }
    
}
