@extends('layouts.app')

@section('title', 'Каталог посуды')
@section('content')
<div class="container">
    <div class="row mb-4">
        <div class="col-md-6">
            <h1>Каталог посуды</h1>
        </div>
        <div class="col-md-6">
            <form action="{{ route('products.index') }}" method="GET">
                <div class="input-group">
                    <input type="text" name="search" class="form-control" placeholder="Поиск..." value="{{ request('search') }}">
                    <button class="btn btn-outline-secondary" type="submit">Найти</button>
                </div>
            </form>
        </div>
    </div>

    <div class="row">
        <div class="col-md-3">
            <div class="card mb-4">
                <div class="card-header">Фильтры</div>
                <div class="card-body">
                    <h5 class="card-title">Категории</h5>
                    <div class="list-group">
                        @foreach($categories as $category)
                        <a href="{{ route('products.index', ['category' => $category->id]) }}" 
                           class="list-group-item list-group-item-action {{ request('category') == $category->id ? 'active' : '' }}">
                            {{ $category->name }}
                        </a>
                        @endforeach
                    </div>

                    <h5 class="card-title mt-3">Материалы</h5>
                    <div class="list-group">
                        @foreach($materials as $material)
                        <a href="{{ route('products.index', ['material' => $material->id]) }}" 
                           class="list-group-item list-group-item-action {{ request('material') == $material->id ? 'active' : '' }}">
                            {{ $material->name }}
                        </a>
                        @endforeach
                    </div>
                </div>
            </div>
        </div>

        <div class="col-md-9">
            <div class="row">
                @foreach($products as $product)
                <div class="col-md-4 mb-4">
                    <div class="card h-100">
                        <div class="card-body">
                            <h5 class="card-title">{{ $product->name }}</h5>
                            <p class="text-muted">{{ $product->category->name }}</p>
                            <p class="card-text">{{ Str::limit($product->description, 100) }}</p>
                            <div class="d-flex justify-content-between align-items-center">
                                <span class="h5">{{ number_format($product->price, 2) }} ₽</span>
                                <div>
                                    <a href="{{ route('products.show', $product) }}" class="btn btn-sm btn-outline-primary">Подробнее</a>
                                    <button class="btn btn-sm btn-primary add-to-cart" data-id="{{ $product->id }}">В корзину</button>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                @endforeach
            </div>

            <div class="d-flex justify-content-center">
                {{ $products->links() }}
            </div>
        </div>
    </div>
</div>
@endsection

@push('scripts')
<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
<script>
$(document).ready(function() {
    $('.add-to-cart').on('click', function(e) {
        e.preventDefault();
        
        var $button = $(this);
        var productId = $button.data('id');
        
        $button.html('<span class="spinner-border spinner-border-sm" role="status" aria-hidden="true"></span> Добавляем...');
        $button.prop('disabled', true);
        
        $.ajax({
            url: '{{ route("cart.add") }}',
            method: 'POST',
            data: {
                _token: '{{ csrf_token() }}',
                product_id: productId,
                quantity: 1
            },
            success: function(response) {
                $button.html('В корзину');
                $button.prop('disabled', false);
                
                alert('Товар успешно добавлен в корзину');
                
                if (typeof updateCartCounter === 'function') {
                    updateCartCounter();
                }
            },
            error: function(xhr) {
                $button.html('В корзину');
                $button.prop('disabled', false);
                
                var errorMessage = xhr.responseJSON && xhr.responseJSON.message 
                    ? xhr.responseJSON.message 
                    : 'Произошла ошибка при добавлении товара';
                alert(errorMessage);
            }
        });
    });
});
</script>
@endpush