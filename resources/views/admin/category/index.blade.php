@extends('layouts.app')
    
 
    <link href="https://cdn.datatables.net/1.10.16/css/jquery.dataTables.min.css" rel="stylesheet">
    <link href="https://cdn.datatables.net/1.10.19/css/dataTables.bootstrap4.min.css" rel="stylesheet">
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.9.1/jquery.js"></script>  
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery-validate/1.19.0/jquery.validate.js"></script>
    <script src="https://cdn.datatables.net/1.10.16/js/jquery.dataTables.min.js"></script>
     <script src="https://cdn.datatables.net/1.10.19/js/dataTables.bootstrap4.min.js"></script>
@section('content')

<div class="container">
    <div class="row justify-content-center">
                <h2>Category  DataTable</h2>
                <a href="{{ URL::to('admin/category/create') }}">create</a>
            <table class="table table-bordered" id="laravel_datatable">
               <thead>
                  <tr>
                     <th>Id</th>
                     <th>Image</th>
                     <th>Name</th>
                     <th>Description</th>
                     <th>Edit</th>
                     <th>Delete</th>
                  </tr>
               </thead>
            </table>
     </div>
</div>
@endsection

<script>
   $(function () {
    show();
  });

  function myFunction(id)
  {
    $.ajax({
      url:"{{url('admin/category/delete')}}"+'/'+id,
      success:function(result){
        console.log(result);
             $('#laravel_datatable').DataTable().ajax.reload();

      }
    })
  }

  function show(){
      var table = $('#laravel_datatable').DataTable({
        processing: true,
        serverSide: true,
        ajax: "{{url('cat-list') }}",
        columns: [
            {data: 'DT_RowIndex', name: 'DT_RowIndex'},
            {data:'image',name:'image',
            render: function (data, type, full, meta) {
        return "<img src=\"" + data + "\" height=\"50\"/>";
          },
          },
            {data: 'name', name: 'name'},
            {data: 'description', name: 'description'},

            // {data: 'action', name: 'action', orderable: false, searchable: false},
            {data: 'edit', name: 'edit', orderable: false, searchable: false},
            {data: 'delete', name: 'delete', orderable: false, searchable: false}

        ]
    });
  }
  </script>