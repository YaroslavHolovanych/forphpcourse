<html>
    <head>
        <meta charset="utf-8">
        <link rel="stylesheet" type="text/css" href="<?php echo route::getBP();?>/css/style.css" >
        <title><?php echo $this->getTitle(); ?></title>
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/css/bootstrap.min.css">
        <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.12.4/jquery.min.js"></script>
        <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/js/bootstrap.min.js"></script>    </head>
    <body>
        <div class="jumbotron">
            <div class="container text-center">
                <h1>Test Shop</h1>
            </div>
        </div>

        <div id="header">
            <?php $this->renderPartialview('menu'); ?>
        </div>
        <div class="container">
            <?php $this->renderView(); ?>
        </div>
        
        <hr style="margin:50px 5px;background-color: black;height: 1px;">
        <footer class="container-fluid text-center">
            <p>Test Shop Copyright</p>
        </footer>
    </body>
</html>