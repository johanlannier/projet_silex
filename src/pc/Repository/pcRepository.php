<?php

namespace App\pc\Repository;

use App\pc\Entity\pcs;
use Doctrine\DBAL\Connection;

/**
 * pcs repository.
 */
class pcRepository
{
    /**
     * @var \Doctrine\DBAL\Connection
     */
    protected $db;

    public function __construct(Connection $db)
    {
        $this->db = $db;
    }

   /**
    * Returns a collection of pc.
    *
    * @param int $limit
    *   The number of pc to return.
    * @param int $offset
    *   The number of pc to skip.
    * @param array $orderBy
    *   Optionally, the order by info, in the $column => $direction format.
    *
    * @return array A collection of pc, keyed by pcs id.
    */
   public function getAll()
   {
       $queryBuilder = $this->db->createQueryBuilder();
       $queryBuilder
           ->select('u.*')
           ->from('pc', 'u');

       $statement = $queryBuilder->execute();
       $pcData = $statement->fetchAll();
       foreach ($pcData as $pcsData) {
           $pcsEntityList[$pcsData['id']] = new pcs($pcsData['id'], $pcsData['nom'], $pcsData['marque'], $pcsData['os'], $pcsData['idUser']);
       }

       return $pcsEntityList;
   }

   /**
    * Returns an pcs object.
    *
    * @param $id
    *   The id of the pcs to return.
    *
    * @return array A collection of pc, keyed by pcs id.
    */
   public function getById($id)
   {
       $queryBuilder = $this->db->createQueryBuilder();
       $queryBuilder
           ->select('u.*')
           ->from('pc', 'u')
           ->where('id = ?')
           ->setParameter(0, $id);
       $statement = $queryBuilder->execute();
       $pcsData = $statement->fetchAll();

       return new pcs($pcsData[0]['id'], $pcsData[0]['nom'], $pcsData[0]['marque'], $pcsData[0]['os'], $pcsData[0]['idUser']);
   }

   public function getUserPcs($id)
   {
       $queryBuilder = $this->db->createQueryBuilder();
       $queryBuilder
           ->select('u.*')
           ->from('pc', 'u')
           ->where('idUser = ?')
           ->setParameter(0, $id);

      $statement = $queryBuilder->execute();
       $pcData = $statement->fetchAll();
       $pcsEntityList = null;
       foreach ($pcData as $pcsData) {
           $pcsEntityList[$pcsData['id']] = new pcs($pcsData['id'], $pcsData['nom'], $pcsData['marque'], $pcsData['os'], $pcsData['idUser']);
       }

      return $pcsEntityList;
   }

    public function delete($id)
    {
        $queryBuilder = $this->db->createQueryBuilder();
        $queryBuilder
          ->delete('pc')
          ->where('id = :id')
          ->setParameter(':id', $id);

        $statement = $queryBuilder->execute();
    }

    public function update($parameters)
    {
        $queryBuilder = $this->db->createQueryBuilder();
        $queryBuilder
          ->update('pc')
          ->where('id = :id')
          ->setParameter(':id', $parameters['id']);

        if ($parameters['nom']) {
            $queryBuilder
              ->set('nom', ':nom')
              ->setParameter(':nom', $parameters['nom']);
        }

        if ($parameters['marque']) {
            $queryBuilder
            ->set('marque', ':marque')
            ->setParameter(':marque', $parameters['marque']);
        }

        if ($parameters['os']) {
            $queryBuilder
            ->set('os', ':os')
            ->setParameter(':os', $parameters['os']);
        }

        if ($parameters['idUser']) {
            $queryBuilder
            ->set('idUser', ':idUser')
            ->setParameter(':idUser', $parameters['idUser']);
        }

        $statement = $queryBuilder->execute();
    }

    public function insert($parameters)
    {
        $queryBuilder = $this->db->createQueryBuilder();
        $queryBuilder
          ->insert('pc')
          ->values(
              array(
                'nom' => ':nom',
                'marque' => ':marque',
                'os'=>':os',
                'idUser'=>':idUser',
              )
          )
          ->setParameter(':nom', $parameters['nom'])
          ->setParameter(':marque', $parameters['marque'])
          ->setParameter(':os', $parameters['os'])
          ->setParameter(':idUser', $parameters['idUser']);
        $statement = $queryBuilder->execute();
    }
}
