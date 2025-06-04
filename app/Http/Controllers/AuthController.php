<?php

namespace App\Http\Controllers;

use App\Models\LoginSession;
use App\Models\Role;
use App\Models\User;
use App\Models\UserHasRole;
use DB;
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
        $sellerRoleModel = Role::select()
            ->where('role', '=', 'SELLER')
            ->first();

        $sellerIsNotYetAvailableInDatabase = true;

        if ($sellerRoleModel !== null) {
            $sellerIsNotYetAvailableInDatabase = false;
        }

        $userThatIsASellerIsNotYetAvailableInDatabase = true;

        $userThatHasAsellerModel = UserHasRole::select()->where('role_id', '=', $sellerRoleModel->id)->first();

        if ($userThatHasAsellerModel !== null) {
            # code...
            $userThatIsASellerIsNotYetAvailableInDatabase = false;
        }

        return response()
            ->view('auth.registration', [
                "sellerRoleIsNotYetAvailableInDatabase" => $sellerIsNotYetAvailableInDatabase,
                "userThatIsASellerIsNotYetAvailableInDatabase" => $userThatIsASellerIsNotYetAvailableInDatabase,
            ]);
    }

    public function registrationSellerForm()
    {
        $sellerIsNotYetAvailableInDatabase = true;
        $userThatIsASellerIsNotYetAvailableInDatabase = true;

        $sellerRoleModel = Role::select()
            ->where('role', '=', 'SELLER')
            ->first();

        return response()
            ->view('auth.registration-sellers', [
                "sellerRoleIsNotYetAvailableInDatabase" => $sellerIsNotYetAvailableInDatabase,
                "userThatIsASellerIsNotYetAvailableInDatabase" => $userThatIsASellerIsNotYetAvailableInDatabase,
                "role" => $sellerRoleModel->role,
            ]);
    }

    public function loginForm()
    {
        return response()->view('auth.login');
    }

    public function submitRegistrationForm(Request $request)
    {
        $rules = [
            "name" => ["required", "min:8", "max:255"],
            "email" => ["required", "email", "max:255", "unique:uas_users,email"],
            "password" => Password::min(8)
                ->max(255)
                ->mixedCase()
                ->letters()
                ->numbers()
                ->symbols(),
            'agreedTermsOfUse' => ['required']
        ];
        Log::debug(
            "AuthController.submitRegistrationForm.\$registrationInput",
            $rules
        );

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
        Log::debug(
            "AuthController.submitRegistrationForm.\$registrationInput",
            $registrationInput
        );

        /**
         * @var array
         */
        $registrationInputValidated = Validator::validate($registrationInput, $rules);
        Log::debug(
            "AuthController.submitRegistrationForm.\$registrationInputValidated",
            $registrationInputValidated
        );

        /**
         * @var \Illuminate\Validation\Validator
         */
        $validator = Validator::make($registrationInput, $rules);
        if ($validator->fails()) {

            /**
             * @var string[][]
             */
            $registrationErrorMessage = $validator->getMessageBag()->getMessages();
            Log::debug(
                "AuthController.submitRegistrationForm.\$arrayStringMessage",
                $registrationErrorMessage
            );

            return back()->withErrors([
                "name" => $registrationErrorMessage['name'] ?? null,
                "email" => $registrationErrorMessage['email'] ?? null,
                "password" => $registrationErrorMessage['password'] ?? null,
                "agreedTermsOfUse" => $registrationErrorMessage['agreedTermsOfUse'] ?? null,
            ])->withInput();
        }

        DB::transaction(function () use ($registrationInputValidated) {

            /**
             * @var \App\Models\User
             */
            $userCreated = User::create([
                "name" => $registrationInputValidated['name'],
                "email" => $registrationInputValidated['email'],
                "password" => $registrationInputValidated['password'],
            ]);
            Log::debug(
                "AuthController.submitRegistrationForm.\$userCreated",
                $userCreated->toArray()
            );
            Log::info("User created.", $userCreated->toArray());

            /**
             * @var \App\Models\Role | null
             */
            $customerRoleModel = Role::select()->where('role', '=', 'CUSTOMER')->first();

            $logCustomerRoleModel = [];

            if ($customerRoleModel !== null) {
                $logCustomerRoleModel = $customerRoleModel->toArray();
            }

            Log::debug(
                "AuthController.submitRegistrationForm.\$customerRoleModel if context is null, there is not yet customer role.",
                $logCustomerRoleModel
            );

            if ($customerRoleModel === null) {

                /**
                 * @var \App\Models\Role | null
                 */
                $customerRoleModel = Role::create(['role' => 'CUSTOMER']);
                Log::debug(
                    "AuthController.submitRegistrationForm.\$customerRoleModel create new customer role cause there is not yet customer role.",
                    $customerRoleModel->toArray()
                );
            }

            Log::debug(
                "AuthController.submitRegistrationForm.\$customerRoleModel after if statement for \$customerRoleModel.",
                $customerRoleModel->toArray()
            );

            /**
             * @var \App\Models\Role | null
             */
            $sellerRoleModel = Role::select()
                ->where('role', '=', 'SELLER')
                ->first();

            $logSellerRoleModel = [];

            if ($sellerRoleModel !== null) {
                $logSellerRoleModel = $sellerRoleModel->toArray();
            }

            Log::debug(
                "AuthController.submitRegistrationForm.\$sellerRoleModel if context is null, there is not yet seller role.",
                $logSellerRoleModel
            );

            if ($sellerRoleModel === null) {

                /**
                 * @var \App\Models\Role | null
                 */
                $sellerRoleModel = Role::create(['role' => 'SELLER']);
                Log::debug(
                    "AuthController.submitRegistrationForm.\$sellerRoleModel create new customer role cause there is not yet customer role.",
                    $sellerRoleModel->toArray()
                );
            }

            Log::debug(
                "AuthController.submitRegistrationForm.\$sellerRoleModel after if statement for \$sellerRoleModel.",
                $sellerRoleModel->toArray()
            );

            /**
             * @var \App\Models\UserHasRole | null
             */
            $userHasRoleModel = UserHasRole::select()->where('user_id', '=', $userCreated->getId())->first();
            Log::debug(
                "AuthController.submitRegistrationForm.\$userHasRoleModel before checking does the userHasRole with certain exist in databases.",
                $userHasRoleModel ?? []
            );

            if ($userHasRoleModel === null) {

                /**
                 * @var \App\Models\UserHasRole | null
                 */
                $userHasRoleModel = UserHasRole::create(['user_id' => $userCreated->getId(), "role_id" => $customerRoleModel->getId()]);
                Log::debug(
                    "AuthController.submitRegistrationForm.\$userHasRoleModel create customer role for userId $userCreated->id.",
                    $userHasRoleModel->toArray()
                );
            }

            Log::debug(
                "AuthController.submitRegistrationForm.\$userHasRoleModel after if statement for \$userHasRoleModel.",
                $userHasRoleModel->toArray()
            );

        });

        return redirect()->action([AuthController::class, 'loginForm']);
    }

    public function submitRegistrationSellerForm(Request $request)
    {
        $rules = [
            "name" => ["required", "min:8", "max:255"],
            "email" => ["required", "email", "max:255", "unique:uas_users,email"],
            "password" => Password::min(8)
                ->max(255)
                ->mixedCase()
                ->letters()
                ->numbers()
                ->symbols(),
            'role' => ['required', 'exists:uas_roles,role'],
            'agreedTermsOfUse' => ['required']
        ];

        Log::debug(
            "AuthController.submitRegistrationForm.\$registrationInput",
            $rules
        );

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
            'role',
            'agreedTermsOfUse'
        ]);
        Log::debug(
            "AuthController.submitRegistrationForm.\$registrationInput",
            $registrationInput
        );

        /**
         * @var array
         */
        $registrationInputValidated = Validator::validate($registrationInput, $rules);
        Log::debug(
            "AuthController.submitRegistrationForm.\$registrationInputValidated",
            $registrationInputValidated
        );

        /**
         * @var \Illuminate\Validation\Validator
         */
        $validator = Validator::make($registrationInput, $rules);
        if ($validator->fails()) {

            /**
             * @var string[][]
             */
            $registrationErrorMessage = $validator->getMessageBag()->getMessages();
            Log::debug(
                "AuthController.submitRegistrationForm.\$arrayStringMessage",
                $registrationErrorMessage
            );

            return back()->withErrors([
                "name" => $registrationErrorMessage['name'] ?? null,
                "email" => $registrationErrorMessage['email'] ?? null,
                "password" => $registrationErrorMessage['password'] ?? null,
                "role" => $registrationErrorMessage['password'] ?? null,
                "agreedTermsOfUse" => $registrationErrorMessage['agreedTermsOfUse'] ?? null,
            ])->withInput();
        }

        DB::transaction(function () use ($registrationInputValidated) {

            /**
             * @var \App\Models\User
             */
            $userCreated = User::create([
                "name" => $registrationInputValidated['name'],
                "email" => $registrationInputValidated['email'],
                "password" => $registrationInputValidated['password'],
            ]);
            Log::debug(
                "AuthController.submitRegistrationForm.\$userCreated",
                $userCreated->toArray()
            );
            Log::info("User created.", $userCreated->toArray());



            /**
             * @var \App\Models\Role | null
             */
            $sellerRoleModel = Role::select()->where('role', '=', $registrationInputValidated['role'])->first();

            $logCustomerRoleModel = [];
            if ($sellerRoleModel !== null) {
                $logCustomerRoleModel = $sellerRoleModel->toArray();
            }
            Log::debug(
                "AuthController.submitRegistrationForm.\$sellerRoleModel if context is null, there is not yet seller role.",
                $logCustomerRoleModel
            );

            if ($sellerRoleModel === null) {

                /**
                 * @var \App\Models\Role | null
                 */
                $sellerRoleModel = Role::create(['role' => $registrationInputValidated['role']]);
                Log::debug(
                    "AuthController.submitRegistrationForm.\$sellerRoleModel create new seller role cause there is not yet seller role.",
                    $sellerRoleModel->toArray()
                );
            }

            Log::debug(
                "AuthController.submitRegistrationForm.\$sellerRoleModel after if statement for \$sellerRoleModel.",
                $sellerRoleModel->toArray()
            );




            /**
             * @var \App\Models\Role | null
             */
            $sellerRoleModel = Role::select()
                ->where('role', '=', 'SELLER')
                ->first();

            $logSellerRoleModel = [];
            if ($sellerRoleModel !== null) {
                $logSellerRoleModel = $sellerRoleModel->toArray();
            }
            Log::debug(
                "AuthController.submitRegistrationForm.\$sellerRoleModel if context is null, there is not yet seller role.",
                $logSellerRoleModel
            );
            if ($sellerRoleModel === null) {

                /**
                 * @var \App\Models\Role | null
                 */
                $sellerRoleModel = Role::create(['role' => 'SELLER']);
                Log::debug(
                    "AuthController.submitRegistrationForm.\$sellerRoleModel create new customer role cause there is not yet customer role.",
                    $sellerRoleModel->toArray()
                );
            }

            Log::debug(
                "AuthController.submitRegistrationForm.\$sellerRoleModel after if statement for \$sellerRoleModel.",
                $sellerRoleModel->toArray()
            );



            /**
             * @var \App\Models\UserHasRole | null
             */
            $userHasRoleModel = UserHasRole::select()->where('user_id', '=', $userCreated->getId())->first();
            Log::debug(
                "AuthController.submitRegistrationForm.\$userHasRoleModel before checking does the userHasRole with certain exist in databases.",
                $userHasRoleModel ?? []
            );

            if ($userHasRoleModel === null) {

                /**
                 * @var \App\Models\UserHasRole | null
                 */
                $userHasRoleModel = UserHasRole::create(['user_id' => $userCreated->getId(), "role_id" => $sellerRoleModel->getId()]);
                Log::debug(
                    "AuthController.submitRegistrationForm.\$userHasRoleModel create customer role for userId $userCreated->id.",
                    $userHasRoleModel->toArray()
                );
            }

            Log::debug(
                "AuthController.submitRegistrationForm.\$userHasRoleModel after if statement for \$userHasRoleModel.",
                $userHasRoleModel->toArray()
            );

        });

        return redirect()->action([AuthController::class, 'loginForm']);
    }

    public function submitLoginForm(Request $request)
    {
        /**
         * @var array
         */
        $rules = [
            "email" => ["required", "max:255", "exists:uas_users,email"],
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
        Log::debug(
            "AuthController.submitLoginForm.\$loginInput",
            $loginInput
        );

        /**
         * @var \Illuminate\Validation\Validator
         */
        $validator = Validator::make($loginInput, $rules);
        if ($validator->fails()) {

            /**
             * @var string[][]
             */
            $loginErrorMessage = $validator->getMessageBag()->getMessages();
            Log::debug(
                "AuthController.submitLoginForm.\$loginErrorMessage",
                $loginErrorMessage
            );

            return back()->withErrors([
                "email" => $loginErrorMessage['email'] ?? null,
                "password" => "Password can't be validated without registered email.",
            ])->withInput();
        }

        /**
         * @var array
         */
        $loginInputValidated = Validator::validate($loginInput, $rules);
        Log::debug(
            "AuthController.submitLoginForm.\$loginInputValidated",
            $loginInputValidated
        );

        /**
         * @var \App\Models\User
         */
        $userModel = User::select()->where('email', '=', $loginInputValidated['email'])->first();
        Log::debug(
            "AuthController.submitLoginForm.\$userModel",
            $userModel->toArray()
        );
        Log::debug(
            "AuthController.submitLoginForm.\$loginSessionModel",
            ['email' => $userModel->email]
        );

        /**
         * @var \App\Models\LoginSession
         */
        $loginSessionModel = LoginSession::select()->where(["email" => $userModel->email])->first();

        if ($loginSessionModel === null) {
            # code...
            $loginSessionModel = LoginSession::create(["email" => $userModel->email, "expired_at" => Carbon::now()->addDays(7)]);
        }

        Log::debug(
            "AuthController.submitLoginForm.\$loginSessionModel",
            ['email' => $loginSessionModel->email]
        );
        Log::debug(
            "AuthController.submitLoginForm.\$loginSessionModel->toArray()",
            $loginSessionModel->toArray()
        );

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
        $duration = $minutesCookieDuration + 150 - 24;
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
