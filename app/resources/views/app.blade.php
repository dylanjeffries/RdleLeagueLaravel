<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="UTF-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <link href="/css/app.css" rel="stylesheet">
        <title>Rdle League</title>
    </head>

    <body class="font-sans">

        {{-- Header --}}
        <header class="border-b-2 border-lightgray">
            <h1 class="mx-auto my-0 text-5xl text-center w-fit">RDLE LEAGUE</h1>
        </header>

        {{-- Main --}}
        <main class="w-11/12 max-w-720 mx-auto my-5 flex gap-x-5">
            <section class="grow flex flex-col flex-grow gap-6">
                <table class="flex-auto text-center border-black border-collapse height-min">
                    <caption class="p-2.5 font-bold font-4xl bg-wordle-green text-white">WORDLE</caption>
                    <tr class="leading-10">
                        <th class="font-xl border-black border-2 border-t-0 border-collapse">Name</th>
                        <th class="font-xl border-black border-2 border-t-0 border-collapse">Points</th>
                    </tr>
                    @foreach ($wordle as $row)
                        <tr class="leading-10">
                            <td class="font-xl border-black border-2 border-t-0 border-collapse">{{ $row->name }}</td>
                            <td class="font-xl border-black border-2 border-t-0 border-collapse">{{ $row->points }}</td>
                        </tr>
                    @endforeach
                </table>

                <table class="flex-auto text-center border-black border-collapse height-min">
                    <caption class="p-2.5 font-bold font-4xl bg-nerdle-purple text-white">NERDLE</caption>
                    <tr class="leading-10">
                        <th class="font-xl border-black border-2 border-t-0 border-collapse">Name</th>
                        <th class="font-xl border-black border-2 border-t-0 border-collapse">Points</th>
                    </tr>
                    @foreach ($nerdle as $row)
                        <tr class="leading-10">
                            <td class="font-xl border-black border-2 border-t-0 border-collapse">{{ $row->name }}</td>
                            <td class="font-xl border-black border-2 border-t-0 border-collapse">{{ $row->points }}</td>
                        </tr>
                    @endforeach
                </table>
            </section>

            <aside class="w-4/12">

                {{-- User Logged In --}}
                @if (Auth::user())
                    <div class="flex flex-col py-2.5 px-5 border-4 border-black mb-4">
                        <h3>Hello, {{ Auth::user()->name }}</h3>
                        <form action="/logout" method="post"
                            class="flex flex-col p-2.5">
                            @csrf
                            <input type="submit" name="submit" value="Logout"
                                class="w-full mt-0.5 mb-4 bg-sharp-blue">
                        </form>
                        @if (Auth::user()->canSubmitWordle)
                            <a href="/submitwordle"
                                class="m-y-1.5 p-5 b-0 text-base font-semibold">
                                <button>Submit Wordle</button>
                            </a>
                        @endif
                        @if (Auth::user()->canSubmitNerdle)
                            <a href="/submitnerdle"
                                class="m-y-1.5 p-5 b-0 text-base font-semibold">
                                <button>Submit Nerdle</button>
                            </a>
                        @endif
                    </div>
                @else
                {{-- No User Logged In --}}
                    {{-- Sign Up Form --}}  
                    <form action="/signup" method="post"
                        class="flex flex-col py-2.5 px-5 border-4 border-black mb-4">  
                        @csrf
                        <h3 class="bg-white m-0 px-5 w-fit relative -top-5">Sign Up</h3>
                        Name
                        <input type="text" name="name" maxlength="20"
                            class="w-full mt-0.5 mb-4">
                        @error('name', 'signup') {{ $message }} @enderror
                        Email
                        <input type="email" name="email" maxlength="30"
                            class="w-full mt-0.5 mb-4">
                        @error('email', 'signup') {{ $message }} @enderror
                        Password
                        <input type="password" name="password"
                            class="w-full mt-0.5 mb-4">
                        Code
                        <input type="text" name="code"
                            class="w-full mt-0.5 mb-4">
                        <input type="submit" name="submit" value="Sign Up"
                            class="w-full mt-0.5 bg-sharp-blue text-white">
                    </form>

                    {{-- Login Form --}}
                    <form action="/login" method="post"
                        class="flex flex-col py-2.5 px-5 border-4 border-black mb-4">
                        @csrf
                        <h3 class="bg-white m-0 px-5 w-fit relative -top-5">Login</h3>
                        Email
                        <input type="email" name="email" maxlength="30"
                            class="w-full mt-0.5 mb-4">
                        @error('email', 'login') {{ $message }} @enderror
                        Password
                        <input type="password" name="password"
                            class="w-full mt-0.5 mb-4">
                        @error('password', 'login') {{ $message }} @enderror
                        <input type="submit" name="submit" value="Login"
                            class="w-full mt-0.5 mb-4 bg-sharp-blue text-white">
                    </form>
                @endif
                
            </aside>
        </main>
    </body>
</html>