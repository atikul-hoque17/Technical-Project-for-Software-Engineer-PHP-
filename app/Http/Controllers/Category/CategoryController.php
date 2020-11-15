<?php

namespace App\Http\Controllers\Category;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Company;
use App\Category;

class CategoryController extends Controller
{
    //
    public function __construct()
    {
      $this->middleware('auth');
    }

    public function index()
    {
      return view('category.add_category');
    }

    public function save(Request $request){     

	 		//return response()->json($request);   
		  $validatedData = $request->validate([
		    'categoryname' => ['required', 'string', 'max:255','unique:categories'],
		  ]);

	      $categoryEntry= new Category();
	      $categoryEntry->categoryname =$request->categoryname;
	      $categoryEntry->save();

	      return Redirect('/category/manage/')->with('message','Category Inserted Succesfully');
	}

	public function manage(){	
		    $categories = Category::paginate(10);
		    return view('category.categorymanage',['category'=> $categories]);		  
	}

	public function edit($id){

			$category = Category::where('id', $id)->firstOrFail();
			return view('category.categoryedit')->with(compact('category'));

	}

	public function update(Request $request){

		 	// return response()->json($request);
			
		    $category = Category::find($request->catid);
		    $category->categoryname =$request->categoryname;
		    $category->save();
		   			   	
            return Redirect('/category/manage/')->with('message','Category Updated Succesfully');

	}

	public function delete($id){

			$category = Category::where('id', $id)->firstOrFail();
			$category-> delete();				
            return Redirect()->back()->with('message','Category Deleted Succesfully');

	}




}
