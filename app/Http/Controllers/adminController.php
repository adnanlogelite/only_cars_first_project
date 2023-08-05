<?php

namespace App\Http\Controllers;

use App\Models\Address;
use Illuminate\Http\Request;
use App\Models\Admin;
use App\Models\category;
use App\Models\Listing;
use App\Models\Banner;
use App\Models\Enquiry;
use App\Models\Faq;
use App\Models\Policy;
use App\Models\Register;
use App\Models\Socialmedia;
use Egulias\EmailValidator\Result\Reason\UnclosedComment;
use Illuminate\Support\Arr;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Session;
use Spatie\Backtrace\Arguments\ReducedArgument\ReducedArgument;
use Symfony\Component\HttpKernel\DataCollector\RequestDataCollector;

class adminController extends Controller
{
    public function dashboard()
    {
        $users = Register::get();
        $enquire = Enquiry::get();
        $cars = Listing::get();
        $category = category::where('parent', 0)->get();
        $cat = count($category);
        $car = count($cars);
        $enquiry = count($enquire);
        $user = count($users);
        return view('admin.dashboard', compact('user', 'enquiry', 'car', 'cat'));
    }
    public function admin_register()
    {
        return view('admin.template.admin_register');
    }

    // admin registeration function 

    public function register(Request $request)
    {
        $request->validate([
            'fullname' => 'required',
            'email' => 'required|email|unique:admins',
            'password' => 'required'
        ], [
            'fullname.required' => 'The full name field is required.'
        ]);
        $register = new Admin;
        $register->name = $request->fullname;
        $register->email = $request->email;
        $register->password = Hash::make($request->password);
        $register->save();
        return redirect('/admin-login');
    }
    public function admin_login()
    {
        return view('admin.template.admin_login');
    }

    // admin login function 

    public function login(Request $request)
    {
        $request->validate([
            'email' => 'required|email',
            'password' => 'required'
        ]);
        $user = Admin::where('email', $request->email)->first();
        if ($user != '') {
            if ($request->email == $user->email && Hash::check($request->password, $user->password)) {
                Session::put('adminlogin', $user->id);
                return redirect('/dashboard');
            } else {
                return redirect()->back()->with('error', 'Wrong Password');
            }
        } else {
            return redirect()->back()->with('error', 'This email is not registered');
        }
    }

    // admin logout function 

    public function logout()
    {
        if (Session::has('adminlogin')) {
            Session::forget('adminlogin');
            return redirect('/admin-login');
        }
    }

    // admin categories funtion 

    public function categories()
    {
        $categories = category::all();
        return view('admin.categories', ['categories' => $categories]);
    }

    // category form view function 

    public function add_category(Request $request, $id = null)
    {
        if (!empty($id)) {
            $categories = category::where('parent', 0)->get()->unique('category');
            $edit = category::where('id', $request->id)->first();
            return view('admin.catform', ['edit' => $edit, 'categories' => $categories]);
        } else {
            $edit = category::where('id', $request->id)->first();
            $categories = category::where('parent', 0)->get()->unique('category');
            return view('admin.catform', ['categories' => $categories, 'edit' => $edit]);
        }
    }

    // add category function

    public function category_added(Request $request)
    {
        $request->validate([
            'category' => 'required',
            'parent' => 'required'
        ]);
        if (empty($request->cid)) {
            $category = new category;
            if ($request->parent == 0) {
                $category->category = $request->category;
                $category->sub_category = $request->category;
                $category->parent = $request->parent;
                $category->description = $request->description;
                $category->save();
            } else {
                $category_name = category::select('category')->where('id', $request->parent)->first();
                $category->category = $category_name->category;
                $category->sub_category = $request->category;
                $category->parent = $request->parent;
                $category->description = $request->description;
                $category->save();
            }
            $data['code'] = 200;
            $data['msg'] = 'Added Successfully!';
            return $data;
        }
        if (!empty($request->cid)) {
            if ($request->parent == 0) {
                $update_cat = category::where('id', $request->cid)->update([
                    'category' => $request->category,
                    'sub_category' => $request->category,
                    'parent' => $request->parent,
                    'description' => $request->description
                ]);
            } else {
                $cat_name = category::select('category')->where('id', $request->parent)->first();
                $update_cat = category::where('id', $request->cid)->update([
                    'category' => $cat_name->category,
                    'sub_category' => $request->category,
                    'parent' => $request->parent,
                    'description' => $request->description
                ]);
            }
            $data['code'] = 100;
            $data['msg'] = 'Updated Successfully!';
            return $data;
        }
    }

    // edit category function 

    public function edit_category(Request $request)
    {
        $edit = category::where('id', $request->id)->first();
        return view('admin.catform', ['edit' => $edit]);
    }

