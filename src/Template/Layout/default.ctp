<html>
<head>
    <?= $this->Html->css('base.css') ?>
    <?= $this->Html->css('cake.css') ?>
    <?= $this->Html->css('app.css') ?>

    <?= $this->Html->script('angular.min.js') ?>
    <?= $this->Html->script('app.js') ?>

    <?= $this->fetch('css') ?>
    <?= $this->fetch('script') ?>

</head>
<body>
    <header>
        <div class="header-title">
            <span></span>
        </div>
        <div class="header-help">
        </div>
    </header>
    <div id="container">

        <div id="content">

                <?= $this->fetch('content') ?>
        </div>
    </div>
</body>
</html>
