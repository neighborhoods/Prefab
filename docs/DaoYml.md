## DAO Yaml File Specification

The purpose of this document is to define the components needed to generate an HTTP endpoint for a DAO from a `.dao.yml` file

The file must be named {DAONAME}.dao.yml and saved under `src/`. They should stored in the same nested directory structure as you would like the machinery to be generated under `fab/`.  
- `dao`
    - `name`
        - Name of the DAO
    - `table_name`
        - Name of the database table containing the data that populates the DAO
    - `identity_field`
        - Name of the database column containing the unique identifier for a given DAO
    - `properties`
        - The class properties of the DAO. Each property should have:
            - `type`
                - The data type as represented in PHP. Should be one of string, int, float, array, or bool.
            - `database_value`
                - Name of the database column containing the data that populates the class property

### Example structure of a DAO yaml file:

Filename: `User.dao.yml`
```yaml
dao:
  name: User
  table_name: mv1_user
  identity_field: user_id
  properties:
    id:
      type: int
      database_value: id
    email:
      type: string
      database_value: email
    first_name:
      type: string
      database_value: fname
    last_name:
      type: string
      database_value: lname
```
