<!doctype html>
<html lang="en">
    <head>
        <meta charset="UTF-8">
        <meta name="viewport"
              content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
        <meta http-equiv="X-UA-Compatible" content="ie=edge">
        <title>
            <?php
            /**
             * @var string $title
             */
            echo $title;
            ?>
        </title>
        <?php
        foreach ($this->getAttribute('css') ?? [] as $css) {
            echo sprintf('<link rel="stylesheet" type="text/css" href="/assets/css/%s">', $css);
        }
        ?>
    </head>
    <body>
    <nav class="site-header sticky-top py-1">
        <div class="container d-flex flex-column flex-md-row justify-content-between text-center">
            <a class="py-2" href="#" aria-label="Product">
                <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" fill="none" stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" class="d-block mx-auto" role="img" viewBox="0 0 24 24" focusable="false"><title>Product</title><circle cx="12" cy="12" r="10"></circle><path d="M14.31 8l5.74 9.94M9.69 8h11.48M7.38 12l5.74-9.94M9.69 16L3.95 6.06M14.31 16H2.83m13.79-4l-5.74 9.94"></path></svg>
            </a>
            <a class="py-2 d-md-inline-block" href="#">Главная</a>
            <a class="py-2 d-md-inline-block" href="#">Product</a>
            <a class="py-2 d-md-inline-block" href="#">Features</a>
            <a class="py-2 d-md-inline-block" href="#">Enterprise</a>
            <a class="py-2 d-md-inline-block" href="#">Support</a>
            <a class="py-2 d-md-inline-block" href="#">Pricing</a>
            <a class="py-2 d-md-inline-block" href="#">Cart</a>
        </div>
    </nav>
    <div class="jumbotron"></div>
    <div class="container">
        <?php
        /**
         * @var string $content
         */
        echo $content;
        ?>
    </div>
    <?php
    foreach ($this->getAttribute('js') ?? [] as $js) {
        echo sprintf('<script src="/assets/js/%s"></script>', $js);
    }
    ?>
    </body>
</html>
