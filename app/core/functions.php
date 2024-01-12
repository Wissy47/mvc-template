<?php 
// Write all site-wide function here, All function written here can be access site-wide


/**
 * If there is an error message, display it and then unset it.
 */
function error_message()
{
	if(isset($_SESSION['error']) && $_SESSION['error'] != "")
	{
		echo $_SESSION['error'];
		unset($_SESSION['error']);
	}
}

/**
 * The function "time_elapsed_string" calculates the time elapsed between a given datetime and the
 * current time and returns a string representation of the elapsed time.
 * 
 * @param datetime The datetime parameter is the date and time that you want to calculate the elapsed
 * time from. It should be in a format that can be parsed by the DateTime constructor, such as "Y-m-d
 * H:i:s" (e.g. "2021-01-01 12:00:00
 * @param full A boolean parameter that determines whether the function should return the full time
 * elapsed string or just the most significant unit. If set to true, the function will return the full
 * time elapsed string including all units (e.g. "2 years, 3 months, 1 week, 4 days ago").
 * 
 * @return a string representing the time elapsed between the given datetime and the current time. If
 * the  parameter is set to false, it returns the most significant time unit (e.g., "1 year ago",
 * "2 months ago"). If  is set to true, it returns the full time elapsed string (e.g., "1 year, 2
 * months, 3 weeks,
 */
function time_elapsed_string($datetime, $full = false) 
{
    $now = new DateTime;
    $ago = new DateTime($datetime);
    $diff = $now->diff($ago);

    $diff->w = floor($diff->d / 7);
    $diff->d -= $diff->w * 7;

    $string = array(
        'y' => 'year',
        'm' => 'month',
        'w' => 'week',
        'd' => 'day',
        'h' => 'hour',
        'i' => 'minute',
        's' => 'second',
    );
    foreach ($string as $k => &$v) {
        if ($diff->$k) {
            $v = $diff->$k . ' ' . $v . ($diff->$k > 1 ? 's' : '');
        } else {
            unset($string[$k]);
        }
    }

    if (!$full) $string = array_slice($string, 0, 1);
    return $string ? implode(', ', $string) . ' ago' : 'just now';
}