<?php

namespace App\Http\Controllers\Seller\Auth;

use App\Events\Mails\Send_Welcome_Message;
use App\Http\Controllers\Controller;
use App\Models\Sellers\Seller;
use App\Services\FileServices;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Illuminate\Validation\Rules;

class RegisterSellerController extends Controller
{

    
    public $Image = null;
    public $Folder = 'seller_profile_picture';
    public $Guard = 'seller';



    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        return response()->json(['message' => 'Account created successfully','data'=>'fares'], 201);

}

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {

      $Countries = DB::table('countries')->get();
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

        
        event(new Send_Welcome_Message($seller->email));

        auth()->guard($this->Guard)->login($seller);
        

if($request->hasFile('image')){

    $this->Image = $request->image;
 
    $imagePath =  FileServices::User_Image($this->Image,$this->Folder,$this->Guard);

    //everything happens in User_Image add anything you want here


};



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
