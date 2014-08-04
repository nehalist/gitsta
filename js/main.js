/*
|----------------------------------------------------------
| Gitsta JavaScript
|----------------------------------------------------------
*/

require({
    baseUrl: theme.template_directory_uri
});

requirejs.config({
    paths: {
        'marked':                 'vendor/marked',
        'bootstrap':              'vendor/bootstrap/js/bootstrap'
    }
});

require(['marked', 'bootstrap'],
    function(marked) {
        'use strict';
        
        jQuery(function() {
            $ = jQuery;
            
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
            
            // Source code toggling
            $('a.toggle-code').click(function(e) {
                e.preventDefault();
                
                $(this).find('i').toggleClass('fa-toggle-up fa-toggle-down');
                
                // Toggle pre tags
                $(this).parentsUntil('.code-box').next('pre').slideToggle();
                
                // Toggle syntaxhighlighter div
                $(this).parentsUntil('.code-box').next('.syntaxhighlighter').slideToggle();
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
            
            // Bootstrap fixed header fix
            var navbar = $('.navbar-fixed-top');
            var top    = 70; // for affix scrolling
            if(navbar.height() > 51) {
                $('body').css('padding-top', navbar.height() + 21);
                top = navbar.height() + 10;
            }
            
            // Affix scroll
            function fixDiv() {
                var $cache = $('.affix');

                if ($(window).scrollTop() > navbar.height() - 10) {
                    $cache.css({'position': 'fixed', 'top': top + 'px'});
                } else {
                    $cache.css({'position': 'relative', 'top': 'auto'});
                }
            }
                
            if($('.affix').height() < $(window).height()) {
                $(window).scroll(fixDiv);
                fixDiv();
            } else {
                // Disable fixed position on affix if sidebar height is greater
                // than window height
                $('.affix').css('position', 'static');
            }
            
            // Enable tooltips
            $('*[data-toggle="tooltip"]').tooltip({
                placement: 'bottom'
            });
            
            // Search input growth
            var searchInput = $('#s');
            var searchInputWidth = searchInput.width();
            searchInput.focus(function() {
                // Grow on focus
                $(this).animate({ width: (searchInputWidth + 150) }, 'slow');
            }).blur(function() {
                // Shrink on blur
                $(this).animate({ width: searchInputWidth + 26 }, 'slow');
            });
        });
    }
);