<?php


namespace App\PageBuilder\Addons\Event;
use App\Events;
use App\EventsCategory;
use App\Helpers\LanguageHelper;
use App\Helpers\SanitizeInput;
use App\PageBuilder\Fields\IconPicker;
use App\PageBuilder\Fields\Image;
use App\PageBuilder\Fields\NiceSelect;
use App\PageBuilder\Fields\Number;
use App\PageBuilder\Fields\Select;
use App\PageBuilder\Fields\Slider;
use App\PageBuilder\Fields\Text;
use App\PageBuilder\Fields\Textarea;
use App\PageBuilder\PageBuilderBase;
use App\ProductCategory;
use App\Testimonial;
use Illuminate\Support\Str;

class EventSliderStyleOne extends PageBuilderBase
{
    public function enable() : bool
    {
        return (boolean) get_static_option('events_module_status');
    }
    /**
     * @inheritDoc
     */
    public function preview_image()
    {
       return 'event/slider-01.png';
    }

    /**
     * @inheritDoc
     */
    public function admin_render()
    {
        $output = $this->admin_form_before();
        $output .= $this->admin_form_start();
        $output .= $this->default_fields();
        $widget_saved_values = $this->get_settings();


        $output .= $this->admin_language_tab(); //have to start language tab from here on
        $output .= $this->admin_language_tab_start();

        $all_languages = LanguageHelper::all_languages();
        foreach ($all_languages as $key => $lang) {
            $output .= $this->admin_language_tab_content_start([
                'class' => $key == 0 ? 'tab-pane fade show active' : 'tab-pane fade',
                'id' => "nav-home-" . $lang->slug
            ]);
            $output .= Text::get([
                'name' => 'section_title_'.$lang->slug,
                'label' => __('Section Title'),
                'value' => $widget_saved_values['section_title_' . $lang->slug] ?? null,
            ]);
            $categories = EventsCategory::where(['status' => 'publish','lang' => $lang->slug])->get()->pluck('title', 'id')->toArray();
            $output .= NiceSelect::get([
                'name' => 'categories_'.$lang->slug,
                'multiple' => true,
                'label' => __('Category'),
                'placeholder' => __('Select Category'),
                'options' => $categories,
                'value' => $widget_saved_values['categories_'.$lang->slug] ?? null,
                'info' => __('you can select category for event, if you want to show all event leave it empty')
            ]);
            $output .= $this->admin_language_tab_content_end();
        }

        $output .= $this->admin_language_tab_end(); //have to end language tab

        $output .= Select::get([
            'name' => 'section_title_alignment',
            'label' => __('Section Title Alignment'),
            'options' => [
                'left-align' => __('Left Align'),
                'center-align' => __('Center Align'),
                'right-align' => __('Right Align'),
            ],
            'value' => $widget_saved_values['section_title_alignment'] ?? null,
            'info' => __('set alignment of section title')
        ]);

        $output .= Select::get([
            'name' => 'order_by',
            'label' => __('Order By'),
            'options' => [
                'id' => __('ID'),
                'created_at' => __('Date'),
            ],
            'value' => $widget_saved_values['order_by'] ?? null,
            'info' => __('set order by')
        ]);
        $output .= Select::get([
            'name' => 'order',
            'label' => __('Order'),
            'options' => [
                'asc' => __('Accessing'),
                'desc' => __('Decreasing'),
            ],
            'value' => $widget_saved_values['order'] ?? null,
            'info' => __('set order')
        ]);
        $output .= Number::get([
            'name' => 'items',
            'label' => __('Items'),
            'value' => $widget_saved_values['items'] ?? null,
            'info' => __('enter how many item you want to show in frontend'),
        ]);

        $output .= Number::get([
            'name' => 'slider_items',
            'label' => __('Slider Item'),
            'value' => $widget_saved_values['slider_items'] ?? 1,
            'info' => __('enter how many item you want to show in a row of slider'),
        ]);
        $output .= Slider::get([
            'name' => 'padding_top',
            'label' => __('Padding Top'),
            'value' => $widget_saved_values['padding_top'] ?? 110,
            'max' => 200,
        ]);
        $output .= Slider::get([
            'name' => 'padding_bottom',
            'label' => __('Padding Bottom'),
            'value' => $widget_saved_values['padding_bottom'] ?? 110,
            'max' => 200,
        ]);

        // add padding option

        $output .= $this->admin_form_submit_button();
        $output .= $this->admin_form_end();
        $output .= $this->admin_form_after();

        return $output;
    }

