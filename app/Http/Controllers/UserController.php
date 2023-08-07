<?php

namespace App\Http\Controllers;

use App\Models\Address;
use App\Models\Banner;
use App\Models\category;
use App\Models\ContactForm;
use App\Models\Enquiry;
use App\Models\EnquiryDetail;
use App\Models\Faq;
use App\Models\Listing;
use App\Models\Policy;
use App\Models\Register;
use App\Models\Socialmedia;
use Illuminate\Support\Facades\Session;
use Illuminate\Http\Request;
use Illuminate\Support\Arr;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Mail;
use PhpParser\Node\Expr\List_;

class UserController extends Controller
{

    public function home()
    {
        $banner = Banner::where('banner_set', 1)->get();
        $featured = Listing::where('featured', 1)->get();
        $late = Listing::orderBy('id', 'desc')->limit(8)->get();
        return view('user.home', compact('late', 'featured', 'banner'));
    }
    public function shop(Request $request)
    {
        $limit = 9;
        $total = Listing::get();
        $records = Listing::select('brand_name')->orderBy('brand_name', 'asc')->get()->unique('brand_name');
        $count = count($total);
        // dd($count);
        $total_page = ceil($count / $limit);
        if(!empty($request->brands)){
            $brands = Listing::where('brand_name', $request->brands)->get();
            return view('user.shop', compact('total_page', 'records', 'brands'));
        }else{
            return view('user.shop', compact('total_page', 'records'));
        }
    }
    public function product(Request $request)
    {
        $listing = Listing::limit(4)->get();
        $product = DB::table('listings')
            ->select('listings.id', 'listings.car_name', 'listings.image', 'listings.brand_name', 'listings.category', 'listings.model_year', 'listings.price', 'listings.city', 'listings.description', 'categories.sub_category',)
            ->join('categories', 'categories.id', '=', 'listings.category')
            ->where('listings.id', $request->id)
            ->first();
        return view('user.product', compact('product', 'listing'));
    }
    public function contact(Request $request)
    {
        $ses = Session::get('userlogin');
        if ($request->all()) {
            $contact = new ContactForm;
            $contact->name = $request->name;
            $contact->email = $request->email;
            $contact->subject = $request->subject;
            $contact->message = $request->message;
            $contact->cust_id = $ses;
            $contact->save();
            return array('code' => 100);
        }
        $add = Address::first();
        return view('user.contact', compact('add'));
    }
    public function shopping_cart(Request $request)
    {
        $offset = ((5 * $request->page));
        if ($offset != 0) {
            $offset = $offset - 5;
        }
        $ses = Session::get('userlogin');
        $enquiry = EnquiryDetail::select('enquiry_details.id', 'enquiry_details.car_name', 'enquiry_details.brand_name', 'enquiry_details.model_year', 'enquiry_details.category', 'enquiry_details.car_image', 'enquiry_details.price', 'enquiry_details.enquiry_id', 'enquiry_details.cust_id', 'categories.sub_category')
            ->join('categories', 'categories.id', '=', 'enquiry_details.category',)
            ->where('enquiry_details.cust_id', $ses)
            ->paginate(5);
        return view('user.cart', compact('enquiry', 'offset'));
    }
    public function enquire(Request $request)
    {
        $enquire = Listing::select('listings.id', 'listings.car_name', 'listings.model_year', 'listings.brand_name', 'listings.category', 'listings.price', 'listings.image', 'categories.sub_category',)
            ->join('categories', 'categories.id', '=', 'listings.category')
            ->where('listings.id', $request->id)
            ->first();
        return view('user.enquire', compact('enquire'));
    }

    // same function for view and insert data 

    public function register(Request $request)
    {
        $token = self::generateRandomString();
        if ($request->all()) {
            $request->validate([
                'name' => "required",
                'email' => "required|email|unique:registers",
                'phone' => "min:10|required",
                'password' => 'required_with:re_password|same:re_password',
                're_password' => 'required'
            ]);
            $register = new Register;
            $register->name = $request->name;
            $register->email = $request->email;
            $register->phone = $request->phone;
            $register->password = Hash::make($request->password);
            $register->verify_token = $token;
            $register->save();

            $details = [
                'title' => 'Mail from Only Cars',
                'body' => 'Please verify your account by clicking on the link below.',
                'token' => $token
            ];
            Mail::to($request->email)->send(new \App\Mail\RegisterMail($details));
            return array('code' => 100, 'msg' => 'Successfully Registered! Please Verify Your Email!');
        }
        return view('user.register');
    }
    public function login(Request $request)
    {
        if ($request->all()) {
            $request->validate([
                'email' => 'required',
                'password' => 'required',
            ]);
            $user = Register::where('email', $request->email)->first();
            if (!empty($user)) {
                if ($user->status == 1) {
                    if ($request->email == $user->email && Hash::check($request->password, $user->password)) {
                        Session::put('userlogin', $user->id);
                        return redirect('home')->with('message', 'You logged in successfully.');
                    } else {
                        return redirect()->back()->with('error', 'Wrong Password!');
                    }
                } else {
                    return redirect()->back()->with('error', 'This email is not verified!');
                }
            } else {
                return redirect()->back()->with('error', 'This email is not registered!');
            }
        }
        // Session::pull('userlogin');
        return view('user.login');
    }

    // random string generator 

    public static function generateRandomString($length = 25)
    {
        $characters = '0123456789abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ';
        $charactersLength = strlen($characters);
        $randomString = '';
        for ($i = 0; $i < $length; $i++) {
            $randomString .= $characters[random_int(0, $charactersLength - 1)];
        }
        return $randomString;
    }

    // email verification function 

