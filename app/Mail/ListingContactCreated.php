<?php

namespace App\Mail;

use App\Models\Listing;
use App\User;
use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;
use Illuminate\Contracts\Queue\ShouldQueue;

class ListingContactCreated extends Mailable
{
    use Queueable, SerializesModels;

    /**
     * Holds the listing model.
     *
     * @var $listing
     */
    public $listing;

    /**
     * Holds the user sending the message.
     *
     * @var $sender
     */
    public $sender;

    /**
     * Holds the sender message.
     *
     * @var $body
     */
    public $body;

    /**
     * Create a new message instance.
     *
     * @param $listing
     * @param $sender
     * @param $body
     */
    public function __construct(Listing $listing, User $sender, $body)
    {
        //init
        $this->listing = $listing;
        $this->sender = $sender;
        $this->body = $body;
    }

    /**
     * Build the message.
     *
     * @return $this
     */
    public function build()
    {
        return $this->markdown('email.listing.contact.message')
            ->subject("{$this->sender->first_name} sent a message about {$this->listing->title}")
            ->from('support@homebid.co', config('app.name'))
            ->replyTo($this->sender->email);
    }
}
