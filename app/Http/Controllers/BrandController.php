<?php

namespace App\Http\Controllers;

use App\Models\Brand;
use Exception;
use Illuminate\Http\Request;

class BrandController extends Controller
{
    public function index(Request $request){
        $data = Brand::where('BrandName', 'LIKE','%'.$request->search.'%')->get();
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

            return redirect('/brand')->with('success','New brand name has been added.');
        } else {
            return redirect()->back()->with('error','Brand name already exist in the database.');
        }
    }

    public function viewBrand($id){
        $data = Brand::where('BrandID',$id)->get();
        return view('Brands/updateBrand', compact('data'));
    }

    public function updateBrand(Request $request){
        $searchBrand = Brand::where('BrandID','!=',$request->BrandID)->where('BrandName',$request->BrandName)->count();
        $search = Brand::where('BrandID',$request->BrandID)->first();
        
        if($searchBrand == 0){

            if($search->BrandID == $request->BrandID && $search->BrandName == $request->BrandName && $search->IsActive == $request->IsActive) {
                return redirect()->back();
            } else {
                $brand = Brand::find($request->BrandID);
                $brand->BrandName = $request->BrandName;
                $brand->IsActive = $request->IsActive;
                $brand->save();
    
                return redirect('/brand')->with('success','Brand has been updated.');
            }
        }else {
            return redirect()->back()->with('error','Brand name already exist in the database.');
        }
    }

    public function deleteBrand($id){
        try{
            $brand = Brand::find($id);
            $brand->delete();
            return redirect('/brand')->with('success',' Brand has been deleted');;
        } catch(Exception $e) {
            return redirect()->back()->with('error','Brand cannot be deleted. This item is referred to by another object.');
        }
       
    }
}