<?php

namespace App\Controller;

use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Response;
use App\Entity\Product;
use App\Entity\Category;

class ProductController extends AbstractController
{
    /**
     * @Route("/product", name="product")
     */
    public function index()
    {
        // you can fetch the EntityManager via $this->getDoctrine()
        // or you can add an argument to your action: index(EntityManagerInterface $em)
        $em = $this->getDoctrine()->getManager();

        $category = new Category();
        $category->setName('Computer Peripherals');

        $product = new Product();
        $product->setName('Keyboard');
        $product->setPrice(19.99);
        $product->setDescription('Ergonomic and stylish!');

        $product->setCategory($category);

        // tell Doctrine you want to (eventually) save the Product (no queries yet)
        $em->persist($category);
        $em->persist($product);

        // actually executes the queries (i.e. the INSERT query)
        $em->flush();

        return new Response('Saved new product with id '.$product->getId() .
            'and category: '.$category->setName()
        );
    }

    /**
     * @Route("/product/{id}", name="product_show")
     */
    public function showAction(Product $product)
    {
        /*$repository = $this->getDoctrine()->getRepository(Product::class);

        $product = $repository->find($id);
        */

        /**EJEMPLOS DE BUSQUEDAS
         * // look for a single Product by its primary key (usually "id")
        $product = $repository->find($id);

        // look for a single Product by name
        $product = $repository->findOneBy(['name' => 'Keyboard']);
        // or find by name and price
        $product = $repository->findOneBy([
        'name' => 'Keyboard',
        'price' => 19.99,
        ]);

        // look for multiple Product objects matching the name, ordered by price
        $products = $repository->findBy(
        ['name' => 'Keyboard'],
        ['price' => 'ASC']
        );

        // look for *all* Product objects
        $products = $repository->findAll();
         * */

        /*if(!$product){
            throw $this->createNotFoundException('No se encuentra el producto: '.$id);
        }

        return new Response('Producto: '.$product->getName());
        */
        return new Response($product->getName().'aspciado a la categoria'.
            $product->getCategory()->getName()
        );
    }

    /**
     * @Route("/product/edit/{id}")
     */
    public function updateAction($id)
    {
        $em = $this->getDoctrine()->getManager();
        $product = $em->getRepository(Product::class)->find($id);

        if(!$product){
            throw $this->createNotFoundException(
                'No product found for id '.$id
            );
        }

        $product->setName('New Product name!');
        $em->flush();

        return $this->redirectToRoute('product_show', [
           'id' => $product->getId()
        ]);
    }

    /**
     * @Route("/product/delete/{id}")
     */
    public function deleteAction($id)
    {
        $em = $this->getDoctrine()->getManager();

        $product = $em->getRepository(Product::class)->find($id);

        if(!$product){
            throw $this->createNotFoundException(
                'No product found for id '.$id
            );
        }

        $em->remove($product);
        $em->flush();

        return new Response('Product deleted: '.$product->getId());
    }

    /**
     * @Route("product/search/")
     */
    public function searchAction()
    {
        $minPrice = 10.00;

        $products = $this->getDoctrine()
            ->getRepository(Product::class)
            ->findAllGreaterThanPrice($minPrice);

        dump($products);

        return new JsonResponse($products);

    }
}
