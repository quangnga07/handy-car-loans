<?php defined('BASEPATH') OR exit('No direct script access allowed');
/**
 *
 * @author 	Mohammad Tareq Alam
 */
if (!function_exists('render_twitter'))
{
	/**
	 * render in front end
	 */

	 function render_twitter($username,$number)
	 {

	 	$feed_url = 'http://api.twitter.com/1/statuses/user_timeline.json?trim_user=1&include_rts=1';

	 	$tweets = json_decode(@file_get_contents($feed_url.'&screen_name='.$username.'&count='.$number));

	 	$patterns = array(
			// Detect URL's
			'((https?|ftp|gopher|telnet|file|notes|ms-help):((//)|(\\\\))+[\w\d:#@%/;$()~_?\+-=\\\.&]*)' => '<a href="$0" target="_blank">$0</a>',
			// Detect Email
			'|([a-z0-9._%+-]+@[a-z0-9.-]+\.[a-z]{2,6})|i' => '<a href="mailto:$1">$1</a>',
			// Detect Twitter @usernames
			'| @([a-z0-9-_]+)|i' => '<a href="https://twitter.com/$1" target="_blank">$0</a>',
			// Detect Twitter #tags
			'|#([a-z0-9-_]+)|i' => '<a href="https://twitter.com/search?q=%23$1" target="_blank">$0</a>'
		);
		
		if ($tweets)
		{
			foreach ($tweets as &$tweet)
			{
				$tweet->text = str_replace($username.': ', '', $tweet->text);
				$tweet->text = preg_replace(array_keys($patterns), $patterns, $tweet->text);
			}
		}

		// Store the feed items
		$data = array(
			'username' => $username,
			'tweets' => $tweets ? $tweets : array(),
		);
		$CI =& get_instance();
		return $CI->load->view('frontend/includes/twitter', $data,TRUE);

	 }
}