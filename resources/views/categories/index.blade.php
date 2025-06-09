@extends('layouts.app')

@section('title', 'Категории посуды')
@section('content')
<div class="container">
    <h1 class="mb-4">Категории посуды</h1>
    
    <div class="row">
        @foreach($categories as $category)
        <div class="col-md-4 mb-4">
            <div class="card h-100">
                <div class="card-body">
                    <h5 class="card-title">{{ $category->name }}</h5>
                    <p class="card-text">{{ Str::limit($category->description, 100) }}</p>
                    <p class="text-muted">Товаров: {{ $category->products_count }}</p>
                    <a href="{{ route('categories.show', $category) }}" class="btn btn-primary">Смотреть товары</a>
                </div>
            </div>
        </div>
        @endforeach
    </div>
</div>
@endsection