    /**
     * @inheritDoc
     */
    public function frontend_render()
    {
        $settings = $this->get_settings();
        $current_lang = LanguageHelper::user_lang_slug();
        $section_title = SanitizeInput::esc_html($settings['section_title_'.$current_lang]);
        $category = $settings['categories_'.$current_lang] ?? [];

        $section_title_alignment = SanitizeInput::esc_html($settings['section_title_alignment']);
        $order_by = SanitizeInput::esc_html($settings['order_by']);
        $order = SanitizeInput::esc_html($settings['order']);
        $items = SanitizeInput::esc_html($settings['items']);
        $slider_items = SanitizeInput::esc_html($settings['slider_items']);
        $padding_top = SanitizeInput::esc_html($settings['padding_top']);
        $padding_bottom = SanitizeInput::esc_html($settings['padding_bottom']);


        $events = Events::query()->where(['lang' => $current_lang,'status' => 'publish']);
        if (!empty($category)){
            $events->whereIn('category_id', $category);
        }
        $events =$events->orderBy($order_by,$order)->get();
        if(!empty($items)){
            $events = $events->take($items);
        }
        $category_markup = '';

        foreach ($events as $event){
            $image = render_image_markup_by_attachment_id($event->image,'','grid');
            $day = date('d',strtotime($event->date));
            $month = date('M',strtotime($event->date));
            $route = route('frontend.events.single',$event->slug);
            $title = $event->title;
            $location = $event->venue_location;
            $description = strip_tags(Str::words(str_replace('&nbsp;',' ',$event->content),20));
            $category_markup .= <<<HTML

<div class="single-events-list-item course-home">
    <div class="thumb">
       {$image}
    </div>
     <div class="content-area">
        <div class="top-part">
            <div class="time-wrap">
                <span class="date">{$day}</span>
                <span class="month">{$month}</span>
            </div>
            <div class="title-wrap">
                <a href="{$route}"><h4 class="title">{$title}</h4></a>
            </div>
        </div>
        <span class="location d-block"><i class="fas fa-map-marker-alt"></i> {$location}</span>
        <p>{$description}</p>
    </div>
</div>
HTML;
        }
        $section_title_markup = '';
        if (!empty($section_title)){
            $section_title_markup .= <<<HTML
<div class="row">
    <div class="col-lg-12">
        <div class="section-title margin-bottom-80 course-home {$section_title_alignment}">
            <h2 class="title">{$section_title}</h2>
        </div>
    </div>
</div>
HTML;

        }

        return <<<HTML
<div class="course-home-event-area" data-padding-top="{$padding_top}" data-padding-bottom="{$padding_bottom}">
    <div class="container">
        {$section_title_markup}
        <div class="row">
            <div class="col-lg-12">
                <div class="global-carousel-init logistic-dots "
                     data-loop="true"
                     data-desktopitem="{$slider_items}"
                     data-mobileitem="1"
                     data-tabletitem="1"
                     data-dots="true"
                     data-autoplay="true"
                     data-margin="0"
                >
                {$category_markup}
                </div>
            </div>
        </div>
    </div>
</div>
HTML;

    }

    /**
     * @inheritDoc
     */
    public function addon_title()
    {
        return __('Event Slider: 01');
    }
}