<?php

function is_closure($t) {
    return is_object($t) && ($t instanceof Closure);
}