<?php
class Gitsta_ThemeComments {
    
    public static function format($comment, $args, $depth)
    {
        $GLOBALS['comment'] = $comment;
        
        if($comment->comment_type == 'pingback' || $comment->comment_type == 'trackback') {
            // Comment is a pingback or trackback
            include 'Partials/Comment_Pingback.php';
        } else {
            // Just a normal comment
            include 'Partials/Comment_Single.php';
        }
    }
    
    // http://stackoverflow.com/questions/1416697/converting-timestamp-to-time-ago-in-php-e-g-1-day-ago-2-days-ago
    public static function timeElapsedString($datetime, $full = false)
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
    
}