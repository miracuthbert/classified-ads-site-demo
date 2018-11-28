<?php

namespace App\Http\Controllers\Messenger;

use App\Http\Requests\StoreMessengerMessageFormRequest;
use App\Transformers\Messenger\ThreadTransformer;
use App\Transformers\UserTransformer;
use App\User;
use Carbon\Carbon;
use Cmgmyr\Messenger\Models\Message;
use Cmgmyr\Messenger\Models\Participant;
use Cmgmyr\Messenger\Models\Thread;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use League\Fractal\Pagination\IlluminatePaginatorAdapter;

class MessageController extends Controller
{
    /**
     * MessageController constructor.
     */
    public function __construct()
    {
        $this->middleware(['auth']);
    }

    /**
     * Display a listing of the resource.
     *
     * @param Request $request
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        $user = $request->user();
        $threads = Thread::with(['messages', 'participants'])->forUser($user->id)->latest('updated_at')->paginate();

        $threadsCollection = $threads->getCollection();

        return fractal()
            ->collection($threadsCollection)
            ->transformWith(new ThreadTransformer($user))
            ->paginateWith(new IlluminatePaginatorAdapter($threads))
            ->toArray();
    }

    /**
     * Show the form for creating a new resource.
     *
     * @param Request $request
     * @return \Illuminate\Http\Response
     */
    public function create(Request $request)
    {
        $user = $request->user();

        $threads = Thread::with(['participants' => function ($query) use ($user) {
            $query->whereNotIn('user_id', [$user->id]);
        }])->forUser($user->id)->get();

        $participants = [];

        foreach ($threads as $thread) {

            //get users ids
            $usersIds = $thread->participants->pluck('user_id')->toArray();

            //loop and push through the users ids
            foreach ($usersIds as $userId) {
                array_push($participants, $userId);
            }
        };

        //push auth user to participants
        array_push($participants, $user->id);

        //list of users
        $users = User::whereNotIn('id', $participants)->orderBy('first_name', 'ASC')->get();

        return fractal()
            ->collection($users)
            ->transformWith(new UserTransformer)
            ->toArray();
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param StoreMessengerMessageFormRequest|Request $request
     * @return \Illuminate\Http\Response
     */
    public function store(StoreMessengerMessageFormRequest $request)
    {
        $user = $request->user();

        //create new thread
        $thread = new Thread;
        $thread->subject = $request->subject;
        $thread->save();

        //save message
        $message = new Message;
        $message->thread_id = $thread->id;
        $message->user()->associate($user->id);
        $message->body = $request->body;
        $message->save();

        //save sender
        $recipient = new Participant;
        $recipient->thread()->associate($thread->id);
        $recipient->user()->associate($user->id);
        $recipient->last_read = new Carbon;
        $recipient->save();

        //save recipient
        $recipient = new Participant;
        $recipient->thread()->associate($thread->id);
        $recipient->user()->associate($request->recipient);
        $recipient->save();

        return fractal()
            ->item($thread, new ThreadTransformer($user))
            ->toArray();
    }

    /**
     * Display the specified resource.
     *
     * @param Request $request
     * @param Thread $thread
     * @return \Illuminate\Http\Response
     */
    public function show(Request $request, $thread)
    {

        //fetch request user
        $user = $request->user();

        $thread = Thread::findOrFail($thread);

        // don't show the current user in list
//        $users = User::whereNotIn('id', $thread->participantsUserIds($userId))->get();

        //mark thread as read by user
        $thread->markAsRead($user->id);

        return fractal()
            ->item($thread, new ThreadTransformer($user))
            ->parseIncludes(['messages'])
            ->toArray();
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request $request
     * @param  int $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $user = $request->user();

        //find thread
        $thread = Thread::findOrFail($id);

        //activate participants
        $thread->activateAllParticipants();

        //save message
        $message = new Message;
        $message->thread_id = $thread->id;
        $message->user()->associate($user->id);
        $message->body = $request->body;
        $message->save();

        // Add replier as a participant
        $participant = Participant::firstOrCreate(
            [
                'thread_id' => $thread->id,
                'user_id' => $user->id,
            ]
        );

        $participant->last_read = new Carbon;
        $participant->save();

        // Recipients TODO: add option if new participants are added to conversation
//        if ($request->has('recipients')) {
//            $thread->addParticipants($request->input('recipients'));
//        }

        return fractal()
            ->item($thread, new ThreadTransformer($user))
            ->parseIncludes(['messages'])
            ->toArray();

    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
}
