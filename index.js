const express = require('express'),
      app = express(),
      server = require('http').createServer(app),
      io = require('socket.io')(server)

require('dotenv').config();
const exp = require('constants');
const { auth } = require('express-openid-connect');
const CANVAS_ROWS = 50
const CANVAS_COLS = 50
var indexRouter = require("./app.js")
var canvas = []

for(var row = 0; row < CANVAS_ROWS; row++){
  canvas[row] = [ ]
  
  for(var col = 0; col < CANVAS_COLS; col++){
    canvas[row][col] = "#FFF"
  }
}
app.use(
  auth({
    authRequired: false,
    issuerBaseURL: process.env.ISSUER_BASE_URL,
    baseURL: process.env.BASE_URL,
    clientID: process.env.CLIENT_ID,
    secret: process.env.SECRET,
    idpLogout: true,
  })
);
app.set("views","public")
app.set("view engine","ejs")
app.use(express.json())
app.use(express.urlencoded({ extended: true}))
app.use(express.static("public"))
app.use("/", indexRouter)

app.get('/', (req, res) => {
  res.send(req.oidc.isAuthenticated() ? 'Logged in' : 'Logged out')
  res.render("index", {title: "Express done"})
})

app.get('/profile', (req, res) => {
  res.send(req.oidc.user)
})


io.on("connection", socket => {
    socket.emit("canvas", canvas)

    socket.on("color", data => {
        if(data.row <= CANVAS_ROWS && data.row > 0 && data.col <= CANVAS_COLS && data.col > 0){
            canvas[data.row - 1][data.col - 1] = data.color
            io.emit("canvas", canvas)
        }
    })
})

server.listen(process.env.PORT || 3000)