<?php
include 'functions.php';
$key = '1wrQzV7xPW6JD5StjYpeK8SR5syN1LrttcJgIGISUTNI';
?>
<html>

<head>
    <meta charset="utf-8" />
    <meta http-equiv="X-UA-Compatible" content="IE=edge" />
    <title>PHP Demo | Get data from Google Sheet</title>

    <!-- Mobile view -->
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />

    <!-- Google fonts  -->
    <link href="https://fonts.googleapis.com/css?family=Open+Sans:300,300i,400,400i,600,600i,700,700i,800,800i" rel="stylesheet" />
    <link href="https://fonts.googleapis.com/css?family=Roboto:100,100i,300,300i,400,400i,500,500i,700" rel="stylesheet" />
    <link href="https://fonts.googleapis.com/css?family=Yesteryear" rel="stylesheet" />

    <!-- Stylesheets -->
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css" integrity="sha384-BVYiiSIFeK1dGmJRAkycuHAHRg32OmUcww7on3RYdg4Va+PmSTsz/K68vbdEjh4u" crossorigin="anonymous">
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css" type="text/css" />
    <link rel="stylesheet" href="blog.css" type="text/css" />

    <!--[if lt IE 9]>
      <script src="http://html5shim.googlecode.com/svn/trunk/html5.js"></script>
    <![endif]-->

</head>

<body>
    <div class="wrapper-boxed">
        <div class="site-wrapper">
            <div class="col-md-12 text-center" style="margin-top:35px">
                    <h1>PHP Demo | Get data from Google Sheet</h1>
            </div>

            <section class="sec-padding">
                <div class="container">
                    <div class="row">

                    <?php
                    $newsdata = get_data($key);
                    foreach ($newsdata as $i=>$news) {
                        if ($i == 0) continue; //Skip first row
                        display_news($news);
                    }
                    ?>

                    <div class="clearfix"></div>
                    <br />

                    </div>
                </div>
            </section>
        </div>

    </div>
</body>

</html>