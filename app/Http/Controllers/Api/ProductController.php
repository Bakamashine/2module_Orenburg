<?php

namespace App\Http\Controllers\Api;

use App\Enum\OrderStatus;
use App\Http\Controllers\Controller;
use App\Http\Requests\PaymentWebhookRequest;
use App\Http\Resources\ProductResource;
use App\Models\Order;
use App\Models\Product;
use Illuminate\Http\Request;

class ProductController extends Controller
{
    public function getById(Product $product)
    {
        return ProductResource::make($product);
    }

    public function buy(Request $request, Product $product)
    {
        $request->user()->order()->create([
            'status' => OrderStatus::Waiting,
            'product_id' => $product->id
        ]);
        return response()->json([
            'pay_url' => "http://localhost:8081/payments"
        ]);
    }

    public function paymentWebhook(PaymentWebhookRequest $request)
    {
        $order = Order::findOrFail($request->order_id);
        if ($request->status == "success") {
            $order->status = OrderStatus::Success;

        } else {
            $order->status = OrderStatus::Error;
        }

        $order->save();
        return response(status: 204);

    }


}
