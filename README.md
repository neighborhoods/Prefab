# Neighborhoods Prefab
A code generation tool. Takes the busywork out of building [Protean](https://github.com/neighborhoods/protean)-compliant applications.

## Protean Docs and FAQs
Protean is an application architecture specification. The specification is canonically defined in https://github.com/neighborhoods/protean. Docs and FAQs can be bound there.

## Running Prefab
- In your composer file, ensure you have your project name defined. Use the `composer-example.json` file, found in the root of Prefab, as a template
- Create your dao.prefab.definition.yml file as outlined [here](https://github.com/neighborhoods/prefab/blob/4.x/docs/DaoYml.md).
- From the root of your project run `./vendor/bin/prefab gen:fab`
    - This will add all of the supporting files needed to create a working API endpoint

## Reporting issues and requesting features

In order to ensure we get as much feedback as possible, we wanted to make it easy for you to submit bugs and request new functionality
- If you find a bug, please [submit and issue on Github](https://github.com/neighborhoods/prefab/issues).
- If you have a request for new functionality, please add it to the [feature request spreadsheet](https://docs.google.com/spreadsheets/d/1QjHGekzFeH8WKreOsiKjciGnbEKLbHjlfT9HhpI6S6w/edit?usp=sharing).