    // delete category function

    public function delete_category(Request $request)
    {
        $delete = category::where('id', $request->id);
        $delete->delete();

        return array('code' => 300, 'msg' => 'Deleted Successfully!');
    }

    // listing form view funtion

    public function listing(Request $request, $id = null)
    {
        if (!empty($id)) {
            $categories = category::where('parent', 0)->get()->unique('category');
            $listing = Listing::where('id', $request->id)->first();
            return view('admin.addlisting', ['listing' => $listing, 'categories' => $categories]);
        } else {
            $listing = Listing::where('id', $request->id)->first();
            $categories = category::where('parent', 0)->get()->unique('category');
            return view('admin.addlisting', ['listing' => $listing, 'categories' => $categories]);
        }
    }

    // add listing function

    public function listing_added(Request $request)
    {
        $request->validate([
            'image' => 'required',
            'car_number' => 'required',
            'car_name' => 'required',
            'brand_name' => 'required',
            'category' => 'required',
            'model_year' => 'required',
            'price' => 'required',
            'city' => 'required'
        ]);

        if (empty($request->lid)) {
            $image_name = time() . '.' . $request->image->getClientOriginalExtension();
            $request->image->move(public_path('images'), $image_name);
            $listing = new Listing;
            $listing->image = $image_name;
            $listing->car_number = $request->car_number;
            $listing->car_name = $request->car_name;
            $listing->brand_name = $request->brand_name;
            $listing->category = $request->category;
            $listing->model_year = $request->model_year;
            $listing->price = $request->price;
            $listing->city = $request->city;
            $listing->description = $request->description;
            $listing->save();

            $data['code'] = 200;
            $data['msg'] = 'Listing Added Successfully!';
            return $data;
        } else {
            $image_name = time() . '.' . $request->image->getClientOriginalExtension();
            $request->image->move(public_path('images'), $image_name);
            $update_listing = Listing::where('id', $request->lid)->update([
                'image' => $image_name,
                'car_number' => $request->car_number,
                'car_name' => $request->car_name,
                'brand_name' => $request->brand_name,
                'category' => $request->category,
                'model_year' => $request->model_year,
                'price' => $request->price,
                'city' => $request->city,
                'description' => $request->description
            ]);

            $data['code'] = 100;
            $data['msg'] = 'Listing Updated Successfully';
            return $data;
        }
    }

    // listing view function

    public function listings(Request $request)
    {
        $offset = (10 * $request->page);
        if ($offset != 0) {
            $offset = $offset - 10;
        }
        $listing = Listing::paginate(10);
        return view('admin.listing', ['listing' => $listing, 'offset' => $offset]);
    }

    //listing delete function

    public function delete_listing(Request $request)
    {
        Listing::where('id', $request->id)->delete();
        return array('code' => 300, 'msg' => 'Listing Deleted Successfully!');
    }

    // Users view function

    public function users(Request $request)
    {
        $users = Register::get();
        return view('admin.users', compact('users'));
    }

    // Enquiry view function

    public function enquiry()
    {
        $enquire = Enquiry::select('enquiries.id', 'enquiries.fname', 'enquiries.lname', 'enquiry_details.car_image', 'enquiry_details.car_name', 'enquiry_details.brand_name')
            ->join('enquiry_details', 'enquiry_details.enquiry_id', '=', 'enquiries.id')
            ->paginate(5);
        return view('admin.enquiry', compact('enquire'));
    }

    // Read Enquiry function

    public function read_enquiry(Request $request)
    {
        $detail = Enquiry::select('enquiries.id', 'enquiries.fname', 'enquiries.lname', 'enquiries.email', 'enquiries.phone', 'enquiries.city', 'enquiries.address', 'enquiries.description', 'enquiry_details.car_image', 'enquiry_details.car_name', 'enquiry_details.brand_name', 'enquiry_details.brand_name', 'enquiry_details.model_year', 'enquiry_details.category', 'enquiry_details.price', 'categories.sub_category')
            ->join('enquiry_details', 'enquiry_details.enquiry_id', '=', 'enquiries.id')
            ->join('categories', 'categories.id', '=', 'enquiry_details.category')
            ->where('enquiries.id', $request->id)
            ->first();
        return view('admin.read_enquiry', compact('detail'));
    }

    // Banner upload function

    public function banner()
    {
        return view('admin.banner');
    }

    public function banner_list()
    {
        $banner = Banner::orderBy('id', 'desc')->get();
        return $banner;
    }

    // Banner uploaded Function

