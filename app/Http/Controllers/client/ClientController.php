<?php

namespace App\Http\Controllers\client;

use App\Http\Controllers\BaseController;
use App\Http\Controllers\Controller;
use App\Http\Resources\CardResource;
use App\Http\Resources\PaymentResource;
use App\Models\Card;
use App\Models\OrderItem;
use App\Models\Payment;
use Illuminate\Http\Request;


class ClientController extends BaseController
{
    public function cardLists(Request $request)
    {
        if (empty($request->query())) {
            $card = CardResource::collection(Card::where('status',true)->get()); 
        }else{       
            $query = Card::query();
            if ($request->set) {
                $query = $this->filterBySet($query,$request);
            }
            if ($request->type) {
                $query = $this->filterByType($query,$request);
            }
            if ($request->name) {
                $query = $this->filterByName($query,$request);
            }
            $card  = CardResource::collection($query->where('status',true)->get());
        }
        return $card;
    }
    public function filterByName($query,$request)
    {
        $query =  $query->where('name','Like','%'.$request->name.'%');
        return $query;
    }
    public function filterBySet($query,$request)
    {
        $query =  $query->where('set_id',$request->set);
        return $query;
    }    
    public function filterByType($query,$request)
    {
        $query =  $query->where('type_id',$request->type);
        return $query;
    }

    public function orders($user_id)
    {
        $order = new PaymentResource(Payment::where('user_id', $user_id)->first());
        return $this->success('Orders!', $order);
    }
    
    public function allOrders()
    {
        $orders = PaymentResource::collection(Payment::with('order_item')->get());
        return $this->success('all orders',$orders);    
    }

    public function orderCard(Request $request)
    {
        $existOrder = Payment::where('user_id' , $request->user_id)->first();
        if ($existOrder) {
            $order_item = new OrderItem();
            $order_item->payment_id = $existOrder->id;
            $order_item->card_id = $request->card_id;
            $order_item->quantity = $request->quantity;
            $card = Card::find($request->card_id);
            if ($card) {
                $order_item->total_price = $request->quantity * $card->price;
                    $card->quantity -= $request->quantity;
                    if ($card->quantity == 0) {
                    $card->status = false;
            }
                    $card->save();
            } else {
                return $this->error('Card not found', [], 404);
            }            
            $order_item->save();
            return $this->success('order added',[$existOrder , $order_item],[]);
        } else {
            $order = new Payment();
            $order->user_id = $request->user_id;
            $order->address = $request->address;
            $order->save();
            $order_item = new OrderItem();
            $order_item->payment_id = $order->id;
            $order_item->card_id = $request->card_id;
            $order_item->quantity = $request->quantity;
            $card = Card::find($request->card_id);
            if ($card) {
                $order_item->total_price = $request->quantity * $card->price;
                $card->quantity -= $request->quantity;
                if ($card->quantity == 0) {
                $card->status = false;
            }
                $card->save();

            } else {
                return $this->error('Card not found', [], 404);
            }
            $order_item->save();
            return $this->success('order created',[$order , $order_item],[]);
        }
    }
    public function canclePayment($order){
        $orderitem = OrderItem::where('id',$order)->first();
        $id = $orderitem->payment_id;
        $orderitem -> delete();
        $ordercount = OrderItem::where('payment_id',$id)->count();
        if($ordercount == 0 ){
            Payment::where('id',$id)->delete();
        }
        return response()->json([
            'data' => $ordercount,
            'condation' => true,
            'message' => "Deleted!"

        ],200);
    }
    
}
