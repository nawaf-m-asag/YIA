@php $home_page_variant = get_static_option('home_page_variant');@endphp
<div class="sidebar-menu">
    <div class="sidebar-header">
        <div class="logo" style="max-height: 50px;">
            <a href="{{route('admin.home')}}">
                @php
                    $logo_type = 'site_logo';
                    if(!empty(get_static_option('site_admin_dark_mode'))){
                        $logo_type = 'site_white_logo';
                    }
                    
                @endphp
                {!! render_image_markup_by_attachment_id(get_static_option($logo_type)) !!}
            </a>
        </div>
    </div>
    <div class="main-menu">
        <div class="menu-inner">
            <nav id="main_menu_wrap">
                <ul class="metismenu" id="menu">
                    <li class="{{active_menu('admin-home')}}">
                        <a href="{{route('admin.home')}}"
                           aria-expanded="true">
                            <i class="ti-dashboard"></i>
                            <span>@lang('لوحة التحكم')</span>
                        </a>
                    </li>
                    @if(check_page_permission('admin_manage'))
                    <li
                        class="main_dropdown
                        @if(request()->is(['admin-home/admin/*'])) active @endif
                        ">
                        <a href="javascript:void(0)" aria-expanded="true"><i class="ti-user"></i>
                            <span>مدير الموقع</span></a>
                        <ul class="collapse">
                            <li class="{{active_menu('admin-home/admin/all')}}"><a
                                        href="{{route('admin.all.user')}}">الكل</a></li>
                            <li class="{{active_menu('admin-home/admin/new')}}"><a
                                        href="{{route('admin.new.user')}}">اضافة جديد</a></li>
                            <li class="{{active_menu('admin-home/admin/all/role')}}"><a
                                        href="{{route('admin.all.user.role')}}">الصلاحيات</a></li>
                        </ul>
                    </li>
                    @endif
                    @if(check_page_permission_by_string('Users Manage'))
                    <li
                        class="main_dropdown
                        @if(request()->is([
                        'admin-home/frontend/user/*',
                        ])) active @endif
                        ">
                        <a href="javascript:void(0)" aria-expanded="true"><i class="ti-user"></i>
                            <span>إدارة المستخدمين</span></a>
                        <ul class="collapse">
                            <li class="{{active_menu('admin-home/frontend/user/all')}}"><a
                                    href="{{route('admin.all.frontend.user')}}">المستخدمين</a></li>
                            <li class="{{active_menu('admin-home/frontend/user/new')}}"><a
                                    href="{{route('admin.frontend.new.user')}}">اضافة مستخدم</a></li>
                            <li class="{{active_menu('admin-home/frontend/user/certificate')}}"><a
                        
                                        href="{{route('admin.frontend.certificate.user')}}">ادارة الشهادات </a></li>  
                          <li class="{{active_menu('admin-home/frontend/user/self-reports')}}"><a
                                            href="{{route('admin.frontend.self_reports')}}">
                             ادارة التقارير الذاتية
                          </a></li>      
                        </ul>
                    </li>
                    @endif
                    @if(check_page_permission_by_string('Newsletter Manage'))
                    <li
                        class="main_dropdown @if(request()->is(['admin-home/newsletter/*','admin-home/newsletter'])) active @endif
                     ">
                        <a href="javascript:void(0)" aria-expanded="true"><i class="ti-email"></i>
                            <span>إدارة المشتركين</span></a>
                        <ul class="collapse">
                            <li class="{{active_menu('admin-home/newsletter')}}"><a
                                        href="{{route('admin.newsletter')}}">المشتركين</a></li>
                            <li class="{{active_menu('admin-home/newsletter/all')}}"><a
                                        href="{{route('admin.newsletter.mail')}}">إرسال ايميل للمشتركين</a></li>
                        </ul>
                    </li>
                    @endif

                    @if(check_page_permission_by_string('Pages Manage'))
                        <li
                        class="main_dropdown
                        @if(request()->is(['admin-home/page/*','admin-home/page'])) active @endif
                        ">
                            <a href="javascript:void(0)" aria-expanded="true"><i class="ti-write"></i>
                                <span>الصفحات</span></a>
                            <ul class="collapse">
                                <li class="{{active_menu('admin-home/page')}}"><a
                                            href="{{route('admin.page')}}">الصفحات</a></li>
                                <li class="{{active_menu('admin-home/page/new')}}"><a
                                            href="{{route('admin.page.new')}}">اضافة صفحة</a></li>
                            </ul>
                        </li>
                    @endif
                    @if(check_page_permission_by_string('Blogs Manage'))
                        <li
                         class="main_dropdown
                        @if(request()->is(['admin-home/blog/*','admin-home/blog'])) active @endif
                        ">
                            <a href="javascript:void(0)" aria-expanded="true"><i class="ti-write"></i>
                                <span>الاخبار</span></a>
                            <ul class="collapse">
                                <li class="{{active_menu('admin-home/blog')}}"><a
                                            href="{{route('admin.blog')}}">الاخبار</a></li>
                                <li class="{{active_menu('admin-home/blog/category')}}"><a
                                            href="{{route('admin.blog.category')}}">التصنيفات</a></li>
                                <li class="{{active_menu('admin-home/blog/new')}}"><a
                                            href="{{route('admin.blog.new')}}">اضافة جديد</a></li>
                                <li class="{{active_menu('admin-home/blog/page-settings')}}"><a
                                        href="{{route('admin.blog.page.settings')}}">اعدادات صفحة الاخبار</a></li>
                                <li class="{{active_menu('admin-home/blog/single-settings')}}"><a
                                        href="{{route('admin.blog.single.settings')}}">اعدادات الاخبار</a></li>
                            </ul>
                        </li>
                    @endif
                    @if(check_page_permission_by_string('Services'))
                    <li class="main_dropdown
                    @if(request()->is(['admin-home/services/*','admin-home/services'])) active @endif
                    ">
                        <a href="javascript:void(0)"
                           aria-expanded="true">
                            <i class="ti-layout"></i>
                            <span>الخدمات</span>
                        </a>
                        <ul class="collapse">
                            <li class="{{active_menu('admin-home/services')}}"><a
                                    href="{{route('admin.services')}}">موضوعات الصفحة الرئيسية</a></li>
                            <li class="{{active_menu('admin-home/services/new')}}"><a
                                    href="{{route('admin.services.new')}}">اضافة جديد</a></li>
                            <li class="{{active_menu('admin-home/services/category')}}"><a
                                    href="{{route('admin.service.category')}}">التصنيفات</a></li>
                            <li class="{{active_menu('admin-home/services/page-settings')}}"><a
                                    href="{{route('admin.services.page.settings')}}">الاعدادات</a></li>
                        </ul>
                    </li>
                    @endif
                   
                    @if(check_page_permission_by_string('Gallery Page'))
                        <li class="main_dropdown
                        {{active_menu('admin-home/gallery-page')}}
                        @if(request()->is('admin-home/gallery-page/*')) active @endif
                                ">
                            <a href="javascript:void(0)" aria-expanded="true"><i class="ti-write"></i>
                                <span>معرض الصور</span></a>
                            <ul class="collapse">
                                <li class="{{active_menu('admin-home/gallery-page')}}">
                                    <a href="{{route('admin.gallery.all')}}" >الصور</a>
                                </li>
                                <li class="{{active_menu('admin-home/gallery-page/category')}}">
                                    <a href="{{route('admin.gallery.category')}}" >التصنيفات</a>
                                </li>
                                <li class="{{active_menu('admin-home/gallery-page/page-settings')}}">
                                    <a href="{{route('admin.gallery.page.settings')}}" >الاعدادات</a>
                                </li>
                            </ul>
                        </li>
                    @endif
                    @if(check_page_permission_by_string('Video Gallery'))
                        <li class="main_dropdown
                        {{active_menu('admin-home/video-gallery')}}
                        @if(request()->is('admin-home/video-gallery/*')) active @endif
                                ">
                            <a href="javascript:void(0)" aria-expanded="true"><i class="ti-write"></i>
                                <span>معرض الفيديو</span></a>
                            <ul class="collapse">
                                <li class="{{active_menu('admin-home/video-gallery')}}">
                                    <a href="{{route('admin.video.gallery.all')}}" >الفديوهات</a>
                                </li>
                                <li class="{{active_menu('admin-home/video-gallery/page-settings')}}">
                                    <a href="{{route('admin.video.gallery.page.settings')}}" >الاعدادات</a>
                                </li>
                            </ul>
                        </li>
                    @endif
                    @if(check_page_permission_by_string('Price Plan'))
                        <li class="main_dropdown {{active_menu('admin-home/price-plan')}}
                        @if(request()->is('admin-home/price-plan/*')) active @endif
                                ">
                            <a href="javascript:void(0)" aria-expanded="true"><i class="ti-write"></i>
                                <span>إدارة العضويات</span></a>
                            <ul class="collapse">
                                <li class="{{active_menu('admin-home/price-plan')}}">
                                    <a href="{{route('admin.price.plan')}}" >العضويات</a>
                                </li>
                                <li class="{{active_menu('admin-home/price-plan/new')}}">
                                    <a href="{{route('admin.price.plan.new')}}" >اضافة جديد</a>
                                </li>
                                <li class="{{active_menu('admin-home/price-plan/category')}}">
                                    <a href="{{route('admin.price.plan.category')}}" >التصنيفات</a>
                                </li>

                            </ul>
                        </li>
                    @endif
                    @if(check_page_permission_by_string('Branches'))
                    <li class="main_dropdown {{active_menu('admin-home/branches')}}">
                        <a href="{{route('admin.branches')}}" aria-expanded="true"><i class="ti-control-forward"></i>
                            <span>الفروع</span></a>
                    </li>
                    @endif
                    @if(check_page_permission_by_string('Faq'))
                    <li class="main_dropdown {{active_menu('admin-home/faq')}}">
                        <a href="{{route('admin.faq')}}" aria-expanded="true"><i class="ti-control-forward"></i>
                            <span>التعليمات</span></a>
                    </li>
                    @endif
                    @if(check_page_permission_by_string('Brand Logos'))
                    <li class="main_dropdown {{active_menu('admin-home/brands')}}">
                        <a href="{{route('admin.brands')}}" aria-expanded="true"><i class="ti-control-forward"></i>
                            <span>الشركاء</span></a>
                    </li>
                    @endif
                    @if(check_page_permission_by_string('Discount Logos'))
                    <li class="main_dropdown {{active_menu('admin-home/discounts')}}">
                        <a href="{{route('admin.discounts')}}" aria-expanded="true"><i class="ti-control-forward"></i>
                            <span>الخصومات</span></a>
                    </li>
                    @endif
                    @if(check_page_permission_by_string('Team Members'))
                    <li class="main_dropdown {{active_menu('admin-home/team-member')}}">
                        <a href="{{route('admin.team.member')}}" aria-expanded="true"><i class="ti-control-forward"></i>
                            <span>المساهمين</span></a>
                    </li>
                    @endif
                    
                   
                    <li class="main_dropdown
                    @if(request()->is(['admin-home/quote-manage/*',
                    'admin-home/package/*',
                    'admin-home/payment-logs',
                    'admin-home/payment-logs/report',
                    'admin-home/jobs',
                    'admin-home/jobs/*',
                    'admin-home/award',
                    'admin-home/award/*',
                    'admin-home/events',
                    'admin-home/events/*',
                    'admin-home/products',
                    'admin-home/products/*',
                    'admin-home/donations',
                    'admin-home/donations/*',
                    'admin-home/knowledge',
                    'admin-home/knowledge/*',
                    'admin-home/appointment/*',
                    'admin-home/courses/*',
                    'admin-home/support-tickets/*',
                    'admin-home/support-tickets'
                    ])) active @endif">
                        <a href="javascript:void(0)" aria-expanded="true"><i class="ti-settings"></i>
                            <span>إدارة المحتوى</span></a>
                        <ul class="collapse ">
                            @if(check_page_permission_by_string('Courses Manage')  && !empty(get_static_option('course_module_status')))
                                <li class="main_dropdown @if(request()->is('admin-home/courses/*')) active @endif ">
                                    <a href="javascript:void(0)" aria-expanded="true">
                                        إدارة الدورات</a>
                                    <ul class="collapse">
                                        <li class="{{active_menu('admin-home/courses/all')}}">
                                            <a href="{{route('admin.courses.all')}}">الدورات</a>
                                        </li>
                                        <li class="{{active_menu('admin-home/courses/new')}}">
                                            <a href="{{route('admin.courses.new')}}">اضافة جديد</a>
                                        </li>
                                        <li class="{{active_menu('admin-home/courses/category')}}">
                                            <a href="{{route('admin.courses.category.all')}}">التصنيفات</a>
                                        </li>
                                        <li class="{{active_menu('admin-home/courses/lesson')}}">
                                            <a href="{{route('admin.courses.lesson.all')}}">الدروس</a>
                                        </li>
                                        <li class="{{active_menu('admin-home/courses/review')}}">
                                            <a href="{{route('admin.courses.review.all')}}">التقييمات والمراجعات</a>
                                        </li>
                                        <li class="{{active_menu('admin-home/courses/coupon')}}">
                                            <a href="{{route('admin.courses.coupon.all')}}">الكوبونات</a>
                                        </li>
                                        <li class="{{active_menu('admin-home/courses/instructor')}}">
                                            <a href="{{route('admin.courses.instructor.all')}}">المدربين</a>
                                        </li>
                                        <li class="{{active_menu('admin-home/courses/enroll')}}">
                                            <a href="{{route('admin.courses.enroll.all')}}">المسجلين بالدورات</a>
                                        </li>
                                        <li class="{{active_menu('admin-home/courses/certificate')}}">
                                            <a href="{{route('admin.courses.certificate.all')}}">الشهادات</a>
                                        </li>
                                        <li class="{{active_menu('admin-home/courses/settings')}}">
                                            <a href="{{route('admin.courses.settings')}}">الاعدادات</a></li>
                                    </ul>
                                </li>
                            @endif
                           
                           
                            @if(check_page_permission_by_string('Package Orders Manage'))
                                <li class="main_dropdown @if(request()->is(['admin-home/payment-logs/report','admin-home/payment-logs','admin-home/package/*'])) active @endif
                                        ">
                                    <a href="javascript:void(0)" aria-expanded="true">
                                        إدارة طلبات العضوية</a>
                                    <ul class="collapse">
                                        <li class="{{active_menu('admin-home/package/order-manage/all')}}"><a
                                                    href="{{route('admin.package.order.manage.all')}}">كل الطلبات</a></li>
                                        <li class="{{active_menu('admin-home/package/order-manage/pending')}}"><a
                                                    href="{{route('admin.package.order.manage.pending')}}">الطلبات قيد الانتظار</a></li>
                                        <li class="{{active_menu('admin-home/package/order-manage/in-progress')}}"><a
                                                    href="{{route('admin.package.order.manage.in.progress')}}">الطلبات تحت المعالجة</a></li>
                                        <li class="{{active_menu('admin-home/package/order-manage/completed')}}"><a
                                                    href="{{route('admin.package.order.manage.completed')}}">الطلبات المكتملة</a></li>
                                        <li class="{{active_menu('admin-home/package/order-manage/success-page')}}"><a
                                                    href="{{route('admin.package.order.success.page')}}">صفحة الطلبات الناجحة</a></li>
                                        <li class="{{active_menu('admin-home/package/order-manage/cancel-page')}}"><a
                                                    href="{{route('admin.package.order.cancel.page')}}">صفحة الطلبات الملغاه</a></li>
                                        <li class="{{active_menu('admin-home/package/order-page')}}">
                                            <a href="{{route('admin.package.order.page')}}">إدارة صفحة الطلب</a>
                                        </li>
                                        <li class="{{active_menu('admin-home/package/order-report')}}">
                                            <a href="{{route('admin.package.order.report')}}">تقارير الطلبات</a>
                                        </li>
                                        <li class="{{active_menu('admin-home/payment-logs')}}"><a
                                                    href="{{route('admin.payment.logs')}}">سجلات الدفع</a></li>
                                        <li class="{{active_menu('admin-home/payment-logs/report')}}"><a
                                                    href="{{route('admin.payment.report')}}">تقارير الدفع</a></li>
                                        <li class="{{active_menu('admin-home/package/order-manage/settings')}}"><a
                                                    href="{{route('admin.package.settings')}}">الاعدادات</a></li>
                                    </ul>
                                </li>
                            @endif
                            @if(check_page_permission_by_string('Job Post Manage') && !empty(get_static_option('job_module_status')))
                                <li
                                    class="main_dropdown
                                    @if(request()->is(['admin-home/jobs/*','admin-home/jobs'])) active @endif
                                    ">
                                    <a href="javascript:void(0)" aria-expanded="true">
                                        إدارة الوظائف</a>
                                    <ul class="collapse">
                                        <li class="{{active_menu('admin-home/jobs')}}"><a
                                                    href="{{route('admin.jobs.all')}}">الوظائف</a></li>
                                        <li class="{{active_menu('admin-home/jobs/category')}}"><a
                                                    href="{{route('admin.jobs.category.all')}}">التصنيفات</a></li>
                                        <li class="{{active_menu('admin-home/new-jobs')}}"><a
                                                    href="{{route('admin.jobs.new')}}">اضافة جديد</a></li>
                                        <li class="{{active_menu('admin-home/jobs/page-settings')}}"><a
                                                    href="{{route('admin.jobs.page.settings')}}">اعدادات صفحة الوظائف</a></li>
                                        <li class="{{active_menu('admin-home/jobs/single-page-settings')}}"><a
                                                    href="{{route('admin.jobs.single.page.settings')}}">الاعدادات</a></li>
                                        <li class="{{active_menu('admin-home/jobs/success-page-settings')}}">
                                            <a href="{{route('admin.jobs.success.page.settings')}}">اعدادات الوظائف الناجحة</a>
                                        </li>
                                        <li class="{{active_menu('admin-home/jobs/cancel-page-settings')}}">
                                            <a href="{{route('admin.jobs.cancel.page.settings')}}">اعدادات الوظائف الملغاة</a>
                                        </li>
                                        <li class="{{active_menu('admin-home/jobs/applicant')}}"><a
                                                    href="{{route('admin.jobs.applicant')}}">جميع المتقدمين</a></li>
                                        <li class="{{active_menu('admin-home/jobs/applicant/report')}}"><a
                                                    href="{{route('admin.jobs.applicant.report')}}">تقرير المتقدمين</a></li>
                                    </ul>
                                </li>
                            @endif
                                 @if(check_page_permission_by_string('Job Post Manage') && !empty(get_static_option('job_module_status')))
                            <li
                                class="main_dropdown
                                @if(request()->is(['admin-home/awards/*','admin-home/awards'])) active @endif
                                ">
                                <a href="javascript:void(0)" aria-expanded="true">
                                    {{__('Awards Post Manage')}}</a>
                                <ul class="collapse">
                                    <li class="{{active_menu('admin-home/awards')}}"><a
                                                href="{{route('admin.awards.all')}}">{{__('All Awards')}}</a></li>
                                    <li class="{{active_menu('admin-home/awards/category')}}"><a
                                                href="{{route('admin.awards.category.all')}}">{{__('Category')}}</a></li>
                                    <li class="{{active_menu('admin-home/new-awards')}}"><a
                                                href="{{route('admin.awards.new')}}">{{__('Add New Awards')}}</a></li>
                                    <li class="{{active_menu('admin-home/awards/page-settings')}}"><a
                                                href="{{route('admin.awards.page.settings')}}">{{__('Award Page Settings')}}</a></li>
                                    <li class="{{active_menu('admin-home/awards/single-page-settings')}}"><a
                                                href="{{route('admin.awards.single.page.settings')}}">{{__('Award Single Page Settings')}}</a></li>
                                    <li class="{{active_menu('admin-home/awards/success-page-settings')}}">
                                        <a href="{{route('admin.awards.success.page.settings')}}">{{__('Award Success Page Settings')}}</a>
                                    </li>
                                    <li class="{{active_menu('admin-home/awards/cancel-page-settings')}}">
                                        <a href="{{route('admin.awards.cancel.page.settings')}}">{{__('Awards Cancel Page Settings')}}</a>
                                    </li>
                                    <li class="{{active_menu('admin-home/awards/applicant')}}"><a
                                                href="{{route('admin.awards.applicant')}}">{{__('All Applicant')}}</a></li>
                                    <li class="{{active_menu('admin-home/awards/applicant/report')}}"><a
                                                href="{{route('admin.awards.applicant.report')}}">{{__('Applicant Report')}}</a></li>
                                </ul>
                            </li>
                        @endif
                            @if(check_page_permission_by_string('Events Manage') && !empty(get_static_option('events_module_status')))
                                    <li class="main_dropdown
                                    @if(request()->is(['admin-home/events/*','admin-home/events'])) active @endif
                                            ">
                                        <a href="javascript:void(0)" aria-expanded="true">
                                            إدارة الاحداث</a>
                                        <ul class="collapse">
                                            <li class="{{active_menu('admin-home/events/all')}}"><a
                                                        href="{{route('admin.events.all')}}">الكل</a></li>
                                            <li class="{{active_menu('admin-home/events/category')}}"><a
                                                        href="{{route('admin.events.category.all')}}">التصنيفات</a></li>
                                            <li class="{{active_menu('admin-home/events/new')}}"><a
                                                        href="{{route('admin.events.new')}}">اضافة جديد</a></li>
                                            <li class="{{active_menu('admin-home/events/page-settings')}}"><a
                                                        href="{{route('admin.events.page.settings')}}">اعدادات صفحة الاحداث</a></li>
                                            <li class="{{active_menu('admin-home/events/single-page-settings')}}"><a
                                                        href="{{route('admin.events.single.page.settings')}}">الاعدادات</a></li>
                                            <li class="{{active_menu('admin-home/events/attendance')}}"><a
                                                        href="{{route('admin.events.attendance')}}">إعدادات حضور الحدث</a></li>
                                            <li class="{{active_menu('admin-home/events/attendance/all')}}"><a
                                                        href="{{route('admin.event.attendance.logs')}}">سجلات الحضور</a>
                                            </li>
                                            <li class="{{active_menu('admin-home/events/event-payment-logs')}}"><a
                                                        href="{{route('admin.event.payment.logs')}}">سجلات الدفع</a>
                                            </li>
                                            <li class="{{active_menu('admin-home/events/payment-success-page-settings')}}"><a
                                                        href="{{route('admin.events.payment.success.page.settings')}}">اعدادات الدفع الناجح</a>
                                            </li>
                                            <li class="{{active_menu('admin-home/events/payment-cancel-pag-settings')}}"><a
                                                        href="{{route('admin.events.payment.cancel.page.settings')}}">اعدادات الدفع الملغاه</a>
                                            </li>
                                            <li class="{{active_menu('admin-home/events/attendance/report')}}"><a
                                                        href="{{route('admin.event.attendance.report')}}">تقرير الحضور</a>
                                            </li>
                                            <li class="{{active_menu('admin-home/events/payment/report')}}"><a
                                                        href="{{route('admin.event.payment.report')}}">تقرير سجلات الدفع</a>
                                            </li>
                                            <li class="{{active_menu('admin-home/events/settings')}}"><a
                                                        href="{{route('admin.events.settings')}}">الاعدادات</a></li>
                                        </ul>
                                    </li>
                                @endif
                           
                     
                            @if(check_page_permission_by_string('Knowledgebase') && !empty(get_static_option('knowledgebase_module_status')))
                                <li class="main_dropdown {{active_menu('admin-home/knowledge')}} @if(request()->is('admin-home/knowledge/*')) active @endif"
                                >
                                    <a href="javascript:void(0)" aria-expanded="true">
                                        المقالات</a>
                                    <ul class="collapse">
                                        <li class="{{active_menu('admin-home/knowledge')}}"><a
                                                    href="{{route('admin.knowledge.all')}}">المقالات</a></li>
                                        <li class="{{active_menu('admin-home/knowledge/category')}}"><a
                                                    href="{{route('admin.knowledge.category.all')}}">المواضيع</a></li>
                                        <li class="{{active_menu('admin-home/knowledge/new')}}"><a
                                                    href="{{route('admin.knowledge.new')}}">اضافة جديد</a></li>
                                        <li class="{{active_menu('admin-home/knowledge/page-settings')}}"><a
                                                    href="{{route('admin.knowledge.page.settings')}}">الاعدادات</a></li>
                                    </ul>
                                </li>
                            @endif
                           
                        </ul>
                    </li>
                    <li class="main_dropdown
                        @if(request()->is([
                            'admin-home/home-page-01/*',
                            'admin-home/home-'.$home_page_variant.'/*',
                            'admin-home/header',
                            'admin-home/keyfeatures',
                            'admin-home/about-page/*',
                            'admin-home/contact-page/*',
                            'admin-home/feedback-page/*',
                            'admin-home/404-page-manage',
                            'admin-home/maintains-page/settings',
                            'admin-home/page-builder/*'
                        ])) active @endif
                        ">
                        <a href="javascript:void(0)" aria-expanded="true"><i class="ti-settings"></i>
                            <span>إدارة محتوى الصفحات</span></a>
                        <ul class="collapse ">
                            @if(check_page_permission_by_string('Home Page Manage'))
                                <li class="main_dropdown
                                @if(request()->is([
                                    'admin-home/home-'.$home_page_variant.'/*',
                                    'admin-home/home-page-01/*',
                                    'admin-home/header',
                                    'admin-home/keyfeatures',
                                    'admin-home/page-builder/home-page'
                                    ])  ) active @endif
                                ">
                                    <a href="javascript:void(0)"
                                       aria-expanded="true">
                                        الصفحة الرئيسية
                                    </a>
                                    <ul class="collapse">
                                        {{-- page builder check --}}
                                        @if(empty(get_static_option('home_page_page_builder_status')))
                                        @if(in_array($home_page_variant,['01','02','03','04']))
                                             <li class="{{active_menu('admin-home/home-18/header-area')}}">
                                                   
                                                </li>
                                            @if($home_page_variant != '03')
                                               <li class="{{active_menu('admin-home/home-18/header-area')}}">
                                                   
                                                </li>
                                            @endif
                                           <li class="{{active_menu('admin-home/home-18/header-area')}}">
                                                   
                                                </li>
                                            @if($home_page_variant == '03')
                                                 <li class="{{active_menu('admin-home/home-18/header-area')}}">
                                                   
                                                </li>
                                            @endif
                                            <li class="{{active_menu('admin-home/home-18/header-area')}}">
                                                   
                                                </li>
                                            @if(in_array($home_page_variant,['04','02']))
                                               <li class="{{active_menu('admin-home/home-18/header-area')}}">
                                                   
                                                </li>
                                            @endif
                                            @if(in_array($home_page_variant,['03','02']))
                                                <li class="{{active_menu('admin-home/home-18/header-area')}}">
                                                   
                                                </li>
                                            @endif
                                        @endif
                                        @if($home_page_variant == '05')
                                             <li class="{{active_menu('admin-home/home-18/header-area')}}">
                                                   
                                                </li>
                                        @endif
                                        @if($home_page_variant == '06')
                                            <li class="{{active_menu('admin-home/home-18/header-area')}}">
                                                   
                                                </li>
                                        @endif
                                        @if($home_page_variant == '07')
                                             <li class="{{active_menu('admin-home/home-18/header-area')}}">
                                                   
                                                </li>
                                        @endif
                                        @if($home_page_variant == '08')
                                            <li class="{{active_menu('admin-home/home-18/header-area')}}">
                                                   
                                                </li>
                                        @endif
                                        @if($home_page_variant == '09')
                                           <li class="{{active_menu('admin-home/home-18/header-area')}}">
                                                   
                                                </li>
                                        @endif
                                        @if($home_page_variant == '10')
                                            <li class="{{active_menu('admin-home/home-18/header-area')}}">
                                                   
                                                </li>
                                        @endif
                                        @if($home_page_variant == '11')
                                            <li class="{{active_menu('admin-home/home-18/header-area')}}">
                                                   
                                                </li>
                                            @endif
                                        @if($home_page_variant == '12')
                                            <li class="{{active_menu('admin-home/home-18/header-area')}}">
                                                   
                                                </li>
                                            @endif
                                            @if($home_page_variant == '13')
                                                 <li class="{{active_menu('admin-home/home-18/header-area')}}">
                                                   
                                                </li>
                                            @endif
                                            @if($home_page_variant == '14')
                                               <li class="{{active_menu('admin-home/home-18/header-area')}}">
                                                   
                                                </li>
                                            @endif
                                            @if($home_page_variant == '15')
                                                <li class="{{active_menu('admin-home/home-18/header-area')}}">
                                                   
                                                </li>
                                            @endif
                                            @if($home_page_variant == '16')
                                               <li class="{{active_menu('admin-home/home-18/header-area')}}">
                                                   
                                                </li>
                                            @endif
                                            @if($home_page_variant == '17')
                                              <li class="{{active_menu('admin-home/home-18/header-area')}}">
                                                   
                                                </li>
                                            @endif
                                            @if($home_page_variant == '18')
                                                 <li class="{{active_menu('admin-home/home-18/header-area')}}">
                                                   
                                                </li>
                                               
                                            @endif

                                        <li class="{{active_menu('admin-home/home-page-01/section-manage')}}">
                                            <a href="{{route('admin.homeone.section.manage')}}">إدارة الاقسام</a>
                                        </li>
                                        {{--  page builder check end --}}
                                        @endif
                                        <li class="{{active_menu('admin-home/page-builder/home-page')}}">
                                            <a href="{{route('admin.home.page.builder')}}">
                                                تحرير الصفحة الرئيسية
                                            </a>
                                        </li>

                                    </ul>
                                </li>
                            @endif
                            @if(check_page_permission('about_page_manage'))
                                <li class="main_dropdown @if(request()->is('admin-home/about-page/*') || request()->is('admin-home/page-builder/about-page')  ) active @endif ">
                                    <a href="javascript:void(0)"
                                       aria-expanded="true">
                                       إدارة صفحة من نحن
                                    </a>
                                    <ul class="collapse">
                                        @if(empty(get_static_option('about_page_page_builder_status')))
                                        <li class="{{active_menu('admin-home/about-page/about-us')}}"><a
                                                    href="{{route('admin.about.page.about')}}">قسم من نحن</a></li>
                                        <li class="{{active_menu('admin-home/about-page/global-network')}}"><a
                                                    href="{{route('admin.about.global.network')}}">قسم العملاء</a></li>
                                        <li class="{{active_menu('admin-home/about-page/experience')}}"><a
                                                    href="{{route('admin.about.experience')}}">قسم الخبرات</a></li>
                                        <li class="{{active_menu('admin-home/about-page/team-member')}}"><a
                                                    href="{{route('admin.about.team.member')}}">قسم الفريق</a></li>
                                        <li class="{{active_menu('admin-home/about-page/testimonial')}}"><a
                                                    href="{{route('admin.about.testimonial')}}">قسم الشهادات</a></li>
                                        <li class="{{active_menu('admin-home/keyfeatures')}}">
                                            <a href="{{route('admin.keyfeatures')}}">قسم المميزات</a>
                                        </li>
                                        <li class="{{active_menu('admin-home/about-page/section-manage')}}"><a
                                                    href="{{route('admin.about.page.section.manage')}}">ادارة الاقسام</a>
                                        </li>
                                        @endif 
                                      
                                    </ul>
                                </li>
                            @endif
                            @if(check_page_permission_by_string('Contact Page Manage'))
                                <li class="main_dropdown @if(request()->is(['admin-home/contact-page/*','admin-home/page-builder/contact-page'])  ) active @endif">
                                    <a href="javascript:void(0)"
                                       aria-expanded="true">
                                        إدارة صفحة التواصل
                                    </a>
                                    <ul class="collapse">
                                        @if(empty(get_static_option('contact_page_page_builder_status')))
                                        <li class="{{active_menu('admin-home/contact-page/contact-info')}}">
                                            <a href="{{route('admin.contact.info')}}">معلومات التواصل</a>
                                        </li>
                                        <li class="{{active_menu('admin-home/contact-page/form-area')}}">
                                            <a href="{{route('admin.contact.page.form.area')}}">قسم نموذج التواصل</a>
                                        </li>
                                        <li class="{{active_menu('admin-home/contact-page/map')}}">
                                            <a href="{{route('admin.contact.page.map')}}">قسم الخريطة</a>
                                        </li>
                                        <li class="{{active_menu('admin-home/contact-page/section-manage')}}">
                                            <a href="{{route('admin.contact.page.section.manage')}}">إدارة الاقسام</a>
                                        </li>
                                        @endif
                                        
                                    </ul>
                                </li>
                            @endif
                            @if(check_page_permission_by_string('Feedback Page Manage'))
                                <li class="main_dropdown @if(request()->is('admin-home/feedback-page/*')  ) active @endif">
                                    <a href="javascript:void(0)"
                                       aria-expanded="true">
                                        إدارة صفحة الملاحظات
                                    </a>
                                    <ul class="collapse">
                                        <li class="{{active_menu('admin-home/feedback-page/page-settings')}}">
                                            <a href="{{route('admin.feedback.page.settings')}}">اعدادات الصفحات</a>
                                        </li>
                                        
                                        <li class="{{active_menu('admin-home/feedback-page/all-feedback')}}">
                                            <a href="{{route('admin.feedback.all')}}">كل الملاحظات</a>
                                        </li>
                                    </ul>
                                </li>
                            @endif
                            @if(check_page_permission_by_string('404 Page Manage'))
                                <li class="main_dropdown {{active_menu('admin-home/404-page-manage')}}">
                                    <a href="{{route('admin.404.page.settings')}}" aria-expanded="true">
                                        صفحة 404</a>
                                </li>
                            @endif
                            @if(!empty(get_static_option('site_maintenance_mode')))
                                <li class="main_dropdown {{active_menu('admin-home/maintains-page/settings')}}">
                                    <a href="{{route('admin.maintains.page.settings')}}"
                                       aria-expanded="true">
                                       إدارة صفحة الصيانة
                                    </a>
                                </li>
                            @endif
                        </ul>
                    </li>
                    <li class="main_dropdown
                    @if(request()->is([
                    'admin-home/form-builder/*',
                    'admin-home/email-template/*',
                    'admin-home/popup-builder/*',
                    'admin-home/widgets/*',
                    'admin-home/widgets',
                    'admin-home/menu-edit/*',
                    'admin-home/media-upload/page',
                    'admin-home/menu',
                    'admin-home/appearance-setting/*'
                    ])) active @endif
                    ">
                        <a href="javascript:void(0)" aria-expanded="true"><i class="ti-settings"></i>
                            <span>إدارة المظهر</span></a>
                        <ul class="collapse ">
                            @if(check_page_permission_by_string('Topbar Settings'))
                                <li class="{{active_menu('admin-home/appearance-setting/topbar-settings')}}">
                                    <a href="{{route('admin.topbar.settings')}}"
                                       aria-expanded="true">
                                        مواقع التواصل
                                    </a>
                                </li>
                            @endif

                            @if(check_page_permission_by_string('Home Variant'))
                                <li class="{{active_menu('admin-home/appearance-setting/navbar-variant/settings')}}">
                                    <a href="{{route('admin.navbar.settings')}}"
                                       aria-expanded="true">
                                    اعدادات الراس
                                    </a>
                                </li>
                                
                                <li class="{{active_menu('admin-home/appearance-setting/breadcrumb-settings')}}">
                                    <a href="{{route('admin.breadcrumb.settings')}}"
                                       aria-expanded="true">
                                        مسار التنقل
                                    </a>
                                </li>
                                <li class="{{active_menu('admin-home/appearance-setting/footer-settings')}}">
                                    <a href="{{route('admin.footer.settings')}}"
                                       aria-expanded="true">
                                        الوان الفوتر
                                    </a>
                                </li>
                            @endif

                            @if(check_page_permission_by_string('Menus Manage'))
                                <li
                                        class="main_dropdown
                                        {{active_menu('admin-home/menu')}}
                                        @if(request()->is('admin-home/menu-edit/*')) active @endif
                                        ">
                                    <a href="javascript:void(0)" aria-expanded="true">
                                        القوائم</a>
                                    <ul class="collapse">
                                        <li class="{{active_menu('admin-home/menu')}}"><a
                                                    href="{{route('admin.menu')}}">الكل</a></li>
                                    </ul>
                                </li>
                            @endif
                                @if(check_page_permission_by_string('Widgets Manage'))
                                    <li
                                            class="main_dropdown
                                            {{active_menu('admin-home/widgets')}}
                                            @if(request()->is('admin-home/widgets/*')) active @endif
                                                    ">
                                        <a href="javascript:void(0)" aria-expanded="true">
                                            الفوتر</a>
                                        <ul class="collapse">
                                            <li class="{{active_menu('admin-home/widgets')}}"><a
                                                        href="{{route('admin.widgets')}}">الكل</a></li>
                                        </ul>
                                    </li>
                                @endif
                              
                                @if(check_page_permission_by_string('Form Builder'))
                                    <li class="main_dropdown @if(request()->is('admin-home/form-builder/*')) active @endif">
                                        <a href="javascript:void(0)"
                                           aria-expanded="true">
                                             النماذج
                                        </a>
                                        <ul class="collapse">
                                            
                                            <li class="{{active_menu('admin-home/form-builder/get-in-touch')}}"><a
                                                        href="{{route('admin.form.builder.get.in.touch')}}">نموذج تواصل معنا</a></li>
                                         
                                          
                                           
                                          
                                            <li class="{{active_menu('admin-home/form-builder/contact-form')}}"><a
                                                        href="{{route('admin.form.builder.contact')}}">نموذج الاتصال</a></li>
                                            <li class="{{active_menu('admin-home/form-builder/apply-job-form')}}"><a
                                                        href="{{route('admin.form.builder.apply.job.form')}}">نموذج التقديم لوظيفة</a>
                                            </li>
                                            <li class="{{active_menu('admin-home/form-builder/event-attendance')}}"><a
                                                        href="{{route('admin.form.builder.event.attendance.form')}}">نموذج حضور الاحداث</a>
                                            </li>
                                            <li class="{{active_menu('admin-home/form-builder/appoinment-booking')}}"><a
                                                href="{{route('admin.form.builder.appointment.form')}}">نموذج التواصل</a>
                                          
                                        </ul>
                                    </li>
                                @endif
                                @if(check_page_permission_by_string('Email Templates'))
                                    <li class="main_dropdown @if(request()->is('admin-home/email-template/*')) active @endif">
                                        <a href="{{route('admin.email.template.all')}}"
                                           aria-expanded="true">
                                            قالب البريد الالكتروني
                                        </a>
                                    </li>
                                @endif
                                <li class="main_dropdown {{active_menu('admin-home/media-upload/page')}}">
                                    <a href="{{route('admin.upload.media.images.page')}}"
                                       aria-expanded="true">
                                        مكتبة الوسائط
                                    </a>
                                </li>
                        </ul>
                    </li>
                    @if(check_page_permission_by_string('General Settings'))
                    <li class="main_dropdown @if(request()->is('admin-home/general-settings/*')) active @endif">
                        <a href="javascript:void(0)" aria-expanded="true"><i class="ti-settings"></i>
                            <span>الاعدادات</span></a>
                        <ul class="collapse ">
                            <li class="{{active_menu('admin-home/general-settings/site-identity')}}"><a
                                        href="{{route('admin.general.site.identity')}}">الشعار</a></li>
                            <li class="{{active_menu('admin-home/general-settings/basic-settings')}}"><a
                                        href="{{route('admin.general.basic.settings')}}">الاعدادات الاساسية</a>
                            </li>
                            <li class="{{active_menu('admin-home/general-settings/color-settings')}}"><a
                                        href="{{route('admin.general.color.settings')}}">اعدادات اللون</a>
                            </li>
                            <li class="{{active_menu('admin-home/general-settings/typography-settings')}}"><a
                                        href="{{route('admin.general.typography.settings')}}">اعدادات الخط</a>
                            </li>
                            <li class="{{active_menu('admin-home/general-settings/seo-settings')}}"><a
                                        href="{{route('admin.general.seo.settings')}}">اعدادات السيو</a></li>
                            <li class="{{active_menu('admin-home/general-settings/scripts')}}"><a
                                        href="{{route('admin.general.scripts.settings')}}">اعدادات السكربتات</a>
                            </li>
                            <li class="{{active_menu('admin-home/general-settings/email-template')}}"><a
                                        href="{{route('admin.general.email.template')}}">اعدادات قوالب البريد</a>
                            </li>
                            
                            <li class="{{active_menu('admin-home/general-settings/smtp-settings')}}"><a
                                        href="{{route('admin.general.smtp.settings')}}">اعدادات smtp</a>
                            </li>

                          
                            @if(!empty(get_static_option('site_payment_gateway')))
                            <li class="{{active_menu('admin-home/general-settings/payment-settings')}}"><a
                                        href="{{route('admin.general.payment.settings')}}">اعدادات طرق الدفع</a></li>
                            @endif
                           

                            <li class="{{active_menu('admin-home/general-settings/cache-settings')}}"><a
                                        href="{{route('admin.general.cache.settings')}}">اعدادات الكاش</a>
                            </li>
                            <li class="{{active_menu('admin-home/general-settings/gdpr-settings')}}"><a
                                        href="{{route('admin.general.gdpr.settings')}}">اعدادات الكوكيز</a>
                            </li>
                            <li class="{{active_menu('admin-home/general-settings/preloader-settings')}}"><a
                                    href="{{route('admin.general.preloader.settings')}}">اعدادات صورة تحميل الموقع</a>
                            </li>
                           
                            <li class="{{active_menu('admin-home/general-settings/sitemap-settings')}}"><a
                                    href="{{route('admin.general.sitemap.settings')}}">اعدادات خريطة الموقع</a>
                            </li>
                           
                            
                            
                            
                          
                        </ul>
                    </li>
                    @endif
                   
                </ul>
            </nav>
        </div>
    </div>
</div>
