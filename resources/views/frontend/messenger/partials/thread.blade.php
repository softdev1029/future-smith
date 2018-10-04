<?php $class = $thread->isUnread(Auth::id()) ? 'alert-info' : ''; ?>

<div class="media alert {{ $class }}">
    <h4 class="media-heading">
        <a href="{{ route('messages.show', $thread->id) }}">{{ $thread->subject }}</a>
        ({{ $thread->userUnreadMessagesCount(Auth::id()) }} unread)</h4>

    <li class="media mb-4">
        <div class="media-body">
            <p>
                <!-- $thread->latestMessage->body -->
            </p>
            <p>
                <small><strong>Creator:</strong> {{ $thread->creator()->name }}</small>
            </p>
            <p>
                <small><strong>Participants:</strong> {{ $thread->participantsString(Auth::id()) }}</small>
            </p>
        </div>
    </li>
</div>