<?php

Route::group(['prefix' => 'admin', 'namespace' => 'Admin'], function () {

    Route::get('/', 'LoginController@index')
        ->name('admin.login.page');

    Route::group(['prefix' => 'login'], function () {
        Route::post('/post', 'LoginController@login')
            ->name('admin.login.post');

        Route::get('logout', 'LoginController@logout')
            ->name('admin.logout');
    });

    Route::group(['middleware' => ['auth', 'adminConfirm']], function () {
        Route::get('dashboard', 'IndexController@index')
            ->name('admin.dashboard');

        // Панель состояния (Устарела, заменяем на Заказы, смотри ниже)
        Route::group(['prefix' => 'panel'], function () {
            Route::get('/', 'StatePanelController@index')
                ->name('admin.statePanel.page');

            Route::get('get/products', 'StatePanelController@getProducts')
                ->name('admin.statePanel.products');

            Route::get('get/cart', 'StatePanelController@getShoppingCart')
                ->name('admin.statePanel.cart');
        });

        // Заказы
        Route::group(['prefix' => 'orders'], function () {
            Route::get('/', 'OrdersController@index')
                ->name('admin.orders.orders');

            Route::get('/viewOrders', 'OrdersController@viewOrders')
                ->name('admin.orders.viewOrders');
        });


        //  Категории
        Route::group(['prefix' => 'categories', 'namespace' => 'Categories'], function () {
            Route::get('/', 'CategoriesController@index')
                ->name('admin.categories.page');

            Route::post('add', 'CategoriesController@addCategory')
                ->name('admin.categories.add');

            Route::post('delete', 'CategoriesController@deleteCategory')
                ->name('admin.categories.delete');

            Route::post('change', 'CategoriesController@changeCategory')
                ->name('admin.categories.change');
        });

        //  Потребности
        Route::group(['prefix' => 'accessories', 'namespace' => 'Accessories'], function () {
            Route::get('/', 'AccessoriesController@index')
                ->name('admin.accessories.page');

            Route::post('add', 'AccessoriesController@addAccessory')
                ->name('admin.accessories.add');

            Route::post('delete', 'AccessoriesController@deleteAccessory')
                ->name('admin.accessories.delete');

            Route::post('change', 'AccessoriesController@changeAccessory')
                ->name('admin.accessories.change');
        });

        //  Товары
        Route::group(['prefix' => 'products', 'namespace' => 'Products'], function () {
            Route::get('/', 'ProductsController@index')
                ->name('admin.products.page');

            Route::get('/pageNew', 'NewProductsController@indexNew')
                ->name('admin.products.pageNew');

            Route::get('/createNewProd', 'NewProductsController@createProd')
                ->name('admin.products.createProd');

            Route::post('/createNewProd', 'NewProductsController@createProdProcess')
                ->name('admin.products.createProdProcess');

            Route::get('/changeNewProd/{id}', 'NewProductsController@getProd')
                ->name('admin.products.changeNewProd');

            Route::post('/changeNewProd/{id}', 'NewProductsController@updateProduct')
                ->name('admin.products.updateProductNew');

            Route::post('/deleteProd', 'NewProductsController@deleteProd')
                ->name('admin.products.deleteNewProd');

            Route::get('/information', 'NewProductsController@information')
                ->name('admin.products.information');

            Route::get('/changeInformation', 'NewProductsController@changeInformation')
                ->name('admin.products.changeInformation');

            Route::get('/get', 'ProductsController@getProductForChange')
                ->name('admin.product.get');

            Route::get('/attributes', 'AttributesController@getAttributesForProduct')
                ->name('admin.product.get.attributes');

            Route::get('/get/attributes', 'AttributesController@getAttributesForChange')
                ->name('admin.product.attributes');

            Route::get('/sales', 'SalesController@getSales')
                ->name('admin.product.sales');

            Route::get('/get/sales', 'SalesController@getSalesForChange')
                ->name('admin.product.get.sales');

            Route::get('/get/sale', 'SalesController@getSale')
                ->name('admin.product.get.sale');

            Route::put('/set/sale', 'SalesController@setSale')
                ->name('admin.product.set.sale');

            Route::put('clear/sales', 'SalesController@clearSales')
                ->name('admin.product.clear.sales');


            // Добавление
            Route::group(['prefix' => 'add'], function () {
                Route::post('/', 'ProductsController@addProduct')
                    ->name('admin.products.add');

                Route::post('attribute', 'AttributesController@addAttributes')
                    ->name('admin.products.add.attribute');

                Route::post('sale', 'SalesController@addSale')
                    ->name('admin.products.add.sale');

                Route::post('globalsale', 'SalesController@addGlobalSale')
                    ->name('admin.products.globalsale');
            });

            // Изменение
            Route::group(['prefix' => 'change'], function () {
                Route::post('/', 'ProductsController@changeProduct')
                    ->name('admin.products.change');

                Route::post('/attribute', 'AttributesController@changeAttribute')
                    ->name('admin.products.attribute.change');

                Route::post('/sale', 'SalesController@changeSale')
                    ->name('admin.products.sale.change');
            });

            // Удаление
            Route::group(['prefix' => 'delete'], function () {
                Route::delete('/', 'ProductsController@deleteProducts')
                    ->name('admin.product.delete');

                Route::delete('attributes', 'AttributesController@deleteAttributes')
                    ->name('admin.product.delete.attribute');

                Route::delete('sales', 'SalesController@deleteSales')
                    ->name('admin.product.delete.sales');
            });
        });

        //  Изображения
        Route::group(['prefix' => 'Images', 'namespace' => 'Products'], function () {
            Route::get('/', 'ImageController@index')
                ->name('admin.images.page');

            Route::get('/banner', 'ImageController@banner')
                ->name('admin.images.banner');

            Route::post('/add', 'ImageController@addImage')
                ->name('admin.addImage');

            Route::post('/addGlobal', 'ImageController@addGlobalImage')
                ->name('admin.addGlobalImage');

            Route::post('/delete', 'ImageController@deleteImage')
                ->name('admin.deleteImage');

            Route::post('/deleteGlobal', 'ImageController@deleteGlobalImage')
                ->name('admin.deleteGlobalImage');
        });
    });
});
