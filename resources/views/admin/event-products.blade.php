@extends('layouts.admin')
@section('wfdata', '6221e4bcc0ed2f0edb5997e8')
@section('title', 'Movie Hall - E-STALLS')
@section('content') 
<style>
    .header-container {
        display: flex;
        justify-content: space-between;
        align-items: center;
        margin-bottom: 20px;
    }
    @media (min-width: 576px) and (max-width: 768px) {
        .products-grid {
            grid-template-columns: 1fr 1fr !important;
        }
    }
    @media (min-width: 768px) {
        .products-grid {
            grid-template-columns: 1fr 1fr 1fr !important;
        }
    }
</style>

<div class="container w-container">
    {{-- <h1 class="dark">Filmzaal</h1> --}}
    <div class="header-container">
        <h1 class="dark">Products</h1>
        <a href="{{ url('admin/events') }}" class="button w-button">Back</a>
    </div>
    <div class="products-grid">
        @foreach($products as $product)
        <div class="product-card">
            <figure class="product-card__header"> 
                <img class="product-card__header__bg" src="{{ asset('uploads/products') }}/{{ $product->image_url }}" alt="{{$product->name}}" loading="lazy">
            </figure>
            <div class="product-card__body">
                <h3 class="product-card__body__title">Product: {{$product->name}}</h3>
                <p class="card-text text-muted">{{ $product->description }}</p>
                <p class="product-card__body__text light">Prijs: {{$product->price}}</p>
                <p class="product-card__body__text light">Aantal: {{$product->stock}}</p>
                <span class="fw-bold" style="color: #D0A446; display: block; margin-bottom: 8px">BTW: {{ $product->tax }}% </span>
                @if ($product->size == 'yes')
                    <p class="product-card__body__text light">Maat: 
                        @foreach ($product->productSize as $size)
                            {{ $size->name }} - {{ $size->stock }}{{ $loop->last ? '':', ' }}
                        @endforeach
                    </p>
                @endif 
            </div>
        </div>
        @endforeach
    </div>
</div>

 
<script>
     
</script>
@endsection