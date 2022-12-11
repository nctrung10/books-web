<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class payment extends Model
{
    protected $table = 'payment';
    protected $fillable = ['id','id_DH','p_transaction_id ','p_user_id','p_money','p_note','p_vnp_reponse_code','p_code_vnpay','p_code_bank','p_time','created_at','updated_at'];
}
