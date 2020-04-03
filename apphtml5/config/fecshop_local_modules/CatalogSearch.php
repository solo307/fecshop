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
    'catalogsearch' => [
        'class' => '\fecshop\app\apphtml5\modules\Catalogsearch\Module',

        'params'=> [
            //'categorysearch_filter_attr' =>[
            //	'color','size',
            //],
            // ����ҳ���title ��ʽ ��%s ���ᱻ�滻��������
            'search_page_title_format' => 'Search Text: %s ',
            // ����ҳ��� meta keywords��ʽ ��%s ���ᱻ�滻��������
            'search_page_meta_keywords_format' => 'Search Text: %s ',
            // ����ҳ��� meta description��ʽ ��%s ���ᱻ�滻��������
            'search_page_meta_description_format' => 'Search Text: %s ',
            // ������������
            'product_search_max_count'  => 1000,
            // ����ҳ���Ƿ������м����
            'search_breadcrumbs'        => true,

            //'search_filter_category' 	=> true,

            'search_query' => [
                // �ŵ���һ���ľ���Ĭ��ֵ��Ʃ�������30
                'numPerPage' => [6],        // ��Ʒ��ʾ�������о�

                // �۸��������ã��������������ҳ��۸���ˣ�������������
                'price_range' => [
                    '0-35000',
                    '35000-85000',
                    '85000-170000',
                    '170000-350000',
                    '350000-700000',
                    '700000-1700000',
                    '1700000-',
                ],
            ],
        ],

    ],
];
