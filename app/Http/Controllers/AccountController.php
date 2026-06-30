<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Str;
use App\Models\ProductCategory;
use App\Models\User;
use App\Models\Profiles;

use Hash;
use Cache;
use Validator;

class AccountController extends Controller
{
    function __construct(
        User $user,
        ProductCategory $productCategory,
        Profiles $profile,
    ){
        $this->user = $user;
        $this->profile = $profile;
        $this->productCategory = $productCategory;
    }

    public function index()
    {
        $data['categorys'] = $this->productCategory->where('status','Active')->orderBy('created_at','desc')->get();

        $data['user'] = $this->user->where('id',auth()->user()->id)->first();

        if (empty($data['user'])) {
            return redirect()->back()->with('error','User Tidak Ditemukan');
        }

        return view('user.account.index',$data);
    }

    public function update(Request $request)
    {
        $rules = [
            'first_name' => 'required',
            'last_name' => 'required',
            'phone_number' => 'required',
        ];

        $messages = [
            'first_name.required' => 'First Name Wajib Diisi',
            'last_name.required' => 'Last Name Wajib Diisi',
            'phone_number.required' => 'Phone Number Wajib Diisi',
        ];

        $validator = Validator::make($request->all(), $rules, $messages);

        if ($validator->passes()){
            $cekProfile = $this->profile->where('user_id',auth()->user()->id)->first();

            if (empty($cekProfile)) {
                $input = $request->all();
                $input['id'] = Str::uuid()->toString();
                $input['user_id'] = auth()->user()->id;

                $saveProfile = $this->profile->create($input);

                if ($saveProfile) {
                    $message_title="Berhasil !";
                    $message_content= "Profile Berhasil Dibuat";
                    $message_type="success";
                    $message_succes = true;

                    $array_message = array(
                        'success' => $message_succes,
                        'message_title' => $message_title,
                        'message_content' => $message_content,
                        'message_type' => $message_type,
                    );

                    return response()->json($array_message);
                }

            }else{
                $saveProfile = $this->user->update([
                    'password' => Hash::make($request->password)
                ]);

                if ($saveProfile) {
                    $message_title="Berhasil !";
                    $message_content= "Profile Berhasil Diupdate";
                    $message_type="success";
                    $message_succes = true;

                    $array_message = array(
                        'success' => $message_succes,
                        'message_title' => $message_title,
                        'message_content' => $message_content,
                        'message_type' => $message_type,
                    );

                    return response()->json($array_message);
                }
            }
        }

        return response()->json(
            [
                'success' => false,
                'error' => $validator->errors()->all()
            ]
        );
    }
}
