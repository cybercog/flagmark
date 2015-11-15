<?php

namespace Flagmark\Services;

class ImageUpload
{
    private $filename = '';

    public function __construct()
    {
        \Cloudinary::config(array(
            'cloud_name' => getenv('CLOUDINARY_CLOUD_NAME'),
            'api_key' => getenv('CLOUDINARY_API_KEY'),
            'api_secret' => getenv('CLOUDINARY_API_SECRET'),
        ));
    }

    public function setUploadedPhoto($file)
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

        $this->convertImage($uploadedImage['public_id']);
    }

    public function setFacebookPhoto($userId)
    {
        $options = [
            'type' => 'facebook',
            'overlay' => 'hzf8f9whr2ed0mogcobe',
            'transformation' => [
                'crop' => 'fit',
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
            'overlay' => 'hzf8f9whr2ed0mogcobe',
            'transformation' => [
                'width' => 508,
                'height' => 508,
            ],
        ];

        return cloudinary_url($this->filename, $options);
    }
}
