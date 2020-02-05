<?php

/**
 * @param string $class
 * @param array $attributes
 * @param null $times
 * @return \Illuminate\Database\Eloquent\Collection|\Illuminate\Database\Eloquent\Model|mixed
 */
function create($class, $attributes = [],$times = null){
    return factory($class,$times)->create($attributes);
}

/**
 * @param string $class
 * @param array $attributes
 */
function make($class, $attributes = [],$times = null){
    return factory($class,$times)->make($attributes);

}
