<!DOCTYPE html>
<html>
    <head>
        <!--Output any error we may catch onto its own page (basically our own custom 404 or other error page)-->
        <meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
        <title>Error Code Output</title>
        <link href="css/styles.css" rel="stylesheet">
    </head>
    <body>
        <p style="color: red; font-weight: 800;">
            <?phpecho $error;?>
        </p>
    </body>
</html>