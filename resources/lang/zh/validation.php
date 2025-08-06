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

    'accepted' => ':attribute 字段必须被接受。',
    'accepted_if' => '当 :other 为 :value 时，:attribute 字段必须被接受。',
    'active_url' => ':attribute 字段必须是有效的URL。',
    'after' => ':attribute 字段必须是 :date 之后的日期。',
    'after_or_equal' => ':attribute 字段必须是 :date 之后或等于 :date 的日期。',
    'alpha' => ':attribute 字段只能包含字母。',
    'alpha_dash' => ':attribute 字段只能包含字母、数字、破折号和下划线。',
    'alpha_num' => ':attribute 字段只能包含字母和数字。',
    'any_of' => ':attribute 字段无效。',
    'array' => ':attribute 字段必须是数组。',
    'ascii' => ':attribute 字段只能包含单字节字母数字字符和符号。',
    'before' => ':attribute 字段必须是 :date 之前的日期。',
    'before_or_equal' => ':attribute 字段必须是 :date 之前或等于 :date 的日期。',
    'between' => [
        'array' => ':attribute 字段必须有 :min 到 :max 个项目。',
        'file' => ':attribute 字段必须在 :min 到 :max KB 之间。',
        'numeric' => ':attribute 字段必须在 :min 到 :max 之间。',
        'string' => ':attribute 字段必须在 :min 到 :max 个字符之间。',
    ],
    'boolean' => ':attribute 字段必须为真或假。',
    'can' => ':attribute 字段包含未授权的值。',
    'confirmed' => ':attribute 字段确认不匹配。',
    'contains' => ':attribute 字段缺少必需的值。',
    'current_password' => '密码不正确。',
    'date' => ':attribute 字段必须是有效日期。',
    'date_equals' => ':attribute 字段必须等于 :date。',
    'date_format' => ':attribute 字段必须符合格式 :format。',
    'decimal' => ':attribute 字段必须有 :decimal 位小数。',
    'declined' => ':attribute 字段必须被拒绝。',
    'declined_if' => '当 :other 为 :value 时，:attribute 字段必须被拒绝。',
    'different' => ':attribute 字段和 :other 必须不同。',
    'digits' => ':attribute 字段必须是 :digits 位数字。',
    'digits_between' => ':attribute 字段必须在 :min 到 :max 位数字之间。',
    'dimensions' => ':attribute 字段的图像尺寸无效。',
    'distinct' => ':attribute 字段有重复值。',
    'doesnt_end_with' => ':attribute 字段不能以以下之一结尾：:values。',
    'doesnt_start_with' => ':attribute 字段不能以以下之一开头：:values。',
    'email' => ':attribute 字段必须是有效的电子邮件地址。',
    'ends_with' => ':attribute 字段必须以以下之一结尾：:values。',
    'enum' => '选择的 :attribute 无效。',
    'exists' => '选择的 :attribute 无效。',
    'extensions' => ':attribute 字段必须具有以下扩展名之一：:values。',
    'file' => ':attribute 字段必须是文件。',
    'filled' => ':attribute 字段必须有值。',
    'gt' => [
        'array' => ':attribute 字段必须有超过 :value 个项目。',
        'file' => ':attribute 字段必须大于 :value KB。',
        'numeric' => ':attribute 字段必须大于 :value。',
        'string' => ':attribute 字段必须超过 :value 个字符。',
    ],
    'gte' => [
        'array' => ':attribute 字段必须有 :value 个或更多项目。',
        'file' => ':attribute 字段必须大于或等于 :value KB。',
        'numeric' => ':attribute 字段必须大于或等于 :value。',
        'string' => ':attribute 字段必须大于或等于 :value 个字符。',
    ],
    'hex_color' => ':attribute 字段必须是有效的十六进制颜色。',
    'image' => ':attribute 字段必须是图像。',
    'in' => '选择的 :attribute 无效。',
    'in_array' => ':attribute 字段必须存在于 :other 中。',
    'in_array_keys' => ':attribute 字段必须包含以下键之一：:values。',
    'integer' => ':attribute 字段必须是整数。',
    'ip' => ':attribute 字段必须是有效的IP地址。',
    'ipv4' => ':attribute 字段必须是有效的IPv4地址。',
    'ipv6' => ':attribute 字段必须是有效的IPv6地址。',
    'json' => ':attribute 字段必须是有效的JSON字符串。',
    'list' => ':attribute 字段必须是列表。',
    'lowercase' => ':attribute 字段必须是小写。',
    'lt' => [
        'array' => ':attribute 字段必须少于 :value 个项目。',
        'file' => ':attribute 字段必须小于 :value KB。',
        'numeric' => ':attribute 字段必须小于 :value。',
        'string' => ':attribute 字段必须少于 :value 个字符。',
    ],
    'lte' => [
        'array' => ':attribute 字段不能超过 :value 个项目。',
        'file' => ':attribute 字段必须小于或等于 :value KB。',
        'numeric' => ':attribute 字段必须小于或等于 :value。',
        'string' => ':attribute 字段必须小于或等于 :value 个字符。',
    ],
    'mac_address' => ':attribute 字段必须是有效的MAC地址。',
    'max' => [
        'array' => ':attribute 字段不能超过 :max 个项目。',
        'file' => ':attribute 字段不能超过 :max KB。',
        'numeric' => ':attribute 字段不能超过 :max。',
        'string' => ':attribute 字段不能超过 :max 个字符。',
    ],
    'max_digits' => ':attribute 字段不能超过 :max 位数字。',
    'mimes' => ':attribute 字段必须是以下类型的文件：:values。',
    'mimetypes' => ':attribute 字段必须是以下类型的文件：:values。',
    'min' => [
        'array' => ':attribute 字段至少必须有 :min 个项目。',
        'file' => ':attribute 字段至少必须有 :min KB。',
        'numeric' => ':attribute 字段至少必须为 :min。',
        'string' => ':attribute 字段至少必须有 :min 个字符。',
    ],
    'min_digits' => ':attribute 字段至少必须有 :min 位数字。',
    'missing' => ':attribute 字段必须缺失。',
    'missing_if' => '当 :other 为 :value 时，:attribute 字段必须缺失。',
    'missing_unless' => '除非 :other 为 :value，否则 :attribute 字段必须缺失。',
    'missing_with' => '当存在 :values 时，:attribute 字段必须缺失。',
    'missing_with_all' => '当存在 :values 时，:attribute 字段必须缺失。',
    'multiple_of' => ':attribute 字段必须是 :value 的倍数。',
    'not_in' => '选择的 :attribute 无效。',
    'not_regex' => ':attribute 字段格式无效。',
    'numeric' => ':attribute 字段必须是数字。',
    'password' => [
        'letters' => ':attribute 字段必须至少包含一个字母。',
        'mixed' => ':attribute 字段必须至少包含一个大写字母和一个小写字母。',
        'numbers' => ':attribute 字段必须至少包含一个数字。',
        'symbols' => ':attribute 字段必须至少包含一个符号。',
        'uncompromised' => '给定的 :attribute 出现在数据泄露中。请选择不同的 :attribute。',
    ],
    'present' => ':attribute 字段必须存在。',
    'present_if' => '当 :other 为 :value 时，:attribute 字段必须存在。',
    'present_unless' => '除非 :other 为 :value，否则 :attribute 字段必须存在。',
    'present_with' => '当存在 :values 时，:attribute 字段必须存在。',
    'present_with_all' => '当存在 :values 时，:attribute 字段必须存在。',
    'prohibited' => ':attribute 字段被禁止。',
    'prohibited_if' => '当 :other 为 :value 时，:attribute 字段被禁止。',
    'prohibited_unless' => '除非 :other 在 :values 中，否则 :attribute 字段被禁止。',
    'prohibits' => ':attribute 字段禁止存在 :other。',
    'regex' => ':attribute 字段格式无效。',
    'required' => ':attribute 字段是必需的。',
    'required_array_keys' => ':attribute 字段必须包含以下条目：:values。',
    'required_if' => '当 :other 为 :value 时，:attribute 字段是必需的。',
    'required_if_accepted' => '当接受 :other 时，:attribute 字段是必需的。',
    'required_if_declined' => '当拒绝 :other 时，:attribute 字段是必需的。',
    'required_unless' => '除非 :other 在 :values 中，否则 :attribute 字段是必需的。',
    'required_with' => '当存在 :values 时，:attribute 字段是必需的。',
    'required_with_all' => '当存在 :values 时，:attribute 字段是必需的。',
    'required_without' => '当不存在 :values 时，:attribute 字段是必需的。',
    'required_without_all' => '当不存在任何 :values 时，:attribute 字段是必需的。',
    'same' => ':attribute 字段必须与 :other 匹配。',
    'size' => [
        'array' => ':attribute 字段必须包含 :size 个项目。',
        'file' => ':attribute 字段必须为 :size KB。',
        'numeric' => ':attribute 字段必须为 :size。',
        'string' => ':attribute 字段必须为 :size 个字符。',
    ],
    'starts_with' => ':attribute 字段必须以以下之一开头：:values。',
    'string' => ':attribute 字段必须是字符串。',
    'timezone' => ':attribute 字段必须是有效的时区。',
    'unique' => ':attribute 已被占用。',
    'uploaded' => ':attribute 上传失败。',
    'uppercase' => ':attribute 字段必须是大写。',
    'url' => ':attribute 字段必须是有效的URL。',
    'ulid' => ':attribute 字段必须是有效的ULID。',
    'uuid' => ':attribute 字段必须是有效的UUID。',

    /*
    |--------------------------------------------------------------------------
    | Custom Validation Language Lines
    |--------------------------------------------------------------------------
    |
    | Here you may specify custom validation messages for attributes using the
    | convention "rule.attribute" to name the lines. This makes it quick to
    | specify a specific custom language line for a given attribute rule.
    |
    */

    'custom' => [
        'attribute-name' => [
            'rule-name' => '自定义消息',
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
        'name' => '姓名',
        'code' => '代码',
        'nationality' => '国籍',
        'age' => '年龄',
        'education' => '教育程度',
        'marital_status' => '婚姻状况',
        'religion' => '宗教',
        'height' => '身高',
        'weight' => '体重',
        'photo' => '照片',
        'date_of_birth' => '出生日期',
        'passport_number' => '护照号码',
        'phone' => '电话',
        'email' => '电子邮件',
        'address' => '地址',
        'emergency_contact' => '紧急联系人',
        'emergency_phone' => '紧急联系电话',
        'languages' => '语言技能',
        'english' => '英语',
        'chinese' => '中文',
        'cantonese' => '粤语',
        'hong_kong_experience' => '香港工作经验',
        'singapore_experience' => '新加坡工作经验',
        'taiwan_experience' => '台湾工作经验',
        'malaysia_experience' => '马来西亚工作经验',
        'brunei_experience' => '文莱工作经验',
        'company_name' => '公司名称',
        'position' => '职位',
        'start_date' => '开始日期',
        'end_date' => '结束日期',
        'salary' => '薪资',
        'duties' => '工作职责',
        'reason_for_leaving' => '离职原因',
        'password' => '密码',
        'password_confirmation' => '确认密码',
    ],

];
