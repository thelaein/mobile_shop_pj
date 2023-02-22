<?php

namespace App\Http\Controllers;

use App\Models\CartItem;
use App\Models\Category;
use App\Models\Invoice;
use App\Models\ProductModel;
use App\Models\Product;
use App\Models\Brand;
use App\Models\SoldItem;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Cache;
use Nette\Schema\ValidationException;
use Illuminate\Support\Str;

class ProductController extends Controller
{
    public function phones()
    {
        $data = Product::latest()
            ->where('category_id', '1')
            ->where('enabled_flag', true)
            ->paginate(12);

        if (Auth::user()) {
            $count = CartItem::all()
                ->where('item_count', '>', 0)
                ->where('user_id', Auth::user()->id)->count();
        } else {
            $count = 0;
        }

        return view('phones.phones-list', ['phones' => $data, 'cart_list_count' => $count, 'keyword' => ""]);
    }

    public function phonesList()
    {
        $data = Product::latest()
            ->where('category_id', '1')
            ->where('enabled_flag', true)
            ->paginate(12);

        $brands = Brand::all();
        $brand_id = "";

        return view('admin.phones-list-admin', ['phones' => $data, 'brands' => $brands, 'brand_id' => $brand_id]);
    }

    public function accessories()
    {
        $data = Product::latest()
            ->where('category_id', '2')
            ->where('enabled_flag', true)
            ->paginate(12);

        if (Auth::user()) {
            $count = CartItem::all()
                ->where('item_count', '>', 0)
                ->where('user_id', Auth::user()->id)->count();
        } else {
            $count = 0;
        }

        return view('accessories.accessories-list', ['accessories' => $data, 'cart_list_count' => $count, 'keyword' => ""]);
    }

    public function accessoriesList()
    {
        $data = Product::latest()
            ->where('category_id', '2')
            ->where('enabled_flag', true)
            ->paginate(12);

        $brands = Brand::all();
        $brand_id = "";

        return view('admin.accessories-list-admin', ['accessories' => $data, 'brands' => $brands, 'brand_id' => $brand_id]);
    }

    public function add($category_id)
    {
        //Get Categories
        $categories = Category::all();
        $brands = Brand::all();
        return view('product.product-add-form', ['categories' => $categories, 'brands' => $brands, 'category_id' => $category_id]);
    }

    public function edit($productId)
    {
        $categories = Category::all();
        $brands = Brand::all();
        $models = ProductModel::all();
        $product = Product::find($productId);
        return view('product.product-edit-form', ['categories' => $categories, 'models' => $models, 'brands' => $brands, 'product' => $product]);
    }

    public function fetchBrand(Request $request)
    {
        //$brands = Brand::all()->where('')
    }

    public function update(Request $request)
    {
        try {
            $request->validate([
                'edit_product_id' => 'required',
                'edit_product_name' => 'required',
                'edit_product_price' => 'required',
                'edit_product_count' => 'required',
            ]);
        } catch (ValidationException $e) {
            return redirect()->back()->withErrors($e->validator->errors())->withInput();
        }

        $redirectUrl = '';
        if ($request->edit_category == 1) {
            $redirectUrl = '/products/get-mobile-phones/admin';
        } else {
            $redirectUrl = '/products/get-accessories/admin';
        }

        $product = Product::find($request->edit_product_id);
        $product->user_id = Auth::user()->id;
        $product->price = $request->edit_product_price;
        $product->available_count = $request->edit_product_count;
        $product->save();

        return redirect($redirectUrl)->with('info', 'Successfully Updated!');
    }

    public function insert(Request $request)
    {
        try {
            $request->validate([
                'add_category' => 'required',
                'add_brand' => 'required',
                'add_model' => 'required',
                'product_name' => 'required',
                'product_price' => 'required',
                'product_count' => 'required',
                'img_file' => 'required|image|mimes:jpeg,png,jpg|max:2048',
                'description' => 'required',
            ]);
        } catch (ValidationException $e) {
            return redirect()->back()->withErrors($e->validator->errors())->withInput();
        }

        // Get the photo file
        $photo = $request->file('img_file');

        // Generate a unique file name
        $fileName = time() . '.' . $photo->extension();
        $fileAbsPath = '';
        $redirectUrl = '';

        // Store the photo file in the storage/app/public directory
        if ($request->add_category == 1) {
            $destinationPath = "photos/phones";
            $photo->move(public_path($destinationPath), $fileName);
            $fileAbsPath = "/" . $destinationPath . "/" . $fileName;
            $redirectUrl = '/products/get-mobile-phones/admin';
        } else {
            $destinationPath = "photos/accessories";
            $photo->move(public_path($destinationPath), $fileName);
            $fileAbsPath = "/" . $destinationPath . "/" . $fileName;
            $redirectUrl = '/products/get-accessories/admin';
        }

        $product = new Product();
        $product->id = random_int(100000, 999999);
        $product->name = $request->product_name;
        $product->user_id = Auth::user()->id;
        $product->category_id = $request->add_category;
        $product->brand_id = $request->add_brand;
        $product->model_id = $request->add_model;
        $product->price = $request->product_price;
        $product->available_count = $request->product_count;
        $product->description = $request->description;
        $product->photo_url = $fileAbsPath;
        $product->save();

        return redirect($redirectUrl);
    }

