<?php

namespace Flagmark\Services;

class ImageUpload
{
    private $filename = '';

    private $countryImageIds = [
        'rus' => 'hzf8f9whr2ed0mogcobe',
        'lib' => 'lib_v1_cklenn',
    ];

    private $countryCode = 'rus';

    public function __construct()
    {
        \Cloudinary::config(array(
            'cloud_name' => getenv('CLOUDINARY_CLOUD_NAME'),
            'api_key' => getenv('CLOUDINARY_API_KEY'),
            'api_secret' => getenv('CLOUDINARY_API_SECRET'),
        ));
    }

    public function setCountryCode($countryCode)
    {
        if (!isset($this->countryImageIds[$countryCode])) {
            echo "This country image isn't uploaded yet.";
        }
        $this->countryCode = $countryCode;
    }

    public function getCountryImageId()
    {
        return $this->countryImageIds[$this->countryCode];
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

        return $this->convertImage($uploadedImage['public_id']);
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
