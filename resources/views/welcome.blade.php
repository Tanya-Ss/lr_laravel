@extends('layouts.app')

@section('title', 'Главная')
@section('content')
<div class="jumbotron bg-light p-5 rounded-3">
    <div class="container text-center">
        <h1 class="display-4">Добро пожаловать в магазин посуды</h1>
        <p class="lead">Широкий ассортимент качественной посуды для вашего дома</p>
        <hr class="my-4">
        <a href="{{ route('products.index') }}" class="btn btn-primary btn-lg">Перейти в каталог</a>
    </div>
</div>

<div class="container mt-5">
    <h2 class="text-center mb-4">Популярные категории</h2>
    <div class="row">
        @foreach($categories as $category)
        <div class="col-md-4 mb-4">
            <div class="card h-100">
                <div class="card-body">
                    <h5 class="card-title">{{ $category->name }}</h5>
                    <p class="card-text">{{ $category->description }}</p>
                    <a href="{{ route('categories.show', $category) }}" class="btn btn-primary">Смотреть товары</a>
                </div>
            </div>
        </div>
        @endforeach
    </div>
</div>
@endsection