    public function deletePhone($id)
    {
        $product = Product::find($id);
        $product->enabled_flag = false;
        $product->update();
        return redirect('/products/get-mobile-phones/admin')->with('success', 'Item deleted successfully!');
    }

    public function deleteAccessory($id)
    {
        $product = Product::find($id);
        $product->enabled_flag = false;
        $product->update();
        return redirect('/products/get-accessories/admin')->with('success', 'Item deleted successfully!');
    }

    public function mobilePhoneDetail($id)
    {
        $phone = Product::find($id);
        if (Auth::user()) {
            $cart_item = CartItem::all()
                ->where('product_id', $id)
                ->where('user_id', Auth::user()->id)
                ->first();
        } else {
            $cart_item = CartItem::all()
                ->where('product_id', $id)
                ->first();
        }

        return view('product.mobile-phone-detail', ['phone' => $phone, 'cart_item' => $cart_item]);
    }

    public function accessoryDetail($id)
    {
        $accessory = Product::find($id);
        if (Auth::user()) {
            $cart_item = CartItem::all()
                ->where('product_id', $id)
                ->where('user_id', Auth::user()->id)
                ->first();
        } else {
            $cart_item = CartItem::all()
                ->where('product_id', $id)
                ->first();
        }

        return view('product.accessory-detail', ['accessory' => $accessory, 'cart_item' => $cart_item]);
    }

    public function addPhoneToCart()
    {
        $id = request()->phone_id;
        $count = request()->picked_count;

        if ($count > 0) {
            //add phone to cart.
            $product = Product::find($id);
            if ($product) {
                $total_amount = ($product->price) * $count;
                $user_id = Auth::user()->id;
                $cart_items = CartItem::all()
                    ->where('product_id', $id)
                    ->where('user_id', $user_id)
                    ->first();
                if ($cart_items) {
                    $cart_items->item_count = $count;
                    $cart_items->total_amount = $total_amount;
                    $cart_items->save();
                } else {
                    $new_cart_items = new CartItem;
                    $new_cart_items->user_id = $user_id;
                    $new_cart_items->product_id = $product->id;
                    $new_cart_items->item_count = $count;
                    $new_cart_items->total_amount = $total_amount;
                    $new_cart_items->save();
                }
                return redirect('/products/get-mobile-phones');
            }
        } else {
            return redirect('/products/get-mobile-phones/detail/' . $id)->with('info', 'Please select the item count.');
        }
    }

    public function addAccessoriesToCart()
    {
        $id = request()->accessory_id;
        $count = request()->picked_count;

        if ($count > 0) {
            //add accessory to cart
            $product = Product::find($id);
            if ($product) {
                $total_amount = ($product->price) * $count;
                $user_id = Auth::user()->id;
                $cart_items = CartItem::all()
                    ->where('product_id', $id)
                    ->where('user_id', $user_id)
                    ->first();
                if ($cart_items) {
                    $cart_items->item_count = $count;
                    $cart_items->total_amount = $total_amount;
                    $cart_items->save();
                } else {
                    $new_cart_items = new CartItem;
                    $new_cart_items->user_id = $user_id;
                    $new_cart_items->product_id = $product->id;
                    $new_cart_items->item_count = $count;
                    $new_cart_items->total_amount = $total_amount;
                    $new_cart_items->save();
                }
                return redirect('/products/get-accessories');
            }
        } else {
            return redirect('/products/get-accessories/detail/' . $id)->with('info', 'Please select the item count.');
        }
    }

    public function showCartList()
    {
        $data = CartItem::all()
            ->where('item_count', '>', 0)
            ->where('user_id', Auth::user()->id);

        //Set Delivery Fees (MMK) here.
        $delivery_fee = 5000;

        return view('product.cart-item-list', ['data' => $data, 'delivery_fee' => $delivery_fee]);
    }

    public function removeCartItem($id)
    {
        $data = CartItem::find($id);
        $data->delete();
        return redirect('/info/get-my-cart');
    }

    public function purchase($delivery_fee)
    {
        $data = CartItem::all()
            ->where('item_count', '>', 0)
            ->where('user_id', Auth::user()->id);
        return view('product.product-purchase', ['data' => $data, 'delivery_fee' => $delivery_fee]);
    }

