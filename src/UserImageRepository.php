<?php
/**
 * holds default images for Profile Pictures
 */
namespace Itb;

/**
 * to store images
 * Class UserImageRepository
 * @package Itb
 */
class UserImageRepository
{
    /**
     * to store an array of strings/name of images
     * @var array
     */
    private $images;

    /**
     * default images
     * UserImageRepository constructor.
     */
    public function __construct()
    {
        $this->images = [
            'elsa.jpg',
            'anna.jpg',
            'olaf.jpg'
        ];
    }

    /**
     * retrieves all image
     * @return array
     */
    public function getImages()
    {
        return $this->images;
    }

}