<?php

    use app\assets\AppAsset;
    use app\models\Records\Carrito;
    use app\models\Usuario;
    use app\widgets\Alert;
    use yii\bootstrap5\Html;
    use webvimark\modules\UserManagement\UserManagementModule;

    AppAsset::register($this);
    $this->registerCsrfMetaTags();
    $this->registerMetaTag(['charset' => Yii::$app->charset], 'charset');
    $this->registerMetaTag(['name' => 'viewport', 'content' => 'width=device-width, initial-scale=1, shrink-to-fit=no']);
    $this->registerMetaTag(['name' => 'description', 'content' => $this->params['meta_description'] ?? '']);
    $this->registerMetaTag(['name' => 'keywords', 'content' => $this->params['meta_keywords'] ?? '']);
    $this->registerLinkTag(['rel' => 'icon', 'type' => 'image/x-icon', 'href' => Yii::getAlias('@web/favicon.ico')]);
    $this->registerJsFile(Yii::getAlias('@web/assets/style_tail.js'), ['position' => \yii\web\View::POS_HEAD]);
    $this->registerCssFile('https://cdnjs.cloudflare.com/ajax/libs/flowbite/2.0.0/flowbite.min.css');
?>

<?php $this->beginPage() ?>
<!DOCTYPE html>
    <html lang="es-es">
    <head>
        <title><?= Html::encode($this->title) ?></title>
        <?php $this->head() ?>
    </head>
    <body>
        <?php $this->beginBody() ?>

        <header id="header" class="text-white bg-[#fff159] px-[80px] py-2">

            <div class="flex gap-5 justify-content-start align-items-bottom py-1">
                <!--Logotipo-->
                <a href="<?= Yii::getAlias('@web/')?>" class="ml-1">
                    <span class="font-bold text-blue-800 text-3xl">
                        Merca<span class="text-green-500">tox</span>
                    </span>
                </a>
                <!--Buscador-->
                <form method="post" action="#" class="flex w-[70%] divide-x">
                    <input class="outline-none border-none rounded-l-md shadow-sm p-2 px-3 w-full text-gray-500" placeholder="Buscar productos, vendedores, etc" type="text">
                    <button type="submit" class="rounded-r-md bg-white p-2 px-3">
                        <svg class="w-4 h-4 text-neutral-900" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" d="M21 21l-5.197-5.197m0 0A7.5 7.5 0 105.196 5.196a7.5 7.5 0 0010.607 10.607z" />
                        </svg>
                    </button>
                </form>
            </div>

            <div class="flex justify-content-between align-items-end">
                <!-- Location -->
                <a href="<?= Yii::getAlias('@web/login')?>" class="flex gap-2 min-w-[185px]">
                    <div class="text-gray-600">
                        <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1" stroke="currentColor" class="w-7 h-7">
                            <path stroke-linecap="round" stroke-linejoin="round" d="M15 10.5a3 3 0 11-6 0 3 3 0 016 0z" />
                            <path stroke-linecap="round" stroke-linejoin="round" d="M19.5 10.5c0 7.142-7.5 11.25-7.5 11.25S4.5 17.642 4.5 10.5a7.5 7.5 0 1115 0z" />
                        </svg>
                    </div>
                    <div class="flex flex-col text-sm">
                        <span class="text-gray-600 text-xs">Ingresa tu</span>
                        <span class="text-neutral-900 text-xs">Codigo postal</span>
                    </div>
                </a>
                <!-- Vinculos -->
                <ul class="flex gap-3 text-sm w-full">
                    <li class="text-gray-600 hover:text-neutral-900">
                        <buttton data-dropdown-toggle="catergoria_dropdown" data-dropdown-placement="right-end" type="button">
                            Categorias
                        </buttton>
                        <div id="catergoria_dropdown" class="z-[100] hidden bg-white rounded-md w-max shadow divide-y divide-gray-100 scrollable-div">
                            <ul class="py-2 text-sm text-gray-700 max-h-72 scrollable-content">
                                <?php
                                $categorias = \app\models\Records\ProductoCategoria::find()->all();
                                if($categorias !== null){
                                    foreach ($categorias as $categoria){
                                        echo '<li> 
                                                    <a href="'.Yii::$app->urlManager->createAbsoluteUrl(['/producto/categoria', 'categoria' => $categoria->categoria]).'" class="px-3 py-2 hover:bg-gray-300 block">
                                                     '.$categoria->categoria .' 
                                                     </a>
                                              </li>';
                                    }
                                }
                                ?>
                            </ul>
                        </div>
                    </li>
                    <li class="text-gray-600 hover:text-neutral-900">
                        <a href="">Ofertas</a>
                    </li>
                    <li class="text-gray-600 hover:text-neutral-900">
                        <a href="">Moda</a>
                    </li>
                    <li class="text-gray-600 hover:text-neutral-900">
                        <a href="">Tecnologia</a>
                    </li>
                </ul>
                <!--Profile-->
                <ul class="flex align-items-center gap-3 text-sm min-w-max">
                    <?php if(Yii::$app->user->isGuest): ?>
                        <li class="text-gray-600 hover:text-neutral-900">
                            <a href="<?= Yii::getAlias('@web/register')?>">Crea tu cuenta</a>
                        </li>
                        <li class="text-gray-600 hover:text-neutral-900">
                            <a href="<?= Yii::getAlias('@web/login')?>">Ingresa</a>
                        </li>
                    <?php else :?>
                        <li class="text-gray-600 hover:text-neutral-900 cursor-pointer" data-dropdown-toggle="user_dropdown" type="button">
                            <div class="flex items-center gap-1">
                                <img class="h-6 rounded-full" src="<?= Yii::getAlias('@web/').Yii::$app->user->identity->fotografia ?>" alt="avatar_<?= Yii::$app->user->identity->username?>" >
                                <span class=""><?= Yii::$app->user->identity->username ?></span>
                                <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1" stroke="currentColor" class="w-4 h-4">
                                    <path stroke-linecap="round" stroke-linejoin="round" d="M19.5 8.25l-7.5 7.5-7.5-7.5" />
                                </svg>
                            </div>
                        </li>

                        <!-- MENU DESPLEGABLE -->
                        <div id="user_dropdown" class="z-[100] hidden bg-white rounded-md w-max shadow divide-y divide-gray-100">
                            <ul class="py-2 text-sm text-gray-700">
                                <?php if(Yii::$app->user->identity->superadmin) : ?>
                                    <li data-dropdown-toggle="user_sistema_dropdown" data-dropdown-placement="left-end" type="button">
                                        <button class="block px-4 py-2 hover:text-neutral-900">
                                            Aplicaciones
                                        </button>
                                    </li>
                                    <?php
                                        foreach((UserManagementModule::menuItems())as $items){
                                            echo '<li><a class="block px-4 py-2 hover:text-neutral-900" href="'.($items['url'][0]) .'">'.($items['label']).'</a></li>';
                                        }
                                    ?>
                                    <div id="user_sistema_dropdown" class="z-[100] hidden bg-white rounded-md w-max shadow divide-y divide-gray-100">
                                        <ul class="py-2 text-sm text-gray-700">
                                            <li>
                                                <a href="<?= Yii::getAlias('@web/management/advertisements')?>" class="block px-4 py-2 hover:text-neutral-900">Carousels</a>
                                            </li>
                                            <li>
                                                <a href="<?= Yii::getAlias('@web/management/publications')?>" class="block px-4 py-2 hover:text-neutral-900 hidden">Publicaciones</a>
                                            </li>
                                            <li>
                                                <a href="<?= Yii::getAlias('@web/management/orders')?>" class="block px-4 py-2 hover:text-neutral-900 hidden">Ordenes</a>
                                            </li>
                                            <li>
                                                <a href="<?= Yii::getAlias('@web/management/products')?>" class="block px-4 py-2 hover:text-neutral-900 hidden">Productos</a>
                                            </li>
                                        </ul>
                                    </div>
                                <?php endif; ?>

                                <?php if(Usuario::getRoleName() === Usuario::ROLE_VENDEDOR) : ?>
                                    <li>
                                        <a href="#" class="block px-4 py-2 hover:text-neutral-900">Mi Perfil</a>
                                    </li>
                                    <li>
                                        <a href="#" class="block px-4 py-2 hover:text-neutral-900 hidden">Pedidos</a>
                                    </li>
                                    <li>
                                        <a href="#" class="block px-4 py-2 hover:text-neutral-900 hidden">Mis Ventas</a>
                                    </li>
                                    <li>
                                        <a href="<?= Yii::getAlias('@web/vendedor/mis-productos')?>" class="block px-4 py-2 hover:text-neutral-900">Mis Productos</a>
                                    </li>
                                <?php endif; ?>

                                <?php if(Usuario::getRoleName() == Usuario::ROLE_COMPRADOR) : ?>
                                    <li>
                                        <a href="#" class="block px-4 py-2 hover:text-neutral-900">Mi Perfil</a>
                                    </li>
                                    <li>
                                        <a href="<?= Yii::getAlias('@web/mis-compras')?>" class="block px-4 py-2 hover:text-neutral-900">Mis Compras</a>
                                    </li>
                                <?php endif; ?>
                            </ul>
                            <form class="block w-full text-gray-700" method="post" action="<?= Yii::getAlias('@web/logout')?>" href="<?= Yii::getAlias('@web/logout')?>">
                                <?= Html::input('hidden',Yii::$app->request->csrfParam,Yii::$app->request->csrfToken)?>
                                <button type="submit" class="text-sm block px-4 py-2 hover:text-neutral-900 w-full text-start">
                                    Cerrar sesion
                                </button>
                            </form>
                        </div>
                    <?php endif; ?>

                    <!-- -->

                    <li class="text-gray-600 hover:text-neutral-900">
                        <a href="<?= Yii::getAlias('@web/mis-compras')?>">Mis compras</a>
                    </li>

                    <!--Cariito-->
                    <li >
                        <button class="relative select-none" data-dropdown-toggle="cart_dropdown" type="button" data-dropdown-placement="left-end">
                            <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1" stroke="currentColor" class="w-6 h-6 text-neutral-700">
                                <path stroke-linecap="round" stroke-linejoin="round" d="M2.25 3h1.386c.51 0 .955.343 1.087.835l.383 1.437M7.5 14.25a3 3 0 00-3 3h15.75m-12.75-3h11.218c1.121-2.3 2.1-4.684 2.924-7.138a60.114 60.114 0 00-16.536-1.84M7.5 14.25L5.106 5.272M6 20.25a.75.75 0 11-1.5 0 .75.75 0 011.5 0zm12.75 0a.75.75 0 11-1.5 0 .75.75 0 011.5 0z" />
                            </svg>

                             <?php if (!Yii::$app->user->isGuest && (Carrito::getCarrito() )!== null) : ?>
                                <div class="absolute -top-[3px] -right-1">
                                    <span class="rounded-full bg-red-600 shadow-sm h-[8px] w-[8px] block"></span>
                                </div>
                            <?php endif; ?>
                        </button>

                        <div id="cart_dropdown" class="z-[100] hidden bg-white rounded-md w-max shadow divide-y divide-gray-100">
                            <ul class="py-2 text-sm text-gray-700">
                                <?php if ((Carrito::getCarrito() )!== null) : ?>
                                    <?php
                                        $productosAndCarrito = Carrito::getProductoCarrito();
                                        if($productosAndCarrito !== null){
                                            foreach ($productosAndCarrito['productos'] as $items){
                                                echo '<li>
                                                    <div class="flex items-center justify-content-between gap-x-3 px-2 py-2 hover:bg-gray-200 select-none cursor-pointer">
                                                        <div class="w-[50px] h-[40px]">
                                                            <img src="'.Yii::getAlias('@web/').$items['producto_fotografia'].'" class="object-fit w-full h-full rounded-md ">
                                                        </div>
                                                        <div class="flex flex-col w-[90px]">
                                                            <h1 class="text-sm text-blue-900">'.(strlen($items['producto_nombre']) > 12 ? (substr($items['producto_nombre'],0,10)."..") : $items['producto_nombre']).'</h1>
                                                            <span class="text-xs text-gray-500">Cantidad: '.$items['cantidad'].'</span>
                                                        </div>
                                                        <div class="min-w-[70px] text-end text-sm text-neutral-600">
                                                             <span>$ '.number_format($items['precio_cantidad'], 2, '.',',').'</span>    
                                                        </div>
                                                    </div>
                                                </li>';
                                            }
                                        }
                                    ?>
                                <?php else : ?>
                                    <li class="w-full">
                                        <div class="w-full px-3 py-2">
                                            <span class="block text-xl font-bold text-gray-900 text-center">Carrito vacio</span>
                                            <span class="block font-light text-sm text-gray-500 w-[180px] text-center">Aun no has agregado ningun producto a tu carrito</span>
                                        </div>
                                    </li>
                                <?php endif; ?>
                            </ul>
                            <div class="w-full text-blue-600">
                                <a href="<?= Yii::getAlias(Yii::$app->user->isGuest ? '/login' : '@web/mi-carrito')?>" class="w-full py-2 text-center block" ><span class="mx-auto">Ver carrito</span></a>
                            </div>
                        </div>
                    </li>
                </ul>
            </div>
        </header>

        <main id="main" class="flex-shrink-0" role="main">
            <?= Alert::widget() ?>
            <?= $content ?>
        </main>

        <footer class="flex flex-col gap-2 shadow-sm px-5 py-3 bg-white divide-y divide-gray-300">
            <div class="grid grid-cols-3 gap-3 divide-x divide-gray-300 mb-2 text-center">
                <div class="px-4 py-3">
                    <img class="mx-auto my-2" src="<?= Yii::getAlias('@web/img/payment.svg')?>" alt="metodo de pago">
                    <span>Elige cómo pagar</span>
                    <span class="block text-gray-600 font-light w-[200px] mx-auto text-sm">Puedes elegir entre diferentes metodos de pago</span>
                </div>
                <div class="px-4 py-3">
                    <img class="mx-auto my-2" src="<?= Yii::getAlias('@web/img/shipping.svg')?>" alt="envio gratis">
                    <span>Envío gratis</span>
                    <span class="block text-gray-600 font-light w-[200px] mx-auto text-sm">Puedes elegir entre diferentes metodos de pago</span>
                </div>
                <div class="px-4 py-3">
                    <img class="mx-auto my-2" src="<?= Yii::getAlias('@web/img/protected.svg')?>" alt="seguridad">
                    <span>Seguridad, de principio a fin</span>
                    <span class="block text-gray-600 font-light w-[200px] mx-auto text-sm">Puedes elegir entre diferentes metodos de pago</span>
                </div>
            </div>
            <div class="flex flex-col gap-2 text-sm clas text-gray-600 pt-3">
                <div class="flex gap-2 text-neutral-800 my-2">
                    <a href="" class="hover:text-blue-700">Trabaja con nosotros</a>
                    <a href="" class="hover:text-blue-700">Términos y condiciones</a>
                    <a href="" class="hover:text-blue-700">Cómo cuidamos tu privacidad</a>
                    <a href="" class="hover:text-blue-700">Accesibilidad</a>
                    <a href="" class="hover:text-blue-700">Ayuda</a>
                </div>
                <p class="-mb-2">Copyright © 1999-2023 El presente canal de instrucción identificada bajo "Mercatox".</p>
                <p>Villahermosa, Tabasco.</p>
            </div>
        </footer>

        <?php $this->endBody() ?>
        <?php $this->registerJsFile(Yii::getAlias('https://cdnjs.cloudflare.com/ajax/libs/flowbite/2.0.0/flowbite.min.js'), ['position' => \yii\web\View::POS_END]);?>
    </body>
</html>
<?php $this->endPage() ?>
