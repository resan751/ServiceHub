<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Update User</title>
    @vite('resources/css/app.css')
    <link href='https://unpkg.com/boxicons@2.1.4/css/boxicons.min.css' rel='stylesheet'>
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Plus+Jakarta+Sans:ital,wght@0,200..800;1,200..800&display=swap"
        rel="stylesheet">
    <style>
        * {
            margin: 0;
            padding: 0;
        }
    </style>
</head>

<body class="font-jakarta bg-black3">
    <div class="back absolute mt-1 ml-1 ">
        <button class="text-white5 bg-black4 p-1 text-center mt-1 ml-1 rounded-md  hover:text-black3 hover:bg-white5 transition-colors duration-500">
            <i class='bx bx-left-arrow-alt'></i>
            <a href="{{ route('dashboard.index') }}">back</a>
        </button>
    </div>
    <div class="flex justify-center">
        <div class="main bg-black4 w-3/6 h-[34rem] mt-16 rounded-3xl justify-center flex pb-8">
            <div class="main-back w-11/12">
                <div class="main-head p-3 pb-5 text-4xl font-semibold text-center text-white">
                    <h1>UPDATE USER</h1>
                </div>
                <div class="icon text-center text-white5 font-bold">
                    <i class='bx bxs-edit-alt text-9xl'></i>
                </div>
                <form action="{{ route('dashboard.update', $User->id_user) }}" method="POST">
                    @csrf
                    @method('PUT')
                    <div class="main-menu">
                        <div class="main-input mt-3">
                            <input type="text"
                                placeholder="Username"
                                name="username"
                                value="{{ old('username', $User->username) }}"
                                class="w-full h-9 rounded-lg @error('username') border-red-500 @enderror">
                            @error('username')
                                <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
                            @enderror
                        </div>

                        <div class="main-input mt-5">
                            <select name="role" class="w-full h-9 rounded-lg @error('role') border-red-500 @enderror">
                                <option value="">Pilih Role</option>
                                <option value="admin" {{ old('role', $User->role) == 'admin' ? 'selected' : '' }}>Admin</option>
                                <option value="user" {{ old('role', $User->role) == 'user' ? 'selected' : '' }}>User</option>
                            </select>
                            @error('role')
                                <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
                            @enderror
                        </div>

                        <div class="main-input mt-5">
                            <input type="email"
                                placeholder="Email"
                                name="email"
                                value="{{ old('email', $User->email) }}"
                                class="w-full h-9 rounded-lg @error('email') border-red-500 @enderror">
                            @error('email')
                                <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
                            @enderror
                        </div>

                        <div class="main-input mt-5">
                            <input type="password"
                                id="password" placeholder="Password" name="password" class="w-full h-9 rounded-lg @error('password') border-red-500 @enderror">
                            @error('password')
                                <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
                            @enderror
                        </div>

                        <button class="text-black3 absolute top-[27.6rem] left-[59.5rem] text-4xl" type="button" onclick="togglePassword()">
                            <i id="eyeIcon" class='bx bx-show'></i>
                        </button>
                        <div class="main-btn w-full h-10 p-2 mt-16 bg-black3 text-white5 hover:text-black3 hover:bg-white5 rounded-lg text-center transition-colors duration-500">
                            <button class="w-full" type="submit">Update</button>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>
</body>
<script>
    function togglePassword() {
        let passwordField = document.getElementById("password");
        let eyeIcon = document.getElementById("eyeIcon");

        if (passwordField.type === "password") {
            passwordField.type = "text";
            eyeIcon.classList.replace('bx-show', 'bx-hide'); // Ganti ikon jadi mata tertutup
        } else {
            passwordField.type = "password";
            eyeIcon.classList.replace('bx-hide', 'bx-show'); // Ganti ikon jadi mata terbuka
        }
    }
</script>
</html>
