<?php

namespace App\Services;
use Illuminate\Support\Facades\Mail;
use App\Mail\Send_Welcome_Message;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class FileServices {

public static function Upload_Image($Image,$Folder,$Guard){


    
    $realName = pathinfo($Image->getClientOriginalName(),PATHINFO_FILENAME);
    
    $imageExtention = $Image->getClientOriginalExtension();

    $completeFileName = $realName . '_' . time() . '.' . $imageExtention;

    $storeImage = $Image->storeAs($Folder,$completeFileName,'images');


    Auth::guard($Guard)->user()->update(['profile_picture' => $storeImage ]);

    return $storeImage;
}

public static function uploadMultipleImages($Table, $Foregin_Id, $Id, $Images, $Folder)
{
    try {
        DB::beginTransaction(); // بدء المعاملة

        foreach ($Images as $Image) {
            // التحقق من صحة الملف
            if (!$Image->isValid()) {
                throw new \Exception('Invalid image file');
            }

            // إنشاء اسم ملف فريد
            $realName = pathinfo($Image->getClientOriginalName(), PATHINFO_FILENAME);
            $imageExtension = $Image->getClientOriginalExtension();
            $completeFileName = $realName . '_' . time() . '.' . $imageExtension;

            // تخزين الصورة
            $storedImagePath = $Image->storeAs($Folder, $completeFileName, 'images');

            // إدخال البيانات في قاعدة البيانات
            DB::table($Table)->insert([
                'path' => $storedImagePath,
                $Foregin_Id => $Id,
                'created_at' => now(),
                'updated_at' => now(),
            ]);
        }

        DB::commit(); // تأكيد التغييرات
        return true;
    } catch (\Exception $e) {
        DB::rollBack(); // إلغاء التغييرات في حال حدوث خطأ
        Log::error('Error uploading images: ' . $e->getMessage());
        return false;
    }
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


