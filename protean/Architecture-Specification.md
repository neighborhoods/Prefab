# Summary
There is an uncountable number of ways to organize and create software. This document describes the specifications of how we organize and create our applications at Neighborhoods.  This specification is called Protean, or more formally the Protean Architecture Specification.

# Problem
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


## Specification
Use PSR-11 compatible Dependency Injection. Additionally, this encourages composition of objects that follow the SRP.


# Interface Driven Design

## Problem
Software engineers often start writing implementations rather than starting from an Interface that describes the contracts that any given implementation may have.

## Proposed Solution
Force all implementations to require an Interface to be able to be useful in our codebases.

# Code Generation
## Problem
Business logic often requires a non-trivial amount of supporting software to be written in order for that business logic to be used.  This supporting software is usually trivial to write.  However, it creates the opportunity for logical mistakes to be made (typos, etc.), breaks from a convention (an engineer isn’t aware of a convention, a convention changed, typos, etc.), and other common issues that are caused when humans write software.

## Proposed Solution
Generate the code for the supporting software through annotations on an Interface.


# Immutable Contracts
## Problem
Changing the behavior of a software contract forces clients of that contract to change their behavior(s) synchronously with the introduction of the changes to the contract.  This forms very brittle relationships between providers and clients.

## Proposed Solution
Do not mutate contracts, instead create a new contract or version an existing one.


# PSR-15 - HTTP Server Request Handlers
## Problem
This problem is identical to Dependency Injection for objects.  In this case, controllers do not provide the ability to arbitrarily inject logic to handle the abstraction of HTTP Messages (PSR-7). In addition, controllers couple our code to a particular framework.

## Proposed Solution
Use PSR-15 Server Request Handlers.


# Testing
## Problem
Testing a behavior of a part of code is an important part of being able to validate that the behavior is correct.  It is often difficult to setup these tests which is unattractive to engineers with deadlines.

## Proposed Solution
Use Continuous Test Driven Development (CTDD).  Test Contracts (~behaviors), and pass implementations as part of a data provider. Use a framework to simplify the creation of tests.
