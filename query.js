query($owner:String! $name:String! $test:String! $tester:String!){
    repository(owner: $owner name: $name) {
        forks(first:5 orderBy:{field:PUSHED_AT, direction:DESC}) {
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
