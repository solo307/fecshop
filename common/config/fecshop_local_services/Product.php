<?php
/**
 * FecShop file.
 *
 * @link http://www.fecshop.com/
 *
 * @copyright Copyright (c) 2016 FecShop Software LLC
 * @license http://www.fecshop.com/license/
 */
return [
    'product' => [
        // 'storagePath' => 'common\\local\\local_services\\product',
        // 'storage' => 'ProductMongodb',
        // 属性组的配置
        'customAttrGroup' => [
            //属性组的名字（每一个子项是一个属性组，譬如下面的clothes_group对应的就是一个属性组）
            'color_group' => [
                /*
                 * 属性组里面的属性有类别，目前有三个类
                 * 1. spu_attr 
                 * 1.1 spu和sku的概念：sku是产品的唯一标示，最小库存单位，譬如一款鞋子为一个spu，这款鞋子的不同的颜色和不同的尺码为一个sku，
                 * 1.2 什么是spu属性（spu_attr），当一款鞋子的不同的sku是颜色和尺码的不同，那么颜色和尺码就是这款鞋子的spu属性（spu_attr）。
                 * 1.2 spu_attr是用来在产品详细页面，将这个spu下面的所有sku串联起来，譬如页面：http://fecshop.appfront.fancyecommerce.com/index.php/raglan-sleeves-letter-printed-crew-neck-sweatshirt-53386451-77774122
                 * 		访问这款衣服的每一个SKU，都会把其他的sku列出来，点击后，就进去其他sku的页面，您会发现url是变化的，这个是类似于京东的方式。
                 *		注意：	1.2.1 因为组合的复杂性，spu attr最多设置2个属性，不能超过2个，超过两个请使用customer_option的方式。也就是类似于淘宝的方式。
                 * 				1.2.2 这里的属性需要严格按照下面的格式进行配置，如果您想配置自己的spu属性，那么
                 * 2. general_attr（普通属性），可以是各种格式的值，譬如时间格式，email格式，下拉条选择值等。这些属性可以用于分类侧栏属性过滤。
                 * 3. custom_options 这里是用户自定义属性，显示方式方面有点和spu属性类似，spu属性显示的方式是京东的方式，点击每一个选项是url跳转的
                 *    用户自定义类似于淘宝的方式，选择各个颜色尺码，页面是不跳转的，各个颜色尺码有相应的图片，库存，价格，sku等。
                 *	  您可以查看演示地址：http://fecshop.appfront.fancyecommerce.com/index.php/reindeer-pattern-glitter-christmas-dress-86519596
                 * 您可以给产品属性组添加的属性类型就上面几种，在后台编辑产品的时候，选择不同的属性组，就会加载相应的属性出来。
                 */
                'spu_attr' => [  // spu用来区分sku的属性，譬如下面的属性的不同，对应不同的sku，进而是不同的库存
                    // 第一个属性会被用户当做图片来显示。
                    'my_color'      => [
                        'dbtype'     => 'String',
                        'name'       => 'my_color',
                        'showAsImg'  => false,
                        'sort_order'   => 1,
                        'display' => [
                            'type' => 'select',
                            'data' => [
                                # 产品的spu属性的顺序，会按照下面的顺序进行排序。
                                'red',
                                'purple red',
                                'orange red',
                                'pink',
                                'oxblood red',
                                'blue',
                                'wathet',
                                'navy blue',
                                'green',
                                'turquoise',
                                'light green',
                                'yellow',
                                'beige',
                                'khaki',
                                'violet',
                                'dark purple',
                                'lavender',
                                'purple black',
                                'orange',
                                'orange yellow',
                                'white',
                                'black',
                                'gray',
                                'golden',
                                'silvery',
                            ],
                        ],
                        //'require' => 0,
                        //'default' => 2,
                    ],
                    
                ],
                'general_attr' => [
                    // 这是input type='text' 的类型
                    'my_remark' => [
                        'dbtype' => 'String',
                        'name'   => 'my_remark',
                        'display'=> [
                            'type' => 'inputString',   // 字符串格式的属性
                        ],
                        'require' => 0,
                    ],
                    // 这是input type='email' 的类型
                    'my_email' => [
                        'dbtype'  => 'String',
                        'name'    => 'my_email',
                        'require' => 0,
                        'display' => [
                            'type' => 'inputEmail',        // 字符串格式的属性（email格式验证）
                        ],
                    ],
                    // 这是input type='date' 的类型
                    'my_date'  => [
                        'name'   => 'my_date',
                        'display'=> [
                            'type' => 'inputDate',        // 字符串格式的属性（Date格式验证）
                        ],
                    ],
                    // 这是<select> 的类型
                ],

                'custom_options' => [
                    'my_color'      => [
                        'dbtype'    => 'String',  //类型
                        'name'      => 'my_color',      // 在数据库中存在的列名
                        'showAsImg' => false,  // （在前端展示部分）通过图片的方式展示属性。譬如；http://fecshop.appfront.fancyecommerce.com/index.php/reindeer-pattern-glitter-christmas-dress-86519596，
                                              //		你会发现，该属性对应的显示方式不是值，而是产品的图片。
                        'require' => 1,  // 1代表是必填选项，0代表选填
                        'display' => [
                            'type' => 'select',
                            'data' => [
                                'red',
                                'purple red',
                                'orange red',
                                'pink',
                                'oxblood red',
                                'blue',
                                'wathet',
                                'navy blue',
                                'green',
                                'turquoise',
                                'light green',
                                'yellow',
                                'beige',
                                'khaki',
                                'violet',
                                'dark purple',
                                'lavender',
                                'purple black',
                                'orange',
                                'orange yellow',
                                'white',
                                'black',
                                'gray',
                                'golden',
                                'silvery',
                            ],
                        ],

                    ],

                ],
            ],
            
            'type_group' => [
                'spu_attr' => [  // spu用来区分sku的属性，譬如下面的属性的不同，对应不同的sku，进而是不同的库存
                    // 第一个属性会被用户当做图片来显示。
                    'my_type'      => [
                        'dbtype'     => 'String',
                        'name'       => 'my_type',
                        'showAsImg'  => false,
                        'sort_order' => 1,
                        'display'    => [
                            'type' => 'select',
                            'data' => [
                                'A',
                                'B',
                                'C',
                                'D',
                                'E',
                                'F',
                                'G',
                            ],
                        ],
                    ],

                ],
                'general_attr' => [
                    // 这是input type='text' 的类型
                    'my_remark' => [
                        'dbtype' => 'String',
                        'name'   => 'my_remark',
                        'display'=> [
                            'type' => 'inputString',   // 字符串格式的属性
                        ],
                        'require' => 0,
                    ],
                    // 这是input type='email' 的类型
                    'my_email' => [
                        'dbtype'  => 'String',
                        'name'    => 'my_email',
                        'require' => 0,
                        'display' => [
                            'type' => 'inputEmail',        // 字符串格式的属性（email格式验证）
                        ],
                    ],
                    // 这是input type='date' 的类型
                    'my_date'  => [
                        'name'   => 'my_date',
                        'display'=> [
                            'type' => 'inputDate',        // 字符串格式的属性（Date格式验证）
                        ],
                    ],
                ],

                'custom_options' => [
                    'my_type'     => [
                        'dbtype'    => 'String',  //类型
                        'name'      => 'my_type',      // 在数据库中存在的列名
                        'showAsImg' => false,  // （在前端展示部分）通过图片的方式展示属性。譬如；http://fecshop.appfront.fancyecommerce.com/index.php/reindeer-pattern-glitter-christmas-dress-86519596，
                                              //		你会发现，该属性对应的显示方式不是值，而是产品的图片。
                        'require'   => 1,  // 1代表是必填选项，0代表选填
                        'display'   => [
                            'type'   => 'select',
                            'data' => [
                                # 产品的spu属性的顺序，会按照下面的顺序进行排序。
                                'A',
                                'B',
                                'C',
                                'D',
                                'E',
                                'F',
                                'G',
                            ],
                        ],
                    ],

                ],
            ],
            
            'number_group' => [
                'spu_attr' => [  // spu用来区分sku的属性，譬如下面的属性的不同，对应不同的sku，进而是不同的库存
                    // 第一个属性会被用户当做图片来显示。
                    'my_number'      => [
                        'dbtype'     => 'String',
                        'name'       => 'my_number',
                        'showAsImg'  => false,
                        'sort_order' => 1,
                        'display'    => [
                            'type' => 'select',
                            'data' => [
                                '1',
                                '2',
                                '3',
                                '4',
                                '5',
                                '6',
                                '7',
                                '8',
                                '9',
                            ],
                        ],
                    ],

                ],
                'general_attr' => [
                    // 这是input type='text' 的类型
                    'my_remark' => [
                        'dbtype' => 'String',
                        'name'   => 'my_remark',
                        'display'=> [
                            'type' => 'inputString',   // 字符串格式的属性
                        ],
                        'require' => 0,
                    ],
                    // 这是input type='email' 的类型
                    'my_email' => [
                        'dbtype'  => 'String',
                        'name'    => 'my_email',
                        'require' => 0,
                        'display' => [
                            'type' => 'inputEmail',        // 字符串格式的属性（email格式验证）
                        ],
                    ],
                    // 这是input type='date' 的类型
                    'my_date'  => [
                        'name'   => 'my_date',
                        'display'=> [
                            'type' => 'inputDate',        // 字符串格式的属性（Date格式验证）
                        ],
                    ],
                ],

                'custom_options' => [
                    'my_number'     => [
                        'dbtype'    => 'String',  //类型
                        'name'      => 'my_number',      // 在数据库中存在的列名
                        'showAsImg' => false,  // （在前端展示部分）通过图片的方式展示属性。譬如；http://fecshop.appfront.fancyecommerce.com/index.php/reindeer-pattern-glitter-christmas-dress-86519596，
                                              //		你会发现，该属性对应的显示方式不是值，而是产品的图片。
                        'require'   => 1,  // 1代表是必填选项，0代表选填
                        'display'   => [
                            'type'   => 'select',
                            'data' => [
                                # 产品的spu属性的顺序，会按照下面的顺序进行排序。
                                '1',
                                '2',
                                '3',
                                '4',
                                '5',
                                '6',
                                '7',
                                '8',
                                '9',
                            ],
                        ],
                    ],

                ],
            ],
      ],//分类外层括号
    ],
];
