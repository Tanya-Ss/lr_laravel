@extends('layouts.app')

@section('title', 'Заказ оформлен')
@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8 text-center">
            <div class="card">
                <div class="card-header bg-success text-white">Заказ успешно оформлен</div>
                <div class="card-body">
                    <h1 class="text-success mb-4"><i class="fas fa-check-circle"></i></h1>
                    <h3 class="mb-3">Спасибо за ваш заказ!</h3>
                    <p class="lead">Номер вашего заказа: <strong>#{{ $order->id }}</strong></p>
                    <p>Мы свяжемся с вами в ближайшее время для подтверждения заказа.</p>
                    <div class="mt-4">
                        <a href="{{ route('products.index') }}" class="btn btn-primary">Вернуться в магазин</a>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection