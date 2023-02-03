<?php

namespace App\Http\Controllers;

use App\Models\Brand;
use App\Models\Item;
use Exception;
use Illuminate\Http\Request;

class TblItemsController extends Controller
{
    public function index(Request $request){
        $data = Item::where('ItemName', 'LIKE','%'.$request->search.'%')->get();
        return view('items',compact('data'));
    }

    public function addItem(){
        $brandData = Brand::get();
        return view ('Items/addItem', compact('brandData'));

    }

    public function store(Request $request) {
        
        $searchItem = Item::where('ItemName',$request->ItemName)->count();
        
        if($searchItem == 0) {
            $newItem = new Item();
            $newItem->ItemName = $request->ItemName;
            $newItem->ItemPrice = $request->ItemPrice;
            $newItem->ItemUOM = $request->ItemUOM;
            $newItem->BrandID = $request->BrandID;
            $newItem->MinStock = $request->MinStock;
            $newItem->ReorderQty = $request->ReorderQty;
            $newItem->IsActive = $request->IsActive;
            $newItem->save();

            return redirect('/items')->with('success','New inventory item has been added.');
        } else {
            return redirect()->back()->with('error','Inventory item already exist in the database.');
        }
    }

    public function viewItem($id){
        $data = Item::where('ItemID',$id)->get();
        $brandData = Brand::get();
        return view('Items/updateItem', compact('data','brandData'));
    }

    public function updateItem(Request $request){
        $searchItem = Item::where('ItemID','!=',$request->ItemID)->where('ItemName',$request->ItemName)->count();
        $search = Item::where('ItemID',$request->ItemID)->first();

        if($searchItem == 0){
            if($search->ItemName == $request->ItemName && $search->ItemPrice == $request->ItemPrice && $search->ItemUOM == $request->ItemUOM && $search->BrandID == $request->BrandID && $search->MinStock == $request->MinStock && $search->ReorderQty == $request->ReorderQty && $search->IsActive == $request->IsActive) {
                return redirect()->back();
            } else {
                $item = Item::find($request->ItemID);
                $item->ItemName = $request->ItemName;
                $item->ItemPrice = $request->ItemPrice;
                $item->ItemUOM = $request->ItemUOM;
                $item->BrandID = $request->BrandID;
                $item->MinStock = $request->MinStock;
                $item->ReorderQty = $request->ReorderQty;
                $item->IsActive = $request->IsActive;
                $item->save();
    
                return redirect('/items')->with('success','Inventory item has been updated.');
            }
        }else {
            return redirect()->back()->with('error','Inventory item already exist in the database.');
        }
    }

    public function deleteItem($id){
        try{
            $item = Item::find($id);
            $item->delete();
            return redirect('/items')->with('success',' Inventory has been deleted');;
        } catch(Exception $e) {
            return redirect()->back()->with('error','Brand cannot be deleted. This item is referred to by another object.');
        }
       
    }


}
