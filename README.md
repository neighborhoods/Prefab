# Neighborhoods Prefab
A code generation tool. Takes the busywork out of building [Protean](https://github.com/neighborhoods/protean)-compliant applications.

## Protean Docs and FAQs
Protean is an application architecture specification. The specification is canonically defined in https://github.com/neighborhoods/protean. Docs and FAQs can be bound there.

## Running Prefab
- In your composer file, ensure you have your project name defined. Use the `composer-example.json` file, found in the root of Prefab, as a template
- Create your dao.prefab.definition.yml file as outlined [here](./docs/PrefabDefinition.md).
- From the root of your project run `./vendor/bin/prefab gen:fab`
    - This will add all of the supporting files needed to create a working API endpoint

## Debug Mode
- Debug mode can be enabled by setting the environment variable `DEBUG_MODE = "true"`

## Fitness
In order to capture the use cases for this product, and to ensure that this product is fit to handle each use case, every codebase that is designed to be composed into another codebase to perform useful work MUST have an accompanying `Fitness` repository.

The `Fitness` repository for `Prefab` is located in [`PrefabFitness`](https://github.com/neighborhoods/PrefabFitness).

All features and changes to `Prefab` MUST have an accompanying use case in this `Fitness` repository and MUST have an adopted RFC in `Protean`.

Bugfixes MUST have a PR with all `Prefab` owners approval and an accompanying ticket that is linked in the PR. Bugfixes SHOULD have a use case in the `Fitness` repository, but do not need an adopted RFC in `Protean`.
