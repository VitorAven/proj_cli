

<html>

    <head>
        <!-- testeConfiguração de Charset -->
        <meta charset='utf-8' />
        <meta http-equiv='X-UA-Compatible' content='IE=edge'>
        <!-- Título da Página -->
        <title>Lelui</title>
        <!-- Meta Tags -->
        <meta name='description' content='' />
        <meta name='viewport' content='width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no' />
        <!-- Ícones -->

        <link rel='apple-touch-icon' href='apple-touch-icon.png' />
        <!-- Meta Tags Open Graph -->

        <meta property='og:locale' content='pt_BR' />
        <meta property='og:url' content='http://www.lelui.com.br ' />
        <meta property='og:title' content='lelui' />
        <meta property='og:site_name' content='lelui' />
        <meta property='og:description' content='lelui' />
        <meta property='og:image' content='/facebook.jpg' />
        <meta property='og:image:type' content='image/jpeg' />
        <meta property='og:image:width' content='800' />
        <meta property='og:image:height' content='600' />


        <link rel="stylesheet" href="http://fontawesome.io/assets/font-awesome/css/font-awesome.css">
        <script src="https://code.jquery.com/jquery-2.2.4.min.js"></script>
        <style type="text/css" >
            * {
                margin: 0;
                border:0;
                padding: 0;
            }
            body {
                overflow:hidden;
                background-img: Url('Pagina_Construcao.jpg');

            }
            i{
                display: inline-block;
                color: #3B579D;

            }
            .face{    text-align: center;
                      width: 100%;
                      top: 94%;
                      position: absolute;
                      font-size: 50px;
            }
            #content {
                background-position: top center;
                background-repeat: no-repeat;

            }
        </style>

    </head>

    <body>

        <script>
            $(document).ready(function () {
                height = window.screen.availHeight - 60;
                $("#lelui").css("height", height);
                $(document).resize(function () {
                    height = window.screen.availHeight - 60;
                    $("#lelui").css("height", height);

                });

            });

        </script>
        <div class='face'><i class="fa fa-facebook-official" aria-hidden="true"></i></div>
        <img src='Pagina_Construcao.jpg' id="lelui" style='width: 100%' />
    </body>

</html>