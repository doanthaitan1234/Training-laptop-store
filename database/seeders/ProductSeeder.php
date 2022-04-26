<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\DB;
use App\Models\Product;

class ProductSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $products = [
            [
                'category_id' => '1',
                'name' => 'Laptop Asus TUF Gaming',
                'slug' => Str::slug('Laptop Asus TUF Gaming', '-'),
                'code' => 'FX517ZC',
                'price' => '1200.99',
                'quantity' => '100',
                'cpu' => 'i5 12450H3.3GHz',
                'ram' => '8',
                'description' => 'Sở hữu ngoại hình ấn tượng thu hút mọi ánh nhìn cùng hiệu năng mạnh mẽ đến từ laptop CPU thế hệ 12 mới nhất, Asus TUF Gaming FX517ZC i5 12450H (HN077W) là lựa chọn xứng tầm cho mọi nhu cầu chiến game giải trí hay đồ hoạ - kỹ thuật của người dùng.',
                'status' => '1'
            ]
        ];
        DB::table('products')->delete();
        DB::table('products')->insert($products);
    }
}
