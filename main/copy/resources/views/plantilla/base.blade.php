<!DOCTYPE html>

<html lang="en">



<head>

    <meta charset="UTF-8">

    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <title></title>

    <style>
        * {

            margin: 50px 0px;

            padding: 0;

        }



        body {

            display: flex;

            justify-items: center;

            align-items: center;

            padding: 0;

            margin: auto;

            width: 100%;

            height: 1100px;

        }



        .page-content {

            margin: 0;

            padding: 0;

            position: relative;

        }



        .data {

            margin: 0;

            padding: 50px;

            text-align: justify;

        }



        .backg {

            margin: 0;

            padding: 0px;

            position: fixed;

            top: 0px;

            left: 0px;

            right: 0px;

            width: 100%;

            height: 100%;

            z-index: -1;

        }



        .centrado {

            margin-top: 150px;

            text-align: center;

            padding: 8px;

        }



        .centrado-dirigido {

            text-align: center;

            padding-left: 50px;

            padding-right: 20px;

            padding-bottom: 20px;

        }



        p {

            margin: 20px 20px;

            text-align: justify;

        }



        center {

            margin: 16px 0;

        }



        .w-100 {

            margin: 80px 0;

            width: 100% !important
        }



        footer {

            position: absolute;

            bottom: 0;

        }
    </style>



</head>



<body>



    <div class="page-content centrado-dirigido">



        <img class="backg" src="https://bolsadeempleo.itc.edu.co/img/header.jpg" alt="">



        <p class="centrado" style="text-transform: uppercase; font-weight:bold; visibility: hidden; ">
            {{ $formato->nombre }}</p>



        {!! $formato->html !!}



    </div>



</body>



</html>
