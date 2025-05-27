<?php

namespace App\Http\Controllers;

use App\Models\LoginSession;
use App\Models\User;
use Hash;
use Illuminate\Http\Request;
use Illuminate\Support\Carbon;
use Illuminate\Support\Facades\Validator;
use Illuminate\Validation\Rules\Password;
use Illuminate\Support\Facades\Log;

class AuthController extends Controller
{
    public function registrationForm()
    {
        return response()->view('auth.registration');
    }

    public function loginForm()
    {
        return response()->view('auth.login');
    }

    public function submitRegistrationForm(Request $request)
    {
        $rules = [
            "name" => ["required", "min:8", "max:255"],
            "email" => ["required", "email", "max:255", "unique:users,email"],
            "password" => Password::min(8)->max(255)->mixedCase()->letters()->numbers()->symbols(),
            'agreedTermsOfUse' => ['required']
        ];

        /**
         * Mengambil hanya input yang dideklarasikan. 
         * 'name', 'email', 'agreedTermsOfUse' dan 'password'.
         * 
         * @var array
         */
        $registrationInput = $request->only([
            'name',
            'email',
            'password',
            'agreedTermsOfUse'
        ]);
        Log::debug("AuthController.submitRegistrationForm.\$registrationInput", $registrationInput);

        /**
         * @var array
         */
        $registrationInputValidated = Validator::validate($registrationInput, $rules);
        Log::debug("AuthController.submitRegistrationForm.\$registrationInputValidated", $registrationInputValidated);

        /**
         * @var \Illuminate\Validation\Validator
         */
        $validator = Validator::make($registrationInput, $rules);
        if ($validator->fails()) {

            /**
             * @var string[][]
             */
            $registrationErrorMessage = $validator->getMessageBag()->getMessages();
            Log::debug("AuthController.submitRegistrationForm.\$arrayStringMessage", $registrationErrorMessage);

            return back()->withErrors([
                "name" => $registrationErrorMessage['name'] ?? null,
                "email" => $registrationErrorMessage['email'] ?? null,
                "password" => $registrationErrorMessage['password'] ?? null,
                "agreedTermsOfUse" => $registrationErrorMessage['agreedTermsOfUse'] ?? null,
            ])->withInput();
        }

        /**
         * @var \App\Models\User
         */
        $userCreated = User::create([
            "name" => $registrationInputValidated['name'],
            "email" => $registrationInputValidated['email'],
            "password" => $registrationInputValidated['password'],
        ]);
        Log::debug("AuthController.submitRegistrationForm.\$userCreated", $userCreated->toArray());
        Log::info("User created.", $userCreated->toArray());

        return redirect()->action([AuthController::class, 'loginForm']);
    }

    public function submitLoginForm(Request $request)
    {
        /**
         * @var array
         */
        $rules = [
            "email" => ["required", "max:255", "exists:users,email"],
        ];

        /**
         * Mengambil hanya input yang dideklarasikan. 
         * 'email' dan 'password'.
         * 
         * @var array
         */
        $loginInput = $request->only([
            'email',
            'password',
        ]);
        Log::debug("AuthController.submitLoginForm.\$loginInput", $loginInput);

        /**
         * @var \Illuminate\Validation\Validator
         */
        $validator = Validator::make($loginInput, $rules);
        if ($validator->fails()) {

            /**
             * @var string[][]
             */
            $loginErrorMessage = $validator->getMessageBag()->getMessages();
            Log::debug("AuthController.submitLoginForm.\$loginErrorMessage", $loginErrorMessage);

            return back()->withErrors([
                "email" => $loginErrorMessage['email'] ?? null,
                "password" => "Password can't be validated without registered email.",
            ])->withInput();
        }

        /**
         * @var array
         */
        $loginInputValidated = Validator::validate($loginInput, $rules);
        Log::debug("AuthController.submitLoginForm.\$loginInputValidated", $loginInputValidated);

        /**
         * @var \App\Models\User
         */
        $userModel = User::select()->where('email', '=', $loginInputValidated['email'])->first();
        Log::debug("AuthController.submitLoginForm.\$userModel", $userModel->toArray());
        Log::debug("AuthController.submitLoginForm.\$loginSessionModel", ['email' => $userModel->email]);

        /**
         * @var \App\Models\LoginSession
         */
        $loginSessionModel = LoginSession::select()->where(["email" => $userModel->email])->first();

        if ($loginSessionModel === null) {
            # code...
            $loginSessionModel = LoginSession::create(["email" => $userModel->email, "expired_at" => Carbon::now()->addDays(7)]);
        }

        Log::debug("AuthController.submitLoginForm.\$loginSessionModel", ['email' => $loginSessionModel->email]);
        Log::debug("AuthController.submitLoginForm.\$loginSessionModel->toArray()", $loginSessionModel->toArray());

        $expiredAtMillis = $loginSessionModel->getExpiredAtMillis();

        if ($loginSessionModel->getExpiredAtMillis() < Carbon::now()->valueOf()) {
            $loginSessionModel->update(["expired_at" => Carbon::now()->addDays(7)]);
        }

        $expiredAtMillis = $loginSessionModel->getExpiredAtMillis();
        $currentMillis = Carbon::now()->valueOf();
        $cookieDurationInEpoch = $expiredAtMillis - $currentMillis;
        var_dump($expiredAtMillis);
        var_dump($currentMillis);
        var_dump($cookieDurationInEpoch);


        if (!Hash::check($loginInput['password'], $userModel->password)) {
            return back()->withErrors([
                "password" => "Password did not match.",
            ])->withInput();
        }

        /**
         * @var float
         */
        $minutesCookieDuration = $cookieDurationInEpoch / 1000 / 60;

        /**
         * @var int
         */
        $minutesCookieDuration = (int) $minutesCookieDuration;

        var_dump($minutesCookieDuration);

        /**
         * @var int
         */
        $duration = 60 * 24 * 7 + 120;
        $duration = $minutesCookieDuration + 150 -24;
        var_dump($duration);

        $cookie = cookie("X-LOGIN-TOKEN", "$loginSessionModel->email", $duration);
        return redirect()->route('home')->withCookie($cookie);
    }

    public function logout(Request $request)
    {
        /**
         * @var \App\Models\LoginSession
         */
        $userHasSessionModel = LoginSession::select()->where("email", "=", $request->cookie("X-LOGIN-TOKEN"))->first();
        $userHasSessionModel->forceDelete();
        return redirect()->action([AuthController::class, "loginForm"])->withCookie(cookie("X-LOGIN-TOKEN", "", -1));
    }
}
