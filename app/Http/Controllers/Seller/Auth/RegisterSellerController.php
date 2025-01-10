<?php

namespace App\Http\Controllers\Seller\Auth;

use App\Models\Sellers\Seller;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Validation\Rules;
use App\Events\Mails\Send_Welcome_Message;
use App\Services\UploadImages;
class RegisterSellerController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
return "i work";    

}

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {

      $Countries = \DB::table('countries')->get();
        return view("sellers/auth/register",compact('Countries'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {

        $request->validate([
            'name' => ['required', 'string', 'max:100'],
            'email' => ['required', 'string','email', 'max:120', 'unique:sellers'],
            'password' => ['required', 'confirmed', Rules\Password::defaults()],

            'address.country' => ['required'],
            'address.city' => ['required','string'],
            'address.details' => ['required','string'],

            'image' => [
                'nullable', 
                'image', 
                'mimes:jpeg,png,jpg,gif,svg',   
                'max:2048',
            ],
        ]);


        $seller = Seller::create([
            'name' => $request->name,
            'email' => $request->email,
            'password' => Hash::make($request->password),

            'address' =>[
                'country' => $request->input('address.country'),
                'city' => $request->input('address.city'),
                'details' => $request->input('address.details'),

            ]

            
        ]);

    
if($request->hasFile('image')){

  $imagePath =  UploadImages::User_Image($request->image);

    $seller->update(['profile_picture' => $imagePath ]);
};


event(new Send_Welcome_Message($seller->email));

        auth()->guard('seller')->login($seller);

return to_route('seller.dashboard');

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
    public function update(Request $request, string $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {



    }
}
