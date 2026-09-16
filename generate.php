<?php
// memanggil file koneksi.php untuk membuat koneksi

?>
<!DOCTYPE html>
<html lang="en">

<head>
    <!-- Required meta tags -->
    <meta charset="utf-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no" />
    <title>Skydash Admin</title>
    <!-- plugins:css -->
    <link rel="stylesheet" href="../vendors/feather/feather.css" />
    <link rel="stylesheet" href="../vendors/ti-icons/css/themify-icons.css" />
    <link rel="stylesheet" href="../vendors/css/vendor.bundle.base.css" />
    <!-- endinject -->
    <!-- Plugin css for this page -->

    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.2/css/all.min.css">
    <!-- End plugin css for this page -->
    <!-- inject:css -->
    <link rel="stylesheet" href="../css/vertical-layout-light/style.css" />
    <!-- endinject -->

    <script src="https://cdnjs.cloudflare.com/ajax/libs/jszip/3.7.1/jszip.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/FileSaver.js/2.0.5/FileSaver.min.js"></script>

    <link rel="shortcut icon" href="../images/favicon.png" />
</head>
<style>

</style>

<body>
    <div class="container-scroller">
        <!-- partial:partials/_navbar.html -->
    <!-- partial -->
    <div class="container-fluid page-body-wrapper">
        <!-- partial:partials/_settings-panel.html -->
        <style>
            .nav-link {
                display: flex;
                align-items: center;
                padding: 10px 15px;
                text-decoration: none;
            }

            .nav-item {
                margin-bottom: 10px;
                /* Adjust as needed for spacing */
            }

            .nav .menu-title {
                margin-left: 10px;
                /* Adjust as needed for icon spacing */
            }
        </style>

    
        <style>
            .qr-code {
                position: relative;
                display: inline-block;
            }

            .qr-code img.card-image {
                width: 100%;
                height: auto;
            }

            .qr-code .qr-image {
                position: absolute;
                top: 128px;
                right: 20px;
                width: 140px;
                height: 140px;
            }


            .qr-container {
                position: absolute;
                top: 128px;
                right: 20px;
            }

            .card-text {
                position: absolute;
                top: 55%;
                left: 20px;
                transform: translate(0, -50%);
                display: flex;
                align-items: center;
                gap: 20px;
                /* Adjust gap as needed */
                text-align: left;
                /* Ensure text is aligned to the left */
            }


            .card-t,
            .card-i {
                font-size: 12px;
            }

            .card-t div,
            .card-i div {
                margin-bottom: 4px;
            }

            .nama-mesin {
                display: block;
                max-width: 150px;
                word-wrap: break-word;
                white-space: normal;
            }

            /* CSS tambahan untuk kelas span baru */
            .text-mesin {
                font-weight: bold;

                /* Anda bisa mengganti warna sesuai keinginan */
            }

            .text-lokasi {
                font-weight: bold;
                /* Anda bisa mengganti warna sesuai keinginan */
            }

            .text-department {
                font-weight: bold;

                /* Anda bisa mengganti warna sesuai keinginan */
            }

            .separator {
                margin: 0 5px;
                /* Adjust space around the colon */
            }
        </style>



        <?php
        include 'koneksi.php';
        $query = "SELECT 
        data_apar.*, 
        tbl_lokasi.lokasi, 
        tbl_departemen.departemen, 
        jenis_apar.jenis_apar 
    FROM data_apar 
    JOIN tbl_lokasi ON data_apar.lokasi = tbl_lokasi.id 
    JOIN tbl_departemen ON data_apar.departemen = tbl_departemen.id 
    JOIN jenis_apar ON data_apar.jenis_apar = jenis_apar.id 
    ORDER BY data_apar.id ASC
    ";
        $result = mysqli_query($koneksi, $query);

        if (!$result) {
            die("Query Error: " . mysqli_errno($koneksi) . " - " . mysqli_error($koneksi));
        }

        $row = mysqli_fetch_assoc($result);
        $code_apar = $row['code_apar']; // Pastikan 'code_apar' adalah kolom yang ada di tabel Anda
        ?>

        <div class="page-inner">
            <div class="container-fluid">
                <br>
                <div class="d-sm-flex align-items-center justify-content-between mb-4"></div>
                <div class="container-fluid">
                    <div class="card shadow mb-4">
                        <div class="card-header py-3">
                            <h6 class="m-0 font-weight-bold text-primary">QR Code</h6>
                        </div>
                        <div class="card-body">
                            <div class="container">
                                <div class="header">
                                    <h1>QR Code Generator</h1>
                                    <button id="download-all-btn" class="btn btn-primary">Download All</button>


                                </div>


                                <div id="qrcode-container">
                                    <?php while ($row = mysqli_fetch_assoc($result)) { ?>
                                        <div class="qr-card">
                                            <div class="qr-details">

                                                <input type="hidden" class="qr-code" value="<?php echo $row['code_apar']; ?>">
                        
                                                <span class="qr-lokasi"> <?php echo htmlspecialchars($row['lokasi']); ?></span><br>
                                                <span class="qr-departemen"> <?php echo htmlspecialchars($row['departemen']); ?></span><br>
                                                <div id="qrcode-<?php echo $row['code_apar']; ?>"></div>
                                                <canvas id="canvas-<?php echo $row['code_apar']; ?>" width="800" height="600" style="display:none;"></canvas>
                                                <button class="btn btn-success download-btn" data-code="<?php echo $row['code_apar']; ?>">Download as Image</button>
                                            </div>
                                        </div>
                                        <hr>
                                    <?php } ?>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <script src="https://cdn.rawgit.com/davidshimjs/qrcodejs/gh-pages/qrcode.min.js"></script>
        <script>
           document.getElementById('download-all-btn').addEventListener('click', function() {  
    console.log("Download button clicked");

    var zip = new JSZip();
    var container = document.getElementById("qrcode-container");
    var cards = container.getElementsByClassName("qr-card");
    var zipFilename = "all_qrcode.zip";
    var promises = [];

    console.log("Total cards found:", cards.length);

    for (var i = 0; i < cards.length; i++) {
        (function(card) {
            // Coba cek setiap card yang sedang diproses
            console.log("Processing card", i);

            // Pastikan bahwa Anda mengakses nilai QR code dengan benar.
            var codeApar = card.querySelector('.qr-code')?.value || card.querySelector('.qr-code')?.textContent;
            console.log("QR Code value for card", i, ":", codeApar);

            var canvas = card.querySelector('canvas[id^="canvas-"]');
            console.log("Canvas found for card", i, ":", canvas !== null);

            // Periksa apakah canvas benar-benar ada
            if (canvas && codeApar) {
                promises.push(new Promise(function(resolve, reject) {
                    canvas.toBlob(function(blob) {
                        if (blob) {
                            console.log("Blob created for card", i);
                            zip.file(codeApar + '.png', blob);
                            resolve();
                        } else {
                            console.log("Blob creation failed for card", i);
                            reject('Blob creation failed');
                        }
                    });
                }));
            } else {
                console.log("Canvas or QR Code not found for card", i);
            }
        })(cards[i]);
    }

    // Setelah semua canvas selesai diproses, buat ZIP
    Promise.all(promises).then(function() {
        console.log("All canvases processed, generating ZIP...");
        zip.generateAsync({
            type: "blob"
        }).then(function(content) {
            console.log("ZIP generated, saving as", zipFilename);
            saveAs(content, zipFilename);
        });
    }).catch(function(error) {
        console.error("An error occurred while creating the ZIP file:", error);
    });
});

        </script>

        <script>
            document.addEventListener("DOMContentLoaded", function() {
                generateAllQRCodes();
            });

            function generateAllQRCodes() {
                var container = document.getElementById("qrcode-container");
                var cards = container.getElementsByClassName("qr-card");

                for (var i = 0; i < cards.length; i++) {
                    var card = cards[i];
                    var qrCode = card.querySelector(".qr-code").value;
                    var qrcodeDiv = card.querySelector("div[id^='qrcode-']");
                    var canvas = card.querySelector("canvas[id^='canvas-']");

                    // Generate QR code using QRCode.js
                    var qrcode = new QRCode(qrcodeDiv, {
                        text: qrCode,
                        width: 340,
                        height: 340
                    });

                    setTimeout((function(canvas, qrcodeDiv, qrCode, card) {
                        return function() {
                            var qrImg = qrcodeDiv.querySelector('img');
                            var qrImgSrc = qrImg.src;

                            var context = canvas.getContext('2d');
                            context.clearRect(0, 0, canvas.width, canvas.height);

                            // Load the card image
                            var cardImage = new Image();
                            cardImage.crossOrigin = "Anonymous"; // Ensure cross-origin is handled
                            cardImage.src = "assets/img/kartuapar2.png";
                            cardImage.onload = function() {
                                // Draw the card image on the canvas
                                context.drawImage(cardImage, 0, 0, canvas.width, canvas.height);

                                // Create QR image
                                var qrImg = new Image();
                                qrImg.crossOrigin = "Anonymous"; // Ensure cross-origin is handled
                                qrImg.src = qrImgSrc;

                                qrImg.onload = function() {
                                    // Calculate the position for the QR code
                                    const qrX = canvas.width - qrImg.width - 30; // 30px padding from right
                                    const qrY = 144; // 144px padding from top

                                    // Draw the QR code on the canvas
                                    context.drawImage(qrImg, qrX, qrY, qrImg.width, qrImg.height);

                                    // Set text properties
                                    context.font = "bold 27px verdana"; // Ukuran font ditingkatkan
                                    context.fillStyle = "black";
                                    context.textAlign = "left";

                                    // Get the text values
                                    const noMesinTex = "";
                        
                                    const namaLokasiTex = "";
                                    const namaDepartmentTex = "";

                                    // Retrieve values from the card elements
                                    const noMesinText = qrCode;
                                    const namaLokasiText = card.querySelector(".qr-lokasi").innerText;
                                    const namaDepartmentText = card.querySelector(".qr-departemen").innerText;

                                    // Draw the labels on the canvas
                                    const labelX = 10;

                                    const baseY = 276;
                                    const lineHeight = 30;

                                    const separatorWidth = context.measureText(':').width;

                                    // Define the fixed position for the separator (adjust 'separatorX' as needed)
                                    const separatorX = labelX + 210; // Adjusted to 160 for moving the separator to the right

                                    // Define the position for the right text (adjust 'textMargin' as needed)
                                    const textMargin = 20; // Adjusted to 20 for moving the text to the right
                                    const valueX = separatorX + separatorWidth + textMargin;

                                    // Function to check if text will overlap with QR code and adjust position
                                    function drawTextWithWrap(text, x, y) {
                                        const words = text.split(/(\s+|-)/); // Split by spaces and "-"
                                        let line = '';
                                        let testLine = '';
                                        let testWidth = 0;

                                        for (let n = 0; n < words.length; n++) {
                                            testLine = line + words[n];

                                            if (words[n] === '-' || x + context.measureText(testLine).width > qrX) {
                                                // Move to next line if encountering a "-" or text overlaps with QR code
                                                context.fillText(line.trim(), x, y);
                                                line = words[n];
                                                y += lineHeight;
                                            } else {
                                                line = testLine;
                                            }
                                        }
                                        context.fillText(line.trim(), x, y);
                                        return y + lineHeight; // Return the y position after drawing all text
                                    }

                                    // Drawing the text and separators
                                    let currentY = baseY;

                                    context.fillText(noMesinTex, labelX, currentY);
                                    context.fillText("", separatorX, currentY);
                                    currentY = drawTextWithWrap(noMesinText, valueX, currentY);

                                    currentY += lineHeight * 3 - 60;
                                    context.fillText(namaLokasiTex, labelX, currentY);
                                    context.fillText('', separatorX, currentY);
                                    currentY = drawTextWithWrap(namaLokasiText, valueX, currentY);

                                    currentY += lineHeight * 3 - 55;
                                    context.fillText(namaDepartmentTex, labelX, currentY);
                                    context.fillText('', separatorX, currentY);
                                    drawTextWithWrap(namaDepartmentText, valueX, currentY);

                                    // Show the canvas
                                    canvas.style.display = 'block';
                                }
                            }
                        }
                    })(canvas, qrcodeDiv, qrCode, card), 1000); // Delay to ensure QR code generation is complete
                }
            }

            // Download button functionality
            document.querySelectorAll('.download-btn').forEach(function(button) {
                button.addEventListener('click', function() {
                    var codeApar = this.getAttribute('data-code');
                    var canvas = document.getElementById('canvas-' + codeApar);
                    var link = document.createElement('a');
                    link.href = canvas.toDataURL('image/png');
                    link.download = codeApar + '.png';
                    link.click();
                });
            });
        </script>




    </div>



    </div>

    <!-- Custom template | don't include it in your project! -->

    <!-- End Custom template -->
    </div>
    <!--   Core JS Files   -->
    <script src="../assets/js/core/jquery-3.7.1.min.js"></script>
    <script src="../assets/js/core/popper.min.js"></script>
    <script src="../assets/js/core/bootstrap.min.js"></script>


    <!-- jQuery Scrollbar -->
    <script src="../assets/js/plugin/jquery-scrollbar/jquery.scrollbar.min.js"></script>

    <!-- Chart JS -->
    <script src="../assets/js/plugin/chart.js/chart.min.js"></script>

    <!-- jQuery Sparkline -->
    <script src="../assets/js/plugin/jquery.sparkline/jquery.sparkline.min.js"></script>

    <!-- Chart Circle -->
    <script src="../assets/js/plugin/chart-circle/circles.min.js"></script>

    <!-- Datatables -->
    <script src="../assets/js/plugin/datatables/datatables.min.js"></script>

    <!-- Bootstrap Notify -->
    <script src="../assets/js/plugin/bootstrap-notify/bootstrap-notify.min.js"></script>

    <!-- jQuery Vector Maps -->
    <script src="../assets/js/plugin/jsvectormap/jsvectormap.min.js"></script>
    <script src="../assets/js/plugin/jsvectormap/world.js"></script>

    <!-- Sweet Alert -->
    <script src="../assets/js/plugin/sweetalert/sweetalert.min.js"></script>

    <!-- Kaiadmin JS -->
    <script src="../assets/js/kaiadmin.min.js"></script>

    <!-- Kaiadmin DEMO methods, don't include it in your project! -->




</body>

</html>