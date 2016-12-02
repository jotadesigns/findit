

<?php

return [

    /*
    |--------------------------------------------------------------------------
    | Errores del Validator
    |--------------------------------------------------------------------------
    |
    */
    'custom' => [
        'password' => [
            'required' => 'El campo password es requerido',
            'confirmed' => 'Las contraseñas no coinciden',
            'min' => 'La :attribute debe ser mallor de :min cifras',
            'max' => 'La :attribute no puede ser mallor de :max cifras',
        ],
        'password_confirmation' => [
            'required' => 'Es necesario introducir la password de confirmacion',
            'min' => 'La password de confirmacion debe ser mallor de :min cifras',
            'max' => 'La password de confirmacion no puede ser ser mallor de :max cifras',
        ],

    ],





];
