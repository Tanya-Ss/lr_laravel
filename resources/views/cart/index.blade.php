@extends('layouts.app')

@section('title', 'Корзина')
@section('content')
<div class="container">
    <h1 class="mb-4">Корзина</h1>
    
    @if(count($cart) > 0)
    <div class="table-responsive">
        <table class="table">
            <thead>
                <tr>
                    <th>Товар</th>
                    <th>Цена</th>
                    <th>Количество</th>
                    <th>Сумма</th>
                    <th></th>
                </tr>
            </thead>
            <tbody>
                @foreach($products as $product)
                <tr>
                    <td>
                        <div class="d-flex align-items-center">
                            <div>
                                <h6 class="mb-0">{{ $product->name }}</h6>
                                <small class="text-muted">{{ $product->category->name }}</small>
                            </div>
                        </div>
                    </td>
                    <td>{{ number_format($product->price, 2) }} ₽</td>
                    <td>
                        <div class="input-group" style="width: 120px;">
                            <button class="btn btn-outline-secondary update-cart" data-id="{{ $product->id }}" data-action="decrement">-</button>
                            <input type="text" class="form-control text-center" value="{{ $cart[$product->id]['quantity'] }}" readonly>
                            <button class="btn btn-outline-secondary update-cart" data-id="{{ $product->id }}" data-action="increment">+</button>
                        </div>
                    </td>
                    <td>{{ number_format($product->price * $cart[$product->id]['quantity'], 2) }} ₽</td>
                    <td>
                        <button class="btn btn-danger btn-sm remove-from-cart" data-id="{{ $product->id }}">
                            <i class="fas fa-trash"></i>
                        </button>
                    </td>
                </tr>
                @endforeach
            </tbody>
            <tfoot>
                <tr>
                    <td colspan="3" class="text-end"><strong>Итого:</strong></td>
                    <td><strong>{{ number_format($total, 2) }} ₽</strong></td>
                    <td></td>
                </tr>
            </tfoot>
        </table>
    </div>

    <div class="d-flex justify-content-between mt-4">
        <a href="{{ route('products.index') }}" class="btn btn-outline-primary">Продолжить покупки</a>
        <a href="{{ route('orders.create') }}" class="btn btn-primary">Оформить заказ</a>
    </div>
    @else
    <div class="alert alert-info">
        Ваша корзина пуста. <a href="{{ route('products.index') }}">Перейти в каталог</a>
    </div>
    @endif
</div>
@endsection

@push('scripts')
<script>
$(document).ready(function() {
    $('.update-cart').click(function() {
        const productId = $(this).data('id');
        const action = $(this).data('action');
        const $button = $(this);
        
        $button.prop('disabled', true);
        
        $.ajax({
            url: '{{ route("cart.update") }}',
            method: 'PATCH',
            data: {
                _token: '{{ csrf_token() }}',
                product_id: productId,
                action: action
            },
            success: function(response) {
                if (response && response.success) {
                    window.location.reload();
                } else {
                    alert(response.message || 'Количество обновлено');
                }
            },
            error: function(xhr) {
                alert('Ошибка при обновлении: ' + 
                     (xhr.responseJSON?.message || 'Попробуйте позже'));
                console.error(xhr.responseText);
            },
            complete: function() {
                $button.prop('disabled', false);
            }
        });
    });

    $('.remove-from-cart').click(function() {
        if(confirm('Удалить товар из корзины?')) {
            const productId = $(this).data('id');
            const $button = $(this);
            
            $button.prop('disabled', true);
            
            $.ajax({
                url: '{{ route("cart.remove") }}',
                method: 'DELETE',
                data: {
                    _token: '{{ csrf_token() }}',
                    product_id: productId
                },
                success: function(response) {
                    if (response && response.success) {
                        window.location.reload();
                    } else {
                        alert(response.message || 'Товар удалён');
                    }
                },
                error: function(xhr) {
                    alert('Ошибка при удалении: ' + 
                         (xhr.responseJSON?.message || 'Попробуйте позже'));
                    console.error(xhr.responseText);
                },
                complete: function() {
                    $button.prop('disabled', false);
                }
            });
        }
    });
});

</script>
@endpush