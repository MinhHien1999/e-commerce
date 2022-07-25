<?php

namespace App\Http\Controllers;

use App\Models\Banner;
use App\Models\Category;
use App\Models\Product;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Http\Requests\SignupRequest;
use Illuminate\Support\Facades\Hash;
use App\User;
use Session;

class FrontendController extends Controller
{
    //

    public function index()
    {
        $banners = Banner::getBanner();
        return view('frontend.index', compact('banners'));
    }
    public function shop()
    {
        return view('frontend.shop');
    }
    public function productCat(Request $request, $slug)
    {
        $category = Category::getCategory($slug);
        // $category = Category::where('slug', $slug)->firstOrFail();
        $productCat = Product::getProductCat($category->id);
        // return $productCat;
        $sort = request()->query('sort');
        $route = request()->segment(1); 
        // $productCat = sortProductCat($category->id,$sort);
        if (!empty(request()->query('sort'))) {
            $productCat = $this->sortProductCat($category->id, request()->query('sort'));
        }
        $lastPage = $productCat->lastPage();
        
        if ($request->ajax()) {
            $html = view('frontend.pages.single-product', compact('productCat'))->render();
            return response()->json(['html' => $html, 'page' => $productCat]);
        }
        // return $productCat;
        return view('frontend.pages.product-category', compact('productCat', 'route', 'category','lastPage','sort'));
    }
    public function sortProductCat($cat_id, $sort)
    {
        switch ($sort) {
                // case 'latest':
                //     return getProductCat($cat_id);
                //     break;
            case "titleASC":
                return Product::where(['cat_id' => $cat_id, 'status' => 'active'])->orderBy('title', 'ASC')->paginate(9);
                break;
            case "titleDESC":
                return Product::where(['cat_id' => $cat_id, 'status' => 'active'])->orderBy('title', 'DESC')->paginate(9);
                break;
            case "priceDESC":
                return Product::where(['cat_id' => $cat_id, 'status' => 'active'])->orderBy('price', 'DESC')->paginate(9);
                break;
            case "priceASC":
                return Product::where(['cat_id' => $cat_id, 'status' => 'active'])->orderBy('price', 'ASC')->paginate(9);
                break;
            default:
                return Product::getProductCat($cat_id);
        }
    }
    public function productDetail($slug)
    {
        $product = Product::getProductDetail($slug);
        // return $product;

        return view('frontend.pages.product-detail', compact('product'));
    }
    public function cart()
    {
        return view('frontend.pages.cart');
    }
    public function showLoginForm()
    {
        return view('login');
    }
    public function showRegisterForm()
    {
        return view('register');
    }
    public function autoSearch(Request $request)
    {
        $query = $request->search;
        $products = Product::where('title', 'LIKE', '%' . $query . '%')->where('status', 'active')
            ->orwhere('price', 'LIKE', '%' . $query . '%')->where('status', 'active')
            ->limit(5)->get();
        $data = array();
        foreach ($products as $product) {
            $data[] = array('value' => $product->title, 'id' => $product->id);
        }
        if (count($data)) {
            return $data;
        } else {
            return ['value' => 'No Result Found', 'id' => ''];
        }
    }
    public function productSearch(request $request)
    {
        $query = $request->search;
        $productSearch = Product::where('title', 'LIKE', '%' . $query . '%')->where('status', 'active')
            ->orwhere('price', 'LIKE', '%' . $query . '%')->where('status', 'active')
            ->paginate(9);
        // return $products;
        return view('frontend.pages.product-search', compact('productSearch'));
    }
    public function register(SignupRequest $request)
    {

        $user = new User();
        $user->name = $request->name;
        $user->email = $request->email;
        $user->password = Hash::make($request->password);
        $user->save();

        Session()->flash('success', 'Đăng kí thành công');
        return redirect()->route('login');
    }
    public function login(Request $request)
    {

        $credentials = $request->only('email', 'password');

        if (Auth::attempt($credentials)) {
            Session()->put('user', Auth::user());
            if (Auth::attempt($credentials, 'role' == 'admin')) {
                return redirect()->intended('admin')->with('success', 'Successfully Login');
            } else {
                return redirect()->intended('login')->with('success', 'Successfully Login');
            }
        } else {
            request()->session()->flash('error', 'Invalid email and password pleas try again!');
            return redirect()->back();
        }
    }

    public function logout()
    {
        if (Auth()->check()) {
            Session()->forget('user');
            Auth::logout();
            request()->session()->flash('success', 'Đăng xuất thành công');
            return redirect()->route('login');
        } else {
            request()->session()->flash('error', 'Đăng xuất thất bại');
            return redirect()->route('login');
        }
    }
}