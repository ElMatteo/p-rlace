const sql = require("mysql")
const db = sql.createConnection({
    host: "localhost",
    user: "root",
    password: "",
    database: "r/place"
})

module.exports = db