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

    'accepted' => ':attribute 必须被认可',
    'active_url' => ':attribute URL无效',
    'after' => ':attribute 必须在 :date 之后',
    'after_or_equal' => ':attribute 必须大于等于 :date',
    'alpha' => ':attribute 只包含字母',
    'alpha_dash' => ':attribute 只包含字母，数字，破折号和下划线',
    'alpha_num' => ':attribute 只包含字母和数字',
    'array' => ':attribute 只包含数组',
    'before' => ':attribute 必须在 :date 之前',
    'before_or_equal' => ':attribute 必须大于等于 :date',
    'between' => [
        'numeric' => ':attribute 必须在 :min - :max 之间',
        'file' => ' :attribute 必须在 :min - :max 字节之间',
        'string' => ' :attribute 必须在 :min - :max 字符之间',
        'array' => ' :attribute 必须在 :min - :max 之间',
    ],
    'boolean' => ' :attribute 字段必须为布尔型',
    'confirmed' => ' :attribute 不匹配',
    'date' => ' :attribute 不是有效日期',
    'date_equals' => ' :attribute 必须等于 :date.',
    'date_format' => ' :attribute 格式不匹配 :format.',
    'different' => ' :attribute 与 :other 必须不同',
    'digits' => ' :attribute 必须 :digits 位',
    'digits_between' => ' :attribute 必须在 :min - :max 位数之间',
    'dimensions' => ' :attribute 图像尺寸无效',
    'distinct' => ' :attribute 字段具有重复的值。',
    'email' => ' :attribute 必须是一个有效的电子邮件地址。',
    'ends_with' => ' :attribute 必须是下列值之一: :values',
    'exists' => ' :attribute 选项是无效的',
    'file' => ' :attribute 必须是个文件',
    'filled' => ' :attribute 必须有值',
    'gt' => [
        'numeric' => ' :attribute 必须大于 :value',
        'file' => ' :attribute 必须大于 :value 字节',
        'string' => ' :attribute 必须大于 :value 字符',
        'array' => ' :attribute 必须大于 :value',
    ],
    'gte' => [
        'numeric' => ' :attribute 必须大于或等于 :value',
        'file' => ' :attribute 必须大于或等于 :value 字节',
        'string' => ' :attribute 必须大于或等于 :value 字符',
        'array' => ' :attribute 必须有 :value 或者更多',
    ],
    'image' => ' :attribute 必须是个图片',
    'in' => ' 选项 :attribute 是无效的',
    'in_array' => ' :attribute 不属于 :other',
    'integer' => ' :attribute 必须是数字',
    'ip' => ' :attribute 必须是一个有效的ip地址',
    'ipv4' => ' :attribute 必须是有效的IPv4地址',
    'ipv6' => ' :attribute 必须是一个有效的IPv6地址',
    'json' => ' :attribute 必须是一个有效的JSON字符串',
    'lt' => [
        'numeric' => ' :attribute 必须小于 :value',
        'file' => ' :attribute 必须小于 :value 字节',
        'string' => ' :attribute 必须小于 :value 字符',
        'array' => ' :attribute 必须小于 :value ',
    ],
    'lte' => [
        'numeric' => ' :attribute 必须小于或等于 :value',
        'file' => ' :attribute 必须小于或等于 :value 字节.',
        'string' => ' :attribute 必须小于或等于 :value 字符.',
        'array' => ' :attribute 一定不能有超过 :value',
    ],
    'max' => [
        'numeric' => ' :attribute 不能大于 :max.',
        'file' => ' :attribute 不能大于 :max 字节',
        'string' => ' :attribute 不能大于 :max 字符.',
        'array' => ' :attribute 不能有 :max ',
    ],
    'mimes' => ' :attribute 必须是文件,类型: :values',
    'mimetypes' => ' :attribute 必须是文件,类型: :values.',
    'min' => [
        'numeric' => ' :attribute 最小为 :min.',
        'file' => ' :attribute 最小字节数为 :min ',
        'string' => ' :attribute 最小长度为 :min ',
        'array' => ' :attribute 最小长度 :min ',
    ],
    'not_in' => ' 选项 :attribute 无效',
    'not_regex' => ' :attribute 格式无效',
    'numeric' => ' :attribute 必须是数字',
    'present' => ' :attribute 不存在',
    'regex' => ' :attribute 格式无效',
    'required' => ' :attribute 必须填写',
    'required_if' => ' :attribute 为 :other 时 :value 必须填写',
    'required_unless' => ' :attribute 必须填写除非 :other 为 :values.',
    'required_with' => '当 :values 存在时 :attribute 必须填写',
    'required_with_all' => '当:values 存在时 :attribute 必须填写',
    'required_without' => ' 当 :values 不存在时 :attribute',
    'required_without_all' => '当 :values 不存在时 :attribute必须填写',
    'same' => ' :attribute 和 :other 必须匹配',
    'size' => [
        'numeric' => ' :attribute 长度必须为 :size.',
        'file' => ' :attribute 必须为 :size 个字节.',
        'string' => ' :attribute 必须为 :size 个字符.',
        'array' => ' :attribute 必须为 :size.',
    ],
    'starts_with' => ' :attribute 必须是下列值: :values',
    'string' => ' :attribute 必须是字符串',
    'timezone' => ' :attribute 必须是有效区域',
    'unique' => ' :attribute 已经存在',
    'uploaded' => ' :attribute 上传失败',
    'url' => ' :attribute 无效的url',
    'uuid' => ' :attribute UUID无效',
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
    | The following language lines are used to swap our attribute placeholder
    | with something more reader friendly such as "E-Mail Address" instead
    | of "email". This simply helps us make our message more expressive.
    |
    */

    'attributes' => [
        "account" => "账号",
        "password" => "密码",
        "captcha" => "验证码",
        "category_id" => "分类",
        "column_id" => "栏目",
        "intro" => "简介",
        "key_words" => "关键字",
        "title" => "标题",
        "author" => "作者",
        "source" => "来源",
        "editor" => "内容",
        "state" => "状态",
    ],

];
