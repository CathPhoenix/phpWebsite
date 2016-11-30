<?php
/**
 * Hold the getters and setters for products
 */

namespace Itb;

/**
 *
 * Class Product
 * @package Itb
 */
class Product
{
    /**
     * the product ID
     * @var int
     */
    private $productId;

    /**
     * the product name
     * @var string
     */
    private $productName;

    /**
     * description of the product
     * @var string
     */
    private $description;

    /**
     * price of the product
     * @var float
     */
    private $price;

    /**
     * the product rating
     * @var int
     */
    private $rating;

    /**
     * get the product id
     * @return int
     */
    public function getProductId()
    {
        return $this->productId;
    }

    /**
     * set the product id
     * @param int $productId
     */
    public function setProductId($productId)
    {
        $this->productId = $productId;
    }

    /**
     * get the product name
     * @return string
     */
    public function getProductName()
    {
        return $this->productName;
    }

    /**
     * set the product name
     * @param string $productName
     */
    public function setProductName($productName)
    {
        $this->productName = $productName;
    }

    /**
     * get the description of the product
     * @return string
     */
    public function getDescription()
    {
        return $this->description;
    }

    /**
     * set the description of the product
     * @param string $description
     */
    public function setDescription($description)
    {
        $this->description = $description;
    }

    /**
     * get the product price
     * @return float
     */
    public function getPrice()
    {
        return $this->price;
    }

    /**
     * set the product price
     * @param float $price
     */
    public function setPrice($price)
    {
        $this->price = $price;
    }

    /**
     * get the product rating
     * @return int
     */
    public function getRating()
    {
        return $this->rating;
    }

    /**
     * set the product rating
     * @param int $rating
     */
    public function setRating($rating)
    {
        $this->rating = $rating;
    }
}