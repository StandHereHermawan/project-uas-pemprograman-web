<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>{{$title ?? "Lapo Marpaigon"}}</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous" />
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"
        integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz"
        crossorigin="anonymous"></script>
</head>

<body>
    <!-- navbar sticky top -->
    <nav class="navbar sticky-top navbar-expand-lg bg-white px-xl-2 shadow">
        <div class="container">

            <div class="col-2 d-flex justify-content-start">
                <form action="{{ url()->route('logout') }}" method="post">
                    @csrf
                    <button type="submit" class="btn btn-outline-dark">
                        Logout
                    </button>
                </form>
            </div>

            <div class="col-auto">
                <h1 class="d-flex justify-content-center text-dark">{{$title ?? "Lapo Marpaigon"}}</h1>
            </div>

            <div class="col-2 d-flex justify-content-end">
                <form action="{{ url()->to('home') }}" method="get">
                    <button type="submit" class="btn btn-outline-dark">
                        Home
                    </button>
                </form>
            </div>

        </div>
    </nav>
    <!-- end of navbar sticky top -->

    <!-- main content -->
    <div class="container-md mt-3">
        <div class="col-auto col-sm-8 offset-sm-2 col-lg-6 offset-lg-3">

            <div class="border p-3 rounded-3">

                <h1 class="text-center text-dark mb-4">Informasi Akun</h1>

                <div class="rounded-3 list-group">

                    <!-- informasi nama -->
                    <div href="#" class="list-group-item list-group-item-action" aria-current="true">
                        <div class="d-flex w-100 justify-content-between">
                            <h5 class="mb-1">
                                Name
                            </h5>
                            <!-- <small class="text-body-secondary">Lorem_ipsum.</small> -->
                        </div>
                        <p class="mb-1">{{ $name ?? "Name not available"}}</p>

                    </div>
                    <!-- end of informasi nama -->

                    <!-- informasi email -->
                    <!-- <div class="list-group-item list-group-item-action"> -->
                    <div class="list-group-item list-group-item-action">

                        <div>
                            <div class="d-flex w-100 justify-content-between">
                                <h5 class="mb-1">Email ter-registrasi</h5>
                                <!-- <small class="text-body-secondary">Lorem_ipsum.</small> -->
                            </div>
                            <p class="mb-1">{{ $email ?? "Email not available" }}</p>

                        </div>

                        <div class="d-flex justify-content-between">

                        </div>
                    </div>
                    <!-- end of informasi email -->


                     <!-- informasi role -->
                      <div class="list-group-item list-group-item-action">

                        <div>
                            <div class="d-flex w-100 justify-content-between">
                                <h5 class="mb-1">Role</h5>
                                <!-- <small class="text-body-secondary">Lorem_ipsum.</small> -->
                            </div>
                            <p class="mb-1">{{ $role ?? "Role not available" }}</p>

                        </div>

                        <div class="d-flex justify-content-between">

                        </div>
                    </div>
                    <!-- end of informasi role -->
                </div>

            </div>

        </div>
    </div>
    <!-- end of main content -->
</body>

</html>