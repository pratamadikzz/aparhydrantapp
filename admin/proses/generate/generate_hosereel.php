<?php
session_start();
if (!isset($_SESSION['username'])) {
    header("Location: ../../../login.php");
    exit();
}

include '../../../koneksi.php';
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Generate QR Hose Reel</title>
    <link rel="stylesheet" href="../../../assets/css/bootstrap.min.css">
    <script src="../../../assets/js/qrcode.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/interactjs/dist/interact.min.js"></script>
    <style>
        #templateCard {
            position: relative;
            width: 800px;
            height: 600px;
            background-image: url('../../../assets/img/hydrantcard.png');
            background-size: cover;
            margin-bottom: 20px;
        }

        #qrContainer, #codeText, #lokasiText {
            position: absolute;
            cursor: move;
        }

        #qrContainer {
            top: 250px;
            right: 450px;
            width: 250px;
            height: 250px;
        }

        #codeText {
            top: 220px;
            left: 645px;
            font-weight: bold;
            font-size: 25px;
            width: auto;
            height: auto;
        }

        #lokasiText {
            top: 265px;
            left: 645px;
            font-weight: bold;
            font-size: 25px;
            width: 150px;
        }

        .resizable {
            touch-action: none;
        }
    </style>
</head>
<body class="p-3">
    <h3>Generate QR Hose Reel</h3>
    <div class="mb-3">
        <label for="hoseSelect">Pilih Hose Reel:</label>
        <select id="hoseSelect" class="form-control">
            <option value="">-- Pilih Hose Reel --</option>
            <?php
            $query = "SELECT code, lokasi FROM hosereel ORDER BY code ASC";
            $result = mysqli_query($koneksi, $query);
            while($row = mysqli_fetch_assoc($result)){
                echo "<option value='{$row['code']}' data-lokasi='{$row['lokasi']}'>{$row['code']} - {$row['lokasi']}</option>";
            }
            ?>
        </select>
    </div>

    <button class="btn btn-primary mb-3" onclick="generateQRCode()">Generate QR</button>
    <button class="btn btn-success mb-3" id="downloadBtn">Download as Image</button>

    <div id="templateCard">
        <div id="qrContainer" class="draggable resizable"></div>
        <div id="codeText" class="draggable resizable"></div>
        <div id="lokasiText" class="draggable resizable"></div>
    </div>

    <canvas id="canvas" width="800" height="600" style="display:none;"></canvas>

<script>
// Wrap text function
function wrapText(ctx, text, x, y, maxWidth, lineHeight){
    let words = text.split(' ');
    let line = '';
    for(let n=0; n<words.length; n++){
        let testLine = line + words[n] + ' ';
        let metrics = ctx.measureText(testLine);
        if(metrics.width > maxWidth && n>0){
            ctx.fillText(line, x, y);
            line = words[n] + ' ';
            y += lineHeight;
        } else {
            line = testLine;
        }
    }
    ctx.fillText(line, x, y);
}

// Generate QR & set text
function generateQRCode(){
    const select = document.getElementById('hoseSelect');
    const code = select.value;
    if(!code) return alert('Pilih Hose Reel dulu');
    const lokasi = select.selectedOptions[0].dataset.lokasi;

    const qrDiv = document.getElementById('qrContainer');
    qrDiv.innerHTML = '';
    new QRCode(qrDiv, { text: code, width: qrDiv.offsetWidth, height: qrDiv.offsetHeight });

    const codeText = document.getElementById('codeText');
    const lokasiText = document.getElementById('lokasiText');
    codeText.innerText = code;
    lokasiText.innerText = lokasi;
}

// Drag & Resize menggunakan interact.js
interact('.draggable')
  .draggable({
    inertia: true,
    modifiers: [interact.modifiers.restrictRect({ restriction: '#templateCard', endOnly: true })],
    listeners: {
      move(event) {
        const target = event.target;
        const x = (parseFloat(target.getAttribute('data-x')) || 0) + event.dx;
        const y = (parseFloat(target.getAttribute('data-y')) || 0) + event.dy;
        target.style.transform = `translate(${x}px, ${y}px)`;
        target.setAttribute('data-x', x);
        target.setAttribute('data-y', y);
      }
    }
  });

interact('.resizable')
  .resizable({
    edges: { left:true, right:true, bottom:true, top:true },
    listeners: {
      move(event) {
        const target = event.target;
        let width = event.rect.width;
        let height = event.rect.height;
        target.style.width = width + 'px';
        target.style.height = height + 'px';
        const x = (parseFloat(target.getAttribute('data-x')) || 0) + event.deltaRect.left;
        const y = (parseFloat(target.getAttribute('data-y')) || 0) + event.deltaRect.top;
        target.style.transform = `translate(${x}px, ${y}px)`;
        target.setAttribute('data-x', x);
        target.setAttribute('data-y', y);
      }
    },
    modifiers: [
      interact.modifiers.restrictEdges({ outer:'#templateCard' }),
      interact.modifiers.restrictSize({ min:{width:50,height:50} })
    ]
  });

// Download canvas sesuai posisi & ukuran elemen
document.getElementById('downloadBtn').addEventListener('click', ()=>{
    const canvas = document.getElementById('canvas');
    const ctx = canvas.getContext('2d');
    ctx.clearRect(0,0,canvas.width,canvas.height);

    // Background
    const bg = new Image();
    bg.src = '../../../assets/img/hydrantcard.png';
    bg.onload = ()=>{
        ctx.drawImage(bg,0,0,canvas.width,canvas.height);

        // QR
        const qrDiv = document.getElementById('qrContainer');
        const qrImg = qrDiv.querySelector('img');
        if(qrImg){
            const rect = qrDiv.getBoundingClientRect();
            const parentRect = qrDiv.parentElement.getBoundingClientRect();
            const x = rect.left - parentRect.left;
            const y = rect.top - parentRect.top;
            ctx.drawImage(qrImg, x, y, qrDiv.offsetWidth, qrDiv.offsetHeight);
        }

        // Code text
        const codeText = document.getElementById('codeText');
        const rectCode = codeText.getBoundingClientRect();
        const parentRect = codeText.parentElement.getBoundingClientRect();
        const xCode = rectCode.left - parentRect.left;
        const yCode = rectCode.top - parentRect.top + parseInt(window.getComputedStyle(codeText).fontSize);
        ctx.font = "bold 25px Verdana";
        ctx.fillStyle = "black";
        ctx.fillText(codeText.innerText, xCode, yCode);

        // Lokasi text
        const lokasiText = document.getElementById('lokasiText');
        const rectLok = lokasiText.getBoundingClientRect();
        const xLok = rectLok.left - parentRect.left;
        const yLok = rectLok.top - parentRect.top + parseInt(window.getComputedStyle(lokasiText).fontSize);
        ctx.font = "bold 20px Verdana";
        wrapText(ctx, lokasiText.innerText, xLok, yLok, lokasiText.offsetWidth, 25);

        // Download
        const link = document.createElement('a');
        link.href = canvas.toDataURL('image/png');
        link.download = codeText.innerText+'.png';
        link.click();
    }
});
</script>
</body>
</html>
