@extends('layouts.layout')
<title>create category</title>
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
                <small>Create Category</small>
            </h1>
        </section>
<div class="card push-top">
  <div class="card-header">
    Add Category
  </div>

  <div class="card-body">
    
      <form method="post" action="{{ route('categories.store') }}">
          <div class="form-group">
              @csrf
              <label class="col-form-label col-md-3 col-sm-3 label-align"
                    for="name">Name<span class="required">*</span>
            </label>
            <div>
                <input type="text" id="name" name="name"  value="{{ old('name') }}"
                    class="form-control @error('name') is-invalid @enderror">
                        @error('name')
                            <div class="alert alert-danger">{{ $message }}</div>
                        @enderror
            </div>
          </div>
          
          <button type="submit" class="btn btn-block btn-danger">Create Category</button>
      </form>
  </div>
</div>
@endsection