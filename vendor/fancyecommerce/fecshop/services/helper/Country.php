<?php

/*
 * FecShop file.
 *
 * @link http://www.fecshop.com/
 * @copyright Copyright (c) 2016 FecShop Software LLC
 * @license http://www.fecshop.com/license/
 */

namespace fecshop\services\helper;

use fecshop\services\Service;

/**
 * Country services.
 * @author Terry Zhao <2358269014@qq.com>
 * @since 1.0
 */
class Country extends Service
{
    public $default_country;

    /**
     * 得到默认的国家
     */
    public function getDefaultCountry()
    {
        if (!$this->default_country) {
            $this->default_country = 'VN';
        }

        return $this->default_country;
    }

    /**
     * 通过国家，得到省的option html的字符串
     */
    public function getStateOptionsByContryCode($CountryCode, $selected = '')
    {
        if (!$CountryCode) {
            $CountryCode = $this->getDefaultCountry();
        }
        $stateArr = $this->getStateByContryCode($CountryCode);
        $str = '';
        if (is_array($stateArr) && !empty($stateArr)) {
            if ($selected) {
                foreach ($stateArr as $code=>$name) {
                    if ($selected == $code || strtolower($selected) == strtolower($name)) {
                        $str .= '<option selected="selected" value="'.$code.'"  rel="'.$name.'">'.$name.'</option>';
                    } else {
                        $str .= '<option value="'.$code.'"  rel="'.$name.'" >'.$name.'</option>';
                    }
                }
            } else {
                foreach ($stateArr as $code=>$name) {
                    $str .= '<option value="'.$code.'" rel="'.$name.'">'.$name.'</option>';
                }
            }
        }

        return $str;
    }

    /**
     * 得到所有国家的option
     */
    public function getAllCountryOptions($name = 'country', $class = 'country', $current = '', $nullShow = '')
    {
        $all_country_array = $this->getAllCountryArray();
        if ($name && $class) {
            $str = '<select name="'.$name.'" class="'.$class.'">';
        }
        $str .= '<option value="">'.$nullShow.'</option>';
        foreach ($all_country_array as $k=>$v) {
            if ($current) {
                if ($k == $current) {
                    $str .= '<option selected="selected" value="'.$k.'">'.$v.'</option>';
                } else {
                    $str .= '<option value="'.$k.'">'.$v.'</option>';
                }
            } else {
                $str .= '<option value="'.$k.'">'.$v.'</option>';
            }
        }
        if ($name && $class) {
            $str .= '</select>';
        }

        return $str;
    }

    /**
     * 通过国家简码得到国家的全称名字
     */
    public function getCountryNameByKey($key)
    {
        $all_country = $this->getAllCountryArray();

        return isset($all_country[$key]) ? $all_country[$key] : $key;
    }

    /**
     * 国家option html
     */
    public function getCountryOptionsHtml($selectd = '')
    {
        if (!$selectd) {
            $selectd = $this->getDefaultCountry();
        }

        $all_country = $this->getAllCountryArray();
        $str = '';
        foreach ($all_country as $key=>$value) {
            if ($selectd && ($selectd == $key)) {
                $str .= '<option selected="selected" value="'.$key.'">'.$value.'</option>';
            } else {
                $str .= '<option value="'.$key.'">'.$value.'</option>';
            }
        }

        return $str;
    }

    /**
     * @param $countryCode |String 国家简码
     * @param $stateCode | String 省市简码
     * @return string OR Array 如果不传递省市简码，那么返回的是该国家对应的省市数组
     *                如果传递省市简码，传递的是省市的名称
     */
    public function getStateByContryCode($countryCode, $stateCode = '')
    {
        $countryStates = $this->getCountryStateArr();
        $returnStateArr = [];
        $returnStateName = '';
        if ($countryCode) {
            if ($stateCode) {
                if (isset($countryStates[$countryCode][$stateCode]) && !empty($countryStates[$countryCode][$stateCode])) {
                    $returnStateName = $countryStates[$countryCode][$stateCode];
                }

                return $returnStateName ? $returnStateName : $stateCode;
            } else {
                if (isset($countryStates[$countryCode]) && !empty($countryStates[$countryCode]) && is_array($countryStates[$countryCode])) {
                    $returnStateArr = $countryStates[$countryCode];
                }

                return $returnStateArr;
            }
        }
    }

