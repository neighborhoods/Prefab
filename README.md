# Neighborhoods Prefab
A code generation tool. Takes the busywork out of building [Protean](https://github.com/neighborhoods/protean)-compliant applications.

## Protean Docs and FAQs
Protean is an application architecture specification. The specification is canonically defined in https://github.com/neighborhoods/protean. Docs and FAQs can be bound there.

# Configuring your PHPStorm
* Use PHPStorm >= 2018.2 (correctly auto-formats YAML, auto-completes traits)

## Apache Velocity Template Language Files

In an effort to produce pattern consistency and increase contributor velocity, we are using the Apache VTL file integration with PHPStorm as a workaround until `prefab` is in `>=` `4.0.0`.

Currently, while PHPStorm is not running,

`tools/PHPStorm/ApacheVelocityLanguage`

should be able to be copied to (below is an example, ensure the path you use is the correct path for your PHPStorm version)

`~/Library/Preferences/PhpStorm{2018.2}/fileTemplates` 

and the copied templates will be ingested by PHPStorm when it is subsequently started.

This should work for updates to these files as well.

Room for improvement includes:
* Ingesting the files within PHPStorm, without using the filesystem directly.

## Setup the Symfony plugin.
1. Make sure that it is enabled in your PHPStorm settings.
1. Enable the plugin in `File` > `Settings` > `Languages & Framework` > `PHP` > `Symfony`
1. Change the plugin to generate the `PSR-4` interface DI service names by context clicking a `PHP` file > `Create Service` (at the bottom) > `Settings` > copy and paste the following > `Save`.
```javascript
var className = args.className;
var projectName = args.projectName;
var projectBasePath = args.projectBasePath;
var defaultNaming = args.defaultNaming;

// nullable
var relativePath = args.relativePath;
var absolutePath = args.absolutePath;

return className+'Interface';
```

## Configure the context of project directories as `Sources` or `Tests`
1. Open the PHPStorm menu `Preferences` > `Directories`. 
1. Select the directory and click sources then click the Mark as: `Sources` or `Test`. 
1. Click the "P" symbol in the right panel to define a prefix as `Neighborhoods\ReplaceWithYourProductName\`, and check the "For Generated Sources". 

Your settings should resemble this after configuring `src`, and `fab` as **Sources**, then `test`, and `test-fab` as **Tests**:
![sources and tests](https://user-images.githubusercontent.com/1881846/43653556-05c566d0-970e-11e8-8353-93b4055efc58.png) 
    
## Setup custom TODO tags    
* Configure your TODO parser to read team notes by navigating to `Preferences` > `Editor` > `TODO` and add the following:
    * `\bteam\b.*`

# Manual Fabrication

## Project Setup
* copy the contents of the `http` directory into your project.
* use PHPStorm to find and replace the following (on *all* files copied)
    * `Replace this with the description of your product.`
    * `replace-this-with-the-name-of-your-product` - use the same hyphenation.
    * `ReplaceThisWithTheNameOfYourProduct` - use the same casing (this does not include `Neighborhoods`. e.g. `AreaService` not `NeighborhoodsAreaService`).

## Manual Fabrication Process
* Create your DAO and DAOInterface using the AVLTs
* Create the class machinery using teh AVLTs and appropriate directory structure.
* Start creating the DI YAML from the DAO.

Note: 
Repositories, Factories, Builders are the only shared actors, i.e. - all other DI service directives are NOT shared and REQUIRE `shared: false`.

* Repository - MUST NOT add a shared directive
* Factory - MUST NOT add a shared directive
* Builder - MUST add a `shared: false` directive
* DAO - MUST add a `shared: false` directive
* Map - MUST add a `shared: false` directive
* Handler - MUST add a `shared: false` directive
* Any other actor you have to understand whether or not it should be a Singleton, without `shared: false` Symfony DI will inject THE SAME instance of an object into all of it's declared dependents!
