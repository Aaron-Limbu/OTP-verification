<?php

namespace App\Repo;
use App\Models\VerificationCode;
use App\Interface\OtpRepoInterface;
class OtpRepo implements OtpRepoInterface
{
    public function index(){
        return VerificationCode::all();
    }
    public function getById($id){
        return VerificationCode::findOrFail($id);
    }
    public function store(array $data){
        return VerificationCode::create($data);
    }
    public function update(array $data,$id){
        return VerificationCode::where('id',$id)->update($data);
    }
    public function findemail($email){
        return VerificationCode::where('email',$email)->latest()->first();
    }
}
