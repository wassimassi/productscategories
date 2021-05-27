<?php

namespace App\Http\Controllers\API;

use Illuminate\Http\Request;
use App\Http\Controllers\API\BaseController as BaseController;
use App\Models\Product;
use App\Models\Category;
use App\Models\ProductCategory;
use App\Http\Resources\ProductResource as ProductResource;
use Validator;

class ProductController extends BaseController
{
     /**
     * @OA\GET(
     *      path="/api/products",
     *      operationId="getproducts",
     *      tags={"products"},
     *      summary="Get list of products",
     *      description="Returns list of products",
     *      @OA\Response(
     *          response=200,
     *          description="Successful operation",
     *          @OA\MediaType(
     *           mediaType="application/json",
     *      )
     *      ),
     *      @OA\Response(
     *          response=401,
     *          description="Unauthenticated",
     *      ),
     *      @OA\Response(
     *          response=403,
     *          description="Forbidden"
     *      ),
     * @OA\Response(
     *      response=400,
     *      description="Bad Request"
     *   ),
     * @OA\Response(
     *      response=404,
     *      description="not found"
     *   ),
     *  )
     **/
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $products = Product::all();    
        return $this->sendResponse(ProductResource::collection($products), 'categories retrieved successfully.');
    }

   /**
     * @OA\Post(
     ** path="/api/products",
     *   tags={"products"},
     *   summary="add product",
     *   operationId="addproduct",
     *  security={
     *      {
     *          "passport": {}},
     *      },
     *  @OA\Parameter(
     *      name="name",
     *      in="query",
     *      required=true,
     *      @OA\Schema(
     *           type="string"
     *      )
     *   ),
     *  @OA\Parameter(
     *      name="description",
     *      in="query",
     *      required=true,
     *      @OA\Schema(
     *           type="string"
     *      )
     *   ),
     *  
     *   @OA\Parameter(
     *      name="price",
     *      in="query",
     *      required=true,
     *      
     *   ),
     *   @OA\Response(
     *      response=201,
     *       description="Success",
     *      @OA\MediaType(
     *           mediaType="application/json",
     *      )
     *   ),
     *   @OA\Response(
     *      response=401,
     *       description="Unauthenticated"
     *   ),
     *   @OA\Response(
     *      response=400,
     *      description="Bad Request"
     *   ),
     *   @OA\Response(
     *      response=404,
     *      description="not found"
     *   ),
     *      @OA\Response(
     *          response=403,
     *          description="Forbidden"
     *      )
     *)
     **/
    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $input = $request->all();
   
        $validator = Validator::make($input, [
            'name' => 'required|max:50|unique:products',
            'description' => 'required|max:250',
            'price' => 'required|min:0|regex:/^\d+(\.\d{1,3})?$/',
            
        ]);
   
        if($validator->fails()){
            return $this->sendError('Validation Error.', $validator->errors());       
        }
        
        $product = Product::create($input);
   
        return $this->sendResponse(new ProductResource($product), 'Product created successfully.');
    }
    /**
     * @OA\GET(
     ** path="/api/products/{id}",
     *   tags={"products"},
     *   summary="product Detail",
     *
     *   @OA\Parameter(
     *      name="id",
     *      in="path",
     *      required=true,
     *      @OA\Schema(
     *           type="integer"
     *      )
     *   ),
     *
     *   @OA\Response(
     *      response=200,
     *       description="Success",
     *      @OA\MediaType(
     *           mediaType="application/json",
     *      )
     *   ),
     *   @OA\Response(
     *      response=401,
     *      description="Unauthenticated"
     *   ),
     *   @OA\Response(
     *      response=400,
     *      description="Bad Request"
     *   ),
     *   @OA\Response(
     *      response=404,
     *      description="not found"
     *   ),
     *      @OA\Response(
     *          response=403,
     *          description="Forbidden"
     *      )
     *)
     **/
    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $product = Product::findOrFail($id);
  
        if (is_null($product)) {
            return $this->sendError('Product not found.');
        }
   
        return $this->sendResponse(new ProductResource($product), 'Product retrieved successfully.');
    }

    /**
     * @OA\PUT(
     ** path="/api/products/{id}",
     *   tags={"products"},
     *   summary="apdate product",
     *   operationId="apdateproduct",
     * 
     * @OA\Parameter(
     *      name="id",
     *      in="path",
     *      required=true,
     *      @OA\Schema(
     *           type="integer"
     *      )
     *   ),
     * security={
     *      {
     *          "passport": {}},
     *      },
     *  @OA\Parameter(
     *      name="name",
     *      in="query",
     *      required=true,
     *      @OA\Schema(
     *           type="string"
     *      )
     *   ),
     *  @OA\Parameter(
     *      name="description",
     *      in="query",
     *      required=true,
     *      @OA\Schema(
     *           type="string"
     *      )
     *   ),
     *  
     *   @OA\Parameter(
     *      name="price",
     *      in="query",
     *      required=true,
     *      
     *   ),
     *   @OA\Response(
     *      response=201,
     *       description="Success",
     *      @OA\MediaType(
     *           mediaType="application/json",
     *      )
     *   ),
     *   @OA\Response(
     *      response=401,
     *       description="Unauthenticated"
     *   ),
     *   @OA\Response(
     *      response=400,
     *      description="Bad Request"
     *   ),
     *   @OA\Response(
     *      response=404,
     *      description="not found"
     *   ),
     *      @OA\Response(
     *          response=403,
     *          description="Forbidden"
     *      )
     *)
     **/

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {

        $input = $request->all();
   
        $validator = Validator::make($input, [
            'name' => 'required|max:50|unique:products,name,'.$id,
            'description' => 'required|max:250',
            'price' => 'required|min:0|regex:/^\d+(\.\d{1,3})?$/',
        ]);
   
        if($validator->fails()){
            return $this->sendError('Validation Error.', $validator->errors());       
        }
        $product = Product::findOrFail($id);
        $product->update($request->all());
   
        return $this->sendResponse(new ProductResource($product), 'Product updated successfully.');
    }
    /**
     * @OA\DELETE(
     ** path="/api/products/{id}",
     *   tags={"products"},
     *   summary="delete product",
     * security={
     *      {
     *          "passport": {}},
     *      },
     *
     *   @OA\Parameter(
     *      name="id",
     *      in="path",
     *      required=true,
     *      @OA\Schema(
     *           type="integer"
     *      )
     *   ),
     *
     *   @OA\Response(
     *      response=200,
     *       description="Success",
     *      @OA\MediaType(
     *           mediaType="application/json",
     *      )
     *   ),
     *   @OA\Response(
     *      response=401,
     *      description="Unauthenticated"
     *   ),
     *   @OA\Response(
     *      response=400,
     *      description="Bad Request"
     *   ),
     *   @OA\Response(
     *      response=404,
     *      description="not found"
     *   ),
     *      @OA\Response(
     *          response=403,
     *          description="Forbidden"
     *      )
     *)
     **/
    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $product = Product::where('id',$product_id)->first();
        if($product==null )
        {
            return $this->sendError( [],'Error: Product not found');

        }
        else{
            $product->delete();
            return $this->sendResponse([], 'Product deleted successfully.');
        }
    }

     /**
     * @OA\PUT(
     ** path="/api/products/attachToCategory/{product_id}/{category_id}",
     *   tags={"products"},
     *   summary="attach product with a category ",
     *   operationId="attach product with a category",
     * security={
     *      {
     *          "passport": {}},
     *      },
     * 
     * @OA\Parameter(
     *      name="product_id",
     *      in="path",
     *      required=true,
     *      @OA\Schema(
     *           type="integer"
     *      )
     *   ),
     * @OA\Parameter(
     *      name="category_id",
     *      in="path",
     *      required=true,
     *      @OA\Schema(
     *           type="integer"
     *      )
     *   ),
     *   @OA\Response(
     *      response=201,
     *       description="Success",
     *      @OA\MediaType(
     *           mediaType="application/json",
     *      )
     *   ),
     *   @OA\Response(
     *      response=401,
     *       description="Unauthenticated"
     *   ),
     *   @OA\Response(
     *      response=400,
     *      description="Bad Request"
     *   ),
     *   @OA\Response(
     *      response=404,
     *      description="not found"
     *   ),
     *      @OA\Response(
     *          response=403,
     *          description="Forbidden"
     *      )
     *)
     **/
    public function attachToCategory($product_id, $category_id)
    {

        $product = Product::where('id',$product_id)->first();
        $category = Category::where('id',$category_id)->first();
        if($product==null )
        {
            return $this->sendError( [],'Error: Product not found');

        }
        else if($category==null)
        {
            return $this->sendError( [],'Error: category not found');

        }
        else
        {
       
            $productcategory = ProductCategory::where('product_category.category_id',$category_id)
            ->where('product_category.product_id',$product_id)->first();
            if($productcategory==null)
            {
                ProductCategory::create(
                    [
                        'product_id'=>$product_id,
                        'category_id'=>$category_id
                    ]
                );
        
                return $this->sendResponse( [],'Product attached to category successfully.');
            }
            else
            {
                return $this->sendError( [],'Error: Product already attached to this category.');
            }
        }
    }
