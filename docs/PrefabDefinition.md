## DAO Yaml File Specification

The purpose of this document is to define the components needed to generate an HTTP endpoint for a DAO from a `.prefab.definition.yml` file

The file must be named {DAONAME}.prefab.definition.yml and saved under `src/`. They should stored in the same nested directory structure as you would like the machinery to be generated under `fab/`.  
- `dao`
    - `table_name`
        - Name of the database table containing the data that populates the DAO
    - `http_route`
        - The http route that corresponds with the DAO
        - This field is optional
    - `http_verbs`
        - HTTP methods allowed for a DAO. Can include get, post, put, patch, and delete.
        - Note: Since mutatitve and destuctive actions are not yet patterned for repositories, you will need to override the generated handler to call the proper repository method.
    - `identity_field`
        - Name of the database column containing the unique identifier for a given DAO
    - `properties`
        - The class properties of the DAO. Each property should have:
            - `php_type`
                - The type of object the property represents. This can be a primitive or a fully qualified namespaced object
            - `database_column_name`
                - Name of the database column containing the data that populates the class property
            - `nullable`
                - Whether or not this property can be null. If true, the builder method will surround this property with isset() before attempting to set the value on the DAO
                - If not set, defaults to false
                
Prefab also enforces
* A Contract Version Namespace (e.g. `MV1`, `DOR1`, `RETS1`, etc.). This MUST be present under `src/`.
* A `{VENDOR}\{PRODUCT_NAME}` PSR-4 namespace convention (e.g. `Neighborhoods\Prefab`). This MUST be defined in `composer.json`.

### Example structure of a DAO yaml file:

Filename: `User.prefab.definition.yml`
```yaml
dao:
  table_name: mv1_user
  identity_field: id
  http_route: /mv1/users/{searchCriteria:}
  http_verbs:
   - get
   - post
   - put
   - patch
   - delete
  properties:
    id:
      php_type: int
      database_column_name: id
      nullable: false
    email:
      php_type: string
      database_column_name: email
      nullable: true
    first_name:
      php_type: string
      database_column_name: fname
      nullable: false
    last_name:
      php_type: string
      database_column_name: lname
      nullable: false
```
