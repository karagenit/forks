query($owner:String! $name:String!){
    repository(owner: $owner name: $name) {
        name
    }
}
