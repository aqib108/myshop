<?php 

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Category;
class CategoryController extends Controller
{
    
    protected $model ; 
    public function __construct(Category $model)
    {
      $this->model = $model;
    }
    public function index()
    {
      
        $Category = $this->model->orderBy('id','DESC')->get();
        return response()->json($Category);
    }

   
    public function store(Request $request)
    {
        
        $validation = $request->validate([
            'name'=>'required|unique:categories',
         ]);
         if($this->model->insert($request->all()))
       {
           $data['status'] = 200;
           $data['message'] = 'Successfully Saved';
       }
       else
       {
        $data['status'] = 401;
        $data['message'] = 'Something Went to Wrong';
       }
       return response()->json($data);
    }

   
    public function show($id)
    {
        $data = $this->model->where('id',$id)->get()[0];
        return response()->json($data);
    }

 
    
  
    public function update(Request $request, $id)
    {
        $validation = $request->validate([
            'category_name'=>'required',
         ]);
        unset($request['id']);
        
         if($this->model->where('id',$id)->update($request->all()))
       {
           $data['status'] = 200;
           $data['message'] = 'Successfully Saved';
       }
       else
       {
        $data['status'] = 401;
        $data['message'] = 'Something Went to Wrong';
       }
       return response()->json($data);
    }

  
    public function destroy($id)
    {
        $Category=$this->model->find($id);
     
        if($Category->delete())
        {
          
          $data['status'] = 200;
          $data['message'] = 'successfully Delete';
        }
        else
        {
          $data['status'] = 401;
          $data['message'] = 'Error in Deletion';
        }
        return response()->json($data);
    }
}
