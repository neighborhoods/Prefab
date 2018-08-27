# Controlling Product Configuration With The Execution Environment
The execution environment being used MUST inject the appropriate configuration settings for that environment.

## Default Observed Environmental Variables
* `DATABASE_HOST` - the hostname of the RDBMS being used.
* `DATABASE_USERNAME` - the username for the RDBMS being used.
* `DATABASE_PASSWORD` - the password for the `DATABASE_USERNAME` for the RDBMS being used.
* `DATABASE_ADAPTER` - `mysql | pgsql`
* `DATABASE_NAME` - The database name for the RDBMS being used.
