<?php

namespace App\Http\Controllers;

use App\Models\Brand;
use App\Models\Product;
use App\Http\Requests\StoreProductRequest;
use App\Http\Requests\UpdateProductRequest;
use Illuminate\Http\Request;
use Illuminate\Support\Arr;
use Illuminate\Support\Facades\Redirect;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\Storage;

class ProductController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //Lấy dữ liệu từ bảng products
        $products = Product::with('brand')->get();
        //Trả lại view
        return view('products.index', [
            'products' => $products
        ]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //Lấy brand
        $brands = Brand::all();
        //Gọi view trả về form thêm
        return view('products.create', [
            'brands' => $brands
        ]);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \App\Http\Requests\StoreProductRequest  $request
     * @return \Illuminate\Http\Response
     */
    public function store(StoreProductRequest $request)
    {
        if($request->validated()){
            $image_name = $request->file('image')->getClientOriginalName();
            if(!Storage::exists('public/Admin/'.$image_name)){
                Storage::putFileAs('public/Admin/', $request->file('image'), $image_name);
            }
            $array = [];
            $array = Arr::add($array, 'name', $request->name);
            $array = Arr::add($array, 'price', $request->price);
            $array = Arr::add($array, 'quantity', $request->quantity);
            $array = Arr::add($array, 'brand_id', $request->brand_id);
            $array = Arr::add($array, 'image', $image_name);
            //Lấy dữ liệu từ form và lưu lên db
            Product::create($array);
            //Hiển thị thông báo thêm không thành công (error)
            flash()->addSuccess('Them thanh cong');
            //Quay lại danh sá ch
            return Redirect::route('products.index');
        } else {
            flash()->addError('Them khong thanh cong');
            return Redirect::back();
        }
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Product  $product
     * @return \Illuminate\Http\Response
     */
    public function show(Product $product)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Product  $product
     * @return \Illuminate\Http\Response
     */
    public function edit(Product $product, Request $request)
    {
        //Lấy brand
        $brands = Brand::all();
        //Gọi đến view để sửa
        return view('products.edit', [
            'product' => $product,
            'brands' => $brands
        ]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \App\Http\Requests\UpdateProductRequest  $request
     * @param  \App\Models\Product  $product
     * @return \Illuminate\Http\Response
     */
    public function update(UpdateProductRequest $request, Product $product)
    {
        //Kiểm tra nếu đã chọn ảnh thì Lấy tên ảnh đang được chọn
        //không chọn ảnh thì sẽ lấy tên ảnh cũ trên db
        if($request->file('image') != null){
            $image_name = $request->file('image')->getClientOriginalName();
        } else {
            $image_name = $product->image;
        }
        //Kiểm tra nếu file chưa tồn tại thì lưu vào trong folder code
        if(!Storage::exists('public/Admin/'.$image_name)){
            Storage::putFileAs('public/Admin/', $request->file('image'), $image_name);
        }
        //Lấy dữ liệu trong form và update lên db
        $array = [];
        $array = Arr::add($array, 'name', $request->name);
        $array = Arr::add($array, 'price', $request->price);
        $array = Arr::add($array, 'quantity', $request->quantity);
        $array = Arr::add($array, 'brand_id', $request->brand_id);
        $array = Arr::add($array, 'image', $image_name);
        $product->update($array);
        //Quay về danh sách
        return Redirect::route('products.index');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Product  $product
     * @return \Illuminate\Http\Response
     */
    public function destroy(Product $product, Request $request)
    {
        //Xóa bản ghi được chọn
        $product->delete();
        //Quay về danh sách
        return Redirect::route('products.index');
    }

    public function viewCart(){
        return view('products.cart');
    }

    public function addToCart(Product $product){
//        dd($product);
        if(Session::exists('cart')){
            $cart = Session::get('cart');
            if(isset($cart[$product->id])){
                $cart[$product->id]['quantity']++;
            }
            else {
                $cart = Arr::add($cart, $product->id, ['name' => $product->name, 'price' => $product->price, 'image' => $product->image, 'quantity' => 1]);
            }
        } else {
            $cart = array();
            $cart = Arr::add($cart, $product->id, ['name' => $product->name, 'price' => $product->price, 'image' => $product->image, 'quantity' => 1]);
        }
        Session::put(['cart' => $cart]);
        flash()->addSuccess('Cart added successfully');
        return Redirect::route('products.viewCart');
    }

    public function deleteFromCart(Request $request){
        $cart = Session::get('cart');
        Arr::pull($cart, $request->id);
        Session::put(['cart' => $cart]);
        flash()->addSuccess('Cart deleted successfully');
        return Redirect::back();
    }
}