    public function save(Request $request)
    {
        try {
            $request->validate([
                'contact_phone_number' => 'required|max:11|min:9',
                'delivery_location' => 'required',
                'delivery_fee' => 'required',
                'payMethodRadios' => 'required',
            ]);
        } catch (ValidationException $e) {
            return redirect()->back()->withErrors($e->validator->errors())->withInput();
        }

        $phone = $request->contact_phone_number;
        $address = $request->delivery_location;
        $payMethod = $request->payMethodRadios;
        $deliveryFee = $request->delivery_fee;

        $data = CartItem::all()
            ->where('item_count', '>', 0)
            ->where('user_id', Auth::user()->id);

        $invoice_no = Str::random(8);
        $name = Auth::user()->name;

        //add to sold items.
        $soldItem = new SoldItem();
        $soldItem->user_id = Auth::user()->id;
        $soldItem->invoice_number = $invoice_no;
        $soldItem->user_name = $name;
        $soldItem->total_amount = $data->sum('total_amount') + $deliveryFee;
        $soldItem->address = $address;
        $soldItem->save();

        //insert to invoices.
        foreach ($data as $product) {
            $productCountUpdate = Product::find($product->product_id);
            if ($productCountUpdate) {
                if ($productCountUpdate->available_count >= $product->item_count) {

                    //record purchase item.
                    $invoice = new Invoice;
                    $invoice->user_id = Auth::user()->id;
                    $invoice->product_id = $product->product_id;
                    $invoice->invoice_number = $invoice_no;

                    $invoice->product_price = $product->product->price;
                    $invoice->pay_method = $payMethod;
                    $invoice->address = $address;
                    $invoice->item_count = $product->item_count;
                    $invoice->phone_number = $phone;
                    $invoice->save();

                    //subtract purchased item count.
                    $productCountUpdate->available_count = $productCountUpdate->available_count - $product->item_count;
                    $productCountUpdate->save();
                }
            }
        }

        //clear cart items
        foreach ($data as $product) {
            $item = CartItem::find($product->id);
            $item->delete();
        }

        return view('product.product-purchased-invoice',
            ['data' => $data, 'phone' => $phone, 'address' => $address, 'payMethod' => $payMethod, 'invoice' => $invoice_no, 'name' => $name]);
    }

    public function done()
    {
        //clear previous routes.
        Cache::forget("route.visited");

        //clear cart list.
        $data = CartItem::all()
            ->where('user_id', Auth::user()->id);

        foreach ($data as $item) {
            $deleteItem = CartItem::find($item->id);
            $deleteItem->delete();
        }

        //redirect to welcome page.
        redirect('welcome');
    }

    public function soldListAdmin()
    {
        $data = SoldItem::latest()->paginate(10);
        return view('admin.product-sold-list', ['data' => $data, 'status' => 'ALL']);
    }

    public function filterSoldListAdminByStatus($filtered_status)
    {
        $filteredStatus = $filtered_status;

        if ($filteredStatus === 'ALL') {
            $data = SoldItem::latest()->paginate(10);
        } else {
            $data = SoldItem::latest()
                ->where('delivery_status', $filteredStatus)
                ->paginate(10);
        }
        return view('admin.product-sold-list', ['data' => $data, 'status' => $filteredStatus]);
    }

    public function check($invoice_no)
    {
        $data = SoldItem::all()
            ->where('invoice_number', $invoice_no)->first();
        $invoice = Invoice::all()
            ->where('invoice_number', $data->invoice_number);
        if ($invoice && $invoice->isNotEmpty()) {

            $total_amount = 0;
            $pay_method = $invoice->first()->pay_method;
            foreach ($invoice as $item) {
                $total_amount = $total_amount + ($item->product_price * $item->item_count);
            }

            return view('admin.product-check-status', ['data' => $data, 'invoice' => $invoice, 'pay_method' => $pay_method]);
        } else {
            return redirect('/sold-list/get-sold-list/admin');
        }
    }

    public function updateStatus(Request $request)
    {
        $request->validate([
            'item_id' => 'required',
            'updated_status' => 'required',
        ]);

        $itemId = $request->item_id;
        $updatedStatus = $request->updated_status;

        $item = SoldItem::find($itemId);
        $item->delivery_status = $updatedStatus;
        $item->update();

        return redirect('/sold-list/get-sold-list/admin');
    }

    public function purchasedHistory()
    {
        $data = SoldItem::orderBy('updated_at', 'desc')
            ->where('user_id', Auth::user()->id)
            ->paginate(10);
        return view('product.purchase-history', ['data' => $data]);
    }

