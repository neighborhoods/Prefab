# Summary
The PHP langauge has improved a lot since PHP 7 was introduced, and some important improvements have also been made since then. This document describes some of the language features that we leverage and extend in order to accomplish the `Protean` architecture specification.

# Typing
PHP 7 introduced [strict typing](http://php.net/manual/en/functions.arguments.php#functions.arguments.type-declaration.strict) and the ability for [return type declarations](http://php.net/manual/en/functions.returning-values.php#functions.returning-values.type-declaration) as well as continuing with the ability to use [argument type declarations](http://php.net/manual/en/functions.arguments.php#functions.arguments.type-declaration). 
* All methods MUST provide a typed declaration of any arguments or returned actors. 
* All PHP files MUST `declare(strict_types=1);`
* All methods SHOULD NOT declare an `array` primitive as an argument or return type declaration. See [Typed Arrays](#typed-arrays).
* All methods MUST NOT use nullable types.

# Interfaces
All classes MUST have an Interface. 

# Typed Arrays
PHP 7 still does not have language support for typed collections of objects. We have created the ability to have Typed Arrays of any arbitrary object. See the `prefab` repository for code generation specifics.
* Typed Arrays MUST be code generated.
* Typed Arrays MUST be used to pass object collections between public interfaces. 
* Typed Arrays SHOULD also be used for internal storage and access inside an actor.

# Aware Traits
PHP has included [Traits](http://php.net/manual/en/language.oop5.traits.php) since `>=` `5.4.0`. We will use code generated Traits in a singular, and very specific way. 

Aware Traits provide the ability to include getters and setters for `Object1` that can be included in other objects to make them aware of `Object1`.
* Aware Traits MUST be code generated.  
* Aware Traits SHOULD be used as the method in which to acces other actors within in object.  There must be a sufficiently strong reason to use a hand written getter or setter for an external actor and that reason MUST be documented in the PR along with any considerations on how to avoid code duplication and tight coupling.
* Traits MUST NOT be used in any other way.

# Composition Over Inheritence
As with any sufficiently mature software project, all of the features have a time and place when they are appropriate to use.  However, 
* All classes and interfaces SHOULD NOT use inheritence. There must be a sufficiently strong reason to inherit from an object, and that reason MUST be documented in the PR along with any considerations on how to decouple that object in the future.

# Object Methods
As with any sufficiently mature software project, all of the features have a time and place when they are appropriate to use.  However, 
* All methods MUST be either `public` or `protected`.
* All methods MUST NOT be `static`.
* All methods MUST do one thing and one thing well.
* All methods MUST NOT return error or success information. A method succeeds by default, if it cannot complete it's contract it MUST throw an `Exception`.
* All methods who are not asked to return an actor MUST return the interface to the class.
* All methods SHOULD have one and only one return statement.

# Objects
As with any sufficiently mature software project, all of the features have a time and place when they are appropriate to use.  However, 
* Objects MUST NOT be `static`.
