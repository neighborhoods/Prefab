# Prefab - Bradfab to Buphalo Transition Overview

## Prefab Actors

### Fabrication Specification

A fabrication specification is the group of actors to be generated for any given Prefab definition file. It consists of a map of `Actor` objects and is eventually written to a YAML fabrication file to be consumed by Buphalo.

**Properties**

`actorMap` - A map of `Actor` objects to be written to a fabrication file

### Actor
An `Actor` represents a single class to be generated.

**Properties**

`actorKey` - Unique identifier that is the top level key in a fabrication file

`templatePath` - Path to the template that represents the class

`annotationProcessorMap` - A map of `AnnotationProcessor` actors to be used by Buphalo when generating the class

### Annotation Processor

An actor used to generate code that varies based on user input. 

Note: this is different than the annotation processor that implements the Buphalo `AnnotationProcessorInterface`. It's probably a good idea to rename this to something to avoid confusion but I'm not sure what right now.

**Properties**

`processorFullyQualifiedClassName` - Fully qualified class name of the class that implements `AnnotationProcessorInterface` to be consumed by Buphalo

`staticContextRecord` - Array of values that are used by the annotation processor to generate code

### Fabrication Specification Writer

An actor that writes `FabricationSpecification`s to disk as fabrication files to be consumed by Buphalo

**Properties**

`fabricationSpecification` - The `FabricationSpecification` to be written to disk

`writePath` - The location on disk to write the `FabricationSpecification`

### Build Configuration

A `dao` representation of a Prefab definition file. The functionality of build configurations has not changed.

## Code Generation Process

Here are the high level steps that are taken when running Prefab using Buphalo:

1. Prefab copies all HTTP machinery to the User's `fab/` directory. (This step is unchanged)
1. Prefab finds all Prefab definition files in the user's `src/` directory.
1. Prefab generates a `BuildConfiguration` for each Prefab definition file.
1. For each `Build Configuration`: 
    1. Prefab calls an `FabricationSpecification\Builder->build()` which takes a `BuildConfiguration` as input and returns a `FabricationSpecification`.
    1. The `FabricationSpecification\Builder`  will check the supporting actor group of the `BuildConfiguration` and call the corresponding `FabricationSpecification\{SupportingActorGroup}\Builder`.
    1. The `FabricationSpecification\{SupportingActorGroup}\Builder` will build a map of `Actor` objects that belong to the supporting actor group, setting each `Actor`'s `actorKey`, `templatePath`, and `annotationProcessorMap`.
    1. The `actorMap` is set on the `FabricationSpecification` and returned.
    1. Prefab writes the `FabricationSpecification` to disk using the `FabricationSpecification\Writer`
1. Prefab calls Buphalo to consume the `FabricationSpecification`s and generate the code to a temporary directory.
1. Prefab copies the temporary directory to the user's `fab/` folder and deletes the temporary directory
