#set($isNeighborhoodsNamespaced = $NAMESPACE.startsWith("Neighborhoods"))
#set($parts = $NAMESPACE.split("\\"))
#set($lastNamespaceElementPosition = $parts.size() - 1)
#set($lastPartOfNamespace = $parts.get($lastNamespaceElementPosition))

#set($part = "") 
#set($truncatedClassPath = "")
#set($awarePropertyName = "")
#set($foreach = "")

#foreach( $part in $parts )
    #set($foreachCount = $foreach.count)
    #if($isNeighborhoodsNamespaced)
        #if($foreachCount != 1 && $foreachCount != 2)
            #set($truncatedClassPath = $truncatedClassPath.concat($part))
        #end
    #else
        #if($foreachCount != 1)
            #set($truncatedClassPath = $truncatedClassPath.concat($part))
        #end
    #end
  #set($awarePropertyName = $awarePropertyName.concat($part))
#end