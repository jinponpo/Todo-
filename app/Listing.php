<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Listing extends Model
{
    
    public function cards() {
    //hasMany設定 Listingモデルとcardテーブルの紐付け
    return $this->hasMany('App\Card');
    }
}
