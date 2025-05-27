<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>{{ $title ?? "Registration" }}</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous" />
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"
        integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz"
        crossorigin="anonymous"></script>
</head>

<body>
    <div class="mt-3">

        <div class="container-fluid container-md">
            <div class="col-auto col-sm-8 offset-sm-2 col-lg-6 offset-lg-3">

                <form id="myForm" method="post" class="border rounded-3" novalidate>
                    @csrf
                    <div class="p-4">
                        <!-- header form -->
                        <h1 class="mb-4 text-center text-secondary">{{ $header ?? "Registration" }}</h1>
                        <!-- end header form -->

                        <!-- Name input -->
                        <div class="form-floating mb-3">
                            <input class="form-control" name="name" id="name" type="text" value="{{ old("name") }}"
                                placeholder="name" autocomplete="true" required />
                            <label for="name">Name</label>

                            <div class="d-flex w-100 justify-content-between">
                                <div id="" class="form-text">Pick Your Name Here!</div>
                                <div id="" class="form-text">Example: Saya Lorem Ipsum.</div>
                            </div>

                            <!-- name error message -->
                            @if ($errors->has('name'))
                                <div class="text-danger">{{ $errors->first('name') }}</div>
                            @endif
                            <!-- end name error message -->
                        </div>
                        <!-- end Name input  -->



                        <!-- email input -->
                        <div class="form-floating mb-3">
                            <input class="form-control" name="email" id="email" type="text" placeholder="email"
                                value="{{ old("email") }}" autocomplete="true" required />
                            <label for="email">Email</label>

                            <div class="d-flex w-100 justify-content-between">
                                <div id="" class="form-text">Pick Your Email Here!</div>
                                <div id="" class="form-text">Example: iamlucky@gmail.com</div>
                            </div>

                            <!-- email error message -->
                            @if ($errors->has('email'))
                                <div class="text-danger">{{ $errors->first('email') }}</div>
                            @endif
                            <!-- end email error message -->
                        </div>
                        <!-- end of email input  -->



                        <!-- password input  -->
                        <div class="form-floating mb-3">
                            <input class="form-control" name="password" id="password" type="text" placeholder="password"
                                value="{{ old("password") }}" autocomplete="true" required />
                            <label for="password">Password</label>

                            <div id="" class="form-text">Example: iamLucky@12345</div>

                            <!-- password error message -->
                            @if ($errors->has('password'))
                                <div class="text-danger">{{ $errors->first('password') }}</div>
                            @endif
                            <!-- end password error message -->
                        </div>
                        <!-- end of password input  -->

                        <!-- term of use input -->
                        <div class="form-check">
                            <div class="mb-3">

                                <input class="form-check-input" type="checkbox" name="agreedTermsOfUse"
                                    id="terms-of-use-check" required />
                                <label for="terms-of-use-check" class="form-check-label">Terms of Use</label>

                                <!-- terms of use error message -->
                                @if ($errors->has('agreedTermsOfUse'))
                                    <div class="text-danger">{{ $errors->first('agreedTermsOfUse') }}</div>
                                @endif
                                <!-- end terms of use error message -->
                            </div>
                        </div>
                        <!-- end of term of use input  -->



                        <!-- button submit input -->
                        <div class="form-floating mb-3">
                            <button type="submit" class="btn btn-outline-secondary w-100">Sign Up</button>
                        </div>
                        <!-- end of button submit input -->

                        <div class="form-floating text-center">
                            <p>
                                Sudah punya akun?
                                <a class="text-secondary link-underline link-underline-opacity-0" href="{{ url()->route('login') }}">
                                    Login disini.
                                </a>
                            </p>
                        </div>

                        <div class="form-floating text-center">
                            <p>
                                Sistem Informasi Peminjaman Ruangan
                            </p>
                        </div>
                    </div>
                </form>

            </div>

        </div>

    </div>
    <script>
        // document.addEventListener("DOMContentLoaded", function () {
        //     // Ambil semua input dalam form
        //     let inputs = document.querySelectorAll("#myForm input, #myForm password");

        //     // Cek apakah ada data tersimpan, lalu isi kembali
        //     inputs.forEach(input => {
        //         let savedValue = localStorage.getItem(input.id);
        //         if (savedValue) {
        //             input.value = savedValue;
        //         }

        //         // Simpan value setiap kali berubah
        //         input.addEventListener("input", function () {
        //             localStorage.setItem(input.id, input.value);
        //         });
        //     });

        //     // Hapus data saat form dikirim
        //     // document.getElementById("myForm").addEventListener("submit", function () {
        //     //     localStorage.clear();
        //     // });
        // });
    </script>
</body>

</html>