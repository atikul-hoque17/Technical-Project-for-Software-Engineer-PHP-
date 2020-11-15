

@extends('layouts.app')

@section('content')

<style type="text/css">
  .col-md-10 {
      margin: 0 auto !important;
  }
  a.btn.btn-primary.btn-sm {
    margin: 2px !important;
    width: 60px !important;
  }
  a#delete {
    width: 60px;
    margin: 2px;
  }
</style>


<div class="panel-body">

<div class="col-md-10">

 <div class="card">
        <div class="card-header">{{ __('All Company') }}</div>

        <div class="card-body">
          @if(Session::has('message'))
            <p class="alert {{ Session::get('alert-class', 'alert-success') }}">{{ Session::get('message') }}</p>
          @endif
        </div>

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
                                        <th>Action</th>
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



                                         </td>
                                        <td>{{ $company->address }} </td>
                                        <td class="center">
                                          <a class="btn btn-primary btn-sm" href="{{ url('/company/edit/'. $company->id) }}">Edit
                                          </a>
                                          <a id="delete" class="btn btn-danger btn-sm" href="{{ url('/company/delete/'. $company->id) }}">Delete
                                          </a>

                                        </td>

                                      </tr>
                                     @endforeach
                                </tbody>
                             </table>     

                           



            </div>



</div>




</div>     
                        


@endsection


