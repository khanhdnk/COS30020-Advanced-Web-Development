<!doctype html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/tailwindcss/2.2.19/tailwind.min.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.3/css/all.min.css">
    <link rel="stylesheet" href="style.css">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>About</title>
</head>
<body>
    <nav class=" shadow-lg shadow-gray-300 w-100 px-8 md:px-auto">
        <div class="md:h-16 h-28 mx-auto md:px-4 container flex items-center justify-between flex-wrap md:flex-nowrap">
            <!-- Logo -->
            <div class="text-indigo-500 md:order-1">
                <img width="60" height="60"
                     src="https://img.icons8.com/external-wanicon-lineal-wanicon/64/external-friend-friendship-wanicon-lineal-wanicon.png"
                     alt="external-friend-friendship-wanicon-lineal-wanicon"/>
            </div>
            <!-- Navigation -->
            <div class=" order-3 w-full md:w-auto md:order-2">
                <ul class="flex font-semibold justify-between">
                    <li class="md:px-4 md:py-2 hover:text-gray-400"><a href="friendlist.php">Friend List</a></li>
                    <li class="md:px-4 md:py-2 hover:text-gray-400"><a href="friendadd.php">Friend Add</a></li>
                    <li class="md:px-4 md:py-2 text-purple-600"><a href="about.php">About</a></li>
                </ul>
            </div>
<!--            link back to home page-->
            <div class="order-2 md:order-3">
                <a href="index.php">
                    <button class="bg-black px-4 py-2  text-gray-50 rounded-full flex items-center gap-2">
                        <i class="fas fa-home"></i>
                        <span>Home</span>
                    </button>

                </a>
            </div>
        </div>
    </nav>

    <div class="container mx-auto py-10 flex justify-center items-center ">
        <div class="bg-gray-50 bg-opacity-30 border border-black border-opacity-20 p-3 md:p-10 rounded-lg shadow-lg max-w-2xl">
            <h1 class="h-14 text-transparent bg-clip-text bg-gradient-to-r from-blue-500 via-pink-500 to-blue-500 text-center mb-4 text-2xl font-extrabold leading-none tracking-tight  md:text-3xl lg:text-4xl dark:text-white">
                About this assignment</h1>
            <!--            answers to the requirements of the assignment-->
            <p class="text-lg"><strong>Req 1:</strong></p>
            <ul class="list-disc md:ml-5 ml-3">
                <li class="">I have completed and attempted all tasks</li>
                <li>
                    <p>Some special features that I made:</p>
                    <ul class="list-decimal ml-7">
                        <li>Sanitise inputs</li>
                        <li>Friend detail for friend add page</li>
                    </ul>
                </li>
                <li>I have trouble with the add friends and unfriends features, but I have overcome it</li>
                <li>Next time I will create better UI with interesting animations</li>
                <li>Additional features:
                    <ul class="list-decimal ml-7">
                        <li>Friend details when user click on the name of the friend in the friend add page</li>
                    </ul>
                </li>

            </ul>
<!--            link to pages-->
            <p class="text-lg"><strong>Req 3:</strong></p>
            <ul class="list-disc"> Links to pages:
                <li><a href="friendlist.php" class="underline text-blue-700 block mt-3 w-60">Friend List </a></li>
                <li><a href="friendadd.php" class="underline text-blue-700 block mt-3 w-60">Add Friends</a></li>
                <li><a href="index.php" class="underline text-blue-700 block mt-3 w-60">Home Page </a></li>
            </ul>
            <!--            figure 1 and figure 2 are the screenshots of the discussion page-->
            <p class="text-lg"><strong>Req 3:</strong></p>
            <figure class="my-5">
                <img src="images/discussion.png" alt="discussion1" class="">
                <figcaption class="text-center text-sm">Figure 1: Discussion 1</figcaption>
            </figure>
            <a href="index.php" class="underline text-blue-700 block mt-3 w-60">Return to Home Page <span
                        class="text-xl ">&#x203A</span></a>
        </div>
</body>
</html>