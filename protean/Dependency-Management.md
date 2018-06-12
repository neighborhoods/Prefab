# Summary
Software is almost always dependent on other software.  This is due to the fact that a lot of logic is already written and can be used without rewriting it for a particular use case.  This has an enormous number of obvious advantages.  However, it may not be easy to add dependencies to a dependent codebase.  This can lead to codebases that provide solutions to many different domains of problems since it it easier to add to a single dependency than manually combine multiple dependencies.

# Specification
Use a dependency manager to assemble a software project’s dependencies.  This allows for the Single Responsibility Principle to be applied to our repositories.  In addition, it supports our design goal of our repositories being agile since they can do one thing well.

# Implementation
[Composer](https://getcomposer.org/) MUST be the only dependency manager used.
