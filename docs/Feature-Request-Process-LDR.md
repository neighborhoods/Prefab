# Prefab Feature Request Process
* Start Date: 2019-04-15
* Author: Noah Leapai

## Summary
This LDR outlines the process for requesting features or support from the Prefab team.

## Problem
Historically, the owners of Prefab have not been able to allocate time toward 
completing the numerous requests from clients of the product. This led to users
self-serving and committing their changes to the repo as they saw fit.

Now that Prefab is an official project, we are able to resume ownership and allocate
time toward maturing the product. However, we still need a process to help identify 
and prioritize feature requests/support tasks so that we may deliver valueable improvements 
in a timely manner.

## Proposed Solution
We want to follow Protean's [Expectations of Projects and Sprints](https://github.com/neighborhoods/Protean/blob/4.x/Architecture/Expectations-of-Projects-and-Sprints.md)
as much as possible. Specifically, sprinted work with Retros and Sprint Committments. 
This means owners will review all known requests before setting Sprint Committments.

To help owners prioritize requests, we propose the following JIRA Ticket Description template to be filled out by clients:
```
Problem: 
 - A succinct description of the problem you are encountering when 
   using Prefab or with the resulting generated code.
   
Desired Outcome:
 - A clearly explained result of the requested feature/support
 
Value:
 - The benefit as it relates to you/your product/others
 
Urgency/Desired Due Date:
 - Is this a blocker for a time sensitive task?
```

## Backward Incompatible Changes
None

## Example 1
```
Problem: 
 - A succinct description of the problem you are encountering when 
   using Prefab or with the resulting generated code.
   
Desired Outcome:
 - A clearly explained result of the requested feature/support
 
Value:
 - The benefit as it relates to you/your product/others
 
Urgency/Desired Due Date:
 - Is this a blocker for a time sensitive task?
```

## Counterexample 1
"I have a PR for something I needed to change in PR. Can you take a look?"

## Future Scope
* This section details areas where the feature might be improved in future, but that are not currently proposed in this LDR.
* If nothing, explicitly state that.

## Drawbacks
* Why should we \*not\* do this? 
* This should heavily take into consideration our [Engineering Values](Humans/Engineering-Values.md). 
* If nothing, explicitly state that.

## Unresolved Questions
* What parts of the design do you expect to resolve through the LDR process before this gets merged?
* What parts of the design do you expect to resolve through the implementation of this feature before stabilization?
* What related issues do you consider out of scope for this LDR that could be addressed in the future independently of the solution that comes out of this LDR?
* Make sure there are no unresolved questions when the vote starts.
* If adopted, delete this section before merging.

## Alternatives
* Why is this design the best in the space of possible designs?
* What other designs have been considered and what is the rationale for not choosing them?
* What is the impact of not doing this?
* If nothing, explicitly state that.

## Implementation Links
After the LDR is implemented, this section should contain:
* Links to any merged PRs.
* Links to any `Fitness` `UseCases`.
* Links to any JIRA tickets, Github issues, etc.
* Links to SonarQube implementations.
* If nothing, explicitly state that.

## Rejected Features
* Features that were were removed from scope. 
* If nothing, explicitly state that.

## References
* [LDR Google calendar](https://calendar.google.com/calendar?cid=NTVwbGFjZXMuY29tX3JrNG12NzFnYzEwNDhwZ3EwcWptMDZidGdjQGdyb3VwLmNhbGVuZGFyLmdvb2dsZS5jb20)
* [RFC 2119 Keywords](https://www.ietf.org/rfc/rfc2119.txt)

Links to external references, related ideas, discussions, or other LDRs.
