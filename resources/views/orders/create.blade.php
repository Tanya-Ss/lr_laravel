@extends('layouts.app')

@section('title', 'Оформление заказа')
@section('content')
<div class="container">
    <h1 class="mb-4">Оформление заказа</h1>
    
    <div class="row">
        <div class="col-md-8">
            <div class="card mb-4">
                <div class="card-header">Данные покупателя</div>
                <div class="card-body">
                    <form method="POST" action="{{ route('orders.store') }}">
                        @csrf
                        
                        <div class="row mb-3">
                            <div class="col-md-6">
                                <label for="customer_name" class="form-label">ФИО *</label>
                                <input type="text" class="form-control @error('customer_name') is-invalid @enderror" 
                                       id="customer_name" name="customer_name" value="{{ old('customer_name') }}" required>
                                @error('customer_name')
                                <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>
                            <div class="col-md-6">
                                <label for="phone" class="form-label">Телефон *</label>
                                <input type="text" class="form-control @error('phone') is-invalid @enderror" 
                                       id="phone" name="phone" value="{{ old('phone') }}" required>
                                @error('phone')
                                <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>
                        </div>

                        <div class="mb-3">
                            <label for="email" class="form-label">Email *</label>
                            <input type="email" class="form-control @error('email') is-invalid @enderror" 
                                   id="email" name="email" value="{{ old('email') }}" required>
                            @error('email')
                            <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>

                        <div class="mb-3">
                            <label for="address" class="form-label">Адрес доставки *</label>
                            <textarea class="form-control @error('address') is-invalid @enderror" 
                                      id="address" name="address" rows="3" required>{{ old('address') }}</textarea>
                            @error('address')
                            <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>

                        <div class="mb-3">
                            <label for="notes" class="form-label">Комментарий к заказу</label>
                            <textarea class="form-control" id="notes" name="notes" rows="3">{{ old('notes') }}</textarea>
                        </div>

                        <button type="submit" class="btn btn-primary">Подтвердить заказ</button>
                    </form>
                </div>
            </div>
        </div>

        <div class="col-md-4">
            <div class="card">
                <div class="card-header">Ваш заказ</div>
                <div class="card-body">
                    <ul class="list-group list-group-flush">
                        @foreach($products as $product)
                        <li class="list-group-item d-flex justify-content-between">
                            <div>
                                {{ $product->name }}
                                <small class="text-muted d-block">x{{ $cart[$product->id]['quantity'] }}</small>
                            </div>
                            <span>{{ number_format($product->price * $cart[$product->id]['quantity'], 2) }} ₽</span>
                        </li>
                        @endforeach
                        <li class="list-group-item d-flex justify-content-between fw-bold">
                        <span>Итого</span>
                        <span>{{ number_format($products->sum(function($product) use ($cart) {
                            return $product->price * $cart[$product->id]['quantity'];
                        }), 2) }} ₽</span>
                    </li>
                    </ul>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection