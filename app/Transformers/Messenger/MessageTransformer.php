<?php
/**
 * Created by PhpStorm.
 * User: Cuthbert Mirambo
 * Date: 10/30/2017
 * Time: 11:22 PM
 */

namespace App\Transformers\Messenger;


use App\Transformers\UserTransformer;
use Cmgmyr\Messenger\Models\Message;
use League\Fractal\TransformerAbstract;

class MessageTransformer extends TransformerAbstract
{
    protected $defaultIncludes = ['user'];

    /**
     * @param Message $message
     * @return array
     */
    public function transform(Message $message)
    {
        return $message->toArray() + [
                'created_at_human' => $message->created_at->diffForHumans(),
            ];
    }

    public function includeUser(Message $message)
    {
        return $this->item($message->user, new UserTransformer);
    }

}