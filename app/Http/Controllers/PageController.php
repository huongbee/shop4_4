<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Slide;
use App\Products;
use App\TypeProduct;
use Session;
use App\Cart;
use App\Customer;
use App\Bills;
use App\BillDetail;
use Mail;

class PageController extends Controller
{
    public function getTrangchu(){

        $slide = Slide::all();
        $promotion_product = Products::whereColumn('unit_price','>','promotion_price')
                                    ->paginate(8);
        $new_product = Products::orderBy('id','DESC')
                                ->limit(4)
                                ->get();

        
    	return view('pages.index',compact('slide','promotion_product','new_product'));
    }

    public function getProductByType($id){
        $product = Products::where([
                                ['id_type','=',$id]
                            ])->paginate(6);
        $type_product = TypeProduct::where('id',$id)->first();
        //dd($type);
    	return view('pages.type',compact('product','type_product'));
    }


    public function getDetailProduct($id){
        $product = Products::where('id',$id)->first();

        $id_type = $product->id_type;
        $related_product = Products::where('id_type',$id_type)->paginate(3);

        $best_seller = Products::selectRaw("products.id,products.name,products.promotion_price,products.image, sum(bill_detail.quantity) as tongsoluong")
                    ->join('bill_detail',function($join){
                        $join->on('products.id','=','bill_detail.id_product');
                            
                    })->groupBy('products.id','products.name','products.promotion_price','products.image')
                    ->orderBy('tongsoluong','DESC')
                    ->limit(10)->get();



        //dd($best_seller);

    	return view('pages.detail',compact('product','related_product','best_seller'));
    }

    public function getCheckout(){
        $cart = Session::has('cart')?Session::get('cart'):null;
        if($cart == null){
            return redirect()->route('trangchu');
        }
    	return view('pages.checkout');
    }

    public function postCheckout(Request $req){

        $this->validate($req,
            [
                'fullname'=>'required|max:30',
                'address'=>'required',
                'email'=>'required|email|max:30|min:5',
                'phone'=>'required|numeric',
                'payment_method'=>'required',
            ],
            [
                'fullname.required'=>'Họ tên không được rỗng',
                'fullname.max'=>'Họ tên không quá 30 kí tự',
                'address.required'=>'Vui lòng nhập địa chỉ',
                'email.email'=>'Không đúng định dạng email',
                'phone.numeric'=>'Số đt là số'
            ]
        );

        $cart = Session::get('cart');

        $customer = new Customer;
        $customer->name = $req->fullname;
        $customer->gender = '-';
        $customer->email = $req->email;
        $customer->address = $req->address;
        $customer->phone_number = $req->phone;
        $customer->note  = $req->notes;
        $customer->save();
        if($customer){
            $bill = new Bills;
            $bill->id_customer = $customer->id;
            $bill->date_order = date('Y-m-d');
            $bill->total = $cart->totalPrice;
            $bill->payment = $req->payment_method;
            $bill->note = $req->notes;
            $bill->save();
            if($bill){
                foreach($cart->items as $item){
                    $bill_detail = new BillDetail;
                    $bill_detail->id_bill = $bill->id;
                    $bill_detail->id_product = $item['item']->id;
                    $bill_detail->quantity = $item['qty'];
                    $bill_detail->unit_price = $item['item']->promotion_price;
                    $bill_detail->save();
                }
            }

           
            Mail::send('pages.xacnhan_cart', ['cart' => $cart], function ($message) use($req)
            {
                $message->from('huonghuong08.php@gmail.com', 'Hương Hương');
                $message->to($req->email,$req->fullname);
                $message->subject('Xác nhận đơn hàng');
            });


            $req->session()->forget('cart');

            return redirect()->route('trangchu');
        }

    }
/*


<p><img alt="" src="/public/images/20228779_1119591398185561_8237886134628969716_n.jpg" style="height:113px; width:200px" /></p>

<p>H&igrave;nh v&iacute; dụ</p>



*/


    public function getLogin(){
    	return view('pages.login');
    }

    public function getShoppingCart(){
        $cart = Session::has('cart')?Session::get('cart'):null;
        // if($cart == null){
        //     return redirect()->route('trangchu');
        //}
    	return view('pages.cart',compact('cart'));
    }

    public function getRegister(){
    	return view('pages.register');
    }

    public function addToCart(Request $req, $id){
        $product = Products::where('id',$id)->first();
        if($product){
            $oldCart = Session::has('cart') ? Session::get('cart') : null;
            $cart = new Cart($oldCart);
            $cart->add($product, $id,1);
            $req->session()->put('cart',$cart);//$_SESSION['cart'] = $cart;
            return redirect()->back();
        }

    }

    public function deleteCart(Request $req, $id){
        $product = Products::where('id',$id)->first();
        if($product){
            $oldCart = Session::has('cart') ? Session::get('cart') : null;
            $cart = new Cart($oldCart);
            $cart->removeItem($id);
            if(count($cart->items)>0){
                $req->session()->put('cart',$cart);//$_SESSION['cart'] = $cart;
            }
            else{
                Session::forget('cart');
            }
            return redirect()->back();
        }
    }

    public function editCart(Request $req){
        //echo $req->idSP; die;
        $product = Products::where('id',$req->idSP)->first();
        if($product){

            $oldCart = Session::has('cart')?Session::get('cart'):null;
            $cart = new Cart($oldCart);

            $cart->removeItem($req->idSP);
            $req->session()->put('cart',$cart);

            $oldCart = Session::has('cart')?Session::get('cart'):null;
            $cart = new Cart($oldCart);
            $cart->add($product, $req->idSP, (int)$req->soluong);
            $req->session()->put('cart',$cart);
            echo number_format($cart->totalPrice).' vnđ';
        }

    }
}
