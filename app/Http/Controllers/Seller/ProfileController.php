<?php

namespace App\Http\Controllers\Seller;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use App\Services\FileServices;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Validation\Rules;


use App\Models\Sellers\Seller;

class ProfileController extends Controller
{

    public $Image = null;
    public $Folder = 'seller_profile_picture';
    public $Guard = 'seller';

    /**
     * Display a listing of the resource.
     */
    public function index()
    {

        $sellerCountry = \DB::table('countries')->where('id',Auth::guard($this->Guard)->user()->id)->first();

        $sellerCity = Auth::guard($this->Guard)->user()->address['city'];

        $sellerDetails = Auth::guard($this->Guard)->user()->address['details'];

        $userName = Auth::guard($this->Guard)->user()->name;

        return view('sellers.profile.index',compact(
            
            'sellerCountry',
            'sellerCity',
            'sellerDetails',
            'userName',
        ));


    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request)
    {


$request->validate([
    
    'password' => ['nullable','confirmed',Rules\Password::defaults()],
    'address.city' => ['nullable'],
    'address.details' => ['nullable'],
    'name' => ['nullable','min:4'],


]);
        
        
$this->CheckEditAbilite($request);

if($request->hasFile('image')){


    $this->Image = $request->image;


    //this service's method will delete the old user's profile picture 

    FileServices::Delete_Image($this->Guard);

    ////this service's method will add the new user's profile picture 

 $reUploading = FileServices::User_Image($this->Image,$this->Folder,$this->Guard);


}


return back();
}
    /**
     * Remove the specified resource from storage.
     */
    public function destroy()
    {

        
}



protected function CheckEditAbilite($request){

    $Seller = Auth::guard('seller')->user();

    $Address = $Seller->address;
    
    if ($request->name != $Seller->name && !is_null($request->name)) {
        $Seller->name = $request->name;
    }
    
    $HashedPassword = Hash::make($request->password);
    if ($HashedPassword != $Seller->password && !is_null($request->password)) {
        $Seller->password = $HashedPassword;
    }
    
    if ($request->input('address.city') != ($Address['city'] ?? null)) {
        $Address['city'] = $request->input('address.city');
    }

    if ($request->input('address.details') != ($Address['details'] ?? null)) {
        $Address['details'] = $request->input('address.details');
    }

    $Seller->address = $Address;
    
    $Seller->save();
    





}
}