<?php

return [
    'role_structure' => [
        'super_admin' => [
            'users' => 'c,r,u,d',
            'employees' => 'c,r,u,d',
            'AttLeave' => 'c,r,u,d',
            'acountemployees' => 'c,r,u,d',
            'empproductable' => 'c,r,u,d',
            'employee_move_report' => 'c,r,u,d',
            'customers' => 'c,r,u,d',
            'customerdeal' => 'c,r,u,d',
            'cost_deal_customer' => 'c,r,u,d',
            'customerpaid' => 'c,r,u,d',
            'customerreport' => 'c,r,u,d',
            'suppliers' => 'c,r,u,d',
            'supplier_paid' => 'c,r,u,d',
            'supplierreport' => 'c,r,u,d',
//            مشنريات
            'buypurchase' => 'c,r,u,d',
//            مبيعات
            'salepurchase' => 'c,r,u,d',
//            'category' => 'c,r,u,d',
            'store' => 'c,r,u,d',
            'products' => 'c,r,u,d',
            'product_order' => 'c,r,u,d',
            'product_addrequest' => 'c,r,u,d',
            'product_report' => 'c,r,u,d',
            'mony' => 'c,r,u,d',
            'monyreport' => 'c,r,u,d',

        ],

        'admin' => [],
    ],

    'permissions_map' => [
        'c' => 'create',
        'r' => 'read',
        'u' => 'update',
        'd' => 'delete'
    ]
];
