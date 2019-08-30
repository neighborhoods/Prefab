## Testing Goals
- Be confident that we are not breaking Prefab's public API when making changes
- Verify that Prefab's internal actors work as expected

## Prefab Components to Test

### Interal Prefab Actors
- HTTP Skeleton
  - Responsible for copying template files into project and replacing placeholder namespaces
  - What would be a good test for this?
- Generator
  - Responsible for interacting with all other Prefab actors
  - Currently responsible for generating bradfab templates for a build configuration, but that should be split out into its own actor
    - This actor should generate a valid Bradfab fabrication file for a given build configuration
- Actor Generator
  - Responsible for generating a file for an actor
  - Each actor has its own generator type
- Build Plan
  - Responsible for holding and executing the generators
  - Only holds generators for DAO, DAO Interface, and DAO service file. Everything else is now handled by Bradfab
  - Want to test and verify that the above files are created
- Build Configuration
  - PHP class representation of a DAO definition file
  - Test that a given build configuration yields a valid Bradfab fabrication file
- Prefab Machinery
  - Executes all build plans
- Supporting Actor Generation (Executing Bradfab)

### Generated Actors
- Test generated code outputted by Prefab
- Test that an HTTP request returns an expected response (End to end testing)
- Container Building (including HTTP Buildable Maps)
- Search Criteria
