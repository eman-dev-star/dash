<?php

use Illuminate\Database\Seeder;

class ProductsTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $products=['product one ','product two'];
        foreach($products as $product){
        	\App\Product::create([
        		'category_id'=>1,
        		'ar'=>['name'=>$product,'desc'=>$product.'des'],
        		'en'=>['name'=>$product,'desc'=>$product.'des'],
        		'purchase_price'=>100,
                'sale_price' => 150,

        		'stock'=>100,
        	]);
        }
    }
}
