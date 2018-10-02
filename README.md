# Neighborhoods Prefab
A code generation tool. Takes the busywork out of building [Protean](https://github.com/neighborhoods/protean)-compliant applications.

## Protean Docs and FAQs
Protean is an application architecture specification. The specification is canonically defined in https://github.com/neighborhoods/protean. Docs and FAQs can be bound there.

## Running Prefab
- In your composer file, ensure you have your project name defined. Use the `composer-example.json` file, found in the root of Prefab, as a template
- Create your DAO Interface with all of your getters, setters, and hasers
- At the top of your DAO Interface, add the annotation `@neighborhoods\prefab:DAO`
- From the root of your project run `./vendor/bin/prefab gen:fab`
    - This will add all of the supporting files needed to create a working API endpoint

### Notes
- Builders are not fully code generated yet. Add your working builder to `src/` to override the generated builder
