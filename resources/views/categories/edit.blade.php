@extends('layouts.layout')
<title>edit categories</title>
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
        <small>Edit Category</small>
    </h1>
</section>
<div class="card push-top">
  <div class="card-header">
    Edit & Update
  </div>

  <div class="card-body">
    
      <form method="post" action="{{ route('categories.update', $category->id) }}">
      @csrf
                        @method('PUT')
                        <div class="item form-group">
                            <label class="col-form-label col-md-3 col-sm-3 label-align" for="name">
                                Name:
                            </label>
                            <div >
                                <input type="text" id="name" value="{{ $category->name }}" name="name"
                                    class="form-control @error('name') is-invalid @enderror">
                                @error('name')
                                    <div class="alert alert-danger">{{ $message }}</div>
                                @enderror
                            </div>
                        </div>
          
          <button type="submit" class="btn btn-block btn-danger">Update Category</button>
      </form>
  </div>
</div>
@endsection