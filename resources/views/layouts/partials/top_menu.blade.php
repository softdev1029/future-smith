<?php

/**
 * @author Dejan
 * @since  Sep 19, 2018
 */

?>
<li class="nav-item mx-3">
	<a class="nav-link {{ strpos($page_key, 'about-us') !== FALSE?'active':'' }}" href="#">About</a>
</li>
<li class="nav-item mx-3">
	<a class="nav-link {{ strpos($page_key, 'tribe-') !== FALSE?'active':'' }}" href="{{ route('tribe.list') }}">Tribes</a>
</li>
<li class="nav-item mx-3">
	<a class="nav-link {{ strpos($page_key, 'project-') !== FALSE?'active':'' }}" href="{{ route('project.list') }}">Projects</a>
</li>
<!-- <li class="nav-item">
	<a class="nav-link {{ strpos($page_key, 'Discussion-') !== FALSE?'active':'' }}" href="{{ route('discussion.list') }}">Discussions</a>
</li>
<li class="nav-item">
	<a class="nav-link {{ strpos($page_key, 'Message-') !== FALSE?'active':'' }}" href="{{ route('messages') }}">Messages</a>
</li> -->