    public function searchAccessories($keyword)
    {
        $data = Product::orderBy('updated_at', 'desc')
            ->where('category_id', '2')
            ->where('enabled_flag', true)
            ->where('name', 'like', '%' . $keyword . '%')
            ->paginate(10);

        if (Auth::user()) {
            $count = CartItem::all()
                ->where('item_count', '>', 0)
                ->where('user_id', Auth::user()->id)->count();
        } else {
            $count = 0;
        }

        return view('accessories.accessories-list', ['accessories' => $data, 'cart_list_count' => $count, 'keyword' => $keyword]);
    }

    public function searchPhones($keyword)
    {
        $data = Product::orderBy('updated_at', 'desc')
            ->where('category_id', '1')
            ->where('enabled_flag', true)
            ->where('name', 'like', '%' . $keyword . '%')
            ->paginate(10);

        if (Auth::user()) {
            $count = CartItem::all()
                ->where('item_count', '>', 0)
                ->where('user_id', Auth::user()->id)->count();
        } else {
            $count = 0;
        }

        return view('phones.phones-list', ['phones' => $data, 'cart_list_count' => $count, 'keyword' => $keyword]);
    }

    public function showUserProductDetail($invoice_no)
    {
        $data = SoldItem::all()
            ->where('invoice_number', $invoice_no)
            ->first();

        $invoice = Invoice::all()
            ->where('invoice_number', $data->invoice_number);

        if ($invoice && $invoice->isNotEmpty()) {

            $total_amount = 0;
            $pay_method = $invoice->first()->pay_method;
            foreach ($invoice as $item) {
                $total_amount = $total_amount + ($item->product_price * $item->item_count);
            }

            return view('product.product-purchased-detail', ['data' => $data, 'invoice' => $invoice, 'pay_method' => $pay_method]);
        } else {
            return redirect('/sold-list/get-sold-list/user');
        }
    }

    public function filterPhonesAdmin($brand_id, $model_id)
    {
        /*$data = Product::latest()
            ->where('category_id', '1')
            ->where('enabled_flag', true)
            ->where('brand_id', $brand_id)
            ->where('model_id', $model_id)
            ->paginate(12);*/

        if ($brand_id == 0 && $model_id == 0) {
            $data = Product::latest()
                ->where('category_id', 1)
                ->where('enabled_flag', true)
                ->paginate(12);
        } else if ($brand_id > 0 && $model_id == 0) {
            $data = Product::latest()
                ->where('category_id', 1)
                ->where('enabled_flag', true)
                ->where('brand_id', $brand_id)
                ->paginate(12);
        } else if ($brand_id == 0 && $model_id > 0) {
            $data = Product::latest()
                ->where('category_id', 1)
                ->where('enabled_flag', true)
                ->where('model_id', $model_id)
                ->paginate(12);
        } else {
            $data = Product::latest()
                ->where('category_id', 1)
                ->where('enabled_flag', true)
                ->where('brand_id', $brand_id)
                ->where('model_id', $model_id)
                ->paginate(12);
        }

        $categories = Category::all();
        $brands = Brand::all();

        return view('admin.phones-list-admin', ['phones' => $data, 'categories' => $categories, 'brands' => $brands, 'brand_id' => $brand_id, 'model_id' => $model_id]);
    }

    public function filterAccessoriesAdmin($brand_id, $model_id)
    {
        /*$data = Product::latest()
            ->where('category_id', '2')
            ->where('enabled_flag', true)
            ->where('brand_id', $brand_id)
            ->where('model_id', $model_id)
            ->paginate(12);*/

        if ($brand_id == 0 && $model_id == 0) {
            $data = Product::latest()
                ->where('category_id', 2)
                ->where('enabled_flag', true)
                ->paginate(12);
        } else if ($brand_id > 0 && $model_id == 0) {
            $data = Product::latest()
                ->where('category_id', 2)
                ->where('enabled_flag', true)
                ->where('brand_id', $brand_id)
                ->paginate(12);
        } else if ($brand_id == 0 && $model_id > 0) {
            $data = Product::latest()
                ->where('category_id', 2)
                ->where('enabled_flag', true)
                ->where('model_id', $model_id)
                ->paginate(12);
        } else {
            $data = Product::latest()
                ->where('category_id', 2)
                ->where('enabled_flag', true)
                ->where('brand_id', $brand_id)
                ->where('model_id', $model_id)
                ->paginate(12);
        }

        $categories = Category::all();
        $brands = Brand::all();

        return view('admin.accessories-list-admin', ['accessories' => $data, 'categories' => $categories, 'brands' => $brands, 'brand_id' => $brand_id, 'model_id' => $model_id]);
    }

    public function welcome()
    {
        //$data = Product::all();
        //$data = "Hello";
        //return view('welcome', ['data' => $data]);

        return view('welcome');
    }
}
