<?php

namespace VirtualHealthBundle\Controller;

use Doctrine\ORM\Cache;
use PDO;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;

class DefaultController extends Controller
{
    const PER_PAGE = 10;

    public function indexAction()
    {
        return $this->render('VirtualHealthBundle::index.html.twig');
    }

    public function task1Action()
    {
        return $this->render('VirtualHealthBundle::task1.html.twig');
    }

    public function task2Action()
    {
        return $this->render('VirtualHealthBundle::task2.html.twig');
    }

    public function task3Action()
    {
        return $this->render('VirtualHealthBundle::task3.html.twig');
    }

    public function task4Action(Request $request)
    {
        $paginator = $this->get('knp_paginator');

        $em = $this->get('doctrine.orm.entity_manager');
        $qb = $em->createQueryBuilder();

        $dql = $qb
            ->select('s')
            ->from('VirtualHealthBundle:Source', 's')
            ->where('s.title LIKE :title')
            ->join('s.rel', 'r')
            ->setParameter('title', 'title 1%');

        $query = $dql->getQuery();

        $items = $paginator->paginate(
            $query,
            $request->query->getInt('page', 1),
            self::PER_PAGE
        );
        return $this->render('VirtualHealthBundle::task4.html.twig', array('items' => $items));
    }

    public function task5Action(Request $request)
    {
        $paginator = $this->get('knp_paginator');
        $start = $request->query->getInt('page', 1) * self::PER_PAGE;

        $em = $this->get('doctrine.orm.entity_manager');

        $query = <<<SQL
SELECT s.cx, s.rx, s.title, r.ndc
FROM `tb_source` s
INNER JOIN `tb_rel` r USING(cx)
WHERE 1
AND s.`title` LIKE :title
LIMIT :limit OFFSET :offset
SQL;


        $stmt = $em->getConnection()->prepare($query);
        $stmt->bindValue('title', 'title 1%');
        $stmt->bindValue('limit', self::PER_PAGE, PDO::PARAM_INT);
        $stmt->bindValue('offset', $start, PDO::PARAM_INT);
        $stmt->execute();

        $items = $paginator->paginate(
            $stmt->fetchAll(),
            $request->query->getInt('page', 1),
            self::PER_PAGE
        );

        return $this->render('VirtualHealthBundle::task5.html.twig', array('items' => $items));
    }

    public function task6Action(Request $request)
    {
        $paginator = $this->get('knp_paginator');

        $em = $this->get('doctrine.orm.entity_manager');
        $qb = $em->createQueryBuilder();

        $dql = $qb
            ->select('s')
            ->from('VirtualHealthBundle:Source', 's')
            ->where('s.title LIKE :title')
            ->join('s.rel', 'r')
            ->setParameter('title', 'title 1%');

        $query = $dql->getQuery();

        $query->setCacheMode(Cache::MODE_GET);
        $query->setCacheable(true);

        // query cache
        $query->useQueryCache(true);
        $query->useResultCache(true);
        $query->setResultCacheLifetime(3600);
        $query->setResultCacheId('my_cache_id');

        $items = $paginator->paginate(
            $query,
            $request->query->getInt('page', 1),
            self::PER_PAGE
        );

        return $this->render('VirtualHealthBundle::task6.html.twig', array('items' => $items));
    }
}
