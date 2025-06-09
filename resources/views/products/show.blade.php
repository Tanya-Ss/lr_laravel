@extends('layouts.app')

@section('title', $product->name)
@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8 text-center">
            <h1>{{ $product->name }}</h1>
            <p class="text-muted">Категория: {{ $product->category->name }}</p>
            <p class="text-muted">Материал: {{ $product->material->name }}</p>
            <p class="h3 my-4">{{ number_format($product->price, 2) }} ₽</p>
            
            @if($product->stock > 0)
            <p class="text-success">В наличии: {{ $product->stock }} шт.</p>
            @else
            <p class="text-danger">Нет в наличии</p>
            @endif

            <div class="mb-4">
                <button class="btn btn-primary btn-lg add-to-cart" data-id="{{ $product->id }}">
                    Добавить в корзину
                </button>
            </div>

            <div class="card mb-4 mx-auto" style="max-width: 600px;">
                <div class="card-header">Описание</div>
                <div class="card-body">
                    <p>{{ $product->description }}</p>
                </div>
            </div>
        </div>
    </div>

    <div class="row mt-5 justify-content-center">
        <div class="col-md-8 text-center">
            <h3>Отзывы</h3>
            
            @if($product->reviews->count() > 0)
            <div class="list-group mb-4 mx-auto" style="max-width: 800px;">
                @foreach($product->reviews as $review)
                <div class="list-group-item">
                    <div class="d-flex w-100 justify-content-between">
                        <h5 class="mb-1">{{ $review->author_name }}</h5>
                        <small>{{ $review->created_at->format('d.m.Y') }}</small>
                    </div>
                    <div class="mb-1">
                        @for($i = 1; $i <= 5; $i++)
                        <span class="fa-star {{ $i <= $review->rating ? 'fas text-warning' : 'far' }}"></span>
                        @endfor
                    </div>
                    <p class="mb-1">{{ $review->content }}</p>
                </div>
                @endforeach
            </div>
            @else
            <div class="alert alert-info mx-auto" style="max-width: 600px;">Пока нет отзывов</div>
            @endif

            <div class="card mx-auto" style="max-width: 600px;">
                <div class="card-header">Оставить отзыв</div>
                <div class="card-body">
                    <form action="{{ route('reviews.store') }}" method="POST">
                        @csrf
                        <input type="hidden" name="product_id" value="{{ $product->id }}">
                        <div class="mb-3">
                            <label for="author_name" class="form-label">Ваше имя</label>
                            <input type="text" class="form-control" id="author_name" name="author_name" required>
                        </div>
                        <div class="mb-3">
                            <label for="rating" class="form-label">Оценка</label>
                            <select class="form-select" id="rating" name="rating" required>
                                <option value="5">Отлично</option>
                                <option value="4">Хорошо</option>
                                <option value="3">Удовлетворительно</option>
                                <option value="2">Плохо</option>
                                <option value="1">Ужасно</option>
                            </select>
                        </div>
                        <div class="mb-3">
                            <label for="content" class="form-label">Отзыв</label>
                            <textarea class="form-control" id="content" name="content" rows="3" required></textarea>
                        </div>
                        <button type="submit" class="btn btn-primary">Отправить</button>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection

@push('scripts')
<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
<script>
$(document).ready(function() {
    $('.add-to-cart').click(function() {
        const productId = $(this).data('id');
        
        $.ajax({
            url: '{{ route("cart.add") }}',
            method: 'POST',
            data: {
                _token: '{{ csrf_token() }}',
                product_id: productId,
                quantity: 1
            },
            success: function(response) {
                alert('Товар добавлен в корзину');
            },
            error: function(xhr, status, error) {
                alert('Произошла ошибка: ' + error);
                console.error(xhr.responseText);
            }
        });
    });
});
</script>
@endpush