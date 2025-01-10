<?php

namespace App\Services;
use Illuminate\Support\Facades\Mail;
use App\Mail\Send_Welcome_Message;

class UploadImages {

public static function User_Image($image){


    $tempLocation = $image;
    
    $realName = pathinfo($tempLocation->getClientOriginalName(),PATHINFO_FILENAME);
    
    $imageExtention = $tempLocation->getClientOriginalExtension();

    $completeFileName = $realName . '_' . time() . '.' . $imageExtention;

    $storeImage = $tempLocation->storeAs('user_profile_picture',$completeFileName,'images');

    return $storeImage;
}


}