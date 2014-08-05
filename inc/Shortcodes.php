<?php
remove_filter('the_content', 'wpautop');

/*
|----------------------------------------------------------
| Sample output
|----------------------------------------------------------
*/
add_shortcode('sample', function($atts, $content = null) {
    return '<samp>' . $content . '</samp>';
});


/*
|----------------------------------------------------------
| User input
|----------------------------------------------------------
*/
add_shortcode('kbd', function($atts, $content = null) {
    return '<kbd>' . $content . '</kbd>';
});


/*
|----------------------------------------------------------
| Abbreviations
|----------------------------------------------------------
*/
add_shortcode('abbr', function($atts, $content) {
    extract(shortcode_atts(array(
        'title' => '',
    ), $atts, 'abbr'));
    
    return '<abbr title="' . $title . '" class="initialism">' . $content . '</abbr>';
});

/*
|----------------------------------------------------------
| Alignment
|----------------------------------------------------------
*/
add_shortcode('align', function($atts, $content) {
    extract(shortcode_atts(array(
        'dir' => '',
    ), $atts, 'align'));
    
    return '<div class="text-' . $dir . '">' . do_shortcode($content) . '</div>';
});

/*
|----------------------------------------------------------
| Tooltips
|----------------------------------------------------------
*/
add_shortcode('tooltip', function($atts, $content) {
    extract(shortcode_atts(array(
        'title'     => '',
        'placement' => 'top'
    ), $atts, 'tooltip'));
    
    return '<span data-toggle="tooltip" data-placement="' . $placement . '" title="' . $title . '">' . do_shortcode($content) . '</span>';
});

/*
|----------------------------------------------------------
| Media object
|----------------------------------------------------------
*/
add_shortcode('media', function($atts, $content) {
    extract(shortcode_atts(array(
        'img'       => '',
        'title'     => '',
    ), $atts, 'media'));
    
    return '<div class="media"><a class="pull-left" href="#"><img class="media-object" src="' . $img . '"></a><div class="media-body">' . ($title != '' ? '<h4 class="media-heading">' . $title . '</h4>' : '') . do_shortcode($content) . '</div>
    </div>';
});

/*
|----------------------------------------------------------
| Progress bars
|----------------------------------------------------------
|
| TODO
*/
add_shortcode('progress-bar', function($atts) {
    extract(shortcode_atts(array(
        'max'       => 100,
        'min'       => 0,
        'value'     => 0,
        'label'     => 'true',
        'type'      => ''
    ), $atts, 'progress-bar'));
    
    if($value == 0 || $value < 10) {
        $width = 'min-width: 20px;';
    } else {
        $width = 'width: ' . $value . '%;';
    }
    
    return '<div class="progress">
        <div class="progress-bar ' . ($type != '' ? 'progress-bar-' . $type : '') . '" role="progressbar" aria-valuenow="' . $value . '" aria-valuemin="' . $min . '" aria-valuemax="' . $max . '" style="'. $width . '">
            ' . (($label == 'true') ? $value . '%' : '<span class="sr-only">' . $value . '%</span>') . '
        </div>
    </div>';
});

/*
|----------------------------------------------------------
| Thumbnails with custom content
|----------------------------------------------------------
*/
add_shortcode('thumbnail', function($atts, $content = null) {
    extract(shortcode_atts(array(
        'img'    => '',
        'width'  => 242,
        'height' => 200,
        'alt'    => '',
        'url'    => ''
    ), $atts, 'thumbnail'));
    
    return '<div class="row">
        <div class="col-sm-6 col-md-4">
            <div class="thumbnail">
                <img src="' . $img . '" alt="' . $alt . '">
                <div class="caption">
                    ' . do_shortcode($content) . '
                </div>
            </div>
        </div>
    </div>';
});

/*
|----------------------------------------------------------
| Well
|----------------------------------------------------------
*/
add_shortcode('well', function($atts, $content = null) {
    return '<div class="well">' . do_shortcode($content) . '</div>';
});

/*
|----------------------------------------------------------
| Labels & Badgets
|----------------------------------------------------------
*/
add_shortcode('label', function($atts, $content = null) {
    extract(shortcode_atts(array(
        'type' => 'default'
    ), $atts, 'label'));
    
    return '<span class="label label-' . $type . '">'.$content.'</span>';
});

add_shortcode('badge', function($atts, $content = null) {
    return '<span class="badge">' . $content . '</span>';
});

/*
|----------------------------------------------------------
| Alerts
|----------------------------------------------------------
*/
add_shortcode('alert', function($atts, $content = null) {
    extract(shortcode_atts(array(
        'type' => 'info'
    ), $atts, 'alert'));
    
    return '<div class="alert alert-' . $type . '">' . do_shortcode($content) . '</div>';
});

/*
|----------------------------------------------------------
| Icons
|----------------------------------------------------------
*/
add_shortcode('icon', function($atts) {
    extract(shortcode_atts(array(
        'family'     => 'fa', // fa, octicon, glyphicon
        'name'       => 'question-circle',
        'additional' => ''
    ), $atts, 'icon'));
    
    switch($family) {
        
        case 'fa':
            return '<i class="fa fa-' . $name .' ' . $additional . '"></i>';
        
        case 'octicon':
            return '<span class="octicon octicon-' . $name .' ' . $additional . '"></span>';
        
        case 'glyphicon':
            return '<span class="glyphicon glyphicon-' . $name .' ' . $additional . '"></span>';
            
        default:
            return '<i class="fa fa-question-circle"></i>';
    }
});

/*
|----------------------------------------------------------
| Buttons
|----------------------------------------------------------
| 
| Usage:
|   [button url="http://www.example.com" type="success" size="xs"]
*/
add_shortcode('button', function($atts, $content = null) {
    extract(shortcode_atts(array(
        'url'  => '#',
        'type' => 'default',
        'size' => ''
    ), $atts, 'button'));
    
    return '<a href="' . $url . '" class="btn btn-' . $type . ' ' . (($size != '') ? 'btn-' . $size : '') . '">' . $content . '</a>';
});

/*
|----------------------------------------------------------
| Grid
|----------------------------------------------------------
|
| Usage:
|   [row]
|       [col size=6]Column 1[/col]
|       [col size=6]Column 2[/col]
|   [/row]
*/
add_shortcode('row', function($atts, $content = null) {
    return '<div class="row">' . do_shortcode($content) . '</div>';
});

add_shortcode('col', function($atts, $content = null) {
    extract(shortcode_atts(array(
        'size' => 12
    ), $atts, 'col'));
    
    if($size < 1) {
        $size = 1;
    } elseif($size > 12) {
        $size = 12;
    }
    
    return '<div class="col-md-' . $size . '">' . do_shortcode($content) . '</div>';
});

add_filter('the_content', 'wpautop', 12);