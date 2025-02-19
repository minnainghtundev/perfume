<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Item;
use App\Models\Category;

use Session;
use App\Cart;

use App\Models\Order;
use App\Models\OrderItem;
use App\Models\Payment;
use Illuminate\Contracts\Session\Session as SessionSession;

class ItemController extends Controller
{
    public function listItem()
    {


        $items = Item::all();
        $categories = Category::all();

        // dd($items);

        return view('item.list-item', ['items' => $items, 'categories' => $categories]);
    }

    public function createItem(Request $request)
    {
        $validator = validator(
            request()->all(),
            [
                "category_id" => "required",
                "name"        => "required",
                "photo"       => "required",
                "price"       => "required",
                "qty"       => "required",
            ]
        );

        if ($validator->fails()) {
            return back()->withErrors($validator)->withInput();
        }

        // dd($request->category_id);

        $item = new Item();
        $item->category_id = request()->category_id;

        $item->name   = request()->name;

        if ($request->hasfile('photo')) {
            $file       = $request->file('photo');
            $name       = $file->getClientOriginalName();
            $extension  = $file->getClientOriginalExtension();

            $file->move('images/item/', $name);

            $item->photo = $name;
        } else {
            $item->photo = '';
        }

        $item->price = request()->price;
        $item->qty = request()->qty;
        $item->gender = request()->gender ?: 'unsex';
        $item->status = request()->status;
        $item->remark = request()->remark;



        $item->save();

        return back()->with('add_info', 'New Item added Successfully!');
    }

    public function deleteItem()
    {
        $id = request()->id;
        Item::find($id)->delete();
        return redirect('/admin/item/list')->with('del_info', 'Item Deleted Successfully!');
    }

    public function updItem()
    {
        $id = request()->id;
        $item = Item::find($id);
        $category = Category::all();
        return view('item.upd-item', [
            'item' => $item,
            'category' => $category
        ]);
    }

    public function updateItem(Request $request)
    {
        $validator = validator(
            request()->all(),
            [
                "category_id"       => "required",
                "name"        => "required",
                "price"       => "required",
                "qty"       => "required",
            ]
        );

        if ($validator->fails()) {
            return back()->withErrors($validator)->withInput();
        }

        // dd($request->category_id);

        $item = Item::find(request()->id);

        $item->category_id = request()->category_id;
        $item->name   = request()->name;

        if ($request->hasfile('photo')) {
            $file       = $request->file('photo');
            $name       = $file->getClientOriginalName();
            $extension  = $file->getClientOriginalExtension();

            $file->move('images/item/', $name);

            $item->photo = $name;
        } else {
            $item->photo = '';
        }

        $item->price = request()->price;
        $item->qty = request()->qty;
        $item->gender = request()->gender ?: 'unsex';
        $item->status = request()->status;
        $item->remark = request()->remark;

        // dd($item);



        $item->save();

        return redirect('/admin/item/list')->with('upd_info', 'Item updated Successfully!');
    }

    public function categoryView()
    {
        $category_id    = request()->id;

        $items       = Item::where("category_id", "=", $category_id)->get();


        return view('item.view-item', [
            'items' => $items
        ]);
    }

    public function detailView()
    {
        $item_id    = request()->id;

        $item       = item::find($item_id);

        return view('item.detail-item', [
            'item' => $item
        ]);
    }

    public function getAddToCartQty(Request $request)
    {
        $pid         = request()->id;
        $pqty       = request()->pqty;

        $item       = Item::find($pid);

        $oldCart     = Session::has('cart') ? Session::get('cart') : null;

        $cart        = new Cart($oldCart);
        $cart->addQty($item, $pid, $pqty);

        $request->session()->put('cart', $cart);

        return back()->with('info', "Product added to Cart Successfully !");
    }

    public function getCart(Request $request)
    {
        if (!Session::has('cart')) {
            return view('item.shopping-cart');
        }

        $oldCart = Session::get('cart');
        $cart    = new Cart($oldCart);

        return view('item.shopping-cart', [
            'items'        => $cart->items,
            'totalPrice'      => $cart->totalPrice,
            'totalQty'        => $cart->totalQty,
        ]);
    }

    public function getSubToCart(Request $request)
    {
        $id         = request()->id;
        $item       = Item::find($id);

        $oldCart    = Session::has('cart') ? Session::get('cart') : null;
        $cart       = new Cart($oldCart);

        $cart->sub($item, $id);

        $request->session()->put('cart', $cart);

        return back();
    }

    public function getAddToCart(Request $request)
    {
        $id         = request()->id;
        $item       = Item::find($id);

        $oldCart    = Session::has('cart') ? Session::get('cart') : null;
        $cart       = new Cart($oldCart);


        $cart->add($item, $id);


        $request->session()->put('cart', $cart);

        return back();
    }

    public function getRemoveFromCart(Request $request)
    {
        $id         = request()->id;
        $item       = Item::find($id);

        $oldCart    = Session::has('cart') ? Session::get('cart') : null;
        $cart       = new Cart($oldCart);

        $cart->remove($item, $id);

        $request->session()->put('cart', $cart);

        $checkcart = $request->session()->get("cart");
        if ($checkcart->totalQty == 0) {
            return redirect('/item/clearCart');
        }

        return back();
    }

    public function getClearCart(Request $request)
    {
        if (Session::has('cart')) {
            $request->session()->forget('cart');

            return redirect("/");
        } else {
            return redirect("/");
        }
    }

    public function getOrder(Request $request)
    {
        if (!Session::has('cart')) {
            return redirect("/");
        }


        $oldCart = Session::get('cart');
        $cart    = new Cart($oldCart);


        $order = new Order();

        $order->user_id        = auth()->user()->id;
        $order->totalPrice     = $cart->totalPrice;
        $order->totalQty       = $cart->totalQty;
        $order->status         = "";
        $order->remark         = "";

        $order->save();


        $items = $cart->items;


        foreach ($items as $item) {
            $orderitem = new OrderItem();


            $orderitem->order_id          = $order->id;
            $orderitem->user_id           = auth()->user()->id;

            $orderitem->product_id        = $item['item']['id'];
            $orderitem->name              = $item['item']['name'];
            $orderitem->price             = $item['item']['price'];
            $orderitem->qty               = $item['qty'];
            $orderitem->amount            = $item['item']['price'] * $item['qty'];
            $orderitem->status            = "";
            $orderitem->remark            = "";

            $orderitem->save();
        }


        $order      = Order::find($order->id);
        $orderitems = OrderItem::where('order_id', '=', $order->id)->get();

        if (Session::has('cart')) {
            $request->session()->forget('cart');
        }

        return view('boucher', [
            'order'         => $order,
            'orderitems'    => $orderitems
        ]);
    }

    public function getPayment(Request $request)
    {

        $order_id       = request()->order_id;

        $payment_amount = Order::where("id", "=", "$order_id")->value("totalPrice");

        return view('payment', [
            'order_id'          => $order_id,
            'payment_amount'    => $payment_amount
        ]);
    }

    public function createPayment(Request $request)
    {
        $order_id           = request()->order_id;
        $amount             = request()->payment_amount;
        $phone              = request()->phone;
        $transaction        = request()->transaction;

        $payment = new Payment();

        $payment->order_id      = $order_id;
        $payment->amount        = $amount;
        $payment->phone         = $phone;
        $payment->transaction   = $transaction;

        $payment->save();

        return redirect("/")->with('info', "အားပေးမှုကို ကျေးဇူးတင်ပါသည်");
    }
}
