<?php
include './../inc/session.php';
$isAuth = isLoggedIn();
if($isAuth == true) {
    header('Location: ./../storage/');
    exit();
}

?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Sharelock - The modern and fast way to share files with friends for free.</title>
    <script src="https://cdn.tailwindcss.com"></script>
</head>

<body class="bg-white-50 w-screen flex flex-col h-screen">
    <div class="bg-white p-3 ">
        <div class="container mx-auto flex items-center justify-between border-gray border-1 border-b py-5">
            <a href="/" class="flex items-center">
                <h1 class="font-bold text-3xl">Share<span class="text-gray-500 ">lock</span></h1>
                <svg xmlns="http://www.w3.org/2000/svg" class="h-10 w-10" viewBox="0 0 20 20" fill="currentColor">
                    <path d="M15 8a3 3 0 10-2.977-2.63l-4.94 2.47a3 3 0 100 4.319l4.94 2.47a3 3 0 10.895-1.789l-4.94-2.47a3.027 3.027 0 000-.74l4.94-2.47C13.456 7.68 14.19 8 15 8z" />
                </svg>

            </a>
            <div>
                <a class="bg-black px-3 py-3 text-white rounded" href="/signup/">Create account</a>
                <a class="font-bold ml-4" href="/login/">Login / signin</a>
            </div>
        </div>
    </div>
    <div class="container mx-auto flex-1 flex items-center justify-center text-center  ">
        <div class="w-2/4">
            <div class="flex items-center justify-center ">
                <h1 class="font-bold text-sm">Share<span class="text-gray-500 ">lock</span></h1>
                <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" viewBox="0 0 20 20" fill="currentColor">
                    <path d="M15 8a3 3 0 10-2.977-2.63l-4.94 2.47a3 3 0 100 4.319l4.94 2.47a3 3 0 10.895-1.789l-4.94-2.47a3.027 3.027 0 000-.74l4.94-2.47C13.456 7.68 14.19 8 15 8z" />
                </svg>

            </div>
            <h1 class="font-bold text-2xl"> Create <span class="text-purple-600">Account</span> .</h1>
            <p class="text-gray-400">Join the news and simplest way to send or share files online.</p>
            <form method="post" action="./../controllers/Register.php" class="w-full flex-1 space-y-3 mt-5">
                <div class="w-full text-left">
                    <label for="" class="text-sm font-bold text-gray-500">Full Name</label>
                    <input type="text" class="w-full border border-gray-300 p-3 rounded" name="name" placeholder="Full Name" />
                </div>
                <div class="w-full text-left">
                    <label for="" class="text-sm font-bold text-gray-500">Email</label>
                    <input type="text" class="w-full border border-gray-300 p-3 rounded" name="email" placeholder="Email address" />
                </div>
                <div class="w-full text-left">
                    <label for="" class="text-sm font-bold text-gray-500">Password</label>
                    <input type="password" class="w-full border border-gray-300 p-3 rounded" name="password" placeholder="Password" />
                </div>
                <div class="w-full text-left">
                    <label for="" class="text-sm font-bold text-gray-500">Repeat Password</label>
                    <input type="password" class="w-full border border-gray-300 p-3 rounded" name="re_password" placeholder="Repeat Password" />
                </div>
                <button type="submit" name="register_form" class=" bg-purple-600 w-full p-3 text-white font-semibold rounded">Register</button>
            </form>
        </div>

    </div>
    <div>
        <p class="text-center my-2 text-sm ">Developed by <span class="text-purple-600 font-bold">Peniel</span> with ❤️.</p>
    </div>

</body>

</html>