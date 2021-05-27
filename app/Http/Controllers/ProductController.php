<?php

namespace App\Http\Controllers;
use Illuminate\Support\Facades\File;
use Illuminate\Http\Request;
use App\Models\Product;
use App\Models\Category;
use App\Models\ProductCategory;


class ProductController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        
        $categories = Category::all();
        $products = Product::paginate(10);
        //$products = $category->products()->paginate(2);
        return view('products.index', compact('products'),compact('products'))
        ->with('i', (request()->input('page', 1) - 1) * 10);
        
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $categories = Category::all();
        return view('products.create', compact('categories'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $validated = $request->validate([
            'name' => 'required|max:50|unique:products',
            'description' => 'required|max:250',
            'price' => 'required|min:0|regex:/^\d+(\.\d{1,3})?$/',
            'category_id' => 'required',
        ]);
        if (!empty($request->photo)) {
            $validated = $request->validate([
                'photo' => 'image|mimes:jpeg,png,jpg,gif,svg',
            ]);
        }
        $name = "";
        if (!empty($request->photo)) {
            $name = $request->file('photo')->getClientOriginalName();
            //$path = $request->file('photo')->store('public/uploads',$name);
            $request->photo->move(public_path('uploads/products'), $name);
        }
        $product = Product::create([
            'name' => $request->name,
            'description' => $request->description,
            'price' => $request->price,
            'photo' => $name,
        ]);
        $product->categories()->attach($request->category_id);
        return redirect()->route('products.index')->with('success', 'product created successfully.');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $product = Product::findOrFail($id);
        return view('products.show', compact('product'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $product = Product::findOrFail($id);
        $categories = Category::all();
        return view('products.edit', compact('product'), compact('categories'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
      
        $validated = $request->validate([
            'name' => 'required|max:50|unique:products,name,'.$id,
            'description' => 'required|max:250',
            'price' => 'required|min:0|regex:/^\d+(\.\d{1,3})?$/',
            'category_id' => 'required',
        ]);

        if(!empty($request->photo))
        {
            $validated = $request->validate([
                'photo' => 'image|mimes:jpeg,png,jpg,gif,svg',

            ]);
        }

        $product = Product::findOrFail($id);
        $name="";
        if(!empty($request->photo))
        {
            $image_path = public_path('uploads/products/'.$product->photo);
            if (File::exists($image_path)) {
                File::delete($image_path);
            }
            $name = $request->file('photo')->getClientOriginalName();
            //$path = $request->file('photo')->store('public/uploads',$name);
            $request->photo->move(public_path('uploads/products'), $name);
            $product->update([
                'name' => $request->name,
                'description' => $request->description,
                'price' => $request->price,
                'photo' => $name,
            ]);

        }
        else
        {
            if(!empty($request->old_photo_name))
            {
                $product->update([
                    'name' => $request->name,
                    'description' => $request->description,
                    'price' => $request->price,
                ]);
            }
            else
            {
                $image_path = public_path('uploads/products/'.$product->photo);
                if (File::exists($image_path)) {
                    File::delete($image_path);
                }
                
                $product->update([
                    'name' => $request->name,
                    'description' => $request->description,
                    'price' => $request->price,
                    'photo' => "",
                ]);
            }
        }
        $productcategory = ProductCategory::where('product_category.category_id',$request->category_id)
            ->where('product_category.product_id',$id)->first();
            if($productcategory==null)
            {
                $product->categories()->attach($request->category_id);
            }
        return redirect()->route('products.index')->with('success','product updated successfully');
    }


    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $product = Product::findOrFail($id);
        if(!empty($product->photo))
        {
            $image_path = public_path('uploads/products/'.$product->photo);
            if (File::exists($image_path)) {
                File::delete($image_path);
            }
        }
        $product->delete();
        return redirect()->route('products.index')->with('success', 'product deleted successfully');;
    }

    public function attachToCategory($id)
    {
        $product = Product::findOrFail($id);
        $productCategories = $product->categories;
        $otherCategories = ProductCategory::join('categories','product_category.category_id','!=','categories.id')
       ->where('product_category.product_id', '=' , $id)->select('categories.id','categories.name')->get();
        //dd($otherCategories);
        return view('products.categories', ['product'=>$product,'productCategories'=>$productCategories,'otherCategories'=>$otherCategories]);
    }

    public function deAttachFromCategory($product_id,$category_id)
    {
        $product = Product::findOrFail($product_id);
        $category = Category::findOrFail($category_id);
        $product->categories()->detach($category);
        return redirect()->route('products.attachToCategory',$product->id)->with('success', 'product deatached from category successfully');
    }

    public function saveCategoryWithProduct(Request $request,$id)
    {
        $productcategory = ProductCategory::where('product_category.category_id',$request->category_id)
            ->where('product_category.product_id',$id)->first();
            if($productcategory==null)
            {
                $product = Product::where('id',$id)->first();
                $category = Category::where('id',$request->category_id)->first();
        
                $product->categories()->attach($category);
                return redirect()->route('products.attachToCategory',$id)->with('success', 'product attached to category successfully');
            }
            else
            {
                return redirect()->route('products.attachToCategory',$id)->with('success', 'Error: Product already attached to this category.');
            }
        
    }

    
  
}
