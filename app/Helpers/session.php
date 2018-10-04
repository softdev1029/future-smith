<?php

/**
 * @author Dejan
 * @since  Sep 19, 2018
 */

if ( !function_exists('add_message') )
{
	function add_message($msg, $type)
	{
		$msgs = session('msgs');

		$msgs[] = [
			'msg' 			=> $msg,
			'type' 			=> $type
		];

		session(['msgs' => $msgs]);
	}
}

if ( !function_exists('show_messages') )
{
	function show_messages($return = false) {
		$groups = [
			'success' => [],
			'info' => [],
			'warning' => [],
			'danger' => [],
		];

		$msgs = session('msgs');

		if (empty($msgs)) {
			echo "";
			return;
		}

		if ( empty($msgs) ) {
			return '';
		}

		$html = '';
		foreach ($msgs as $msg) {
			$type = $msg['type'];

			$html .= '<div class="messages">';
				$html .= '<div class="alert alert-' . $type . ' alert-dismissible fade show" role="alert">';
					$html .= $msg['msg'];
					$html .= '<button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button>';
				$html .= '</div>';
			$html .= '</div>';
		}

		session()->forget('msgs');

		if ($return)
			return $html;
		else
			echo $html;
	}
}