<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Auth;
use Intervention\Image\ImageManager;
use Intervention\Image\Facades\Image;
use App\Picture;
use Illuminate\Support\Facades\Input;

class AdminController extends Controller
{
    public function login(Request $request){
        if($request->isMethod('post')){
            $data = $request->input();
            if(Auth::attempt(['email'=>$data['email'],'password'=>$data['password'],'admin'=>'1'])){
                return redirect('/admin/picture');
            }
        }
        return view('admin.admin_login');
    }

    public function dashboard(){
        return view('admin.admin_dashboard');
    }

    public function picture(){
        return view('admin.admin_picture');
    }

    public function addPicture(Request $request){
        if($request->isMethod('post')){
            $data = $request->all();
            $picture = new Picture;
            $picture->name = $data['name'];
            $picture->description = $data['description'];
            if(!empty($data['description'])){
                $picture->description = $data['description']; 
            }else{
                $picture->description =''; 
            } 
            //Upload Image
            if($request->hasFile('image')){
                echo $image_tmp = Input::file('image');
                if($image_tmp->isValid()){
                    $extension = $image_tmp->getClientOriginalExtension();
                    $filename = rand(111,99999). '.' . $extension;
                    $image_path = 'images/'.$filename; 
                    //Resize Images
                    Image::make($image_tmp)->save($image_path);
                    $picture->image = $filename;
                }
            }   
            $picture-> save();
            return redirect('/admin/view-picture');
        }
    }
    
    public function viewPicture(){
        $pictures = Picture::get();
        $pictures = json_decode(json_encode($pictures));
        foreach($pictures as $key=>$val){
            $name = Picture::where(['id'=>$val->id])->first();
            $pictures[$key]->name = $name->name;
        }
        return view('admin.view_picture')->with(compact('pictures'));
    }
    
}