    /**
     * @return array ，得到所有国家的数组
     *               格式：['国家简码' => '国家全称']
     */
    public static function getAllCountryArray()
    {
        return [
/**
            'AF'=>'Afghanistan',
            'AX'=>'Åland Islands',
            'AL'=>'Albania',
            'DZ'=>'Algeria',
            'AS'=>'American Samoa',
            'AD'=>'Andorra',
            'AO'=>'Angola',
            'AI'=>'Anguilla',
            'AQ'=>'Antarctica',
            'AG'=>'Antigua and Barbuda',
            'AR'=>'Argentina',
            'AM'=>'Armenia',
            'AW'=>'Aruba',
            'AU'=>'Australia',
            'AT'=>'Austria',
            'AZ'=>'Azerbaijan',
            'BS'=>'Bahamas',
            'BH'=>'Bahrain',
            'BD'=>'Bangladesh',
            'BB'=>'Barbados',
            'BY'=>'Belarus',
            'BE'=>'Belgium',
            'BZ'=>'Belize',
            'BJ'=>'Benin',
            'BM'=>'Bermuda',
            'BT'=>'Bhutan',
            'BO'=>'Bolivia',
            'BA'=>'Bosnia and Herzegovina',
            'BW'=>'Botswana',
            'BV'=>'Bouvet Island',
            'BR'=>'Brazil',
            'IO'=>'British Indian Ocean Territory',
            'VG'=>'British Virgin Islands',
            'BN'=>'Brunei',
            'BG'=>'Bulgaria',
            'BF'=>'Burkina Faso',
            'BI'=>'Burundi',
            'KH'=>'Cambodia',
            'CM'=>'Cameroon',
            'CA'=>'Canada',
            'CV'=>'Cape Verde',
            'KY'=>'Cayman Islands',
            'CF'=>'Central African Republic',
            'TD'=>'Chad',
            'CL'=>'Chile',
            'CN'=>'China',
            'CX'=>'Christmas Island',
            'CC'=>'Cocos [Keeling] Islands',
            'CO'=>'Colombia',
            'KM'=>'Comoros',
            'CG'=>'Congo - Brazzaville',
            'CD'=>'Congo - Kinshasa',
            'CK'=>'Cook Islands',
            'CR'=>'Costa Rica',
            'CI'=>'Côte d’Ivoire',
            'HR'=>'Croatia',
            'CU'=>'Cuba',
            'CY'=>'Cyprus',
            'CZ'=>'Czech Republic',
            'DK'=>'Denmark',
            'DJ'=>'Djibouti',
            'DM'=>'Dominica',
            'DO'=>'Dominican Republic',
            'EC'=>'Ecuador',
            'EG'=>'Egypt',
            'SV'=>'El Salvador',
            'GQ'=>'Equatorial Guinea',
            'ER'=>'Eritrea',
            'EE'=>'Estonia',
            'ET'=>'Ethiopia',
            'FK'=>'Falkland Islands',
            'FO'=>'Faroe Islands',
            'FJ'=>'Fiji',
            'FI'=>'Finland',
            'FR'=>'France',
            'GF'=>'French Guiana',
            'PF'=>'French Polynesia',
            'TF'=>'French Southern Territories',
            'GA'=>'Gabon',
            'GM'=>'Gambia',
            'GE'=>'Georgia',
            'DE'=>'Germany',
            'GH'=>'Ghana',
            'GI'=>'Gibraltar',
            'GR'=>'Greece',
            'GL'=>'Greenland',
            'GD'=>'Grenada',
            'GP'=>'Guadeloupe',
            'GU'=>'Guam',
            'GT'=>'Guatemala',
            'GG'=>'Guernsey',
            'GN'=>'Guinea',
            'GW'=>'Guinea-Bissau',
            'GY'=>'Guyana',
            'HT'=>'Haiti',
            'HM'=>'Heard Island and McDonald Islands',
            'HN'=>'Honduras',
            'HK'=>'Hong Kong SAR China',
            'HU'=>'Hungary',
            'IS'=>'Iceland',
            'IN'=>'India',
            'ID'=>'Indonesia',
            'IR'=>'Iran',
            'IQ'=>'Iraq',
            'IE'=>'Ireland',
            'IM'=>'Isle of Man',
            'IL'=>'Israel',
            'IT'=>'Italy',
            'JM'=>'Jamaica',
            'JP'=>'Japan',
            'JE'=>'Jersey',
            'JO'=>'Jordan',
            'KZ'=>'Kazakhstan',
            'KE'=>'Kenya',
            'KI'=>'Kiribati',
            'KW'=>'Kuwait',
            'KG'=>'Kyrgyzstan',
            'LA'=>'Laos',
            'LV'=>'Latvia',
            'LB'=>'Lebanon',
            'LS'=>'Lesotho',
            'LR'=>'Liberia',
            'LY'=>'Libya',
            'LI'=>'Liechtenstein',
            'LT'=>'Lithuania',
            'LU'=>'Luxembourg',
            'MO'=>'Macau SAR China',
            'MK'=>'Macedonia',
            'MG'=>'Madagascar',
            'MW'=>'Malawi',
            'MY'=>'Malaysia',
            'MV'=>'Maldives',
            'ML'=>'Mali',
            'MT'=>'Malta',
            'MH'=>'Marshall Islands',
            'MQ'=>'Martinique',
            'MR'=>'Mauritania',
            'MU'=>'Mauritius',
            'YT'=>'Mayotte',
            'MX'=>'Mexico',
            'FM'=>'Micronesia',
            'MD'=>'Moldova',
            'MC'=>'Monaco',
            'MN'=>'Mongolia',
            'ME'=>'Montenegro',
            'MS'=>'Montserrat',
            'MA'=>'Morocco',
            'MZ'=>'Mozambique',
            'MM'=>'Myanmar [Burma]',
            'NA'=>'Namibia',
            'NR'=>'Nauru',
            'NP'=>'Nepal',
            'NL'=>'Netherlands',
            'AN'=>'Netherlands Antilles',
            'NC'=>'New Caledonia',
            'NZ'=>'New Zealand',
            'NI'=>'Nicaragua',
            'NE'=>'Niger',
            'NG'=>'Nigeria',
            'NU'=>'Niue',
            'NF'=>'Norfolk Island',
            'MP'=>'Northern Mariana Islands',
            'KP'=>'North Korea',
            'NO'=>'Norway',
            'OM'=>'Oman',
            'PK'=>'Pakistan',
            'PW'=>'Palau',
            'PS'=>'Palestinian Territories',
            'PA'=>'Panama',
            'PG'=>'Papua New Guinea',
            'PY'=>'Paraguay',
            'PE'=>'Peru',
            'PH'=>'Philippines',
            'PN'=>'Pitcairn Islands',
            'PL'=>'Poland',
            'PT'=>'Portugal',
            'PR'=>'Puerto Rico',
            'QA'=>'Qatar',
            'RE'=>'R¨¦union',
            'RO'=>'Romania',
            'RU'=>'Russia',
            'RW'=>'Rwanda',
            'BL'=>'Saint Barth¨¦lemy',
            'SH'=>'Saint Helena',
            'KN'=>'Saint Kitts and Nevis',
            'LC'=>'Saint Lucia',
            'MF'=>'Saint Martin',
            'PM'=>'Saint Pierre and Miquelon',
            'VC'=>'Saint Vincent and the Grenadines',
            'WS'=>'Samoa',
            'SM'=>'San Marino',
            'ST'=>'São Tomé and Príncipe',
            'SA'=>'Saudi Arabia',
            'SN'=>'Senegal',
            'RS'=>'Serbia',
            'SC'=>'Seychelles',
            'SL'=>'Sierra Leone',
            'SG'=>'Singapore',
            'SK'=>'Slovakia',
            'SI'=>'Slovenia',
            'SB'=>'Solomon Islands',
            'SO'=>'Somalia',
            'ZA'=>'South Africa',
            'GS'=>'South Georgia and the South Sandwich Islands',
            'KR'=>'South Korea',
            'ES'=>'Spain',
            'LK'=>'Sri Lanka',
            'SD'=>'Sudan',
            'SR'=>'Suriname',
            'SJ'=>'Svalbard and Jan Mayen',
            'SZ'=>'Swaziland',
            'SE'=>'Sweden',
            'CH'=>'Switzerland',
            'SY'=>'Syria',
            'TW'=>'Taiwan',
            'TJ'=>'Tajikistan',
            'TZ'=>'Tanzania',
            'TH'=>'Thailand',
            'TL'=>'Timor-Leste',
            'TG'=>'Togo',
            'TK'=>'Tokelau',
            'TO'=>'Tonga',
            'TT'=>'Trinidad and Tobago',
            'TN'=>'Tunisia',
            'TR'=>'Turkey',
            'TM'=>'Turkmenistan',
            'TC'=>'Turks and Caicos Islands',
            'TV'=>'Tuvalu',
            'UG'=>'Uganda',
            'UA'=>'Ukraine',
            'AE'=>'United Arab Emirates',
            'GB'=>'United Kingdom',
            'US'=>'United States',
            'UY'=>'Uruguay',
            'UM'=>'U.S. Minor Outlying Islands',
            'VI'=>'U.S. Virgin Islands',
            'UZ'=>'Uzbekistan',
            'VU'=>'Vanuatu',
            'VA'=>'Vatican City',
            'VE'=>'Venezuela',
            'VN'=>'Vietnam',
            'WF'=>'Wallis and Futuna',
            'EH'=>'Western Sahara',
            'YE'=>'Yemen',
            'ZM'=>'Zambia',
            'ZW'=>'Zimbabwe',
*/
            'VN'=>'Vietnam',
            'CN'=>'China',
        ];
    }

