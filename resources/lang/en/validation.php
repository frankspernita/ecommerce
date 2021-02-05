<?php

return [

    /*
    |--------------------------------------------------------------------------
    | Validation Language Lines
    |--------------------------------------------------------------------------
    |
    | The following language lines contain the default error messages used by
    | the validator class. Some of these rules have multiple versions such
    | as the size rules. Feel free to tweak each of these messages here.
    |
    */

    'accepted'             => 'El: atributo debe ser aceptado.',
    'active_url'           => 'El: atributo no es una URL válida.',
    'after'                => 'El: atributo debe ser una fecha después de: fecha.',
    'after_or_equal'       => 'El atributo: debe ser una fecha posterior o igual a: fecha.',
    'alpha'                => 'El atributo: solo puede contener letras.',
    'alpha_dash'           => 'El atributo: solo puede contener letras, números y guiones.',
    'alpha_num'            => 'El atributo: solo puede contener letras y números.',
    'array'                => 'El: atributo debe ser una matriz.',
    'before'               => 'El: atributo debe ser una fecha anterior a: fecha.',
    'before_or_equal'      => 'El atributo: debe ser una fecha anterior o igual a: fecha.',
    'between'              => [
        'numeric' => 'El: atributo debe estar entre: min y: max.',
        'file'    => 'El atributo: debe estar entre: min y: max kilobytes.',
        'string'  => 'El: atributo debe estar entre: min y: max caracteres.',
        'array'   => 'El: atributo debe tener entre: min y: max items.',
    ],
    'boolean'              => 'El campo: atributo debe ser verdadero o falso.',
    'confirmed'            => 'La confirmación de atributo no coincide.',
    'date'                 => 'El: atributo no es una fecha válida.',
    'date_format'          => 'El atributo: no coincide con el formato: formato.',
    'different'            => 'El: atributo y: otro deben ser diferentes.',
    'digits'               => 'El: atributo debe ser: dígitos dígitos.',
    'digits_between'       => 'El atributo: debe estar entre: min y: dígitos máximos.',
    'dimensions'           => 'El atributo: tiene dimensiones de imagen no válidas.',
    'distinct'             => 'El campo: atributo tiene un valor duplicado.',
    'email'                => 'El: atributo debe ser una dirección de correo electrónico válida.',
    'exists'               => 'El atributo seleccionado: no es válido.',
    'file'                 => 'El: atributo debe ser un archivo.',
    'filled'               => 'El campo: atributo debe tener un valor.',
    'image'                => 'El: atributo debe ser una imagen.',
    'in'                   => 'El atributo seleccionado: no es válido.',
    'in_array'             => 'El campo: atributo no existe en: otro.',
    'integer'              => 'El: atributo debe ser un entero.',
    'ip'                   => 'El: atributo debe ser una dirección IP válida.',
    'ipv4'                 => 'El atributo: debe ser una dirección IPv4 válida.',
    'ipv6'                 => 'El: atributo debe ser una dirección IPv6 válida.',
    'json'                 => 'El atributo: debe ser una cadena JSON válida',
    'max'                  => [
        'numeric' => 'El: atributo no puede ser mayor que: máx.',
        'file'    => 'El atributo: no puede ser mayor que: kilobytes máximos.',
        'string'  => 'El atributo: no puede ser mayor que: caracteres máximos.',
        'array'   => 'El atributo: no puede tener más de: elementos máximos.',
    ],
    'mimes'                => 'El: atributo debe ser un archivo de tipo:: valores.',
    'mimetypes'            => 'El: atributo debe ser un archivo de tipo:: valores.',
    'min'                  => [
        'numeric' => 'El: atributo debe ser al menos: min.',
        'file'    => 'El: atributo debe ser al menos: min kilobytes.',
        'string'  => 'El atributo: debe tener al menos: caracteres min.',
        'array'   => 'El atributo: debe tener al menos: elementos mínimos.',
    ],
    'not_in'               => 'El atributo seleccionado: no es válido.',
    'numeric'              => 'El: atributo debe ser un número.',
    'present'              => 'El campo: atributo debe estar presente.',
    'regex'                => 'El formato del atributo no es válido.',
    'required'             => 'El campo de atributo es obligatorio.',
    'required_if'          => 'El campo: atributo es obligatorio cuando: otro es: valor.',
    'required_unless'      => 'El campo: atributo es obligatorio a menos que: otro esté en: valores.',
    'required_with'        => 'El campo: atributo es obligatorio cuando: valores están presentes.',
    'required_with_all'    => 'El campo: atributo es obligatorio cuando: valores están presentes.',
    'required_without'     => 'El campo: atributo es obligatorio cuando: los valores no están presentes.',
    'required_without_all' => 'El campo: atributo es obligatorio cuando ninguno de los valores está presente.',
    'same'                 => 'El atributo: y otro deben coincidir.',
    'size'                 => [
        'numeric' => 'El: atributo debe ser: tamaño.',
        'file'    => 'El: atributo debe ser: tamaño kilobytes.',
        'string'  => 'El: atributo debe ser: caracteres de tamaño.',
        'array'   => 'El: atributo debe contener: elementos de tamaño.',
    ],
    'string'               => 'El: atributo debe ser una cadena.',
    'timezone'             => 'El: atributo debe ser una zona válida.',
    'unique'               => 'El atributo: ya se ha tomado.',
    'uploaded'             => 'El atributo: no se pudo cargar.',
    'url'                  => 'El formato del atributo no es válido.',

    /*
    |--------------------------------------------------------------------------
    | Custom Validation Language Lines
    |--------------------------------------------------------------------------
    |
    | Here you may specify custom validation messages for attributes using the
    | convention "attribute.rule" to name the lines. This makes it quick to
    | specify a specific custom language line for a given attribute rule.
    |
    */

    'custom' => [
        'attribute-name' => [
            'rule-name' => 'custom-message',
        ],
    ],

    /*
    |--------------------------------------------------------------------------
    | Custom Validation Attributes
    |--------------------------------------------------------------------------
    |
    | The following language lines are used to swap attribute place-holders
    | with something more reader friendly such as E-Mail Address instead
    | of "email". This simply helps us make messages a little cleaner.
    |
    */

    'attributes' => [],

];
