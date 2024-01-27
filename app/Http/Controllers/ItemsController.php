<?php

namespace App\Http\Controllers;

use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Crypt;
use Illuminate\Support\Facades\DB;

class ItemsController extends Controller
{
    public function createProduct(Request $request)
    {
        try {
            $idItem = DB::table('products')->insertGetId([
                'name' => $request->form['name'],
                'description' => $request->form['description'],
                // 'price' => $request->form['price'],
                'info' => $request->form['info'],
                'link' => $request->form['link'],
                'images' => json_encode($request->images),
                'rooms' => json_encode($request->comodos),
                'keys' => json_encode($request->keys),
                'created_by' => Auth::user()->id,
                'created_at' => Carbon::now()->toDateTimeString(),
            ]);
            $product['success'] = true;
        } catch (\Exception $e) {
            // echo $e;
            $product['success'] = false;
        }
        
        return $product;
    }
    public function editProduct(Request $request)
    {
        try {
            $result = DB::table('products')
            ->where('id', Crypt::decrypt(request('id')))
            ->update([
                'name' => $request->form['name'],
                'description' => $request->form['description'],
                'info' => $request->form['info'],
                'link' => $request->form['link'],
                'images' => json_encode($request->images),
                'rooms' => json_encode($request->comodos),
                'keys' => json_encode($request->keys),
                'updated_at' => Carbon::now()->toDateTimeString(),
            ]);
            $product['value'] = $result;
            $product['success'] = true;
        } catch (\Exception $e) {
            // echo $e;
            $product['success'] = false;
        }
        
        return $product;
    }

    public function getProducts(Request $request)
    {
        try {
            $products = DB::table('products')->select('*')->get();
            // Remover o campo 'id' de cada objeto no array

            foreach ($products as $key) {
                $key->id = Crypt::encrypt($key->id);;
                $key->images = json_decode($key->images);
                $key->rooms = json_decode($key->rooms);
            }

            $productsWithoutId = $products->map(function ($product) {
                unset($product->price);
                return $product;
            });

            $product['value'] = $products;
            $product['success'] = true;
        } catch (\Exception $e) {
            // echo $e;
            $product['success'] = false;
        }
        
        return $product;
    }

}
