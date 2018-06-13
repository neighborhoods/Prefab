# Summary
There is an uncountable number of ways to organize and create software. This document describes the specification of how we organize and create our software at Neighborhoods.  

This specification is called Protean, or more formally the Protean Architecture Specification.

# Problem
![simplify](images/simplify.jpeg)

# Neighborhoods Engineering Values
Protean inherits all of the Neighborhoods engineering values.

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
