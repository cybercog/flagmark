<?php

class ImageUpload
{
    private $filename = '';

    public function __construct()
    {
        \Cloudinary::config(array(
            "cloud_name" => getenv('CLOUDINARY_CLOUD_NAME'),
            "api_key" => getenv('CLOUDINARY_API_KEY'),
            "api_secret" => getenv('CLOUDINARY_API_SECRET'),
        ));
    }

    public function upload($filename)
    {
        $uploadedImage = \Cloudinary\Uploader::upload($_FILES["avatar"]["tmp_name"],
            [
                "public_id" => time(), // :TODO: UUID here
                "crop" => "fit",
                "width" => "508",
                "height" => "508",
                "tags" => ["special", "for_people"]
            ]
        );

        $this->filename = $uploadedImage['public_id'];
    }

    public function getFacebookPhoto($userId)
    {
        return facebook_profile_image_tag($userId);
    }

    public function getImage()
    {
        return cl_image_tag($this->filename, [
            "alt" => ":(",
            "overlay" => 'hzf8f9whr2ed0mogcobe',
            'transformation' => [
                'width' => 508,
                'height' => 508,
            ]
        ]);
    }
}
