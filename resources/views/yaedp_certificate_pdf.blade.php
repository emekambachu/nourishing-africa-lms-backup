<!DOCTYPE html>
<html>
    <head>
        <meta http-equiv="Content-Type" content="text/html; charset=utf-8"/>
        <style>
            .certificate-bg{
                margin: 0 auto;
                width: 700px;
                height: 722px;
                background-image:  url({{ $data['certificate_image'] }});
            }

            .certificate-name{
                position: absolute;
                top: 35%;
                font-family: sans-serif;
                font-weight: normal;
                font-size: 22px;
                margin: 0 auto;
                width: inherit;
                text-align: center;
            }

            .certificate-date{
                position: absolute;
                top: 57.8%;
                font-size: 14px;
                font-family: monospace, sans-serif;
                margin: 0 auto;
                width: inherit;
                text-align: center;
            }

            .certificate-id{
                position: absolute;
                top: 63%;
                left: 8%;
                font-size: 12px;
                font-family: monospace, sans-serif;
            }
        </style>
    </head>
    <body>
        <div class="certificate-bg">
            <h4 class="certificate-name">{{ $data['name'] }}</h4>
            <h4 class="certificate-date">{{ $data['current_date'] }}</h4>
            <p class="certificate-id"><strong>ID:</strong> {{ $data['certificate_id'] }}</p>
        </div>
    </body>
</html>
