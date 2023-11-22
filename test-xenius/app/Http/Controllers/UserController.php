<?php

namespace App\Http\Controllers;

use App\Http\Requests\CreateCvRequest;
use App\Models\OffreEmploi;
use App\Models\User;
use PDF;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Mail;

class UserController extends Controller
{
    public function createCV(CreateCvRequest $request)
    {
        $user = User::where('id',Auth::user()->id)->first();
        $user->update([
            'experience'=>$request->experience,
            'comptences'=>$request->comptences,
            'formation'=>$request->formation,
        ]);
        
        return response()->json(['success'=>true,'messsage'=>'Cv created successfully','data'=>$user]);
    }

    public function sendCandidature($id)
    {
        $offer = OffreEmploi::findOrFail($id);
        $user = User::where('id',Auth::user()->id)->first();
        $offer->users()->attach($user->id);
        $dataCV = [
            'email'=>$user->email,
            'experience'=>$user->experience,
            'comptences'=>$user->comptences,
            'formation'=>$user->formation,
        ];
        $cv = PDF::loadView('cv', $dataCV);
        $data = [
            'title' => 'Candidature pour l\'offre '.$offer->title,
        ];
        $admin = User::where('is_admin',1)->first();
        Mail::send('emails.candidature', $data, function($message)use($data, $cv,$admin) {
            $message->to($admin->email)
            ->subject($data['title']);
            $message->attachData($cv->output(),'cv.pdf');
        });
        return response()->json(['success'=>true,'messsage'=>'Candidature send successfully']);
    }
}
