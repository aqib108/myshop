<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Product;
use App\Models\Category;
use App\Models\ProductImages;
use Image;
use DB;
class ProductController extends Controller
{
    protected $model; 
    protected $Imagemodel; 
    public function __construct(Product $model,ProductImages $Imagemodel)
    {

      $this->model = $model;
      $this->Imagemodel = $Imagemodel;
    }
    function productindex()
    {
      $record = $this->model->with('Images')->get();
      foreach($record as $rd)
      {
        $imagepath = null;
        if(!empty($rd->images))
        {
           $imagepath = $rd->images[0]['file'];
        }
        $products[] = array(
          'product_id'=>$rd->id,
          'title'=>$rd->title,
          'price'=>$rd->price,
          'size'=>$rd->size,
          'category'=>$this->categoryName($rd->category_id),
          'image'=> $imagepath,

        );
      }
     // dd($products);
    // $Category = $this->model->orderBy('id','DESC')->get();
      return response()->json($products);
    }
    public function index()
    {
    
        $record = $this->model->with('Images')->get();
        foreach($record as $rd)
        {
          $products[] = array(
            'product_id'=>$rd->id,
            'title'=>$rd->title,
            'price'=>$rd->price,
            'size'=>$rd->size,
            'category'=>$this->categoryName($rd->category_id),
            'images'=>$rd->Images,

          );
        }
       // dd($products);
      // $Category = $this->model->orderBy('id','DESC')->get();
        return response()->json($products);
    }
   function categoryName($id)
   {
     return Category::where('id',$id)->first()->name;
   }
   
    public function store(Request $request)
    {
      $validation = $request->validate([
        'title'=>'required|unique:products',
        'price'=>'required',
        'category_id'=>'required',
        'description'=>'required',
      
     ]);
        extract($request->all());
       
               unset($request->images);
               $data['title'] = $title;
               $data['category_id'] = $category_id;
               $data['size'] = $size;
               $data['price'] = $price;
               $data['description'] = $description;
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
                    'product_id'=>$result,
                    'file'=>$image_url
                );
             }     
               }
              $this->Imagemodel->insert($array);
             //  dd( $array);
              
           //end of upload image
           $data1['status'] = 200;
           $data1['message'] = 'Successfully Saved';
       }
       else
       {
        $data1['status'] = 401;
        $data1['message'] = 'Something Went to Wrong';
       }
       return response()->json($data1);
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
