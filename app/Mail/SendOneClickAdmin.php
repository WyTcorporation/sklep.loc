<?php

namespace App\Mail;

use App\Modules\Pub\Products\Models\Product;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;

class SendOneClickAdmin extends Mailable
{
    use Queueable, SerializesModels;

    /**
     * The order instance.
     *
     * @var Product
     */
    public Product $product;

    /**
     * The order instance.
     *
     * @var string
     */
    public string $phone;

    /**
     * Create a new message instance.
     *
     * @return void
     */
    public function __construct($phone,$product)
    {
        $this->phone = $phone;
        $this->product = $product;
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
            ->subject('Замовлення в один клік!')
            ->view('mail.one-click');
    }
}
