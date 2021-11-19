<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Product;
use App\Models\ProductImages;
use Image;
class ProductController extends Controller
{
    protected $model; 
    protected $Imagemodel; 
    public function __construct(Product $model,ProductImages $Imagemodel)
    {

      $this->model = $model;
      $this->Imagemodel = $Imagemodel;
    }
    public function index()
    {
      
        $Category = $this->model->orderBy('id','DESC')->get();
        return response()->json($Category);
    }

   
    public function store(Request $request)
    {
        extract($request->all());
       
               unset($request->images);
               $data['title'] = $title;
               $data['category_id'] = $category_id;
               $data['size'] = $size;
               $data['price'] = $price;
               $result = $this->model->insertGetId($data);
             // dd($result);
               //  dd($array);
         if($result)
       {
           //upload image
           if(count($images)>0)
           {
               foreach($images as $image)
               {
                $position = strpos($image,';');
           
                $sub = substr($image,0,$position);
                $ext = explode('/',$sub)[1];
                $name = time().'.'.$ext;
                $img = Image::make($image)->resize(200,240);
                $path = 'uploads/products/';
                $image_url = $path.$name;
                $img->save($image_url);
                $array[] = array(
                    'product_id'=>1,
                    'file'=>$image_url
                );
             }     
               }
               $this->
             //  dd( $array);
              
           //end of upload image
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
