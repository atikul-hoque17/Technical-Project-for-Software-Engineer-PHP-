@extends('layouts.app')

@section('content')

<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">{{ __('Update Company') }}</div>

                <div class="card-body">

                    @if(Session::has('message'))
                    <p class="alert {{ Session::get('alert-class', 'alert-success') }}">{{ Session::get('message') }}</p>
                    @endif

                    <form name="companyedit" method="POST" action="{{ url('/company/update/') }}" enctype="multipart/form-data">
                        @csrf
 
                        <div class="form-group row">
                            <label for="companyname" class="col-md-4 col-form-label text-md-right">{{ __('Company Name') }}</label>

                            <div class="col-md-6">
                                <input id="companyname" type="text" class="form-control @error('companyname') is-invalid @enderror" name="companyname" value="{{ $companyprofile->companyname }}">

                                @error('companyname')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        </div>

                        <div class="form-group row">
                            <label for="companycategory" class="col-md-4 col-form-label text-md-right">{{ __('Company Category') }}</label>

                            <div class="col-md-6">
                                  <select class="form-control" name="companycategory" required>
                                   @foreach( $categories as $category) 
					                  <option value="{{ $category->id }}">{{ $category->categoryname}}</option>
					                @endforeach           
                                 </select>

                                @error('categoryname')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        </div>

                        <div class="form-group row">
                            <label for="email" class="col-md-4 col-form-label text-md-right">{{ __('No of Employee') }}</label>

                            <div class="col-md-6">
                                <input id="noofemployee" type="text" class="form-control @error('noofemployee') is-invalid @enderror" name="noofemployee" value="{{ $companyprofile->noofemployee }}" >

                                @error('noofemployee')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        </div>

                        <div class="form-group row">
                            <label for="dateofbirth" class="col-md-4 col-form-label text-md-right">{{ __('Website') }}</label>

                            <div class="col-md-6">
                                
                                <input id="website" type="text" class="form-control @error('website') is-invalid @enderror" name="website" value="{{ $companyprofile->website }}">

                                @error('website')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        </div>

                        <div class="form-group row">
                            <label for="dateofbirth" class="col-md-4 col-form-label text-md-right">{{ __('Phone') }}</label>

                            <div class="col-md-6">
                                
                                <input id="phone" type="text" class="form-control @error('phone') is-invalid @enderror" name="phone" value="{{ $companyprofile->phone }}">

                                @error('phone')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        </div>

                        <div class="form-group row">
                            <label for="dateofbirth" class="col-md-4 col-form-label text-md-right">{{ __('Company Email') }}</label>

                            <div class="col-md-6">
                                
                                <input id="companyemail" type="companyemail" class="form-control @error('companyemail') is-invalid @enderror" name="companyemail" value="{{ $companyprofile->companyemail }}" >

                                @error('companyemail')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        </div>

                        <div class="form-group row">
                            <label for="dateofbirth" class="col-md-4 col-form-label text-md-right">{{ __('Address') }}</label>

                            <div class="col-md-6">
                                
                                <input id="address" type="text" class="form-control @error('address') is-invalid @enderror" name="address" value="{{ $companyprofile->address }}" >

                                @error('address')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        </div>

                        <div class="form-group row">
                            <label for="photo" class="col-md-4 col-form-label text-md-right">{{ __('Photo') }}</label>

                            <div class="col-md-6">
                                <input type="file"  name="newlogo">
                            </div>
                        </div>

                        <div class="form-group row">
                            <label for="dateofbirth" class="col-md-4 col-form-label text-md-right">{{ __('Old Logo') }}</label>

                            <div class="col-md-6">
                                
                                 @if($companyprofile->logo =='')         
								    <img style="width: 180px;height: 180px;border: 1px solid #efefef;" src="{{asset('/companyLogo/no_image.jpg')}}">
								 @else
									<img style="width: 180px;height: 180px;border: 1px solid #efefef;" src="{{asset('/' .$companyprofile->logo )}}">
								 @endif

                            </div>
                        </div>

                        <input type="hidden" name="updateid" value="{{ $companyprofile->id }}"> 
                        
                        <div class="form-group row mb-0">
                            <div class="col-md-6 offset-md-4">
                                <button type="submit" class="btn btn-primary">
                                    {{ __('Update') }}
                                </button>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>


 <script type="text/javascript">
                                          
    document.forms['companyedit'].elements['companycategory'].value='{{ $companyprofile -> companycategory }}'
 </script>




@endsection
