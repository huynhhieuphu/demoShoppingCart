<h1>Thông tin đơn hàng</h1>
<hr>
<h3>Mã đơn hàng: {{$order->id}}</h3>
<h4>Ngày mua hàng: {{$order->created_at}}</h4>

<table style="border: 1px solid black; width: 500px;">
    <thead>
    <tr>
        <th>Product</th>
        <th>Quantity</th>
        <th class="text-end">Price</th>
    </tr>
    </thead>
    <tbody>
    @foreach($cart->items as $item)
        <?php
        $total = $item['quantity'] * $item['price'];
        ?>
        <tr>
            <td>{{$item['name']}}</td>
            <td class="text-end">{{$item['quantity']}}</td>
            <td class="text-end">{{number_format($total)}} VND</td>
        </tr>
    @endforeach
    </tbody>
    <tfoot>
    <tr>
        <td class="text-end"><strong>Total</strong></td>
        <td class="text-end"><strong>{{$cart->totalQuantity}}</strong></td>
        <td class="text-end"><strong>{{number_format($cart->totalPrice)}} VND</strong></td>
    </tr>
    </tfoot>
</table>
