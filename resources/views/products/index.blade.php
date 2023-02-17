@extends('layouts.app')

@section('content')
    <div class="d-sm-flex align-items-center justify-content-between mb-4">
        <h1 class="h3 mb-0 text-gray-800">Products</h1>
    </div>


    <div class="card">
        <form action="{{ route('') }}" method="post" class="card-header">
            @csrf
            <div class="form-row justify-content-between">
                <div class="col-md-2">
                    <input type="text" name="title" placeholder="Product Title" class="form-control">
                </div>
                <div class="col-md-2">
                    <select name="variant" id="" class="form-control">
                        @forelse($product_variants as $item)
                            <option value="{{ $item->variant }}"></option>

                        @endforelse

                    </select>
                </div>

                <div class="col-md-3">
                    <div class="input-group">
                        <div class="input-group-prepend">
                            <span class="input-group-text">Price Range</span>
                        </div>
                        <input type="text" name="price_from" aria-label="First name" placeholder="From"
                            class="form-control">
                        <input type="text" name="price_to" aria-label="Last name" placeholder="To" class="form-control">
                    </div>
                </div>
                <div class="col-md-2">
                    <input type="date" name="date" placeholder="Date" class="form-control">
                </div>
                <div class="col-md-1">
                    <button type="submit" class="btn btn-primary float-right"><i class="fa fa-search"></i></button>
                </div>
            </div>
        </form>

        <div class="card-body">
            <div class="table-response">
                <table class="table">
                    <thead>
                        <tr>
                            <th>#</th>
                            <th>Title</th>
                            <th>Description</th>
                            <th>Variant</th>
                            <th width="150px">Action</th>
                        </tr>
                    </thead>

                    <tbody>
                        @foreach ($products as $row)
                            <tr>
                                <td>{{ $row->id }}</td>
                                <td>{{ $row->titele }} <br> {{ $row->created_at->format('d-M-Y') }}</td>
                                <td>{{ $row->description }}</td>
                                <td>
                                    <dl class="row mb-0" style="height: 80px; overflow: hidden" id="variant">


                                        @foreach ($product_variants as $variants)
                                            <dt class="col-sm-3 pb-0">
                                                {{ $variants->variant }}/

                                            </dt>
                                        @endforeach

                                        @foreach ($prices as $price)
                                            <dd class="col-sm-9">
                                                <dl class="row mb-0">
                                                    <dt class="col-sm-4 pb-0">Price :
                                                        {{ $price->price->number_format(200, 2) }}</dt>
                                                    <dd class="col-sm-8 pb-0">InStock :
                                                        {{ $price->stock->number_format(50, 2) }}</dd>
                                                </dl>
                                            </dd>
                                        @endforeach

                                    </dl>
                                    <button onclick="$('#variant').toggleClass('h-auto')" class="btn btn-sm btn-link">Show
                                        more</button>
                                </td>
                                <td>
                                    <div class="btn-group btn-group-sm">
                                        <a href="{{ route('product.edit', 1) }}" class="btn btn-success">Edit</a>
                                    </div>
                                </td>
                            </tr>
                        @endforeach



                    </tbody>

                </table>
            </div>

        </div>

        <div class="card-footer">
            <div class="row justify-content-between">
                <div class="col-md-6">
                    @php
                        $showing = $products->perPage() * ($products->currentPage() - 1) + 1;
                        $to = $products->perPage() * $products->currentPage();
                        $total = $products->total();
                    @endphp
                    <p>
                        Showing {{ $showing > $total ? $total : $showing }}
                        to
                        {{ $to > $total ? $total : $to }}
                        out of
                        {{ $total }}
                    </p>
                </div>
                < {{ $products->links() }} </div>
            </div>
        </div>
    </div>
@endsection
