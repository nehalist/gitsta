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
    
}