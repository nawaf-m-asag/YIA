<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Spatie\Feed\Feedable;
use Spatie\Feed\FeedItem;


class Ads extends Model implements Feedable
{
    protected $table = 'ads';
    protected $fillable = ['title','lang','status','author','slug','meta_description','meta_tags','excerpt','content','ads_categories_id','tags','image','user_id'];

    public function category(){
        return $this->belongsTo('App\AdsCategory','ads_categories_id');
    }
    public function user(){
        return $this->belongsTo('App\Admin','user_id');
    }

    public function toFeedItem()
    {
        return FeedItem::create([
            'id' => $this->id,
            'title' => $this->title,
            'summary' => $this->excerpt,
            'updated' => $this->updated_at,
            'link' => route('frontend.ads.single',$this->slug),
            'author' => $this->author,
        ]);
    }

    public static function getAllFeedItems()
    {
        return Ads::all();
    }
}
