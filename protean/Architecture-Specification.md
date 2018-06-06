# Summary
There is an uncountable number of ways to organize and create software. This document describes the specifications of how we organize and create our applications at Neighborhoods.

![simplify](images/simplify.jpeg)

# Neighborhoods Engineering Values
Protean inherits all of the Neighborhoods engineering values.

# Protean Design Approach Philosophy

# Data Driven Architecture
## Data
Our information capital.
## API applications
The collection of codebases with the mission to provide our supported Client applications access to our Data.
### HTTP
### Task
### SDK
## Client applications
### Browser applications
A consumer of the API applications with the mission to provide a browser interface to our Data.
### Mobile applications
A consumer of the API applications with the mission to provide a native mobile device interface to our Data.


# API
An API is an exposed PHP object interface (HTTP, CLI, etc.).

# Operations
An Operation is an exposed public method on an API.

# API Groups
An API Group is a collection of related APIs.  This is how repository boundaries are defined.

# Dependency Management
## Problem
Software is almost always dependent on other software.  This is due to the fact that a lot of logic is already written and can be used without rewriting it for a particular use case.  This has an enormous number of obvious advantages.  However, it may not be easy to add dependencies to a dependent codebase.  This can lead to codebases that provide solutions to many different domains of problems since it it easier to add to a single dependency than manually combine multiple dependencies.

## Specification
Use a dependency manager to assemble a software project’s dependencies.  This allows for the Single Responsibility Principle to be applied to our repositories.  In addition, it supports our design goal of our repositories being agile since they can do one thing well.


# Dependency Injection
## Problem
The Dependency Injection design pattern solves problems like:

- How can an application be independent of how its objects are created?
- How can a class be independent of how the objects it requires are created?
- How can the way objects are created be specified in separate configuration files?
- How can an application support different configurations?

Creating objects directly within the class that requires the objects is inflexible because it commits the class to particular objects and makes it impossible to change the instantiation later independently from (without having to change) the class. It stops the class from being reusable if other objects are required, and it makes the class hard to test because real objects can't be replaced with mock objects.

## Specification
Use PSR-11 compatible Dependency Injection. Additionally, this encourages composition of objects that follow the SRP.

