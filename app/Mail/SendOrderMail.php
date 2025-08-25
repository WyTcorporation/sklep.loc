<?php

namespace App\Mail;

use App\Models\Orders;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;


class SendOrderMail extends Mailable
{
    use Queueable, SerializesModels;

    /**
     * The order instance.
     *
     * @var Orders
     */
    public Orders $order;
    /**
     * The order instance.
     *
     * @var array
     */
    public array $products;

    /**
     * Create a new message instance.
     *
     * @return void
     */
    public function __construct(Orders $order)
    {
        $products = [];
        $x = 1;
        foreach($order->ordersProducts as $product){
            $products[] = [
                'number'=>$x,
                'id'=>$product->product->id,
                'title'=>$product->product->title,
                'count'=>$product->count,
                'price'=>$product->price,
                'countPrice'=>$product->countPrice
            ];
            $x++;
        }
        $this->products = $products;
        $this->order = $order;
    }

    /**
     * Build the message.
     *
     * @return $this
     */
    public function build()
    {
        return $this
            ->to(env("MAIL_ADMIN_ADDRESS"))
            ->subject('Ваше замовлення на '.env("APP_NAME").'!')
            ->view('mail.send-order');
    }
}
