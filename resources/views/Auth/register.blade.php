@extends('layout.auth')

@section('title', 'Register')

@section('isi')
    <div
        class="flex min-h-full flex-col justify-center items-center bg-cover bg-center bg-no-repeat bg-[url(/public/images/background.jpg)]">
        <div class="sm:w-[420px] w-full p-4 rounded-4xl bg-white">
            <div class="sm:mx-auto sm:w-full sm:max-w-sm">
                <h2 class="text-center font-bold tracking-tight text-gray-900 font-[Darumadrop_One] text-5xl">
                    Register
                </h2>
            </div>

            <div class="mt-10 sm:mx-auto sm:w-full sm:max-w-sm">
                <form class="space-y-6" action="/register/create" method="POST">
                    @csrf

                    <div class="px-10 sm:px-16">
                        <label for="email" class="block text-sm/6 font-medium text-gray-900">Email</label>
                        <div class="mt-2 flex items-center gap-2 border-b border-gray-300">
                            <i class='bx bx-envelope text-xl text-gray-500'></i>
                            <input type="email" name="email" id="email" autocomplete="email"
                                placeholder="Type your Email" class="w-full sm:text-base text-sm focus:outline-none"
                                value="{{ old('email') }}">
                        </div>
                        @if ($errors->has('email'))
                            <p class="mt-1 text-sm text-red-500 font-medium">{{ $errors->first('email') }}</p>
                        @endif
                    </div>


                    <div class="px-10 sm:px-16">
                        <label for="password" class="block text-sm/6 font-medium text-gray-900">Password</label>
                        <div class="mt-2 flex items-center gap-2 border-b border-gray-300">
                            <i class='bx bx-lock-alt text-xl text-gray-500'></i>
                            <input type="password" name="password" id="password" autocomplete="current-password"
                                placeholder="Type your Password"
                                class="w-full sm:text-base text-sm focus:outline-none py-2">
                        </div>
                        @if ($errors->has('password'))
                            <p class="mt-1 text-sm text-red-500 font-medium">{{ $errors->first('password') }}</p>
                        @endif
                    </div>

                    <div class="flex justify-center">
                        <button type="submit"
                            class="cursor-pointer w-1/3 max-w-xs rounded-md bg-yellow-300 px-3 py-1.5 text-sm font-semibold text-black shadow hover:bg-yellow-400 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-yellow-500">
                            Register
                        </button>
                    </div>

                </form>

                <p class="mt-10 text-center text-sm/6 text-gray-500">
                    Already have an account
                    <a href="/login" class="font-semibold text-indigo-600 hover:text-indigo-500">Sign in here</a>
                </p>
            </div>
        </div>
    </div>
@endsection
