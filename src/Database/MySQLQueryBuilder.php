<?php

namespace Solid\Database;

use Solid\Contracts\QueryBuilderInterface;
use stdClass;

class MySQLQueryBuilder implements QueryBuilderInterface
{
    private $query;

    public function __construct()
    {
        $this->query = new stdClass();
    }

    public function select(string $table, array $fields = ['*']): QueryBuilderInterface
    {
        $this->query->type = 'select';
        $this->query->start = sprintf("SELECT %s from %s", implode(", ", $fields), $table);

        return $this;
    }

    public function update($table): QueryBuilderInterface
    {
        $this->query->type = 'update';
        $this->query->start = 'UPDATE';
    }

    public function where(): QueryBuilderInterface
    {
    }

    public function getSQL(): string
    {
    }
}
