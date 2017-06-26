query($owner:String! $name:String! $count:Int=20){
    repository(owner: $owner name: $name) {
        forks(first: $count orderBy:{field:STARGAZERS, direction:DESC}) {
            edges {
                node {
                    nameWithOwner
                    pushedAt
                    diskUsage
                    watchers { totalCount }
                    forks { totalCount }
                    issues { totalCount }
                    mentionableUsers { totalCount }
                    commitComments { totalCount }
                    milestones { totalCount }
                    projects { totalCount }
                    pullRequests { totalCount }
                    releases { totalCount }
                    stargazers { totalCount }
                }
                cursor
            }
        }
    }
}
