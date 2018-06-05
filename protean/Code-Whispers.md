# Summary
`Code Smell` is the concept of a colleciton of indicators that code is poorly written. This has taken on a very negative connotation equivalent to "You are doing it wrong".  

Refactoring is a constant, never ending process, and should be practiced constantly and agressively by any expert software engineer. Most of the time the *when* to refactor is not known when piece of software is started.  The idea of `Code Smell` creates a fear that everything must be perfect from the beginning, or that refactoring means that "You did it wrong". If this was the case then every piece of software has been "doing it wrong" since the Babbage engine.

This document attempts to define a less severe concept of `Code Smell` called `Code Whispers` where the distinction is that a judgement is not being passed on the author, but rather the emphasis is more like a long line marker; an indicator that the code is *whispering* to you that refactoring should happen at this point.

# Examples
Your code might be whispering to you to refactor it if
* A long line marker is exceeded.
* A method is greater than 30 lines long.
* A method uses the word `and`.
* Code cannot be understood without comments.
* Variable names are abbreviated or not descriptive.
* Method names are abbreviated or not descriptive.
* A class over 175 lines long.
* Methods are not asks or tells.
* Methods do not have strict contracts.
* A method takes more than one argument.
