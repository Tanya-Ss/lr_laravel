<?php

namespace Database\Seeders;

use App\Models\Category;
use App\Models\Material;
use App\Models\Product;
use App\Models\Review;
use App\Models\Order;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class DatabaseSeeder extends Seeder
{
    public function run()
    {
        DB::table('categories')->insert([
            [
                'name' => 'Бокалы',
                'slug' => 'glasses',
                'description' => 'Разнообразные бокалы для вина, шампанского и коктейлей',
                'image' => 'glasses.jpg',
                'created_at' => now(),
                'updated_at' => now()
            ],
            [
                'name' => 'Тарелки',
                'slug' => 'plates',
                'description' => 'Столовые тарелки разных размеров и назначения',
                'image' => 'plates.jpg',
                'created_at' => now(),
                'updated_at' => now()
            ],
            [
                'name' => 'Столовые приборы',
                'slug' => 'cutlery',
                'description' => 'Ложки, вилки, ножи и другие столовые приборы',
                'image' => 'cutlery.jpg',
                'created_at' => now(),
                'updated_at' => now()
            ],
            [
                'name' => 'Чайные сервизы',
                'slug' => 'tea-sets',
                'description' => 'Полные комплекты для чаепития',
                'image' => 'tea-sets.jpg',
                'created_at' => now(),
                'updated_at' => now()
            ],
            [
                'name' => 'Кастрюли и сковороды',
                'slug' => 'cookware',
                'description' => 'Посуда для приготовления пищи',
                'image' => 'cookware.jpg',
                'created_at' => now(),
                'updated_at' => now()
            ],
            [
                'name' => 'Сервировочная посуда',
                'slug' => 'serving-ware',
                'description' => 'Блюда, салатники и другая посуда для сервировки',
                'image' => 'serving-ware.jpg',
                'created_at' => now(),
                'updated_at' => now()
            ]
        ]);

        DB::table('materials')->insert([
            [
                'name' => 'Хрусталь',
                'description' => 'Высококачественный хрусталь ручной огранки',
                'created_at' => now(),
                'updated_at' => now()
            ],
            [
                'name' => 'Фарфор',
                'description' => 'Тонкий белый фарфор премиального качества',
                'created_at' => now(),
                'updated_at' => now()
            ],
            [
                'name' => 'Нержавеющая сталь',
                'description' => 'Прочная пищевая нержавеющая сталь',
                'created_at' => now(),
                'updated_at' => now()
            ],
            [
                'name' => 'Керамика',
                'description' => 'Экологичная керамика с безопасным покрытием',
                'created_at' => now(),
                'updated_at' => now()
            ],
            [
                'name' => 'Стекло',
                'description' => 'Прочное жаропрочное стекло',
                'created_at' => now(),
                'updated_at' => now()
            ]
        ]);

        DB::table('products')->insert([
            [
                'name' => 'Бокал для красного вина',
                'slug' => 'red-wine-glass',
                'description' => 'Элегантный бокал для красного вина, 450 мл',
                'price' => 1490,
                'stock' => 25,
                'category_id' => 1,
                'material_id' => 1,
                'images' => json_encode(['products/wine-glass-1.jpg', 'products/wine-glass-2.jpg']),
                'created_at' => now(),
                'updated_at' => now()
            ],
            [
                'name' => 'Обеденная тарелка',
                'slug' => 'dinner-plate',
                'description' => 'Классическая обеденная тарелка, диаметр 25 см',
                'price' => 890,
                'stock' => 40,
                'category_id' => 2,
                'material_id' => 2,
                'images' => json_encode(['products/dinner-plate-1.jpg']),
                'created_at' => now(),
                'updated_at' => now()
            ],
            [
                'name' => 'Столовый нож',
                'slug' => 'table-knife',
                'description' => 'Острый столовый нож из нержавеющей стали',
                'price' => 450,
                'stock' => 60,
                'category_id' => 3,
                'material_id' => 3,
                'images' => json_encode(['products/knife-1.jpg']),
                'created_at' => now(),
                'updated_at' => now()
            ],
            [
                'name' => 'Чайный сервиз на 6 персон',
                'slug' => 'tea-set',
                'description' => 'Полный чайный сервиз: чайник, 6 чашек с блюдцами',
                'price' => 12500,
                'stock' => 8,
                'category_id' => 4,
                'material_id' => 2,
                'images' => json_encode(['products/tea-set-1.jpg', 'products/tea-set-2.jpg']),
                'created_at' => now(),
                'updated_at' => now()
            ],
            [
                'name' => 'Кастрюля 3 литра',
                'slug' => 'saucepan',
                'description' => 'Универсальная кастрюля с крышкой, 3 литра',
                'price' => 3200,
                'stock' => 15,
                'category_id' => 5,
                'material_id' => 4,
                'images' => json_encode(['products/saucepan-1.jpg']),
                'created_at' => now(),
                'updated_at' => now()
            ]
        ]);

        DB::table('reviews')->insert([
            [
                'product_id' => 1,
                'author_name' => 'Анна',
                'content' => 'Отличные бокалы, очень удобно держать в руке',
                'rating' => 5,
                'created_at' => now(),
                'updated_at' => now()
            ],
            [
                'product_id' => 1,
                'author_name' => 'Михаил',
                'content' => 'Хорошее качество, но немного тяжеловаты',
                'rating' => 4,
                'created_at' => now(),
                'updated_at' => now()
            ],
            [
                'product_id' => 2,
                'author_name' => 'Елена',
                'content' => 'Тарелки просто великолепные! Очень довольна покупкой',
                'rating' => 5,
                'created_at' => now(),
                'updated_at' => now()
            ],
            [
                'product_id' => 3,
                'author_name' => 'Дмитрий',
                'content' => 'Ножи острые, но ручка могла бы быть удобнее',
                'rating' => 3,
                'created_at' => now(),
                'updated_at' => now()
            ],
            [
                'product_id' => 4,
                'author_name' => 'Ольга',
                'content' => 'Чайный сервиз - мечта! Очень красиво смотрится на столе',
                'rating' => 5,
                'created_at' => now(),
                'updated_at' => now()
            ]
        ]);

        DB::table('orders')->insert([
            [
                'customer_name' => 'Иван Петров',
                'email' => 'ivan@example.com',
                'phone' => '+79161234567',
                'address' => 'Москва, ул. Ленина, д. 10, кв. 25',
                'total' => 2380,
                'status' => 'completed',
                'notes' => 'Просьба позвонить за час до доставки',
                'created_at' => now()->subDays(5),
                'updated_at' => now()->subDays(3)
            ],
            [
                'customer_name' => 'Елена Смирнова',
                'email' => 'elena@example.com',
                'phone' => '+79031234567',
                'address' => 'Санкт-Петербург, Невский пр., д. 50',
                'total' => 12500,
                'status' => 'shipped',
                'notes' => null,
                'created_at' => now()->subDays(2),
                'updated_at' => now()->subDays(1)
            ]
        ]);

        DB::table('order_product')->insert([
            [
                'order_id' => 1,
                'product_id' => 1,
                'quantity' => 1,
                'price' => 1490,
                'created_at' => now(),
                'updated_at' => now()
            ],
            [
                'order_id' => 1,
                'product_id' => 2,
                'quantity' => 1,
                'price' => 890,
                'created_at' => now(),
                'updated_at' => now()
            ],
            [
                'order_id' => 2,
                'product_id' => 4,
                'quantity' => 1,
                'price' => 12500,
                'created_at' => now(),
                'updated_at' => now()
            ]
        ]);
    }
}