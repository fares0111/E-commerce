<?php

namespace App\Services;
use Illuminate\Support\Facades\Mail;
use App\Mail\Send_Welcome_Message;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Auth;


class FileServices {

public static function User_Image($Image,$Folder,$Guard){


    
    $realName = pathinfo($Image->getClientOriginalName(),PATHINFO_FILENAME);
    
    $imageExtention = $Image->getClientOriginalExtension();

    $completeFileName = $realName . '_' . time() . '.' . $imageExtention;

    $storeImage = $Image->storeAs($Folder,$completeFileName,'images');


    Auth::guard($Guard)->user()->update(['profile_picture' => $storeImage ]);

    return $storeImage;
}


public static function Delete_Image($Guard){



    $originalPath = 'public/'.Auth::guard($Guard)->user()->profile_picture;
    $cleanPath = preg_replace('/[^A-Za-z0-9\-_.\/]/', '', $originalPath);
    

//dd($cleanPath);
    if(Storage::exists($cleanPath)){

Storage::delete($cleanPath);


    }else{return false;}

}


}


