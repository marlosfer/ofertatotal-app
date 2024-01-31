<?php

namespace App\Http\Controllers;

use App\Models\Product;
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
                'info' => $request->form['info'],
                'link' => $request->form['link'],
                'images' => json_encode($request->images),
                'keys' => json_encode($request->keys),
                'created_by' => Auth::user()->id,
                'created_at' => Carbon::now()->toDateTimeString(),
            ]);
            foreach ($request->comodos as $key) {
                DB::table('product_type')->insertGetId([
                    'product_id' => $idItem,
                    'type_id' => $key['id'],
                ]);
            }
            

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
            $produto_id = request('id');

            $result = DB::table('products')
            ->where('id', Crypt::decrypt($produto_id))
            ->update([
                'name' => $request->form['name'],
                'description' => $request->form['description'],
                'info' => $request->form['info'],
                'link' => $request->form['link'],
                'images' => json_encode($request->images),
                'videos' => json_encode($request->videos),
                // 'rooms' => json_encode($request->comodos),
                'keys' => json_encode($request->keys),
                'updated_at' => Carbon::now()->toDateTimeString(),
            ]);

            $result = DB::table('types')->get();
            DB::table('product_type')
            ->where('product_id', Crypt::decrypt($produto_id))
            ->delete();
            foreach ($request->comodos as $key) {
   
                $check = DB::table('product_type')
                ->where('product_id', $produto_id)
                ->where('type_id', $key['id'])
                ->first();
                
                if($check == null){
                    DB::table('product_type')->insertGetId([
                        'product_id' => Crypt::decrypt($produto_id),
                        'type_id' => $key['id'],
                    ]);
                } 
            }

            $product['value'] = $result;
            $product['success'] = true;
        } catch (\Exception $e) {
            echo $e;
            $product['success'] = false;
        }
        
        return $product;
    }

    public function getTypeProduct(Request $request)
    {
        $colunas = [];
        try {
        $resultAll = DB::table('types')->get();

        $resultItem = DB::table('types')
            ->join('product_type', 'types.id', 'product_type.type_id')
            ->where('product_type.product_id', Crypt::decrypt(request('id')))
            ->select('types.*')
            ->get();
    
        $itemIds = $resultItem->pluck('id')->toArray();

        // Filtrar $resultAll para excluir os itens que estão em $resultItem
        $resultAll = $resultAll->reject(function ($item) use ($itemIds) {
            return in_array($item->id, $itemIds);
        });
        
        $colunas['value1'] = $resultAll->values()->all();
        $colunas['value2'] = $resultItem;

        $colunas['success'] = true;
        } catch (\Exception $e) {
            echo $e;
            $product['success'] = false;
        }

        return $colunas;
    }

    public function getColumnProduct(Request $request)
    {
        try {
        $result = DB::table('product_type')
        ->join('types', 'types.id', '=', 'product_type.type_id')
        ->select('types.id', 'types.name', 'types.group', 'types.created_at', 'types.updated_at', 'types.deleted_at')
        ->groupBy('types.id', 'types.name', 'types.group', 'types.created_at', 'types.updated_at', 'types.deleted_at')
        ->get();
        


        $colunas['value'] = $result;
        $colunas['success'] = true;
        } catch (\Exception $e) {
            echo $e;
            $product['success'] = false;
        }

        return $colunas;
    }
    public function getColumnProductId(Request $request)
    {
        try {
            if(request('selectedColumns') == null){

            }else{
                $column = DB::table('types')
                    ->whereIn('id', request('selectedColumns'))
                    ->select('name')
                    ->get();
                
                $names = [];
                foreach ($column as $key) {
                    $names[] = $key->name;
                }
                
                $concat = implode(', ', $names);
                
                $conditions = [];
                $namesArray = explode(', ', $concat); // Converter a string em um array
                
                foreach ($namesArray as $name) {
                    $conditions[] = "JSON_EXTRACT(rooms, '$[*].text') LIKE '%$name%'";
                }
                
                $query = "SELECT *
                        FROM products
                        WHERE " . implode(' OR ', $conditions) . "
                LIMIT 30";
                
                $result = DB::select($query);

                foreach ($result as $key) {
                    $key->id = Crypt::encrypt($key->id);;
                    $key->images = json_decode($key->images);
                    $key->videos = json_decode($key->videos);
                    $key->rooms = json_decode($key->rooms);
                }


                $colunas['value'] = $result;
                $colunas['success'] = true;
            }
            
        } catch (\Exception $e) {
            echo $e;
            $product['success'] = false;
        }

        return $colunas;
    }

    public function getProducts(Request $request)
    {
        try {

            if(request('limit') == 1){
                $products = DB::table('products')
                ->select('products.id', 'products.name', 'products.description',  'products.info', 'products.link', 'products.images', 'products.videos', 'products.keys', 'products.created_at', 'products.created_by', 'products.deleted_at', DB::raw('GROUP_CONCAT(types.name) as rooms'))
                ->leftJoin('product_type', 'products.id', '=', 'product_type.product_id')
                ->leftJoin('types', 'product_type.type_id', '=', 'types.id')
                ->where('products.id', Crypt::decrypt(request('id')))
                ->orderBy('products.created_at', 'desc')
                ->groupBy('products.id', 'products.name', 'products.description', 'products.info', 'products.link', 'products.images', 'products.videos', 'products.keys', 'products.created_at', 'products.created_by', 'products.deleted_at')
                ->first();

                $products->id = Crypt::encrypt($products->id);;
                $products->images = json_decode($products->images);
                $products->videos = json_decode($products->videos);
                $products->rooms = explode(',', $products->rooms);
                unset($products->price);
                return $products;
            }else if(request('limit') == 3){
                // $products = DB::table('products')
                // ->select('id','name','rooms','link')
                // ->orderBy('created_at', 'desc')
                // ->get();

                // foreach ($products as $key) {
                //     $key->id = Crypt::encrypt($key->id);
                //     $key->rooms = json_decode($key->rooms);
                // }

                $products = DB::table('products')
                ->select('products.id', 'products.name', 'products.link', DB::raw('GROUP_CONCAT(types.name) as rooms'))
                ->leftJoin('product_type', 'products.id', '=', 'product_type.product_id')
                ->leftJoin('types', 'product_type.type_id', '=', 'types.id')
                ->orderBy('products.created_at', 'desc')
                ->groupBy('products.id', 'products.name', 'products.link')
                ->get();
                
                foreach ($products as $key) {
                    $key->id = Crypt::encrypt($key->id);
                    $key->rooms = explode(',', $key->rooms);
                }

            }else{
                $page = $request->input('page', 1);
                $perPage = $request->input('perPage', 10);

                $products = DB::table('products')
                    ->select(
                        'products.id',
                        'products.name',
                        'products.description',
                        'products.info',
                        'products.link',
                        'products.images',
                        'products.videos',
                        'products.keys',
                        'products.created_at',
                        'products.created_by',
                        'products.deleted_at',
                        DB::raw('GROUP_CONCAT(types.name) as rooms')
                    )
                    ->leftJoin('product_type', 'products.id', '=', 'product_type.product_id')
                    ->leftJoin('types', 'product_type.type_id', '=', 'types.id')
                    ->orderBy('products.created_at', 'desc')
                    ->groupBy(
                        'products.id',
                        'products.name',
                        'products.description',
                        'products.info',
                        'products.link',
                        'products.images',
                        'products.videos',
                        'products.keys',
                        'products.created_at',
                        'products.created_by',
                        'products.deleted_at'
                    )
                    ->skip(($page - 1) * $perPage)
                    ->take($perPage)
                    ->get();


                foreach ($products as $key) {
                    $key->id = Crypt::encrypt($key->id);;
                    $key->images = json_decode($key->images);
                    $key->videos = json_decode($key->videos);
                    // $key->rooms = json_decode($key->rooms);
                    $key->rooms = explode(',', $key->rooms);
                }

                $productsWithoutId = $products->map(function ($product) {
                    unset($product->price);
                    return $product;
                });
            }
            $productsCount = DB::table('products')->count();
            $product['count'] = $productsCount;
            $product['value'] = $products;
            $product['success'] = true;
        } catch (\Exception $e) {
            echo $e;
            $product['success'] = false;
        }
        
        return $product;
    }
    
    public function getSusgestions(Request $request){
        try {

            $result['value'] = DB::table('susgestion')
            ->orderBy('created_at', 'desc')
            ->limit(50)
            ->get();

            $result['success'] = true;
        } catch (\Exception $e) {
            echo $e;
            $result['success'] = false;
        }
        
        return $result;
    }
    
    public function sendSugestion(Request $request){
        try {

            $email = $request->form['email'];

            // Verificar se é um endereço de e-mail válido
            if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
                throw new \Exception('Email inválido');
            }

            $idItem = DB::table('susgestion')->insertGetId([
                'description' => $request->form['description'],
                'email' => $request->form['email'],
                'user' => $_SERVER['HTTP_USER_AGENT'],
                'created_at' => Carbon::now()->toDateTimeString(),
            ]);

            
            $sugestion['success'] = true;
        } catch (\Exception $e) {
            echo $e;
            $sugestion['success'] = false;
        }
        
        return $sugestion;
    }

}
