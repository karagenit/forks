# Github Repository Forks

Find Most Updated Forks of a Github Repository

**Standard Roadmap**  

- [x] Better Sorting
- [x] OAuth Login & Sessions
- [ ] Bootstrap
- [ ] Error Page/About Page

**AJAX Roadmap**

- [ ] AJAX Requests (Sorting Server Side)
- [ ] Client Side Sorting
- [ ] Load More Feature

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

* Watchers
* Disk Usage: could compare to parent, see how much code has been added
* Forks: if this fork has been forked, it must have made useful changes
* Issues: if this fork has many open issues, it might be popular
* Mentionable Users: if this fork has many mentionable users, it probably has many contributors
* Commit Comments: if this fork has many commit comments, it's probably popular
* Milestones
* Projects
* PRs
* Releases
* Stargazers (stars)

Others that might be useable:

* defaultBranchRef
* refs

### OAuth

We need to set up our app as an OAuth app to be able to access the GraphQL API from the command line. We might also consider having clients register our app, so that requests count against their 5000 limit and not ours. 
