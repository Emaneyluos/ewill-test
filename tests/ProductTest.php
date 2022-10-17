<?php

namespace App\Tests;

use App\Entity\Product;
use PHPUnit\Framework\TestCase;

class ProductTest extends TestCase
{
    public function testIsTrue(): void
    {
        $product = new Product();

        $product->setName('Bougie')
                ->setReference(15)
                ->setPrice(12.5);

        $this->assertTrue($product->getName() === 'Bougie');
        $this->assertTrue($product->getReference() === 15);
        $this->assertTrue($product->getPrice() === 12.5);           
    }

    public function testIsFalse(): void
    {
        $product = new Product();

        $product->setName('Bougie')
                ->setReference(15)
                ->setPrice(12.5);

       $this->assertFalse($product->getName() === 'Lampe');
       $this->assertFalse($product->getReference() === 1);
       $this->assertFalse($product->getPrice() === 24.58);
    }

    public function testIsEmpty (): void 
    {
        $product = new Product();

        $this->assertEmpty($product->getName());
        $this->assertEmpty($product->getReference());
        $this->assertEmpty($product->getPrice());
    }
}
