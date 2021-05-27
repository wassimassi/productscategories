@extends('layouts.layout')
<title>edit product</title>
@section('content')

<style>
    .container {
      max-width: 650px;
    }
    .push-top {
      margin-top: 50px;
    }
</style>
<section class="content-header">
    <h1>
        <small>Edit Product</small>
    </h1>
</section>
<div class="card push-top">
  <div class="card-header">
    Edit & Update
  </div>

  <div class="card-body">
    
  <form method="POST" action="{{ route('products.update', $product->id) }}"
                        enctype="multipart/form-data">
                        @csrf
                        @method('PUT')
                        <div class="item form-group">
                            <label class="col-form-label col-md-3 col-sm-3 label-align" for="name">
                               Name
                            </label>
                            <div>
                                <input type="text" id="name" value="{{ $product->name }}" name="name"
                                    class="form-control @error('name') is-invalid @enderror">
                                @error('name')
                                    <div class="alert alert-danger">{{ $message }}</div>
                                @enderror
                            </div>
                        </div>
                        <div class="item form-group">
                            <label class="col-form-label col-md-3 col-sm-3 label-align" for="description">
                                Description
                            </label>
                            <div>
                                <textarea id="description" name="description" rows="5"
                                    class="form-control @error('description') is-invalid @enderror">{{ $product->description }}</textarea>
                                @error('description')
                                    <div class="alert alert-danger">{{ $message }}</div>
                                @enderror
                            </div>
                        </div>
                        <div class="item form-group">
                            <label class="col-form-label col-md-3 col-sm-3 label-align" for="price">
                                Price
                            </label>
                            <div>
                                <input type="text" value="{{ $product->price }}" id="price" name="price"
                                    class="form-control @error('price') is-invalid @enderror">
                                @error('price')
                                    <div class="alert alert-danger">{{ $message }}</div>
                                @enderror
                            </div>
                        </div>
                        <div class="item form-group">
                            <label class="col-form-label col-md-3 col-sm-3 label-align"
                                for="category_id">Ctegory<span class="required">*</span>
                            </label>
                            <div>
                                <select id="category_id" name="category_id"
                                    class="form-control @error('category_id') is-invalid @enderror">
                                    
                                    @foreach ($categories as $category)
                                        <option value="{{ $category->id }}">
                                            {{ $category->name }}
                                        </option>
                                    @endforeach
                                </select>
                                @error('category_id')
                                    <div class="alert alert-danger">{{ $message }}</div>
                                @enderror
                            </div>
                        </div>
                        <div class="item form-group">
                            <label class="col-form-label col-md-3 col-sm-3 label-align"
                                for="photo">{{ __('product.photo') }}
                            </label>
                            <p class="col-form-label col-md-3 col-sm-3 label-align">
                                Remove photo 
                                <input type="button" class="btn btn-danger"
                                onClick="var result = confirm('Are you sure you want to delete this item?'); if(result) {document.getElementById('old_photo_src').style.display='none';document.getElementById('old_photo_name').value='';}" 
                                id="removeoldphoto" value="X">

                            </p>
                            
                            <div>
                            <input type="text" value="{{ $product->photo }}" id="old_photo_name" name="old_photo_name"
                                    readonly class="form-control ">
                            </div>
                            </br>
                            <div>
                                <img id="old_photo_src" src="{{ asset('uploads/products/'.$product->photo) }}" width="400">
                            </div>
                            </br>
                            <div>
                                <p class="label-align">
                                Add new photo
                                <input type="file" id="photo" name="photo" value="{{ $product->photo }}"
                                    class="@error('photo') is-invalid @enderror form-control">
                                @error('photo')
                                    <div class="alert alert-danger mt-1 mb-1">{{ $message }}</div>
                                @enderror
                                </p>
                            </div>

                        </div>
                    </div>
          
          <button type="submit" class="btn btn-block btn-danger">Update product</button>
      </form>
  </div>
</div>
@endsection