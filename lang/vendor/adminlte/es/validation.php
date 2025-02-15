<?php

return [
    'custom' => [
        'name' => [
            'required' => 'El nombre es obligatorio.',
        ],
        'email' => [
            'required' => 'El correo electrónico es obligatorio.',
            'email' => 'El correo electrónico debe ser una dirección válida.',
        ],
        'password' => [
            'required' => 'La contraseña es obligatoria.',
            'min' => 'La contraseña debe tener al menos :min caracteres.',
            'same' => 'La confirmación de la contraseña no coincide.',
        ],
    ],
];
