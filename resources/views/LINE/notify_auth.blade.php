<!DOCTYPE html>
<html>
<head>
    <title>暨大最新公告 LINE Notify</title>
    <link rel="icon" href="https://moli.rocks/favicon.ico"/>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css">
    <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.6.3/css/all.css">
    <style>
        html {
            position: relative;
            min-height: 100%;
        }

        body {
            margin-bottom: 150px; /* Margin bottom by footer height */
        }

        .line-logo {
            width: 150px;
        }

        .tg-logo {
            width: 50px;
        }

        .fb-logo {
            width: 50px;
        }

        .center-text {
            text-align: center;
            vertical-align: center;
        }

        .padding-top {
            padding-top: 1em;
        }

        .footer {
            position: absolute;
            bottom: 0;
            width: 100%;
            height: 150px; /* Set the fixed height of the footer here */
        }

        .button-apply {
            background-color: #4CAF50;
            border: 2px solid #4CAF50;
            color: white;
            padding: 16px 32px;
            text-align: center;
            text-decoration: none;
            display: inline-block;
            font-size: 16px;
            margin: 4px 2px;
            -webkit-transition-duration: 0.4s; /* Safari */
            transition-duration: 0.4s;
            cursor: pointer;
        }

        .button-apply:hover {
            background-color: white;
            color: black;
        }

        @media (prefers-color-scheme: dark)
        {
            body {
                background-color: #2a2a2e;
                color: #cfcfd1;
            }

            .button-apply {
                background-color: #4CAF50;
                border: 2px solid #4CAF50;
                color: white;
            }

            .button-apply:hover {
                background-color: #2a2a2e;
                color: #4CAF50;
            }
        }
    </style>
</head>
<body>
    <div class="container">
        <div class="row padding-top">
            <div class="col center-text">
                <img class="line-logo" src="{{ asset('img/LINE_APP_logo.png') }}" alt="LINE logo">
            </div>
        </div>
        @if (isset($success) && $success == true)
            <div class="row padding-top">
                <div class="col center-text">
                    <h1>恭喜完成連動！</h1>
                </div>
            </div>
            <div class="row padding-top">
                <div class="col center-text">
                    <h1>請查看 LINE 通知，並確認 LINE Notify 並沒有被封鎖！</h1>
                </div>
            </div>
        @elseif (isset($error))
            <div class="row padding-top">
                <div class="col center-text">
                    <h1>發生錯誤！</h1>
                </div>
            </div>
            <div class="row padding-top">
                <div class="col center-text">
                    <h2>錯誤代碼：{{ $error }}</h2>
                </div>
            </div>
            <div class="row padding-top">
                <div class="col center-text">
                    <p>如問題持續發生，請聯絡 MOLi 實驗室，並且告知錯誤代碼</p>
                    <p>If the problem continues, please contact the MOLi Lab and tell us Error Code</p>
                </div>
            </div>
            <div class="row padding-top">
                <div class="col center-text">
                    <a href="{{ Route('line_notify_auth') }}"><button class="button-apply">重新嘗試連動</button></a>
                </div>
            </div>
        @else
            <div class="row padding-top">
                <div class="col center-text">
                    <h2>點擊按鈕後，選取「透過1對1聊天接收LINE Notify的通知」，並且同意連動</h2>
                </div>
            </div>
            <div class="row padding-top">
                <div class="col center-text">
                    <div class="alert alert-danger" role="alert">
                        切勿重複申請，會造成同樣訊息多次收到。
                    </div>
                </div>
            </div>
            <div class="row padding-top">
                <div class="col center-text">
                    <button class="button-apply" onclick="oAuth2();">點此申請暨大最新公告 LINE Notify</button>
                </div>
            </div>
            <div class="row padding-top">
                <div class="col center-text">
                    <a href="https://notify-bot.line.me/my/">
                        <button class="btn btn-outline-danger">點此取消連動通知</button>
                    </a>
                </div>
            </div>
            <div class="row padding-top">
                <div class="col center-text">
                    <img width="50%" src="{{ asset('img/LINE_Notify_Sample.jpg') }}">
                </div>
            </div>
        @endif
    </div>
    <footer class="footer">
        <div class="container padding-top">
            <div class="row">
                <div class="col center-text">
                    聯絡我們 Contact Us
                </div>
            </div>
            <div class="row">
                <div class="col-12 col-md-7 padding-top">
                    <P>服務供應商：MOLi 實驗室</P>
                    <P>南投縣埔里鎮大學路 470 號管理學院 237 室</P>
                </div>
                <div class="col-12 col-md-2 center-text">
                    <a href="https://telegram.me/MOLi_rocks" target="_blank">
                        <img class="tg-logo" src="{{ asset('img/telegram_logo.png') }}" alt="Telegram logo">
                    </a>
                    <p>Telegram</p>
                </div>
                <div class="col-12 col-md-3 center-text">
                    <a href="https://www.facebook.com/MOLi.rocks" target="_blank">
                        <img class="fb-logo" src="{{ asset('img/facebook_logo.png') }}" alt="Facebook logo">
                    </a>
                    <p>Facebook</p>
                </div>
            </div>
        </div>
    </footer>

    <script src="https://code.jquery.com/jquery-3.3.1.slim.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.7/umd/popper.min.js"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.min.js"></script>
    @if (isset($client_id) && isset($redirect_uri))
        <script>
            function oAuth2() {
                let URL = 'https://notify-bot.line.me/oauth/authorize?';
                URL += 'response_type=code';
                URL += '&client_id={{ $client_id }}';
                URL += '&redirect_uri={{ $redirect_uri }}';
                URL += '&scope=notify';
                URL += '&state=NO_STATE';
                window.location.href = URL;
            }
        </script>
    @endif
</body>
</html>
