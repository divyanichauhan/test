@extends('layouts.app')
   
@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
<!--                                     You are Admin.
 -->  
                <div class="card-header">Category</div>

                <div class="card-body">
                  <div class="col-md-8">
                      @if(Session::has('success'))
                        <div class="alert alert-success">
                         {{ Session::get('success') }}
                          @php
                              Session::forget('success');
                          @endphp
                      </div>
                      @endif
                   @if (count($errors) > 0)
                    <div class="alert alert-danger">
                        <strong>Whoops!</strong> There were some problems with your input.
                        <ul>
                            @foreach ($errors->all() as $error)
                                <li>{{ $error }}</li>
                            @endforeach
                        </ul>
                    </div>
                @endif
                    <form action="{{url('admin/category/store')}}" name="cat" id="cat" method="post" enctype="multipart/form-data">
		   		           <input name="_token" type="hidden" value="{{ csrf_token() }}"/>
                      <div class="form-group">
                        <label for="category_name">Category Name</label>
                        <input type="text" class="form-control" id="category_name" name="category_name">
                      </div>
                      <div class="form-group">
                        <label for="category_description">Description:</label>
                        <textarea name="category_description" class="form-control" id="category_description"> </textarea>  
                      </div>
                      <div class="form-group">
                        <label for="parent_category">Parent Category:</label>
                        <select name="parent_category" class="form-control" id="parent_category">
                            <option value="">Select</option>
                            @if(count($cat)>0)
                              @foreach($cat as $data)
                              <option value="{{$data->id}}">{{$data->name}}</option>
                              @endforeach
                            @endif
                        </select>
                      </div>
                      <div class="form-group">
                        <div class="input-group-prepend">
                             <span class="input-group-text" id="inputGroupFileAddon01">Upload</span>
                        </div>
                        <div class="custom-file">
                            <input type="file" class="custom-file-input" id="inputGroupFile01"
                          aria-describedby="inputGroupFileAddon01" name="image">
                            <label class="custom-file-label" for="inputGroupFile01">Choose file</label>
                        </div>
                      </div>
                      
                      <button type="submit" class="btn btn-primary">Submit</button>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>

@endsection
<script>
// 	function readURL(input) {
//     if (input.files && input.files[0]) {
//         var reader = new FileReader();
//         reader.onload = function(e) {
//             $('#imagePreview').css('background-image', 'url('+e.target.result +')');
//             $('#imagePreview').hide();
//             $('#imagePreview').fadeIn(650);
//         }
//         reader.readAsDataURL(input.files[0]);
//     }
// }
// $("#imageUpload").change(function() {
//     readURL(this);
// });
</script>