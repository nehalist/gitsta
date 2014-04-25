        <footer style="margin-bottom: 20px;">
            <hr>
            <div class="row">
                <div class="col-md-6">
                    <a href="#top" data-scroll="true">
                        <i class="fa fa-arrow-up"></i> Back to top
                    </a>
                </div>
                <div class="col-md-6 text-right">
                    <small class="text-muted">
                        &copy; <strong><?= get_bloginfo('name'); ?></strong><br>
                        Theme by <a href="http://www.doecode.net" target="_blank">doecode.net</a> <!-- Please do not remove this line - thanks :-) -->
                    </small>
                </div>
            </div>
        </footer>
    </div>

    <?php wp_footer(); ?>

    <script src="<?= bloginfo('template_url'); ?>/js/require.js"></script>
    <script>
    // Load RequireJS
    require({
        baseUrl: "<?= bloginfo('template_url'); ?>/",
    }, ['<?= bloginfo('template_url'); ?>/js/main.js?t=<?= time(); ?>']);
    </script>
</body>
</html>
