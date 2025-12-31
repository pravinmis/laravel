<?php
namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Services\CashfreeService;
use App\Models\Order; // optionally store in DB

class CashfreeController extends Controller
{
    protected $cf;
    
    public function __construct(CashfreeService $cf)
    {
    
        $this->cf = $cf;
    }

    public function createOrder(Request $r)
    {
    
        // Validate
        $r->validate([
            'amount' => 'required|numeric|min:1',
            'customer_email' => 'nullable|email',
            'customer_phone' => 'nullable',
        ]);

        // prepare unique order_id from your system
        $orderId = 'order_'.time().rand(1000,9999);
       //  dd($orderId);
        $payload = [
            "order_id" => $orderId,
            "order_amount" => round($r->amount, 2),
            "order_currency" => "INR",
            "customer_details" => [
                "customer_id" => $r->customer_id ?? $orderId,
                "customer_email" => $r->customer_email,
                "customer_phone" => $r->customer_phone,
                "customer_name" => $r->customer_name ?? "",
            ],
            "order_meta" => [
                "return_url" => route('checkout.return', ['order_id' => $orderId]), // must be whitelisted
            ],
            "order_note" => "Order for ".$orderId,
        ];
         
        
        $response = $this->cf->createOrder($payload);
       // dd($response);
        // handle response, save in DB if needed
        // $response contains 'payment_session_id' and 'order_id' (cashfree) etc.
        if(isset($response['payment_session_id'])) {
            // send payment_session_id to frontend
            return response()->json([
                'success' => true,
                'payment_session_id' => $response['payment_session_id'],
                'order_id' => $orderId,
                'cf_order' => $response,
            ]);
        }

        return response()->json(['success'=>false,'error'=>$response], 500);
    }

    // return_url handler (customer lands here after payment)
    public function return(Request $r)
    {
        // You will get some params or can check query for order_id
        $orderId = $r->query('order_id') ?? null;
       // dd($orderId);
        if(!$orderId) {
            // try to get from request or show a message
        }

        // verify order status server-side
        $cfResp = $this->cf->getOrder($orderId);
        // check $cfResp['order_status'] == 'PAID'
        // then show success/failure page
        dd($cfResp);
        return view('checkout.result', compact('cfResp'));
    }
}