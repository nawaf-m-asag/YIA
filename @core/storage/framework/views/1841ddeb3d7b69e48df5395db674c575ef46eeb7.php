<?php
    $home_page_variant = $home_page ?? filter_static_option_value('home_page_variant',$global_static_field_data);
?>
        <!DOCTYPE html>
<html lang="<?php echo e($user_select_lang_slug); ?>"  dir="<?php echo e(get_user_lang_direction()); ?>">

<head>
<?php if(!empty(filter_static_option_value('site_google_analytics',$global_static_field_data))): ?>
    <?php echo get_static_option('site_google_analytics'); ?>

<?php endif; ?>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">

    <?php echo render_favicon_by_id(filter_static_option_value('site_favicon',$global_static_field_data)); ?>

    <?php echo load_google_fonts(); ?>

    <link rel="canonical" href="<?php echo e(url()->current()); ?>">
    <link rel=preload href="<?php echo e(asset('assets/frontend/css/fontawesome.min.css')); ?>" as="style">
    <link rel=preload href="<?php echo e(asset('assets/frontend/css/flaticon.css')); ?>" as="style">
    <link rel=preload href="<?php echo e(asset('assets/frontend/css/nexicon.css')); ?>" as="style">

    <link rel="stylesheet" href="<?php echo e(asset('assets/frontend/css/flaticon.css')); ?>">
    <link rel="stylesheet" href="<?php echo e(asset('assets/frontend/css/nexicon.css')); ?>">
    <link rel="stylesheet" href="<?php echo e(asset('assets/frontend/css/fontawesome.min.css')); ?>">

    <link rel="stylesheet" href="<?php echo e(asset('assets/frontend/css/bootstrap.min.css')); ?>">
    <link rel="stylesheet" href="<?php echo e(asset('assets/frontend/css/owl.carousel.min.css')); ?>">
    <link rel="stylesheet" href="<?php echo e(asset('assets/frontend/css/animate.css')); ?>">

    <link rel="stylesheet" href="<?php echo e(asset('assets/frontend/css/magnific-popup.css')); ?>">
    <link rel="stylesheet" href="<?php echo e(asset('assets/frontend/css/style.css')); ?>">
    <link rel="stylesheet" href="<?php echo e(asset('assets/frontend/css/helpers.css')); ?>">
    <link rel="stylesheet" href="<?php echo e(asset('assets/frontend/css/responsive.css')); ?>">
    <link rel="stylesheet" href="<?php echo e(asset('assets/frontend/css/jquery.ihavecookies.css')); ?>">
    <link rel="stylesheet" href="<?php echo e(asset('assets/frontend/css/dynamic-style.css')); ?>">
    <link rel="stylesheet" href="<?php echo e(asset('assets/frontend/css/toastr.css')); ?>">
    <link href="<?php echo e(asset('assets/frontend/css/jquery.mb.YTPlayer.min.css')); ?>" media="all" rel="stylesheet" type="text/css">
    <link rel="stylesheet" href="//code.jquery.com/ui/1.12.1/themes/base/jquery-ui.css">

    <?php if(file_exists('assets/frontend/css/home-'.$home_page_variant.'.css') && empty(get_static_option('home_page_page_builder_status'))): ?>
        <link rel="stylesheet" href="<?php echo e(asset('assets/frontend/css/home-'.$home_page_variant.'.css')); ?>">
    <?php endif; ?>
    <?php echo $__env->make('frontend.partials.css-variable', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
    <?php echo $__env->make('frontend.partials.navbar-css', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
    <?php echo $__env->yieldContent('style'); ?>
    <?php if(!empty(filter_static_option_value('site_rtl_enabled',$global_static_field_data)) || get_user_lang_direction() == 'rtl'): ?>
        <link rel="stylesheet" href="<?php echo e(asset('assets/frontend/css/rtl.css')); ?>">
    <?php endif; ?>
    <?php echo $__env->make('frontend.partials.og-meta', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
    <script src="<?php echo e(asset('assets/frontend/js/jquery-3.4.1.min.js')); ?>"></script>
    <script src="<?php echo e(asset('assets/frontend/js/jquery-migrate-3.1.0.min.js')); ?>"></script>
    <script>var siteurl = "<?php echo e(url('/')); ?>"</script>
    <?php echo filter_static_option_value('site_third_party_tracking_code',$global_static_field_data); ?>

    
    <script type="text/javascript">
    adroll_adv_id = "GXM5SRU2XZE7JOKGHSZPSZ";
    adroll_pix_id = "WP43YTLBS5BQXDP6XUEIC7";
    adroll_version = "2.0";

    (function(w, d, e, o, a) {
        w.__adroll_loaded = true;
        w.adroll = w.adroll || [];
        w.adroll.f = [ 'setProperties', 'identify', 'track' ];
        var roundtripUrl = "https://s.adroll.com/j/" + adroll_adv_id
                + "/roundtrip.js";
        for (a = 0; a < w.adroll.f.length; a++) {
            w.adroll[w.adroll.f[a]] = w.adroll[w.adroll.f[a]] || (function(n) {
                return function() {
                    w.adroll.push([ n, arguments ])
                }
            })(w.adroll.f[a])
        }

        e = d.createElement('script');
        o = d.getElementsByTagName('script')[0];
        e.async = 1;
        e.src = roundtripUrl;
        o.parentNode.insertBefore(e, o);
    })(window, document);
    adroll.track("pageView");
</script>
</head>

<body class="<?php echo e(request()->path()); ?> home_variant_<?php echo e($home_page_variant); ?> nexelit_version_<?php echo e(getenv('XGENIOUS_NEXELIT_VERSION')); ?> <?php echo e(filter_static_option_value('item_license_status',$global_static_field_data)); ?> apps_key_<?php echo e(filter_static_option_value('site_script_unique_key',$global_static_field_data)); ?> ">
<?php echo $__env->make('frontend.partials.preloader', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
<?php echo $__env->make('frontend.partials.search-popup', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>


<?php if(!empty(get_static_option('navbar_variant')) && !in_array(get_static_option('navbar_variant'),['03','05'])): ?>
<?php echo $__env->make('frontend.partials.supportbar',['home_page_variant' => $home_page_variant], \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
<?php endif; ?><?php /**PATH D:\YIA\@core\resources\views/frontend/partials/header.blade.php ENDPATH**/ ?>