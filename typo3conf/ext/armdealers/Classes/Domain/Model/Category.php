<?php
namespace ARM\Armdealers\Domain\Model;

/**
 * Category
 */
class Category extends \TYPO3\CMS\Extbase\DomainObject\AbstractEntity
{
    /**
     * title
     *
     * @var string
     */
    protected $title = '';

    /**
     * products
     *
     * @var \TYPO3\CMS\Extbase\Persistence\ObjectStorage<\ARM\Armdealers\Domain\Model\Product>
     * @cascade remove
     */
    protected $products = null;

    /**
     * __construct
     */
    public function __construct()
    {
        //Do not remove the next line: It would break the functionality
        $this->initStorageObjects();
    }

    /**
     * Initializes all ObjectStorage properties
     * Do not modify this method!
     * It will be rewritten on each save in the extension builder
     * You may modify the constructor of this class instead
     *
     * @return void
     */
    protected function initStorageObjects()
    {
        $this->products = new \TYPO3\CMS\Extbase\Persistence\ObjectStorage();
    }

    /**
     * Returns the title
     *
     * @return string $title
     */
    public function getTitle()
    {
        return $this->title;
    }

    /**
     * Sets the title
     *
     * @param string $title
     * @return void
     */
    public function setTitle($title)
    {
        $this->title = $title;
    }

    
    /**
     * Adds a Product
     *
     * @param \ARM\Armdealers\Domain\Model\Product $product
     * @return void
     */
    public function addProduct(\ARM\Armdealers\Domain\Model\Product $product)
    {
        $this->products->attach($product);
    }

    /**
     * Removes a Product
     *
     * @param \ARM\Armdealers\Domain\Model\Product $productToRemove The Product to be removed
     * @return void
     */
    public function removeProduct(\ARM\Armdealers\Domain\Model\Product $productToRemove)
    {
        $this->products->detach($productToRemove);
    }

    /**
     * Returns the products
     *
     * @return \TYPO3\CMS\Extbase\Persistence\ObjectStorage<\ARM\Armdealers\Domain\Model\Product> $products
     */
    public function getProducts()
    {
        return $this->products;
    }

    /**
     * Sets the products
     *
     * @param \TYPO3\CMS\Extbase\Persistence\ObjectStorage<\ARM\Armdealers\Domain\Model\Product> $products
     * @return void
     */
    public function setProducts(\TYPO3\CMS\Extbase\Persistence\ObjectStorage $products)
    {
        $this->products = $products;
    }
}
