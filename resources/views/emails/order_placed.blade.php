<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Order Confirmation - phoneKART</title>
    <style>
        body { font-family: 'Helvetica Neue', Helvetica, Arial, sans-serif; color: #334155; line-height: 1.6; margin: 0; padding: 0; background-color: #f8fafc; }
        .wrapper { padding: 40px 20px; background-color: #f8fafc; }
        .container { max-width: 600px; margin: 0 auto; background: #ffffff; border-radius: 12px; overflow: hidden; box-shadow: 0 4px 6px -1px rgba(0, 0, 0, 0.1), 0 2px 4px -1px rgba(0, 0, 0, 0.06); }
        .header { background: linear-gradient(to right, #2563eb, #06b6d4); color: white; padding: 30px 20px; text-align: center; }
        .logo-container { margin-bottom: 15px; }
        .logo { width: 30px; height: 30px; }
        .header h2 { margin: 0; font-size: 28px; font-weight: bold; letter-spacing: -0.5px; }
        .header p { margin: 5px 0 0 0; opacity: 0.9; font-size: 16px; }
        .content { padding: 40px 30px; }
        .greeting { font-size: 18px; font-weight: bold; color: #1e293b; margin-top: 0; }
        .intro { font-size: 16px; color: #475569; margin-bottom: 30px; }
        .order-meta { background: #f1f5f9; padding: 20px; border-radius: 8px; margin-bottom: 30px; }
        .order-meta h3 { margin-top: 0; margin-bottom: 15px; font-size: 16px; color: #0f172a; text-transform: uppercase; letter-spacing: 0.5px; }
        .order-meta p { margin: 5px 0; font-size: 14px; color: #475569; }
        .order-meta strong { color: #334155; }
        .table-container { margin-bottom: 30px; }
        .table { width: 100%; border-collapse: collapse; }
        .table th, .table td { padding: 12px 10px; border-bottom: 1px solid #e2e8f0; text-align: left; font-size: 14px; }
        .table th { background: #f8fafc; font-weight: 600; color: #64748b; text-transform: uppercase; font-size: 12px; letter-spacing: 0.5px; }
        .table td { color: #334155; }
        .product-name { font-weight: 600; color: #0f172a; }
        .text-right { text-align: right !important; }
        .total-row td { font-weight: bold; font-size: 16px; color: #0f172a; border-top: 2px solid #cbd5e1; border-bottom: none; padding-top: 15px; }
        .footer { background: #f8fafc; padding: 30px 20px; text-align: center; border-top: 1px solid #e2e8f0; }
        .footer p { margin: 5px 0; font-size: 14px; color: #64748b; }
        .footer .brand { font-weight: bold; color: #2563eb; }
    </style>
</head>
<body>
    <div class="wrapper">
        <div class="container">
            <div class="header">
                <div class="logo-container">
                    <img src="{{ $message->embed(public_path('favicon.png')) }}" alt="phoneKART Logo" class="logo">
                </div>
                <h2>phoneKART</h2>
                <p>Order Confirmation</p>
            </div>
            
            <div class="content">
                <p class="greeting">Hi {{ $order->user->fname }},</p>
                <p class="intro">Thank you for your purchase! Your order has been received and is now being processed. Here are your order details:</p>
                
                <div class="order-meta">
                    <h3>Order #{{ str_pad($order->id, 6, '0', STR_PAD_LEFT) }}</h3>
                    <p><strong>Date:</strong> {{ $order->created_at->format('F j, Y') }}</p>
                    <p><strong>Payment Mode:</strong> {{ $order->payment_mode }}</p>
                    <p><strong>Shipping Address:</strong><br>
                    {{ $order->address }}<br>
                    Pincode: {{ $order->pincode }}</p>
                </div>
                
                <div class="table-container">
                    <table class="table">
                        <thead>
                            <tr>
                                <th>Product</th>
                                <th class="text-right">Qty</th>
                                <th class="text-right">Price</th>
                                <th class="text-right">Total</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach($order->items as $item)
                            <tr>
                                <td class="product-name">{{ $item->product->name }}</td>
                                <td class="text-right">{{ $item->qty }}</td>
                                <td class="text-right">₹{{ number_format($item->price, 2) }}</td>
                                <td class="text-right">₹{{ number_format($item->price * $item->qty, 2) }}</td>
                            </tr>
                            @endforeach
                            <tr class="total-row">
                                <td colspan="3" class="text-right">Grand Total</td>
                                <td class="text-right" style="color: #2563eb;">₹{{ number_format($order->total_amount, 2) }}</td>
                            </tr>
                        </tbody>
                    </table>
                </div>
            </div>
            
            <div class="footer">
                <p>Thank you for shopping with <span class="brand">phoneKART</span>!</p>
                <p>If you have any questions about your order, please reply to this email.</p>
            </div>
        </div>
    </div>
</body>
</html>
