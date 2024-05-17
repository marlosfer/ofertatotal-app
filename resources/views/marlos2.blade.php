
<!DOCTYPE html>
<html lang="en">
<head>

<meta charset="UTF-8">
<meta http-equiv="X-UA-Compatible" content="IE=Edge">
<meta name="description" content="">
<meta name="keywords" content="">
<meta name="author" content="templatemo">
<meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1">

<title>QUEM SOU EU ??</title>

</head>
    <body >
        <h1>LIVE TODOS OS DIAS</h1>
        <div id="twitch-embed" style="width: 100%; height: 100vh;"></div>

        <!-- Load the Twitch embed script -->
        <script src="https://player.twitch.tv/js/embed/v1.js"></script>

        <!-- Create a Twitch.Player object. This will render within the placeholder div -->
        <script type="text/javascript">
        new Twitch.Player("twitch-embed", {
            channel: "insectoydee"
        });
        </script>
        <style>
            #twitch-embed {
            height: 0;
            position: relative;
            overflow: hidden;
            padding: 0 0 56.25%;
            width: 100%;
            border-radius: 8px;
            }

            #twitch-embed iframe {
            position: absolute;
            height: 55%;
            width: 100%;
            }
        </style>
    </body>
</html>