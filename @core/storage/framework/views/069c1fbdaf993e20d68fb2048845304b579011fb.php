<div class="navbar-variant-03">
<div class="industry-support-wrap">
    <div class="container">
        <div class="row justify-content-end">
            <div class="col-lg-9">
                <div class="industry-support-inner-wrap">
                    <div class="left-content">
                        <?php
                            $all_icon_fields =  filter_static_option_value('home_page_07_topbar_section_info_item_icon',$global_static_field_data);
                            $all_icon_fields =  !empty($all_icon_fields) ? unserialize($all_icon_fields) : [];
                            $all_title_fields = filter_static_option_value('home_page_07_'.$user_select_lang_slug.'_topbar_section_info_item_title',$global_static_field_data);
                            $all_title_fields = !empty($all_title_fields) ? unserialize($all_title_fields) : [];
                            $all_details_fields = filter_static_option_value('home_page_07_'.$user_select_lang_slug.'_topbar_section_info_item_details',$global_static_field_data);
                            $all_details_fields = !empty($all_details_fields) ? unserialize($all_details_fields) : [];
                        ?>
                        <ul class="industry-info-items">
                            <?php $__currentLoopData = $all_icon_fields; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $icon): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                <li class="industry-single-info-item">
                                    <div class="icon">
                                        <i class="<?php echo e($icon); ?>"></i>
                                    </div>
                                    <div class="content">
                                        <h4 class="title"><?php echo e($all_title_fields[$loop->index] ?? ''); ?></h4>
                                        <span class="details"><?php echo e($all_details_fields[$loop->index] ?? ''); ?></span>
                                    </div>
                                </li>
                            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                        </ul>
                    </div>
                    <div class="right-content">
                        <ul class="industry-top-right-list">
                            <?php if(auth()->check()): ?>
                                <?php
                                    $route = auth()->guest() == 'admin' ? route('admin.home') : route('user.home');
                                ?>
                                <li><a href="<?php echo e($route); ?>"><?php echo e(__('Dashboard')); ?></a>  <span>/</span>
                                    <a href="<?php echo e(route('user.logout')); ?>"
                                       onclick="event.preventDefault();
                                                     document.getElementById('userlogout-form').submit();">
                                        <?php echo e(__('Logout')); ?>

                                    </a>
                                    <form id="userlogout-form" action="<?php echo e(route('user.logout')); ?>" method="POST" style="display: none;">
                                        <?php echo csrf_field(); ?>
                                    </form>
                                </li>
                            <?php else: ?>
                                <li><a href="<?php echo e(route('user.login')); ?>"><?php echo e(__('Login')); ?></a> <span>/</span> <a href="<?php echo e(route('user.register')); ?>"><?php echo e(__('Register')); ?></a></li>
                            <?php endif; ?>
                            <?php if(!empty(get_static_option('language_select_option'))): ?>
                                <li>
                                    <select id="langchange">
                                        <?php $__currentLoopData = $all_language; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $lang): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                            <option <?php if($user_select_lang_slug == $lang->slug): ?> selected <?php endif; ?> value="<?php echo e($lang->slug); ?>" class="lang-option"><?php echo e(explode('(',$lang->name)[0] ?? $lang->name); ?></option>
                                        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                    </select>
                                </li>
                            <?php endif; ?>
                        </ul>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
<div class="header-style-03  header-variant-07">
    <nav class="navbar navbar-area navbar-expand-lg">
        <div class="container nav-container">
            <div class="responsive-mobile-menu">
                <div class="logo-wrapper">
                    <a href="<?php echo e(url('/')); ?>" class="logo">
                        <?php if(!empty(filter_static_option_value('site_logo',$global_static_field_data))): ?>
                            <?php echo render_image_markup_by_attachment_id(filter_static_option_value('site_logo',$global_static_field_data)); ?>

                        <?php else: ?>
                            <h2 class="site-title"><?php echo e(filter_static_option_value('site_'.$user_select_lang_slug.'_title',$global_static_field_data)); ?></h2>
                        <?php endif; ?>
                    </a>
                </div>
                 <?php if (isset($component)) { $__componentOriginalc254754b9d5db91d5165876f9d051922ca0066f4 = $component; } ?>
<?php $component = $__env->getContainer()->make(Illuminate\View\AnonymousComponent::class, ['view' => 'components.product-cart-mobile','data' => []]); ?>
<?php $component->withName('product-cart-mobile'); ?>
<?php if ($component->shouldRender()): ?>
<?php $__env->startComponent($component->resolveView(), $component->data()); ?>
<?php $component->withAttributes([]); ?>
<?php if (isset($__componentOriginalc254754b9d5db91d5165876f9d051922ca0066f4)): ?>
<?php $component = $__componentOriginalc254754b9d5db91d5165876f9d051922ca0066f4; ?>
<?php unset($__componentOriginalc254754b9d5db91d5165876f9d051922ca0066f4); ?>
<?php endif; ?>
<?php echo $__env->renderComponent(); ?>
<?php endif; ?> 
                <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#bizcoxx_main_menu"
                        aria-expanded="false" aria-label="Toggle navigation">
                    <span class="navbar-toggler-icon"></span>
                </button>
            </div>
            <div class="collapse navbar-collapse" id="bizcoxx_main_menu">
                <ul class="navbar-nav">
                    <?php echo render_frontend_menu($primary_menu); ?>

                </ul>
            </div>
            <div class="nav-right-content">
                <div class="icon-part">
                    <ul>
                         <?php if (isset($component)) { $__componentOriginalc254754b9d5db91d5165876f9d051922ca0066f4 = $component; } ?>
<?php $component = $__env->getContainer()->make(Illuminate\View\AnonymousComponent::class, ['view' => 'components.navbar-search','data' => []]); ?>
<?php $component->withName('navbar-search'); ?>
<?php if ($component->shouldRender()): ?>
<?php $__env->startComponent($component->resolveView(), $component->data()); ?>
<?php $component->withAttributes([]); ?>
<?php if (isset($__componentOriginalc254754b9d5db91d5165876f9d051922ca0066f4)): ?>
<?php $component = $__componentOriginalc254754b9d5db91d5165876f9d051922ca0066f4; ?>
<?php unset($__componentOriginalc254754b9d5db91d5165876f9d051922ca0066f4); ?>
<?php endif; ?>
<?php echo $__env->renderComponent(); ?>
<?php endif; ?> 
                         <?php if (isset($component)) { $__componentOriginalc254754b9d5db91d5165876f9d051922ca0066f4 = $component; } ?>
<?php $component = $__env->getContainer()->make(Illuminate\View\AnonymousComponent::class, ['view' => 'components.product-cart','data' => []]); ?>
<?php $component->withName('product-cart'); ?>
<?php if ($component->shouldRender()): ?>
<?php $__env->startComponent($component->resolveView(), $component->data()); ?>
<?php $component->withAttributes([]); ?>
<?php if (isset($__componentOriginalc254754b9d5db91d5165876f9d051922ca0066f4)): ?>
<?php $component = $__componentOriginalc254754b9d5db91d5165876f9d051922ca0066f4; ?>
<?php unset($__componentOriginalc254754b9d5db91d5165876f9d051922ca0066f4); ?>
<?php endif; ?>
<?php echo $__env->renderComponent(); ?>
<?php endif; ?> 
                    </ul>
                </div>
            </div>
        </div>
    </nav>
</div>
</div><?php /**PATH D:\YIA\@core\resources\views/frontend/partials/navbar-variant/navbar-03.blade.php ENDPATH**/ ?>