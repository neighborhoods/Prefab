# Summary
There is an uncountable number of ways to organize and create software. These documents describe the specifications of how we organize and create our software at Neighborhoods Engineering.

This specification is called Protean, or more formally; the Protean Architecture Specification.

# Problem
![simplify](images/simplify.jpeg)

# Neighborhoods Engineering Values
Protean inherits and *relies on* all of the Neighborhoods Engineering Values. These values are restated here in their entirety because their importance  cannot be emphasized enough.

## We Value...

### Ease of Change
Because nothing is permanent, my work must have clear boundaries, narrow scope and minimal complexity.

### The [Agile Manifesto](http://agilemanifesto.org/) and The [Unix Philosophy](https://en.wikipedia.org/wiki/Unix_philosophy)
I believe that these principles are paramount in writing good code, having healthy relationships with my team, and constantly seeking to improve our products and processes.

### The Best Solution
My success depends on our success. The best solution is the one that is best for the team.

### Skepticism of our Work
I know that mistakes are normal and common. I assume my work is broken until I prove otherwise.

### Experimentation
I must have a constant sense of curiosity and adaptability for improving myself, my work, our products, and my team. This requires me to fail fast and fail often to learn new things.

### The Pit of Success
Because others will share in my work, I must ensure that the work I produce guides my team toward good practices by making bad practices difficult.

### Ownership
I must take pride in my work and nurture it to ensure the success of my team and our company. Outstanding craftsmanship is vital to me.

# Product Teams
## Summary
Tight coupling and the traps of monotlithic applications lie in the ease of compromise. Within an engineering orgranization it is very often far too tempting to make the wrong decision because it is easy, and because the logic to do so resides in within the same codebase.

## Definitions
* A client product is a product that consumes information from another product.
* A service product is a product that produces information for another product.

## Specification
* All domains of responsibility MUST be separated as much as possible.
* From a technical perspective, all product teams MUST treat each individual product as if it were a **completely separate** company. The strongest separation MUST be maintained. This is especially difficult and the strongest discipline to this philosophical approach MUST be adhered to when several products are owned by the same product team.
* Service products MUST facilitate the *behavior* required by client products.  However, service products MUST dictate and be the authority with regard to how that behavior is served, and this authority MUST be derived from a technical motivation. 
* This SHOULD be a part of the conversation between the client and service product teams during the technical design phase.
* If a product team has both a client and a service product that that team owns in the context of a project, two different engineers from that team SHOULD represent each product respectively and have a conversation as if they were two separate companies from a technical perspective.

# Interface Driven Design

## Summary
Software engineers often start writing implementations rather than starting from an Interface that describes the contracts that any given implementation may have.

## Specification
Force all implementations to require an Interface to be able to be useful in our codebases.

# Immutable Contracts
## Summary
Changing the behavior of a software contract forces clients of that contract to change their behavior(s) synchronously with the introduction of the changes to the contract.  This forms very brittle relationships between providers and clients.

## Specification
Do not mutate contracts, instead create a new contract or version an existing one.

# References
* Language in all Protean documents uses [RFC 2119 Keywords](https://www.ietf.org/rfc/rfc2119.txt)