    public function banner_upload(Request $request)
    {
        $request->validate([
            'banner' => 'required'
        ]);

        $banner_name = time() . '.' . $request->banner->getClientOriginalExtension();
        $request->banner->move(public_path('images'), $banner_name);
        $banner = new Banner;
        $banner->banner_img = $banner_name;
        $banner->save();

        $data['code'] = 100;
        $data['msg'] = 'Banner Uploaded!';
        return $data;
    }

    // delete multiple banner function

    public function delete_all(Request $request)
    {
        $ids = $request->ids;
        Banner::whereIn('id', explode(',', $ids))->delete();
        return array('code' => 300, 'msg' => 'Banners Deleted Successfully!');
    }

    // set banner function

    public function banner_status(Request $request)
    {
        $banners = Banner::where('id', $request->id)->value('banner_set');
        if ($banners == 0) {
            $banners = 1;
            Banner::where('id', $request->id)->update([
                'banner_set' => $banners
            ]);
            return array('code' => 200, 'msg' => 'Banner Enabled Successfully!');
        } else {
            $banners = 0;
            Banner::where('id', $request->id)->update([
                'banner_set' => $banners
            ]);
            return array('code' => 100, 'msg' => 'Banner Disabled Successfully!');
        }
    }

    public function featured(Request $request)
    {
        $featured = Listing::where('id', $request->lid)->value('featured');
        if ($featured == 0) {
            $featured = 1;
            Listing::where('id', $request->lid)->update([
                'featured' => $featured
            ]);
            return array('code' => 1, 'msg' => 'Featured Successfully!');
        } else {
            $featured = 0;
            Listing::where('id', $request->lid)->update([
                'featured' => $featured
            ]);
            return array('code' => 0, 'msg' => 'Featured Removed!');
        }
    }
    public function edit_user(Request $request)
    {
        $user = Register::where('id', $request->id)->first();
        return view('admin.edit_user', compact('user'));
    }
    public function user_edited(Request $request)
    {
        Register::where('id', $request->uid)->update([
            'name' => $request->uname,
            'email' => $request->uemail,
            'phone' => $request->uphone,
        ]);
        return redirect('/admin-users');
    }
    public function udelete(Request $request)
    {
        $delete = Register::where('id', $request->id);
        $delete->delete();

        return array('code' => 100, 'msg' => 'User Deleted Successfully!');
    }
    public function admin_faq()
    {
        $faq = Faq::select('id', 'title')->get();
        return view('admin.faq_list', compact('faq'));
    }
    public function upload_faq(Request $request)
    {
        if (empty($request->fid)) {
            if ($request->all()) {
                $faq = new Faq;
                $faq->title = $request->title;
                $faq->content = $request->content;
                $faq->save();
                return array('code' => 100, 'msg' => 'Question Added Successfully!');
            }
        }
        if (!empty($request->fid)) {
            Faq::where('id', $request->fid)->update([
                'title' => $request->title,
                'content' => $request->content,
            ]);
            return array('code' => 200, 'msg' => 'Question Updated Successfully!');
        }
    }
    public function faq_form(Request $request)
    {
        $faq = Faq::where('id', $request->id)->first();
        return view('admin.admin_faq', compact('faq'));
    }
    public function admin_privacy()
    {
        $policy = Policy::first();
        return view('admin.admin_privacy', compact('policy'));
    }
    public function upload_privacy(Request $request)
    {
        Policy::where('id', $request->pid)->update([
            'title' => $request->title,
            'content' => $request->content,
        ]);
        return redirect('/admin-privacy');
    }
    public function delete_faq(Request $request)
    {
        $delete = Faq::where('id', $request->id);
        $delete->delete();

        return array('code' => 300, 'msg' => 'Deleted Successfully!');
    }
    public function address()
    {
        $add = Address::first();
        return view('admin.admin_address', compact('add'));
    }
    public function add_address(Request $request)
    {
        $request->validate([
            'address' => 'required',
            'email' => 'required|email',
            'phone' => 'required',
            'description' => 'required',
        ]);
        $add = Address::where('id', $request->aid)->update([
            'address' => $request->address,
            'email' => $request->email,
            'phone' => $request->phone,
            'description' => $request->description
        ]);
        return array('code' => 100, 'msg' => 'Updated Successfully!');
    }
    public function social()
    {
        $social = Socialmedia::first();
        return view('admin.social', compact('social'));
    }
    public function social_media(Request $request)
    {
        Socialmedia::where('id', $request->sid)->update([
            'facebook' => $request->facebook,
            'twitter' => $request->twitter,
            'linkedin' => $request->linkedin,
            'instagram' => $request->instagram,
            'youtube' => $request->youtube,
            'reddit' => $request->reddit,
            'telegram' => $request->telegram,
            'pinterest' => $request->pinterest
        ]);
        return array('code' => 100, 'msg' => 'Social Links Updated!');
    }
}
