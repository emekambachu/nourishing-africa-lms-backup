<!DOCTYPE html>
<html>
    <head>
        <meta http-equiv="Content-Type" content="text/html; charset=utf-8"/>
        <style>
            .certificate-bg{
                margin: 0 auto;
                width: 700px;
                height: 569px;
                background-image:  url({{ $data['certificate_image'] }});
            }

            .certificate-name{
                position: absolute;
                top: 23%;
                left: 38%;
                text-align: center;
                font-family: sans-serif;
                font-weight: normal;
                font-size: 30px;
            }

            .certificate-date{
                position: absolute;
                top: 42%;
                left: 11%;
                font-size: 14px;
                font-family: monospace, sans-serif;
            }
        </style>
    </head>
    <body>
        <div class="certificate-bg">
            <h4 class="certificate-name">{{ $data['name'] }}</h4>
            <h4 class="certificate-date">{{ $data['current_date'] }}</h4>
        </div>
    </body>
</html>
