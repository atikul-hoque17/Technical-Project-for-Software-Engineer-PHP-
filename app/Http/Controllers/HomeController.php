<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\User;
use App\Company;
use App\Category;
use Illuminate\Support\Facades\Validator;

class HomeController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index()
    {
        return view('home');
    }

    public function editprofile($id )
    {
       // dd($id);
        
         $profileid = User::where('id',$id)->first();
         //return response()->json($profileid);
        return view('edit_profile',['profileid'=>$profileid,]);        
    }

    public function update(Request $request)
    {       
        //return response()->json($request);
       
        $validatedData = $request->validate([
            'name' => ['required', 'string', 'max:255'],
            'username' => ['required', 'string', 'max:255'],
            'email' => ['required', 'string', 'email', 'max:255'],
            'dateofbirth' => ['required'],
        ]);

        
        $updateid=$request->updateid;

        $profilePic=User::where('id',$request->updateid)->first();
        $exist_pic=$profilePic->photo;

        $picInfo=$request->file('newphoto');  
         
         if($picInfo){
           
            if(file_exists($exist_pic)){           
             unlink($exist_pic);
            }
              $picName=$updateid.$picInfo->getClientOriginalName();
                $path="profileImage/";
                $picUrl=$path.$picName;
                $picInfo->move($path,$picName);  

                $savepath="profileImage/";
                $savepicUrl=$savepath.$picName;

            }else{
             $picUrl=$exist_pic;
             $savepicUrl=$picUrl;
            }
             
       
            $updateProfile=User::find($updateid);
            $updateProfile->name=$request->name;
            $updateProfile->username=$request->username;
            $updateProfile->email=$request->email;
            $updateProfile->dateofbirth=$request->dateofbirth;
            $updateProfile->photo=$savepicUrl;
            $updateProfile->save();

        return Redirect()->back()->with('message','Profile Updated Succesfully');


        }


       public function findSearch(Request $request)
            {           
            $search = $request->search;      
           
            $companies = Company::join('categories','companies.companycategory' , '=', 'categories.id')
                ->where('companyname', 'LIKE', '%'.$search.'%')
                ->orWhere('categoryname',  'LIKE', '%'.$search.'%')
               ->get();
        
             return view('home',['companies'=>$companies,]); 
         
            }

}
