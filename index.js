const express = require('express'),
  app = express(),
  server = require('http').createServer(app),
  io = require('socket.io')(server)

const CANVAS_ROWS = 50
const CANVAS_COLS = 50

var canvas = []

for (var row = 0; row < CANVAS_ROWS; row++) {
  canvas[row] = []

  for (var col = 0; col < CANVAS_COLS; col++) {
    canvas[row][col] = "#FFF"
  }
}

app.use(express.static("public"))

io.on("connection", socket => {
  socket.emit("canvas", canvas)

  socket.on("color", data => {
    if (data.row <= CANVAS_ROWS && data.row > 0 && data.col <= CANVAS_COLS && data.col > 0) {
      canvas[data.row - 1][data.col - 1] = data.color
      io.emit("canvas", canvas)
    }
  })
})

server.listen(process.env.PORT || 3000)