    /**
     * 得到国家和省市数组
     * 格式为： [
     *				国家简码 =>
     *					[
     *						省/市简码 => 省/市名称,
     *						省/市简码 => 省/市名称,
     *						省/市简码 => 省/市名称,
     *					]
     *				]
     *			]
     * 在选择国家后，省市的信息会以ajax的形式带出，存在以下列表的国家，会以下拉选择条
     * 的方式显示，如果不存在以下列表，则显示inputtext输入框，如果您想要某个国家的省市以
     * 下拉条的方式选择，可以在下面的函数里面添加对应的国家和省市信息，添加后
     * 选择国家后，省市会以下拉条的方式供用户选择，而不是inputtext填写省市信息。
     */
    public function getCountryStateArr()
    {
        $data = [
            'US' => [
                'AL' => 'Alabama',
                'AK' => 'Alaska',
                'AS' => 'American Samoa',
                'AZ' => 'Arizona',
                'AR' => 'Arkansas',
                'AF' => 'Armed Forces Africa',
                'AA' => 'Armed Forces Americas',
                'AC' => 'Armed Forces Canada',
                'AE' => 'Armed Forces Europe',
                'AM' => 'Armed Forces Middle East',
                'AP' => 'Armed Forces Pacific',
                'CA' => 'California',
                'CO' => 'Colorado',
                'CT' => 'Connecticut',
                'DE' => 'Delaware',
                'DC' => 'District of Columbia',
                'FM' => 'Federated States Of Micronesia',
                'FL' => 'Florida',
                'GA' => 'Georgia',
                'GU' => 'Guam',
                'HI' => 'Hawaii',
                'ID' => 'Idaho',
                'IL' => 'Illinois',
                'IN' => 'Indiana',
                'IA' => 'Iowa',
                'KS' => 'Kansas',
                'KY' => 'Kentucky',
                'LA' => 'Louisiana',
                'ME' => 'Maine',
                'MH' => 'Marshall Islands',
                'MD' => 'Maryland',
                'MA' => 'Massachusetts',
                'MI' => 'Michigan',
                'MN' => 'Minnesota',
                'MS' => 'Mississippi',
                'MO' => 'Missouri',
                'MT' => 'Montana',
                'NE' => 'Nebraska',
                'NV' => 'Nevada',
                'NH' => 'New Hampshire',
                'NJ' => 'New Jersey',
                'NM' => 'New Mexico',
                'NY' => 'New York',
                'NC' => 'North Carolina',
                'ND' => 'North Dakota',
                'MP' => 'Northern Mariana Islands',
                'OH' => 'Ohio',
                'OK' => 'Oklahoma',
                'OR' => 'Oregon',
                'PW' => 'Palau',
                'PA' => 'Pennsylvania',
                'PR' => 'Puerto Rico',
                'RI' => 'Rhode Island',
                'SC' => 'South Carolina',
                'SD' => 'South Dakota',
                'TN' => 'Tennessee',
                'TX' => 'Texas',
                'UT' => 'Utah',
                'VT' => 'Vermont',
                'VI' => 'Virgin Islands',
                'VA' => 'Virginia',
                'WA' => 'Washington',
                'WV' => 'West Virginia',
                'WI' => 'Wisconsin',
                'WY' => 'Wyoming',
            ],
	    'VN' => [
		'Thành phố Hà Nội' => 'Thành phố Hà Nội',
		'Thành phố Hồ Chí Minh' => 'Thành phố Hồ Chí Minh',
		'Thành phố Đà Nẵng' => 'Thành phố Đà Nẵng',
		'Thành phố Cần Thơ' => 'Thành phố Cần Thơ',
		'Thành phố Hải Phòng' => 'Thành phố Hải Phòng',
		'Tỉnh Thừa Thiên Huế' => 'Tỉnh Thừa Thiên Huế',
		'Tỉnh Bắc Ninh' => 'Tỉnh Bắc Ninh',
		'Tỉnh Quảng Nam' => 'Tỉnh Quảng Nam',
		'Tỉnh Bắc Giang' => 'Tỉnh Bắc Giang',
		'Tỉnh Quảng Ngãi' => 'Tỉnh Quảng Ngãi',
		'Tỉnh Bạc Liêu' => 'Tỉnh Bạc Liêu',
		'Tỉnh Kon Tum' => 'Tỉnh Kon Tum',
		'Tỉnh Bắc Kạn' => 'Tỉnh Bắc Kạn',
		'Tỉnh Bình Định' => 'Tỉnh Bình Định',
		'Tỉnh Lạng Sơn' => 'Tỉnh Lạng Sơn',
		'Tỉnh Gia Lai' => 'Tỉnh Gia Lai',
		'Tỉnh Cao Bằng' => 'Tỉnh Cao Bằng',
		'Tỉnh Phú yên' => 'Tỉnh Phú yên',
		'Tỉnh Hà Giang' => 'Tỉnh Hà Giang',
		'Tỉnh Đắc Lắc' => 'Tỉnh Đắc Lắc',
		'Tỉnh Đắk Nông' => 'Tỉnh Đắk Nông',
		'Tỉnh Điện Biên' => 'Tỉnh Điện Biên',
		'Tỉnh Lào Cai' => 'Tỉnh Lào Cai',
		'Tỉnh Khánh Hòa' => 'Tỉnh Khánh Hòa',
		'Tỉnh Lai Châu' => 'Tỉnh Lai Châu',
		'Tỉnh Ninh Thuận' => 'Tỉnh Ninh Thuận',
		'Tỉnh Tuyên Quang' => 'Tỉnh Tuyên Quang',
		'Tỉnh Lâm Đồng' => 'Tỉnh Lâm Đồng',
		'Tỉnh Yên Bái' => 'Tỉnh Yên Bái',
		'Tỉnh Bình Phước' => 'Tỉnh Bình Phước',
		'Tỉnh Thái Nguyên' => 'Tỉnh Thái Nguyên',
		'Tỉnh Bình Thuận' => 'Tỉnh Bình Thuận',
		'Tỉnh Phú Thọ' => 'Tỉnh Phú Thọ',
		'Tỉnh Đồng Nai' => 'Tỉnh Đồng Nai',
		'Tỉnh Sơn La' => 'Tỉnh Sơn La',
		'Tỉnh Tây Ninh' => 'Tỉnh Tây Ninh',
		'Tỉnh Vĩnh Phúc' => 'Tỉnh Vĩnh Phúc',
		'Tỉnh Bình Dương' => 'Tỉnh Bình Dương',
		'Tỉnh Quảng Ninh' => 'Tỉnh Quảng Ninh',
		'Tỉnh Bà Rịa Vũng Tàu' => 'Tỉnh Bà Rịa Vũng Tàu',
		'Tỉnh Hải Dương' => 'Tỉnh Hải Dương',
		'Tỉnh Long An' => 'Tỉnh Long An',
		'Tỉnh Hưng Yên' => 'Tỉnh Hưng Yên',
		'Tỉnh Đồng Tháp' => 'Tỉnh Đồng Tháp',
		'Tỉnh kiên giang' => 'Tỉnh kiên giang',
		'Tỉnh Tiền Giang' => 'Tỉnh Tiền Giang',
		'Tỉnh Hòa Bình' => 'Tỉnh Hòa Bình',
		'Tinh An Giang' => 'Tinh An Giang',
		'Tỉnh Hà Nam' => 'Tỉnh Hà Nam',
		'Tỉnh Hà tây' => 'Tỉnh Hà tây',
		'Tỉnh Thái Bình' => 'Tỉnh Thái Bình',
		'Tỉnh Vĩnh Long' => 'Tỉnh Vĩnh Long',
		'Tỉnh Ninh Bình' => 'Tỉnh Ninh Bình',
		'Tỉnh Bến Tre' => 'Tỉnh Bến Tre',
		'Tỉnh Nam Định' => 'Tỉnh Nam Định',
		'Tỉnh Trà Vinh' => 'Tỉnh Trà Vinh',
		'Tỉnh Thanh Hóa' => 'Tỉnh Thanh Hóa',
		'Tỉnh Nghệ An' => 'Tỉnh Nghệ An',
		'Tỉnh Sóc Trăng' => 'Tỉnh Sóc Trăng',
		'Tỉnh Hà Tĩnh' => 'Tỉnh Hà Tĩnh',
		'Tỉnh Quảng Bình' => 'Tỉnh Quảng Bình',
		'Tỉnh Quảng Trị' => 'Tỉnh Quảng Trị',
		'Tỉnh Cà Mau' => 'Tỉnh Cà Mau',
	    ],
            'CN' => [
                'BJ' => '北京市',
                'SH' => '上海市',
                'TJ' => '天津市',
                'CQ' => '重庆市',
                'HEB' => '河北省',
                'SAX' => '山西省',
                'LN' => '辽宁省',
                'JL' => '吉林省',
                'HLJ' => '黑龙江省',
                'JS' => '江苏省',
                'ZJ' => '浙江省',
                'AH' => '安徽省',
                'FJ' => '福建省',
                'JX' => '江西省',
                'SD' => '山东省',
                'HEN' => '河南省',
                'HUB' => '湖北省',
                'HUN' => '湖南省',
                'GD' => '广东省',
                'HN' => '海南省',
                'SC' => '四川省',
                'HZ' => '贵州省',
                'YN' => '云南省',
                'SNX' => '陕西省',
                'GS' => '甘肃省',
                'QH' => '青海省',
                'TW' => '台湾省',
                'GX' => '广西壮族自治区',
                'NMG' => '内蒙古自治区',
                'XZ' => '西藏自治区',
                'NX' => '宁夏回族自治区',
                'XJ' => '新疆维吾尔自治区',
                'XG' => '香港特别行政区',

            ],

        ];

        return $data;
    }
}
