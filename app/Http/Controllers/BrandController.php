<?php

namespace App\Http\Controllers;

use App\Models\Brand;
use Illuminate\Http\Request;

class BrandController extends Controller
{
    public function index(){
        $data = Brand::get();
        return view('brand',compact('data'));
    }

    public function addBrand(){
        return view ('Brands/addBrand');
    }

    public function store(Request $request) {
        
        $searchBrand = Brand::where('BrandName',$request->BrandName)->count();
        
        if($searchBrand == 0) {
            $newBrand = new Brand();
            $newBrand->BrandName = $request->BrandName;
            $newBrand->IsActive = $request->IsActive;
            $newBrand->save();

            return redirect('/brand');
        } else {
            return redirect()->back()->with('error','Brand name already exist in the database.');
        }
    }
    public function viewBrand($id){
        $data = Brand::where('BrandID',$id)->get();
        return view('Brands/updateBrand', compact('data'));
    }
}
