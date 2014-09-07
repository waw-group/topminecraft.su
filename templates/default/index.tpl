
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="description" content="">
    <meta name="author" content="">

    <title>[title]{lng.default_title}[/title]</title>

    <!-- Bootstrap core CSS -->
    <link href="{THEME}assets/css/bootstrap.css" rel="stylesheet">




    <!-- Custom CSS Assets -->

    <link href="{THEME}assets/css/scojs.css" rel="stylesheet">
    <link rel="stylesheet" href="{THEME}assets/css/jquery.fs.picker.css">
    <link href="{THEME}assets/css/jquery.fs.selecter.css" rel="stylesheet">
    <link rel="stylesheet" href="{THEME}assets/css/jquery.fs.scroller.css">
    <link rel="stylesheet" href="{THEME}assets/css/font-awesome.css">
    <link href="{THEME}assets/css/theme.css" rel="stylesheet">


</head>

<body>


<!-- /Wrap -->
<div id="wrap">

    <div id="login" class="collapse">
        <div class="container">
            <div class="top-form-inner">

                <form class="form-inline" role="form" method="post" action="/auth/processor">
                    <div class="form-group">
                        <label class="sr-only" for="exampleInputEmail2">{lng.placeholder_login}</label>
                        <input type="text" name="login" class="form-control" id="exampleInputEmail2" placeholder="{lng.placeholder_login}">
                    </div>
                    <div class="form-group">
                        <label class="sr-only" for="exampleInputPassword2">{lng.placeholder_password}</label>
                        <input type="password" name="password" class="form-control" id="exampleInputPassword2" placeholder="{lng.placeholder_password}">
                    </div>
                    <input type="submit" value="{lng.enter}" class="btn btn-primary">
                </form>
            </div>
        </div>
    </div>

    <nav class="navbar  navbar-default" role="navigation">
        <div class="container">
            <div class="navbar-header">
                <button type="button" class="navbar-toggle" data-toggle="collapse" data-target=".navbar-ex1-collapse">
                    <span class="sr-only">Toggle navigation</span>
                    <span class="icon-bar"></span>
                    <span class="icon-bar"></span>
                    <span class="icon-bar"></span>
                </button>
                <a class="navbar-brand" href="/"><span class="glyphicon glyphicon-dashboard"></span> Mc<span class="sec-brand">Shop 3</span></a>
            </div>

            <!-- Collect the nav links, forms, and other content for toggling -->
            <div class="collapse navbar-collapse navbar-ex1-collapse">

                <p class="navbar-text pull-right">{lng.q_registered} <a data-toggle="collapse" data-target="#login" class="navbar-link">{lng.authorize}</a>
                </p>

                <div class="btn-toolbar pull-right">
                    <div class="btn-group"><a href="/registration/form" class="btn btn-success navbar-btn btn-sm"><span class="glyphicon glyphicon-user"></span> {lng.register}</a>
                    </div>
                </div>

            </div>
            <!-- /.navbar-collapse -->
        </div>
        <!-- /.container -->
    </nav>


    <div id="top">
        <nav class="secondary navbar navbar-default" role="navigation">
            <div class="container">
                <!-- Brand and toggle get grouped for better mobile display -->
                <div class="navbar-header">
                    <button type="button" class="navbar-toggle" data-toggle="collapse" data-target=".navbar-ex5-collapse">
                        <span class="sr-only">Toggle navigation</span>
                        <span class="icon-bar"></span>
                        <span class="icon-bar"></span>
                        <span class="icon-bar"></span>
                    </button>
                </div>

                <!-- Collect the nav links, forms, and other content for toggling -->
                <div class="collapse navbar-collapse navbar-ex5-collapse">
                    <ul class="nav navbar-nav">
                        <li><a href="/">{lng.news}</a></li>
                        [pages]
                        <li><a href="index.html#">Скачать клиент</a></li>
                        <li><a href="index.html#">Как играть</a></li>
                        <li><a href="index.html#">Магазин</a></li>
                        [/pages]
                    </ul>
                </div>
                <!-- /.navbar-collapse -->
            </div>
        </nav>
    </div>





    <div class="container">

        <div class="row">
[content]
            <div class="col-md-3 col-sm-4">
                <!-- left sec -->
                <div class="left-sec">
                </div>
                <!-- /left sec -->
            </div>


            <div class="col-md-9 col-sm-8">
                <div class="right-sec">
                </div>
            </div>
[/content]
        </div>

    </div>
    <!-- /.container -->

</div>

<!-- /Wrap -->



<!-- Footer -->
<div id="footer">
    <div class="container">
        <p class="text-muted credit">&copy; 2011-2014 <strong>McShop</strong> &middot; Created by: <a href="#">mops1k</a>
        </p>
    </div>
</div>
<!-- /Footer -->




<!-- javascript -->
<script src="{THEME}assets/js/jquery.js"></script>
<script src="{THEME}assets/js/jquery.fs.selecter.js"></script>
<script src="{THEME}assets/js/jquery.fs.picker.js"></script>
<script src="{THEME}assets/js/jquery.fs.scroller.js"></script>

<script src="{THEME}assets/js/bootstrap.js"></script>
<script src="{THEME}assets/js/theme.js"></script>
<script src="{THEME}assets/js/sco.modal.js"></script>
<script src="{THEME}assets/js/sco.confirm.js"></script>
<script src="{THEME}assets/js/sco.ajax.js"></script>
<script src="{THEME}assets/js/sco.collapse.js"></script>
<script src="{THEME}assets/js/sco.countdown.js"></script>
<script src="{THEME}assets/js/sco.message.js"></script>




<script>
    $(document).ready(function (e) {




        $(".selecter_label_1").selecter({
            defaultLabel: "Select a Make"
        });

        $(".selecter_label_2").selecter({
            defaultLabel: "Select A Model"
        });

        $(".selecter_label_3").selecter({
            defaultLabel: "Condition"
        });

        $(".selecter_label_4").selecter({
            defaultLabel: "Transmission"
        });

        $("input[type=checkbox], input[type=radio]").picker();

    });
</script>
<!-- /Javascript -->




</body>

</html>