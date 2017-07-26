<?php 
$user = new User;
?>
<!DOCTYPE html>
<!--[if lt IE 7]><html lang="ru" class="lt-ie9 lt-ie8 lt-ie7"><![endif]-->
<!--[if IE 7]><html lang="ru" class="lt-ie9 lt-ie8"><![endif]-->
<!--[if IE 8]><html lang="ru" class="lt-ie9"><![endif]-->
<!--[if gt IE 8]><!-->
<html lang="ru">
<!--<![endif]-->
<head>
    <meta charset="utf-8" />
        <title><?php echo htmlspecialchars(Title::get());?></title>
    <meta name="description" content="" />
    <meta http-equiv="X-UA-Compatible" content="IE=edge" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <!-- bootstrap -->
    <link rel="stylesheet" href="/public/libs/bootstrap/bootstrap.min.css" />
    <!-- font-awesome -->
    <link rel="stylesheet" href="http://netdna.bootstrapcdn.com/font-awesome/4.0.3/css/font-awesome.css">
    <!-- styles -->
    <!-- <link rel="stylesheet" href="/public/css/fonts.css" /> -->
    <link rel="stylesheet" href="/public/css/style.css">
</head>
<body>
    <div class="wrapper">
        <div class="page">
            <header>
                <?php require_once Config::get('path/views') . '/admin/admin-panel.php' ?>
                <div class="header-top clearfix">
                    <div class="container">
                        <div class="logo pull-left">
                            <h1><a title="Home page" href="/">&middot; Nevada blog &middot;</a></h1>
                        </div>
                        <div class="pull-right">
                            <?php if (!$user->isLoggedIn()): ?>
                                <nav class="nav auth-buttons pull-right">
                                    <ul>   
                                        <li><a href="/auth/login" class="button">Вход</a></li>
                                        <li><a href="/auth/register" class="button">Регистрация</a></li>
                                    </ul>
                                </nav>
                            <?php else: ?>
                                <ul class="nav navbar-nav navbar-right">
                                    <li class="dropdown user-block">
                                        <a href="/profile" class="dropdown-toggle top-profile-button" data-toggle="dropdown" role="button" aria-haspopup="true" aria-expanded="false">
                                           <span class="top-username"><?= $user->data()->username; ?></span>
                                           <div class="top-image-wrap" style="background-image: url('/<?=$user->data()->avatar;?>')"></div>
                                           <span class="caret"></span></a>
                                           <ul class="dropdown-menu">
                                            <li><a href="/profile">Мой профиль</a></li>
                                            <li><a href="/profile/posts">Мои публикации</a></li>
                                            <li><a href="/post/create">Добавить публикацию</a></li>
                                            <li class="divider"></li>
                                            <li><a href="/auth/logout">Выход</a></li>
                                        </ul>
                                    </li>
                                </ul>
                            <?php endif; ?>
                        </div>
                    </div>
                </div>
            </header>
            <div class="container">
                <?=Alert::getFlash();?>
            </div>
            <?php require_once Config::get('path/views') . '/' . $contentPage . '.php';  ?>
        </div>
        <footer>
            <div class="container">
                <h4 class="text-right">Kalayda Vitaly &copy; 2017</h4>
            </div>
        </footer>
    </div>
    <!--[if lt IE 9]>
    <script src="libs/html5shiv/es5-shim.min.js"></script>
    <script src="libs/html5shiv/html5shiv.min.js"></script>
    <script src="libs/html5shiv/html5shiv-printshiv.min.js"></script>
    <script src="libs/respond/respond.min.js"></script>
    <![endif]-->
    <script src="/public/libs/jquery/jquery-3.1.1.min.js"></script>
    <script src="/public/libs/bootstrap/bootstrap.min.js"></script>
    <script src="/public/libs/tinymce/tinymce.min.js"></script>
    <script src="/public/js/tinymce-init.js"></script>
    <script src="/public/js/common.js"></script>
</body> 
</html>