<?php

namespace Solid\Contracts;

interface QueryBuilderInterface
{
    public function select(): QueryBuilderInterface;
    public function update(): QueryBuilderInterface;

    public function getSQL(): string;
}
