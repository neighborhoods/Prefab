# Summary
[Software design patterns](https://en.wikipedia.org/wiki/Software_design_pattern) solve a large number of problems. One of the more important problems that they solve is how to organize and reuse code. The `Protean` architectural specification is built on a number of design patterns that will likely continue to increase as needed. This document describes the ones currently used and why we are using them.

# Factories
A `Factory` is a creational pattern that deals with the problem of creating objects without having to specify the exact class of the object that will be created.

# [Repositories](https://martinfowler.com/eaaCatalog/repository.html)
A `Repository` mediates between the domain and data mapping layers, acting like an in-memory domain object collection. Client objects construct query specifications declaratively and submit them to the `Repository` for satisfaction. Objects can be added to and removed from the `Repository`, as they can from a simple collection of objects, and the mapping code encapsulated by the `Repository` will carry out the appropriate operations behind the scenes. Conceptually, a `Repository` encapsulates the set of objects persisted in a data store and the operations performed over them, providing a more object-oriented view of the persistence layer. A `Repository` also supports the objective of achieving a clean separation and one-way dependency between the domain and data mapping layers.

# Builders
The intent of the `Builder` design pattern is to separate the construction of a complex object from its representation. By doing so the same construction process can create different representations.
