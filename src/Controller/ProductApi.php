<?php

namespace App\Controller;

use App\Entity\Product;

use App\Repository\ProductRepository;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\Serializer\SerializerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Routing\Generator\UrlGeneratorInterface;
use Symfony\Component\Serializer\Normalizer\AbstractNormalizer;

class ProductApi extends AbstractController
{
    /**
     * Cette méthode récupère les produits
     *
     * @param ProductRepository $productRepository
     * @param SerializerInterface $serializer
     * @return JsonResponse
     */
    #[Route('/api/products', name: 'products', methods: ['GET'])]
    public function getAllProducts(ProductRepository $productRepository, SerializerInterface $serializer): JsonResponse
    {
        $productList = $productRepository->findAll();
        
        $jsonProductList = $serializer->serialize($productList, 'json');
        return new JsonResponse($jsonProductList, Response::HTTP_OK, [], true);
    }
	
    /**
     * Cette méthode récupère un produit par son id. 
     *
     * @param Product $product
     * @param SerializerInterface $serializer
     * @return JsonResponse
     */
    #[Route('/api/products/{id}', name: 'detail', methods: ['GET'])]
    public function getDetailProduct(Product $product, SerializerInterface $serializer): JsonResponse {
        $jsonProduct = $serializer->serialize($product, 'json');
        return new JsonResponse($jsonProduct, Response::HTTP_OK, [], true);
    }
    
    
    /**
     * Cette méthode supprime un produit par osn id
     *
     * @param Product $product
     * @param EntityManagerInterface $em
     * @return JsonResponse 
     */
    #[Route('/api/products/{id}', name: 'delete', methods: ['DELETE'])]
    public function deleteProduct(Product $product, EntityManagerInterface $em): JsonResponse {
        $em->remove($product);
        $em->flush();

        return new JsonResponse(null, Response::HTTP_NO_CONTENT);
    }

    /**
     * Cette méthode créer un nouveau produit 
     *
     * @param Request $request
     * @param SerializerInterface $serializer
     * @param EntityManagerInterface $em
     * @param UrlGeneratorInterface $urlGenerator
     * @param AuthorRepository $authorRepository
     * @return JsonResponse
     */
    #[Route('/api/products', name:"create", methods: ['POST'])] 
    public function createProduct(Request $request, SerializerInterface $serializer, EntityManagerInterface $em,
        UrlGeneratorInterface $urlGenerator): JsonResponse {
        
        $product = $serializer->deserialize($request->getContent(), Product::class, 'json');
        $em->persist($product);
        $em->flush();


		$jsonProduct = $serializer->serialize($product, 'json');
		
        $location = $urlGenerator->generate('detail', ['id' => $product->getId()], UrlGeneratorInterface::ABSOLUTE_URL);

		return new JsonResponse($jsonProduct, Response::HTTP_CREATED, ["Location" => $location], true);	
    }
    
    
    /**
     * Cette méthode met à jour le produit
     * 
     * @param Request $request
     * @param SerializerInterface $serializer
     * @param Product $currentProduct
     * @param EntityManagerInterface $em
     * @param AuthorRepository $authorRepository
     * @return JsonResponse
     */
    #[Route('/api/products/{id}', name:"update", methods:['PUT'])]
    public function updateProduct(Request $request, SerializerInterface $serializer,
                        Product $currentProduct, EntityManagerInterface $em): JsonResponse {

        $updatedProduct = $serializer->deserialize($request->getContent(), Product::class, 'json', [AbstractNormalizer::OBJECT_TO_POPULATE => $currentProduct]);


        $em->persist($updatedProduct);
        $em->flush();

        return new JsonResponse(null, JsonResponse::HTTP_NO_CONTENT);
    }


}