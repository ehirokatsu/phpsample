<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Mail\Mailable;
use Illuminate\Mail\Mailables\Content;
use Illuminate\Mail\Mailables\Envelope;
use Illuminate\Queue\SerializesModels;

class ContactsSendmail extends Mailable
{
    use Queueable, SerializesModels;

    //フォーム入力された値の格納用
    private $email;
    private $title;
    private $body;
    
    /**
     * Create a new message instance.
     *
     * @return void
     */
    public function __construct( $inputs )
    {
        //フォーム入力された値を格納
        $this->email = $inputs['email'];
        $this->title = $inputs['title'];
        $this->body = $inputs['body'];
    }

    /**
     * Get the message envelope.
     *
     * @return \Illuminate\Mail\Mailables\Envelope
     */
    public function envelope()
    {
        return new Envelope(
            subject: $this->title,
            from: 'laravel@laravel.com',
        );
    }

    /**
     * Get the message content definition.
     *
     * @return \Illuminate\Mail\Mailables\Content
     */
    public function content()
    {
        return new Content(

            //メール本文作成用のビューを呼び出す。値をwithで渡す。
            view: 'contact.mail',
            with: [
                'email' => $this->email,
                'title' => $this->title,
                'body' => $this->body,
            ],
        );
    }

    /**
     * Get the attachments for the message.
     *
     * @return array
     */
    public function attachments()
    {
        return [];
    }
}
