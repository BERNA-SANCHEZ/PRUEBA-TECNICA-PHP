<?php

namespace App\Repository;

use App\Entity\Producto;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;

/**
 * @extends ServiceEntityRepository<Producto>
 *
 * @method Producto|null find($id, $lockMode = null, $lockVersion = null)
 * @method Producto|null findOneBy(array $criteria, array $orderBy = null)
 * @method Producto[]    findAll()
 * @method Producto[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class ProductoRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, Producto::class);
    }

    public function save(Producto $entity, bool $flush = false): void
    {
        $this->getEntityManager()->persist($entity);

        if ($flush) {
            $this->getEntityManager()->flush();
        }
    }

    public function remove(Producto $entity, bool $flush = false): void
    {
        $this->getEntityManager()->remove($entity);

        if ($flush) {
            $this->getEntityManager()->flush();
        }
    }

    public function findAllProductos(){
        return $this->getEntityManager()
            ->createQuery(
                'SELECT producto.id,producto.codigo,producto.descripcion_producto,producto.precio,
                producto.stock,producto.iva,producto.peso, 
                zona.descripcion as zonaname     ,   
                marca.descripcion as marcaname     ,   
                proveedor.descripcion as proveedorname    ,    
                presentacion.descripcion as presentacionname        
                FROM App:Producto producto 
                JOIN producto.zona zona
                JOIN producto.marca marca
                JOIN producto.presentacion presentacion
                JOIN producto.proveedor proveedor
                ORDER BY producto.id DESC '
            )
            ->getResult();
    }


    public function findAllProductosProveedor(){
        return $this->getEntityManager()
            ->createQuery(
                'SELECT producto.id,producto.codigo,producto.descripcion_producto,producto.precio,
                producto.stock,producto.iva,producto.peso, 
                zona.descripcion as zonaname     ,   
                marca.descripcion as marcaname     ,   
                proveedor.descripcion as proveedorname    ,    
                presentacion.descripcion as presentacionname        
                FROM App:Producto producto 
                JOIN producto.zona zona
                JOIN producto.marca marca
                JOIN producto.presentacion presentacion
                JOIN producto.proveedor proveedor
                ORDER BY producto.proveedor DESC '
            )
            ->getResult();
    }



//    /**
//     * @return Producto[] Returns an array of Producto objects
//     */
//    public function findByExampleField($value): array
//    {
//        return $this->createQueryBuilder('p')
//            ->andWhere('p.exampleField = :val')
//            ->setParameter('val', $value)
//            ->orderBy('p.id', 'ASC')
//            ->setMaxResults(10)
//            ->getQuery()
//            ->getResult()
//        ;
//    }

//    public function findOneBySomeField($value): ?Producto
//    {
//        return $this->createQueryBuilder('p')
//            ->andWhere('p.exampleField = :val')
//            ->setParameter('val', $value)
//            ->getQuery()
//            ->getOneOrNullResult()
//        ;
//    }
}
