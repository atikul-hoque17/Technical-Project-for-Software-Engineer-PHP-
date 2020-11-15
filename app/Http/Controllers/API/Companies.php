<?php

namespace App\Http\Controllers\API;


use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use App\Company;
use App\Category;


class Companies extends Controller
{
    //
    public function index()
    {
        $companies = Company::join('categories','companies.companycategory' , '=', 'categories.id')
       ->select('companies.*','categories.categoryname')
       ->get();
        // // return Response::json($users);
        // //return json_decode($users);
         return response()->json($companies);
    }
}
