<?php

namespace AppBundle\Controller;

use AppBundle\Entity\Product;
use AppBundle\Form\ProductType;
use Doctrine\ORM\Query;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;

/**
 * @Route("/product")
 */
class ProductController extends Controller
{
    /**
     * @Route("/list", name="product_list")
     */
    public function listAction(Request $request)
    {
        $query = $em = $this->get('app.repository.product')
            ->getQueryBuilderForAll($request->query->get('search'))
            ->getQuery();
            
        $query->setHydrationMode(Query::HYDRATE_ARRAY);

        $products = $this->get('knp_paginator')->paginate(
            $query, (int) $request->get('page', 1), 5
        );

        return $this->render('product/list.html.twig', [
            'products' => $products,
        ]);
    }

    /**
     * @Route("/create", name="product_create")
     */
    public function createAction(Request $request)
    {
        $product = new Product();
        $form    = $this->createForm(ProductType::class, $product);
        $form->handleRequest($request);

        if ($form->isSubmitted() and $form->isValid()) {
            $this->get('app.repository.product')->save($product);

            $this->addFlash('success', sprintf(
                'El producto con el código %s se ha creado con éxito!',
                $product->getCode()
            ));

            return $this->redirectToRoute('product_list');
        }

        return $this->render('product/create.html.twig', [
            'form' => $form->createView(),
        ]);
    }

    /**
     * @Route("/edit/{id}", name="product_edit")
     */
    public function editAction(Request $request, Product $product)
    {
        $form    = $this->createForm(ProductType::class, $product);
        $form->handleRequest($request);

        if ($form->isSubmitted() and $form->isValid()) {
            $this->get('app.repository.product')->save($product);

            $this->addFlash('success', sprintf(
                'El producto con el código %s se ha actualizado con éxito!',
                $product->getCode()
            ));

            return $this->redirectToRoute('product_list');
        }

        return $this->render('product/edit.html.twig', [
            'form' => $form->createView(),
            'product' => $product,
        ]);
    }
}
