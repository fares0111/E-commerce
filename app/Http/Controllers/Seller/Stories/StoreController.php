<?php

namespace App\Http\Controllers\Seller\Stories;

use App\Http\Controllers\Controller;
use App\Jobs\Upload_Multi_Images;
use App\Models\Stories\Store;
use App\Services\FileServices;
use Illuminate\Http\Request;
use Illuminate\Validation\Rule;

use Illuminate\Support\Facades\Auth;
use App\Models\Sellers\Seller;

class StoreController extends Controller
{
    
    public function index()
    {


//return Store::find(27)->Images()->get();
        $Seller = Auth::guard('seller')->user();

        $Stories = $Seller->stories()->with('Images')->get();



        // foreach ($Stories as $Store){
        //     dd($Store);


        // }
      return view('sellers.stories.operations.index',compact('Stories'));


    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('sellers.stories.operations.create');

    }

    /**
     * Store a newly created resource in storage.
     */
    
    public function store(Request $request)
    {

    $request->validate([
    'name' => ['required', 'string', 'min:6','max:100','unique:stores'],
    'description' => ['required', 'string','min:10', 'max:120'],


    'images.*' => [
        'required', 
        'mimes:jpeg,png,jpg,gif,svg',   
        'max:2048',
    ],
],[

   'name.unique' => 'هذا الاسم محجوز',
   'name.min' => 'يجب ان يكون الاسم علي الاقل 6 احرف' 

]);



$Id = Auth::guard('seller')->user()->id;


$Store = Store::create([

'name' => $request->name,
'description' => $request->description,
'seller_id' =>$Id ,

]);

    if ($request->hasFile('images')) {
        $Table = 'store_images'; // اسم الجدول
        $Foregin_Id = 'store_id'; // الحقل المرتبط
        $Id = $Store->id; // ID المتجر
        $Images = $request->images; // الصور المرفوعة
        $Folder = 'store_images'; // المجلد

        // استدعاء الخدمة لرفع الصور
        $Status = FileServices::uploadMultipleImages($Table, $Foregin_Id, $Id, $Images, $Folder);

        if ($Status) {
            return back();
        } else {
            return back();
        }
    }
}


    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {

    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {

        $Store = Store::find($id);

        return view("sellers.stories.operations.edit",compact("Store"));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, int $id)
    {


$request->validate([

    'name' => ['required',
    'min:6',
    'max:100',
    Rule::unique('stores')->ignore($id), 
    'regex:/^[\pL\s]+$/u'
],

    'description' => ['required', 'string','min:10', 'max:120'],

],
[
    'name.required' => 'الاسم مطلوب',
    'name.min' => 'يجب ان يكون الاسم 6 احرف علي الاقل',
    'name.unique' => 'هذا الاسم مستخدم من قبل',
    'name.regex' => 'يجب ان يكون الاسم احرف فقط',
]);

        $Store = Store::find($id);
        

if (!$Store){

session()->flash('status','لقد حدث خطاء حاول مرة اخري');

return to_route('seller.store.index');

}


$Store->name = $request->name;
$Store->description = $request->description;
$Store->save();

session()->flash('status','تم التعديل بنجاح');

return to_route('seller.store.index');

    }

 
    public function destroy(string $id)
    {

        $Store = Store::find($id);

        if(!$Store){

            session()->flash('status','لقد حدث خطاء حاول مرة اخري');

            return to_route('seller.store.index');
        }else{

session()->flash('status','تم حذف المتجر');

$Store->delete();

return to_route('seller.store.index');

        }


    }
}
