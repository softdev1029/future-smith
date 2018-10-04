<ul class="list-unstyled user-list">
  @foreach ($members as $member)
  <li class="media mb-4 user-list-item">
      <img class="align-self-start mr-3 rounded user-avatar" src="{{ file_url($member->image()) }}">
      <div class="media-body">
          <h5 class="mt-0 user-name">{{ $member->name }}</h5>
          @if ($parent->isOwner($member))
          <p class="user-role">Leader</p>
          @else
          <p class="user-role">Member</p>
          @endif
      </div>
  </li>
  @endforeach
</ul>
