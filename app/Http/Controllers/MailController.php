<?php

namespace App\Http\Controllers;

use App\khachhang;
use App\danhmucsanpham;
use App\Http\Requests\RuleDangKy;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\Redirect;
use RealRashid\SweetAlert\Facades\Aler;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\DB;
use PHPUnit\Framework\Constraint\Count;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Carbon;

class MailController extends Controller
{
    public function getPageQuenPW(){
        $danhmucs = danhmucsanpham::where('trangThai', '1')->get();

        return view('khachhang.quenmatkhau', [
            'danhmucs' => $danhmucs,
        ]);
    }

    public function quenPW(Request $request){
        $email = khachhang::where('email','=',$request->fg_email)->get();
        $now = Carbon::now('Asia/Ho_Chi_Minh')->format('d-m-Y');
        $title_mail = "Lấy lại mật khẩu TTD BookStore".' '. $now;
        foreach($email as $value){
            $id = $value->id;
            $toemail = $value->email;
        }
    
        if(count($email) > 0){
            $token = Str::random(10);
            $khachhang = khachhang::find($id);
            $khachhang->token= $token;
            $khachhang->save();

            $to_email =  $toemail;
            $link_reset_pass = url('/trangchu/new-pass?email='.$to_email.'&token='.$token);
            $data = array("name"=>$title_mail,"body"=>$link_reset_pass,'email'=> $toemail);
            

            $a = Mail::send('khachhang.xacthucmk', ['data' => $data], function($message) use($title_mail,$data){
                $message->to($data['email'])->subject($title_mail);
                $message->from($data['email'],$title_mail);
            });
            //dd($a); exit;
            alert('Vui lòng kiểm tra email!','Chúng tôi đã gửi link reset đến email của bạn ','success');
            return redirect()->route('khachhang.quenmatkhau');
        }else{
            alert('Email không đúng','','error');
            return redirect()->back();
        }
    }

    public function getPageNewPass(){
        if(Auth::guard('khachhang')->check()){
            alert('Link đã hết hạn','','error');
            return redirect()->back();
        }else{
            $danhmucs = danhmucsanpham::where('trangThai', '1')->get();

            return view('khachhang.matkhaumoi', [
                'danhmucs' => $danhmucs,
            ]);
        }

    }

    public function updateNewPass(Request $request){

        $khachhang = khachhang::where('email','=',$request->email)->where('token','=',$request->token)->get();
        $newToken = Str::random(10);
        if($request->password === $request->cf_password){
            if(Count($khachhang) > 0){
                foreach($khachhang as $value){
                    $id = $value->id;
                }
                $reset = khachhang::find($id);
                $reset->password = Hash::make($request->password);
                $reset->token = $newToken;
                $updated = $reset->save();
    
                if($updated){
                    alert('Thay đổi mật khẩu thành công','','success');
                    return redirect()->route('khachhang.trangchu');
                }else{
                    alert('Thay đổi mật khẩu thất bại','Link đã hết hạn','error');
                    return redirect()->back();
                }
            }
        }else{
            alert('Mật khẩu không trùng nhau','','error');
            return redirect()->back();
        }
    }
}
