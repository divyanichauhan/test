<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Category;
use DataTables;

class CategoryController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return view('admin.category.index');

    }
    public function CatList(Request $request)
    {
       
            $data = Category::latest()->get();
            return Datatables::of($data)
                    ->addIndexColumn()
                    ->addColumn('image', function ($row) { 
                      return  $url= asset('images/cat/'.$row->image);
                    })
                   
                     ->editColumn('edit', function ($row) {
                       return $edit = '<a href="category/edit/'. $row->id .' " class="edit btn btn-primary btn-sm">Edit</a>';                    
                    })

                     ->addColumn('delete', function ($row) {
                       return $delete = '<a onclick="myFunction('. $row->id .') " class="edit btn btn-danger btn-sm">delete</a>';                    
                    })
                    ->rawColumns(['edit','delete'])
                    ->make(true);
        
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {   
        $cat = Category::where('parentcat',null)->get();
         return view('admin.category.create',compact('cat'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $request->validate([
            'category_name' => 'required',
            'category_description' => 'required',
            'image' => 'required|image|mimes:jpeg,png,jpg,gif,svg|max:2048',

        ]);
        // return $request->all();
        $imageName = time().'.'.$request->image->extension(); 

        $cat = new Category;
        $cat->name=$request->category_name;
        $cat->slug='EN'. $request->_token .time().uniqid();
        $cat->description = $request->category_description;

            if($request->parent_category != null)
            {
             $cat->parentcat  = $request->parent_category;
            }

        $cat->image = $imageName;
        $request->image->move(public_path('images/cat/'), $imageName);
        $cat->save();


         return back()
            ->with('success','You have successfully Save Category.');
            
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $cat = Category::where('parentcat',null)->get();
        $data = Category::find($id);
        return view('admin.category.edit',compact('cat','data'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request)
    {
        // return  $request->all();
          $request->validate([
            'category_name' => 'required',
            'category_description' => 'required',
            'image' => 'required|image|mimes:jpeg,png,jpg,gif,svg|max:2048',

        ]);
        $cat = Category::find($request->id);
        $cat->name = $request->category_name;
        $cat->description = $request->category_description;
        $cat->parentcat = $request->parent_category;

        if($request->file('image'))
        {
            $image_path = public_path().'\images\cat'.'/' .$cat->image;
            unlink($image_path);

             $imageName = time().'.'.$request->image->extension(); 
            $cat->image = $imageName;
            $request->image->move(public_path('images\cat'), $imageName);
        }
           
            $cat->update();

              return back()
            ->with('success','You have successfully update Category.');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
       Category::where('id',$id)->delete();
       return 1;
    }
}
