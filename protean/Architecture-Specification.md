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

# Interface Driven Design

## Problem
Software engineers often start writing implementations rather than starting from an Interface that describes the contracts that any given implementation may have.

## Proposed Solution
Force all implementations to require an Interface to be able to be useful in our codebases.

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
