# Summary
This document attempts to define a concept of `Code Whispers` that differs from the concept of `Code Smell`.

# Problem
`Code Smell` is the concept of a collection of indicators that code is poorly written. This has taken on a very negative connotation equivalent to "You are doing it wrong".  

Refactoring is a neverending process. It should be practiced constantly and agressively by any expert software engineer. The art of refactoring is *not* a tool that gets employed only on special occasion. Rather, it is an *inherent* and *continous* part of software engineering.

Most of the time the *when* to refactor is not known when authorship of a piece of software begins.  The idea of `Code Smell` creates a fear that everything must be perfect from the beginning, or that refactoring indicates that "You did it wrong". If this was the case then every piece of software has been "doing it wrong" since the Babbage engine. 

This sentiment encourages software engineers to not perform this critical behavior. The sentiment of `Code Smell` is an anti-pattern.

# Solution
Use the concept of `Code Whispers`. The distinction is that a judgement is not being passed on the author, but rather the emphasis is more akin to a long line marker; it is an indicator that the code is *whispering* to you that refactoring should happen at this point.

# Examples
Your code might be whispering to you to refactor it if
* A long line marker is exceeded.
* A method is greater than 30 lines long.
* A method uses the word `and`.
* Code cannot be understood without comments.
* Variable names are abbreviated or not descriptive.
* Method names are abbreviated or not descriptive.
* A class is over 175 lines long.
* Methods are not asks or tells.
* Methods do not have strict contracts.
* A method takes more than one argument.
