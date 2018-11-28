<?php

namespace App\Mail;

use App\Models\Listing;
use App\User;
use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;
use Illuminate\Contracts\Queue\ShouldQueue;

class ListingShared extends Mailable
{
    use Queueable, SerializesModels;

    /**
     * The listing being shared.
     *
     * @var Listing
     */
    public $listing;

    /**
     * The user sharing the listing.
     *
     * @var User
     */
    public $sender;

    /**
     * The message being shared.
     *
     * @var $body
     */
    public $body;

    /**
     * Create a new message instance.
     *
     * @param Listing $listing
     * @param User $sender
     * @param null $body
     */
    public function __construct(Listing $listing, User $sender, $body = null)
    {
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
        return $this->markdown('email.listing.shared.message')
            ->subject("{$this->sender->first_name} shared a listing with you.")
            ->from('support@jangobid.com', config('app.name'));
    }
}
