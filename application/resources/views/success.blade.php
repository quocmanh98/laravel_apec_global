<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Document</title>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.6.1/dist/css/bootstrap.min.css" integrity="sha384-zCbKRCUGaJDkqS1kPbPd7TveP5iyJE0EjAuZQTgFLD2ylzuqKfdKlfG/eSrtxUkn" crossorigin="anonymous">
    <style>
        /*======================
    404 page
=======================*/
        *{
            margin: 0 auto;
        }

        .page_404 {
            padding: 40px 0;
            background: #fff;
            font-family: 'Arvo', serif;
        }

        .page_404 img {
            width: 100%;
        }

        .four_zero_four_bg {

            background-image: url(https://cdn.dribbble.com/users/285475/screenshots/2083086/dribbble_1.gif);
            height: 300px;
            background-position: center;
        }


        .four_zero_four_bg h1 {
            font-size: 80px;
        }

        .four_zero_four_bg h3 {
            font-size: 80px;
        }

        .link_404 {
            color: #fff !important;
            padding: 10px 20px;
            background: #39ac31;
            margin: 10px 0;
            display: inline-block;
        }

        .contant_box_404 {
            margin-top: 20px;
        }

    </style>
</head>

<body>
    <section class="page_404">
        <div class="container">
            <div class="row">
                <div class="col-sm-12 ">
                    <div class="col-sm-10 col-sm-offset-1  text-center">
                        <div class="four_zero_four_bg">
                        </div>
                        <div class="contant_box_404">
                            <h3 class="h2">
                                Ứng tuyển thành công !
                            </h3>

                            <label>Công Ty Tập Đoàn Apec Global xác nhận thông tin bạn đã gửi ! <br> Chúng tôi sẽ liên hệ bạn trong thời gian sớm nhất !</label> <br>

                            <a href="{{ url('/') }}" class="link_404">Trang chủ</a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
</body>

</html>
