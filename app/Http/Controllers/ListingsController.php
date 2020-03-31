<?php

namespace App\Http\Controllers;

use App\Listing;
use Auth;
use Validator;
use Illuminate\Http\Request;

class ListingsController extends Controller
{
    
    public function __construct()                               //このクラスが呼ばれると、最初にこの処理をする）
    {
        $this->middleware('auth');                              //ログインしてなかったら、ログインページに飛ぶ
    }

    public function index() 
    {
        $listings = Listing::where('user_id', Auth::user()->id)
            ->latest()                                          //データを新しい順に並び替える
            ->get();
            
        return view('listing/index', ['listings' => $listings]);//「listing/index.blade.php」を表示
    }

    public function new()
    {
        return view('listing/new');                             //「listing/new.blade.php」を表示
        
    }

    public function store(Request $request)                     //storeアクション
    {
        $validator = Validator::make($request->all() , [        //条件
            'list_name' => 'required|max:255', ]);              //リスト名は必須&255文字まで

        if ($validator->fails())                                //もしバリデーションエラーなら
        {
            return redirect()->back()->withErrors($validator->errors())->withInput();//一つ前に戻る、入力値を保持する
        }

        //モデル作成(Formから送信されたデータはRequest型で渡ってくるので、$requestを使って新しいリストを作る)
        $listings = new Listing;                                //モデル名「Listing」
        $listings->title = $request->list_name;                 //titleはlist_name
        $listings->user_id = Auth::user()->id;                  //user_idを認証
        $listings->save();                                      //保存
        return redirect('/');                                   //一覧「/」にリダイレクト
    }

    public function edit($listing_id)                           //アクションの引数を型の同じ変数名にすると$lisiting_idにURLから受け取ったidに対応するデータが格納される
    {
        $listing = Listing::find($listing_id);
        return view('listing/edit', ['listing' => $listing]);   //「listing/edit.balde.php」を表示,データをビューの渡す　
    }

    public function update(Request $request)
    {
        $validator = Validator::make($request->all() , ['list_name' => 'required|max:255', ]);

        if ($validator->fails())
        {
          return redirect()->back()->withErrors($validator->errors())->withInput();
        }
        
        $listing = Listing::find($request->id);
        $listing->title = $request->list_name;
        $listing->save();
        return redirect('/');
    }

    public function destroy($listing_id)
    {
        $listing = Listing::find($listing_id);
        $listing->delete();
        return redirect('/');
    }
}