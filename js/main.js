requirejs.config({
    paths: {
        'jquery':                 'vendor/jquery',
        'marked':                 'vendor/marked',
        'bootstrap':              'vendor/bootstrap/js/bootstrap.min'
    },
    
    shim: {
        'bootstrap': {
            deps: ['jquery']
        }
    }
});

require(['jquery', 'marked', 'bootstrap'],
    function($, marked) {
        'use strict';
        
        $(function() {
            // Smooth scrolling
            // by http://css-tricks.com/snippets/jquery/smooth-scrolling/
            // Blame the dynamic sidebar its just for the "Back to top"-Link :'(...
            $('a[data-scroll="true"]').click(function() {
                if(!$(this).hasClass('comment-reply-link')) {
                    if(location.pathname.replace(/^\//, '') == this.pathname.replace(/^\//, '') && location.hostname == this.hostname) {
                        var target = $(this.hash);
                        target = target.length ? target : $('[name=' + this.hash.slice(1) + ']');
                        if(target.length) {
                            $('html,body').animate({
                                scrollTop: target.offset().top - 70
                            }, 1000);
                            return false;
                        }
                    }
                }
            });
            
            // Enable bootstrap tabs
            $('a[data-toggle="tab"]').click(function(e) {
                e.preventDefault();
                $(this).tab('show');
            });
            
            // Markdown
            $('.preview-reply').click(function() {
                var comment = $('#comment').val();
                var preview;
                if(comment != "") {
                    preview = marked(comment);
                } else {
                    preview = "<div class='text-center text-muted'>Nothing to preview :(</div>";
                }
                $('#markdown-preview').html(preview);
            });
            
            // Affix scroll
            function fixDiv() {
                var $cache = $('.affix');
                
                if ($(window).scrollTop() > 70)
                    $cache.css({'position': 'fixed', 'top': '70px'});
                else
                    $cache.css({'position': 'relative', 'top': 'auto'});
            }
            $(window).scroll(fixDiv);
            fixDiv();
            
            // Enable tooltips
            $('*[data-toggle="tooltip"]').tooltip({
                placement: 'bottom'
            });
        });
    }
);