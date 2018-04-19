<?php

namespace onethirtyone\repository\Contracts;


interface RepositoryContract
{
    /**
     * Creates a new model instance of the repository class
     *
     * @param $data
     *
     * @return mixed
     */
    public static function create($data);


    /**
     * Retrieves a model instance by id
     *
     * @param $id
     *
     * @return mixed
     */
    public static function find($id);

    /**
     * Returns object property
     *
     * @param $name
     *
     * @return mixed
     */
    public function get($name);

    /**
     * Returns object property
     *
     * @param $name
     *
     * @return mixed
     */
    public function __get ($name);

    /**
     * Returns model instance in string
     * @return mixed
     */
    public function __toString();
}