<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="utf-8">
        <title><?php echo $title; ?></title>
        <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
        <link href="/public/styles/bootstrap.css" rel="stylesheet">
        <link href="/public/styles/admin.css" rel="stylesheet">
        <link href="/public/styles/font-awesome.css" rel="stylesheet">
        <script src="/public/scripts/jquery.js"></script>
        <script src="/public/scripts/popper.js"></script>
        <script src="/public/scripts/bootstrap.js"></script>
    </head>
    <body class="fixed-nav sticky-footer bg-dark">

            <nav class="navbar navbar-expand-lg navbar-dark bg-dark fixed-top" id="mainNav">
                <a class="navbar-brand" href="/">Главная</a>
                <button class="navbar-toggler navbar-toggler-right" type="button" data-toggle="collapse" data-target="#navbarResponsive" aria-controls="navbarResponsive" aria-expanded="false" aria-label="Toggle navigation">
                    <span class="navbar-toggler-icon"></span>
                </button>
                <div class="collapse navbar-collapse" id="navbarResponsive">
                    <ul class="navbar-nav navbar-sidenav" id="exampleAccordion">
                        <li class="nav-item">
                            <a class="nav-link" href="#">
                            <i class="fa fa-fw fa-plus"></i>
                            <span class="nav-link-text">Автоскан ISBN</span>
                            </a>
                        </li>
                    </ul>
                </div>
            </nav>

<div class="content-wrapper">
    <div class="container-fluid">
        <div class="card mb-3">

        <?php echo $content; ?>

        </div>
    </div>
</div>
            <footer class="sticky-footer">
                <div class="container">
                    <div class="text-center">
                        <small>&copy; 2020</small>
                    </div>
                </div>
            </footer>

        <script src="/public/scripts/form.js"></script>
        <script src="/public/scripts/table.js"></script>
    </body>
</html>