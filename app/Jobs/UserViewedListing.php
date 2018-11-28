<?php

namespace App\Jobs;

use App\Models\Listing;
use App\User;
use Illuminate\Bus\Queueable;
use Illuminate\Queue\SerializesModels;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;

class UserViewedListing implements ShouldQueue
{
    use Dispatchable, InteractsWithQueue, Queueable, SerializesModels;

    public $user;

    public $listing;

    /**
     * Create a new job instance.
     *
     * @param User $user
     * @param Listing $listing
     */
    public function __construct(User $user, Listing $listing)
    {
        $this->user = $user;
        $this->listing = $listing;
    }

    /**
     * Execute the job.
     *
     * @return void
     */
    public function handle()
    {
        $viewed = $this->user->viewedListings;

        if($viewed->contains($this->listing)){  //if user viewed listing: then increment view count
            $viewed->where('id', $this->listing->id)->first()->pivot->increment('count');
            return;
        }

        //if not viewed: insert initial view record
        $this->user->viewedListings()->attach($this->listing, [
            'count' => 1,
        ]);
    }
}
