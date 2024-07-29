<?php

    namespace App\Http\Controllers;

    use App\Interface\OtpRepoInterface;
    use Illuminate\Http\Request;
    use App\Models\VerificationCode;
    use Carbon\Carbon;
    use App\Mail\SendMail;
    use Illuminate\Support\Facades\Mail;
    use App\Class\ApiRes;
    class OtpController extends Controller
    {
        private OtpRepoInterface $otpRepoInterface      ;
        public function __construct(OtpRepoInterface $otpRepoInterface){
            $this->otpRepoInterface = $otpRepoInterface;
        }
        public function index()
        {
            return view('ver');
        }
        public function generate(Request $request)
        {
            $email = $request->email;
            $verificationCode = $this->otpRepoInterface->findemail($email);
            $now = Carbon::now();
            if ($verificationCode && $now->isBefore($verificationCode->expire_at)) {
                Mail::to($email)->send(new SendMail($verificationCode->otp));
                return ApiRes::sendResponse([],'Code has been successfully sent',200);
            }
            $newOTP = rand(123456, 999999);
            $data = ['email'=>$email,'otp'=>$newOTP,'expire_at'=>$now->addMinutes(10)];
            if($verificationCode){
                $this->otpRepoInterface->update($data,$verificationCode->id);

            }else{
                $this->otpRepoInterface->store($data);
            }
            Mail::to($email)->send(new SendMail($newOTP));
            return ApiRes::sendResponse([],"Code has been successfully sent",200);
        }
        public function verify(Request $request)
        {
            $otp = $request->code;
            $verificationCode = VerificationCode::where('otp', $otp)->latest()->first();
            $now = Carbon::now();

            if ($verificationCode && $now->isBefore($verificationCode->expire_at)) {
                return ApiRes::sendResponse([],"Code matches",200);
            } else {
                return ApiRes::sendResponse([],"Code has been expired",400);
            }
        }
        public function code()
        {
            return view('code');
        }
    }
