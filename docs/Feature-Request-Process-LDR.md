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
and prioritize feature requests/support tasks so that we may deliver valuable improvements 
in a timely manner.

## Proposed Solution
We want to follow Protean's [Expectations of Projects and Sprints](https://github.com/neighborhoods/Protean/blob/4.x/Architecture/Expectations-of-Projects-and-Sprints.md)
as much as possible. Specifically, sprinted work with Retros and Sprint Commitments. 
This means owners will review all known requests before setting Sprint Commitments.

To help owners prioritize Prefab requests, we propose clients create JIRA tickets in the [Prefab project](https://55places.atlassian.net/browse/PREF) using the `Feature Request` issue type and filling out the following fields:

##### Problem:
- A succinct description of the problem you are encountering when 
using Prefab or with the resulting generated code.
   
##### Desired Outcome:
- A clearly explained result of the requested feature/support.
 
##### Urgency:
- Is this a blocker for a time sensitive task? Do you have a desired due date?

## Backward Incompatible Changes
None

## Example 1
##### Problem: 
 We have noticed that as our HTTP container grows in size, response times have been slowing significantly. 
   
##### Desired Outcome:
 We would like a way to only include what is needed for individual requests so they aren't slowed down by 
 including a bunch of unnecessary files in the Symfony containers.
 
##### Urgency/Desired Due Date:
 Listing Service is currently too slow to launch without this feature and has a deadline of 6/1. It would 
 be great if we could have a couple weeks of leeway to integrate this feature before launch, so desired date: 5/13.

## Counterexample 1
"I have a PR for something I needed to change in Prefab. Can you take a look?"

## Future Scope
This being the first attempt at improving requesting features/support, the future is unknown. Once we put this into practice, we will use the lessons learned to improve upon this process.

## Drawbacks
* I see no downsides to having documented requests with context and defined desired results over our current process.

## Unresolved Questions
* None

## Alternatives
* We could not think of any reasonable alternatives to JIRA tickets that would better offer documented requests and tie into our current sprinted workflow as quickly/easily.
* Unreasonable alternatives consist of:
  * Self-serving clients
  * Continuing with ephemeral verbal requests.
  * A google spreadsheet that nobody keeps up to date or looks at.
  * Never fulfill requests.

## Implementation Links
* https://55places.atlassian.net/browse/PREF-120

## Rejected Features
* None

## References
* [LDR Google calendar](https://calendar.google.com/calendar?cid=NTVwbGFjZXMuY29tX3JrNG12NzFnYzEwNDhwZ3EwcWptMDZidGdjQGdyb3VwLmNhbGVuZGFyLmdvb2dsZS5jb20)
* [RFC 2119 Keywords](https://www.ietf.org/rfc/rfc2119.txt)

