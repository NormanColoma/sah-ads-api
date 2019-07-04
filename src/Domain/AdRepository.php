<?php


namespace App\Domain;


interface AdRepository
{
    public function save(Ad $ad):void;
    public function findAll($sortedBy, $direction, $page): array;
}