<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Razorpay\Api\Api;
use Mail;
use App\Mail\PaymentSuccessMail;

class RazorpayController extends Controller
{
    public function payment(){
        return view('razorpay.payment');
    }

   public function createOrder(Request $request)
    {
        $api = new Api(config('razorpay.key'), config('razorpay.secret'));

        $order = $api->order->create([
            'receipt' => uniqid(),
            'amount' => $request->amount * 100, // paise
            'currency' => 'INR'
        ]);

        return response()->json([
            'order_id' => $order['id'],
            'name' => $request->name,
            'email' => $request->email,
            'phone' => $request->phone,
            'amount' => $request->amount,
            'image' => $request->image
        ]);
    }

    public function paymentSuccess(Request $request)
    {
        // yaha Razorpay signature verify bhi kar sakte ho (interview me bolna important)

        $data = [
            'name' => $request->name,
            'email' => $request->email,
            'phone' => $request->phone,
            'amount' => $request->amount,
            'payment_id' => $request->razorpay_payment_id,
        ];

        // 📧 Email send
        Mail::to($request->email)->send(new PaymentSuccessMail($data));

        return response()->json(['status' => 'success']);
    }

}
