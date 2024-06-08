<?php
namespace Controllers;

use Services\RolesService;
use Services\UsersService;
use Lib\Pages;
use Utils\DataCleaner;

class AdminProductsController
{
    private ProductsService $service;
    private RolesService $rolesService;
    private Pages $pages;

    public function __construct()
    {
        $this->service = new ProductsService();
        $this->rolesService = new RolesService();
        $this->pages = new Pages();
    }

    public function list()
    {
        $this->pages->render('admin_products');
    }
}