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

    'accepted'             => 'Este campo deve ser aceito.',
    'active_url'           => 'Este campo deve ser uma URL válida.',
    'after'                => 'Este campo deve ser uma data posterior a :date.',
    'after_or_equal'       => 'Este campo deve ser uma data posterior ou igual a :date.',
    'alpha'                => 'Este campo deve conter apenas letras.',
    'alpha_dash'           => 'Este campo deve ocnter apenas letras, números e underlines.',
    'alpha_num'            => 'Este campo deve conter apenas letras e números.',
    'array'                => 'Este campo deve ser um array.',
    'before'               => 'Este campo deve ser uma date anterior a :date.',
    'before_or_equal'      => 'Este campo deve ser uma data anterior ou igual a :date.',
    'between'              => [
        'numeric' => 'Este campo deve estar contido entre :min e :max.',
        'file'    => 'Este campo deve estar contido entre :min e :max kilobytes.',
        'string'  => 'Este campo deve conter entre :min e :max caracteres.',
        'array'   => 'Este campo deve conter entre :min e :max itens.',
    ],
    'boolean'              => 'Este campo deve ser verdadeiro ou falso.',
    'confirmed'            => 'A senha e sua confirmação não são iguais',
    'date'                 => 'Este campo não é uma data válida.',
    'date_format'          => 'Este campo não está no formato :format.',
    'different'            => 'Este campo e :other devem ser diferentes.',
    'digits'               => 'Este campo deve conter :digits dígitos.',
    'digits_between'       => 'Este campo deve conter entre :min e :max dígitos.',
    'dimensions'           => 'Este campo possui dimensões inválidas de imagem.',
    'distinct'             => 'Este campo tem um valor duplicado.',
    'email'                => 'Este campo precisa ser um email válido.',
    'exists'               => 'Este campo selecionado é inválido.',
    'file'                 => 'Este campo deve ser um arquivo.',
    'filled'               => 'Este campo deve conter um valor.',
    'image'                => 'Este campo deve ser uma imagem.',
    'in'                   => 'Este campo selecionado é inválido.',
    'in_array'             => 'Este campo não existe em :other.',
    'integer'              => 'Este campo deve ser um inteiro.',
    'ip'                   => 'Este campo deve ser um endereço IP válido.',
    'ipv4'                 => 'Este campo deve ser um endereço IPv4 válido.',
    'ipv6'                 => 'Este campo deve ser um endereço IPv6 válido.',
    'json'                 => 'Este campo deve ser uma JSON válido.',
    'max'                  => [
        'numeric' => 'Este campo não deve ser maior que :max.',
        'file'    => 'Este campo não deve ser maior que :max kilobytes.',
        'string'  => 'Este campo não deve ser maior que :max caracteres.',
        'array'   => 'Este campo não deve possuir mais que :max itens.',
    ],
    'mimes'                => 'Este campo deve ser um arquivo do tipo: :values.',
    'mimetypes'            => 'Este campo deve ser um arquivo do tipo: :values.',
    'min'                  => [
        'numeric' => 'Este campo deve ser maior ou igual a :min.',
        'file'    => 'Este campo deve possuir ao menos :min kilobytes.',
        'string'  => 'Este campo deve possuir ao menos :min caracteres.',
        'array'   => 'Este campo deve possuir ao menos :min itens.',
    ],
    'not_in'               => 'Este campo selecionado é inválido.',
    'numeric'              => 'Este campo deve ser um número.',
    'present'              => 'Este campo deve estar preenchido.',
    'regex'                => 'O formato do campo :attribute é inválido.',
    'required'             => 'Este campo é obrigatório.',
    'required_if'          => 'Este campo é obrigatório quando :other é :value.',
    'required_unless'      => 'Este campo é obrigatório a menos que :other esteja em :values.',
    'required_with'        => 'Este campo é obrigatório quando :values está preenchido.',
    'required_with_all'    => 'Este campo é obrigatório quando :values está preenchido.',
    'required_without'     => 'Este campo é obrigatório quando :values não está preenchido.',
    'required_without_all' => 'Este campo é obrigatório quando nenhum destes :values estão preenchidos.',
    'same'                 => 'Este campo e :other devem coincidir.',
    'size'                 => [
        'numeric' => 'Este campo deve possuir tamanho igual a :size.',
        'file'    => 'Este campo deve possuir tamanho igual a :size kilobytes.',
        'string'  => 'Este campo deve conter :size caracteres.',
        'array'   => 'Este campo deve conter :size itens.',
    ],
    'string'               => 'Este campo deve ser uma palavra.',
    'timezone'             => 'Este campo deve ser uma zona de tempo válida.',
    'unique'               => 'Este campo já está em uso.',
    'uploaded'             => 'Este campo falhou durante o envio.',
    'url'                  => 'O formato de :attribute é inválido.',

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
