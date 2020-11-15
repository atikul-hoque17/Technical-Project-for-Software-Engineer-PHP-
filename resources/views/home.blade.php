@extends('layouts.app')

@section('content')

 
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-11">
            <div class="card">
                <div class="card-header">{{ __('Dashboard') }}</div>

                <div class="card-body">                   
                       <p style="font-weight: bold;    font-size: 24px;    color: #ec6800;"><b>Welcome to my Project</b></p>


                       <?php
if(isset($companies)){
    
    ?>
     <table width="100%" class="table table-striped table-bordered table-hover" id="dataTables-example">
                                <thead>
                                    <tr>
                                        <th>SI.</th>
                                        <th>Compnay Name</th>  
                                        <th>Category Name</th>  
                                        <th>No of Employee</th>  
                                        <th>Website</th>  
                                        <th>Phone</th>  
                                        <th>Company Email</th>  
                                        <th>Logo</th>  
                                        <th>Adress</th>   
                                    </tr>
                                </thead>
                                <tbody>
                                 <?php $i=0; ?>
                                   @foreach( $companies as $company) 
                                       <tr class="odd gradeX">                                                                

                                        <td>{{ ++$i }}</td>
                                        <td>{{ $company->companyname }} </td>
                                        <td>{{ $company-> categoryname }} </td>
                                        <td>{{ $company->noofemployee }} </td>
                                        <td>{{ $company->website }} </td>
                                        <td>{{ $company->phone }} </td>
                                        <td>{{ $company->companyemail }} </td>
                                        <td>

                                          @if($company->logo =='')         
                                              <img style="width: 40px;height: 40px;border: 1px solid #efefef;" src="{{asset('/companyLogo/no_image.jpg')}}">
                                           @else
                                            <img style="height: 40px;width: 40px;" src="{{asset('/' . $company->logo)}}">
                                           @endif

                                        <td>{{ $company->address }} </td>

                                         </td>
                                        
                                      </tr>
                                     @endforeach
                                </tbody>
                             </table>     
    <?php
}
?> 
                  
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
