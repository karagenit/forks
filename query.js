query($owner:String!){
    repository(owner: $owner name:"jQuery") {
        name
    }
}
