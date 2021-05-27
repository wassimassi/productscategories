
@extends('layouts.layout')

<title>product categories</title>
@section('content')

<style>
  .push-top {
    margin-top: 50px;
  }
</style>

@section('content')
    <div>
        <section class="content-header">
            <h1>
                <small>Product: {{$product->name}}</small>
            </h1>
        </section>
        
        @if ($message = Session::get('success'))
            <div class="alert alert-success">
                <p>{{ $message }}</p>
            </div>
        @endif
        <section>
        <section class="content-header">
            <h1>
                <small>here you can add a category to this product</small>
            </h1>
        </section>
        <div class="row">
        <form method="GET" action="{{ route('products.saveCategoryWithProduct', $product->id) }}">
        @method('GET')
        <div class="item form-group">
                                                    <label class="col-form-label col-md-3 col-sm-3 label-align"
                                                        for="category_id">Available Categories
                                                    </label>
                                                    <div >
                                                        <select id="category_id" name="category_id" 
                                                        class="form-control">
                                                            
                                                            @foreach($otherCategories as $othercategory)
                                                                <option value="{{ $othercategory->id }}">
                                                                    {{$othercategory->name}}
                                                                </option>
                                                            @endforeach
                                                        </select>
                                                  
                                                    </div>
                                                </div>
          <button type="submit" class="btn btn-block btn-danger">Update Category</button>
      </form>
                                                
        </div>
        </section>
        <section class="content">
        <section class="content-header">
            <h1>
                <small>here you can find the categories of thid product</small>
            </h1>
        </section>
            <div class="row">
                <div class="col-md-12 col-sm-12 ">
                    <table id="pageTable" class="table table-bordered table-hover dataTable dtr-inline" role="grid">
                        <thead>
                        <tr class="table-warning">
                            <td></td>
                            <td>Category</td>
                            <td class="text-center">Action</td>
                        </tr>
                        </thead>

                        <tbody>
                            @foreach ($productCategories as  $key => $productCategory)
                            <tr>
                                <td></td>
                                <td>
                                    {{ $productCategory->name }}
                                </td>

                                <td class="text-center">

                                    <form action="{{ route('products.deAttachFromCategory',[$product->id,$productCategory->id]) }}" 
                                    method="POST">
                                        
                                        @csrf
                                        
                                        <button onclick="return confirm('Are you sure you want to delete this item?');"
                                            type="submit" title="delete" 
                                            class="btn btn-danger btn-sm"> <i class="fas fa-trash"> Delete</i>

                                        </button>

                                       
                                    </form>
                                </td>
                            </tr>
                            @endforeach
                        </tbody>
                    </table>
                   
                </div>

            </div>
        </section>
    </div>

@endsection
