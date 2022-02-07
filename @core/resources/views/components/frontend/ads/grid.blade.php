
<div class="col-lg-6">
    <div class="blog-classic-item-ads card {{$margin ? 'margin-bottom-60' : ''}}">
        
            <div class="thumbnail">
               
                    <div class="overlay">
                        <div class="plus">
                            <a href="{{route('frontend.ads.single',$ads->slug)}}"><i class="fas fa-plus"></i></a>
                        </div>
                        <ul class="post-meta">
                            <li><a href="{{route('frontend.ads.single',$ads->slug)}}"><i class="far fa-clock"></i> {{date_format($ads->created_at,'d M y')}}</a></li>
                            <li>
                                <div class="cats"><i class="fas fa-microchip"></i>
                                    {!! get_ads_category_by_id($ads->ads_categories_id,'link') !!}
                                </div>
                            </li>
                        </ul>
                    </div>
                
                    {!! render_image_markup_by_attachment_id($ads->image) !!}
         
              
            </div>
    
            <div class="content">
            
                <h4 class="mt-3"><a href="{{route('frontend.ads.single',$ads->slug)}}">{{$ads->title}}</a></h4>
                <p>{{$ads->excerpt}}</p>
            </div>
        </div>
    </div>    
     