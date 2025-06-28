<?php

namespace App\Mail;

use App\Models\DonHang;
use App\Models\User;
use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;

class OrderSuccessMail extends Mailable
{
    use Queueable, SerializesModels;

    public DonHang $order;
    public User $receiver;
    public string $link;
    public string $buttonText;

    /**
     * Tạo mail xác nhận đơn hàng
     */
    public function __construct(DonHang $order, User $receiver, string $link, string $buttonText)
    {
        $this->order = $order;
        $this->receiver = $receiver;
        $this->link = $link;
        $this->buttonText = $buttonText;
    }

    /**
     * Xây dựng nội dung mail
     */
    public function build(): self
    {
        return $this->subject('Thông báo đơn hàng từ TOPPC')
                    ->markdown('emails.order_success');
    }
}
