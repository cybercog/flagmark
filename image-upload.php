<?php

class ImageUpload
{
    private $filename = '';

    public function __construct()
    {
        \Cloudinary::config(array(
            "cloud_name" => getenv('COUDINARY_CLOUD_NAME'),
            "api_key" => getenv('COUDINARY_API_KEY'),
            "api_secret" => getenv('COUDINARY_API_SECRET'),
        ));
    }

    public function upload($filename)
    {
        $uploadedImage = \Cloudinary\Uploader::upload($_FILES["avatar"]["tmp_name"],
            [
                "public_id" => time(), // :TODO: UUID here
                "crop" => "fit",
                "width" => "2000",
                "height" => "2000",
                "tags" => ["special", "for_people"]
            ]
        );

        $this->filename = $uploadedImage['public_id'];
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
