<?php
/**
 * Created by PhpStorm.
 * User: Cuthbert Mirambo
 * Date: 10/24/2017
 * Time: 8:40 PM
 */

namespace App\Transformers\Messenger;


use App\Transformers\UserTransformer;
use App\User;
use Cmgmyr\Messenger\Models\Thread;
use League\Fractal\TransformerAbstract;

class ThreadTransformer extends TransformerAbstract
{
    protected $defaultIncludes = ['creator', 'recipient'];

    protected $availableIncludes = ['messages'];

    protected $user;

    /**
     * ThreadTransformer constructor.
     * @param $user
     */
    public function __construct($user)
    {
        $this->user = $user;
    }

    /**
     * @param Thread $thread
     * @return array
     */
    public function transform(Thread $thread)
    {
        return [
            'id' => $thread->id,
            'subject' => $thread->subject,
            'latest_message' => str_limit($thread->getLatestMessageAttribute()->body, 15),
            'unread_count' => $thread->userUnreadMessagesCount($this->user->id),
            'created_at' => $thread->created_at->toDateTimeString(),
            'created_at_human' => $thread->created_at->diffForHumans(),
            'updated_at' => $thread->updated_at->toDateTimeString(),
            'updated_at_human' => $thread->updated_at->diffForHumans(),
        ];
    }

    /**
     * @param Thread $thread
     * @return mixed
     */
    public function includeCreator(Thread $thread)
    {
        $user = $thread->creator();

        return $this->item($user, new UserTransformer);
    }

    /**
     * @param Thread $thread
     * @return mixed
     */
    public function includeRecipient(Thread $thread)
    {
        $user = $thread->creator();

        $recipient = $thread->participants()->with('user')->whereNotIn('user_id', [$user->id])->first();

        return $this->item($recipient->user, new UserTransformer);
    }

    /**
     * @param Thread $thread
     * @return mixed
     */
    public function includeRecipients(Thread $thread)
    {
        $users = User::whereIn('id', $thread->participantsUserIds())->get();

        return $this->collection($users, new UserTransformer);
    }

    /**
     * @param Thread $thread
     * @return mixed
     */
    public function includeMessages(Thread $thread)
    {
        return $this->collection($thread->messages, new MessageTransformer);
    }
}