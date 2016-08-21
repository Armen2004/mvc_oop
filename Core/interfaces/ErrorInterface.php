<?php namespace Core\interfaces;

interface ErrorInterface
{
    /**
     * @return mixed
     */
    public function fileNotFound();

    /**
     * @return mixed
     */
    public function pageNotFound();

    /**
     * @return mixed
     */
    public function modelNotFound();

    /**
     * @return mixed
     */
    public function methodNotAllowed();

    /**
     * @return mixed
     */
    public function methodNotFound();
}