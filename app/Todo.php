<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Todo extends Model
{
    // protected $table = 'todos';

    // protected $primaryKey = 'id';

    protected $fillable = [
        'title',
        'user_id'
    ];
    // $fillableは書き換えることのできるカラムを指定する
    // 書き換えたくない値のカラムを保護する場合に$fillableを使う

    public function getByUserId($id) //User_idカラムのIDを取得している関数
    {
        return $this->where('user_id', $id)->get();
    }
}
