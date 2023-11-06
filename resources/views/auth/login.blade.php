<x-guest-layout>


    <!-- component -->
    <link rel="stylesheet" href="https://kit-pro.fontawesome.com/releases/v5.15.1/css/pro.min.css" />
    
    <div class="min-h-screen flex flex-col items-center justify-center bg-gray-200">
      <div class="flex flex-col bg-white shadow-md px-4 sm:px-6 md:px-8 lg:px-10 py-8 rounded-md w-full max-w-md">
        <div class="font-medium self-center text-xl sm:text-2xl uppercase text-gray-800 justify-center text-center">
            <img class=" ml-28 my-3" src="{{ url('img/utpp.png') }}" style="width: 100px" />
            <h1 class=" font-mono ">Inicio de Sesion FeriaUTP</h1>
        </div>
        <hr class="mt-6 border-b-4 border-gray-700">
        <x-validation-errors class="mb-4" />
    
    
        <div class="mt-5">
          <form method="POST" action="{{ route('login') }}">
            @csrf
            <div class="flex flex-col mb-6">
              <label for="email" class="mb-1 text-xs sm:text-sm tracking-wide text-gray-600">Correo Electronico:</label>
              <div class="relative">
                <div class="inline-flex items-center justify-center absolute left-0 top-0 h-full w-10 text-gray-400">
                  <svg class="h-6 w-6" fill="none" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" viewBox="0 0 24 24" stroke="currentColor">
                    <path d="M16 12a4 4 0 10-8 0 4 4 0 008 0zm0 0v1.5a2.5 2.5 0 005 0V12a9 9 0 10-9 9m4.5-1.206a8.959 8.959 0 01-4.5 1.207" />
                  </svg>
                </div>
    
                <input id="email" type="email" name="email" :value="old('email')" required autofocus autocomplete="username" class="text-sm sm:text-base placeholder-gray-500 pl-10 pr-4 rounded-lg border border-gray-400 w-full py-2 focus:outline-none focus:border-green-800 focus:ring-green-800" placeholder="Correo Electronico" />
              </div>
            </div>
            <div class="flex flex-col mb-6">
              <label for="password" class="mb-1 text-xs sm:text-sm tracking-wide text-gray-600">Password:</label>
              <div class="relative">
                <div class="inline-flex items-center justify-center absolute left-0 top-0 h-full w-10 text-gray-400">
                  <span>
                    <svg class="h-6 w-6" fill="none" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" viewBox="0 0 24 24" stroke="currentColor">
                      <path d="M12 15v2m-6 4h12a2 2 0 002-2v-6a2 2 0 00-2-2H6a2 2 0 00-2 2v6a2 2 0 002 2zm10-10V7a4 4 0 00-8 0v4h8z" />
                    </svg>
                  </span>
                </div>
    
                <input id="password" type="password" name="password" required autocomplete="current-password"  class="text-sm sm:text-base placeholder-gray-500 pl-10 pr-4 rounded-lg border border-gray-400 w-full py-2 focus:outline-none focus:border-green-800 focus:ring-green-800" placeholder="Password" />
              </div>
            </div>
    
            <div class="flex items-center mb-6 -mt-4">
              <div class="flex">
                <div class="block mt-4">
                    <label for="remember_me" class="flex items-center">
                        <x-checkbox id="remember_me" name="remember" />
                        <span class="ml-2 text-sm text-gray-600">{{ __('Recordar Sesion') }}</span>
                        {{-- <a href="#" class=" pl-20 inline-flex text-xs sm:text-sm text-green-800 hover:text-red-900">Forgot Your Password?</a> --}}
                        @if (Route::has('password.request'))
                        <a class=" pl-20 inline-flex text-xs sm:text-sm text-green-800 hover:text-red-900 " href="{{ route('password.request') }}">
                            {{ __('Forgot your password?') }}
                        </a>
                    @endif
                    </label>
                </div>
              </div>
            </div>
    
            <div class="flex w-full">
              <button type="submit" class="flex items-center justify-center focus:outline-none text-white text-sm sm:text-base bg-green-800 hover:bg-red-900 rounded py-2 w-full transition duration-150 ease-in">
                <span class="mr-2 uppercase font-mono">Iniciar Sesion</span>
                <span>
                  <svg class="h-6 w-6" fill="none" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" viewBox="0 0 24 24" stroke="currentColor">
                    <path d="M13 9l3 3m0 0l-3 3m3-3H8m13 0a9 9 0 11-18 0 9 9 0 0118 0z" />
                  </svg>
                </span>
              </button>
            </div>
          </form>
        </div>
    
      </div>
    </div>
    
    
    </x-guest-layout>
    
    
    