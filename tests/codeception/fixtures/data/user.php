<?php
/**
 * Fixture data for user table 
 */
return [
    [
        'name'          =>'ADMIN',
        'username'      =>'ADMIN',
        'password'      =>Yii::$app->getSecurity()->generatePasswordHash('ADMIN'),
        'active'        =>1,
        'access_token'  =>null,
        'auth_key'      =>'9CEQD9h51DASTja10X1zCaGDCPyp9Lnv',
    ],
    [
        'name'          =>'DEMO',
        'username'      =>'DEMO',
        'password'      =>Yii::$app->getSecurity()->generatePasswordHash('DEMO'),
        'active'        =>1,
        'access_token'  =>null,
        'auth_key'      =>'qN38K8lRV7nVmrJPhkcVpUmsceLqoeKN',
    ],
    [
        'name'          =>'BUDDY',
        'username'      =>'BUDDY',
        'password'      =>Yii::$app->getSecurity()->generatePasswordHash('BUDDY'),
        'active'        =>1,
        'access_token'  =>null,
        'auth_key'      =>'asldkfJkdlIjflaOosdjoaiOIljkdaKN',
    ],
    
    
];