<?php

/**
 * @author Dejan
 * @since  Sep 23, 2018
 */

namespace App\Http\Controllers\Frontend;

use App\Models\User;
use App\Models\Tribe;
use App\Models\Project;
use App\Models\StripePlan;
use App\Http\Controllers\Controller;
use Carbon\Carbon;
use Cmgmyr\Messenger\Models\Message;
use Cmgmyr\Messenger\Models\Participant;
use Cmgmyr\Messenger\Models\Thread;
use App\Models\Message\MessageThread;
use Illuminate\Http\Request;
use Illuminate\Database\Eloquent\ModelNotFoundException;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Input;
use Illuminate\Support\Facades\Session;
use App\Notifications\MessageReceived;

class MessagesController extends Controller
{
    /**
     * Show all of the message threads to the user.
     *
     * @return mixed
     */
    public function index(Request $request) {
        
        $type = $request->type;
        $ref_id = $request->ref_id;

        // All threads, ignore deleted/archived participants
        if (!empty($type)) {
            $threads = MessageThread::getAllLatestByType($type, $ref_id)->get();
        } else {
            $threads = MessageThread::getAllLatest()->get();
        }

        // All threads that user is participating in
        // $threads = Thread::forUser(Auth::id())->latest('updated_at')->get();

        // All threads that user is participating in, with new messages
        // $threads = Thread::forUserWithNewMessages(Auth::id())->latest('updated_at')->get();

        if ($type == MessageThread::TYPE_TRIBE) {
            $tribe = Tribe::find($ref_id);
            return view('frontend.tribe.detail', [
                'tribe' => $tribe,
                'threads' => $threads,
                'page' => 'messages',
                'type' => MessageThread::TYPE_TRIBE,
                'ref_id' => $tribe->id
                ]);
        } else if ($type == MessageThread::TYPE_PROJECT) {
            $project = Project::find($ref_id);
            return view('frontend.project.detail', [
                'project' => $project,
                'threads' => $threads,
                'page' => 'messages',
                'type' => MessageThread::TYPE_PROJECT,
                'ref_id' => $project->id
                ]);
        }

        return view('frontend.messenger.index', compact('threads'));
    }

    /**
     * Shows a message thread.
     *
     * @param $id
     * @return mixed
     */
    public function show($id)
    {
        try {
            $thread = Thread::findOrFail($id);
        } catch (ModelNotFoundException $e) {
            Session::flash('error_message', 'The thread with ID: ' . $id . ' was not found.');

            return redirect()->route('messages');
        }

        // show current user in list if not a current participant
        // $users = User::whereNotIn('id', $thread->participantsUserIds())->get();

        // don't show the current user in list
        $userId = Auth::id();
        $users = User::whereNotIn('id', $thread->participantsUserIds($userId))->get();

        $thread->markAsRead($userId);

        return view('frontend.messenger.show', compact('thread', 'users'));
    }

    /**
     * Creates a new message thread.
     *
     * @return mixed
     */
    public function create(Request $request)
    {
        $type = $request->type;
        $ref_id = $request->ref_id;

        $users = User::where('id', '!=', Auth::id())->get();

        return view('frontend.messenger.create', compact('users', 'type', 'ref_id'));
    }

    /**
     * Stores a new message thread.
     *
     * @return mixed
     */
    public function store(Request $request)
    {
        $type = $request->type;
        if (empty($type)) {
            $type = MessageThread::TYPE_GLOBAL;
        }
        $ref_id = $request->ref_id;

        $input = Input::all();

        $thread = new Thread();
        $thread->subject = $input['subject'];
        $thread->type = $type;
        $thread->ref_id = $ref_id;

        $thread->save();
        
        // Message
        Message::create([
            'thread_id' => $thread->id,
            'user_id' => Auth::id(),
            'body' => $input['message'],
        ]);

        // Sender
        Participant::create([
            'thread_id' => $thread->id,
            'user_id' => Auth::id(),
            'last_read' => new Carbon,
        ]);

        // Recipients
        if (Input::has('recipients')) {
            $thread->addParticipant($input['recipients']);
        }

        return redirect()->route('messages', compact('type', 'ref_id'));
    }

    /**
     * Adds a new message to a current thread.
     *
     * @param $id
     * @return mixed
     */
    public function update($id)
    {
        try {
            $thread = Thread::findOrFail($id);
        } catch (ModelNotFoundException $e) {
            Session::flash('error_message', 'The thread with ID: ' . $id . ' was not found.');

            return redirect()->route('messages');
        }

        $thread->activateAllParticipants();

        // Message
        $message = Input::get('message');
        Message::create([
            'thread_id' => $thread->id,
            'user_id' => Auth::id(),
            'body' => $message,
        ]);

        // Add replier as a participant
        $participant = Participant::firstOrCreate([
            'thread_id' => $thread->id,
            'user_id' => Auth::id(),
        ]);
        $participant->last_read = new Carbon;
        $participant->save();

        // Recipients
        if (Input::has('recipients')) {
            $thread->addParticipant(Input::get('recipients'));
        }

        // Send a notification to participants
        $sender = Auth::user();
        foreach ($thread->participants as $participant) {
            $receiver = $participant->user;
            if ($sender->id != $receiver->id) {
                $receiver->notify(new MessageReceived($sender, $participant->user));
            }
            if (!$receiver->subscribed(StripePlan::find(StripePlan::PLAN_TRIBE_MEMBER)->stripe_id)) {
                $receiver->sendMessageReceiveNotification($receiver->profile->name, $message);
            }
        }

        return redirect()->route('messages.show', $id);
    }
}
