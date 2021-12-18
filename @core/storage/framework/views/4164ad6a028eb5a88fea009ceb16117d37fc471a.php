<?php
    $home_page_variant = $home_page ?? get_static_option('home_page_variant');
?>
<?php if(!in_array(Route::currentRouteName(),['frontend.course.lesson','frontend.course.lesson.start'])): ?>
<footer class="footer-area home-variant-<?php echo e($home_page_variant); ?>

<?php if((request()->routeIs('homepage')  || request()->routeIs('frontend.homepage.demo') ) && $home_page_variant == '17' &&
filter_static_option_value('home_page_call_to_action_section_status',$static_field_data)): ?>
   has-top-padding
<?php endif; ?>
">
    <?php if(App\WidgetsBuilder\WidgetBuilderSetup::render_frontend_sidebar('footer',['column' => true])): ?>
        <div class="footer-top padding-top-90 padding-bottom-65">
            <div class="container">
                <div class="row">
                    <?php echo App\WidgetsBuilder\WidgetBuilderSetup::render_frontend_sidebar('footer',['column' => true]); ?>

                </div>
            </div>
        </div>
    <?php endif; ?>
    <div class="copyright-area">
        <div class="container">
            <div class="row">
                <div class="col-lg-12">
                    <div class="copyright-item">
                        <div class="copyright-area-inner">
                            <?php echo get_footer_copyright_text(); ?>

                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</footer>
<?php if(preg_match('/(xgenious)/',url('/'))): ?>
<script type="text/javascript"> adroll_adv_id = "GXM5SRU2XZE7JOKGHSZPSZ"; adroll_pix_id = "WP43YTLBS5BQXDP6XUEIC7"; adroll_version = "2.0";  (function(w, d, e, o, a) { w.__adroll_loaded = true; w.adroll = w.adroll || []; w.adroll.f = [ 'setProperties', 'identify', 'track' ]; var roundtripUrl = "https://s.adroll.com/j/" + adroll_adv_id + "/roundtrip.js"; for (a = 0; a < w.adroll.f.length; a++) { w.adroll[w.adroll.f[a]] = w.adroll[w.adroll.f[a]] || (function(n) { return function() { w.adroll.push([ n, arguments ]) } })(w.adroll.f[a]) }  e = d.createElement('script'); o = d.getElementsByTagName('script')[0]; e.async = 1; e.src = roundtripUrl; o.parentNode.insertBefore(e, o); })(window, document); adroll.track("pageView"); </script>
    <div class="buy-now-wrap">
        <ul class="buy-list">
            <li><a target="_blank"href="https://xgenious.com/laravel/nexelit/doc/" data-container="body" data-toggle="popover" data-placement="left" data-content="<?php echo e(__('Documentation')); ?>"><i class="far fa-file-alt"></i></a></li>
            <li><a target="_blank"href="https://1.envato.market/OXNPP"><i class="fas fa-shopping-cart"></i></a></li>
            <li><a target="_blank"href="https://xgenious51.freshdesk.com/"><i class="fas fa-headset"></i></a></li>
        </ul>
    </div>
<?php endif; ?>
<div class="back-to-top">
    <span class="back-top">
        <i class="fas fa-angle-up"></i>
    </span>
</div>

<?php echo $__env->make('frontend.partials.popup-structure', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
<?php endif; ?>
<!-- load all script -->
<script src="<?php echo e(asset('assets/frontend/js/bootstrap.bundle.min.js')); ?>"></script>
<script src="<?php echo e(asset('assets/frontend/js/dynamic-script.js')); ?>"></script>
<script src="<?php echo e(asset('assets/frontend/js/jquery.magnific-popup.js')); ?>"></script>
<script src="<?php echo e(asset('assets/frontend/js/imagesloaded.pkgd.min.js')); ?>"></script>
<script src="<?php echo e(asset('assets/frontend/js/isotope.pkgd.min.js')); ?>"></script>
<script src="<?php echo e(asset('assets/frontend/js/jquery.waypoints.js')); ?>"></script>
<script src="<?php echo e(asset('assets/frontend/js/jquery.counterup.min.js')); ?>"></script>
<script src="<?php echo e(asset('assets/frontend/js/owl.carousel.min.js')); ?>"></script>
<script src="<?php echo e(asset('assets/frontend/js/wow.min.js')); ?>"></script>
<script src="<?php echo e(asset('assets/frontend/js/jQuery.rProgressbar.min.js')); ?>"></script>
<script src="<?php echo e(asset('assets/frontend/js/jquery.mb.YTPlayer.js')); ?>"></script>
<script src="<?php echo e(asset('assets/frontend/js/main.js')); ?>"></script>

<?php if(request()->routeIs('homepage') || request()->routeIs('frontend.homepage.demo')): ?>
    <?php echo $__env->make('frontend.partials.google-captcha', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
    <?php echo $__env->make('frontend.partials.gdpr-cookie', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
    <?php echo $__env->make('frontend.partials.popup-jspart', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
    <?php echo $__env->make('frontend.partials.twakto', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
<?php endif; ?>

<?php echo $__env->make('frontend.partials.inline-script', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
<?php echo $__env->make('frontend.partials.product-ajax-js', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>

<?php echo $__env->yieldContent('scripts'); ?>

</body>
</html>
<?php /**PATH D:\YIA\@core\resources\views/frontend/partials/footer.blade.php ENDPATH**/ ?>