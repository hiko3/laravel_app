<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Todo extends Model
{
    use SoftDeletes;
    // protected $table = 'todos';

    // protected $primaryKey = 'id';

    protected $fillable = [
        'title',
        'user_id'
    ];
    // $fillableは書き換えることのできるカラムを指定する
    // 書き換えたくない値のカラムを保護する場合に$fillableを使う

    protected $dates = ['deleted_at'];

    public function getByUserId($id) //User_idカラムのIDを取得している関数
    {
        return $this->where('user_id', $id)->get();
    }
}
