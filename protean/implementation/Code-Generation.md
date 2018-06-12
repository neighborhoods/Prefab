# Summary
Business logic often requires a non-trivial amount of supporting software to be written in order for that business logic to be used.  This supporting software is usually trivial to write.  However, it creates the opportunity for logical mistakes to be made (typos, etc.), breaks from a convention (an engineer isn’t aware of a convention, a convention changed, typos, etc.), and other common issues that are caused when humans write software.

# Specification
Generate the code for the supporting software through annotations on an Interface.

# Apache Velocity Language
[Apache Velocity](http://velocity.apache.org/engine/1.7/user-guide.html) is a Java-based template engine. `PHPStorm` has first class support for using it to generate code. We are currently using this as a polyfill for a `PHP` code generation tool until one can be written.

# Purpose
The purpose of the `AVT`'s is to ensure the consistent creation of code that can and should be built by a machine.  These actors include but are not limited to the following:
* Factories
* Repositories
* Builders
* Aware Traits
* OpenAPI Specifications

# How To Contribute
In order to improve existing `AVT`'s or create new ones, please submit a PR to the `prefab` master repository branch.

# Usage
Please see the `README` in the `prefab` repository root.
