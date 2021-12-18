<?php if(empty(get_static_option('navbar_variant'))): ?>
<?php echo $__env->make('frontend.partials.supportbar',['home_page_variant' => $home_page_variant], \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
<?php endif; ?><?php /**PATH D:\YIA\@core\resources\views/frontend/partials/homesupportbar.blade.php ENDPATH**/ ?>