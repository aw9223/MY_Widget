<!DOCTYPE html>
<html xmlns="http://www.w3.org/1999/xhtml" lang="ko" xml:lang="ko">
    <head>
        <title><?= htmlspecialchars($this->theme->get_title()) ?></title>
        <meta http-equiv="X-UA-Compatible" content="IE=edge"/>
        <meta http-equiv="Content-Type" content="text/html; charset=UTF-8"/>
    </head>
    <body>  
        <div id="appHeader">
            <?= $this->theme->get_area('header') ?>
        </div>
        <div id="appCenter">
            <?= $this->theme->get_area('contents') ?> 
            <?= $this->theme->get_area('sidebar') ?> 
        </div>
        <div id="appFooter">
            <?= $this->theme->get_area('footer') ?>
        </div>
    </body>
</html>