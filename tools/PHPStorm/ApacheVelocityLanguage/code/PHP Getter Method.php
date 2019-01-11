public ${STATIC} function ${GET_OR_IS}${NAME}()#if(${RETURN_TYPE}): ${RETURN_TYPE}#else#end
{
#if (${STATIC} == "static")
    return self::$${FIELD_NAME};
#else
    if ($this->${FIELD_NAME} === null) {
        throw new \LogicException('${CLASS_NAME} ${FIELD_NAME} has not been set.');
    }

    return $this->${FIELD_NAME};
#end
}