<?php
include './../inc/session.php';
include './../inc/File.php';
include './../inc/Account.php';
include './../inc/DBconn.php';


$isAuth = isLoggedIn();
if ($isAuth == false) {
    header('Location: ./../login/');
    exit();
}

$conn = new DBConnection(NULL);
$account = new Account($conn, $_SESSION['id']);
$files = $account->files($_SESSION['id']);

$files = $files['data'];


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

<body>
    <header class="bg-white shadow-sm w-full fixed z-10  top-0 ">
        <div class="max-auto  px-8 py-2 bg-white">
            <div class="flex justify-between">
                <div class="logo flex items-center space-x-4 mr-10">
                    <a href="/storage/" class="flex items-center">
                        <h1 class="font-bold text-3xl">Share<span class="text-gray-500 ">lock</span></h1>
                        <svg xmlns="http://www.w3.org/2000/svg" class="h-10 w-10" viewBox="0 0 20 20" fill="currentColor">
                            <path d="M15 8a3 3 0 10-2.977-2.63l-4.94 2.47a3 3 0 100 4.319l4.94 2.47a3 3 0 10.895-1.789l-4.94-2.47a3.027 3.027 0 000-.74l4.94-2.47C13.456 7.68 14.19 8 15 8z" />
                        </svg>

                    </a>
                </div>
                <div class="flex-1 ml-8">
                    <div class="w-full inline-flex">
                        <input type="text" placeholder="Search sharelock Studio" class="w-full rounded-md text-gray-800 bg-gray-100 
                focus:outline-none py-3 px-10 max-w-xl text-md focus:text-gray-800">
                        <svg class="h-5  mt-4 px-4  absolute  text-gray-700" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z" />
                        </svg>
                    </div>
                </div>

                <div class=" menu flex justify-end  items-center  flex-1 space-x-4">
                    <svg xmlns="http://www.w3.org/2000/svg" class="h-7 w-7 text-gray-500" viewBox="0 0 20 20" fill="currentColor">
                        <path fill-rule="evenodd" d="M3 3a1 1 0 00-1 1v12a1 1 0 102 0V4a1 1 0 00-1-1zm10.293 9.293a1 1 0 001.414 1.414l3-3a1 1 0 000-1.414l-3-3a1 1 0 10-1.414 1.414L14.586 9H7a1 1 0 100 2h7.586l-1.293 1.293z" clip-rule="evenodd" />
                    </svg>

                </div>
            </div>
        </div>
    </header>

    <div class="grid grid-cols-12 mt-20">
        <div class="col-span-4 bg-white h-screen py-5  w-60">
            <div class="mt-5">
                <div class="bg-black mr-50  pl-6 py-3 font-semibold">
                    <button class="text-white text-sm font-semibold flex items-center  focus:outline-none">
                        <svg class="h-5  px-3" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z" />
                        </svg>
                        Recent</button>

                </div>
                <div class="mt-1  mr-50  pl-6 py-3 font-semibold">
                    <button  class="text-gray-600  text-sm font-semibold flex items-center  focus:outline-none">
                        <svg class="h-6  px-3" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4.354a4 4 0 110 5.292M15 21H3v-1a6 6 0 0112 0v1zm0 0h6v-1a6 6 0 00-9-5.197M13 7a4 4 0 11-8 0 4 4 0 018 0z" />
                        </svg>
                        Public</button>

                </div>

                <div class="mt-1  mr-50  pl-6 py-3 font-semibold">
                    <button class="text-gray-600 text-sm font-semibold flex items-center  focus:outline-none">
                        <svg class="h-6  px-3" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z" />
                        </svg>
                        Eyes only</button>

                </div>
            </div>
        </div>

        <div class="col-span-4 absolute px-4  w-full pr-10">
            <div class="space-x-3 ">
                <a class="bg-black font-bold text-white p-3" href="?p=1">Public</a>
                <a class="bg-black font-bold text-white p-3" href="?p=2">My eyes only</a>
            <div>
            <div class="bg-white ml-64  mt-5">


                <div class="flex justify-between">
                    <h3 class="font-semibold text-gray-500">Your Files</h3>

                </div>

                <div class="flex mt-5 space-x-2">
                    <a href="./../upload/" class="max-w-xs rounded overflow-hidden shadow-lg my-2py-4 border border-gray-300">

                        <svg xmlns="http://www.w3.org/2000/svg" class="h-28 px-8" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                            <path stroke-linecap="round" stroke-linejoin="round" d="M12 4v16m8-8H4" />
                        </svg>
                        <div class="px-2 py-2">
                            <div class="font-semibold text-sm mb-2">Add new file</div>
                            <p class="font-semibold text-gray-400 text-xs">
                                upload now
                            </p>
                        </div>

                    </a>
                    <?php

                    foreach ($files as $file) {
                        echo '
                       
                       <a href="./../share?id='.$file->uid.'" class="max-w-xs rounded overflow-hidden shadow-lg my-2py-4 border border-gray-300">

                        <svg xmlns="http://www.w3.org/2000/svg" class="h-28 px-8 text-gray-300" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                            <path stroke-linecap="round" stroke-linejoin="round" d="M15.172 7l-6.586 6.586a2 2 0 102.828 2.828l6.414-6.586a4 4 0 00-5.656-5.656l-6.415 6.585a6 6 0 108.486 8.486L20.5 13" />
                        </svg>
                        <div class="px-2 py-2">
                            <div class="font-semibold text-sm mb-2">' . $file->uid . '</div>
                            <p class="font-semibold text-gray-400 text-xs">
                              ' . $file->name . '
                            </p>
                        </div>

                    </a>
                       
                       ';
                    }


                    ?>






                </div>

            </div>

        </div>
        <div id="upload_modal" class="hidden w-screen h-screen bg-white absolute top-0 left-0">


        </div>
    </div>


    <style>
        body {
            background-color: white;
        }
    </style>

    <script>
         function pub_(){
             alert('Please');
         }

    </script>

</body>

</html>