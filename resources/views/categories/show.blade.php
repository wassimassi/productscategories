@extends('layouts.layout')
<title>category deatails</title>
@section('content')

<style>
    .container {
      max-width: 650px;
    }
    .push-top {
      margin-top: 50px;
    }
</style>

@section('content')
    <div>
        <section class="content-header">
            <h1>
                <small>Category: {{$category->name}}</small>
            </h1>
        </section>
        
        <section class="content">
        <section class="content-header">
            <h2>
                <small>here you can find the products that belongto this category </small>
            </h2>
        </section>
            <div class="row">
                <div class="col-md-12 col-sm-12 ">
                    <table id="pageTable" class="table table-bordered table-hover dataTable dtr-inline" role="grid">
                        <thead>
                        <tr class="table-warning">
                            <td></td>
                            <td>product mame</td>
                            <td>product description</td>
                            <td>product price</td>
                        </tr>
                        </thead>

                        <tbody>
                            @foreach ($category->products as $product)
                            <tr>
                                <td></td>
                                <td>
                                    {{ $product->name }}
                                </td>
                                <td>
                                    {{ $product->description }}
                                </td>
                                <td>
                                    {{ $product->price }}
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