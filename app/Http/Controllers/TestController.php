<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use Image;

class TestController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        // print_r(phpinfo());
        // $this->middleware('auth');
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index()
    {
        return view('test');
    }
    public function upload(Request $request){
        $validatedData = Validator::make($request->all(), [
            'image'            => 'required|mimes:jpeg,bmp,png',
        ]);
        if ($validatedData->fails()) {
            /*foreach ($validatedData->messages()->getMessages() as $field_name => $messages){
               print_r($messages); // messages are retrieved (publicly)
            }*/
            return redirect('test')
                        ->withErrors($validatedData)
                        ->withInput();
        }
        else{
            $file       = $request->file('image');       
            $upload_dir =  public_path('uploads/'.Date('Y').'/'.Date('m').'/');
            $file_name  = $file->getClientOriginalName();
            $file_ext   = '.'.$file->getClientOriginalExtension();
            $temp_name  = pathinfo($file_name, PATHINFO_FILENAME); echo "<br/>";  
            $num        = 1;
            $append     = '';
            while (file_exists($upload_dir . $temp_name. $append . $file_ext )) {
                $append    = '('.$num.')';
                $file_name = $temp_name. $append . $file_ext; 
                $num++;
            }
            $file->move($upload_dir, $file_name);
            echo $upload_dir.$file_name."<br/>";
            $img = Image::make($upload_dir.$file_name);
            $img->fit(200, 200);
            $img->save($upload_dir.$temp_name. $append.'_thumbnail'. $file_ext);
            
            // echo $img = Image::make($file->getRealPath())->resize(200, 200)->insert($upload_dir.'watermark.png');
           
            // $image = Image::make(sprintf('uploads/%s', $file_name))->resize(200, 200)->save();
        }
    }
}
