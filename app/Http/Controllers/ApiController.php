<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\Items;

class ApiController extends Controller
{
      public function createItems(Request $request) {
        // logic to create a student record goes here
        $item = new Items;
        $item->recipient = $request->recipient;
        $item->title = $request->title;
        $item->status = isset($request->status) ?$request->status :0;
        $item->watched = isset($request->watched) ?$request->watched :0;
        $item->video = $request->video;
        $item->save();
    
        return response()->json([
            "message" => "item record created"
        ], 201);      
      }
  
      public function getAllItems() {
          $items = Items::get()->toJson(JSON_PRETTY_PRINT);
          return response($items, 200);
        }

      public function getItem($id) {
        if (Items::where('id', $id)->exists()) {
            $item = Items::where('id', $id)->get()->toJson(JSON_PRETTY_PRINT);
            return response($item, 200);
          } else {
            return response()->json([
              "message" => "Item not found"
            ], 404);
          }          
      }
  
      public function updateItem(Request $request, $id) {
        if (Items::where('id', $id)->exists()) {
            $item = Items::find($id);
    
            $item->recipient = is_null($request->recipient) ? $item->recipient : $request->recipient;
            $item->title = is_null($request->title) ? $item->title : $request->title;
            $item->status = is_null($request->status) ? $item->status : $request->status;
            $item->watched = is_null($request->watched) ? $item->watched : $request->watched;
            $item->video = is_null($request->video) ? $item->video : $request->video;
            $item->save();
    
            return response()->json([
              "message" => "items updated successfully"
            ], 200);
          } else {
            return response()->json([
              "message" => "Item not found"
            ], 404);
          }
      }
  
      public function deleteItem ($id) {
        if(Items::where('id', $id)->exists()) {
            $item = Items::find($id);
            $item->delete();
    
            return response()->json([
              "message" => "items deleted"
            ], 202);
          } else {
            return response()->json([
              "message" => "Item not found"
            ], 404);
          }          
      }

      public function testUpload(Request $request){
        if($request->hasFile('video')){
            $file = $request->file('video');
            $destinationPath = 'video_uploaded/';
            $filename=strtotime(date('Y-m-d-H:isa')).$file->getFilename().".".$file->extension();
            $full_url = $destinationPath.$filename;
            $file->move($destinationPath, $filename);

            /*$item = Items::find(1); id pass
            $item->video = $full_url;
            $item->save();*/
        }
        return $full_url;
    }

}