/**
     * @OA\PUT(
     ** path="/api/products/deAttachFromCategory/{product_id}/{category_id}",
     *   tags={"products"},
     *   summary="deattach product from a category ",
     *   operationId="attach product from a category",
    *  security={
     *      {
     *          "passport": {}},
     *      }, 
     * @OA\Parameter(
     *      name="product_id",
     *      in="path",
     *      required=true,
     *      @OA\Schema(
     *           type="integer"
     *      )
     *   ),
     * @OA\Parameter(
     *      name="category_id",
     *      in="path",
     *      required=true,
     *      @OA\Schema(
     *           type="integer"
     *      )
     *   ),
     *   @OA\Response(
     *      response=201,
     *       description="Success",
     *      @OA\MediaType(
     *           mediaType="application/json",
     *      )
     *   ),
     *   @OA\Response(
     *      response=401,
     *       description="Unauthenticated"
     *   ),
     *   @OA\Response(
     *      response=400,
     *      description="Bad Request"
     *   ),
     *   @OA\Response(
     *      response=404,
     *      description="not found"
     *   ),
     *      @OA\Response(
     *          response=403,
     *          description="Forbidden"
     *      )
     *)
     **/
    public function deAttachFromCategory($product_id,$category_id)
    {
        //$product = Product::findOrFail($product_id);
        //$category = Category::findOrFail($category_id);
        //$product->categories()->detach($category);

        $productcategory = ProductCategory::where('product_id',$product_id)
        ->where('category_id',$category_id)->first();
        if($productcategory!=null)
        {
            $productcategory->delete();    
            return $this->sendResponse( [],'Product deattached from category successfully.');
        }
        else
        {
            return $this->sendError( [],'Error: this Product not attached to this category');
        }
    }

}
