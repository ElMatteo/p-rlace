$(document).ready(() => {
  var socket = io()

  var canvas = $("#rlace")[0]
  var ctx = canvas.getContext("2d")

  socket.on("canvas", canvasData => {
    canvasData.forEach((row, rowIndex) => {
      row.forEach((col, colIndex) => {
        ctx.fillStyle = col
        ctx.fillRect(colIndex * 10, rowIndex * 10, 10, 10)
      })
    })
  })

  $("#submit").click(() => {
    socket.emit("color", {
      col: parseInt($("#x-coord").val()),
      row: parseInt($("#y-coord").val()),
      color: $("#color").val()
    })
  })

  $('#rlace').click(function(e){
      var elm = $(this);
      var x = e.pageX - elm.offset().left;
      var y = e.pageY - elm.offset().top;

      console.log(x, y);

      // divide x and y by 10 but never get under 0
      x = Math.max(0, Math.floor(x/10));
      y = Math.max(0, Math.floor(y/10));


      console.log(x, y);

      socket.emit("color", {
          col: x,
          row: y,
          color: $("#color").val()
      })
  });

  // Slider JS

  var sliderx = document.getElementById("x-coord");
  var outputx = document.getElementById("valueX");
  // Display the default slider value
  outputx.innerHTML = "X = "+sliderx.value; 

  // Update the current slider value
  sliderx.oninput = function() {
    outputx.innerHTML = "X = "+sliderx.value;
  }

  var slidery = document.getElementById("y-coord");
  var outputy = document.getElementById("valueY");
  // Display the default slider value
  outputy.innerHTML = "Y = "+slidery.value;

  // Update the current slider value
  slidery.oninput = function() {
    outputy.innerHTML = "Y = "+slidery.value;
  }

})