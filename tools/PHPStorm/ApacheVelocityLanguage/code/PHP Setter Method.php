public ${STATIC} function set${NAME}(#if (${SCALAR_TYPE_HINT})${SCALAR_TYPE_HINT} #else#end$${PARAM_NAME}) : ${CLASS_NAME}Interface
{
#if (${STATIC} == "static")
    self::$${FIELD_NAME} = $${PARAM_NAME};
#else
    if ($this->${FIELD_NAME} !== null) {
        throw new \LogicException('${CLASS_NAME} ${FIELD_NAME} is already set.');
    }

    $this->${FIELD_NAME} = $${PARAM_NAME};
    
    return $this;
#end
}