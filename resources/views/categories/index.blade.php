
@extends('layouts.layout')

<title>categories</title>
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
                <small>categories management</small>
            </h1>
        </section>
        <div class="title_right">
            <div class="col-md-5 col-sm-5 col-xs-12 form-group pull-right top_search">
                <div class="input-group">

                    <a class="btn btn-primary btn-round" href="{{ Route('categories.create') }}"><i
                            class="fa fa-plus-circle"></i> new category</a>
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
                            <td class="text-center">Action</td>
                        </tr>
                        </thead>

                        <tbody>
                            @foreach ($categories as  $key => $category)
                            <tr>
                                <td>{{ ++$i }}</td>
                                <td>
                                    {{ $category->name }}
                                </td>

                                <td class="text-center">

                                    <form action="{{ route('categories.destroy',$category->id) }}" method="POST">
                                        <a  href="{{ route('categories.edit',$category->id) }}" title="edit"
                                        class="btn btn-primary btn-sm">
                                        <i class="fas fa-edit "> Edit</i>
                                        </a>
                                        @csrf
                                        @method('DELETE')
                                        <button onclick="return confirm('Are you sure you want to delete this item?');"
                                            type="submit" title="delete" 
                                            class="btn btn-danger btn-sm"> <i class="fas fa-trash"> Delete</i>

                                        </button>
                                        <a  href="{{ route('categories.show',$category->id) }}" title="show"
                                        class="btn btn-primary btn-sm">
                                        <i class="fas fa-eye "> Show</i>
                                        </a>
                                    </form>
                                </td>
                            </tr>
                            @endforeach
                        </tbody>
                    </table>
                    {!! $categories->links() !!}
                </div>

            </div>
        </section>
    </div>

@endsection