    public function verify(Request $request)
    {
        $user = Register::where('verify_token', $request->token)->first();
        if (!empty($user)) {
            $user->status = 1;
            $user->verify_token = '';
            if ($user->save()) {
                Session::flash('verify_message', 'Email confirmed please login!');
                return redirect('/login');
            }
        }
        Session::flash('verify_error', 'This link has been expired!');
        return redirect('/register');
    }

    public function user_logout()
    {
        if (Session::has('userlogin')) {
            Session::pull('userlogin');
            return redirect('login')->with('error', 'You have been logged out!');
        }
    }
    public function price_filter(Request $request)
    {
        $brand = $request->name;
        $search = $request->search;
        $page = $request->page;
        $limit = 9;
        $offset = ($page - 1) * $limit;
        $chnge = $request->arr;

        // making object of a query 

        $price = Listing::select('id', 'car_name', 'brand_name', 'price', 'image', 'model_year');

        // brand filter query with dropdwon start 

        if (isset($brand) && !empty($brand)) {
            $price = $price->where('brand_name', $brand);
        }
        // brand filter query with dropdwon end

        // search box filter query start 

        if (isset($search) && !empty($search)) {
            $price = $price->where('brand_name', 'like', $search . '%')->orWhere('car_name', 'like', $search . '%');
        }
        // search box filter query end

        // year filter query with checkbox start 

        if (isset($chnge) && !empty($chnge)) {
            foreach ($chnge as $change) {
                $arr = explode("-", $change);
                $price = $price->orwhereBetween('model_year', [$arr[0], $arr[1]]);
                unset($arr);
            }
        }
        // year filter query with checkbox end

        // price filter query with select box start

        if ($request->val == 1) {
            $price = $price->where('price', '<=', 1000000);
        } elseif ($request->val == 2) {
            $price = $price->where('price', '>=', 1000000)->where('price', '<=', 2000000);
        } elseif ($request->val == 3) {
            $price = $price->where('price', '>=', 2000000)->where('price', '<=', 5000000);
        } elseif ($request->val == 4) {
            $price = $price->where('price', '>=', 5000000)->where('price', '<=', 10000000);
        } elseif ($request->val == 5) {
            $price = $price->where('price', '>=', 10000000);
        }
        // price filter query with select box end

        $price = $price->orderBy('id', 'desc')->offset($offset)->limit($limit)->get();
        return response()->json($price);
    }
    public function new_cars()
    {
        return view('user.new_cars');
    }
    public function categories()
    {
        $category = category::where('parent', 0)->get();
        return $category;
    }
    public function category_product(Request $request)
    {
        $listing =  DB::table('listings')
            ->select('listings.id', 'listings.category', 'listings.car_name', 'listings.brand_name', 'listings.image', 'listings.price', 'categories.sub_category')
            ->join('categories', 'categories.id', '=', 'listings.category')
            ->where('listings.category', $request->id)
            ->get();
        return view('user.cat_product', compact('listing'));
    }
    public function cities()
    {
        $cities = Listing::select('id', 'city')
            ->get()
            ->unique('city');
        return ($cities);
    }
    public function city(Request $request)
    {
        $city = Listing::where('city', $request->city)->get();
        return view('user.city', compact('city'));
    }
    public function search(Request $request)
    {
        // dd($request->search);
        $search = Listing::where('car_name', $request->search)->orWhere('brand_name', $request->search)->get();
        return view('user.search', compact('search'));
    }
    public function search_list(Request $request)
    {
        if (!empty($request->keyword)) {
            $list = Listing::select('id', 'car_name', 'brand_name')->where('car_name', 'like', '%' . $request->keyword . '%')->orWhere('brand_name', 'like', '%' . $request->keyword . '%')->get();
            return $list;
        }
    }
    public function send_enquiry(Request $request)
    {
        $request->validate([
            'fname' => 'required',
            'lname' => 'required',
            'email' => 'required|email',
            'phone' => 'required',
            'address' => 'required',
            'city' => 'required'
        ], [
            'fname.required' => 'The first name field is required.',
            'lname.required' => 'The last name field is required.',
        ]);

        $ses = Session::get('userlogin');
        $send = new Enquiry;
        $send->cust_id = $ses;
        $send->fname = $request->fname;
        $send->lname = $request->lname;
        $send->email = $request->email;
        $send->phone = $request->phone;
        $send->address = $request->address;
        $send->city = $request->city;
        $send->description = $request->description;
        $send->save();

        $id = DB::getPdo()->lastInsertId();
        $car = new EnquiryDetail;
        $car->enquiry_id = $id;
        $car->car_name = $request->car_name;
        $car->brand_name = $request->brand_name;
        $car->model_year = $request->model_year;
        $car->category = $request->category;
        $car->price = $request->price;
        $car->car_image = $request->car_image;
        $car->cust_id = $ses;
        $car->save();

        $name = $request->fname . ' ' . $request->lname;
        $car = $request->car_name;
        $brand = $request->brand_name;
        $details = [
            'name' => $name,
            'car_name' => $car,
            'brand_name' => $brand
        ];
        Mail::to($request->email)->send(new \App\Mail\EnquiryMail($details));
        return array('code' => 100);
    }
    public function enq()
    {
        $ses = Session::get('userlogin');
        $enq = Enquiry::where('cust_id', $ses)->get();
        $enquiry = count($enq);
        return $enquiry;
    }
    public function faq()
    {
        $faq = Faq::get();
        return view('user.faq', compact('faq'));
    }
    public function privacy()
    {
        $privacy = Policy::first();
        return view('user.privacy', compact('privacy'));
    }
    public function footer_address()
    {
        $add = Address::first();
        return $add;
    }
    public function social()
    {
        $social = Socialmedia::first();
        return $social;
    }
}
