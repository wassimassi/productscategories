
@extends('layouts.layout')

<title>products</title>
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
                <small>products management</small>
            </h1>
        </section>
        <div class="title_right">
            <div class="col-md-5 col-sm-5 col-xs-12 form-group pull-right top_search">
                <div class="input-group">

                    <a class="btn btn-primary btn-round" href="{{ Route('products.create') }}"><i
                            class="fa fa-plus-circle"></i> new product</a>
                </div>
            </div>
        </div>
        @if ($message = Session::get('success'))
            <div class="alert alert-success">
                <p>{{ $message }}</p>
            </div>
        @endif
        <section class="content">
            <div class="row">
                <div class="col-md-12 col-sm-12 ">
                    <table id="pageTable" class="table table-bordered table-hover dataTable dtr-inline" role="grid">
                        <thead>
                        <tr class="table-warning">
                            <td></td>
                            <td>Name</td>
                            <td>Description</td>
                            <td>Price</td>
                            <td>Category</td>
                            <td class="text-center">Action</td>
                        </tr>
                        </thead>

                        <tbody>
                            @foreach ($products as  $key => $product)
                            <tr>
                                <td>{{ ++$i }}</td>
                                <td>
                                    {{ $product->name }}
                                </td>
                                <td>
                                    {{ $product->description }}
                                </td>
                                <td>
                                    {{ $product->price }}
                                </td>
                                <td>
                                @foreach ($product->categories as $category)
                                    {{ $category->name }},
                                @endforeach
                                </td>

                                <td class="text-center">

                                    <form action="{{ route('products.destroy',$product->id) }}" method="POST">
                                        <a  href="{{ route('products.edit',$product->id) }}" title="edit"
                                        class="btn btn-primary btn-sm">
                                        <i class="fas fa-edit "> Edit</i>
                                        </a>
                                        @csrf
                                        @method('DELETE')
                                        <button onclick="return confirm('Are you sure you want to delete this item?');"
                                            type="submit" title="delete" 
                                            class="btn btn-danger btn-sm"> <i class="fas fa-trash"> Delete</i>

                                        </button>

                                        <a  href="{{ route('products.attachToCategory',$product->id) }}" title="attach to category"
                                        class="btn btn-secondary btn-sm">
                                        <i class="fa fa-tags"> Attach To Category</i>
                                        </a>
                                    </form>
                                </td>
                            </tr>
                            @endforeach
                        </tbody>
                    </table>
                    {!! $products->links() !!}
                </div>

            </div>
        </section>
    </div>

@endsection
