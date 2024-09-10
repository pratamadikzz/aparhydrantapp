<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Interactive Map with Pins</title>
    <link rel="stylesheet" href="styles.css">
   <style>
    body {
    font-family: Arial, sans-serif;
}

.map-container {
    position: relative;
    width: 100%;
    max-width: 800px;
    margin: 0 auto;
    cursor: crosshair;
}

.map {
    width: 100%;
    display: block;
}

.pin {
    position: absolute;
    width: 24px;
    height: 24px;
    background-color: red;
    border-radius: 50%;
    cursor: pointer;
    transform: translate(-50%, -50%);
}

.modal {
    display: none;
    position: fixed;
    z-index: 1;
    left: 0;
    top: 0;
    width: 100%;
    height: 100%;
    overflow: auto;
    background-color: rgb(0,0,0);
    background-color: rgba(0,0,0,0.4);
    padding-top: 60px;
}

.modal-content {
    background-color: #fefefe;
    margin: 5% auto;
    padding: 20px;
    border: 1px solid #888;
    width: 80%;
}

.close {
    color: #aaa;
    float: right;
    font-size: 28px;
    font-weight: bold;
}

.close:hover,
.close:focus {
    color: black;
    text-decoration: none;
    cursor: pointer;
}

   </style>
</head>
<body>
    <div class="map-container" id="map-container">
        <img src="map.jpg" alt="Map" class="map">
    </div>

    <!-- Modal -->
    <div id="modal" class="modal">
        <div class="modal-content">
            <span class="close">&times;</span>
            <p>Pin Details</p>
            <!-- Add more content here -->
        </div>
    </div>

    <script src="script.js"></script>
</body>
<script>
  // Get the modal
var modal = document.getElementById("modal");

// Get the <span> element that closes the modal
var span = document.getElementsByClassName("close")[0];

// Get the map container
var mapContainer = document.getElementById("map-container");

// Load pins from local storage
function loadPins() {
    var pins = JSON.parse(localStorage.getItem("pins")) || [];
    pins.forEach(pinData => {
        createPin(pinData.x, pinData.y);
    });
}

// Save pins to local storage
function savePins() {
    var pins = [];
    var pinElements = document.getElementsByClassName("pin");
    for (var i = 0; i < pinElements.length; i++) {
        var pin = pinElements[i];
        pins.push({
            x: parseInt(pin.style.left),
            y: parseInt(pin.style.top)
        });
    }
    localStorage.setItem("pins", JSON.stringify(pins));
}

// Function to create a new pin
function createPin(x, y) {
    var pin = document.createElement("div");
    pin.className = "pin";
    pin.style.left = x + "px";
    pin.style.top = y + "px";
    pin.onclick = function() {
        modal.style.display = "block";
    };
    mapContainer.appendChild(pin);
    savePins();
}

// When the user clicks on <span> (x), close the modal
span.onclick = function() {
    modal.style.display = "none";
}

// When the user clicks anywhere outside of the modal, close it
window.onclick = function(event) {
    if (event.target == modal) {
        modal.style.display = "none";
    }
}

// When the user clicks on the map container, create a new pin
mapContainer.onclick = function(event) {
    var rect = mapContainer.getBoundingClientRect();
    var x = event.clientX - rect.left;
    var y = event.clientY - rect.top;
    createPin(x, y);
}

// Load existing pins when the page loads
window.onload = function() {
    loadPins();
}

</script>
</html>
