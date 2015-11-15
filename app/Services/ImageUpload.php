<?php

namespace Flagmark\Services;

class ImageUpload
{
    private $filename = '';

    private $countryImageIds = [
        'ru' => [
            'image_id' => 'hzf8f9whr2ed0mogcobe',
            'name' => 'Russia',
        ],
        'lb' => [
            'image_id' => 'lib_v1_cklenn',
            'name' => 'Lebanon',
        ],
        'fr' => [
            'image_id' => 'fr_v1_lrgtag',
            'name' => 'France',
        ],
        'jp' => [
            'image_id' => 'jp_v1_erct4l',
            'name' => 'Japan',
        ],
        'iq' => [
            'image_id' => 'iq_v1_smlos1',
            'name' => 'Iraq',
        ],
        'sy' => [
            'image_id' => 'sy_v1_xpisgd',
            'name' => 'Syria',
        ],
        'mx' => [
            'image_id' => 'mx_v1_iczewr',
            'name' => 'Mexico',
        ],
    ];

    private $countryCode = '';

    public function __construct()
    {
        \Cloudinary::config(array(
            'cloud_name' => getenv('CLOUDINARY_CLOUD_NAME'),
            'api_key' => getenv('CLOUDINARY_API_KEY'),
            'api_secret' => getenv('CLOUDINARY_API_SECRET'),
        ));
    }

    public function setCountryCode($countryCode = null)
    {
        if (!$countryCode || !isset($this->countryImageIds[$countryCode])) {
            $this->countryCode = 'ru';
        } else {
            $this->countryCode = $countryCode;
        }
    }

    public function getCountryImageIds()
    {
        return $this->countryImageIds;
    }

    public function getCountryImageId()
    {
        return $this->countryImageIds[$this->countryCode]['image_id'];
    }

    public function getUploadedPhoto($file)
    {
        $uploadedImage = \Cloudinary\Uploader::upload($file['avatar']['tmp_name'],
            [
                'public_id' => time(), // :TODO: UUID here
                'crop' => 'fit',
                'width' => '508',
                'height' => '508',
                'tags' => ['special', 'for_people']
            ]
        );

        $this->filename = $uploadedImage['public_id'];
        return $this->convertImage();
    }

    public function getFacebookPhoto($userId)
    {
        $options = [
            'type' => 'facebook',
            'overlay' => $this->getCountryImageId(),
            'transformation' => [
                'crop' => 'fill',
                'width' => 508,
                'height' => 508,
            ],
        ];

        return cloudinary_url($userId, $options);
    }

    private function convertImage()
    {
        $options = [
            'alt' => 'Flagmark image',
            'overlay' => $this->getCountryImageId(),
            'transformation' => [
                'width' => 508,
                'height' => 508,
            ],
        ];

        return cloudinary_url($this->filename, $options);
    }
}
