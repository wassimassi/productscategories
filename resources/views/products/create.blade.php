@extends('layouts.layout')
<title>create product</title>
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
                <small>Create Product</small>
            </h1>
        </section>
<div class="card push-top">
  <div class="card-header">
    Add Product
  </div>

  <div class="card-body">
    
  <form  action="{{ Route('products.store') }}" method="POST" enctype="multipart/form-data">
                    @csrf
      <div class="item form-group">
                                                    <label class="col-form-label col-md-3 col-sm-3 label-align"
                                                        for="name">Name<span class="required">*</span>
                                                    </label>
                                                    <div >
                                                        <input type="text" id="name" name="name"  value="{{ old('name') }}"
                                                        class="form-control @error('name') is-invalid @enderror">
                                                        @error('name')
                                                            <div class="alert alert-danger">{{ $message }}</div>
                                                        @enderror
                                                    </div>
                                                </div>
                                                <div class="item form-group">
                                                    <label class="col-form-label col-md-3 col-sm-3 label-align"
                                                        for="description">Description<span class="required">*</span>
                                                    </label>
                                                    <div >
                                                    <textarea id="description" name="description" rows="5"
                                                         class="form-control @error('description') is-invalid @enderror">{{ old('description') }}</textarea>
                                                        @error('description')
                                                            <div class="alert alert-danger">{{ $message }}</div>
                                                        @enderror
                                                    </div>
                                                </div>
                                                <div class="item form-group">
                                                    <label class="col-form-label col-md-3 col-sm-3 label-align"
                                                        for="price">Price<span class="required">*</span>
                                                    </label>
                                                    <div >
                                                        <input type="text" id="price" name="price" value="{{ old('price') }}"
                                                         class="form-control @error('price') is-invalid @enderror">
                                                        @error('price')
                                                            <div class="alert alert-danger">{{ $message }}</div>
                                                        @enderror
                                                    </div>
                                                </div>
                                                <div class="item form-group">
                                                    <label class="col-form-label col-md-3 col-sm-3 label-align"
                                                        for="category_id">Category<span class="required">*</span>
                                                    </label>
                                                    <div >
                                                        <select id="category_id" name="category_id" 
                                                        class="form-control @error('price') is-invalid @enderror">
                                                            
                                                            @foreach($categories as $category)
                                                                <option value="{{ $category->id }}">
                                                                    {{$category->name}}
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
                                                        for="photo">{{ __('service.photo') }}
                                                    </label>
                                                    <div>
                                                    <input type="file" id="photo" name="photo" class="@error('photo') is-invalid @enderror form-control">
                                                        @error('photo')
                                                            <div class="alert alert-danger mt-1 mb-1">{{ $message }}</div>
                                                        @enderror
                                                        </div>
                                                    </div>
                                                </div>
          
          <button type="submit" class="btn btn-block btn-danger">Create Product</button>
      </form>
  </div>
</div>
@endsection