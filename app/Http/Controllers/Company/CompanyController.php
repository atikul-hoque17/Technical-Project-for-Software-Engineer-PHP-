<?php

namespace App\Http\Controllers\Company;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use App\Company;
use App\Category;
use DB;

class CompanyController extends Controller
{
    //
    public function __construct()
    {
      $this->middleware('auth');
    }

    public function index()
    {
      $categories = Category::get();
      return view('company.add_company')->with( ['categories' => $categories] );
    }

    public function save(Request $request){     

      //return response()->json($request);   
      $validatedData = $request->validate([
            'companyname' => ['required', 'string', 'max:255'],
            'companycategory' => ['required', 'string', 'max:255'],
            'noofemployee' => ['required', 'numeric'],
            'website' => ['required', 'string', 'max:255'],
            'phone' =>['required', 'numeric'],
            'companyemail' => ['required', 'string', 'email', 'max:255'],
            'address' => ['required', 'string', 'max:255'],
            'logo' => 'required|image|mimes:jpeg,png,jpg,gif,svg|max:2048',
        ]);

        
        if($picInfo=$request->file('logo')){
           
                $picName=$picInfo->getClientOriginalName();
                $path="companyLogo/";
                $picUrl=$path.$picName;
                $picInfo->move($path,$picName);  
               
        }else{
             $picUrl='';
        }

        
        $CompanyEntry= new Company();
        $CompanyEntry->companyname =$request->companyname;
        $CompanyEntry->companycategory =$request->companycategory;
        $CompanyEntry->noofemployee =$request->noofemployee;
        $CompanyEntry->website =$request->website;
        $CompanyEntry->phone =$request->phone;
        $CompanyEntry->companyemail =$request->companyemail;
        $CompanyEntry->address =$request->address;
        $CompanyEntry->logo =$picUrl;
        $CompanyEntry->save();

        return Redirect()->back()->with('message','Profile Updated Succesfully');
    }


    public function manage(){

       $companies = Company::join('categories','companies.companycategory' , '=', 'categories.id')
       ->select('companies.*','categories.categoryname')
       ->get();

       return view('company.companymanage',['companies'=>$companies]);
       // return response()->json($Company);

    }

    public function editcompany($id )
    {
        
         $companyprofile = Company::where('id',$id)->first();
         $poscategories = Category::all();
         //return response()->json($Company);
         return view('company.edit_company',['companyprofile'=>$companyprofile,'categories'=>$poscategories]);        
    }

    public function update(Request $request)
    {       
        //return response()->json($request);
       
      
        $updateid=$request->updateid;

        $companyfilePic=Company::where('id',$request->updateid)->first();
        $exist_pic=$companyfilePic->logo;

        $picInfo=$request->file('newlogo');  
         
         if($picInfo){
           
            if(file_exists($exist_pic)){           
             unlink($exist_pic);
            }
              $picName=$updateid.$picInfo->getClientOriginalName();
                $path="companyLogo/";
                $picUrl=$path.$picName;
                $picInfo->move($path,$picName);  

                $savepath="companyLogo/";
                $savepicUrl=$savepath.$picName;

            }else{
             $picUrl=$exist_pic;
             $savepicUrl=$picUrl;
            }
             
       
              $CompanyEntry=Company::find($updateid);
              $CompanyEntry->companyname =$request->companyname;
              $CompanyEntry->companycategory =$request->companycategory;
              $CompanyEntry->noofemployee =$request->noofemployee;
              $CompanyEntry->website =$request->website;
              $CompanyEntry->phone =$request->phone;
              $CompanyEntry->companyemail =$request->companyemail;
              $CompanyEntry->address =$request->address;
              $CompanyEntry->logo =$savepicUrl;
              $CompanyEntry->save();

        return Redirect()->back()->with('message','Profile Updated Succesfully');


        }

    public function delete($id){

      $category = Company::where('id', $id)->firstOrFail();
      $category-> delete();       
      return Redirect()->back()->with('message','Company Deleted Succesfully');

    }



}
