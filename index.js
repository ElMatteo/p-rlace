console.log("Starting index.js ...")
let authors = "Louis, Matteo and Theo"
let description = "UCI project of Advanced web programming. "

stringGenerator(authors, description)

function stringGenerator(authors, description) {
    console.log("This project has been done by " + authors + ".\nThe description of the project is: " + description)
}
