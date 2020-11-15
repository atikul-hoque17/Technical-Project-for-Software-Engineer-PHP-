@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">{{ __('All Category') }}</div>

                <div class="card-body">
	                @if(Session::has('message'))
						<p class="alert {{ Session::get('alert-class', 'alert-success') }}">{{ Session::get('message') }}</p>
					@endif
				</div>

 				<table width="100%" class="table table-striped table-bordered table-hover" id="dataTables-example">
                                <thead>
                                    <tr>
                                        <th>SI.</th>
                                        <th>Category Name</th>           
                                        <th>Action</th>
                                    </tr>
                                </thead>
                                <tbody>
                                 <?php $i=0; ?>
                                   @foreach( $category as $catname) 
                                       <tr class="odd gradeX">                                                                

                                        <td>{{ ++$i }}</td>
                                        <td>{{ $catname->categoryname }} </td>
                                        <td class="center">
                                          <a class="btn btn-primary btn-sm" href="{{ url('/category/edit/'. $catname->id) }}">Edit
                                          </a>
                                          <a id="delete" class="btn btn-danger btn-sm" href="{{ url('/category/delete/'. $catname->id) }}">Delete
                                          </a>

                                        </td>

                                      </tr>
                                     @endforeach
                                </tbody>
                             </table>     

                           {{ $category->onEachSide(3)->links() }}



            </div>
        </div>
    </div>
</div>
@endsection
