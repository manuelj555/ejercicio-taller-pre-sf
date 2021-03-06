<?php

namespace AppBundle\Repository;

use AppBundle\Entity\Product;
use Doctrine\ORM\QueryBuilder;

/**
 * ProductRepository
 *
 * This class was generated by the Doctrine ORM. Add your own custom
 * repository methods below.
 */
class ProductRepository extends \Doctrine\ORM\EntityRepository
{
    /**
     * Crea una consulta para obtener los productos desde la base de datos
     *
     * 
     * @param  string|null $search Si se pasa un valor, se intenta
     * buscar en los campos de la entidad producto alguna coincidencia.
     * 
     * @return QueryBuilder
     */
    public function getQueryBuilderForAll($search = null)
    {
        /*
         * Se agrega un join y se coloca en el select el alias
         * de la entidad categoria, para que la consulta cargue las
         * categorías de una vez.
         */
        $query = $this->createQueryBuilder('product')
            ->addSelect('category')
            ->leftJoin('product.category', 'category');

        if(is_string($search) and !empty($search)){
            /*
             * Si la variable $search no está vacia, creamos
             * un conjunto de consultas agrupadas con un OR
             * para que se tome en cuenta alguna de las coincidencias:
             */
            $query->andWhere($query->expr()->orX(
                'product.id = :search',
                'product.code LIKE :search_like',
                'product.name LIKE :search_like',
                'product.description LIKE :search_like',
                'product.brand LIKE :search_like',
                'category.name LIKE :search_like'
            ))->setParameters([
                'search' => $search,
                'search_like' => '%'.$search.'%',
            ]);
        }

        return $query;
    }

    public function save(Product $product, $flush = true)
    {
        $this->_em->persist($product);
        $flush and $this->_em->flush();
    }

    public function remove(Product $product, $flush = true)
    {
        $this->_em->remove($product);
        $flush and $this->_em->flush();
    }
}
