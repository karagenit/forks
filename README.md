# Github Repository Forks

Find Most Updated Forks of a Github Repository

**Roadmap of Planned Features**  

- [x] Better Sorting
- [x] OAuth Login & Sessions
- [x] Bootstrap
- [x] Error Messages
- [ ] User Settings [#18] \[#36]
- [ ] General Cleanup [#42] \[#39]
- [ ] Redesign Query Page [#26] \[#43] [#44]
- [ ] Redesign Results Page [#28] \[#33]
- [ ] Webflow Redesign [#23] \[#25] \[#44]
- [ ] Improve Search [#17] \[#37]
- [ ] AJAX Requests (Sorting Server Side) [#13]
- [ ] Client Side Sorting [#16]
- [ ] Load More Feature [#11]
- [ ] Client Side Queries [#14]
- [ ] Improve Error Reporting [#41]


**Future Ideas**

## Setup & Install

Requires `bootstrap v3.3.7` extracted in the `bootstrap/` directory. Requires files `client_id.token` and `client_secret.token` located in the root project directory - you are given these keys when you register a Github OAuth app. 

## Site Layout

Index Page: Describes app, link to github's oauth authorization page.  
Auth Page: Saves user token, sets up PHP session with user  
Query Page: Takes user input, passes to result page  
Result Page: Performs query based on user's token, displays results  

We could also combine the Query/Result pages (e.g. by checking if the POST header has data - if so, run query) so the user doesn't have to click back to run a new query.

### AJAX

I think it would be neat to eventually set it up for AJAX (site layout would be mostly the same, we'd probably still use sessions [and have the AJAX pass a session token back with the new query or whatever] and the Query page would be JS). I think the PHP would simply perform the query and hand the JSON object from github to the client. This would make the "load more" feature much easier, as the client would handle the sorting & calculations - otherwise, to "load more", the client would have to send it's current data set back to the server so the server can sort all of them. (Load more will still have to tell it what `cursor` to start the query at). 

Oh, oh, we could even do the query client side! That's a little ways off...


## Documentation

> **Protip**  
> When creating the JSON object for the GraphQL query, you have to have each of the initial {} on a new line!

### API References

[Forks](https://developer.github.com/v3/repos/forks/#forks)  
[Commits](https://developer.github.com/v3/repos/commits/#commits)  
[Branches](https://developer.github.com/v3/repos/branches/#get-branch)  
[Traffic](https://developer.github.com/v3/repos/traffic/)  
[Statistics](https://developer.github.com/v3/repos/statistics/)  

### Analytics Ideas

- Stars
- Issues (Pulse data)
- Forks
- Last Update
- Commits Above/Behind Parent

With certain cursors put in the `after` tag, it returns an error. I think maybe it times out searching through the list of forks.

### Available Analytics Fields

**Sort By**

We can only grab 100 repos at a time. We can, however, tell it to give us certain ones first a la `orderBy`. 

Either oldest created or most recently pushed. Can also do most recently "updated" but this is kind of arbitrary and will eventually be deprecated in the API.

**Calculate**

This is how we determine which is the "most popular" repo. Current methods the API exposes:

- [x] Watchers
- [ ] Disk Usage: could compare to parent, see how much code has been added
- [ ] Forks: if this fork has been forked, it must have made useful changes
- [x] Issues: if this fork has many open issues, it might be popular
- [x] Mentionable Users: if this fork has many mentionable users, it probably has many contributors
- [ ] Commit Comments: if this fork has many commit comments, it's probably popular
- [ ] Milestones
- [ ] Projects
- [ ] PRs
- [ ] Releases
- [x] Stargazers (stars)

Others that might be usable:

* defaultBranchRef
* refs
