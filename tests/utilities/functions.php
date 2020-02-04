<?php

/**
 * @param string $class
 * @param array $attributes
 * @return \Illuminate\Database\Eloquent\Collection|\Illuminate\Database\Eloquent\Model|mixed
 */
function create($class, $attributes = []){
    return factory($class)->create($attributes);
}

/**
 * @param string $class
 * @param array $attributes
 */
function make($class, $attributes = []){
    return factory($class)->make($attributes);

}
